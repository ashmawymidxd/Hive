<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\GuestFeedback;
use App\Models\BlacklistedGuest;


class GuestController extends Controller
{
    public function index(Request $request)
    {
        $guests = Guest::latest()->get();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json($guests);
        }

        // guest feedbacks

        $feedbacks = GuestFeedback::with('guest')
            ->latest()
            ->get();

        $blacklistedGuests = BlacklistedGuest::with(['guest', 'addedBy'])
            ->latest()
            ->get();

        return view('admin.pages.guests.index', compact('guests', 'feedbacks', 'blacklistedGuests'));
    }

    public function create()
    {
        return view('admin.pages.guests.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:guests',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:50',
            'country' => 'nullable|string|max:50'
        ]);

        Guest::create($validated);

        if ($request->ajax()) {
            return response()->json(['success' => 'Guest added successfully.']);
        }

        return redirect()->route('admin.guests.index')
            ->with('success', 'Guest added successfully.');
    }

    public function show(Guest $guest)
    {
        $guest->load('reservations.room');
        return view('admin.pages.guests.show', compact('guest'));
    }

    public function edit(Guest $guest)
    {
        return view('admin.pages.guests.edit', compact('guest'));
    }

    public function update(Request $request, Guest $guest)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => ['required', 'email', Rule::unique('guests')->ignore($guest->id)],
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:50',
            'country' => 'nullable|string|max:50'
        ]);

        $guest->update($validated);

        return redirect()->route('admin.guests.index')
            ->with('success', 'Guest updated successfully.');
    }

    public function destroy(Guest $guest)
    {
        // Check if guest has reservations
        if ($guest->reservations()->exists()) {
            return redirect()->back()
                ->with('error', 'Cannot delete guest with existing reservations.');
        }

        $guest->delete();

        return redirect()->route('admin.guests.index')
            ->with('success', 'Guest deleted successfully.');
    }
}
