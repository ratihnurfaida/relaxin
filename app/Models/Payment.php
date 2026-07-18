<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';
    protected $primaryKey = 'payment';
    protected $fillable = [
        'id_booking',
        'metode_payment',
        'jumlah_bayar',
        'bukti_payment',
        'status',
        'alasan_penolakan'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'id_booking', 'id_booking');
    }
}