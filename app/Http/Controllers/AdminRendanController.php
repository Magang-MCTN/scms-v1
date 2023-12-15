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
use App\Models\Status;
use App\Models\SumberAnggaran;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Dompdf\Options;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminRendanController extends Controller
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
    
        foreach ($pengadaan as $p) {
            foreach ($dokumenList as $d) {
                $dokumen_checked[$p->ID_Pengadaan][$d] = $p->{'checklist_' . strtolower(str_replace(' ', '_', $d))};
            }
        }
        return view('adminrendan.index',compact('pengadaan', 'dokumenList','dokumen_checked', 'pengadaanst', 'statusData'));
    }

    public function detail($ID_Pengadaan, ...$dokumen)
    {
        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $hpe = HPE::where('ID_Pengadaan', $ID_Pengadaan)->first();
        // $rks = HPE::where('ID_Pengadaan', $ID_Pengadaan)->first();
        // $ringkasanRKS = HPE::where('ID_Pengadaan', $ID_Pengadaan)->first();
        // $dokumenKualifikasi = HPE::where('ID_Pengadaan', $ID_Pengadaan)->first();
        $notaDinasPermintaan = RencanaNotaDinas::where('ID_Pengadaan', $ID_Pengadaan)->first();
        $dokumenList = ['Nota Dinas Permintaan Pengadaan', 'HPE', 'RKS', 'Ringkasan RKS', 'Dokumen Kualifikasi'];
        $dokumen_checked = [];

        foreach ($dokumenList as $d) {
            $dokumen_checked[$d] = $pengadaan->{'checklist_' . strtolower(str_replace(' ', '_', $d))};
        }

    $statusData = Status::all();
    $status = $pengadaan->status;
    $statusNotaDinasPermintaan = $pengadaan->statusNotaDinasPermintaan;
    $statusHPE = $pengadaan->statusHPE;
    $statusRKS = $pengadaan->statusRKS;
    $statusRingkasanRKS = $pengadaan->statusRingkasanRKS;
    $statusDokumenKualifikasi = $pengadaan->statusDokumenKualifikasi;

        return view('adminrendan.detail', compact('pengadaan', 'notaDinasPermintaan','hpe','dokumen_checked','dokumenList','statusData','status', 'statusNotaDinasPermintaan','statusHPE','statusRKS','statusRingkasanRKS','statusDokumenKualifikasi'));

    }

    public function detailNotaDinas($ID_Pengadaan)
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

        return view('adminrendan.tampil', compact('ID_Pengadaan','rab','justifikasi','adminRendanOptions','adminRendanUser','notaDinasPermintaan','pengadaan','ID_RAB','ID_JPL','id_nota_dinas_permintaan','rencanaMulaiFormatted', 'rencanaSelesaiFormatted','sumberAnggaran', 'kotaRab','kotaJPL','kotaNotaDinasPermintaan','barangs','kriteria','tanggalRabFormatted','tanggalJPLFormatted','tanggalNotaDinasPermintaanFormatted','jenisPengadaan','base64Image','types', 'pdf1','pdf2','pdf3'));
            } else {
                \Log::error('File gambar tidak ditemukan di path yang diinginkan: ' . $pathToImage);
                return redirect()->back()->with('error', 'File gambar tidak ditemukan.');
            }
        } catch (\Exception $e) {
            \Log::error('Error saat membuat file PDF: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat file PDF preview.');
        }
    }

}
