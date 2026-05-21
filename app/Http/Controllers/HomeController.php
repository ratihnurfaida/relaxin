<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        return view('pages.welcome', compact('hotels'));
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