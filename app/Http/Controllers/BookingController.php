<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Kamar;
use App\Models\Hotel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create(Request $request) 
    {
        $kamar = Kamar::all();
        $selected_hotel = $request->query('hotel_id');
        $selected_kamar = $request->query('id_kamar');
        $hotel = Hotel::find($selected_hotel); 
        
        return view('pages.booking.create', compact('kamar', 'selected_hotel', 'selected_kamar', 'hotel'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tamu'         => 'required|string|max:255',
            'email_tamu'        => 'required|email|max:255',
            'no_telepon'        => 'required|string|max:20',
            'no_identitas'      => 'nullable|string|max:50',
            'tgl_checkin'       => 'required|date|after_or_equal:today',
            'tgl_checkout'      => 'required|date|after:tgl_checkin',
            'id_hotel'          => 'required',
            'id_kamar'          => 'required',
            'jumlah_kamar'      => 'required|integer|min:1',
            'total_tamu'        => 'required|integer|min:1',
            'metode_payment'    => 'required|string',
            'permintaan_khusus' => 'nullable|string',
            'catatan'           => 'nullable|string',
            'bukti_payment'     => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silahkan login terlebih dahulu.');
        }

        $kamar = Kamar::findOrFail($request->id_kamar);
        $tgl_checkin = Carbon::parse($request->tgl_checkin);
        $tgl_checkout = Carbon::parse($request->tgl_checkout);
        $total_malam = $tgl_checkin->diffInDays($tgl_checkout);

        if (!$total_malam || $total_malam <= 0) {
            $total_malam = 1;
        }

        $subtotal    = ($kamar->harga_per_kamar * $total_malam) * $request->jumlah_kamar;
        $pajak       = round($subtotal * 0.1); 
        $total_harga = $subtotal + $pajak;

        $nama_file = null;
        if ($request->hasFile('bukti_payment')) {
            $file = $request->file('bukti_payment');
            $nama_file = time() . '_' . Auth::id() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/bukti_transfer', $nama_file);
        }

        // PERBAIKAN: Gunakan variabel $metode_payment yang sudah dikonversi
        $metode_payment = $request->metode_payment;
        if ($metode_payment == 'transfer_bank') {
            $metode_payment = 'Transfer Bank';
        } elseif ($metode_payment == 'kartu_kredit') {
            $metode_payment = 'Kartu Kredit';
        }
        
        Booking::create([
            'id_user'           => Auth::id(), // Gunakan Auth::id() lebih singkat
            'id_hotel'          => $request->id_hotel,
            'id_kamar'          => $request->id_kamar,
            'nama_tamu'         => $request->nama_tamu,
            'email_tamu'        => $request->email_tamu,
            'no_telepon'        => $request->no_telepon,
            'no_identitas'      => $request->no_identitas,
            'tgl_checkin'       => $request->tgl_checkin,
            'tgl_checkout'      => $request->tgl_checkout,
            'total_malam'       => $total_malam,
            'total_tamu'        => $request->total_tamu,
            'jumlah_kamar'      => $request->jumlah_kamar,
            'permintaan_khusus' => $request->permintaan_khusus, 
            'catatan'           => $request->catatan,
            'metode_payment'    => $metode_payment, // PERBAIKAN: Pakai variabel yang sudah dikonversi
            'total_harga'       => $total_harga,
            'bukti_payment'     => $nama_file, 
            'status'            => 'Menunggu Konfirmasi', 
        ]);

        return redirect()->route('booking.success')->with('success', 'Booking dan pembayaran berhasil dikirim!');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Disetujui,Ditolak'
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status berhasil diubah!');
    }

    // PERBAIKAN: Hapus fungsi index() yang dobel/kosong, gunakan adminDashboard
    public function adminDashboard()
    {
        $booking = Booking::with(['hotel', 'kamar'])->orderBy('created_at', 'desc')->get(); 
        $total_hotels = Hotel::count(); 
        
        return view('admin.dashboard', compact('booking', 'total_hotels'));
    }
}