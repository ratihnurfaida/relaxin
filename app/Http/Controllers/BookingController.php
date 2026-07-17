<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Kamar;
use App\Models\Hotel;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Tambahkan ini

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
            'permintaan_khusus' => 'nullable|string',
            'catatan'           => 'nullable|string',
            'status'            => 'nullable|string',
        ]);
        
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silahkan login terlebih dahulu.');
        }

        // Menggunakan DB Transaction untuk memastikan data sinkron
        return DB::transaction(function () use ($request) {
            $kamar = Kamar::findOrFail($request->id_kamar);

            // Cek apakah stok mencukupi
            if ($kamar->total_kamar < $request->jumlah_kamar) {
                return back()->with('error', 'Maaf, kamar tidak mencukupi.');
            }

            $tgl_checkin = Carbon::parse($request->tgl_checkin);
            $tgl_checkout = Carbon::parse($request->tgl_checkout);
            $total_malam = $tgl_checkin->diffInDays($tgl_checkout);

            if (!$total_malam || $total_malam <= 0) {
                $total_malam = 1;
            }

            $subtotal    = ($kamar->harga_per_kamar * $total_malam) * $request->jumlah_kamar;
            $pajak       = round($subtotal * 0.1); 
            $total_harga = $subtotal + $pajak;

            $booking = Booking::create([
                'id_user'          => Auth::id(),
                'id_hotel'         => $request->id_hotel,
                'id_kamar'         => $request->id_kamar,
                'nama_tamu'        => $request->nama_tamu,
                'email_tamu'       => $request->email_tamu,
                'no_telepon'       => $request->no_telepon,
                'no_identitas'     => $request->no_identitas,
                'tgl_checkin'      => $request->tgl_checkin,
                'tgl_checkout'     => $request->tgl_checkout,
                'total_malam'      => $total_malam,
                'total_tamu'       => $request->total_tamu,
                'jumlah_kamar'     => $request->jumlah_kamar,
                'total_harga'      => $total_harga,
                'status'           => 'pending', 
            ]);

            if (!$booking) {
                return back()->with('error', 'Gagal memproses reservasi.');
            }

            // PENGURANGAN STOK (total_kamar)
            $kamar->decrement('total_kamar', $request->jumlah_kamar);

            session(['payment_expired_at' => now()->addMinutes(15)->toIso8601String()]);
            return redirect()->route('booking.payment', ['id' => $booking->id_booking]);
        });
    }

    public function showPaymentPage($id) 
    {
        $booking = Booking::findOrFail($id);
        if (now()->greaterThan(session('payment_expired_at', now()))) {
            return redirect()->route('welcome')->with('error', 'Waktu pembayaran habis.');
        }
        return view('pages.booking.payment', compact('booking'));
    }

    public function confirmPayment(Request $request, $id)
    {
        $request->validate([
            'bukti_payment' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'metode_payment' => 'required',
        ]);

        $booking = Booking::findOrFail($id);

        if ($request->hasFile('bukti_payment')) {
            $file = $request->file('bukti_payment');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('bukti_transfer', $nama_file, 'public');

            Payment::create([
                'id_booking'     => $id,
                'bukti_payment'  => $nama_file,
                'metode_payment' => $request->metode_payment,
                'jumlah_bayar'   => $booking->total_harga,
                'status'         => 'pending', 
            ]);

            $booking->update(['status' => 'pending']);
        }

        return redirect()->route('booking.success')->with('success', 'Pembayaran berhasil dikirim!');
    }
        
    public function updateStatus(Request $request, $id) 
    {
        $request->validate([
            'status' => 'required|in:confirmed,Cancelled',
        ]);

        $booking = Booking::where('id_booking', $id)->firstOrFail();
        
        // PENGEMBALIAN STOK jika dibatalkan
        if ($request->status == 'Cancelled' && $booking->status != 'Cancelled') {
            Kamar::where('id_kamar', $booking->id_kamar)->increment('total_kamar', $booking->jumlah_kamar);
        }
        
        $booking->update([
            'status' => $request->status 
        ]);

        $pesan = ($request->status == 'confirmed') ? 'Pesanan berhasil disetujui!' : 'Pesanan berhasil dibatalkan!';
        
        return redirect()->back()->with('success', $pesan);
    }

    public function updateBukti(Request $request, $id)
    {
        // 1. Validasi file baru
        $request->validate([
            'bukti_payment' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Cari data pembayaran berdasarkan id_booking
        $payment = Payment::where('id_booking', $id)->firstOrFail();
        $booking = Booking::findOrFail($id);

        // 3. Hapus file lama dari storage (opsional agar storage tidak penuh)
        if ($payment->bukti_payment && \Illuminate\Support\Facades\Storage::exists('public/bukti_transfer/' . $payment->bukti_payment)) {
            \Illuminate\Support\Facades\Storage::delete('public/bukti_transfer/' . $payment->bukti_payment);
        }

        // 4. Upload file baru
        if ($request->hasFile('bukti_payment')) {
            $file = $request->file('bukti_payment');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('bukti_transfer', $nama_file, 'public');

            // 5. Update data di tabel payment dan status booking
            $payment->update([
                'bukti_payment' => $nama_file,
                'status'        => 'pending', // Reset status agar bisa dicek ulang admin
            ]);

            $booking->update(['status' => 'pending']);
        }

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diunggah ulang.');
    }

    public function index()
    {
        $bookings = Booking::where('status', '!=', 'selesai')
                        ->orderBy('created_at', 'desc')
                        ->get();
                        
        return view('admin.dashboard', compact('bookings'));
    }

    public function archive(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        $booking->update([
            'status' => 'selesai'
        ]);

        return redirect()->back()->with('success', 'Transaksi telah diarsipkan.');
    }
}