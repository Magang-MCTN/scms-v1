<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;
    protected $table = 'tabel_kriteria';
    protected $primaryKey = 'ID_Kriteria';

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
        'checklist_10',
        'checklist_11',
        'checklist_12',
        'checklist_13',
        'checklist_14',
        'checklist_15',
        'checklist_16',
        'checklist_17',
        'checklist_18',
        'checklist_19',
        'checklist_20',
        'checklist_21',
        'checklist_22',
        'checklist_23',
        'checklist_24',
        'checklist_25',
        'checklist_26',
        'checklist_27',
        'checklist_28',
        'checklist_29',
        'checklist_30',
        'checklist_31',
    ];
}
