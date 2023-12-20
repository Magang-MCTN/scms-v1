<?php

namespace App\Http\Controllers;

use App\Models\HPE;
use App\Models\JenisPengadaan;
use App\Models\KlasifikasiBaku;
use App\Models\Kota;
use App\Models\MetodeEvaluasiPenawaran;
use App\Models\MetodePenawaran;
use App\Models\MetodePengadaan;
use App\Models\Pengadaan;
use App\Models\RencanaNotaDinas;
use App\Models\RingkasanRKS;
use App\Models\SumberAnggaran;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Dompdf\Options;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;

class RingkasanRKSController extends Controller
{
    public function index(Request $request, $ID_Pengadaan)
    {
        $pengadaan = Pengadaan::findorfail($ID_Pengadaan);
        $rks = RingkasanRKS::all();
        $sumberAnggaran = SumberAnggaran::find($pengadaan->ID_Sumber_Anggaran);
        $hpe = HPE::where('ID_Pengadaan', $ID_Pengadaan)->first();
        $notaDinasPermintaan = RencanaNotaDinas::where('ID_Pengadaan', $ID_Pengadaan)->first();
        $jenisPengadaan = JenisPengadaan::find($pengadaan->ID_Jenis_Pengadaan);
        $kota = !empty($Kota) ? Kota::find($Kota[1]) : null;
        $kotaOptions = Kota::all();
        $klasifikasi = !empty($Nomor_Klasifikasi) ? KlasifikasiBaku::find($Nomor_Klasifikasi[1]) : null;
        $klasifikasiOptions = KlasifikasiBaku::all();
        $metodePengadaan = !empty($Metode_Pengadaan) ? MetodePengadaan::find($Metode_Pengadaan[1]) : null;
        $metodePengadaanOptions = MetodePengadaan::all();
        $metodePenawaran = !empty($Metode_Penawaran) ? MetodePenawaran::find($Metode_Penawaran[1]) : null;
        $metodePenawaranOptions = MetodePenawaran::all();
        $metodeEvaluasiPenawaran = !empty($Metode_Evaluasi_Penawaran) ? MetodeEvaluasiPenawaran::find($Metode_Evaluasi_Penawaran[1]) : null;
        $metodeEvaluasiPenawaranOptions = MetodeEvaluasiPenawaran::all();
        $rencanaMulaiFormatted = Carbon::parse($pengadaan->rencana_tanggal_terkontrak_mulai)->format('d F Y');
        $rencanaSelesaiFormatted = Carbon::parse($pengadaan->rencana_tanggal_terkontrak_selesai)->format('d F Y');
        $divisi1Options = User::where('id_divisi', 3)->get();
        $divisiUser1 = !empty($name) ? User::find($name[1]) : null;
        $divisi2Options = User::where('id_role', 6)->get();
        $divisiUser2 = !empty($name) ? User::find($name[1]) : null;

        return view('rks.index', compact('pengadaan','rks','sumberAnggaran','notaDinasPermintaan','hpe','kota', 'kotaOptions','klasifikasi', 'klasifikasiOptions','metodePengadaan', 'metodePengadaanOptions','metodePenawaran', 'metodePenawaranOptions','metodeEvaluasiPenawaran', 'metodeEvaluasiPenawaranOptions', 'jenisPengadaan', 'rencanaMulaiFormatted','rencanaSelesaiFormatted','divisi1Options', 'divisiUser1','divisi2Options', 'divisiUser2'));
    }

    public function store(Request $request, $ID_Pengadaan)
    {
        try {
        $validatedData = $request->validate([
            'Status_Rks' => 'in:Ada di DRP, Tidak Ada di DRP',
            'Kualifikasi_Pengadaan' => 'in:Prakualifikasi, Pasca Kualifikasi',
            'Kualifikasi_CSMS' => 'in:Tidak Perlu, Perlu',
            'url_rks' => 'nullable|url',
        ]);
        $namaKota = $request->input('kota');
        $kota = Kota::where('Kota', $namaKota)->first();
        $ID_Kota = $kota->ID_Kota;
        
        $namaLokasi = $request->input('lokasi');
        $lokasi = Kota::where('Kota', $namaLokasi)->first();
        $ID_Lokasi = $lokasi->ID_Kota;

        $namaMetodePengadaan = $request->input('Metode_Pengadaan');
        $metodePengadaan = MetodePengadaan::where('Metode_Pengadaan', $namaMetodePengadaan)->first();
        $ID_Metode_Pengadaan = $metodePengadaan->ID_Metode_Pengadaan;

        $namaMetodePenawaran = $request->input('Metode_Penawaran');
        $metodePenawaran = MetodePenawaran::where('Metode_Penawaran', $namaMetodePenawaran)->first();
        $ID_Metode_Penawaran = $metodePenawaran->ID_Metode_Penawaran;

        $namaMetodeEvaluasiPenawaran = $request->input('Metode_Evaluasi_Penawaran');
        $metodeEvaluasiPenawaran = MetodeEvaluasiPenawaran::where('Metode_Evaluasi_Penawaran', $namaMetodeEvaluasiPenawaran)->first();
        $ID_Metode_Evaluasi_Penawaran = $metodeEvaluasiPenawaran->ID_Metode_Evaluasi_Penawaran;

        $namaKlasifikasi = $request->input('klasifikasi_baku');
        $klasifikasi = KlasifikasiBaku::where('Nomor_Klasifikasi', $namaKlasifikasi)->first();
        $ID_Klasifikasi = $klasifikasi->ID_Klasifikasi;

        $namaPengguna1 = $request->input('divisiUser1');
        $pengguna1 = User::where('name', $namaPengguna1)->first();
        $ID_Pengguna1 = $pengguna1->name;

        $namaPengguna2 = $request->input('divisiUser2');
        $pengguna2 = User::where('name', $namaPengguna2)->first();
        $ID_Pengguna2 = $pengguna2->name;

        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $pengadaan->update(['id_status_rks' => 11]);
        $pengadaan->update(['id_status_ringkasan_rks' => 7]);
        $pengadaan->update(['id_status' => 11]);

        $ringkasanRKS = RingkasanRKS::create([
                'Nomor_Rks' => $request->input('Nomor_Rks'),
                'ID_Kota' => $ID_Kota,
                'ID_Pengadaan' => $ID_Pengadaan,
                'Tanggal_Pengambilan_Rks_Mulai' => $request->input('Tanggal_Pengambilan_Rks_Mulai'),
                'Tanggal_Pengambilan_Rks_Selesai' => $request->input('Tanggal_Pengambilan_Rks_Selesai'),
                'Tanggal' => $request->input('Tanggal'),
                'Waktu_Pengambilan_Rks_Mulai' => $request->input('Waktu_Pengambilan_Rks_Mulai'),
                'Waktu_Pengambilan_Rks_Selesai' => $request->input('Waktu_Pengambilan_Rks_Selesai'),
                'Lokasi_Pengambilan_Rks' => $namaLokasi,
                'Status_Rks' => $request->input('Status_Rks'),
                'ID_Metode_Pengadaan' => $ID_Metode_Pengadaan,
                'ID_Metode_Penawaran' => $ID_Metode_Penawaran,
                'ID_Metode_Evaluasi_Penawaran' => $ID_Metode_Evaluasi_Penawaran,
                'ID_Klasifikasi' => $ID_Klasifikasi,
                'Kualifikasi_Pengadaan' => $request->input('Kualifikasi_Pengadaan'),
                'Kualifikasi_CSMS' => $request->input('Kualifikasi_CSMS'),
                'Target_Selesai_Rks' => $request->input('Target_Selesai_Rks'),
                'Info_Tambahan' => strip_tags($request->input('Info_Tambahan')),
                'Tanggal_Rks' => $request->input('Tanggal_Rks'),
                'Kualifikasi_Peserta_Pengadaan' => $request->input('Kualifikasi_Peserta_Pengadaan'),
                'nama_user_1'=> $ID_Pengguna1,
                'nama_rendan_1'=> $ID_Pengguna2,
                'url_rks' => $request->input('url_rks'),
            ]);
            $ringkasanRKS->save();

        // \Log::info('Ringkasan RKS saved successfully:', ['ringkasanRKS' => $ringkasanRKS]);
            return redirect()->route('adminrendan.detail', ['ID_Pengadaan' => $ID_Pengadaan])->with('success', 'Ringkasan RKS berhasil disimpan');
        } catch (\Exception $e) {
            \Log::error('Validation error: ' . $e->getMessage());
            \Log::error('Error saat menyimpan data: ' . $e->getMessage());
    
            return redirect()->route('adminrendan.detail', ['ID_Pengadaan' => $ID_Pengadaan])->with('error', 'Terjadi kesalahan saat menyimpan Ringkasan RKS');
        }
}

// public function edit($ID_Pengadaan, $ID_Ringkasan_Rks)
// {
//     $pengadaan = Pengadaan::findorfail($ID_Pengadaan);
//     $ringkasanRKS = RingkasanRKS::findorfail($ID_Ringkasan_Rks);
//     $kotaOptions = Kota::all();
//     $klasifikasiOptions = KlasifikasiBaku::all();
//     $metodePengadaanOptions = MetodePengadaan::all();
//     $metodePenawaranOptions = MetodePenawaran::all();
//     $metodeEvaluasiPenawaranOptions = MetodeEvaluasiPenawaran::all();
//     $divisi1Options = User::where('id_divisi', 3)->get();
//     $divisi2Options = User::where('id_role', 6)->get();

//     return view('rks.edit', compact('pengadaan', 'ringkasanRKS', 'kotaOptions', 'klasifikasiOptions', 'metodePengadaanOptions', 'metodePenawaranOptions', 'metodeEvaluasiPenawaranOptions', 'divisi1Options', 'divisi2Options'));
// }

// public function update(Request $request, $ID_Pengadaan, $ID_Ringkasan_Rks)
// {
//     try {
//         // Validasi data
//         $validatedData = $request->validate([
//             'Status_Rks' => 'in:Ada di DRP, Tidak Ada di DRP',
//             'Kualifikasi_Pengadaan' => 'in:Prakualifikasi, Pasca Kualifikasi',
//             'Kualifikasi_CSMS' => 'in:Tidak Perlu, Perlu',
//             'url_rks' => 'nullable|url',
//         ]);

//         // Proses update
//         $namaKota = $request->input('kota');
//         $kota = Kota::where('Kota', $namaKota)->first();
//         $ID_Kota = $kota->ID_Kota;
        
//         $namaLokasi = $request->input('lokasi');
//         $lokasi = Kota::where('Kota', $namaLokasi)->first();
//         $ID_Lokasi = $lokasi->ID_Kota;

//         $namaMetodePengadaan = $request->input('Metode_Pengadaan');
//         $metodePengadaan = MetodePengadaan::where('Metode_Pengadaan', $namaMetodePengadaan)->first();
//         $ID_Metode_Pengadaan = $metodePengadaan->ID_Metode_Pengadaan;

//         $namaMetodePenawaran = $request->input('Metode_Penawaran');
//         $metodePenawaran = MetodePenawaran::where('Metode_Penawaran', $namaMetodePenawaran)->first();
//         $ID_Metode_Penawaran = $metodePenawaran->ID_Metode_Penawaran;

//         $namaMetodeEvaluasiPenawaran = $request->input('Metode_Evaluasi_Penawaran');
//         $metodeEvaluasiPenawaran = MetodeEvaluasiPenawaran::where('Metode_Evaluasi_Penawaran', $namaMetodeEvaluasiPenawaran)->first();
//         $ID_Metode_Evaluasi_Penawaran = $metodeEvaluasiPenawaran->ID_Metode_Evaluasi_Penawaran;

//         $namaKlasifikasi = $request->input('klasifikasi_baku');
//         $klasifikasi = KlasifikasiBaku::where('Nomor_Klasifikasi', $namaKlasifikasi)->first();
//         $ID_Klasifikasi = $klasifikasi->ID_Klasifikasi;

//         $namaPengguna1 = $request->input('divisiUser1');
//         $pengguna1 = User::where('name', $namaPengguna1)->first();
//         $ID_Pengguna1 = $pengguna1->name;

//         $namaPengguna2 = $request->input('divisiUser2');
//         $pengguna2 = User::where('name', $namaPengguna2)->first();
//         $ID_Pengguna2 = $pengguna2->name;

//         $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
//         $pengadaan->update(['id_status_rks' => 11]);
//         $pengadaan->update(['id_status_ringkasan_rks' => 7]);
//         $pengadaan->update(['id_status' => 11]);

//         $ringkasanRKS = RingkasanRKS::findorfail($ID_Ringkasan_Rks);

//         // Lakukan update sesuai kebutuhan
//         $ringkasanRKS->update([
//             'Nomor_Rks' => $request->input('Nomor_Rks'),
//             'ID_Kota' => $ID_Kota,
//             'ID_Pengadaan' => $ID_Pengadaan,
//             'Tanggal_Pengambilan_Rks_Mulai' => $request->input('Tanggal_Pengambilan_Rks_Mulai'),
//             'Tanggal_Pengambilan_Rks_Selesai' => $request->input('Tanggal_Pengambilan_Rks_Selesai'),
//             'Tanggal' => $request->input('Tanggal'),
//             'Waktu_Pengambilan_Rks_Mulai' => $request->input('Waktu_Pengambilan_Rks_Mulai'),
//             'Waktu_Pengambilan_Rks_Selesai' => $request->input('Waktu_Pengambilan_Rks_Selesai'),
//             'Lokasi_Pengambilan_Rks' => $namaLokasi,
//             'Status_Rks' => $request->input('Status_Rks'),
//             'ID_Metode_Pengadaan' => $ID_Metode_Pengadaan,
//             'ID_Metode_Penawaran' => $ID_Metode_Penawaran,
//             'ID_Metode_Evaluasi_Penawaran' => $ID_Metode_Evaluasi_Penawaran,
//             'ID_Klasifikasi' => $ID_Klasifikasi,
//             'Kualifikasi_Pengadaan' => $request->input('Kualifikasi_Pengadaan'),
//             'Kualifikasi_CSMS' => $request->input('Kualifikasi_CSMS'),
//             'Target_Selesai_Rks' => $request->input('Target_Selesai_Rks'),
//             'Info_Tambahan' => strip_tags($request->input('Info_Tambahan')),
//             'Tanggal_Rks' => $request->input('Tanggal_Rks'),
//             'Kualifikasi_Peserta_Pengadaan' => $request->input('Kualifikasi_Peserta_Pengadaan'),
//             'nama_user_1'=> $ID_Pengguna1,
//             'nama_rendan_1'=> $ID_Pengguna2,
//             'url_rks' => $request->input('url_rks'),
//         ]);

//         return redirect()->route('adminrendan.detail', ['ID_Pengadaan' => $ID_Pengadaan])->with('success', 'Ringkasan RKS berhasil diperbarui');
//     } catch (\Exception $e) {
//         \Log::error('Validation error: ' . $e->getMessage());
//         \Log::error('Error saat mengupdate data: ' . $e->getMessage());

//         return redirect()->route('adminrendan.detail', ['ID_Pengadaan' => $ID_Pengadaan])->with('error', 'Terjadi kesalahan saat mengupdate Ringkasan RKS');
//     }
// }



public function preview($ID_Pengadaan, $ID_Ringkasan_Rks)
    {
        $rks = RingkasanRKS::where('ID_Pengadaan', $ID_Pengadaan)->where('ID_Ringkasan_Rks', $ID_Ringkasan_Rks)->first();

        if (!$rks) {
        abort(404);
        }

        $urlRKS = $rks->url_rks;

        return redirect($urlRKS);
    }

    public function previewRingkasan($ID_Pengadaan, $ID_Ringkasan_Rks)
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

    return view('rks.tampil', compact('ID_Pengadaan','sumberAnggaran','metodePengadaan','metodePenawaran','metodeEvaluasiPenawaran','pengadaan','notaDinasPermintaan','rencanaMulaiFormatted','rencanaSelesaiFormatted','jenisPengadaan','rks', 'hpe', 'kota', 'tanggalFormatted','base64Image','types', 'pdf'));
    } else {
        \Log::error('File gambar tidak ditemukan di path yang diinginkan: ' . $pathToImage);
        return redirect()->back()->with('error', 'File gambar tidak ditemukan.');
    }
} catch (\Exception $e) {
    \Log::error('Error saat membuat file PDF: ' . $e->getMessage());
    return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat file PDF preview.');
}
}

public function downloadPreview($ID_Pengadaan, $ID_Ringkasan_Rks)
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

        $pdf = PDF::loadView('rks.preview', compact('pengadaan', 'metodePengadaan','metodePenawaran','metodeEvaluasiPenawaran','sumberAnggaran','notaDinasPermintaan','rencanaMulaiFormatted','rencanaSelesaiFormatted', 'rks', 'hpe', 'kota', 'tanggalFormatted','base64Image','types','jenisPengadaan'));
    
        return $pdf->download('preview-ringkasan-rks.pdf');
        } else {
            \Log::error('File gambar tidak ditemukan di path yang diinginkan: ' . $pathToImage);
            return redirect()->back()->with('error', 'File gambar tidak ditemukan.');
        }
    } catch (\Exception $e) {
        \Log::error('Error saat membuat file PDF: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat file PDF preview.');
    }
}

public function kirimRKS($ID_Pengadaan, $ID_Ringkasan_Rks)
{
    // Logika pengiriman pengadaan
    $user = auth()->user();
    $divisi = $user->divisi;
    $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
    $pengadaan->update(['id_status_ringkasan_rks' => 13]);
    $rks = RingkasanRKS::findOrFail($ID_Ringkasan_Rks);
    $tanggalPengajuan = Carbon::now('Asia/Jakarta');
    $rks->update(['tanggal_pengajuan' => $tanggalPengajuan]);
    // Redirect ke halaman detail
    return redirect()->route('adminrendan.detail', ['ID_Pengadaan' => $ID_Pengadaan, 'ID_Ringkasan_Rks' => $ID_Ringkasan_Rks])
    ->with('success', 'Surat RKS berhasil dikirim.');
}
}