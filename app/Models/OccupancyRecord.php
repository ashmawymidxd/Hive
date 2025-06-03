<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class OccupancyRecord extends Model
{
    use HasFactory;
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