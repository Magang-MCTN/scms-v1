<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RingkasanRKS extends Model
{
    use HasFactory;
    protected $table = 'tabel_ringkasan_rks';
    protected $primaryKey = 'ID_Ringkasan_Rks';

    protected $fillable = [
        'ID_Pengadaan',
        'ID_Kota',
        'Nomor_Rks',
        'Tanggal_Pengambilan_Rks_Mulai',
        'Tanggal_Pengambilan_Rks_Selesai',
        'Waktu_Pengambilan_Rks_Mulai',
        'Waktu_Pengambilan_Rks_Selesai',
        'Lokasi_Pengambilan_Rks',
        'Tanggal',
        'Status_Rks',
        'ID_Metode_Pengadaan',
        'ID_Metode_Penawaran',
        'Kualifikasi_Pengadaan',
        'Kualifikasi_CSMS',
        'ID_Metode_Evaluasi_Penawaran',
        'Target_Selesai_Rks',
        'Info_Tambahan',
        'Tanggal_Rks',
        'Kualifikasi_Peserta_Pengadaan',
        'url_rks',
        'ID_Klasifikasi',
        'nama_user_1',
        'tanda_tangan_user_1',
        'nama_rendan_1',
        'tanda_tangan_rendan_1',
        'tanggal_pengajuan',
    ];

    public function kota()
    {
        return $this->hasMany(Kota::class, 'ID_Kota');
    }

    public function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class, 'ID_Pengadaan');
    }

    public function metodePengadaan()
    {
        return $this->hasMany(MetodePengadaan::class, 'ID_Metode_Pengadaan');
    }

    public function metodePenawaran()
    {
        return $this->hasMany(MetodePenawaran::class, 'ID_Metode_Penawaran');
    }

    public function metodeEvaluasiPenawaran()
    {
        return $this->hasMany(MetodeEvaluasiPenawaran::class, 'ID_Metode_Evaluasi_Penawaran');
    }

    public function klasifikasiBaku()
    {
        return $this->hasMany(KlasifikasiBaku::class, 'ID_Klasifikasi');
    }
}
