<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeasonalRatePeriod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'rate_adjustment_type',
        'rate_adjustment_value',
        'is_active',
    ];

     protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}
