<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    protected $fillable = ['id','title','status','content','meta_title','meta_description','slug'];

    use HasFactory,SoftDeletes;
    
    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class,'state_id');
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class,'state_id');
    }

    public function districts(): HasManyThrough
    {
        return $this->hasManyThrough(
            District::class,
            City::class,
            'state_id',
            'city_id',
            'id',
            'id'
        );
    }

    public function url($subdomain=Null): string
    {
        if($subdomain) return route('sub.listing.state',[$subdomain,$this->slug]);
        return route('listing.state',$this->slug);
    }

    public function getMetaTitleAttribute($value): string
    {
        return $value ?? $this->title . ' - ' . env('APP_NAME');
    }

}
