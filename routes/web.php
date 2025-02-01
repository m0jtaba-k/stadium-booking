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

Route::get('/stadiums/create', [StadiumController::class, 'create'])->name('stadiums.create');
// Authenticated user routes
Route::middleware(['auth'])->group(function () {
    // Stadium Management (Available to all authenticated users)
    Route::post('/stadiums', [StadiumController::class, 'store'])->name('stadiums.store');
    Route::resource('stadiums', StadiumController::class)->except(['index', 'show', 'create', 'store']);

    // Bookings and Ratings
    Route::resource('bookings', BookingController::class);
    Route::resource('ratings', RatingController::class);

    // Admin-only routes
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::get('/admin/stadiums', [StadiumController::class, 'index'])->name('admin.stadiums.index');
    });
});