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
        'ID_Pengadaan',
        'ID_Jenis_Pengadaan',
        'ID_Kriteria',
        'Tanggal',
        'pagu_anggaran',
        'nama_perusahaan',
        'nama_user_1',
        'jabatan_user_1',
        'tanda_tangan_user_1',
        'Rincian_Status_Kondisi',
        'Rincian_Alasan_Metode',
        'Rincian_Kriteria_Peserta',
        'Rincian_Kriteria_Peserta_Komersial',
        'Rincian_Kriteria_Peserta_Lainnya',
    ];

    public function kota()
    {
        return $this->hasMany(Kota::class, 'ID_Kota');
    }

    public function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class, 'ID_Pengadaan');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'ID_Kriteria');
    }
}
