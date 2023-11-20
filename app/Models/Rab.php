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
        'Tanggal',
        'ID_Barang',
        'ID_Transaksi',
        'pengadaan_ID_Pengadaan',
    ];

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'ID_Kota');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'ID_Barang');
    }
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'ID_Transaksi');
    }

    public function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class, 'pengadaan_ID_Pengadaan');
    }
}
