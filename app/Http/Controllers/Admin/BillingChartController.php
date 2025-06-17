<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

class BillingChartController extends Controller
{
    public function getDailyComparison(Request $request)
    {
        $daysInMonth = Carbon::now()->daysInMonth;
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        // Initialize arrays with 0 values for each day
        $revenueData = array_fill(1, $daysInMonth, 0);
        $expensesData = array_fill(1, $daysInMonth, 0);

        // Get daily revenue
        $revenue = Payment::whereYear('payment_date', $currentYear)
            ->whereMonth('payment_date', $currentMonth)
            ->where('status', 'completed')
            ->selectRaw('DAY(payment_date) as day, SUM(amount) as total')
            ->groupBy('day')
            ->get();

        // Populate revenue data
        foreach ($revenue as $item) {
            $revenueData[$item->day] = (float)$item->total;
        }

        // Get daily expenses
        $expenses = Expense::whereYear('date', $currentYear)
            ->whereMonth('date', $currentMonth)
            ->selectRaw('DAY(date) as day, SUM(amount) as total')
            ->groupBy('day')
            ->get();

        // Populate expenses data
        foreach ($expenses as $item) {
            $expensesData[$item->day] = (float)$item->total;
        }

        return response()->json([
            'revenue' => array_values($revenueData),
            'expenses' => array_values($expensesData),
            'days' => range(1, $daysInMonth)
        ]);
    }

    public function getWeeklyComparison(Request $request)
    {
        $weeks = [];
        $revenueData = [];
        $expensesData = [];

        // Get the current date and calculate the start of the current week
        $now = Carbon::now();
        $currentWeekStart = $now->copy()->startOfWeek();

        // Get data for the last 4 weeks
        for ($i = 3; $i >= 0; $i--) {
            $weekStart = $currentWeekStart->copy()->subWeeks($i);
            $weekEnd = $weekStart->copy()->endOfWeek();

            // Label for the week (e.g., "May 1 - May 7")
            $weeks[] = $weekStart->format('M j') . ' - ' . $weekEnd->format('M j');

            // Get revenue for the week
            $revenue = Payment::whereBetween('payment_date', [
                $weekStart->format('Y-m-d'),
                $weekEnd->format('Y-m-d')
            ])
                ->where('status', 'completed')
                ->sum('amount');

            $revenueData[] = (float)$revenue;

            // Get expenses for the week
            $expenses = Expense::whereBetween('date', [
                $weekStart->format('Y-m-d'),
                $weekEnd->format('Y-m-d')
            ])
                ->sum('amount');

            $expensesData[] = (float)$expenses;
        }

        return response()->json([
            'revenue' => $revenueData,
            'expenses' => $expensesData,
            'weeks' => $weeks,
            'time_period' => 'Last 4 Weeks (' . $currentWeekStart->subWeeks(3)->format('M j') . ' - ' . $now->format('M j') . ')'
        ]);
    }

    public function getMonthlyComparison(Request $request)
    {
        $selectedYear = $request->input('year') ?: Carbon::now()->year;
        $months = [];
        $revenueData = [];
        $expensesData = [];

        // Get data for each month of the selected year
        for ($month = 1; $month <= 12; $month++) {
            $monthName = Carbon::create()->month($month)->format('M');
            $months[] = $monthName;

            // Get revenue for the month
            $revenue = Payment::whereYear('payment_date', $selectedYear)
                ->whereMonth('payment_date', $month)
                ->where('status', 'completed')
                ->sum('amount');

            $revenueData[] = (float)$revenue;

            // Get expenses for the month
            $expenses = Expense::whereYear('date', $selectedYear)
                ->whereMonth('date', $month)
                ->sum('amount');

            $expensesData[] = (float)$expenses;
        }

        return response()->json([
            'revenue' => $revenueData,
            'expenses' => $expensesData,
            'months' => $months,
            'year' => $selectedYear
        ]);
    }

     public function generateReport(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);
        
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        
        // Get revenue data
        $totalRevenue = Payment::whereBetween('payment_date', [$startDate, $endDate])
            ->where('status', 'completed')
            ->sum('amount');
        
        // Get expenses data
        $totalExpenses = Expense::whereBetween('date', [$startDate, $endDate])
            ->sum('amount');
        
        // Calculate net profit
        $netProfit = $totalRevenue - $totalExpenses;
        
        return response()->json([
            'status' => 'success',
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_revenue' => $totalRevenue,
            'total_expenses' => $totalExpenses,
            'net_profit' => $netProfit,
            // You could add more detailed data here
        ]);
    }
    
    public function exportReport(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'type' => 'required|in:pdf,csv'
        ]);
        
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $type = $request->type;
        
        // Get report data (same as generateReport)
        $totalRevenue = Payment::whereBetween('payment_date', [$startDate, $endDate])
            ->where('status', 'completed')
            ->sum('amount');
        
        $totalExpenses = Expense::whereBetween('date', [$startDate, $endDate])
            ->sum('amount');
        
        $netProfit = $totalRevenue - $totalExpenses;
        
        if ($type === 'pdf') {
            $data = [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'total_revenue' => $totalRevenue,
                'total_expenses' => $totalExpenses,
                'net_profit' => $netProfit,
                // Add more data as needed
            ];
            
            $pdf = PDF::loadView('admin.pages.billing.reports.pdf', $data);
            return $pdf->download("financial_report_{$startDate}_to_{$endDate}.pdf");
        }
        
        // For CSV export
        if ($type === 'csv') {
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => "attachment; filename=financial_report_{$startDate}_to_{$endDate}.csv",
            ];
            
            $callback = function() use ($startDate, $endDate, $totalRevenue, $totalExpenses, $netProfit) {
                $file = fopen('php://output', 'w');
                
                // CSV headers
                fputcsv($file, ['Financial Report', $startDate, 'to', $endDate]);
                fputcsv($file, []);
                fputcsv($file, ['Metric', 'Amount']);
                fputcsv($file, ['Total Revenue', $totalRevenue]);
                fputcsv($file, ['Total Expenses', $totalExpenses]);
                fputcsv($file, ['Net Profit', $netProfit]);
                
                fclose($file);
            };
            
            return response()->stream($callback, 200, $headers);
        }
    }
}
