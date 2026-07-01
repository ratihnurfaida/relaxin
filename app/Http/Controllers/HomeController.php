<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Models\Booking;

class HomeController extends Controller
{
    
    public function index()
    {
        $hotels = Hotel::all();
        return view('pages.welcome', compact('hotels'));
    }
    public function adminDashboard()
    {
        $total_selesai = Booking::where('status', 'selesai')->count();
        $booking = Booking::latest()->get();
        return view('admin.dashboard', compact('total_selesai', 'booking'));
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
        return view ('pages.show', compact('hotels'));
    }

    public function about()
    {
        return view('pages.about', [
            'title' => 'Tentang Kami — RelaXin'
        ]);
    }
}