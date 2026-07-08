<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\KamarController as AdminKamarController;
use App\Http\Controllers\Admin\HotelController as AdminHotelController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Models\Booking;

// halam utama
Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/search', [HomeController::class, 'search'])->name('hotel.search');
Route::get('/hotel', [HotelController::class, 'index'])->name('hotel.index');
Route::get('/destinasi', [HotelController::class, 'destinasi']) ->name('destinasi.index');
Route::get('/hotel/{id}', [HotelController::class, 'show'])->name('hotel.show');
Route::get('/about', [HomeController::class, 'about'])->name('about');


// route user biasa (pelanggan)
Route::middleware('auth')->group(function () {
    
    // dashboard user biasa
    Route::get('/dashboard', function () {
        $bookings = Booking::where('id_user', Auth::id())->with('kamar.hotel')->get();
        return view('pages.dashboard', compact('bookings'));
    })->name('dashboard');

    // alur reservasi & booking
    Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create'); 
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/payment/{id}', [BookingController::class, 'showPaymentPage'])->name('booking.payment');
    Route::post('/booking/confirm-payment/{id}', [BookingController::class, 'confirmPayment'])->name('booking.confirm');
    Route::put('/admin/booking/{id}/archive', [BookingController::class, 'archive'])->name('admin.booking.archive');
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
    ->middleware(['auth'])
    ->name('admin.')
    ->group(function () {

        Route::get('dashboard', [HomeController::class, 'adminDashboard'])->name('dashboard');
        Route::get('reservasi', [HomeController::class, 'reservasi'])->name('reservasi');

        // Hotel tetap resource, aman
        Route::resource('hotel', AdminHotelController::class);

        // Kamar — manual, TIDAK ada Route::resource('kamar', ...) di manapun lagi
        Route::get('kamar/pilih-hotel', [AdminHotelController::class, 'selectHotel'])->name('kamar.pilih-hotel');
        Route::get('kamar/create/{hotel}', [AdminKamarController::class, 'create'])->name('kamar.create');
        Route::get('kamar', [AdminKamarController::class, 'index'])->name('kamar.index');
        Route::post('kamar', [AdminKamarController::class, 'store'])->name('kamar.store');
        Route::get('kamar/{kamar}/edit', [AdminKamarController::class, 'edit'])->name('kamar.edit');
        Route::put('kamar/{kamar}', [AdminKamarController::class, 'update'])->name('kamar.update');
        Route::delete('kamar/{kamar}', [AdminKamarController::class, 'destroy'])->name('kamar.destroy');

        Route::get('/booking', [BookingController::class, 'adminIndex'])->name('booking.index');
        Route::put('/booking/{id}/status', [BookingController::class, 'updateStatus'])->name('booking.status');
    });

Route::get('/view-bukti/{filename}', function ($filename) {
    $path = storage_path('storage/bukti_transfer/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    return response()->file($path);
})->name('view.bukti');

// route untuk autentikasi 
require __DIR__.'/auth.php';