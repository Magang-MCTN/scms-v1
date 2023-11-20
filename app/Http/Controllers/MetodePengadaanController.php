<?php

namespace App\Http\Controllers;

use App\Models\MetodePengadaan;
use Illuminate\Http\Request;

class MetodePengadaanController extends Controller
{
    public function index()
    {
        $metodePengadaan = MetodePengadaan::with(['kualifikasi', 'metodePenawaran', 'tahapan'])->get();
        return view('metode_pengadaan.index', compact('metodePengadaan'));
    }
}
