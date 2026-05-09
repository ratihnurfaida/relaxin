<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HotelController;

Route::get('/', function () {
    return view('welcome');
});

// Route user biasa
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/tambah-hotel', function() {
    return view('pages.hotels.hotel-create');
});

// Route admin
Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        //CRUD Hotel
        Route::resource('hotel', App\Http\Controllers\Admin\HotelController::class);

        //CRUD Kamar
        Route::resource('kamar', App\Http\Controllers\Admin\KamarController::class);
    });

Route::resource('hotels', HotelController::class);

// Route profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';