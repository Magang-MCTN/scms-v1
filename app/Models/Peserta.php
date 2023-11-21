<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'tabel_peserta';
    protected $primaryKey = 'ID_Peserta';

    protected $fillable = [
        'ID_Vendor',
        'Nama_Peserta',
        'jabatan',
        'Alamat_Peserta',
        'Email_Peserta',
        'Nomor_Kontak_Peserta',
        'signature',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'ID_Vendor', 'ID_Vendor');
    }
}
