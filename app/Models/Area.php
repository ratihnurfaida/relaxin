<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'area';

    protected $primaryKey = 'id_area';

    protected $fillable = ['name'];

    public function hotels()
    {
        return $this->hasMany(Hotel::class, 'id_area', 'id_area');
    }
}