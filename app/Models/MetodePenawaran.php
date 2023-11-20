<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePenawaran extends Model
{
    protected $table = 'tabel_metode_penawaran';
    protected $primaryKey = 'ID_Metode_Penawaran';

    protected $fillable = [
        'Metode_Penawaran',
    ];
}
