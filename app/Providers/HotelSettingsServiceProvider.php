<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\HotelSetting;
use App\Models\SystemPreference;

class HotelSettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton('settings', function () {
            return HotelSetting::firstOr(function () {
                return HotelSetting::factory()->make();
            });
        });

        $this->app->singleton('preferences', function () {
            return SystemPreference::firstOr(function () {
                return SystemPreference::factory()->make();
            });
        });


    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
