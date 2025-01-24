<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['title','slug','status','content','meta_title','meta_description'];

    public function url($subdomain=Null): string
    {
        if($subdomain) return route('sub.blog.show.tag',[$subdomain, $this->slug]);
        return route('blog.show.tag',$this->slug);
    }

    public function getMetaTitleAttribute($value): string
    {
        return $value ?? $this->title . ' - ' . env('APP_NAME');
    }
}
