<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'tabel_transaksi';
    protected $primaryKey = 'ID_Transaksi';

    protected $fillable = [
        'Unit',
        'Harga',
        'Total',
    ];
}
