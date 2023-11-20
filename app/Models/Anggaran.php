<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggaran extends Model
{
    protected $table = 'tabel_anggaran';
    protected $primaryKey = 'ID_Anggaran';

    protected $fillable = [
        'Nomor_PRK',
        'Cost_Center',
        'Pagu_Anggaran',
    ];
}
