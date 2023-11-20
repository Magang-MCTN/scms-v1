<?php

namespace App\Http\Controllers;

use App\Models\JenisPengadaan;
use Illuminate\Http\Request;

class JenisPengadaanController extends Controller
{
    public function index()
    {
        $jenisPengadaan = JenisPengadaan::all();
        return view('jenis_pengadaan.index', compact('jenisPengadaan'));
    }
}
