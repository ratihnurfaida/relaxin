<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'hotel';
    protected $primaryKey = 'id_hotel';
    public  $timestamps = false;

    protected $fillable  = [
        'nama',
        'kota',
        'alamat',
        'deskripsi',
        'star_rating',
        'harga',
        'fasilitas',
        'gambar',
    ];

    public function kamar()
    {
        return $this->hasMany(Kamar::class, 'id_hotel', 'id_hotel');
    }
}
