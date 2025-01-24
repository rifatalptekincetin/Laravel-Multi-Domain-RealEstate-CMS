<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//user is agent
use App\Models\User;

//site is agency
use App\Models\Site;

class AgencyController extends Controller
{
    public function agents(Request $request)
    {
        $agents = User::whereNotNull('image_id');
        if ($request->has('search')) {
            $agents = $agents->where('name', 'like', '%' . $request->search . '%');
        }
        $agents = $agents->orderBy('name')->paginate(12);
        return view('agency.agents', [
            'agents'=>$agents,
            'title'=>settings('agents_title'),
            'meta_title'=>settings('agents_title'). ' - ' . env('APP_NAME'),
            'meta_description'=>settings('agents_description'),
        ]);
    }

    public function agent(Request $request, $id)
    {
        $agent = User::findOrFail($id);
        return view('agency.agent', [
            'agent'=>$agent,
            'title'=>$agent->name,
            'meta_title'=>$agent->name . ' - ' . env('APP_NAME'),
            'meta_description'=>Null,
        ]);
    }

    public function sites(Request $request)
    {
        $sites = Site::whereNotNull('image_id');
        if ($request->has('search')) {
            $sites = $sites->where('title', 'like', '%' . $request->search . '%');
        }
        $sites = $sites->paginate(12);
        return view('agency.sites', [
            'sites'=>$sites,
            'title'=>settings('agencies_title'),
            'meta_title'=>settings('agencies_title'). ' - ' . env('APP_NAME'),
            'meta_description'=>settings('agencies_description'),
        ]);
    }

}
