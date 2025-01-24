<?php

namespace App\Http\Controllers\Sub;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\Models\Post;
use App\Models\Site;

class BlogController extends Controller
{
    public function index(string $subdomain){
        $site = Site::where('subdomain', $subdomain)->first();
        $blogs = Post::where('site_id',$site->id)->where('status','published')->paginate(6);
        return view('sub.blog.index',[
            "blogs"=>$blogs,
            "meta_title" => settings('blogs_title') . " - " . env('APP_NAME'),
            "meta_description" => settings('blogs_description') . " - " . env('APP_NAME'),
            "futured_image" => get_image_url(settings("blogs_image"),"medium_url"),
        ]);
    }

    public function show(string $subdomain, $slug){
        $site = Site::where('subdomain', $subdomain)->first();
        $blog = Post::where('site_id',$site->id)->where('status','published')
        ->where('slug',$slug)->firstOrFail();
        return view('sub.blog.show',[
            "blog"=>$blog,
            "meta_title" => $blog->meta_title,
            "meta_description" => $blog->meta_description,
            "futured_image" => get_image_url($blog->image_id,"medium_url"),
        ]);
    }

    public function showCategory(string $subdomain, $slug){
        $site = Site::where('subdomain', $subdomain)->first();
        $category = PostCategory::where('status','published')
        ->where('slug',$slug)->firstOrFail();
        $blogs = Post::where('site_id',$site->id)->where('status','published')
        ->whereHas('categories', function($q) use ($slug){
            $q->where('slug', $slug);
        })->paginate(12);
        return view('sub.blog.show-category',[
            "blogs"=>$blogs,
            "category"=>$category,
            "meta_title" => $category->meta_title,
            "meta_description" => $category->meta_description,
            "futured_image" => get_image_url($category->image_id,"medium_url"),
        ]);
    }

    public function showTag(string $subdomain, $slug){
        $site = Site::where('subdomain', $subdomain)->first();
        $tag = PostTag::where('status','published')
        ->where('slug',$slug)->firstOrFail();
        $blogs = Post::where('site_id',$site->id)->where('status','published')
        ->whereHas('tags', function($q) use ($slug){
            $q->where('slug', $slug);
        })->paginate(12);
        return view('sub.blog.show-tag',[
            "blogs"=>$blogs,
            "tag"=>$tag,
            "meta_title" => $tag->meta_title,
            "meta_description" => $tag->meta_description,
            "futured_image" => Null,
        ]);
    }

}
