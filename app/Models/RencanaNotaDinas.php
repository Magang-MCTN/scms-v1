<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaNotaDinas extends Model
{
    protected $table = 'tabel_nota_dinas_user';
    protected $primaryKey = 'Nomor_ND_PPBJ';

    protected $fillable = [
        'ID_Kota',
        'Judul',
        'Tanggal',
        'Sifat',
        'ID_Tujuan',
        'Perihal',
        'ID_Sumber_Anggaran',
        'Nomor_PRK',
        'ID_Pegawai',
        'pengadaan_ID_Pengadaan',
        'ID_RAB ',
    ];

    public function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class, 'pengadaan_ID_Pengadaan');
    }
}
