<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HPE extends Model
{
    use HasFactory;
    protected $table = 'tabel_hpe';
    protected $primaryKey = 'ID_HPE';

    protected $fillable = [
        'ID_Kota',
        'ID_Pengadaan',
        'ID_Sumber_Referensi',
        'Tanggal',
        'HPE',
        'attachment_file',
        'nama_pejabat_rendan',
        'jabatan_pejabat_rendan',
        'tanda_tangan_pejabat_rendan',
    ];

    public function kota()
    {
        return $this->hasMany(Kota::class, 'ID_Kota');
    }

    public function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class, 'ID_Pengadaan');
    }

    public function sumberReferensi()
    {
        return $this->belongsTo(SumberReferensi::class, 'ID_Sumber_Referensi');
    }
}
