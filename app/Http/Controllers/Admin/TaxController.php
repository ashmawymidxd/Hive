<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index()
    {
        $taxes = Tax::orderBy('date', 'desc')->get();
        return view('admin.pages.billing.index', compact('taxes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'status' => 'required|in:Filed,Pending,Paid,Overdue',
        ]);

        // Generate tax ID
        $year = date('Y');
        $latestTax = Tax::where('tax_id', 'like', "TAX-{$year}-%")->latest()->first();
        $sequence = $latestTax ? (int) substr($latestTax->tax_id, -3) + 1 : 1;
        $taxId = sprintf("TAX-%s-%03d", $year, $sequence);

        Tax::create([
            'tax_id' => $taxId,
            'description' => $request->description,
            'type' => $request->type,
            'amount' => $request->amount,
            'date' => $request->date,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.invoices.index')->with('success', 'Tax record created successfully.');
    }

    public function show(Tax $tax)
    {
        return response()->json($tax);
    }

    public function update(Request $request, Tax $tax)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'status' => 'required|in:Filed,Pending,Paid,Overdue',
        ]);

        $tax->update($request->all());
        return redirect()->route('admin.invoices.index')->with('success', 'Tax record updated successfully.');
    }

    public function destroy(Tax $tax)
    {
        $tax->delete();
        return redirect()->route('admin.invoices.index')->with('success', 'Tax record deleted successfully.');
    }
}