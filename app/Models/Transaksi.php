<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'tabel_transaksi';
    protected $primaryKey = 'ID_Transaksi';

    protected $fillable = [
        'estimasi_jumlah',
        'Unit',
        'Harga',
        'Total',
        'total_keseluruhan',
    ];

    public function rab()
    {
        return $this->hasMany(rab::class,'ID_Transaksi');
    }
    public function barang()
    {
        return $this->hasMany(Barang::class, 'ID_Transaksi');
    }
}
