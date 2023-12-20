<?php

namespace App\Http\Controllers;

use App\Models\DokumenKualifikasi;
use App\Models\HPE;
use App\Models\JenisPengadaan;
use App\Models\JustifikasiPenunjukanLangsung;
use App\Models\Kota;
use App\Models\Kriteria;
use App\Models\MetodeEvaluasiPenawaran;
use App\Models\MetodePenawaran;
use App\Models\MetodePengadaan;
use App\Models\Pengadaan;
use App\Models\Rab;
use App\Models\RencanaNotaDinas;
use App\Models\RingkasanRKS;
use App\Models\Signatures;
use App\Models\Status;
use App\Models\SumberAnggaran;
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

        $dokumenList = ['Rencana Anggaran Biaya', 'Justifikasi Penunjukan Langsung','Nota Dinas Permintaan Pengadaan', 'HPE', 'RKS', 'Ringkasan RKS', 'Dokumen Kualifikasi'];
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
        $notaDinasPermintaan = RencanaNotaDinas::where('ID_Pengadaan', $ID_Pengadaan)->first();
        $hpe = HPE::where('ID_Pengadaan', $ID_Pengadaan)->first();
        $rks = RingkasanRKS::where('ID_Pengadaan', $ID_Pengadaan)->first();
        $ringkasanRKS = RingkasanRKS::where('ID_Pengadaan', $ID_Pengadaan)->first();
        $dokumenKualifikasi = DokumenKualifikasi::where('ID_Pengadaan', $ID_Pengadaan)->first();
        $dokumenList = ['Rencana Anggaran Biaya', 'Justifikasi Penunjukan Langsung','Nota Dinas Permintaan Pengadaan', 'HPE', 'RKS', 'Ringkasan RKS', 'Dokumen Kualifikasi'];
        $dokumen_checked = [];

        foreach ($dokumenList as $d) {
            $dokumen_checked[$d] = $pengadaans->{'checklist_' . strtolower(str_replace(' ', '_', $d))};
        }

        $statusData = Status::all();
        $status = $pengadaans->status;
        $statusRab = $pengadaans->statusRab;
        $statusJustifikasi = $pengadaans->statusJustifikasi;
        $statusNotaDinasPermintaan = $pengadaans->statusNotaDinasPermintaan;
        $statusHPE = $pengadaans->statusHPE;
        $statusRKS = $pengadaans->statusRKS;
        $statusRingkasanRKS = $pengadaans->statusRingkasanRKS;
        $statusDokumenKualifikasi = $pengadaans->statusDokumenKualifikasi;

        return view('pejabatuser.detail', compact('pengadaans','rab', 'hpe','rks','ringkasanRKS','dokumenKualifikasi','statusRKS','statusRingkasanRKS','statusDokumenKualifikasi','justifikasi','notaDinasPermintaan','dokumen_checked', 'dokumen','statusData','status', 'statusRab','statusHPE','statusJustifikasi','statusNotaDinasPermintaan'));

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
        $pengadaan->id_status_rab = 3;
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
        $pengadaan->id_status_rab = 2;
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
        $kriteria = Kriteria::find($justifikasi->ID_Kriteria);
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
    
        $pdf = PDF::loadView('justifikasi.preview', compact('pengadaan', 'kriteria','justifikasi', 'kota','jenisPengadaan', 'tanggalFormatted','base64Image','types'));
    
        return view('pejabatuser.tampil-justifikasi', compact('ID_Pengadaan','pengadaan','kriteria', 'justifikasi', 'kota','jenisPengadaan', 'tanggalFormatted','base64Image','types', 'pdf'));
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
        $pengadaan->id_status_justifikasi = 3;
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
        $pengadaan->id_status_justifikasi = 2;
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

    public function approveNotaDinasPermintaan($ID_Pengadaan, $id_nota_dinas_permintaan)
{
    try {
        // Ambil data berdasarkan ID_Pengadaan dan ID_RAB
        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $notaDinasPermintaan = RencanaNotaDinas::findOrFail($id_nota_dinas_permintaan);
        $kota = Kota::find($notaDinasPermintaan->ID_Kota);
        $sumberAnggaran = SumberAnggaran::find($pengadaan->ID_Sumber_Anggaran);
        $jenisPengadaan = JenisPengadaan::find($pengadaan->ID_Jenis_Pengadaan);
        $tanggalFormatted = Carbon::parse($notaDinasPermintaan->Tanggal)->format('d F Y');
        $rencanaMulaiFormatted = Carbon::parse($pengadaan->rencana_tanggal_terkontrak_mulai)->format('d F Y');
        $rencanaSelesaiFormatted = Carbon::parse($pengadaan->rencana_tanggal_terkontrak_selesai)->format('d F Y');
        // $tanda_tangan = Signatures::findOrFail()
    
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

        $pdf = PDF::loadView('notaDinasPermintaan.preview', compact('pengadaan','rencanaMulaiFormatted','rencanaSelesaiFormatted', 'notaDinasPermintaan','sumberAnggaran', 'kota', 'tanggalFormatted','base64Image','types','jenisPengadaan'));
    
        return view('pejabatuser.tampil-nota-dinas-permintaan', compact('ID_Pengadaan','pengadaan','rencanaMulaiFormatted', 'rencanaSelesaiFormatted','notaDinasPermintaan','sumberAnggaran', 'kota','jenisPengadaan', 'tanggalFormatted','base64Image','types', 'pdf'));
            } else {
                \Log::error('File gambar tidak ditemukan di path yang diinginkan: ' . $pathToImage);
                return redirect()->back()->with('error', 'File gambar tidak ditemukan.');
            }
        } catch (\Exception $e) {
            \Log::error('Error saat membuat file PDF: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat file PDF preview.');
        }
}

    public function approveFileNotaDinasPermintaan(Request $request, $ID_Pengadaan, $id_nota_dinas_permintaan)
    {
        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $pengadaan->id_status_nota_dinas_permintaan= 3;
        $pengadaan->update(['id_status' => 9]);
        $pengadaan->alasan_nota_dinas_permintaan = $request->input('alasan_nota_dinas_permintaan');
        $pengadaan->save();
        // $users = User::where('id_role', 5)->get();
        // $emails = $users->pluck('email')->toArray();
        // Mail::to($emails)->send(new NotifEmailAdminDuri($surat2));

        $notaDinasPermintaan = RencanaNotaDinas::findOrFail($id_nota_dinas_permintaan);
        // $rab->ID_RAB = Auth::user()->id_user;
        $id_user = Auth::user()->id_user;
        $tandaTangan = Signatures::where('id_user', $id_user)->value('path');
        $notaDinasPermintaan->tanda_tangan_user_1 = $tandaTangan;
        $notaDinasPermintaan->save();


        // Redirect ke halaman sebelumnya atau ke halaman lain
        return redirect()->back()->with('success', 'Surat Nota Dinas Perencanaan Permintaan telah disetujui');
    }

    public function rejectFileNotaDinasPermintaan(Request $request, $ID_Pengadaan, $id_nota_dinas_permintaan)
    {
        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $pengadaan->id_status_nota_dinas_permintaan = 2;
        $pengadaan->alasan_nota_dinas_permintaan = $request->input('alasan_nota_dinas_permintaan');
        $pengadaan->save();
        // $users = User::where('id_role', 5)->get();
        // $emails = $users->pluck('email')->toArray();
        // Mail::to($emails)->send(new NotifEmailAdminDuri($surat2));

        $notaDinasPermintaan = RencanaNotaDinas::findOrFail($id_nota_dinas_permintaan);
        // $rab->ID_RAB = Auth::user()->id_user;


        // Redirect ke halaman sebelumnya atau ke halaman lain
        return redirect()->back()->with('success', 'Surat Nota Dinas Perencanaan Pengadaan telah ditolak');
    }

    public function approveRKS($ID_Pengadaan, $ID_Ringkasan_Rks)
{
    try {
    // Ambil data berdasarkan ID_Pengadaan dan ID_RAB
    $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
    $rks = RingkasanRKS::findOrFail($ID_Ringkasan_Rks);
    $notaDinasPermintaan = RencanaNotaDinas::where('ID_Pengadaan', $ID_Pengadaan)->first();
    $hpe = HPE::where('ID_Pengadaan', $ID_Pengadaan)->first();
    $kota = Kota::find($hpe->ID_Kota);
    $sumberAnggaran = SumberAnggaran::find($pengadaan->ID_Sumber_Anggaran);
    $jenisPengadaan = JenisPengadaan::find($pengadaan->ID_Jenis_Pengadaan);
    $metodePengadaan = MetodePengadaan::find($rks->ID_Metode_Pengadaan);
    $metodePenawaran = MetodePenawaran::find($rks->ID_Metode_Penawaran);
    $metodeEvaluasiPenawaran = MetodeEvaluasiPenawaran::find($rks->ID_Metode_Evaluasi_Penawaran);
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
    
    $pdf = PDF::loadView('rks.preview', compact('pengadaan','metodePengadaan','metodePenawaran','metodeEvaluasiPenawaran','sumberAnggaran','rks','notaDinasPermintaan','jenisPengadaan','rencanaMulaiFormatted','rencanaSelesaiFormatted', 'hpe', 'kota', 'tanggalFormatted','base64Image','types'));

    return view('pejabatuser.tampil-rks', compact('ID_Pengadaan','sumberAnggaran','metodePengadaan','metodePenawaran','metodeEvaluasiPenawaran','pengadaan','notaDinasPermintaan','rencanaMulaiFormatted','rencanaSelesaiFormatted','jenisPengadaan','rks', 'hpe', 'kota', 'tanggalFormatted','base64Image','types', 'pdf'));
    } else {
        \Log::error('File gambar tidak ditemukan di path yang diinginkan: ' . $pathToImage);
        return redirect()->back()->with('error', 'File gambar tidak ditemukan.');
    }
} catch (\Exception $e) {
    \Log::error('Error saat membuat file PDF: ' . $e->getMessage());
    return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat file PDF preview.');
}
}

public function approveFileRKS(Request $request, $ID_Pengadaan, $ID_Ringkasan_Rks)
    {
        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $pengadaan->id_status_ringkasan_rks = 3;
        $pengadaan->id_status_rks = 3;
        $pengadaan->alasan_rks = $request->input('alasan_rks');
        $pengadaan->save();
        // $users = User::where('id_role', 5)->get();
        // $emails = $users->pluck('email')->toArray();
        // Mail::to($emails)->send(new NotifEmailAdminDuri($surat2));

        $rks = RingkasanRKS::findOrFail($ID_Ringkasan_Rks);
        // $rab->ID_RAB = Auth::user()->id_user;
        // $id_user = Auth::user()->id_user;
        $namaUser1 = $rks->nama_user_1;
        // $namaUser2 = $rks->nama_rendan_1;
        $idUser1 = User::where('name', $namaUser1)->value('id_user');
        // $idUser2 = User::where('name', $namaUser2)->value('id_user');
        $tandaTangan1 = Signatures::where('id_user', $idUser1)->value('path');
        // $tandaTangan2 = Signatures::where('id_user', $idUser2)->value('path');
        $rks->tanda_tangan_user_1 = $tandaTangan1;
        // $rks->tanda_tangan_rendan_1 = $tandaTangan2;
        $rks->save();


        // Redirect ke halaman sebelumnya atau ke halaman lain
        return redirect()->back()->with('success', 'Surat Ringkasan RKS telah disetujui');
    }

    public function rejectFileRKS(Request $request, $ID_Pengadaan, $ID_Ringkasan_Rks)
    {
        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $pengadaan->id_status_ringkasan_rks = 2;
        $pengadaan->id_status_rks = 2;
        $pengadaan->alasan_rks = $request->input('alasan_rks');
        $pengadaan->save();
        // $users = User::where('id_role', 5)->get();
        // $emails = $users->pluck('email')->toArray();
        // Mail::to($emails)->send(new NotifEmailAdminDuri($surat2));

        $rks = RingkasanRKS::findOrFail($ID_Ringkasan_Rks);
        // $rab->ID_RAB = Auth::user()->id_user;


        // Redirect ke halaman sebelumnya atau ke halaman lain
        return redirect()->back()->with('success', 'Surat Ringkasan RKS telah ditolak');
    }
}