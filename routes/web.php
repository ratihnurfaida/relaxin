<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $hotels = collect([
        [
            'id'          => 1,
            'name'        => 'The Trans Luxury Hotel',
            'location'    => 'Bandung, Jawa Barat',
            'image'       => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=600&q=80',
            'stars'       => 5,
            'rating'      => '4.9',
            'reviews'     => '1.2k',
            'amenities'   => ['🏊 Pool', '🍳 Sarapan', '💆 Spa'],
            'price'       => 850000,
            'badge'       => 'Best Seller',
            'badge_color' => 'rose',
        ],
        [
            'id'          => 2,
            'name'        => 'Padma Resort Ubud',
            'location'    => 'Ubud, Bali',
            'image'       => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=600&q=80',
            'stars'       => 5,
            'rating'      => '4.8',
            'reviews'     => '2.4k',
            'amenities'   => ['🏊 Infinity Pool', '🍽️ All-inclusive'],
            'price'       => 1200000,
            'badge'       => 'Hemat 30%',
            'badge_color' => 'emerald',
        ],
        [
            'id'          => 3,
            'name'        => 'Four Points by Sheraton',
            'location'    => 'Makassar, Sulawesi',
            'image'       => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=600&q=80',
            'stars'       => 4,
            'rating'      => '4.7',
            'reviews'     => '890',
            'amenities'   => ['🌊 View Laut', '🍳 Sarapan'],
            'price'       => 620000,
            'badge'       => 'Baru',
            'badge_color' => 'primary',
        ],
        [
            'id'          => 4,
            'name'        => 'Swiss-Belhotel Yogyakarta',
            'location'    => 'Yogyakarta',
            'image'       => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=600&q=80',
            'stars'       => 4,
            'rating'      => '4.6',
            'reviews'     => '1.1k',
            'amenities'   => ['🏛️ Pusat Kota', '🅿️ Parkir'],
            'price'       => 450000,
            'badge'       => null,
            'badge_color' => null,
        ],
    ]);

    return view('pages.welcome', compact('hotels'));

})->name('home');

Route::get('/hotels',        fn() => redirect('/') )->name('hotels.index');
Route::get('/hotels/search', fn() => redirect('/') )->name('hotels.search');
Route::get('/hotels/{id}',   fn() => redirect('/') )->name('hotels.show');

require __DIR__.'/auth.php';