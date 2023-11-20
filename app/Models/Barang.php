<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'tabel_barang';
    protected $primaryKey = 'ID_Barang';

    protected $fillable = [
        'Nama_Barang',
        'Kode_Barang',
        'qty',
        'ID_Transaksi',
        'Deskripsi',
        'Keterangan',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'ID_Transaksi');
    }

    public function rab()
    {
        return $this->belongsTo(rab::class,'ID_RAB');
    }
}
