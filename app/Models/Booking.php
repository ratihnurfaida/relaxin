<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking';
    protected $primaryKey = 'id_booking';
    protected $fillable = [
        'id_pelanggan',
        'id_kamar',
        'tgl_checkin',
        'tgl_checkout',
        'total_malam',
        'total_tamu',
        'jumlah_kamar',
        'total_harga',
        'status'
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'id_kamar', 'id_kamar');
    }
}
