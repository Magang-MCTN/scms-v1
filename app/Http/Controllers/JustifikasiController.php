<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\JenisPengadaan;
use App\Models\Kota;
use App\Models\Kriteria;
use App\Models\Pengadaan;
use App\Models\Peserta;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\JustifikasiPenunjukanLangsung;
use Carbon\Carbon;
use Dompdf\Options;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;

class JustifikasiController extends Controller
{
    public function index(Request $request, $ID_Pengadaan)
    {
        $justifikasiID = Pengadaan::findorfail($ID_Pengadaan);
        $jenisPengadaan = !empty($ID_Jenis_Pengadaan) ? JenisPengadaan::find($ID_Jenis_Pengadaan[1]) : null;
        $namaPeserta = !empty($nama_perusahaan) ? Vendor::find($nama_perusahaan[1]) : null;
        $justifikasiData = JustifikasiPenunjukanLangsung::all();
        $jenisPengadaanOptions = JenisPengadaan::all();
        $namaPesertaOptions = Vendor::all();
        $kota = !empty($Kota) ? Kota::find($Kota[1]) : null;
        $kotaOptions = Kota::all();
        $divisi1Options = User::where('id_divisi', 3)->get();
        $divisiUser1 = !empty($name) ? User::find($name[1]) : null;

        return view('justifikasi.index', compact('justifikasiID','justifikasiData','kota', 'kotaOptions', 'jenisPengadaan', 'jenisPengadaanOptions', 'namaPeserta', 'namaPesertaOptions','divisi1Options', 'divisiUser1'));
    }
    // public function create()
    // {
    //     return view('justifikasi.create');
    // }
    public function store(Request $request, $ID_Pengadaan)
    {
        try {
        $validatedData = $request->validate([
            'pagu_anggaran' => 'required',
            'Rincian_Status_Kondisi',
            'Rincian_Alasan_Metode',
            'Rincian_Kriteria_Peserta_Teknis',
            'Rincian_Kriteria_Peserta_Komersial',
            'Rincian_Kriteria_Peserta_Lainnya',
        ]);
        $namaKota = $request->input('kota');
        $kota = Kota::where('Kota', $namaKota)->first();
        $ID_Kota = $kota->ID_Kota;

        $namaJenisPengadaan = $request->input('jenis_pengadaan');
        $jenisPengadaan = JenisPengadaan::where('Jenis_Pengadaan', $namaJenisPengadaan)->first();
        $ID_Jenis_Pengadaan = $jenisPengadaan->ID_Jenis_Pengadaan;

        $namaPerusahaan = $request->input('nama_perusahaan');
        $perusahaan = Vendor::where('nama_perusahaan', $namaPerusahaan)->first();
        $ID_Vendor = $perusahaan->nama_perusahaan;

        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $pengadaan->update(['id_status_justifikasi' => 7]);
        $pengadaan->update(['id_status' => 10]);

        $namaUser1 = $request->input('divisiUser1');
        $user1 = User::where('name', $namaUser1)->first();
        $jabatanUser1 = $user1->jabatan;

        if ($user1 && $user1->name) {
            $idUser1 = $user1->name;

            $checklistKriteria = new Kriteria;
            $checklistKriteria->checklist_1 = $request->has('checklist_1') ? 1 : 0;
            $checklistKriteria->checklist_2 = $request->has('checklist_2') ? 1 : 0;
            $checklistKriteria->checklist_3 = $request->has('checklist_3') ? 1 : 0;
            $checklistKriteria->checklist_4 = $request->has('checklist_4') ? 1 : 0;
            $checklistKriteria->checklist_5 = $request->has('checklist_5') ? 1 : 0;
            $checklistKriteria->checklist_6 = $request->has('checklist_6') ? 1 : 0;
            $checklistKriteria->checklist_7 = $request->has('checklist_7') ? 1 : 0;
            $checklistKriteria->checklist_8 = $request->has('checklist_8') ? 1 : 0;
            $checklistKriteria->checklist_9 = $request->has('checklist_9') ? 1 : 0;
            $checklistKriteria->checklist_10 = $request->has('checklist_10') ? 1 : 0;
            $checklistKriteria->checklist_11 = $request->has('checklist_11') ? 1 : 0;
            $checklistKriteria->checklist_12 = $request->has('checklist_12') ? 1 : 0;
            $checklistKriteria->checklist_13 = $request->has('checklist_13') ? 1 : 0;
            $checklistKriteria->checklist_14 = $request->has('checklist_14') ? 1 : 0;
            $checklistKriteria->checklist_15 = $request->has('checklist_15') ? 1 : 0;
            $checklistKriteria->checklist_16 = $request->has('checklist_16') ? 1 : 0;
            $checklistKriteria->checklist_17 = $request->has('checklist_17') ? 1 : 0;
            $checklistKriteria->checklist_18 = $request->has('checklist_18') ? 1 : 0;
            $checklistKriteria->checklist_19 = $request->has('checklist_19') ? 1 : 0;
            $checklistKriteria->checklist_20 = $request->has('checklist_20') ? 1 : 0;
            $checklistKriteria->checklist_21 = $request->has('checklist_21') ? 1 : 0;
            $checklistKriteria->checklist_22 = $request->has('checklist_22') ? 1 : 0;
            $checklistKriteria->checklist_23 = $request->has('checklist_23') ? 1 : 0;
            $checklistKriteria->checklist_24 = $request->has('checklist_24') ? 1 : 0;
            $checklistKriteria->checklist_25 = $request->has('checklist_25') ? 1 : 0;
            $checklistKriteria->checklist_26 = $request->has('checklist_26') ? 1 : 0;
            $checklistKriteria->checklist_27 = $request->has('checklist_27') ? 1 : 0;
            $checklistKriteria->checklist_28 = $request->has('checklist_28') ? 1 : 0;
            $checklistKriteria->checklist_29 = $request->has('checklist_29') ? 1 : 0;
            $checklistKriteria->checklist_30 = $request->has('checklist_30') ? 1 : 0;
            $checklistKriteria->checklist_31 = $request->has('checklist_31') ? 1 : 0;
            $checklistKriteria->save();

            $ID_Kriteria = $checklistKriteria->ID_Kriteria;

            \Log::info('ID_Kriteria setelah disimpan:', ['ID_Kriteria' => $ID_Kriteria]);


            $justifikasi = JustifikasiPenunjukanLangsung::create([
                'ID_Kota' => $ID_Kota,
                'ID_Pengadaan' => $ID_Pengadaan,
                'ID_Kriteria' => $ID_Kriteria,
                'Tanggal' => $request->input('Tanggal'),
                'pagu_anggaran' => $request->input('pagu_anggaran'),
                'nama_perusahaan' => $ID_Vendor,
                'nama_user_1'=> $idUser1,
                'jabatan_user_1' => $jabatanUser1,
                'Rincian_Status_Kondisi' => strip_tags($request->input('Rincian_Status_Kondisi')),
                'Rincian_Alasan_Metode' => strip_tags($request->input('Rincian_Alasan_Metode')),
                'Rincian_Kriteria_Peserta_Teknis' => strip_tags($request->input('Rincian_Kriteria_Peserta_Teknis')),
                'Rincian_Kriteria_Peserta_Komersial' => strip_tags($request->input('Rincian_Kriteria_Peserta_Komersial')),
                'Rincian_Kriteria_Peserta_Lainnya' => strip_tags($request->input('Rincian_Kriteria_Peserta_Lainnya')),


            ]);
            $justifikasi->save();

            $jenisPengadaanisi = $pengadaan->update([
                'ID_Jenis_Pengadaan' => $ID_Jenis_Pengadaan,
            ]);
            // $jenisPengadaanisi->save();

        }else {
            // Log nilai-nilai yang diperlukan untuk debugging
            \Log::error('User1:', ['namaUser1' => $namaUser1, 'user1' => $user1]);
        
            // Tangani kasus ketika user tidak ditemukan atau properti 'name' tidak ada
            \Log::error('User dengan nama ' . $namaUser1 . ' tidak ditemukan atau properti "name" tidak ada.');
        }
        \Log::info('Justifikasi saved successfully:', ['justifikasi' => $justifikasi]);
            return redirect()->route('pengadaan.detail', ['ID_Pengadaan' => $ID_Pengadaan])->with('success', 'Data Barang berhasil disimpan');
        } catch (\Exception $e) {
            \Log::error('Error saat menyimpan data: ' . $e->getMessage());
    
            return redirect()->route('pengadaan.detail', ['ID_Pengadaan' => $ID_Pengadaan])->with('error', 'Terjadi kesalahan saat menyimpan data Barang');
        }
}

public function edit(Request $request, $ID_Pengadaan, $ID_JPL)
{
    $justifikasiID = JustifikasiPenunjukanLangsung::findorfail($ID_JPL);
    $pengadaan = Pengadaan::findorfail($ID_Pengadaan);
    $jenisPengadaan = $pengadaan->ID_Jenis_Pengadaan;
    $jenisPengadaanOptions = JenisPengadaan::all();
        $namaPeserta = $justifikasiID->nama_perusahaan;
        $namaPesertaOptions = Vendor::all();
        $kota = $justifikasiID->ID_Kota;
        $kotaOptions = Kota::all();
        $kriteria = Kriteria::find($justifikasiID->ID_Kriteria);
        $rencanaMulaiFormatted = Carbon::parse($pengadaan->rencana_tanggal_terkontrak_mulai)->format('d F Y');
        $rencanaSelesaiFormatted = Carbon::parse($pengadaan->rencana_tanggal_terkontrak_selesai)->format('d F Y');
        $divisi1Options = User::where('id_divisi', 3)->get();
        $divisiUser1 = $justifikasiID->nama_user_1;

        return view('justifikasi.edit', compact('pengadaan','justifikasiID','kriteria','kota', 'kotaOptions','namaPeserta','namaPesertaOptions','jenisPengadaan','jenisPengadaanOptions', 'rencanaMulaiFormatted','rencanaSelesaiFormatted','divisi1Options', 'divisiUser1'));
}

public function update(Request $request, $ID_Pengadaan, $ID_JPL)
{
    try {
        // Validasi data
        $validatedData = $request->validate([
            // 'Status_Rks' => 'in:Ada di DRP, Tidak Ada di DRP',
            // 'Kualifikasi_Pengadaan' => 'in:Prakualifikasi, Pasca Kualifikasi',
            // 'Kualifikasi_CSMS' => 'in:Tidak Perlu, Perlu',
            // 'url_rks' => 'nullable|url',
        ]);

        // Proses update
        $namaKota = $request->input('kota');
        $kota = Kota::where('Kota', $namaKota)->first();
        $ID_Kota = $kota->ID_Kota;

        $namaJenisPengadaan = $request->input('jenis_pengadaan');
        $jenisPengadaan = JenisPengadaan::where('Jenis_Pengadaan', $namaJenisPengadaan)->first();
        $ID_Jenis_Pengadaan = $jenisPengadaan->ID_Jenis_Pengadaan;

        $namaPerusahaan = $request->input('nama_perusahaan');
        $perusahaan = Vendor::where('nama_perusahaan', $namaPerusahaan)->first();
        $ID_Vendor = $perusahaan->nama_perusahaan;

        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $pengadaan->update(['id_status_justifikasi' => 7]);
        $pengadaan->update(['id_status' => 10]);
        $pengadaan->update(['ID_Jenis_Pengadaan' => $ID_Jenis_Pengadaan]);

        $namaUser1 = $request->input('divisiUser1');
        $user1 = User::where('name', $namaUser1)->first();
        $jabatanUser1 = $user1->jabatan;
        $idUser1 = $user1->name;

            $justifikasi = JustifikasiPenunjukanLangsung::findorfail($ID_JPL);
            $checklistKriteria = Kriteria::find($justifikasi->ID_Kriteria);

            $checklistKriteria->update([
            'checklist_1' => $request->has('checklist_1') ? 1 : 0,
            'checklist_2' => $request->has('checklist_2') ? 1 : 0,
            'checklist_3' => $request->has('checklist_3') ? 1 : 0,
            'checklist_4' => $request->has('checklist_4') ? 1 : 0,
            'checklist_5' => $request->has('checklist_5') ? 1 : 0,
            'checklist_6' => $request->has('checklist_6') ? 1 : 0,
            'checklist_7' => $request->has('checklist_7') ? 1 : 0,
            'checklist_8' => $request->has('checklist_8') ? 1 : 0,
            'checklist_9' => $request->has('checklist_9') ? 1 : 0,
            'checklist_10' => $request->has('checklist_10') ? 1 : 0,
            'checklist_11' => $request->has('checklist_11') ? 1 : 0,
            'checklist_12' => $request->has('checklist_12') ? 1 : 0,
            'checklist_13' => $request->has('checklist_13') ? 1 : 0,
            'checklist_14' => $request->has('checklist_14') ? 1 : 0,
            'checklist_15' => $request->has('checklist_15') ? 1 : 0,
            'checklist_16' => $request->has('checklist_16') ? 1 : 0,
            'checklist_17' => $request->has('checklist_17') ? 1 : 0,
            'checklist_18' => $request->has('checklist_18') ? 1 : 0,
            'checklist_19' => $request->has('checklist_19') ? 1 : 0,
            'checklist_20' => $request->has('checklist_20') ? 1 : 0,
            'checklist_21' => $request->has('checklist_21') ? 1 : 0,
            'checklist_22' => $request->has('checklist_22') ? 1 : 0,
            'checklist_23' => $request->has('checklist_23') ? 1 : 0,
            'checklist_24' => $request->has('checklist_24') ? 1 : 0,
            'checklist_25' => $request->has('checklist_25') ? 1 : 0,
            'checklist_26' => $request->has('checklist_26') ? 1 : 0,
            'checklist_27' => $request->has('checklist_27') ? 1 : 0,
            'checklist_28' => $request->has('checklist_28') ? 1 : 0,
            'checklist_29' => $request->has('checklist_29') ? 1 : 0,
            'checklist_30' => $request->has('checklist_30') ? 1 : 0,
            'checklist_31' => $request->has('checklist_31') ? 1 : 0,
            ]);
            $checklistKriteria->save();

            $ID_Kriteria = $checklistKriteria->ID_Kriteria;

            \Log::info('ID_Kriteria setelah disimpan:', ['ID_Kriteria' => $ID_Kriteria]);


            $justifikasi->update([
                'ID_Kota' => $ID_Kota,
                'ID_Pengadaan' => $ID_Pengadaan,
                'ID_Kriteria' => $ID_Kriteria,
                'Tanggal' => $request->input('Tanggal'),
                'pagu_anggaran' => $request->input('pagu_anggaran'),
                'nama_perusahaan' => $ID_Vendor,
                'nama_user_1'=> $idUser1,
                'jabatan_user_1' => $jabatanUser1,
                'Rincian_Status_Kondisi' => strip_tags($request->input('Rincian_Status_Kondisi')),
                'Rincian_Alasan_Metode' => strip_tags($request->input('Rincian_Alasan_Metode')),
                'Rincian_Kriteria_Peserta_Teknis' => strip_tags($request->input('Rincian_Kriteria_Peserta_Teknis')),
                'Rincian_Kriteria_Peserta_Komersial' => strip_tags($request->input('Rincian_Kriteria_Peserta_Komersial')),
                'Rincian_Kriteria_Peserta_Lainnya' => strip_tags($request->input('Rincian_Kriteria_Peserta_Lainnya')),

            ]);

            // $pengadaan->update([
            //     'ID_Jenis_Pengadaan' => $ID_Jenis_Pengadaan,
            // ]);

        
        \Log::info('Justifikasi saved successfully:', ['justifikasi' => $justifikasi]);
            return redirect()->route('pengadaan.detail', ['ID_Pengadaan' => $ID_Pengadaan])->with('success', 'Data Barang berhasil disimpan');
        } catch (\Exception $e) {
            \Log::error('Error saat menyimpan data: ' . $e->getMessage());
    
            return redirect()->route('pengadaan.detail', ['ID_Pengadaan' => $ID_Pengadaan])->with('error', 'Terjadi kesalahan saat menyimpan data Barang');
        }
}


    public function status(Request $request)
    {
        $selectedStatus = $request->input('status', 'semua');
        $searchKeyword = $request->input('search');

        $query = JustifikasiPenunjukanLangsung::query();

        if ($selectedStatus !== 'semua') {
            $query->where('status', $selectedStatus);
        }

        if ($searchKeyword) {
            $query->where('tujuan', 'like', '%' . $searchKeyword . '%');
        }

        // Hanya menampilkan pengadaan barang yang diajukan oleh pengguna yang sedang login.
        $query->where('id_user', auth()->user()->id_user);

        $query = JustifikasiPenunjukanLangsung::query();
        $justifikasiData = $query->get();
        $id_user = auth()->user()->id_user;
        $justifikasiData->id_user = $id_user;
        $justifikasiDataUser = JustifikasiPenunjukanLangsung::where('id_user', $id_user)->get();


        return view('justifikasi.status', compact('justifikasiData', 'selectedStatus', 'justifikasiDataUser', 'searchKeyword'));
    }
    public function detail($ID_Pengadaan)
    {
        $justifikasiData = JustifikasiPenunjukanLangsung::findOrFail($ID_Pengadaan);

        return view('justifikasi.tampil', compact('justifikasiData'));
    }

    public function preview($ID_Pengadaan, $ID_JPL)
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
    // $typesuser1 = $rab->tanda_tangan_user_1->mime_type;
    // Mengambil path gambar dari direktori lokal
    $pathToImage = public_path('dashboard/template/images/logo1.jpg');

    // Memeriksa apakah file gambar ada
    if (file_exists($pathToImage)) {
    // Mengonversi gambar ke dalam base64
    $base64Image = base64_encode(File::get($pathToImage));
    $types = pathinfo($pathToImage, PATHINFO_EXTENSION);
    
    $pdf = PDF::loadView('justifikasi.preview', compact('pengadaan','jenisPengadaan','kriteria', 'justifikasi', 'kota', 'tanggalFormatted','base64Image','types'));

    return view('justifikasi.tampil', compact('ID_Pengadaan','pengadaan','jenisPengadaan','kriteria', 'justifikasi', 'kota', 'tanggalFormatted','base64Image','types', 'pdf'));
    } else {
        \Log::error('File gambar tidak ditemukan di path yang diinginkan: ' . $pathToImage);
        return redirect()->back()->with('error', 'File gambar tidak ditemukan.');
    }
} catch (\Exception $e) {
    \Log::error('Error saat membuat file PDF: ' . $e->getMessage());
    return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat file PDF preview.');
}
}

public function downloadPreview($ID_Pengadaan, $ID_JPL)
{
    try {
        // Ambil data berdasarkan ID_Pengadaan dan ID_RAB
        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $justifikasi = JustifikasiPenunjukanLangsung::findOrFail($ID_JPL);
        $kota = Kota::find($justifikasi->ID_Kota);
        $kriteria = Kriteria::find($justifikasi->ID_Kriteria);
        $jenisPengadaan = JenisPengadaan::find($pengadaan->ID_Jenis_Pengadaan);
        $tanggalFormatted = Carbon::parse($justifikasi->Tanggal)->format('d F Y');
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

        $pdf = PDF::loadView('justifikasi.preview', compact('pengadaan', 'kriteria', 'justifikasi', 'kota', 'tanggalFormatted','base64Image','types','jenisPengadaan'));
    
        return $pdf->download('preview-justifikasi.pdf');
        } else {
            \Log::error('File gambar tidak ditemukan di path yang diinginkan: ' . $pathToImage);
            return redirect()->back()->with('error', 'File gambar tidak ditemukan.');
        }
    } catch (\Exception $e) {
        \Log::error('Error saat membuat file PDF: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat file PDF preview.');
    }
}

public function kirimJustifikasi($ID_Pengadaan, $ID_JPL)
{
    // Logika pengiriman pengadaan
    $user = auth()->user();
    $divisi = $user->divisi;
    $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
    $pengadaan->update(['id_status_justifikasi' => 8]);
    $justifikasi = JustifikasiPenunjukanLangsung::findOrFail($ID_JPL);
    $tanggalPengajuan = Carbon::now('Asia/Jakarta');
    $justifikasi->update(['tanggal_pengajuan' => $tanggalPengajuan]);
    // Redirect ke halaman detail
    return redirect()->route('pengadaan.detail', ['ID_Pengadaan' => $ID_Pengadaan, 'ID_JPL' => $ID_JPL])
                   ->with('success', 'Surat Justifikasi Penunjukan Langsung berhasil dikirim.');
}
}
