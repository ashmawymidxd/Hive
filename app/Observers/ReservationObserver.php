<?php
namespace App\Observers;

use App\Models\Reservation;
use Carbon\Carbon;

class ReservationObserver
{
    public function creating(Reservation $reservation)
    {
        if ($reservation->status === 'confirmed') {
            $reservation->room->update(['status' => 'occupied']);
        }
    }

    public function updating(Reservation $reservation)
    {
        $originalStatus = $reservation->getOriginal('status');
        $newStatus = $reservation->status;

        // If status changed from confirmed to cancelled
        if ($originalStatus === 'confirmed' && in_array($newStatus, ['cancelled', 'no_show'])) {
            $reservation->room->update(['status' => 'available']);
        }

        // If status changed to confirmed
        if ($newStatus === 'confirmed' && $originalStatus !== 'confirmed') {
            $reservation->room->update(['status' => 'occupied']);
        }
    }

    public function deleting(Reservation $reservation)
    {
        if ($reservation->status === 'confirmed') {
            $reservation->room->update(['status' => 'available']);
        }
    }
}
