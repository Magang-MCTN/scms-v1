<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangRab extends Model
{
    protected $table = 'tabel_barang_rab';
    protected $primaryKey = 'ID_Barang_Rab';

    protected $fillable = [
        'ID_RAB',
        'ID_Barang',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'ID_Barang');
    }

    public function rab()
    {
        return $this->belongsTo(Rab::class, 'ID_RAB');
    }
}
