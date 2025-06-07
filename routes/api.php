<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OccupancyDataController;
use App\Http\Controllers\Api\Admin\ReservationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Occupancy data routes
Route::get('/occupancy-data/{period}', [OccupancyDataController::class, 'getOccupancyData']);

// Reservation API routes
Route::prefix('admin')->group(function () {
    Route::apiResource('reservations', ReservationController::class);
});