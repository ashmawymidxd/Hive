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
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\BillingChartController;
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
    ->middleware(['auth:admin', 'verified', 'check.admin.status'])->name('admin');

Route::get('/login-admin', function () {
    return view('auth.admin-login');
})->middleware('guest')->name('login-admin');

Route::middleware(['auth:admin', 'check.admin.status'])->name('admin.')->prefix('admin')->group(function () {

    Route::resource('rooms', RoomController::class)->middleware('admin.permission:manage_rooms');

    // Amenities
    Route::get('amenities', [AmenityController::class, 'index'])->name('amenities.index')->middleware('admin.permission:view_amenities');
    Route::post('amenities', [AmenityController::class, 'store'])->name('amenities.store')->middleware('admin.permission:create_amenities');
    Route::put('amenities/{amenity}', [AmenityController::class, 'update'])->name('amenities.update')->middleware('admin.permission:update_amenities');
    Route::delete('amenities/{amenity}', [AmenityController::class, 'destroy'])->name('amenities.destroy')->middleware('admin.permission:delete_amenities');

    // Room Images
    Route::get('rooms/{room}', [RoomController::class, 'show'])->name('rooms.show')->middleware('admin.permission:view_room_details');
    Route::post('rooms/{room}/upload-images', [RoomController::class, 'uploadImages'])->name('rooms.upload-images')->middleware('admin.permission:upload_room_images');
    Route::delete('rooms/images/{image}', [RoomController::class, 'deleteImage'])->name('rooms.delete-image')->middleware('admin.permission:delete_room_images');

    // Reservations
    Route::resource('reservations', ReservationController::class)->middleware('admin.permission:manage_reservations');
    Route::post('reservations/{reservation}/check-in', [ReservationStatusController::class, 'checkIn'])->name('reservations.check-in')->middleware('admin.permission:reservation_check_in');
    Route::post('reservations/{reservation}/check-out', [ReservationStatusController::class, 'checkOut'])->name('reservations.check-out')->middleware('admin.permission:reservation_check_out');
    Route::post('reservations/{reservation}/no-show', [ReservationStatusController::class, 'markAsNoShow'])->name('reservations.no-show')->middleware('admin.permission:reservation_no_show');

    // Guests
    Route::resource('guests', GuestController::class)->middleware('admin.permission:manage_guests');
    Route::get('guests/search', [GuestController::class, 'index'])->name('guests.search')->middleware('admin.permission:search_guests');

    // Notifications
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index')->middleware('admin.permission:view_notifications');
    Route::post('notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read')->middleware('admin.permission:mark_notification_read');
    Route::post('notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read')->middleware('admin.permission:mark_all_notifications_read');

    // Feedback
    Route::post('/feedback', [GuestFeedbackController::class, 'store'])->name('feedback.store')->middleware('admin.permission:create_feedback');
    Route::get('/feedbacks', [GuestFeedbackController::class, 'index'])->name('feedbacks.index')->middleware('admin.permission:view_feedback');
    Route::put('/feedbacks/{feedback}', [GuestFeedbackController::class, 'updateStatus'])->name('feedbacks.update')->middleware('admin.permission:update_feedback');

    // Blacklist
    Route::post('/blacklist', [BlacklistedGuestController::class, 'store'])->name('blacklist.store')->middleware('admin.permission:add_blacklist');
    Route::put('/blacklist/{blacklistedGuest}/status', [BlacklistedGuestController::class, 'updateStatus'])->name('blacklist.update-status')->middleware('admin.permission:update_blacklist_status');

    // Staff
    Route::resource('staff', StaffController::class)->middleware('admin.permission:manage_staff');
    Route::post('/staff/{staff}/password', [StaffController::class, 'updatePassword'])->name('staff.update-password')->middleware('admin.permission:update_staff_password');

    // Roles
    Route::get('staff/roles', [RoleController::class, 'roles'])->name('staff.roles')->middleware('admin.permission:view_roles');
    Route::post('staff/roles', [RoleController::class, 'storeRole'])->name('staff.storeRole')->middleware('admin.permission:create_role');
    Route::put('staff/roles/{role}', [RoleController::class, 'updateRole'])->name('staff.updateRole')->middleware('admin.permission:update_role');
    Route::delete('staff/roles/{role}', [RoleController::class, 'destroyRole'])->name('staff.destroyRole')->middleware('admin.permission:delete_role');

    // Departments
    Route::resource('departments', DepartmentController::class)->except(['create', 'edit', 'show'])->middleware('admin.permission:manage_departments');

    // Tasks
    Route::post('/staff/{staff}/tasks/', [TaskController::class, 'store'])->name('admin.staff.tasks.store')->middleware('admin.permission:assign_tasks');
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show')->middleware('admin.permission:view_task');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update')->middleware('admin.permission:update_task');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy')->middleware('admin.permission:delete_task');

    // Inventory
    Route::get('/inventories_page', fn() => view('admin.pages.inventories.index'))->name('inventories.page')->middleware('admin.permission:view_inventory');
    Route::resource('inventories', InventoryController::class)->except(['create', 'edit'])->middleware('admin.permission:manage_inventory');

    // Housekeeping
    Route::resource('housekeeping-items', HousekeepingItemController::class)->except(['create', 'edit'])->middleware('admin.permission:manage_housekeeping');
    Route::get('housekeeping-items-alerts', [HousekeepingItemController::class, 'alerts'])->name('housekeeping-items.alerts')->middleware('admin.permission:view_housekeeping_alerts');
    Route::post('housekeeping-items/{housekeepingItem}/update-reorder', [HousekeepingItemController::class, 'updateReorderPoint'])->middleware('admin.permission:update_housekeeping_reorder');

    // Vendors
    Route::resource('vendors', VendorController::class)->except(['create', 'edit'])->middleware('admin.permission:manage_vendors');

    // Invoices
    Route::resource('invoices', InvoiceController::class)->except(['edit', 'update', 'destroy'])->middleware('admin.permission:manage_invoices');
    Route::get('invoices/{invoice}/download', [InvoiceController::class, 'download'])->name('invoices.download')->middleware('admin.permission:download_invoice');
    Route::get('invoices/{invoice}/print', [InvoiceController::class, 'print'])->name('invoices.print')->middleware('admin.permission:print_invoice');
    Route::post('invoices/{invoice}/mark-as-paid', [InvoiceController::class, 'markAsPaid'])->name('invoices.mark-as-paid')->middleware('admin.permission:mark_invoice_paid');

    // Payments
    Route::resource('payments', PaymentController::class)->except(['edit', 'update'])->middleware('admin.permission:manage_payments');

    // expenses
    Route::resource('expenses', ExpenseController::class)->except(['index', 'create'])->middleware('admin.permission:manage_expenses');
    // expenses.storeCategory
    Route::post('expenses/categories', [ExpenseController::class, 'storeCategory'])->name('expenses.storeCategory')->middleware('admin.permission:create_expense_category');
    // expenses.destroyCategory
    Route::delete('expenses/categories/{category}', [ExpenseController::class, 'destroyCategory'])->name('expenses.destroyCategory')->middleware('admin.permission:delete_expense_category');

    // getChartData
    Route::get('dashboard/chart-data', [ExpenseController::class, 'getChartData'])->name('dashboard.chart-data');

    // Billing Chart
    Route::get('charts/daily-comparison', [BillingChartController::class, 'getDailyComparison'])->name('charts.dailyComparison');
    Route::get('charts/weekly-comparison', [BillingChartController::class, 'getWeeklyComparison'])->name('charts.weeklyComparison');
    Route::get('charts/monthly-comparison', [BillingChartController::class, 'getMonthlyComparison'])->name('charts.monthlyComparison');
    Route::post('reports/generate', [BillingChartController::class, 'generateReport'])->name('reports.generate');
    Route::get('reports/export', [BillingChartController::class, 'exportReport'])->name('reports.export');
});

require __DIR__ . '/auth_admin.php';
