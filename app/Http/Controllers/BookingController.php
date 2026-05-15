<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Kamar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
        'tgl_checkin' => 'required|date',
        'tgl_checkout' => 'required|date|after:tgl_checkin',
        'id_hotel' => 'required',
        'id_kamar' => 'required',
    ]);
    
        //pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silahkan login terlebih dahulu.');
        }

        //ambil data kamar untuk tahu harganya
        $kamar=Kamar::findOrFail($request->id_kamar);

        //hitung total malam
        $tgl_checkin = Carbon::parse($request->tgl_checkin);
        $tgl_checkout = Carbon::parse($request->tgl_checkout);
        $total_malam = $tgl_checkin->diffInDays($tgl_checkout);

        //pastikan minimal 1 malam
        if($total_malam <= 0) $total_malam = 1;

        //hitung total harga
        $total_harga = ($kamar->harga_per_kamar * $total_malam) * $request->jumlah_kamar;

        //simpan ke database
        Booking::create([
            'id_user' => Auth::user()->id_user, // Sesuaikan dengan foreign key di migration kamu
            'id_hotel'     => $request->id_hotel,
            'id_kamar'     => $request->id_kamar,
            'tgl_checkin'  => $request->tgl_checkin,
            'tgl_checkout' => $request->tgl_checkout,
            'total_malam'  => $total_malam,
            'total_tamu'   => $request->total_tamu ?? 1,
            'jumlah_kamar' => $request->jumlah_kamar ?? 1,
            'total_harga'  => $total_harga,
            'status'       => 'Pending',
        ]);

        return redirect()->route('booking.success')->with('success', 'Booking berhasil dibuat!');
    }
}
