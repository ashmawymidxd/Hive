<?php

namespace Database\Seeders;

use App\Models\SystemPreference;
use Illuminate\Database\Seeder;

class SystemPreferencesSeeder extends Seeder
{
    public function run()
    {
        SystemPreference::firstOrCreate([], [
            'default_language' => 'en',
            'timezone' => 'UTC',
            'date_format' => 'Y-m-d',
            'currency_format' => '$0,0.00',
            'measurement_system' => 'metric',
            'ui_theme_color' => '#fcfcfc',
            'default_loader' => 'elegant_spinner',
            'compact_mode' => false,
            'auto_refresh_dashboard' => true,
            'enable_animations' => true,
        ]);
    }
}
