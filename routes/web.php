<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\KamarController;
use App\Http\Controllers\Admin\HotelController as AdminHotelController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;

// halam utama
Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/search', [HomeController::class, 'search'])->name('hotel.search');
Route::get('/hotel/{id}', [HotelController::class, 'show'])->name('hotel.show');


// route user biasa (pelanggan)
Route::middleware('auth')->group(function () {
    
    // dashboard user biasa
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    // alur reservasi & booking
    Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create'); 
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking-success', function() {
        return view('pages.booking-success');
    })->name('booking.success');

    // manajemen profil user
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// route untuk admin
Route::prefix('admin')
    ->middleware(['auth']) // Pastikan middleware 'role' aktif di Kernel.php
    ->name('admin.')
    ->group(function () {
        
        // halaman utama dashboard admin
        Route::get('/dashboard', [BookingController::class, 'adminDashboard'])->name('dashboard');

        // CRUD hotel & kamar 
        Route::resource('hotel', AdminHotelController::class);
        Route::resource('kamar', KamarController::class);

        // verifikasi & update status booking
        Route::get('/booking', [BookingController::class, 'adminIndex'])->name('booking.index');
        Route::put('/booking/{id}/status', [BookingController::class, 'updateStatus'])->name('booking.status');
    });

// route untuk autentikasi 
require __DIR__.'/auth.php';