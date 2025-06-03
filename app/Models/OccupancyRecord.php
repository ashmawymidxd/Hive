<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OccupancyRecord extends Model
{
    protected $fillable = [
        'record_date',
        'occupancy_rate',
        'occupied_rooms',
        'total_rooms'
    ];
    
    protected $casts = [
        'record_date' => 'date'
    ];
}