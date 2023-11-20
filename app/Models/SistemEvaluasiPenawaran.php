<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SistemEvaluasiPenawaran extends Model
{
    protected $table = 'tabel_sistem_evaluasi_penawaran';
    protected $primaryKey = 'ID_Sistem_Evaluasi_Penawaran';

    protected $fillable = [
        'Sistem_Evaluasi_Penawaran_Teknis',
    ];
}
