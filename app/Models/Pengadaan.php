<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    protected $table = 'tabel_pengadaan';
    protected $primaryKey = 'ID_Pengadaan';

    protected $fillable = [
        'No_Pengadaan',
        'Judul_Pengadaan',
        'Ringkasan_Pekerjaan',
        'ID_Metode_Pengadaan',
        'ID_Sistem_Evaluasi_Penawaran',
        'ID_Jenis_Pengadaan',
        'id_status',
    ];

    public function metodePengadaan()
    {
        return $this->hasMany(MetodePengadaan::class, 'ID_Metode_Pengadaan');
    }

    public function sistemEvaluasiPenawaran()
    {
        return $this->hasMany(SistemEvaluasiPenawaran::class, 'ID_Sistem_Evaluasi_Penawaran');
    }

    public function jenisPengadaan()
    {
        return $this->hasMany(JenisPengadaan::class, 'ID_Jenis_Pengadaan');
    }

    public function rab()
    {
        return $this->hasMany(Rab::class, 'pengadaan_ID_Pengadaan');
    }

    public function justifikasiPenunjukanLangsung()
    {
        return $this->hasMany(JustifikasiPenunjukanLangsung::class, 'pengadaan_ID_Pengadaan');
    }

    public function rencanaNotaDinas()
    {
        return $this->hasMany(RencanaNotaDinas::class, 'pengadaan_ID_Pengadaan');
    }

    public function pelaksanaanNotaDinas()
    {
        return $this->hasMany(PelaksanaanNotaDinas::class, 'pengadaan_ID_Pengadaan');
    }

    public function pengadaanSCM()
    {
        return $this->hasMany(PengadaanScm::class, 'pengadaan_ID_Pengadaan');
    }

    public function status()
{
    return $this->belongsTo(Status::class, 'id_status');
}

    public function barang()
    {
        return $this->hasMany(Barang::class, 'ID_Pengadaan', 'ID_Pengadaan');
    }

}
