<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberAnggaran extends Model
{
    use HasFactory;
    protected $table = 'tabel_sumber_anggaran';
    protected $primaryKey = 'ID_Sumber_Anggaran';

    protected $fillable = [
        'nama_anggaran',
    ];
}
