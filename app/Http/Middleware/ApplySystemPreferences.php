<?php

namespace App\Http\Middleware;

use App\Models\SystemPreference;
use Closure;
use Illuminate\Http\Request;

class ApplySystemPreferences
{
    public function handle(Request $request, Closure $next)
    {
        if (!app()->runningInConsole()) {
            $preferences = SystemPreference::getPreferences();

            // Set timezone
            config(['app.timezone' => $preferences->timezone]);
            date_default_timezone_set($preferences->timezone);

            // Set locale
            app()->setLocale($preferences->default_language);

            // Share preferences with all views
            view()->share('systemPreferences', $preferences);
        }

        return $next($request);
    }
}
