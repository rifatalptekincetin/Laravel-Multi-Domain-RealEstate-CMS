<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ListingOption extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['title','helper','status','type','answers','order','show_in_filters'];

    protected $casts = ['answers' => 'array','show_in_filters' => 'boolean'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(ListingCategory::class, 'listing_option_listing_category', 'listing_option_id', 'listing_category_id');
    }

    public function metas(): HasMany
    {
        return $this->hasMany(ListingMeta::class,'listing_option_id');
    }

}
