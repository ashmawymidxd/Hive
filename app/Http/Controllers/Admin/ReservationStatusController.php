<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Notifications\CheckInNotification;
use App\Notifications\CheckOutNotification;
use App\Notifications\ReservationStatusNotification;
use App\Models\Invoice;
use App\Notifications\InvoiceNotification;
use Illuminate\Support\Facades\Notification;

class ReservationStatusController extends Controller
{
    public function checkIn(Reservation $reservation)
    {
        if ($reservation->status !== 'confirmed') {
            return redirect()->back()
                ->with('error', 'Only confirmed reservations can be checked in.');
        }

        $reservation->checkIn();

        // Notify current authenticated admin
        $admin = auth('admin')->user();
        $admin->notify(new CheckInNotification($reservation));

        // Notify guest
        $reservation->guest->notify(new ReservationStatusNotification($reservation, 'checked in'));

        return redirect()->back()
            ->with('success', 'Guest checked in successfully.');
    }

    public function checkOut(Request $request, Reservation $reservation)
    {
        $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'room_id' => 'required|exists:rooms,id',
            'amount' => 'required|numeric|min:0',
            'issue_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:issue_date',
        ]);

        $invoice = Invoice::create([
            'invoice_number' => 'INV-' . date('Y') . '-' . str_pad(Invoice::count() + 1, 3, '0', STR_PAD_LEFT),
            'guest_id' => $request->guest_id,
            'room_id' => $request->room_id,
            'amount' => $request->amount,
            'issue_date' => $request->issue_date,
            'due_date' => $request->due_date,
            'status' => 'pending',
        ]);

        if (!$reservation->isCheckedIn()) {
            return redirect()->back()
                ->with('error', 'Only checked-in reservations can be checked out.');
        }

        $reservation->checkOut();

        // Notify current authenticated admin
        $admin = auth('admin')->user();
        $admin->notify(new CheckOutNotification($reservation));

        // Notify current authenticated admin
        Notification::send($admin, new InvoiceNotification($invoice, 'created'));

        // Notify the guest (email only)
        $invoice->guest->notify(new InvoiceNotification($invoice, 'created', true));

        // Notify guest
        $reservation->guest->notify(new ReservationStatusNotification($reservation, 'checked out'));

        return redirect()->back()
            ->with('success', 'Guest checked out successfully and invoice created.');
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
