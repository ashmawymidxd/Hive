<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {

        $today = Carbon::today();

        // Revenue for today
        $todayRevenue = Reservation::whereDate('check_in', $today)->sum('amount');

        // Revenue on the same day of last month
        $lastMonthSameDay = $today->copy()->subMonth();
        $lastMonthRevenue = Reservation::whereDate('check_in', $lastMonthSameDay)->sum('amount');

        // Calculate percentage change (handle division by zero)
        $percentageChange = $lastMonthRevenue > 0
            ? (($todayRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100
            : null;


        // Fetch all reservations with guest and room details
        $reservations = Reservation::with(['guest', 'room'])->latest()->limit(5)->get();

        return view('admin.index',compact('todayRevenue', 'percentageChange','reservations'))
            ->with('title', 'Dashboard')
            ->with('subtitle', 'Overview of Reservations and Revenue');

        
    }


}
