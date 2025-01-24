<?php
if (!function_exists('get_image')) {
    function get_image($id){
        $image = \Awcodes\Curator\Models\Media::where('id',$id)->first();
        return $image;
    }
}

if (!function_exists('get_image_url')) {
    function get_image_url($id,$size=Null){
        $image = get_image($id);
        if($image){
            if($size) return $image[$size];
            return asset('storage/'.$image->path);
        }
        return "";
    }
}

if (!function_exists('get_listings')) {
    function get_listings($count,$subsite=Null){
        $listings = \App\Models\Listing::where('status','published')->orderByDesc('id')->limit($count);
        if($subsite){
            $listings = $listings->where('site_id',get_subsite()->id);
        }
        return $listings->get();
    }
}

if (!function_exists('get_categories')) {
    function get_categories($ids){
        $listing_categories = \App\Models\ListingCategory::where('status','published')->whereIn('id',$ids)->get();
        return $listing_categories;
    }
}

if (!function_exists('get_posts')) {
    function get_posts($count,$is_subdomain=Null){
        if($is_subdomain){
            $listings = \App\Models\Post::where('site_id',get_subsite()->id)->where('status','published')->orderByDesc('id')->limit($count)->get();
            return $listings;
        }
        $listings = \App\Models\Post::where('status','published')->orderByDesc('id')->limit($count)->get();
        return $listings;
    }
}

if (!function_exists('get_agents')) {
    function get_agents($ids){
        $agents = \App\Models\User::whereIn('id',$ids)->get();
        return $agents;
    }
}

if (!function_exists('get_agencies')) {
    function get_agencies($ids){
        $agencies = \App\Models\Site::whereIn('id',$ids)->get();
        return $agencies;
    }
}

if (!function_exists('get_post_categories')) {
    function get_post_categories($count=999){
        $listings = \App\Models\PostCategory::where('status','published')->orderByDesc('id')->limit($count)->get();
        return $listings;
    }
}

if (!function_exists('get_post_tags')) {
    function get_post_tags($count=999){
        $listings = \App\Models\PostTag::where('status','published')->orderByDesc('id')->limit($count)->get();
        return $listings;
    }
}

if (!function_exists('settings')) {
    function settings($key=Null){
        if($key) return app(App\Settings\GeneralSettings::class)->$key;
        return app(App\Settings\GeneralSettings::class);
    }
}

if (!function_exists('current_url')){
    function current_url(){
        return 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }
}

if(!function_exists('yt_vid_id')){
    function yt_vid_id($url){
        $video_id = explode("?v=", $url);
        if (empty($video_id[1])) $video_id = explode("/v/", $url);
        $video_id = explode("&", $video_id[1]);
        return $video_id[0];
    }
}

if(!function_exists('get_subdomain')){
    function get_subdomain(){
        return \Illuminate\Support\Facades\Route::getCurrentRoute()->subdomain;
    }
}

if(!function_exists('get_subsite')){
    function get_subsite(){
        return \App\Models\Site::where('subdomain',\Illuminate\Support\Facades\Route::getCurrentRoute()->subdomain)
        ->first();
    }
}

if(!function_exists('slugify')){
    function slugify($s){
        return \Illuminate\Support\Str::slug($s);
    }
}