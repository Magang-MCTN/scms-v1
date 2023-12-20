<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePengadaan extends Model
{
    protected $table = 'tabel_metode_pengadaan';
    protected $primaryKey = 'ID_Metode_Pengadaan';

    protected $fillable = [
        'Metode_Pengadaan',
    ];

}
