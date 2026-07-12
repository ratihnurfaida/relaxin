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
Route::view('/kebijakan-privasi', 'pages.kebijakan')->name('kebijakan');
Route::view('/syarat-ketentuan', 'pages.syarat')->name('syarat');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak.index');
Route::post('/kontak', [HomeController::class, 'kontakStore'])->name('kontak.store');


// route user biasa (pelanggan)
Route::middleware('auth')->group(function () {

    // dashboard user biasa
    Route::get('/dashboard', function () {
        $userId = Auth::id();

        $allBookings = Booking::where('id_user', $userId)->with(['kamar', 'hotel'])->get();

        $totalBooking = $allBookings->count();

        $selesaiCount = $allBookings->filter(fn($b) => in_array(strtolower(trim($b->status)), ['confirmed', 'berhasil', 'selesai']))->count();
        $pendingCount = $allBookings->filter(fn($b) => in_array(strtolower(trim($b->status)), ['pending', 'menunggu konfirmasi']))->count();
        $dibatalkanCount = $allBookings->filter(fn($b) => in_array(strtolower(trim($b->status)), ['cancelled', 'dibatalkan']))->count();

        $selesaiPercent = $totalBooking > 0 ? round(($selesaiCount / $totalBooking) * 100) : 0;
        $pendingPercent = $totalBooking > 0 ? round(($pendingCount / $totalBooking) * 100) : 0;
        $dibatalkanPercent = $totalBooking > 0 ? round(($dibatalkanCount / $totalBooking) * 100) : 0;

        $nextBooking = $allBookings
            ->filter(fn($b) => in_array(strtolower(trim($b->status)), ['confirmed', 'berhasil'])
                && \Carbon\Carbon::parse($b->tgl_checkin)->isFuture())
            ->sortBy('tgl_checkin')
            ->first();

        $bookings = Booking::where('id_user', $userId)
                        ->with(['kamar', 'hotel'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(6);

        return view('pages.dashboard', compact(
            'bookings', 'nextBooking', 'totalBooking',
            'selesaiCount', 'pendingCount', 'dibatalkanCount',
            'selesaiPercent', 'pendingPercent', 'dibatalkanPercent'
        ));
    })->name('dashboard');

    // alur reservasi & booking
    Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/payment/{id}', [BookingController::class, 'showPaymentPage'])->name('booking.payment');
    Route::post('/booking/confirm-payment/{id}', [BookingController::class, 'confirmPayment'])->name('booking.confirm');
    Route::get('/booking-success', function() {
        return view('pages.booking-success');
    })->name('booking.success');

    // manajemen profil user
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // lihat bukti transfer — wajib login, tidak lagi bisa diakses publik
    Route::get('/view-bukti/{filename}', function ($filename) {
        $path = storage_path('app/public/bukti_transfer/' . $filename);
        if (!File::exists($path)) {
            abort(404);
        }
        return response()->file($path);
    })->name('view.bukti');
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

        // dipindahkan ke sini dari grup auth biasa — sebelumnya bisa diakses semua user login, bukan cuma admin
        Route::put('/booking/{id}/archive', [BookingController::class, 'archive'])->name('booking.archive');
    });

// route untuk autentikasi
require __DIR__.'/auth.php';