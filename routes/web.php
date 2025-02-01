<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StadiumController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('stadiums', StadiumController::class)->only(['index', 'show']);

// Authentication routes
Auth::routes();

// Admin-only routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::resource('users', UserController::class)->except(['show']);
    Route::get('stadiums', [StadiumController::class, 'adminIndex'])->name('admin.stadiums.index');
    Route::delete('stadiums/{stadium}', [StadiumController::class, 'adminDestroy'])->name('admin.stadiums.destroy');
});

// Authenticated user routes
Route::middleware(['auth'])->group(function () {
    // Bookings and Ratings
    Route::resource('bookings', BookingController::class);
    Route::resource('ratings', RatingController::class);

    // Stadium management (users can manage their own stadiums)
    Route::resource('stadiums', StadiumController::class)->except(['index', 'show']);
});