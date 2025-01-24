<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use SolutionForest\FilamentTree\Concern\ModelTree;

use Awcodes\Curator\Models\Media;

class ListingCategory extends Model
{
    use HasFactory,SoftDeletes,ModelTree;

    protected $fillable = ['title','slug','status','content','meta_title','meta_description','parent_id','image_id'];

    public function listingOptions(): BelongsToMany
    {
        return $this->belongsToMany(ListingOption::class, 'listing_option_listing_category', 'listing_category_id', 'listing_option_id');
    }

    public function listingOptionsFilter(): BelongsToMany
    {
        return $this->belongsToMany(ListingOption::class, 'listing_option_listing_category', 'listing_category_id', 'listing_option_id')->where('show_in_filters',1);
    }

    public function listingOptionsWithParents()
    {
        $options = $this->listingOptionsFilter;
        if($this->parent){
            $options = $options->merge($this->parent->listingOptionsFilter);
        }
        if($this->parent && $this->parent->parent){
            $options = $options->merge($this->parent->parent->listingOptionsFilter);
        }
        if($this->parent && $this->parent->parent && $this->parent->parent->parent){
            $options = $options->merge($this->parent->parent->parent->listingOptionsFilter);
        }
        return $options;
    }

    public function listings(): BelongsToMany
    {
        return $this->belongsToMany(Listing::class, 'listing_listing_category', 'listing_category_id', 'listing_id');
    }
    
    public function parent(): BelongsTo
    {
        return $this->belongsTo(ListingCategory::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(ListingCategory::class, 'parent_id');
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_id', 'id')->withDefault([
            'ext' => "png",
            'path' => "",
        ]);
    }

    public function url($subdomain=Null): string
    {
        if($subdomain) return route('sub.listing.category',[$subdomain,$this->slug]);
        return route('listing.category',$this->slug);
    }

    public function titleWithParent(): string
    {
        $ret = '';
        foreach($this->parent()->where('status','published')->orderBy('id','asc')->get() as $parent){
            $ret .= $parent->title.' / ';
        }
        return $ret.' '.$this->title;
    }

    public function getMetaTitleAttribute($value): string
    {
        return $value ?? $this->title . ' - ' . env('APP_NAME');
    }

}
