<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenKualifikasi extends Model
{
    use HasFactory;
    protected $table = 'tabel_dokumen_kualifikasi';

    protected $primaryKey = 'ID_Dokumen_Kualifikasi';

    protected $fillable = [
        'ID_Pengadaan',
        'dokumen_kualifikasi',
    ];

    public function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class, 'ID_Pengadaan');
    }
}
