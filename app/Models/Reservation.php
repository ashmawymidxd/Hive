<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Reservation extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'guest_id',
        'room_id',
        'check_in',
        'check_out',
        'status',
        'amount',
        'special_requests'
    ];

    protected $dates = [
        'check_in',
        'check_out',
        'actual_check_in',
        'actual_check_out',
        'created_at',
        'updated_at'
    ];

    // Or for Laravel 8+
    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
        'actual_check_in' => 'datetime',
        'actual_check_out' => 'datetime',
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function checkIn()
    {
        $this->update([
            'status' => 'checked_in',
            'actual_check_in' => now()
        ]);

        $this->room->update(['status' => 'occupied']);
    }

    public function checkOut()
    {
        $this->update([
            'status' => 'checked_out',
            'actual_check_out' => now()
        ]);

        $this->room->update(['status' => 'available']);
    }

    public function isCheckedIn()
    {
        return $this->status === 'checked_in';
    }

    public function isCheckedOut()
    {
        return $this->status === 'checked_out';
    }
}
