<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    // Menghubungkan ke nama tabel 'area' di phpMyAdmin
    protected $table = 'area';

    // Menentukan primary key asli tabel area
    protected $primaryKey = 'id_area';

    protected $fillable = ['name'];

    // Relasi ke tabel Hotel
    public function hotels()
    {
        return $this->hasMany(Hotel::class, 'id_area', 'id_area');
    }
}