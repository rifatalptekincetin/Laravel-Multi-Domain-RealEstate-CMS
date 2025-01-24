<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Awcodes\Curator\Models\Media;

class Post extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['title','slug','status','content','meta_title','meta_description','image_id'];

    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_id', 'id')->withDefault([
            'ext' => "png",
            'path' => "",
        ]);
    }

    public function url($subdomain=Null): string
    {
        if($subdomain) return route('sub.blog.show',[$subdomain, $this->slug]);
        return route('blog.show',$this->slug);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(PostCategory::class, 'post_post_category', 'post_id', 'post_category_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(PostTag::class, 'post_post_tag', 'post_id', 'post_tag_id');
    }

    public function next(){
        return Post::where('id', '>', $this->id)->where('status','published')->orderBy('id','asc')->first();
    
    }
    public  function previous(){
        return Post::where('id', '<', $this->id)->where('status','published')->orderBy('id','desc')->first();
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class, 'site_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getMetaTitleAttribute($value): string
    {
        return $value ?? $this->title . ' - ' . env('APP_NAME');
    }
}
