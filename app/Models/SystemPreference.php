<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'default_language',
        'timezone',
        'date_format',
        'currency_format',
        'measurement_system',
        'ui_theme_color',
        'default_loader',
        'compact_mode',
        'auto_refresh_dashboard',
        'enable_animations'
    ];

    protected $casts = [
        'compact_mode' => 'boolean',
        'auto_refresh_dashboard' => 'boolean',
        'enable_animations' => 'boolean',
    ];



    // In the SystemPreference model
    public static function getPreferences()
    {
        return cache()->rememberForever('system_preferences', function () {
            return self::firstOrCreate([]);
        });
    }
}
