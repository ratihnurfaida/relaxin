<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penginapan extends Model
{
    protected $table = 'penginapan';
    protected $primarykey = 'id_penginapan';
    protected $timstamps = false;

    protected $fillable  = [
        'nama',
        'kota',
        'alamat',
        'deskripsi',
        'star_rating',
        'gambar',
    ];

    public function kamar()
    {
        return $this->hasMany(Kamar::class, 'id_penginapan', 'id_penginapan');
    }
}
