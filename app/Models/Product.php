<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Awcodes\Curator\Models\Media;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image_id',
        'content',
        'price',
        'status',
        'type',
        'event_time',
        'address',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'event_time' => 'datetime',
    ];

    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_id', 'id')->withDefault([
            'ext' => "png",
            'path' => "",
        ]);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_product', 'product_id', 'user_id');
    }


    public function url(): string
    {
        return route('product.'.$this->type.'.show', $this->slug);
    }
}
