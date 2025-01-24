<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListingMeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'listing_id',
        'listing_option_id',
        'meta_value',
    ];

    protected $casts = [
        'meta_value' => 'array',
    ];

    public function option(): BelongsTo
    {
        return $this->belongsTo(ListingOption::class, 'listing_option_id', 'id');
    }

    public function getMetaTitleAttribute($value): string
    {
        return $value ?? $this->title . ' - ' . env('APP_NAME');
    }
}
