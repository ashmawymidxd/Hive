<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Guest;
use App\Models\BlacklistedGuest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlacklistedGuestController extends Controller
{

  public function store(Request $request)
    {
         $admin = Auth::guard('admin')->user();
        // Validate the request data
        $validated = $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'reason' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'blacklisted_until' => 'nullable|date',
            'is_active' => 'boolean'
        ]);

        BlacklistedGuest::create([
            'guest_id' => $validated['guest_id'],
            'added_by' => $admin->id,
            'reason' => $validated['reason'],
            'notes' => $validated['notes'],
            'blacklisted_until' => $validated['blacklisted_until'],
            'is_active' => $validated['is_active'] ?? true
        ]);

        return redirect()->back()
            ->with('success', 'Guest added to blacklist successfully');
    }

    public function updateStatus(Request $request, BlacklistedGuest $blacklistedGuest)
    {

        // dd($blacklistedGuest);
        $admin = Auth::guard('admin')->user();
        // Validate the request data
        $validated = $request->validate([
            'is_active' => 'required|boolean',
        ]);
        // Update the blacklist status
        $blacklistedGuest->update([
            'is_active' => $validated['is_active'],
        ]);
        // Log the action (optional)

        return back()->with('success', 'Blacklist status updated');
    }
}