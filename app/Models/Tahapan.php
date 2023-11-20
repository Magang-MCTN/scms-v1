<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahapan extends Model
{
    protected $table = 'tabel_tahapan';
    protected $primaryKey = 'ID_Tahapan';

    protected $fillable = [
        'Tahapan',
    ];
}
