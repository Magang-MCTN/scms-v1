<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\JenisPengadaan;
use App\Models\Kota;
use App\Models\Pengadaan;
use App\Models\Rab;
use App\Models\RencanaNotaDinas;
use App\Models\SumberAnggaran;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Dompdf\Options;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;

class NotaDinasPermintaanPengadaanController extends Controller
{
    public function index(Request $request, $ID_Pengadaan)
    {
        $notaDinasPermintaanID = Pengadaan::findorfail($ID_Pengadaan);
        // $ID_RAB = Rab::where('ID_Pengadaan', $ID_Pengadaan)->value('ID_RAB');
        $jenisPengadaan = !empty($Jenis_Pengadaan) ? JenisPengadaan::find($Jenis_Pengadaan[1]) : null;
        $jenisPengadaanOptions = JenisPengadaan::all();
        $rencanaNotaDinasData =  RencanaNotaDinas::all();
        $kota = !empty($Kota) ? Kota::find($Kota[1]) : null;
        $kotaOptions = Kota::all();
        $divisiOptions = Divisi::whereIn('id_divisi', [4,5,6,7])->get();
        $divisi = !empty($nama_divisi) ? (int)$nama_divisi : null;
        $divisiUser = !empty($name) ? $name : null;
        $sumberAnggaran = !empty($nama_anggaran) ? SumberAnggaran::find($nama_anggaran[1]) : null;
        $sumberAnggaranOptions = SumberAnggaran::all();
        $divisi1Options = User::where('id_divisi', 3)->get();
        $divisiUser1 = !empty($name) ? User::find($name[1]) : null;

        if ($divisi) {
            $divisiUsers = User::where('id_divisi', $divisi)->get();
        } else {
            $divisiUsers = User::whereIn('id_divisi', [4, 5, 6, 7])->get();
        }

        return view('notaDinasPermintaan.index', compact('notaDinasPermintaanID','rencanaNotaDinasData','jenisPengadaan','jenisPengadaanOptions','kota', 'kotaOptions', 'jenisPengadaan', 'divisi', 'divisiOptions', 'divisiUser','divisiUsers','sumberAnggaran','sumberAnggaranOptions', 'divisiUser1','divisi1Options',));
    }

    public function store(Request $request, $ID_Pengadaan)
    {
        try {
        $validatedData = $request->validate([
            'Nomor_ND_PPBJ',
            'Nomor_PRK',
            'cost_center',
            'pagu_anggaran',
            'nama_pengguna',
            'divisi_pengguna',
            'url_kak' => 'nullable|url',
            'url_spesifikasi_teknis' => 'nullable|url',
            'rencana_durasi_kontrak_tanggal' => 'in:Hari Kerja,Hari Kalender,Bulan,Tahun',
        ]);
        $namaKota = $request->input('kota');
        $kota = Kota::where('Kota', $namaKota)->first();
        $ID_Kota = $kota->ID_Kota;

        $namaJenisPengadaan = $request->input('jenis_pengadaan');
        $jenisPengadaan = JenisPengadaan::where('jenis_pengadaan', $namaJenisPengadaan)->first();
        $ID_Jenis_Pengadaan = $jenisPengadaan->ID_Jenis_Pengadaan;

        $namaSumberAnggaran = $request->input('nama_anggaran');
        $sumberAnggaran = SumberAnggaran::where('nama_anggaran', $namaSumberAnggaran)->first();
        // $ID_Sumber_Anggaran = $sumberAnggaran->ID_Sumber_Anggaran;
        if ($sumberAnggaran) {
            $ID_Sumber_Anggaran = $sumberAnggaran->ID_Sumber_Anggaran;
        }else{
            \Log::error('Objek SumberAnggaran dengan nama ' . $namaSumberAnggaran . ' tidak ditemukan.');
        }

        $namaPengguna = $request->input('divisiUser');
        $pengguna = User::where('name', $namaPengguna)->first();
        if ($pengguna) {
            $ID_Pengguna = $pengguna->name;
        // $ID_Pengguna = $pengguna->name;

        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $pengadaan->update(['id_status_nota_dinas_permintaan' => 7]);
        $pengadaan->update(['id_status' => 10]);
        
        // $namaJenisPengadaan = $request->input('jenis_pengadaan');
        // $jenisPengadaan = JenisPengadaan::where('Jenis_Pengadaan', $namaJenisPengadaan)->first();
        // $ID_Jenis_Pengadaan = $jenisPengadaan->ID_Jenis_Pengadaan;

        $namaDivisi = $request->input('divisi');
        $divisi = Divisi::where('id_divisi', $namaDivisi)->first();
        $divisiID = $divisi->nama_divisi;

        $namaUser1 = $request->input('divisiUser1');
        $user1 = User::where('name', $namaUser1)->first();
        $jabatanUser1 = $user1->jabatan;

        // if ($pengguna && $pengguna->name) {
            $userID = $user1->name;

            $notaDinasPermintaan = RencanaNotaDinas::create([
                'Nomor_ND_PPBJ' => $request->input('nomor_nd_ppbj'),
                'ID_Kota' => $ID_Kota,
                'ID_Pengadaan' => $ID_Pengadaan,
                // 'ID_Jenis_Pengadaan' => $ID_Jenis_Pengadaan,
                'Tanggal' => $request->input('Tanggal'),
                'Nomor_PRK' => $request->input('informasi_anggaran'),
                'pagu_anggaran' => $request->input('pagu_anggaran'),
                'cost_center' => $request->input('cost_center'),
                'nama_pengguna' => $ID_Pengguna,
                'nama_user_1'=> $userID,
                'jabatan_user_1' => $jabatanUser1,
                'divisi_pengguna' => $divisiID,
                'url_kak' => $request->input('url_kak'),
                'url_spesifikasi_teknis' => $request->input('url_spesifikasi_teknis'),
            ]);
            $pengadaan->rencanaNotaDinas()->save($notaDinasPermintaan);
            $notaDinasPermintaan->save();

            $sumberAnggaranisi = Pengadaan::findOrFail($ID_Pengadaan);
            $sumberAnggaranisi->update([
                'Ringkasan_Pekerjaan' => strip_tags($request->input('ringkasan_pekerjaan')),
                'ID_Sumber_Anggaran' => $ID_Sumber_Anggaran,
                'ID_Jenis_Pengadaan' => $ID_Jenis_Pengadaan,
                'rencana_tanggal_terkontrak_mulai' => $request->input('rencana_tanggal_terkontrak_mulai'),
                'rencana_tanggal_terkontrak_selesai' => $request->input('rencana_tanggal_terkontrak_selesai'),
                'rencana_durasi_kontrak' => $request->input('rencana_durasi_kontrak'),
                'rencana_durasi_kontrak_tanggal' => $request->input('rencana_durasi_kontrak_tanggal'),

            ]);
            $sumberAnggaranisi->save();

        }else{
            // Log nilai-nilai yang diperlukan untuk debugging
            \Log::error('pengguna:', ['namaPengguna' => $namaPengguna, 'pengguna' => $pengguna]);
        
            // Tangani kasus ketika user tidak ditemukan atau properti 'name' tidak ada
            \Log::error('Pengguna dengan nama ' . $namaPengguna . ' tidak ditemukan atau properti "name" tidak ada.');
        }
        \Log::info('Nota Dinas Permintaan saved successfully:', ['notaDinasPermintaan' => $notaDinasPermintaan]);
            return redirect()->route('pengadaan.detail', ['ID_Pengadaan' => $ID_Pengadaan])->with('success', 'Nota Dinas Permintaan berhasil disimpan');
        } catch (\Exception $e) {
            \Log::error('Error saat menyimpan data: ' . $e->getMessage());
    
            return redirect()->route('pengadaan.detail', ['ID_Pengadaan' => $ID_Pengadaan])->with('error', 'Terjadi kesalahan saat menyimpan Nota Dinas Permintaan');
        }
}

public function preview($ID_Pengadaan, $id_nota_dinas_permintaan)
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
    
    $pdf = PDF::loadView('notaDinasPermintaan.preview', compact('pengadaan','rencanaMulaiFormatted','rencanaSelesaiFormatted','jenisPengadaan','sumberAnggaran', 'notaDinasPermintaan', 'kota', 'tanggalFormatted','base64Image','types'));

    return view('notaDinasPermintaan.tampil', compact('ID_Pengadaan','pengadaan','rencanaMulaiFormatted','rencanaSelesaiFormatted','jenisPengadaan','sumberAnggaran', 'notaDinasPermintaan', 'kota', 'tanggalFormatted','base64Image','types', 'pdf'));
    } else {
        \Log::error('File gambar tidak ditemukan di path yang diinginkan: ' . $pathToImage);
        return redirect()->back()->with('error', 'File gambar tidak ditemukan.');
    }
} catch (\Exception $e) {
    \Log::error('Error saat membuat file PDF: ' . $e->getMessage());
    return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat file PDF preview.');
}
}

public function downloadPreview($ID_Pengadaan, $id_nota_dinas_permintaan)
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
    
        return $pdf->download('preview-nota-dinas-permintaan.pdf');
        } else {
            \Log::error('File gambar tidak ditemukan di path yang diinginkan: ' . $pathToImage);
            return redirect()->back()->with('error', 'File gambar tidak ditemukan.');
        }
    } catch (\Exception $e) {
        \Log::error('Error saat membuat file PDF: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat file PDF preview.');
    }
}

public function kirimNotaDinasPermintaan($ID_Pengadaan, $id_nota_dinas_permintaan)
{
    // Logika pengiriman pengadaan
    $user = auth()->user();
    $divisi = $user->divisi;
    $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
    $pengadaan->update(['id_status_nota_dinas_permintaan' => 8]);
    $notaDinasPermintaan = RencanaNotaDinas::findOrFail($id_nota_dinas_permintaan);
    $tanggalPengajuan = Carbon::now('Asia/Jakarta');
    $notaDinasPermintaan->update(['tanggal_pengajuan' => $tanggalPengajuan]);
    // Redirect ke halaman detail
    return redirect()->route('pengadaan.detail', ['ID_Pengadaan' => $ID_Pengadaan, 'id_nota_dinas_permintaan' => $id_nota_dinas_permintaan])
                   ->with('success', 'Surat Nota Dinas Permintaan berhasil dikirim.');
}
}
