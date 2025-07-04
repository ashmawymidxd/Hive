<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
    ];

    protected $casts = [
        'value' => 'array', // Assuming value is stored as JSON
    ];

    
}
