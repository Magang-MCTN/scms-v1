<?php

namespace App\Http\Controllers;

use App\Models\HPE;
use App\Models\JenisPengadaan;
use App\Models\JustifikasiPenunjukanLangsung;
use App\Models\Kota;
use App\Models\Kriteria;
use App\Models\Pengadaan;
use App\Models\Rab;
use App\Models\RencanaNotaDinas;
use App\Models\Signatures;
use App\Models\Status;
use App\Models\SumberAnggaran;
use App\Models\SumberReferensi;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Dompdf\Options;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PejabatRendanController extends Controller
{
    public function index()
    {
        $pengadaanst = Pengadaan::with('status')->get(['Judul_Pengadaan', 'id_status']);
        $statusData = Status::all();
        $adminRendanOptions = User::where('id_role', 3)->get();
        $adminRendanUser = !empty($name) ? User::find($name[1]) : null;
        $pengadaan = Pengadaan::with(['metodePengadaan', 'sistemEvaluasiPenawaran', 'jenisPengadaan'])->get();

        $dokumenList = ['Rencana Anggaran Biaya', 'Justifikasi Penunjukan Langsung','Nota Dinas Permintaan Pengadaan'];
        $dokumen_checked = [];
        $dokumenList2 = ['Nota Dinas Permintaan Pengadaan', 'HPE', 'RKS', 'Ringkasan RKS', 'Dokumen Kualifikasi'];
        $dokumen_checked2 = [];
    
        foreach ($pengadaan as $p) {
            foreach ($dokumenList as $d) {
                $dokumen_checked[$p->ID_Pengadaan][$d] = $p->{'checklist_' . strtolower(str_replace(' ', '_', $d))};
            }
        }

        foreach ($pengadaan as $x) {
            foreach ($dokumenList2 as $y) {
                $dokumen_checked2[$x->ID_Pengadaan][$y] = $x->{'checklist_' . strtolower(str_replace(' ', '_', $y))};
            }
        }
        return view('pejabatrendan.index',compact('pengadaan','adminRendanOptions','adminRendanUser','dokumenList','dokumenList2', 'dokumen_checked', 'dokumen_checked2', 'pengadaanst', 'statusData'));
    }

    public function detailPekerjaan($ID_Pengadaan, ...$dokumen)
    {
        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $hpe = HPE::where('ID_Pengadaan', $ID_Pengadaan)->first();
        // $rks = HPE::where('ID_Pengadaan', $ID_Pengadaan)->first();
        // $ringkasanRKS = HPE::where('ID_Pengadaan', $ID_Pengadaan)->first();
        // $dokumenKualifikasi = HPE::where('ID_Pengadaan', $ID_Pengadaan)->first();
        $notaDinasPermintaan = RencanaNotaDinas::where('ID_Pengadaan', $ID_Pengadaan)->first();
        $dokumenList2 = ['Nota Dinas Permintaan Pengadaan', 'HPE', 'RKS', 'Ringkasan RKS', 'Dokumen Kualifikasi'];
        $dokumen_checked2 = [];

        foreach ($dokumenList2 as $y) {
            $dokumen_checked2[$y] = $pengadaan->{'checklist_' . strtolower(str_replace(' ', '_', $y))};
        }

    $statusData = Status::all();
    $status = $pengadaan->status;
    $statusNotaDinasPermintaan = $pengadaan->statusNotaDinasPermintaan;
    $statusHPE = $pengadaan->statusHPE;
    $statusRKS = $pengadaan->statusRKS;
    $statusRingkasanRKS = $pengadaan->statusRingkasanRKS;
    $statusDokumenKualifikasi = $pengadaan->statusDokumenKualifikasi;

        return view('pejabatrendan.detail', compact('pengadaan', 'notaDinasPermintaan','hpe','dokumen_checked2','dokumenList2','statusData','status', 'statusNotaDinasPermintaan','statusHPE','statusRKS','statusRingkasanRKS','statusDokumenKualifikasi'));

    }

    public function detail($ID_Pengadaan)
    {
    try {
        // Ambil data berdasarkan ID_Pengadaan dan ID_RAB
        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);

        $ID_RAB = Rab::where('ID_Pengadaan', $ID_Pengadaan)->first();
        $rab = Rab::findOrFail($ID_RAB->ID_RAB);
        $ID_JPL = JustifikasiPenunjukanLangsung::where('ID_Pengadaan', $ID_Pengadaan)->first();
        $justifikasi = JustifikasiPenunjukanLangsung::findOrFail($ID_JPL->ID_JPL);
        $id_nota_dinas_permintaan = RencanaNotaDinas::where('ID_Pengadaan', $ID_Pengadaan)->first();
        $notaDinasPermintaan = RencanaNotaDinas::findOrFail($id_nota_dinas_permintaan->id_nota_dinas_permintaan);

        $kotaRab = Kota::find($rab->ID_Kota);
        $kotaJPL = Kota::find($justifikasi->ID_Kota);
        $kotaNotaDinasPermintaan = Kota::find($notaDinasPermintaan->ID_Kota);

        $barangs = $ID_RAB->barang()->with('transaksi')->get();
        $kriteria = Kriteria::find($ID_JPL->ID_Kriteria);
        $sumberAnggaran = SumberAnggaran::find($pengadaan->ID_Sumber_Anggaran);
        $jenisPengadaan = JenisPengadaan::find($pengadaan->ID_Jenis_Pengadaan);

        $tanggalRabFormatted = Carbon::parse($ID_RAB->tanggal)->format('d F Y');
        $tanggalJPLFormatted = Carbon::parse($ID_JPL->Tanggal)->format('d F Y');
        $tanggalNotaDinasPermintaanFormatted = Carbon::parse($id_nota_dinas_permintaan->Tanggal)->format('d F Y');

        $rencanaMulaiFormatted = Carbon::parse($pengadaan->rencana_tanggal_terkontrak_mulai)->format('d F Y');
        $rencanaSelesaiFormatted = Carbon::parse($pengadaan->rencana_tanggal_terkontrak_selesai)->format('d F Y');

        $adminRendanOptions = User::where('id_role', 3)->get();
        $adminRendanUser = !empty($name) ? User::find($name[1]) : null;

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('pdfBackend', 'CPDF');
        $options->set('defaultPaperSize', 'A4');
        $options->set('max_execution_time', 1000);
        // $options->set('orientation', 'landscape');
        // $typesuser1 = $rab->tanda_tangan_user_1->mime_type;
        // Mengambil path gambar dari direktori lokal
        $pathToImage = public_path('dashboard/template/images/logo1.jpg');

        // Memeriksa apakah file gambar ada
        if (file_exists($pathToImage)) {
        // Mengonversi gambar ke dalam base64
        $base64Image = base64_encode(File::get($pathToImage));
        $types = pathinfo($pathToImage, PATHINFO_EXTENSION);

        // $pdf = PDF::loadView('pejabatrendan.preview', compact('pengadaan','rab','justifikasi','notaDinasPermintaan','ID_RAB','ID_JPL','id_nota_dinas_permintaan','rencanaMulaiFormatted','rencanaSelesaiFormatted','sumberAnggaran', 'kotaRab', 'kotaJPL','kotaNotaDinasPermintaan','barangs','kriteria', 'tanggalRabFormatted','tanggalJPLFormatted','tanggalNotaDinasPermintaanFormatted','base64Image','types','jenisPengadaan'));
        $pdf1 = PDF::loadView('pejabatrendan.previewNotaDinasPermintaan', compact('pengadaan','id_nota_dinas_permintaan','rencanaMulaiFormatted','rencanaSelesaiFormatted', 'notaDinasPermintaan','sumberAnggaran', 'kotaNotaDinasPermintaan', 'tanggalNotaDinasPermintaanFormatted','base64Image','types','jenisPengadaan'));
        $pdf2 = PDF::loadView('pejabatrendan.previewRab', compact('pengadaan', 'rab', 'kotaRab', 'ID_RAB', 'barangs', 'tanggalRabFormatted','base64Image','types'));
        $pdf3 = PDF::loadView('pejabatrendan.previewJustifikasi', compact('pengadaan','ID_JPL', 'kriteria','justifikasi', 'kotaJPL','jenisPengadaan', 'tanggalJPLFormatted','base64Image','types'));

        return view('pejabatrendan.tampil', compact('ID_Pengadaan','rab','justifikasi','adminRendanOptions','adminRendanUser','notaDinasPermintaan','pengadaan','ID_RAB','ID_JPL','id_nota_dinas_permintaan','rencanaMulaiFormatted', 'rencanaSelesaiFormatted','sumberAnggaran', 'kotaRab','kotaJPL','kotaNotaDinasPermintaan','barangs','kriteria','tanggalRabFormatted','tanggalJPLFormatted','tanggalNotaDinasPermintaanFormatted','jenisPengadaan','base64Image','types', 'pdf1','pdf2','pdf3'));
            } else {
                \Log::error('File gambar tidak ditemukan di path yang diinginkan: ' . $pathToImage);
                return redirect()->back()->with('error', 'File gambar tidak ditemukan.');
            }
        } catch (\Exception $e) {
            \Log::error('Error saat membuat file PDF: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat file PDF preview.');
        }
    }

    public function kirimPegawai(Request $request, $ID_Pengadaan)
{
    // Logika pengiriman pengadaan
    $user = auth()->user();
    $divisi = $user->divisi;
    $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
    // $pengadaan->update(['id_status' => 9]);
    // $pengadaan->input(['id_admin_Rendan' => 'adminRendanUser']);
    $request->validate([
        'adminRendanUser' => 'required|exists:users,id_user', // Pastikan bahwa ID user yang dipilih ada di tabel users
    ]);
            $pengadaan->update([
                'id_admin_rendan' => $request->input('adminRendanUser'),
                'id_status' => 11,
                'id_status_hpe' => 6,
                'id_status_rks' => 6,
                'id_status_ringkasan_rks' => 6,
                'id_status_dokumen_kualifikasi' => 6,
                'checklist_hpe' => 1,
                'checklist_rks' => 1,
                'checklist_ringkasan_rks' => 1,
                'checklist_dokumen_kualifikasi' => 1,
            ]);
            $pengadaan->save();

    // Redirect ke halaman detail
    return redirect()->route('persetujuan.pengadaan-rendan.index')
                   ->with('success', 'Permintaan Pengadaan Berhasil Dikirim ke Pegawai');
}

public function approveHPE($ID_Pengadaan, $ID_HPE)
{
    try {
    // Ambil data berdasarkan ID_Pengadaan dan ID_RAB
    $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
    $hpe = HPE::findOrFail($ID_HPE);
    $notaDinasPermintaan = RencanaNotaDinas::where('ID_Pengadaan', $ID_Pengadaan)->first();
    $kota = Kota::find($hpe->ID_Kota);
    $sumberReferensi = SumberReferensi::find($hpe->ID_Sumber_Referensi);
    $jenisPengadaan = JenisPengadaan::find($pengadaan->ID_Jenis_Pengadaan);
    $tanggalFormatted = Carbon::parse($hpe->Tanggal)->format('d F Y');
    $rencanaMulaiFormatted = Carbon::parse($pengadaan->rencana_tanggal_terkontrak_mulai)->format('d F Y');
    $rencanaSelesaiFormatted = Carbon::parse($pengadaan->rencana_tanggal_terkontrak_selesai)->format('d F Y');

    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $options->set('isHtml5ParserEnabled', true);
    $options->set('pdfBackend', 'CPDF');
    $options->set('defaultPaperSize', 'A4');
    $options->set('max_execution_time', 1000);
    // $options->set('orientation', 'landscape');
    // $typesuser1 = $rab->tanda_tangan_user_1->mime_type;
    // Mengambil path gambar dari direktori lokal
    $pathToImage = public_path('dashboard/template/images/logo1.jpg');

    // Memeriksa apakah file gambar ada
    if (file_exists($pathToImage)) {
    // Mengonversi gambar ke dalam base64
    $base64Image = base64_encode(File::get($pathToImage));
    $types = pathinfo($pathToImage, PATHINFO_EXTENSION);
    
    $pdf = PDF::loadView('hpe.preview', compact('pengadaan','notaDinasPermintaan','jenisPengadaan','rencanaMulaiFormatted','rencanaSelesaiFormatted','sumberReferensi', 'hpe', 'kota', 'tanggalFormatted','base64Image','types'));

    return view('pejabatrendan.tampil-hpe', compact('ID_Pengadaan','pengadaan','notaDinasPermintaan','rencanaMulaiFormatted','rencanaSelesaiFormatted','jenisPengadaan','sumberReferensi', 'hpe', 'kota', 'tanggalFormatted','base64Image','types', 'pdf'));
    } else {
        \Log::error('File gambar tidak ditemukan di path yang diinginkan: ' . $pathToImage);
        return redirect()->back()->with('error', 'File gambar tidak ditemukan.');
    }
} catch (\Exception $e) {
    \Log::error('Error saat membuat file PDF: ' . $e->getMessage());
    return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat file PDF preview.');
}
}

public function approveFileHPE(Request $request, $ID_Pengadaan, $ID_HPE)
    {
        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $pengadaan->id_status_hpe = 3;
        $pengadaan->alasan_hpe = $request->input('alasan_hpe');
        $pengadaan->save();
        // $users = User::where('id_role', 5)->get();
        // $emails = $users->pluck('email')->toArray();
        // Mail::to($emails)->send(new NotifEmailAdminDuri($surat2));

        $hpe = HPE::findOrFail($ID_HPE);
        // $rab->ID_RAB = Auth::user()->id_user;
        $id_user = Auth::user()->id_user;
        $tandaTangan = Signatures::where('id_user', $id_user)->value('path');
        $hpe->tanda_tangan_pejabat_rendan = $tandaTangan;
        $hpe->save();


        // Redirect ke halaman sebelumnya atau ke halaman lain
        return redirect()->back()->with('success', 'Surat HPE telah disetujui');
    }

    public function rejectFileHPE(Request $request, $ID_Pengadaan, $ID_HPE)
    {
        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $pengadaan->id_status_hpe = 2;
        $pengadaan->alasan_hpe = $request->input('alasan_hpe');
        $pengadaan->save();
        // $users = User::where('id_role', 5)->get();
        // $emails = $users->pluck('email')->toArray();
        // Mail::to($emails)->send(new NotifEmailAdminDuri($surat2));

        $hpe = Rab::findOrFail($ID_HPE);
        // $rab->ID_RAB = Auth::user()->id_user;


        // Redirect ke halaman sebelumnya atau ke halaman lain
        return redirect()->back()->with('success', 'Surat HPE telah ditolak');
    }
}
