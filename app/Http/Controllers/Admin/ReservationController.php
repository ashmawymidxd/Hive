<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Reservation;
use App\Models\Guest;
use App\Models\Room;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Notifications\ReservationCreatedNotification;
class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['guest', 'room'])->latest()->get();
        return view('admin.pages.reservations.index', compact('reservations'));
    }

    public function create()
    {
        $guests = Guest::all();
        $rooms = Room::where('status', 'available')->get();
        return view('admin.pages.reservations.create', compact('guests', 'rooms'));
    }

   public function store(Request $request)
    {
        $validated = $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'status' => 'required|in:confirmed,pending,cancelled,completed',
            'amount' => 'required|numeric|min:0',
            'special_requests' => 'nullable|string'
        ]);

        // Get the room
        $room = Room::findOrFail($request->room_id);

        // Check if room is available
        if ($room->status !== 'available') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'This room is not available for reservation.');
        }

        // Check for overlapping reservations
        $overlappingReservation = Reservation::where('room_id', $request->room_id)
            ->where('status', '!=', 'cancelled')
            ->where(function($query) use ($request) {
                $query->whereBetween('check_in', [$request->check_in, $request->check_out])
                    ->orWhereBetween('check_out', [$request->check_in, $request->check_out])
                    ->orWhere(function($q) use ($request) {
                        $q->where('check_in', '<', $request->check_in)
                        ->where('check_out', '>', $request->check_out);
                    });
            })
            ->exists();

        if ($overlappingReservation) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'This room is already reserved for the selected dates.');
        }

        // Create the reservation
        $reservation = Reservation::create($validated);

        // Update room status if reservation is confirmed
        if ($request->status === 'confirmed') {
            $room->update(['status' => 'occupied']);
        }

        // Notify current authenticated admin about the new reservation
        $reservation->load('guest', 'room'); // Load related models for notification
        $admin = auth('admin')->user();
        $admin->notify(new ReservationCreatedNotification($reservation));

        // Notify guest
        $reservation->guest->notify(new ReservationCreatedNotification($reservation));


        // Redirect back with success message
        return redirect()->route('admin.reservations.index')
            ->with('success', 'Reservation created successfully.');
    }

    public function show(Reservation $reservation)
    {
        return view('admin.pages.reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $guests = Guest::all();
        $rooms = Room::all();
        return view('admin.pages.reservations.edit', compact('reservation', 'guests', 'rooms'));
    }

   public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'status' => 'required|in:confirmed,pending,cancelled,completed',
            'amount' => 'required|numeric|min:0',
            'special_requests' => 'nullable|string'
        ]);

        // Get the room
        $room = Room::findOrFail($request->room_id);

        // Check for overlapping reservations (excluding current reservation)
        $overlappingReservation = Reservation::where('room_id', $request->room_id)
            ->where('id', '!=', $reservation->id)
            ->where('status', '!=', 'cancelled')
            ->where(function($query) use ($request) {
                $query->whereBetween('check_in', [$request->check_in, $request->check_out])
                    ->orWhereBetween('check_out', [$request->check_in, $request->check_out])
                    ->orWhere(function($q) use ($request) {
                        $q->where('check_in', '<', $request->check_in)
                        ->where('check_out', '>', $request->check_out);
                    });
            })
            ->exists();

        if ($overlappingReservation) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'This room is already reserved for the selected dates.');
        }

        // Update the reservation
        $reservation->update($validated);

        // Handle room status changes
        if ($reservation->wasChanged('room_id') || $reservation->wasChanged('status')) {
            // Free up the previous room if it was changed
            if ($reservation->wasChanged('room_id')) {
                Room::where('id', $reservation->getOriginal('room_id'))
                    ->update(['status' => 'available']);
            }

            // Update new room status
            if ($request->status === 'confirmed') {
                $room->update(['status' => 'occupied']);
            } elseif ($reservation->wasChanged('room_id')) {
                $room->update(['status' => 'available']);
            }
        }

        return redirect()->route('admin.reservations.index')
            ->with('success', 'Reservation updated successfully.');
    }

    public function destroy(Reservation $reservation)
    {
        // Free up the room if reservation was confirmed
        if ($reservation->status === 'confirmed') {
            Room::where('id', $reservation->room_id)->update(['status' => 'available']);
        }

        $reservation->delete();

        return redirect()->route('admin.reservations.index')
            ->with('success', 'Reservation deleted successfully.');
    }
}
