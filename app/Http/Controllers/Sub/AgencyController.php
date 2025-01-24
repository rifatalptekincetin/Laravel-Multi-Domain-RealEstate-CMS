<?php

namespace App\Http\Controllers\Sub;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
//user is agent
use App\Models\User;

//site is agency
use App\Models\Site;

class AgencyController extends Controller
{
    public function agents(Request $request, string $subdomain)
    {
        $site = Site::where('subdomain', $subdomain)->first();
        $agents = User::where('site_id',$site->id)->whereNotNull('image_id');
        if ($request->has('search')) {
            $agents = $agents->where('name', 'like', '%' . $request->search . '%');
        }
        $agents = $agents->paginate(12);
        return view('sub.agency.agents', [
            'agents'=>$agents,
            'title'=>settings('agents_title'),
            'meta_title'=>settings('agents_title'). ' - ' . $site->title,
            'meta_description'=>settings('agents_description'),
        ]);
    }

    public function agent(Request $request, string $subdomain, $id)
    {
        $site = Site::where('subdomain', $subdomain)->first();
        $agent = User::where('site_id',$site->id)->findOrFail($id);
        return view('sub.agency.agent', [
            'agent'=>$agent,
            'title'=>$agent->name,
            'meta_title'=>$agent->name . ' - ' . $site->title,
            'meta_description'=>Null,
        ]);
    }
}
