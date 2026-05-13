<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function show(Request $request, $id)
    {
    $checkin = $request->query('checkin');
    $checkout = $request->query('checkout');

    $hotel = Hotel::with(['kamar' => function($query) use ($checkin, $checkout) {
        if ($checkin && $checkout) {
            $query->withCount(['bookings as pesanan_terisi' => function($q) use ($checkin, $checkout) {
                $q->where('status', 'success')
                  ->where(function($dateQuery) use ($checkin, $checkout) {
                      $dateQuery->whereBetween('tgl_checkin', [$checkin, $checkout])
                                ->orWhereBetween('tgl_checkout', [$checkin, $checkout]);
                  });
            }]);
        }
    }])->findOrFail($id);

    return view('pages.detail', compact('hotel', 'checkin', 'checkout'));
    }

    public function index(Request $request)
{
    $hotels = Hotel::all(); // Ambil semua dulu buat tes

    // Tambahkan ini sementara:
    if($request->has('search')) {
        dd($request->all()); 
    }

    return view('pages.home', compact('hotels'));
}
}
