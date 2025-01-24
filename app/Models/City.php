<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    use HasFactory,SoftDeletes;

    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class,'city_id');
    }

    public function districts(): HasMany
    {
        return $this->hasMany(District::class,'city_id');
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function url($subdomain = Null): string
    {
        if($subdomain) return route('sub.listing.city',[$subdomain,$this->slug]);
        return route('listing.city',[$this->slug]);
    }

    public function getMetaTitleAttribute($value): string
    {
        return $value ?? $this->title . ' - ' . env('APP_NAME');
    }
}
