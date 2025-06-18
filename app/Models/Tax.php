<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    protected $fillable = [
        'tax_id',
        'description',
        'type',
        'amount',
        'date',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
    ];


}
