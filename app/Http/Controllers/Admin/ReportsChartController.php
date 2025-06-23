<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OccupancyRecord;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Expense;
use Carbon\Carbon;
use App\Models\Guest;

class ReportsChartController extends Controller
{
    public function monthlyOccupancyData(Request $request)
    {
        // Get current year or year from request
        $year = $request->input('year', date('Y'));

        // Get monthly occupancy data
        $monthlyData = OccupancyRecord::selectRaw('
                MONTH(record_date) as month,
                AVG(occupancy_rate) as avg_occupancy
            ')
            ->whereYear('record_date', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Initialize array with all months at 0
        $allMonths = array_fill(1, 12, 0);

        // Fill with actual data
        foreach ($monthlyData as $data) {
            $allMonths[$data->month] = round($data->avg_occupancy, 2);
        }

        return response()->json([
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'data' => array_values($allMonths),
            'year' => $year
        ]);
    }


    public function dailyOccupancyData(Request $request)
    {
        // Get parameters from request (default to current week)
        $weekStart = $request->input('start_date', now()->startOfWeek()->format('Y-m-d'));
        $weekEnd = $request->input('end_date', now()->endOfWeek()->format('Y-m-d'));

        // Get daily occupancy data
        $dailyData = OccupancyRecord::selectRaw('
                DAYNAME(record_date) as day_name,
                DAYOFWEEK(record_date) as day_of_week,
                AVG(occupancy_rate) as avg_occupancy
            ')
            ->whereBetween('record_date', [$weekStart, $weekEnd])
            ->groupBy('day_name', 'day_of_week')
            ->orderBy('day_of_week')
            ->get();

        // Initialize array with all days at 0
        $allDays = [
            'Monday' => 0,
            'Tuesday' => 0,
            'Wednesday' => 0,
            'Thursday' => 0,
            'Friday' => 0,
            'Saturday' => 0,
            'Sunday' => 0
        ];

        // Fill with actual data
        foreach ($dailyData as $data) {
            $allDays[$data->day_name] = round($data->avg_occupancy, 2);
        }

        return response()->json([
            'labels' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            'data' => array_values($allDays),
            'week_start' => $weekStart,
            'week_end' => $weekEnd
        ]);
    }

    public function getRevenueData(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);

        // Get monthly revenue data
        $monthlyRevenue = Payment::selectRaw('MONTH(payment_date) as month, SUM(amount) as total')
            ->whereYear('payment_date', $year)
            ->where('status', 'completed')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        // Fill in months with no data
        $allMonths = [];
        for ($i = 1; $i <= 12; $i++) {
            $allMonths[$i] = $monthlyRevenue[$i] ?? 0;
        }

        return response()->json([
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'data' => array_values($allMonths),
            'year' => $year
        ]);
    }

    public function getRevenueByRoomType(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);

        $revenueByRoomType = Payment::with(['invoice.room'])
            ->selectRaw('rooms.type as room_type, SUM(payments.amount) as total_revenue')
            ->join('invoices', 'payments.invoice_id', '=', 'invoices.id')
            ->join('rooms', 'invoices.room_id', '=', 'rooms.id')
            ->whereYear('payments.payment_date', $year)
            ->where('payments.status', 'completed')
            ->groupBy('rooms.type')
            ->orderByDesc('total_revenue')
            ->get();

        // Format data for chart
        $labels = [];
        $data = [];
        $backgroundColors = [
            'rgba(54, 162, 235, 0.7)', // Standard - Blue
            'rgba(75, 192, 192, 0.7)', // Deluxe - Teal
            'rgba(153, 102, 255, 0.7)', // Suite - Purple
            'rgba(255, 159, 64, 0.7)', // Executive - Orange
            'rgba(255, 99, 132, 0.7)'  // Penthouse - Red
        ];

        foreach ($revenueByRoomType as $index => $item) {
            $labels[] = $item->room_type;
            $data[] = $item->total_revenue;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
            'backgroundColor' => array_slice($backgroundColors, 0, count($labels)),
            'borderColor' => array_map(function ($color) {
                return str_replace('0.7', '1', $color);
            }, array_slice($backgroundColors, 0, count($labels))),
            'year' => $year
        ]);
    }

    public function getExpenseByCategory(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);

        $expensesByCategory = Expense::with(['category'])
            ->selectRaw('expense_categories.name as category_name, SUM(expenses.amount) as total_amount')
            ->join('expense_categories', 'expenses.category_id', '=', 'expense_categories.id')
            ->whereYear('expenses.date', $year)
            ->groupBy('expense_categories.name')
            ->orderByDesc('total_amount')
            ->get();

        // Format data for chart
        $labels = [];
        $data = [];
        $backgroundColors = [
            'rgba(255, 99, 132, 0.7)',  // Red
            'rgba(54, 162, 235, 0.7)',  // Blue
            'rgba(255, 159, 64, 0.7)',  // Orange
            'rgba(75, 192, 192, 0.7)',  // Teal
            'rgba(153, 102, 255, 0.7)', // Purple
            'rgba(201, 203, 207, 0.7)', // Gray
            'rgba(255, 205, 86, 0.7)',  // Yellow
            'rgba(120, 200, 150, 0.7)'  // Green
        ];

        foreach ($expensesByCategory as $index => $item) {
            $labels[] = $item->category_name;
            $data[] = $item->total_amount;
        }

        // If no data, show empty state
        if (empty($labels)) {
            $labels = ['No expenses recorded'];
            $data = [1];
            $backgroundColors = ['rgba(200, 200, 200, 0.7)'];
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
            'backgroundColor' => array_slice($backgroundColors, 0, count($labels)),
            'borderColor' => array_map(function ($color) {
                return str_replace('0.7', '1', $color);
            }, array_slice($backgroundColors, 0, count($labels))),
            'year' => $year
        ]);
    }

    public function getAgeDistribution()
    {
        $ageGroups = [
            '18-24' => [18, 24],
            '25-34' => [25, 34],
            '35-44' => [35, 44],
            '45-54' => [45, 54],
            '55-64' => [55, 64],
            '65+' => [65, 150] // Assuming no one is over 150 :)
        ];

        $data = [];
        $totalGuests = Guest::count();

        foreach ($ageGroups as $label => $range) {
            $count = Guest::whereBetween('age', $range)->count();
            $percentage = $totalGuests > 0 ? round(($count / $totalGuests) * 100, 2) : 0;

            $data['labels'][] = $label;
            $data['values'][] = $percentage;
        }

        return response()->json($data);
    }

    public function getPurposeStayDistribution()
    {
        $purposes = [
            'Business',
            'Leisure',
            'Events',
            'Other'
        ];

        $data = [];
        $totalGuests = Guest::count();

        foreach ($purposes as $purpose) {
            $count = Guest::where('purpose_of_stay', $purpose)->count();
            $percentage = $totalGuests > 0 ? round(($count / $totalGuests) * 100, 2) : 0;

            $data['labels'][] = $purpose;
            $data['values'][] = $percentage;
        }

        return response()->json($data);
    }

    public function getGuestOriginData()
    {
        // Get top 8 countries with most guests
        $countries = Guest::select('country')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('country')
            ->orderByDesc('count')
            ->limit(8)
            ->get();

        $data = [
            'labels' => $countries->pluck('country')->toArray(),
            'values' => $countries->pluck('count')->toArray()
        ];

        return response()->json($data);
    }
}
