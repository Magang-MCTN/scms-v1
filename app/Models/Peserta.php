<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'tabel_peserta';
    protected $primaryKey = 'ID_Peserta';

    protected $fillable = [
        'Nama_Peserta',
        'Alamat_Peserta',
        'Email_Peserta',
        'Nomor_Kontak_Peserta',
        'Faks',
        'NPWP',
    ];
}
