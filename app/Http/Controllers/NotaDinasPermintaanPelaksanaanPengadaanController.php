<?php

namespace App\Http\Controllers;

use App\Models\JenisPengadaan;
use App\Models\Kota;
use App\Models\Pengadaan;
use App\Models\RencanaNotaDinas;
use App\Models\SumberAnggaran;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Dompdf\Options;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
class NotaDinasPermintaanPelaksanaanPengadaanController extends Controller
{
    public function index(Request $request, $ID_Pengadaan, $id_nota_dinas_permintaan)
    {
        $pengadaan = Pengadaan::findorfail($ID_Pengadaan);
        $notaDinasPelaksanaan = RencanaNotaDinas::findorfail($id_nota_dinas_permintaan);

        return view('notaDinasPelaksanaan.index', compact('pengadaan', 'notaDinasPelaksanaan'));
    }

    public function store(Request $request, $ID_Pengadaan, $id_nota_dinas_permintaan)
    {
        try {
        $validatedData = $request->validate([
            'Nomor_ND_Lakdan',
        ]);

        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $pengadaan->update(['id_status_nota_dinas_pelaksanaan' => 7]);
        $pengadaan->update(['id_status' => 10]);
        $notaDinasPelaksanaan = RencanaNotaDinas::findorfail($id_nota_dinas_permintaan);

            $notaDinasPelaksanaan->update([
                'Nomor_ND_Lakdan' => $request->input('Nomor_ND_Lakdan'),
            ]);
            $notaDinasPelaksanaan->save();

            return redirect()->route('pengadaan.detail', ['ID_Pengadaan' => $ID_Pengadaan])->with('success', 'Nota Dinas Pelaksanaan berhasil disimpan');
        } catch (\Exception $e) {
            \Log::error('Error saat menyimpan data: ' . $e->getMessage());
    
            return redirect()->route('pengadaan.detail', ['ID_Pengadaan' => $ID_Pengadaan])->with('error', 'Terjadi kesalahan saat menyimpan Nota Dinas Pelaksanaan');
        }
}

public function edit($ID_Pengadaan, $id_nota_dinas_permintaan)
{
    $notaDinasPelaksanaan = RencanaNotaDinas::findorfail($id_nota_dinas_permintaan);
    $pengadaan = Pengadaan::findorfail($ID_Pengadaan);

        return view('notaDinasPelaksanaan.edit', compact('pengadaan','notaDinasPelaksanaan'));
    }

public function update(Request $request, $ID_Pengadaan, $id_nota_dinas_permintaan)
{
    try {
        $validatedData = $request->validate([
            // 'Nomor_ND_Lakdan',
        ]);

        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $pengadaan->update(['id_status_nota_dinas_pelaksanaan' => 7]);
        $pengadaan->update(['id_status' => 10]);

            $notaDinasPelaksanaan = RencanaNotaDinas::findorfail($id_nota_dinas_permintaan);
            $notaDinasPelaksanaan->update([
                'Nomor_ND_Lakdan' => $request->input('Nomor_ND_Lakdan'),

            ]);
            $notaDinasPelaksanaan->save();

            return redirect()->route('pengadaan.detail', ['ID_Pengadaan' => $ID_Pengadaan])->with('success', 'Nota Dinas Pelaksanaan berhasil disimpan');
        } catch (\Exception $e) {
            \Log::error('Error saat menyimpan data: ' . $e->getMessage());
    
            return redirect()->route('pengadaan.detail', ['ID_Pengadaan' => $ID_Pengadaan])->with('error', 'Terjadi kesalahan saat menyimpan Nota Dinas Pelaksanaan');
        }
}

public function preview($ID_Pengadaan, $id_nota_dinas_permintaan)
{
    try {
    // Ambil data berdasarkan ID_Pengadaan dan ID_RAB
    $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
    $notaDinasPelaksanaan = RencanaNotaDinas::findOrFail($id_nota_dinas_permintaan);
    $kota = Kota::find($notaDinasPelaksanaan->ID_Kota);
    $sumberAnggaran = SumberAnggaran::find($pengadaan->ID_Sumber_Anggaran);
    $jenisPengadaan = JenisPengadaan::find($pengadaan->ID_Jenis_Pengadaan);
    $tanggalFormatted = Carbon::parse($notaDinasPelaksanaan->Tanggal)->format('d F Y');
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
    
    $pdf = PDF::loadView('notaDinasPelaksanaan.preview', compact('pengadaan','rencanaMulaiFormatted','rencanaSelesaiFormatted','jenisPengadaan','sumberAnggaran', 'notaDinasPelaksanaan', 'kota', 'tanggalFormatted','base64Image','types'));

    return view('notaDinasPelaksanaan.tampil', compact('ID_Pengadaan','pengadaan','rencanaMulaiFormatted','rencanaSelesaiFormatted','jenisPengadaan','sumberAnggaran', 'notaDinasPelaksanaan', 'kota', 'tanggalFormatted','base64Image','types', 'pdf'));
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
        $notaDinasPelaksanaan = RencanaNotaDinas::findOrFail($id_nota_dinas_permintaan);
        $kota = Kota::find($notaDinasPelaksanaan->ID_Kota);
        $sumberAnggaran = SumberAnggaran::find($pengadaan->ID_Sumber_Anggaran);
        $jenisPengadaan = JenisPengadaan::find($pengadaan->ID_Jenis_Pengadaan);
        $tanggalFormatted = Carbon::parse($notaDinasPelaksanaan->Tanggal)->format('d F Y');
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

        $pdf = PDF::loadView('notaDinasPelaksanaan.preview', compact('pengadaan','rencanaMulaiFormatted','rencanaSelesaiFormatted', 'notaDinasPelaksanaan','sumberAnggaran', 'kota', 'tanggalFormatted','base64Image','types','jenisPengadaan'));
    
        return $pdf->download('preview-nota-dinas-pelaksanaan.pdf');
        } else {
            \Log::error('File gambar tidak ditemukan di path yang diinginkan: ' . $pathToImage);
            return redirect()->back()->with('error', 'File gambar tidak ditemukan.');
        }
    } catch (\Exception $e) {
        \Log::error('Error saat membuat file PDF: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat file PDF preview.');
    }
}

public function kirimNotaDinasPelaksanaan($ID_Pengadaan, $id_nota_dinas_permintaan)
{
    // Logika pengiriman pengadaan
    $user = auth()->user();
    $divisi = $user->divisi;
    $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
    $pengadaan->update(['id_status_nota_dinas_pelaksanaan' => 8]);
    $notaDinasPelaksanaan = RencanaNotaDinas::findOrFail($id_nota_dinas_permintaan);
    $tanggalPengajuan = Carbon::now('Asia/Jakarta');
    $notaDinasPelaksanaan->update(['tanggal_pengajuan_pelaksanaan' => $tanggalPengajuan]);
    // Redirect ke halaman detail
    return redirect()->route('pengadaan.detail', ['ID_Pengadaan' => $ID_Pengadaan, 'id_nota_dinas_permintaan' => $id_nota_dinas_permintaan])
                   ->with('success', 'Surat Nota Dinas Pelaksanaan berhasil dikirim.');
}
}
