<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kualifikasi extends Model
{
    protected $table = 'nama_tabel_kualifikasi';
    protected $primaryKey = 'ID_Kualifikasi';

    protected $fillable = [
        'Kualifikasi_Pengadaan',
    ];
}
