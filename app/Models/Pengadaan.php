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
        'ID_Sumber_Anggaran',
        'id_pejabat_user_tingkat_3',
        'id_pejabat_user_tingkat_2',
        'id_pejabat_user_tingkat_1',
        'id_admin_rendan',
        'id_status',
        'id_status_rab',
        'id_status_justifikasi',
        'id_status_nota_dinas_permintaan',
        'id_status_nota_dinas_pelaksanaan',
        'id_status_hpe',
        'id_status_rks',
        'id_status_ringkasan_rks',
        'id_status_dokumen_kualifikasi',
        'checklist_hpe',
        'checklist_rks',
        'checklist_ringkasan_rks',
        'checklist_dokumen_kualifikasi',
        'alasan_rab',
        'alasan_justifikasi',
        'alasan_nota_dinas_permintaan',
        'alasan_nota_dinas_pelaksanaan',
        'rencana_tanggal_terkontrak_mulai',
        'rencana_tanggal_terkontrak_selesai',
        'rencana_durasi_kontrak',
        'rencana_durasi_kontrak_tanggal',
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
    return $this->hasOne(RencanaNotaDinas::class, 'ID_Pengadaan');
}

    public function sumberAnggaran()
    {
        return $this->hasMany(SumberAnggaran::class, 'ID_Sumber_Anggaran');
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
public function statusHPE()
{
    return $this->belongsTo(Status::class, 'id_status_hpe');
}
public function statusRKS()
{
    return $this->belongsTo(Status::class, 'id_status_rks');
}
public function statusRingkasanRKS()
{
    return $this->belongsTo(Status::class, 'id_status_ringkasan_rks');
}
public function statusDokumenKualifikasi()
{
    return $this->belongsTo(Status::class, 'id_status_dokumen_kualifikasi');
}


    public function barang()
    {
        return $this->hasMany(Barang::class, 'ID_Pengadaan', 'ID_Pengadaan');
    }

}
