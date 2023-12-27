<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaNotaDinas extends Model
{
    protected $table = 'tabel_nota_dinas_user';
    protected $primaryKey = 'id_nota_dinas_permintaan';

    protected $fillable = [
        'Nomor_ND_PPBJ',
        'Nomor_ND_Lakdan',
        'ID_Kota',
        'Tanggal',
        'Nomor_PRK',
        'cost_center',
        'pagu_anggaran',
        'nama_pengguna',
        'divisi_pengguna',
        'nama_user_1',
        'jabatan_user_1',
        'tanda_tangan_user_1',
        'tanda_tangan_user_pelaksanaan',
        'ID_Pengadaan',
        'ID_Jenis_Pengadaan ',
        'url_kak',
        'url_spesifikasi_teknis',
        'tanggal_pengajuan',
        'tanggal_pengajuan_pelaksanaan',
    ];
    public function kota()
    {
        return $this->hasMany(Kota::class, 'ID_Kota');
    }
    public function jenisPengadaan()
    {
        return $this->belongsTo(JenisPengadaan::class, 'ID_Jenis_Pengadaan');
    }
    public function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class, 'ID_Pengadaan');
    }
}
