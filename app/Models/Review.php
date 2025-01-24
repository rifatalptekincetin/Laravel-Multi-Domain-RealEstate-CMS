<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'content',
        'name',
        'email',
        'reviewable_id',
        'reviewable_type',
        'status'
    ];

    public function reviewable()
    {
        return $this->morphTo();
    }
    
}
