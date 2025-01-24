<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Awcodes\Curator\Models\Media;

class Site extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'title','subdomain','status','user_id','meta_description','image_id',
        'home_id','menu','footer','logo_id',
        'about','email','phone','whatsapp','telegram','facebook','instagram',
        'twitter','tiktok','linkedin','youtube','pinterest','address',
        'state_id','city_id','district_id',
    ];

    protected $casts = [
        'menu' => 'array',
        'footer' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class,'site_id');
    }

    public function reviews(): HasManyThrough
    {
        return $this->hasManyThrough(Review::class,User::class,'site_id','reviewable_id','id','id')->where('reviewable_type','App\Models\User');
    }

    public function pages(): HasMany
    {
        return $this->hasMany(Page::class,'site_id');
    }

    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class,'site_id');
    }
    
    public function logo(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'logo_id', 'id')->withDefault([
            'ext' => "png",
            'path' => "",
        ]);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_id', 'id')->withDefault([
            'ext' => "png",
            'path' => "",
        ]);
    }

    public function home(): BelongsTo
    {
        return $this->belongsTo(Page::class,'home_id','id');
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class,'state_id','id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class,'city_id','id');
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class,'district_id','id');
    }

    public function url(){
        return route('sub.home',$this->subdomain);
    }
}
