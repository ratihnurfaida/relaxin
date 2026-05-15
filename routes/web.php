<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\KamarController;
use App\Http\Controllers\Admin\HotelController as AdminHotelController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\BookingController;

// Halaman utama & search
Route::get('/', [HomeController::class, 'index'])->name('hotel.index');
Route::get('/search', [HomeController::class, 'search'])->name('hotel.search');

// Route detail hotel dan tipe kamar
Route::get('/hotel/{id}', [HotelController::class, 'show'])->name('hotel.show');  

// Route booking
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store')->middleware('auth');
// Route menampilkan halaman sukses booking
Route::get('/booking-success', function() {
    return view('pages.booking-success');
})->name('booking.success');

// Route user biasa
Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth'])->name('dashboard');

// Route admin
Route::prefix('admin')
    ->middleware(['auth', 'role:admin']) // Pastikan middleware 'role' sudah kamu buat
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // CRUD Hotel
        Route::resource('hotel', AdminHotelController::class);

        // CRUD Kamar
        Route::resource('kamar', KamarController::class);
    });


// Route profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';