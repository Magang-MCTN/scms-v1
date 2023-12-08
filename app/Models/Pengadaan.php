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
        'id_status_rab',
        'id_status_justifikasi',
        'id_status_nota_dinas_permintaan',
        'id_status_nota_dinas_pelaksanaan',
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
        return $this->hasOne(Rab::class, 'ID_Pengadaan');
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

    public function statusRab()
{
    return $this->belongsTo(Status::class, 'id_status_rab');
}

public function statusJustifikasi()
{
    return $this->belongsTo(Status::class, 'id_status_justifikasi');
}
public function statusNotaDinasPermintaan()
{
    return $this->belongsTo(Status::class, 'id_status_nota_dinas_permintaan');
}
public function statusNotaDinasPelaksanaan()
{
    return $this->belongsTo(Status::class, 'id_status_nota_dinas_pelaksanaan');
}


    public function barang()
    {
        return $this->hasMany(Barang::class, 'ID_Pengadaan', 'ID_Pengadaan');
    }

}
