<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Guest;
use App\Models\Room;
use Illuminate\Http\Request;
use PDF;
use App\Models\Admin;
use App\Models\Payment;
use App\Notifications\InvoiceNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Department;


class InvoiceController extends Controller
{
    public function index()
    {
        $guests = Guest::all();
        $rooms = Room::all();
        $invoices = Invoice::with(['guest', 'room'])->latest()->get();

        // Get today's date
        $today = now()->format('Y-m-d');
        $yesterday = now()->subDay()->format('Y-m-d');

        // Calculate metrics
        $todayPayments = Payment::whereDate('payment_date', $today)
            ->where('status', 'completed')
            ->sum('amount');

        $yesterdayPayments = Payment::whereDate('payment_date', $yesterday)
            ->where('status', 'completed')
            ->sum('amount');

        $percentageChange = $yesterdayPayments > 0
            ? round(($todayPayments - $yesterdayPayments) / $yesterdayPayments * 100, 1)
            : 100;

        $pendingPayments = Payment::where('status', 'pending')->sum('amount');
        $pendingCount = Payment::where('status', 'pending')->count();

        $recentTransactions = Payment::where('created_at', '>=', now()->subDay())->count();

        $payments = Payment::with(['guest', 'invoice'])->get();

        $expenses = Expense::with(['category', 'department'])->latest()->get();
        $categories = ExpenseCategory::all();
        $departments = Department::all();


        return view(
            'admin.pages.billing.index',
            compact(
                'invoices',
                'guests',
                'rooms',
                'payments',
                'todayPayments',
                'percentageChange',
                'pendingPayments',
                'pendingCount',
                'recentTransactions',
                'expenses',
                'categories',
                'departments'
            )
        );
    }

    public function create()
    {
        $guests = Guest::all();
        $rooms = Room::all();
        return view('admin.pages.billing.create', compact('guests', 'rooms'));
    }

    public function store(Request $request)
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

        // Notify current authenticated admin
        $admin = auth('admin')->user();
        $admin->notify(new InvoiceNotification($invoice, 'created'));

        // Notify the guest (email only)
        $invoice->guest->notify(new InvoiceNotification($invoice, 'created', true));

        return redirect()->route('admin.invoices.index')->with('success', 'Invoice created successfully');
    }

    public function show(Invoice $invoice)
    {
        return view('admin.pages.billing.show', compact('invoice'));
    }

    public function download(Invoice $invoice)
    {
        $pdf = PDF::loadView('admin.pages.billing.pdf', compact('invoice'));
        return $pdf->download('invoice-' . $invoice->invoice_number . '.pdf');
    }

    public function print(Invoice $invoice)
    {
        $pdf = PDF::loadView('admin.pages.billing.pdf', compact('invoice'));
        return $pdf->stream('invoice-' . $invoice->invoice_number . '.pdf');
    }

    public function markAsPaid(Invoice $invoice)
    {
        $invoice->update(['status' => 'paid']);
        return back()->with('success', 'Invoice marked as paid');
    }
}
