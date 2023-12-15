<?php

namespace App\Http\Controllers;

use App\Models\Pengadaan;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;

class PengadaanRendanController extends Controller
{
    public function index()
    {
        $pengadaanst = Pengadaan::with('status')->get(['Judul_Pengadaan', 'id_status']);
        $statusData = Status::all();
        // $adminRendanOptions = User::where('id_role', 3)->get();
        // $adminRendanUser = !empty($name) ? User::find($name[1]) : null;
        $pengadaan = Pengadaan::with(['metodePengadaan', 'sistemEvaluasiPenawaran', 'jenisPengadaan'])->get();

        $dokumenList = ['Nota Dinas Permintaan Pengadaan', 'HPE', 'RKS', 'Ringkasan RKS', 'Dokumen Kualifikasi'];
        $dokumen_checked = [];
    
        // foreach ($pengadaan as $p) {
        //     foreach ($dokumenList as $d) {
        //         $dokumen_checked[$p->ID_Pengadaan][$d] = $p->{'checklist_' . strtolower(str_replace(' ', '_', $d))};
        //     }
        // }
        return view('adminrendan.index',compact('pengadaan', 'dokumen_checked', 'pengadaanst', 'statusData'));
    }
}
