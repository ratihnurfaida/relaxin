<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking';
    protected $primaryKey = 'id_booking';
    protected $fillable = [
    'id_user',
    'id_kamar',
    'id_hotel',
    // --- Tambahkan field ini ---
    'nama_tamu',
    'email_tamu',
    'no_telepon',
    'no_identitas',
    // ---------------------------
    'tgl_checkin',
    'tgl_checkout',
    'total_malam',
    'total_tamu',
    'jumlah_kamar',
    'permintaan_khusus',
    'catatan',
    'metode_payment',
    'total_harga',
    'bukti_payment',
    'status'
];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'id_kamar', 'id_kamar');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel', 'id_hotel');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
     public function payment()
    {
        return $this->hasOne(Payment::class, 'id_booking');
    }
}
