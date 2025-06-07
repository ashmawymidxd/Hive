<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation; // Assuming you have a Reservation model
use App\Http\Resources\ReservationResource;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all reservations, you can add pagination or filtering as needed
        $reservations = ReservationResource::collection(Reservation::all());

        // Return the reservations as a JSON response
        return response()->json($reservations);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        // This method is typically not used in API controllers, as APIs usually don't have forms.
        // You can return a message or an empty response if needed.
        return response()->json(['message' => 'Create method not implemented for API']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'status' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'special_requests' => 'nullable|string|max:1000',
        ]);
        // Create a new reservation using the validated data
        $reservation = Reservation::create($validatedData);
        // Return the created reservation as a JSON response
        return response()->json($reservation, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the reservation by ID
        $reservation = Reservation::findOrFail($id);

        // Return the reservation as a JSON response
        return response()->json($reservation);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // This method is typically not used in API controllers, as APIs usually don't have forms.
        // You can return a message or an empty response if needed.
        return response()->json(['message' => 'Edit method not implemented for API']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the reservation by ID
        $reservation = Reservation::findOrFail($id);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'guest_id' => 'sometimes|required|exists:guests,id',
            'room_id' => 'sometimes|required|exists:rooms,id',
            'check_in_date' => 'sometimes|required|date',
            'check_out_date' => 'sometimes|required|date|after:check_in_date',
            'status' => 'sometimes|required|string|max:255',
            'amount' => 'sometimes|required|numeric',
            'special_requests' => 'nullable|string|max:1000',
        ]);

        // Update the reservation with the validated data
        $reservation->update($validatedData);

        // Return the updated reservation as a JSON response
        return response()->json($reservation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the reservation by ID
        $reservation = Reservation::findOrFail($id);

        // Delete the reservation
        $reservation->delete();

        // Return a success response
        return response()->json(['message' => 'Reservation deleted successfully'], 204);
    }
}
