<?php

// app/Http/Controllers/Admin/ExpenseController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:expense_categories,id',
            'department_id' => 'required|exists:departments,id',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);

        Expense::create($request->all());

        return redirect()->route('admin.invoices.index')
            ->with('success', 'Expense created successfully.');
    }

    public function show(Expense $expense)
    {
        return view('admin.pages.billing.expenses.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        $categories = ExpenseCategory::all();
        $departments = Department::all();
        return view('admin.pages.billing.expenses.edit', compact('expense', 'categories', 'departments'));
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'category_id' => 'required|exists:expense_categories,id',
            'department_id' => 'required|exists:departments,id',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);

        $expense->update($request->all());

        return redirect()->route('admin.invoices.index')
            ->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('admin.invoices.index')
            ->with('success', 'Expense deleted successfully.');
    }


    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:expense_categories,name',
            'description' => 'nullable|string',
        ]);

        ExpenseCategory::create($request->all());

        return redirect()->back()
            ->with('success', 'Category created successfully.');
    }

    // app/Http/Controllers/Admin/ExpenseController.php

    public function destroyCategory(ExpenseCategory $category)
    {
        try {
            // Check if category has any expenses using the correct column name
            if ($category->expenses()->exists()) {
                return redirect()->back()
                    ->with('error', 'Cannot delete category with associated expenses.');
            }

            $category->delete();

            return redirect()->back()
                ->with('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting category: ' . $e->getMessage());
        }
    }


    public function getChartData(Request $request)
    {
        $expenses = Expense::selectRaw('
                departments.name as department,
                SUM(expenses.amount) as total_amount
            ')
            ->join('departments', 'expenses.department_id', '=', 'departments.id')
            ->groupBy('departments.name')
            ->orderBy('total_amount', 'DESC')
            ->get();

        return response()->json([
            'departments' => $expenses->pluck('department'),
            'amounts' => $expenses->pluck('total_amount')
        ]);
    }
}
