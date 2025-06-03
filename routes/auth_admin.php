<?php
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use Illuminate\Support\Facades\Route;


Route::post('/login/admin', [AdminController::class, 'store'])->middleware('guest')->name('login.admin');
Route::post('/logout/admin', [AdminController::class, 'destroy'])->name('logout.admin');

Route::prefix('admin')->name('admin.')->group(function () {
    // Admin profile routes
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [AdminProfileController::class, 'updateProfile'])->name('profile.update');
        Route::put('/profile/security', [AdminProfileController::class, 'updateSecurity'])->name('security.update');
        Route::put('/profile/preferences', [AdminProfileController::class, 'updatePreferences'])->name('preferences.update');
    });
});
