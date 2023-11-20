<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $table = 'tabel_kota';
    protected $primaryKey = 'ID_Kota';

    protected $fillable = [
        'Kota',
    ];
}
