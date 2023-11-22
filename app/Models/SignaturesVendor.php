<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignaturesVendor extends Model
{
    use HasFactory;
    protected $table = 'signatures-vendor';
    protected $primaryKey = 'id_signatures';

    protected $fillable = [
        'signatures',
    ];

    public function vendor()
    {
        return $this->hasMany(Vendor::class, 'id_signatures', 'id_signatures');
    }

    // Model SignaturesVendor
        public function vendorSignatures()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor', 'id_vendor');
    }


    public function tabelPeserta(){
        return $this->hasMany(Peserta::class,'id_signatures', 'id_signatures');
    }
}
