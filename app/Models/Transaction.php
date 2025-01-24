<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'user_ids',
        'order_info',
        'payment_method',
        'status',
        'price',
        'title',
        'description',
    ];

    protected $casts = [
        'user_ids' => 'array',
        'order_info' => 'array',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function users(){
        if(!$this->user_ids) return [];
        return User::whereIn('id', $this->user_ids)->get();
    }

}
