<?php

namespace App\Http\Controllers;

use App\Models\SistemEvaluasiPenawaran;
use Illuminate\Http\Request;

class SistemEvaluasiPenawaranController extends Controller
{
    public function index()
    {
        $sistemEvaluasiPenawaran = SistemEvaluasiPenawaran::all();
        return view('sistem_evaluasi_penawaran.index', compact('sistemEvaluasiPenawaran'));
    }
}
