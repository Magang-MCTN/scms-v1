<?php

namespace App\Http\Controllers;

use App\Models\JenisPengadaan;
use App\Models\JustifikasiPenunjukanLangsung;
use App\Models\Kota;
use App\Models\Pengadaan;
use App\Models\Rab;
use App\Models\Signatures;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Dompdf\Options;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

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
        $justifikasi = JustifikasiPenunjukanLangsung::where('ID_Pengadaan', $ID_Pengadaan)->first();
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

        return view('pejabatuser.detail', compact('pengadaans','rab', 'justifikasi','dokumen_checked', 'dokumen','statusData','status', 'statusRab','statusJustifikasi','statusNotaDinasPermintaan'));

    }

    public function approveRab($ID_Pengadaan, $ID_RAB)
{
    try {
        // Ambil data berdasarkan ID_Pengadaan dan ID_RAB
        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $rab = Rab::findOrFail($ID_RAB);
        $kota = Kota::find($rab->ID_Kota);
        $barangs = $rab->barang()->with('transaksi')->get();
        $tanggalFormatted = Carbon::parse($rab->tanggal)->format('d F Y');
    
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('pdfBackend', 'CPDF');
        $options->set('defaultPaperSize', 'A4');
        $options->set('max_execution_time', 1000);
        // $options->set('orientation', 'landscape');
    
        // Mengambil path gambar dari direktori lokal
        $pathToImage = public_path('dashboard/template/images/logo1.jpg');
    
        // Memeriksa apakah file gambar ada
        if (file_exists($pathToImage)) {
        // Mengonversi gambar ke dalam base64
        $base64Image = base64_encode(File::get($pathToImage));
        $types = pathinfo($pathToImage, PATHINFO_EXTENSION);
    
        $pdf = PDF::loadView('rab.preview', compact('pengadaan', 'rab', 'kota','barangs', 'tanggalFormatted','base64Image','types'));
    
        return view('pejabatuser.tampil', compact('ID_Pengadaan','pengadaan', 'rab', 'kota','barangs', 'tanggalFormatted','base64Image','types', 'pdf'));
        } else {
            \Log::error('File gambar tidak ditemukan di path yang diinginkan: ' . $pathToImage);
            return redirect()->back()->with('error', 'File gambar tidak ditemukan.');
        }
    } catch (\Exception $e) {
        \Log::error('Error saat membuat file PDF: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat file PDF preview.');
    }
}

    public function approveFileRab(Request $request, $ID_Pengadaan, $ID_RAB)
    {
        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $pengadaan->id_status_rab = 9;
        $pengadaan->alasan_rab = $request->input('alasan_rab');
        $pengadaan->save();
        // $users = User::where('id_role', 5)->get();
        // $emails = $users->pluck('email')->toArray();
        // Mail::to($emails)->send(new NotifEmailAdminDuri($surat2));

        $rab = Rab::findOrFail($ID_RAB);
        // $rab->ID_RAB = Auth::user()->id_user;
        $id_user = Auth::user()->id_user;
        $tandaTangan = Signatures::where('id_user', $id_user)->value('path');
        $rab->tanda_tangan_user_1 = $tandaTangan;
        $rab->save();


        // Redirect ke halaman sebelumnya atau ke halaman lain
        return redirect()->back()->with('success', 'Surat Pengadaan RAB telah disetujui');
    }

    public function rejectFileRab(Request $request, $ID_Pengadaan, $ID_RAB)
    {
        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $pengadaan->id_status_rab = 8;
        $pengadaan->alasan_rab = $request->input('alasan_rab');
        $pengadaan->save();
        // $users = User::where('id_role', 5)->get();
        // $emails = $users->pluck('email')->toArray();
        // Mail::to($emails)->send(new NotifEmailAdminDuri($surat2));

        $rab = Rab::findOrFail($ID_RAB);
        // $rab->ID_RAB = Auth::user()->id_user;


        // Redirect ke halaman sebelumnya atau ke halaman lain
        return redirect()->back()->with('success', 'Surat Pengadaan RAB telah ditolak');
    }

    public function approveJustifikasi($ID_Pengadaan, $ID_JPL)
{
    try {
        // Ambil data berdasarkan ID_Pengadaan dan ID_RAB
        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $justifikasi = JustifikasiPenunjukanLangsung::findOrFail($ID_JPL);
        $kota = Kota::find($justifikasi->ID_Kota);
        $jenisPengadaan = JenisPengadaan::find($pengadaan->ID_Jenis_Pengadaan);
        $tanggalFormatted = Carbon::parse($justifikasi->Tanggal)->format('d F Y');
    
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('pdfBackend', 'CPDF');
        $options->set('defaultPaperSize', 'A4');
        $options->set('max_execution_time', 1000);
        // $options->set('orientation', 'landscape');
    
        // Mengambil path gambar dari direktori lokal
        $pathToImage = public_path('dashboard/template/images/logo1.jpg');
    
        // Memeriksa apakah file gambar ada
        if (file_exists($pathToImage)) {
        // Mengonversi gambar ke dalam base64
        $base64Image = base64_encode(File::get($pathToImage));
        $types = pathinfo($pathToImage, PATHINFO_EXTENSION);
    
        $pdf = PDF::loadView('justifikasi.preview', compact('pengadaan', 'justifikasi', 'kota','jenisPengadaan', 'tanggalFormatted','base64Image','types'));
    
        return view('pejabatuser.tampil-justifikasi', compact('ID_Pengadaan','pengadaan', 'justifikasi', 'kota','jenisPengadaan', 'tanggalFormatted','base64Image','types', 'pdf'));
        } else {
            \Log::error('File gambar tidak ditemukan di path yang diinginkan: ' . $pathToImage);
            return redirect()->back()->with('error', 'File gambar tidak ditemukan.');
        }
    } catch (\Exception $e) {
        \Log::error('Error saat membuat file PDF: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat file PDF preview.');
    }
}

    public function approveFileJustifikasi(Request $request, $ID_Pengadaan, $ID_JPL)
    {
        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $pengadaan->id_status_justifikasi = 9;
        $pengadaan->alasan_justifikasi = $request->input('alasan_justifikasi');
        $pengadaan->save();
        // $users = User::where('id_role', 5)->get();
        // $emails = $users->pluck('email')->toArray();
        // Mail::to($emails)->send(new NotifEmailAdminDuri($surat2));

        $justifikasi = JustifikasiPenunjukanLangsung::findOrFail($ID_JPL);
        // $rab->ID_RAB = Auth::user()->id_user;
        $id_user = Auth::user()->id_user;
        $tandaTangan = Signatures::where('id_user', $id_user)->value('path');
        $justifikasi->tanda_tangan_user_1 = $tandaTangan;
        $justifikasi->save();


        // Redirect ke halaman sebelumnya atau ke halaman lain
        return redirect()->back()->with('success', 'Surat Pengadaan Justifikasi Penunjukan Langsung telah disetujui');
    }

    public function rejectFileJustifikasi(Request $request, $ID_Pengadaan, $ID_JPL)
    {
        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $pengadaan->id_status_justifikasi = 8;
        $pengadaan->alasan_justifikasi = $request->input('alasan_justifikasi');
        $pengadaan->save();
        // $users = User::where('id_role', 5)->get();
        // $emails = $users->pluck('email')->toArray();
        // Mail::to($emails)->send(new NotifEmailAdminDuri($surat2));

        $justifikasi = JustifikasiPenunjukanLangsung::findOrFail($ID_JPL);
        // $rab->ID_RAB = Auth::user()->id_user;


        // Redirect ke halaman sebelumnya atau ke halaman lain
        return redirect()->back()->with('success', 'Surat Pengadaan Justifikasi Penunjukan Langsung telah ditolak');
    }
}