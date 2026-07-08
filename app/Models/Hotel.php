<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'hotel';
    protected $primaryKey = 'id_hotel';
    protected $casts = [
        'harga' => 'integer',
        'star_rating' => 'integer',
    ];
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
        'id_area',
    ];

    public function kamar()
    {
        return $this->hasMany(Kamar::class, 'id_hotel', 'id_hotel');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'id_area', 'id_area');
    }
}
