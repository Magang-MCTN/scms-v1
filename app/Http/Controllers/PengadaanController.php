<?php

namespace App\Http\Controllers;

use App\Models\BarangRab;
use App\Models\JustifikasiPenunjukanLangsung;
use App\Models\Pengadaan;
use App\Models\Rab;
use App\Models\RencanaNotaDinas;
use App\Models\Status;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PengadaanController extends Controller
{
    public function index()
    {
        $pengadaan = Pengadaan::with(['metodePengadaan', 'sistemEvaluasiPenawaran', 'jenisPengadaan'])->get();

        $dokumenList = ['Rencana Anggaran Biaya', 'Justifikasi Penunjukan Langsung','Nota Dinas Permintaan Pengadaan','Nota Dinas Permintaan Pelaksanaan Pengadaan'];
        $dokumen_checked = [];
    
        foreach ($pengadaan as $p) {
            foreach ($dokumenList as $d) {
                $dokumen_checked[$p->ID_Pengadaan][$d] = $p->{'checklist_' . strtolower(str_replace(' ', '_', $d))};
            }
        }

        return view('pengadaan.index', compact('pengadaan', 'dokumen_checked'));
    }

    public function create()
    {
        return view('pengadaan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'No_Pengadaan' ,
            'Judul_Pengadaan' => 'required',
            'Ringkasan_Pekerjaan',
            'ID_Metode_Pengadaan',
            'ID_Sistem_Evaluasi_Penawaran',
            'ID_Jenis_Pengadaan',
            'checklist_nota_dinas_permintaan_pengadaan',
        'checklist_nota_dinas_permintaan_pelaksanaan_pengadaan',
        'checklist_rencana_anggaran_biaya',
        'checklist_justifikasi_penunjukan_langsung',
        'id_status',
        'id_status_rab',
        'id_status_justifikasi',
        'id_status_nota_dinas_permintaan',
        'id_status_nota_dinas_pelaksanaan',
    ]);

    $pengadaan = new Pengadaan;
    $pengadaan->Judul_Pengadaan = $validatedData['Judul_Pengadaan'];
    $pengadaan->checklist_nota_dinas_permintaan_pengadaan = $request->has('checklist_nota_dinas_permintaan_pengadaan') ? 1 : 0;
    $pengadaan->checklist_nota_dinas_permintaan_pelaksanaan_pengadaan = $request->has('checklist_nota_dinas_permintaan_pelaksanaan_pengadaan') ? 1 : 0;
    $pengadaan->checklist_rencana_anggaran_biaya = $request->has('checklist_rencana_anggaran_biaya') ? 1 : 0;
    $pengadaan->checklist_justifikasi_penunjukan_langsung = $request->has('checklist_justifikasi_penunjukan_langsung') ? 1 : 0;
    $pengadaan->id_status = 6;
    $pengadaan->id_status_rab = 6;
    $pengadaan->id_status_justifikasi = 6;
    $pengadaan->id_status_nota_dinas_permintaan = 6;
    $pengadaan->id_status_nota_dinas_pelaksanaan = 6;
    $pengadaan->save();

        return redirect()->route('pengadaan.index')->with('success', 'Data pengadaan berhasil disimpan');
    }

    public function status(Request $request)
    {
        $selectedStatus = $request->input('status', 'semua');
        $searchKeyword = $request->input('search');

        $query = Pengadaan::query();

        if ($selectedStatus !== 'semua') {
            $query->where('status', $selectedStatus);
        }

        if ($searchKeyword) {
            $query->where('tujuan', 'like', '%' . $searchKeyword . '%');
        }

        // Hanya menampilkan pengadaan barang yang diajukan oleh pengguna yang sedang login.
        $query->where('id_user', auth()->user()->id_user);

        $query = Pengadaan::query();
        $pengadaan = $query->get();
        $id_user = auth()->user()->id_user;
        $pengadaan->id_user = $id_user;
        $pengadaanUser = Pengadaan::where('id_user', $id_user)->get();


        return view('pengadaan.status', compact('pengadaan', 'selectedStatus', 'pengadaanUser', 'searchKeyword'));
    }
    public function detail($ID_Pengadaan, ...$dokumen)
    {
        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $rab = Rab::where('ID_Pengadaan', $ID_Pengadaan)->first();
        $justifikasi = JustifikasiPenunjukanLangsung::where('ID_Pengadaan', $ID_Pengadaan)->first();
        $notaDinasPermintaan = RencanaNotaDinas::where('ID_Pengadaan', $ID_Pengadaan)->first();
        $dokumenList = ['Rencana Anggaran Biaya', 'Justifikasi Penunjukan Langsung','Nota Dinas Permintaan Pengadaan','Nota Dinas Permintaan Pelaksanaan Pengadaan'];
        $dokumen_checked = [];

        foreach ($dokumenList as $d) {
            $dokumen_checked[$d] = $pengadaan->{'checklist_' . strtolower(str_replace(' ', '_', $d))};
        }

    
    $statusData = Status::all();
    $status = $pengadaan->status;
    $statusRab = $pengadaan->statusRab;
    $statusJustifikasi = $pengadaan->statusJustifikasi;
    $statusNotaDinasPermintaan = $pengadaan->statusNotaDinasPermintaan;
    $statusNotaDinasPelaksanaan = $pengadaan->statusNotaDinasPelaksanaan;

        return view('pengadaan.detail', compact('pengadaan','rab','justifikasi', 'notaDinasPermintaan','dokumen_checked', 'dokumen','statusData','status', 'statusRab','statusJustifikasi','statusNotaDinasPermintaan','statusNotaDinasPelaksanaan'));

    }

    public function edit($ID_Pengadaan)
    {
        $pengadaan = Pengadaan::find($ID_Pengadaan);

        return view('pengadaan.edit', compact('pengadaan'));
    }

    public function update(Request $request, $ID_Pengadaan)
{
    $validatedData = $request->validate([
        'Judul_Pengadaan' => 'required',
        'checklist_nota_dinas_permintaan_pengadaan',
        'checklist_nota_dinas_permintaan_pelaksanaan_pengadaan',
        'checklist_rencana_anggaran_biaya',
        'checklist_justifikasi_penunjukan_langsung',
        // 'id_status' => 7,
    ]);

    $pengadaan = Pengadaan::find($ID_Pengadaan);

    $pengadaan->Judul_Pengadaan = $validatedData['Judul_Pengadaan'];
    $pengadaan->checklist_nota_dinas_permintaan_pengadaan = $request->has('checklist_nota_dinas_permintaan_pengadaan') ? 1 : 0;
    $pengadaan->checklist_nota_dinas_permintaan_pelaksanaan_pengadaan = $request->has('checklist_nota_dinas_permintaan_pelaksanaan_pengadaan') ? 1 : 0;
    $pengadaan->checklist_rencana_anggaran_biaya = $request->has('checklist_rencana_anggaran_biaya') ? 1 : 0;
    $pengadaan->checklist_justifikasi_penunjukan_langsung = $request->has('checklist_justifikasi_penunjukan_langsung') ? 1 : 0;
    // $pengadaan->id_status = 7;
    $pengadaan->save();

    return redirect()->route('pengadaan.index')->with('success', 'Data pengadaan berhasil diperbarui');
}


public function delete($ID_Pengadaan)
{

    $pengadaan = Pengadaan::find($ID_Pengadaan);

    if (!$pengadaan) {
        return redirect()->route('pengadaan.index', compact('pengadaan'))->with('error', 'Data pengadaan tidak ditemukan');
    }

    $pengadaan->delete();

    return redirect()->route('pengadaan.index',  compact('pengadaan'))->with('success', 'Data pengadaan berhasil dihapus');
}

}
