<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Area;


class HomeController extends Controller
{

    public function index()
    {
        // Tampilkan 4 hotel sebagai rekomendasi (tidak lagi berdasarkan jumlah booking)
        $hotels = Hotel::latest()->take(4)->get();
        $areas = Area::withCount('hotels')->get();

        return view('pages.welcome', compact('hotels', 'areas'));
    }

    public function adminDashboard()
    {
        $total_selesai = Booking::where('status', 'selesai')->count();
        $booking = Booking::latest()->get();
        $total_hotel = Hotel::count();
        return view('admin.dashboard', compact('total_selesai', 'booking', 'total_hotel'));
    }

    public function reservasi()
    {
        $booking = Booking::latest()->get();

        return view('admin.reservasi', compact('booking'));
    }

    public function search(Request $request)
    {
        $query = $request->input('location');
        $hotels = Hotel::where('nama', 'LIKE', "%{$query}%")
                    ->orWhere('kota', 'LIKE', "%{$query}%")
                    ->get();

        return view('pages.welcome', compact('hotels'));
    }

    public function show()
    {
        $hotels = Hotel::all();
        $kamar = $hotels->kamar;
        return view ('pages.show', compact('hotels', 'kamar'));
    }

    public function about()
    {
        return view('pages.about', [
            'title' => 'Tentang Kami — RelaXin'
        ]);
    }

    public function kontak()
    {
        return view('pages.kontak');
    }
 
    public function kontakStore(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'email'  => 'required|email|max:255',
            'subjek' => 'required|string|max:255',
            'pesan'  => 'required|string|max:2000',
        ]);
    }
}