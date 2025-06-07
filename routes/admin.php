<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\ReservationStatusController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\GuestFeedbackController;
use App\Http\Controllers\Admin\BlacklistedGuestController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\HousekeepingItemController;
use App\Http\Controllers\Admin\VendorController;
/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "admin" middleware group. Make something great!
|
*/


Route::get('/admin', [DashboardController::class, 'index'])
->middleware(['auth:admin', 'verified'])->name('admin');

Route::get('/login-admin', function(){
    return view('auth.admin-login');
})->middleware('guest')->name('login-admin');

Route::middleware('auth:admin')->name('admin.')->prefix('admin')->group(function(){
   Route::resource('rooms', RoomController::class);

    // Amenities API routes for select2
    Route::get('amenities', [AmenityController::class, 'index'])->name('amenities.index');
    Route::post('amenities', [AmenityController::class, 'store'])->name('amenities.store');
    Route::put('amenities/{amenity}', [AmenityController::class, 'update'])->name('amenities.update');
    Route::delete('amenities/{amenity}', [AmenityController::class, 'destroy'])->name('amenities.destroy');

    // Room images routes
    Route::get('rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');
    Route::post('rooms/{room}/upload-images', [RoomController::class, 'uploadImages'])->name('rooms.upload-images');
    Route::delete('rooms/images/{image}', [RoomController::class, 'deleteImage'])->name('rooms.delete-image');
    // reservations
    Route::resource('reservations', ReservationController::class);

    // Guests routes
    Route::resource('guests', GuestController::class);

    // For select2 in reservations
    Route::get('guests/search', [GuestController::class, 'index'])
        ->name('guests.search');

    // Reservation status routes
    Route::post('reservations/{reservation}/check-in', [ReservationStatusController::class, 'checkIn'])
        ->name('reservations.check-in');
    Route::post('reservations/{reservation}/check-out', [ReservationStatusController::class, 'checkOut'])
        ->name('reservations.check-out');
    Route::post('reservations/{reservation}/no-show', [ReservationStatusController::class, 'markAsNoShow'])
        ->name('reservations.no-show');

    // Notification routes
    Route::get('notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');
    Route::post('notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.mark-as-read');
    Route::post('notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])
        ->name('notifications.mark-all-read');

    // Guest feedback routes
    Route::post('/feedback', [GuestFeedbackController::class, 'store'])->name('feedback.store');

    // Admin routes
    Route::get('/feedbacks', [GuestFeedbackController::class, 'index'])->name('feedbacks.index');
    Route::put('/feedbacks/{feedback}', [GuestFeedbackController::class, 'updateStatus'])->name('feedbacks.update');

    // Blacklisted guests routes
    Route::post('/blacklist', [BlacklistedGuestController::class, 'store'])->name('blacklist.store');
    Route::put('/blacklist/{blacklistedGuest}/status', [BlacklistedGuestController::class, 'updateStatus'])->name('blacklist.update-status');

    // Staff Management Routes
    Route::resource('staff',StaffController::class);

    // Roles management
    Route::get('staff/roles', [RoleController::class, 'roles'])->name('staff.roles');
    Route::post('staff/roles', [RoleController::class, 'storeRole'])->name('staff.storeRole');
    Route::put('staff/roles/{role}', [RoleController::class, 'updateRole'])->name('staff.updateRole');
    Route::delete('staff/roles/{role}', [RoleController::class, 'destroyRole'])->name('staff.destroyRole');

    // Department routes
    Route::resource('departments', DepartmentController::class)->except(['create', 'edit', 'show']);

    // routes/web.php
    Route::post('/staff/{staff}/tasks/', [TaskController::class, 'store'])->name('admin.staff.tasks.store');
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    // inventory management
    Route::get('/inventories_page', 
    function ()
    {
        return view('admin.pages.inventories.index');
    }
    )->name('inventories.page');
    Route::resource('inventories', InventoryController::class)->except(['create', 'edit']);

    // Housekeeping items management
    Route::resource('housekeeping-items', HousekeepingItemController::class)->except(['create', 'edit']);
    Route::get('housekeeping-items-alerts', [HousekeepingItemController::class, 'alerts'])->name('housekeeping-items.alerts');
    Route::post('housekeeping-items/{housekeepingItem}/update-reorder', [HousekeepingItemController::class, 'updateReorderPoint']);

    // Vendor Management
    Route::resource('vendors', VendorController::class)->except(['create', 'edit']);
});




require __DIR__.'/auth_admin.php';
