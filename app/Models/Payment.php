<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_number',
        'invoice_id',
        'guest_id',
        'amount',
        'payment_date',
        'payment_method',
        'status',
        'notes'
    ];

    protected $casts = [
        'payment_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }


}
