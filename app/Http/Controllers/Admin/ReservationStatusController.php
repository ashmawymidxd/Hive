<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Notifications\CheckInNotification;
use App\Notifications\CheckOutNotification;
use App\Notifications\ReservationStatusNotification;

class ReservationStatusController extends Controller
{
    public function checkIn(Reservation $reservation)
    {
        if ($reservation->status !== 'confirmed') {
            return redirect()->back()
                ->with('error', 'Only confirmed reservations can be checked in.');
        }

        $reservation->checkIn();

        // Notify admin
        $admins = Admin::get();
        foreach ($admins as $admin) {
            $admin->notify(new CheckInNotification($reservation));
        }

        // Notify guest
        $reservation->guest->notify(new ReservationStatusNotification($reservation, 'checked in'));

        return redirect()->back()
            ->with('success', 'Guest checked in successfully.');
    }

    public function checkOut(Reservation $reservation)
    {
        if (!$reservation->isCheckedIn()) {
            return redirect()->back()
                ->with('error', 'Only checked-in reservations can be checked out.');
        }

        $reservation->checkOut();

        // Notify admin
        $admins = Admin::get();
        foreach ($admins as $admin) {
            $admin->notify(new CheckOutNotification($reservation));
        }
        
        // Notify guest
        $reservation->guest->notify(new ReservationStatusNotification($reservation, 'checked out'));

        return redirect()->back()
            ->with('success', 'Guest checked out successfully.');
    }

    public function markAsNoShow(Reservation $reservation)
    {
        if ($reservation->status !== 'confirmed') {
            return redirect()->back()
                ->with('error', 'Only confirmed reservations can be marked as no-show.');
        }

        $reservation->update(['status' => 'no_show']);
        $reservation->room()->update(['status' => 'available']);

        return redirect()->back()
            ->with('success', 'Reservation marked as no-show.');
    }
}
