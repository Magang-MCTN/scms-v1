<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signatures extends Model
{
    use HasFactory;
    protected $table = 'signatures';
    protected $primaryKey = 'id_signatures';
    protected $fillable = [
        'id_user', 
        'path'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
