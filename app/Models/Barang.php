<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'tabel_barang';
    protected $primaryKey = 'ID_Barang';

    protected $fillable = [
        'Kode_Barang',
        'Nama_Barang',
        'ID_Transaksi',
        'Deskripsi',
        'Keterangan',
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'ID_Transaksi');
    }

    public function rab()
    {
        return $this->hasMany(rab::class,'ID_Barang');
    }
}
