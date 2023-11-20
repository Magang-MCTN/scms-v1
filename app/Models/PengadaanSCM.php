<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengadaanScm extends Model
{
    protected $table = 'pengadaan_scm';
    protected $fillable = [
        'nomor_pengadaan',
        'tujuan',
        'nama_pekerjaan',
        'ringkasan_pekerjaan',
        'nama_pengguna',
        'divisi_pengguna',
        'jenis_pengadaan',
        'informasi_anggaran',
        'sumber_anggaran',
        'pagu_anggaran',
        'cost_center',
        'rencana_tanggal_terkontrak_mulai',
        'rencana_tanggal_terkontrak_selesai',
        'rencana_durasi_kontrak',
        'rencana_durasi_kontrak_tanggal',
        'url_kak',
        'url_spesifikasi_teknis',
        'id_user',
        'perihal',
        'judul_pengadaan',
        'status',
        'alasan',
        'pengadaan_ID_Pengadaan',
        'ID_Vendor',
    ];

    public function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class, 'ID_Pengadaan');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'ID_Vendor');
    }
}
