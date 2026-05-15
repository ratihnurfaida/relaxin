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

   return view('pages.detail', [
    'hotel' => $hotel, 
    'tgl_checkin' => $checkin, 
    'tgl_checkout' => $checkout
    ]);
    }

    public function index(Request $request)
    {
        $query = Hotel::query(); 

        //filter berdasarkan apa yang diketik di "Destinasi"
        if ($request->filled('search')) {
            $query->where('nama_hotel', 'like', '%' . $request->search . '%');
        }

        //ambil hasilnya
        $hotels = $query->get(); 

        // cek kalau hasil pencariannya pas cuma 1, langsung pindah ke detail
        if ($hotels->count() == 1) {
            return redirect()->route('hotel.show', [
                'id' => $hotels->first()->id_hotel,
                'checkin' => $request->checkin,
                'checkout' => $request->checkout
            ]);
        }

        // kalau lebih dari satu (misal cari "Hotel" muncul banyak), tampilkan daftar
        return view('pages.welcome', compact('hotels')); 
    }
}
