<?php

namespace App\Http\Controllers;

use App\Models\HPE;
use App\Models\JenisPengadaan;
use App\Models\Kota;
use App\Models\Pengadaan;
use App\Models\RencanaNotaDinas;
use App\Models\SumberReferensi;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Dompdf\Options;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;

class HPEController extends Controller
{
    public function index(Request $request, $ID_Pengadaan)
    {
        $pengadaan = Pengadaan::findorfail($ID_Pengadaan);
        $notaDinasPermintaan = RencanaNotaDinas::where('ID_Pengadaan', $ID_Pengadaan)->first();
        $pejabatRendanOptions = User::where('id_role', 6)->get();
        $pejabatRendan = !empty($name) ? User::find($name[1]) : null;
        $jenisPengadaan = JenisPengadaan::find($pengadaan->ID_Jenis_Pengadaan);
        $kota = !empty($Kota) ? Kota::find($Kota[1]) : null;
        $kotaOptions = Kota::all();
        // $divisi1Options = User::where('id_divisi', 3)->get();
        // $divisiUser1 = !empty($name) ? User::find($name[1]) : null;

        return view('hpe.index', compact('pengadaan','kota', 'notaDinasPermintaan','kotaOptions', 'jenisPengadaan','pejabatRendanOptions','pejabatRendan'));
    }

    public function store(Request $request, $ID_Pengadaan)
    {
        try {
        $validatedData = $request->validate([
            // 'HPE' => 'required|numeric',
            'attachment_file' => 'required|mimes:pdf,xlsx,xls|max:25000',
        ]);
        $namaKota = $request->input('kota');
        $kota = Kota::where('Kota', $namaKota)->first();
        $ID_Kota = $kota->ID_Kota;

        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $pengadaan->update(['id_status_hpe' => 7]);
        $pengadaan->update(['id_status' => 11]);

        $namaPejabatRendan = $request->input('pejabatRendan');
        $pejabatRendan = User::where('name', $namaPejabatRendan)->first();
        $jabatanPejabatRendan = $pejabatRendan->jabatan;

        if ($pejabatRendan && $pejabatRendan->name) {
            $idUser1 = $pejabatRendan->name;

            $checklistSumberReferensi = new SumberReferensi;
            $checklistSumberReferensi->checklist_1 = $request->has('checklist_1') ? 1 : 0;
            $checklistSumberReferensi->checklist_2 = $request->has('checklist_2') ? 1 : 0;
            $checklistSumberReferensi->checklist_3 = $request->has('checklist_3') ? 1 : 0;
            $checklistSumberReferensi->checklist_4 = $request->has('checklist_4') ? 1 : 0;
            $checklistSumberReferensi->checklist_5 = $request->has('checklist_5') ? 1 : 0;
            $checklistSumberReferensi->checklist_6 = $request->has('checklist_6') ? 1 : 0;
            $checklistSumberReferensi->checklist_7 = $request->has('checklist_7') ? 1 : 0;
            $checklistSumberReferensi->checklist_8 = $request->has('checklist_8') ? 1 : 0;
            $checklistSumberReferensi->checklist_9 = $request->has('checklist_9') ? 1 : 0;
            $checklistSumberReferensi->save();

            $ID_Sumber_Referensi = $checklistSumberReferensi->ID_Sumber_Referensi;

            \Log::info('ID_Sumber_Referensi setelah disimpan:', ['ID_Sumber_Referensi' => $ID_Sumber_Referensi]);

            $attachmentFile = $request->file('attachment_file');
            
            if ($attachmentFile) {
                $allowedFileTypes = ['pdf', 'xlsx', 'xls'];
                $fileExtension = strtolower($attachmentFile->getClientOriginalExtension());
    
                if (!in_array($fileExtension, $allowedFileTypes)) {
                    return redirect()->back()->with('error', 'File attachment harus berupa PDF atau Excel file.');
                }

                // Simpan file ke folder public/storage/attachment_hpe
                $attachmentPath = $attachmentFile->store('attachment_hpe', 'public');
            }

            $hpe = HPE::create([
                'ID_Kota' => $ID_Kota,
                'ID_Pengadaan' => $ID_Pengadaan,
                'ID_Sumber_Referensi' => $ID_Sumber_Referensi,
                'Tanggal' => $request->input('Tanggal'),
                'HPE' => $request->input('hpe'),
                'nama_pejabat_rendan'=> $idUser1,
                'jabatan_pejabat_rendan' => $jabatanPejabatRendan,
                // 'divisi_pejabat_rendan' => $jabatanPejabatRendan,
                'attachment_file' => $attachmentPath,

            ]);
            $hpe->save();

        }else {
            // Log nilai-nilai yang diperlukan untuk debugging
            \Log::error('Pejabat Rendan:', ['namaPejabatRendan' => $namaPejabatRendan, 'user1' => $pejabatRendan]);
        
            // Tangani kasus ketika user tidak ditemukan atau properti 'name' tidak ada
            \Log::error('User dengan nama ' . $namaPejabatRendan . ' tidak ditemukan atau properti "name" tidak ada.');
        }
        \Log::info('HPE saved successfully:', ['hpe' => $hpe]);
            return redirect()->route('adminrendan.detail', ['ID_Pengadaan' => $ID_Pengadaan])->with('success', 'Data Barang berhasil disimpan');
        } catch (\Exception $e) {
            \Log::error('Error saat menyimpan data: ' . $e->getMessage());
    
            return redirect()->route('adminrendan.detail', ['ID_Pengadaan' => $ID_Pengadaan])->with('error', 'Terjadi kesalahan saat menyimpan data Barang');
        }
}

public function preview($ID_Pengadaan, $ID_HPE)
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

    return view('hpe.tampil', compact('ID_Pengadaan','pengadaan','notaDinasPermintaan','rencanaMulaiFormatted','rencanaSelesaiFormatted','jenisPengadaan','sumberReferensi', 'hpe', 'kota', 'tanggalFormatted','base64Image','types', 'pdf'));
    } else {
        \Log::error('File gambar tidak ditemukan di path yang diinginkan: ' . $pathToImage);
        return redirect()->back()->with('error', 'File gambar tidak ditemukan.');
    }
} catch (\Exception $e) {
    \Log::error('Error saat membuat file PDF: ' . $e->getMessage());
    return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat file PDF preview.');
}
}

public function downloadPreview($ID_Pengadaan, $ID_HPE)
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

        $pdf = PDF::loadView('hpe.preview', compact('pengadaan', 'notaDinasPermintaan','rencanaMulaiFormatted','rencanaSelesaiFormatted', 'sumberReferensi', 'hpe', 'kota', 'tanggalFormatted','base64Image','types','jenisPengadaan'));
    
        return $pdf->download('preview-hpe.pdf');
        } else {
            \Log::error('File gambar tidak ditemukan di path yang diinginkan: ' . $pathToImage);
            return redirect()->back()->with('error', 'File gambar tidak ditemukan.');
        }
    } catch (\Exception $e) {
        \Log::error('Error saat membuat file PDF: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat file PDF preview.');
    }
}

public function kirimHpe($ID_Pengadaan, $ID_HPE)
{
    // Logika pengiriman pengadaan
    $user = auth()->user();
    $divisi = $user->divisi;
    $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
    $pengadaan->update(['id_status_hpe' => 13]);
    // Redirect ke halaman detail
    return redirect()->route('adminrendan.detail', ['ID_Pengadaan' => $ID_Pengadaan, 'ID_HPE' => $ID_HPE])
    ->with('success', 'Surat HPE berhasil dikirim.');
}
}
