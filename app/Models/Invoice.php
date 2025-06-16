<?php

// app/Models/Invoice.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_number',
        'guest_id',
        'room_id',
        'amount',
        'issue_date',
        'due_date',
        'status',
        'notes'
    ];

    protected $casts = [
        'issue_date' => 'date',
        'due_date' => 'date',
    ];

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
