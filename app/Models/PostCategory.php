<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Awcodes\Curator\Models\Media;

class PostCategory extends Model
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
        if($subdomain) return route('sub.blog.show.category',[$subdomain, $this->slug]);
        return route('blog.show.category',$this->slug);
    }

    public function getMetaTitleAttribute($value): string
    {
        return $value ?? $this->title . ' - ' . env('APP_NAME');
    }
}
