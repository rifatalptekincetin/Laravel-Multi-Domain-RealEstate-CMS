<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\Models\Post;

class BlogController extends Controller
{
    public function index(){
        $blogs = Post::where('status','published')->paginate(6);
        return view('blog.index',[
            "blogs"=>$blogs,
            "meta_title" => settings('blogs_title') . " - " . env('APP_NAME'),
            "meta_description" => settings('blogs_description') . " - " . env('APP_NAME'),
            "futured_image" => get_image_url(settings("blogs_image"),"medium_url"),
        ]);
    }

    public function show($slug){
        $blog = Post::where('status','published')
        ->where('slug',$slug)->firstOrFail();
        return view('blog.show',[
            "blog"=>$blog,
            "meta_title" => $blog->meta_title,
            "meta_description" => $blog->meta_description,
            "futured_image" => get_image_url($blog->image_id,"medium_url"),
        ]);
    }

    public function showCategory($slug){
        $category = PostCategory::where('status','published')
        ->where('slug',$slug)->firstOrFail();
        $blogs = Post::where('status','published')
        ->whereHas('categories', function($q) use ($slug){
            $q->where('slug', $slug);
        })->paginate(12);
        return view('blog.show-category',[
            "blogs"=>$blogs,
            "category"=>$category,
            "meta_title" => $category->meta_title,
            "meta_description" => $category->meta_description,
            "futured_image" => get_image_url($category->image_id,"medium_url"),
        ]);
    }

    public function showTag($slug){
        $tag = PostTag::where('status','published')
        ->where('slug',$slug)->firstOrFail();
        $blogs = Post::where('status','published')
        ->whereHas('tags', function($q) use ($slug){
            $q->where('slug', $slug);
        })->paginate(12);
        return view('blog.show-tag',[
            "blogs"=>$blogs,
            "tag"=>$tag,
            "meta_title" => $tag->meta_title,
            "meta_description" => $tag->meta_description,
            "futured_image" => Null,
        ]);
    }

}
