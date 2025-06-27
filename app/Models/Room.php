<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_number',
        'type',
        'floor',
        'status',
        'price',
        'description',
        'capacity'
    ];

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class);
    }

    public function images()
    {
        return $this->hasMany(RoomImage::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeOccupied($query)
    {
        return $query->where('status', 'occupied');
    }

    public function scopeMaintenance($query)
    {
        return $query->where('status', 'maintenance');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
