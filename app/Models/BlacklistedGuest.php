<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlacklistedGuest extends Model
{
    protected $fillable = [
        'guest_id',
        'added_by',
        'reason',
        'notes',
        'blacklisted_until',
        'is_active'
    ];

    protected $casts = [
        'blacklisted_until' => 'date',
        'is_active' => 'boolean'
    ];

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    public function addedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    // Scope for active blacklist entries
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function($q) {
                $q->whereNull('blacklisted_until')
                  ->orWhere('blacklisted_until', '>=', now());
            });
    }
}