<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function show($id)
    {
        $hotel = Hotel::where('id_hotel', $id)->firstOrFail();

        return view('pages.detail', compact('hotel'));
    }
}
