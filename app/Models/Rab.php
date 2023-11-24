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
        'ID_Transaksi',
        'pengadaan_ID_Pengadaan',
        'id_status',
        'created_at',
        'updated_at',
    ];

    public function kota()
    {
        return $this->hasMany(Kota::class, 'ID_Kota');
    }

    public function barang()
    {
        return $this->hasMany(Barang::class, 'ID_Barang');
    }
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'ID_Transaksi');
    }

    public function pengadaan()
    {
        return $this->hasMany(Pengadaan::class, 'pengadaan_ID_Pengadaan');
    }

    public function status(){
        return $this->hasMany(Status::class,'id_status');
    }
}
