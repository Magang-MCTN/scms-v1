<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JustifikasiPenunjukanLangsung extends Model
{
    protected $table = 'tabel_justifikasi_penunjukkan_langsung';
    protected $primaryKey = 'ID_JPL';

    protected $fillable = [
        'ID_Kota',
        'pengadaan_ID_Pengadaan',
        'Tanggal',
        'Nomor_PRK',
        'ID_Peserta',
        'Rincian_Status_Kondisi',
        'Rincian_Alasan_Metode',
        'Rincian_Kriteria_Peserta',
    ];

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'ID_Kota');
    }

    public function anggaran()
    {
        return $this->belongsTo(Anggaran::class, 'Nomor_PRK');
    }

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'ID_Peserta');
    }

    public function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class, 'pengadaan_ID_Pengadaan');
    }
}
