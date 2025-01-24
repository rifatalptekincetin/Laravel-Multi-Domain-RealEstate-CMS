<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Awcodes\Curator\Models\Media;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Listing extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'location',
        'title',
        'slug',
        'status',
        'content',
        'latitude',
        'longitude',
        'meta_title',
        'meta_description',
        'state_id',
        'city_id',
        'district_id',
        'site_id',
        'user_id',
        'image_id',
        'video_url',
        'price',
        'price_type',
    ];

    protected $appends = [
        'location',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(ListingCategory::class, 'listing_listing_category', 'listing_id', 'listing_category_id');
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class, 'site_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }

    public function metas(): HasMany
    {
        return $this->hasMany(ListingMeta::class,'listing_id');
    }
 
    public function images(): BelongsToMany
    {
        return $this
            ->belongsToMany(Media::class, 'listing_media', 'listing_id', 'media_id')
            ->withPivot('order')
            ->orderBy('order');
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_id', 'id')->withDefault([
            'ext' => "png",
            'path' => "",
        ]);
    }

    /**
    * Returns the 'latitude' and 'longitude' attributes as the computed 'location' attribute,
    * as a standard Google Maps style Point array with 'lat' and 'lng' attributes.
    *
    * Used by the Filament Google Maps package.
    *
    * Requires the 'location' attribute be included in this model's $fillable array.
    *
    * @return array
    */

    public function getLocationAttribute(): array
    {
        return [
            "lat" => (float)$this->latitude,
            "lng" => (float)$this->longitude,
        ];
    }

    /**
    * Takes a Google style Point array of 'lat' and 'lng' values and assigns them to the
    * 'latitude' and 'longitude' attributes on this model.
    *
    * Used by the Filament Google Maps package.
    *
    * Requires the 'location' attribute be included in this model's $fillable array.
    *
    * @param ?array $location
    * @return void
    */
    public function setLocationAttribute(?array $location): void
    {
        if (is_array($location))
        {
            $this->attributes['latitude'] = $location['lat'];
            $this->attributes['longitude'] = $location['lng'];
            unset($this->attributes['location']);
        }
    }

    /**
     * Get the lat and lng attribute/field names used on this table
     *
     * Used by the Filament Google Maps package.
     *
     * @return string[]
     */
    public static function getLatLngAttributes(): array
    {
        return [
            'lat' => 'latitude',
            'lng' => 'longitude',
        ];
    }

   /**
    * Get the name of the computed location attribute
    *
    * Used by the Filament Google Maps package.
    *
    * @return string
    */
    public static function getComputedLocation(): string
    {
        return 'location';
    }

    public function url($subdomain=Null): string
    {
        if($subdomain) return route('sub.listing.show',[$subdomain,$this->slug]);
        return route('listing.show',$this->slug);
    }

    public function getSlugAttribute($slug): string
    {
        if(!$slug) return $this->id;
        return $slug;
    }
    
    public function getMetaTitleAttribute($value): string
    {
        return $value ?? $this->title . ' - ' . env('APP_NAME');
    }

    public function scopeSearch($query, $request)
    {
        if($request->option){
            foreach($request->option as $key=>$value){
                if(!isset($value["min"]) & !isset($value["max"])){
                    $query = $query->whereHas('metas', function($q) use ($key,$value){
                        $q->where('listing_option_id',$key)
                                ->whereJsonContains('meta_value', $value);
                    });
                } else{
                    if(isset($value["min"]) && $value["min"]){
                        $query = $query->whereHas('metas', function($q) use ($key,$value){
                            $q->where('listing_option_id',$key)
                                    ->whereRaw('JSON_EXTRACT(meta_value, "$[0]") >= '.$value["min"]);
                        });
                    }
                    if(isset($value["max"]) && $value["max"]){
                        $query = $query->whereHas('metas', function($q) use ($key,$value){
                            $q->where('listing_option_id',$key)
                                    ->whereRaw('JSON_EXTRACT(meta_value, "$[0]") < '.$value["max"]);
                        });
                    }
                }
            }
        }
        return $query;
    }
}
