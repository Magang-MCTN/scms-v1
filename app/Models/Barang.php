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
        // 'ID_Baran',
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
        return $this->hasMany(Transaksi::class, 'ID_Barang');
    }

    public function rab()
    {
        return $this->hasMany(rab::class,'ID_Barang');
    }

    public function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class, 'ID_Pengadaan', 'ID_Pengadaan');
    }
}
