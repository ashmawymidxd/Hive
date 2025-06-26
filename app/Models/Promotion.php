<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'discount',
        'start_date',
        'end_date',
        'room_types',
        'promo_code',
        'status',
        'description'
    ];

    protected $casts = [
        'room_types' => 'array',
        'start_date' => 'date',
        'end_date' => 'date'
    ];
}
