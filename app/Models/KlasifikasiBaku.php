<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlasifikasiBaku extends Model
{
    use HasFactory;
    protected $table = 'tabel_klasifikasi_baku';
    protected $primaryKey = 'ID_Klasifikasi';

    protected $fillable = [
        'Nomor_Klasifikasi',
        'Nama_Klasifikasi',
    ];
}
