<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Payment;
use App\Models\Guest;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['guest', 'invoice'])
            ->orderBy('payment_date', 'desc')
            ->paginate(10);

        return view('admin.pages.billing.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        return view('admin.pages.billing.showPayment', compact('payment'));
    }


    public function create()
    {
        $guests = Guest::all();
        $invoices = Invoice::where('status', '!=', 'paid')->get();
        return view('admin.pages.billing.create', compact('guests', 'invoices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'guest_id' => 'required|exists:guests,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string|max:255',
            'status' => 'required|in:completed,pending,failed',
            'notes' => 'nullable|string'
        ]);

        $payment = Payment::create([
            'payment_number' => 'PAY-' . now()->format('Y') . '-' . Str::upper(Str::random(6)),
            'invoice_id' => $request->invoice_id,
            'guest_id' => $request->guest_id,
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'payment_method' => $request->payment_method,
            'status' => $request->status,
            'notes' => $request->notes
        ]);

        // Update invoice status if payment is completed
        if ($payment->status === 'completed') {
            $invoice = Invoice::find($request->invoice_id);
            $invoice->update(['status' => 'paid']);
        }


        // In your PaymentController after successful payment creation
        if ($payment->status === 'completed') {
            // Get today's successful payments count (more accurate query)
            $todayPaymentsCount = Payment::whereDate('created_at', today())
                ->where('status', 'completed')
                ->count();

            $adminPhone = '201552389395'; // Egyptian number with country code (20), remove the 0
            $formattedAmount = number_format($payment->amount, 2); // Properly formatted amount

            $message = "💰 *New Payment Received* 💰\n" .
                "➤ *Payment #*: {$payment->payment_number}\n" .
                "➤ *Amount*: {$formattedAmount} EGP\n" .
                "➤ *Guest*: {$payment->guest->getFullName()}\n" .
                "➤ *Date*: {$payment->payment_date->format('M d, Y H:i')}\n" .
                "➤ *Today's Total*: {$todayPaymentsCount} payments";

            $whatsappUrl = "https://wa.me/{$adminPhone}?text=" . urlencode($message);

            try {
                // Attempt to open the WhatsApp link
                $response = file_get_contents($whatsappUrl);

                // Log the attempt (for debugging)
                Log::info("WhatsApp notification sent for payment {$payment->id}", [
                    'url' => $whatsappUrl,
                    'response' => $response
                ]);
            } catch (\Exception $e) {
                Log::error("Failed to send WhatsApp notification: " . $e->getMessage());
            }
        }

        return redirect()->route('admin.invoices.index')->with('success', 'Payment created successfully!');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('admin.invoices.index')->with('success', 'Payment deleted successfully!');
    }
}
