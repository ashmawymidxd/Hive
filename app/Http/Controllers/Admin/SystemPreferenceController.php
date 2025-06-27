<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\SystemPreference;
use Illuminate\Http\Request;

class SystemPreferenceController extends Controller
{
    public function index()
    {
        //
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'default_language' => 'required|string|max:50',
            'timezone' => 'required|string|max:100',
            'date_format' => 'required|string|max:20',
            'currency_format' => 'required|string|max:20',
            'measurement_system' => 'required|string|in:metric,imperial',
            'ui_theme_color' => 'required|string',
            'default_loader' => 'required|string',
            'compact_mode' => 'sometimes',
            'auto_refresh_dashboard' => 'sometimes',
            'enable_animations' => 'sometimes',
        ]);

        // Convert checkboxes to proper boolean values
        $validated['compact_mode'] = $request->has('compact_mode');
        $validated['auto_refresh_dashboard'] = $request->has('auto_refresh_dashboard');
        $validated['enable_animations'] = $request->has('enable_animations');

        $preferences = SystemPreference::getPreferences();
        $preferences->update($validated);

        // Clear the cache if you're using it
        cache()->forget('system_preferences');

        return redirect()->back()->with('success', 'System preferences updated successfully!');
    }
}
