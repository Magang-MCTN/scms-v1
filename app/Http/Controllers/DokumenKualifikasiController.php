<?php

namespace App\Http\Controllers;

use App\Models\DokumenKualifikasi;
use App\Models\Pengadaan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Dompdf\Options;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;

class DokumenKualifikasiController extends Controller
{
    public function index($ID_Pengadaan)
    {
        $pengadaan = Pengadaan::findorfail($ID_Pengadaan);

        return view('dokumen.index', compact('pengadaan'));
    }

    public function store(Request $request, $ID_Pengadaan)
    {
        $validatedData = $request->validate([
            'dokumen_kualifikasi' => "required|url"
    ]);
    $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
    $pengadaan->update(['id_status_dokumen_kualifikasi' => 4]);
    $pengadaan->update(['id_status' => 16]);

    $dokumenKualifikasi = DokumenKualifikasi::create([
        'ID_Pengadaan' => $ID_Pengadaan,
        'dokumen_kualifikasi' => $request->input('dokumen_kualifikasi'),
    ]);
    $dokumenKualifikasi->save();

    $dokumens = DokumenKualifikasi::where('ID_Pengadaan', $ID_Pengadaan)->first();
    $tanggalPengajuan = Carbon::now('Asia/Jakarta');
    $dokumens->tanggal_pengajuan = $tanggalPengajuan;
    $dokumens->save();

        return redirect()->route('adminrendan.detail', ['ID_Pengadaan' => $ID_Pengadaan])->with('success', 'Data Dokumen Kualifikasi berhasil disimpan');
    }

    public function preview($ID_Pengadaan, $ID_Dokumen_Kualifikasi)
    {
        $dokumen = DokumenKualifikasi::where('ID_Pengadaan', $ID_Pengadaan)->where('ID_Dokumen_Kualifikasi', $ID_Dokumen_Kualifikasi)->first();

        if (!$dokumen) {
        abort(404);
        }

        $urlDokumen = $dokumen->dokumen_kualifikasi;

        return redirect($urlDokumen);
    }
}
