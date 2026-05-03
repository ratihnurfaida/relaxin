<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'hotel';
    protected $primarykey = 'id_hotel';
    protected $timstamps = false;

    protected $fillable  = [
        'nama',
        'kota',
        'alamat',
        'deskripsi',
        'star_rating',
        'gambar',
    ];

    puyblic function kamar()
    {
        return $this->hasMany(Kamar::class, 'id_hotel', 'id_hotel');
    }
}
