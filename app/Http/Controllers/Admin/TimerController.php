<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimerController extends Controller
{
    public function start()
    {
        $user = Auth::guard('admin')->user();

        if (!$user->timer_started_at) {
            $user->update([
                'timer_started_at' => now(),
                'timer_seconds' => $user->timer_seconds ?: 0
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Timer started',
                'timer_started_at' => $user->timer_started_at
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Timer already running',
            'timer_started_at' => $user->timer_started_at
        ]);
    }

    public function stop()
    {
        $user = Auth::guard('admin')->user();

        if ($user->timer_started_at) {
            $elapsed = now()->diffInSeconds($user->timer_started_at);
            $totalSeconds = $user->timer_seconds + $elapsed;

            $user->update([
                'timer_seconds' => $totalSeconds,
                'timer_started_at' => null
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Timer stopped',
                'total_seconds' => $totalSeconds,
                'timer_started_at' => null
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No active timer',
            'timer_started_at' => null
        ]);
    }

    // app/Http/Controllers/TimerController.php

    public function status()
    {
        $user = Auth::guard('admin')->user();
        $totalSeconds = $user->timer_seconds;
        $isRunning = false;

        if ($user->timer_started_at) {
            $totalSeconds += now()->diffInSeconds($user->timer_started_at);
            $isRunning = true;
        }

        return response()->json([
            'is_running' => $isRunning,
            'total_seconds' => $totalSeconds,
            'formatted_time' => $this->formatTime($totalSeconds),
            'server_time' => now()->toDateTimeString() // Add server time for sync
        ]);
    }


    public function reset()
    {
        $user = Auth::guard('admin')->user();
        $user->update([
            'timer_seconds' => 0,
            'timer_started_at' => null
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Timer reset'
        ]);
    }


    protected function formatTime($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

}
