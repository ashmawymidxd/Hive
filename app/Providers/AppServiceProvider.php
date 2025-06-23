<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Reservation;
use App\Observers\ReservationObserver;
use Illuminate\Support\Facades\Blade;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Reservation::observe(ReservationObserver::class);

        Blade::if('hasPermission', function ($permission) {
            // Your permission check logic here
            return auth()->check() && auth()->user()->can($permission);
        });
    }
}
