<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodeEvaluasiPenawaran extends Model
{
    use HasFactory;
    protected $table = 'tabel_sistem_evaluasi_penawaran';
    protected $primaryKey = 'ID_Metode_Evaluasi_Penawaran';

    protected $fillable = [
        'Metode_Evaluasi_Penawaran',
    ];
}
