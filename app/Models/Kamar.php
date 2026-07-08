<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Hotel;
use App\Models\Booking;

class Kamar extends Model
{
    protected $table = 'kamar';
    protected $primaryKey = 'id_kamar';
    protected $timstamps = false;

    protected $fillable  = [
        'id_kamar',
        'id_hotel',
        'kode_kamar',
        'tipe_kamar',
        'tipe_bed',
        'kapasitas',
        'harga_per_kamar',
        'total_kamar',
        'gambar',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel', 'id_hotel');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'id_kamar', 'id_kamar');
    }
}
