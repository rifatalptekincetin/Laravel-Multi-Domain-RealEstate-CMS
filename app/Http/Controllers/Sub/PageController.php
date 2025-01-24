<?php

namespace App\Http\Controllers\Sub;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Site;

class PageController extends Controller
{
    public function show(Request $request, string $subdomain, string $slug){
        $site = Site::where('subdomain',$subdomain)->firstOrFail();
        $page = Page::where('status','published')->where('site_id',$site->id)->where('slug',$slug)->firstOrFail();
        return view('sub.page.show',[
            'page'=>$page,
            'meta_title'=>$page->meta_title,
            'meta_description'=>$page->meta_description,
        ]);
    }
    
    public function home(Request $request, string $subdomain){
        $site = Site::where('subdomain',$subdomain)->firstOrFail();
        $page = Page::where('status','published')->where('id',$site->home_id)->firstOrFail();
        return view('sub.page.show',[
            'page'=>$page,
            'meta_title'=>$page->meta_title,
            'meta_description'=>$page->meta_description,
        ]);
    }
}
