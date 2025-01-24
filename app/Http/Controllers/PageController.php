<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function show(Request $request, string $slug){
        $page = Page::where('status','published')->whereNull('site_id')->where('slug',$slug)->firstOrFail();
        return view('page.show',[
            'page'=>$page,
            'meta_title'=>$page->meta_title,
            'meta_description'=>$page->meta_description,
        ]);
    }
    
    public function home(Request $request){
        $page = Page::where('status','published')->whereNull('site_id')->where('slug','home')->firstOrFail();
        return view('page.show',[
            'page'=>$page,
            'meta_title'=>$page->meta_title,
            'meta_description'=>$page->meta_description,
        ]);
    }

    public function talep(){
        return view('page.talep');
    }
}
