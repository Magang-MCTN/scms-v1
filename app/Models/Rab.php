<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rab extends Model
{
    protected $table = 'tabel_rencana_anggaran_biaya';
    protected $primaryKey = 'ID_RAB';

    protected $fillable = [
        'ID_Kota',
        'tanggal',
        'ID_Barang',
        'ID_Pengadaan',
        'total_keseluruhan',
        'nama_user_1',
        'jabatan_user_1',
    ];

    public function kota()
    {
        return $this->hasMany(Kota::class, 'ID_Kota');
    }

    public function barang()
    {
        return $this->belongsToMany(Barang::class, 'tabel_barang_rab', 'ID_RAB', 'ID_Barang');
    }

    public function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class, 'ID_Pengadaan');
    }

    public function status(){
        return $this->belongsTo(Status::class,'id_status');
    }
}
