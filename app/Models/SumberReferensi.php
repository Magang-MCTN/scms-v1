<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberReferensi extends Model
{
    use HasFactory;
    protected $table = 'tabel_sumber_referensi';
    protected $primaryKey = 'ID_Sumber_Referensi';

    protected $fillable = [
        'checklist_1',
        'checklist_2',
        'checklist_3',
        'checklist_4',
        'checklist_5',
        'checklist_6',
        'checklist_7',
        'checklist_8',
        'checklist_9',
    ];
}
