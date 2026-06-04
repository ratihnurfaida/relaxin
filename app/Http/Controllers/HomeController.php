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
        $booking = Booking::with(['hotel', 'kamar'])
        ->latest()
        ->get();
        return view('admin.dashboard', compact('booking'));
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
}