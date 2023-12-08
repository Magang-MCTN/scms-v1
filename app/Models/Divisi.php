<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $table = 'tabel_divisi';
    protected $primaryKey = 'id_divisi';
    protected $fillable = [

        'nama_divisi',
        'keterangan_divisi',
    ];

    public function divisiUser()
    {
        return $this->belongsTo(User::class, 'id_divisi', 'id_divisi');
    }

}
