<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\GuestFeedback;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestFeedbackController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:feedback,complaint,suggestion',
            'category' => 'nullable|string',
            'message' => 'required|string|max:2000',
            'rating' => 'nullable|integer|between:1,5',
            'reservation_id' => 'nullable|exists:reservations,id'
        ]);

        $feedback = GuestFeedback::create([
            'guest_id' => Auth::id(),
            'reservation_id' => $validated['reservation_id'],
            'type' => $validated['type'],
            'category' => $validated['category'],
            'message' => $validated['message'],
            'rating' => $validated['rating'],
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }

    public function index()
    {
        $feedbacks = GuestFeedback::with(['guest', 'reservation'])
            ->latest()
            ->get();

        return view('admin.feedbacks.index', compact('feedbacks'));
    }

    public function updateStatus(Request $request, GuestFeedback $feedback)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,acknowledged,resolved,rejected',
            'resolution_notes' => 'nullable|string'
        ]);

        $updates = [
            'status' => $validated['status'],
        ];

        if ($validated['status'] === 'resolved') {
            $updates['resolved_at'] = now();
            $updates['resolved_by'] = Auth::id();
        }

        $feedback->update($updates);

        return redirect()->back()->with('success', 'Feedback status updated');
    }
}
