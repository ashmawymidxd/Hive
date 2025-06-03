<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GuestFeedback extends Model
{
    use HasFactory;
    protected $fillable = [
        'guest_id',
        'reservation_id',
        'type',
        'category',
        'message',
        'status',
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
    ];

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }
}