<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'tabel_barang';
    protected $primaryKey = 'ID_Barang';

    protected $fillable = [
        'ID_Pengadaan',
        'Kode_Barang',
        'Nama_Barang',
        'Deskripsi',
        'Keterangan',
        'estimasi_jumlah',
        'Unit',
        'Harga',
        'Total',
        'total_keseluruhan',
    ];

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'ID_Barang', 'ID_Barang');
    }

    public function rab()
    {
        return $this->belongsToMany(Rab::class, 'tabel_barang_rab', 'ID_Barang', 'ID_RAB');
    }

    public function pengadaan()
    {
        return $this->hasMany(Pengadaan::class, 'ID_Pengadaan', 'ID_Pengadaan');
    }
}
