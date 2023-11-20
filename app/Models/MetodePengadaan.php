<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePengadaan extends Model
{
    protected $table = 'tabel_metode_pengadaan';
    protected $primaryKey = 'ID_Metode_Pengadaan';

    protected $fillable = [
        'Metode_Pengadaan',
    ];

    public function kualifikasi()
    {
        return $this->belongsTo(Kualifikasi::class, 'ID_Kualifikasi', 'ID_Kualifikasi');
    }

    public function metodePenawaran()
    {
        return $this->belongsTo(MetodePenawaran::class, 'ID_Metode_Penawaran', 'ID_Metode_Penawaran');
    }

    public function tahapan()
    {
        return $this->belongsTo(Tahapan::class, 'ID_Tahapan', 'ID_Tahapan');
    }
}
