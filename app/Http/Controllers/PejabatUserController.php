<?php

namespace App\Http\Controllers;

use App\Models\Pengadaan;
use App\Models\Rab;
use App\Models\Status;
use Illuminate\Http\Request;

class PejabatUserController extends Controller
{
    public function index()
    {
        $pengadaanst = Pengadaan::with('status')->get(['Judul_Pengadaan', 'id_status']);
        $statusData = Status::all();
        $pengadaan = Pengadaan::with(['metodePengadaan', 'sistemEvaluasiPenawaran', 'jenisPengadaan'])->get();

        $dokumenList = ['Rencana Anggaran Biaya', 'Justifikasi Penunjukan Langsung','Nota Dinas Permintaan Pengadaan'];
        $dokumen_checked = [];
    
        foreach ($pengadaan as $p) {
            foreach ($dokumenList as $d) {
                $dokumen_checked[$p->ID_Pengadaan][$d] = $p->{'checklist_' . strtolower(str_replace(' ', '_', $d))};
            }
        }
        return view('pejabatuser.index',compact('pengadaan', 'dokumen_checked', 'pengadaanst', 'statusData'));
    }

    public function detail($ID_Pengadaan, ...$dokumen)
    {
        $pengadaans = Pengadaan::findOrFail($ID_Pengadaan);
        $rab = Rab::where('ID_Pengadaan', $ID_Pengadaan)->first();
        $dokumenList = ['Rencana Anggaran Biaya', 'Justifikasi Penunjukan Langsung','Nota Dinas Permintaan Pengadaan'];
        $dokumen_checked = [];

        foreach ($dokumenList as $d) {
            $dokumen_checked[$d] = $pengadaans->{'checklist_' . strtolower(str_replace(' ', '_', $d))};
        }

        $statusData = Status::all();
        $status = $pengadaans->status;
        $statusRab = $pengadaans->statusRab;
        $statusJustifikasi = $pengadaans->statusJustifikasi;
        $statusNotaDinasPermintaan = $pengadaans->statusNotaDinasPermintaan;

        return view('pejabatuser.detail', compact('pengadaans','rab', 'dokumen_checked', 'dokumen','statusData','status', 'statusRab','statusJustifikasi','statusNotaDinasPermintaan'));

    }
}
