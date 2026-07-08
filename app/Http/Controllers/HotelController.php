<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Area;

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

        // filter search
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // filter area
        if ($request->filled('area')) {
            $query->whereHas('area', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->area . '%');
            });
        }

        $hotels = $query->get(); 
        $totalHotels = $hotels->count();

        if ($totalHotels == 1 && $request->filled('search')) {
            return redirect()->route('hotel.show', [
                'id' => $hotels->first()->id_hotel, 
                'tgl_checkin' => $request->checkin,
                'tgl_checkout' => $request->checkout
            ]);
        }

        return view('pages.hotel', compact('hotels', 'totalHotels')); 
    }

    public function destinasi()
    {
        $hotels = Hotel::all();
        $areas = Area::withCount('hotels')->get();
        return view('pages.destinasi', compact('areas'));
    }


}