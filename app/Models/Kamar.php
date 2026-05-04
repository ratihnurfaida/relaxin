<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $table = 'kamar';
    protected $primarykey = 'id_kamar';
    protected $timstamps = false;

    protected $fillable  = [
        'id_penginapan',
        'kode_kamar',
        'tipe_kamar',
        'kapasitas',
        'harga_3jam',
        'harga_6jam',
        'harga_12jam',
        'total_kamar',
        'gambar',
    ];

    public function penginapan()
    {
        return $this->belongsTo(Penginapan::class, 'id_penginapan', 'id_penginapan');
    }
}
