<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'buyer_user_id',
        'seller_user_id',
        'property',
        'address',
        'description',
        'seller_name',
        'seller_email',
        'seller_phone',
        'buyer_name',
        'buyer_email',
        'buyer_phone',
        'price',
        'service_fee',
        'royalty_fee',
        'attachments',
        'selling_date'
    ];

    protected $casts = [
        'attachments' => 'array',
        'selling_date' => 'date'
    ];

    public function buyer_user(): BelongsTo
    {
        return $this->belongsTo(User::class,'buyer_user_id','id');
    }

    public function seller_user(): BelongsTo
    {
        return $this->belongsTo(User::class,'seller_user_id','id');
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class, 'site_id');
    }
}
