<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPengadaan extends Model
{
    protected $table = 'tabel_jenis_pengadaan';
    protected $primaryKey = 'ID_Jenis_Pengadaan';

    protected $fillable = [
        'Jenis_Pengadaan',
    ];

}
