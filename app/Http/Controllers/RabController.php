<?php

namespace App\Http\Controllers;
use App\Models\BarangRab;
use App\Models\Divisi;
use App\Models\Signatures;
use App\Models\User;
use Carbon\Carbon;
use Dompdf\Options;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\Kota;
use App\Models\Pengadaan;
use App\Models\Rab;
use App\Models\Status;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RabController extends Controller
{
    public function index(Request $request, $ID_Pengadaan)
    {
        $rabData = Pengadaan::findorfail($ID_Pengadaan);
        $newKodeBarang = $this->generateKodeBarang();
        $kota = !empty($Kota) ? Kota::find($Kota[1]) : null;
        $kotaOptions = Kota::all();

        // $divisi1Options = User::all();
        // $divisiTingkat = $this->getDivisiTingkat($request->input('total_keseluruhan'));
        // $divisiUser1 = !empty($divisiUser1) ? User::find($divisiUser1->id) : null;
        // // $divisiUser = $users->divisiUser;
        // $name = User::where('id_divisi', $divisiTingkat)->get();

        // $divisi1Options = User::where('id_divisi', 1)->get();
        // $divisiUser1 = !empty($divisiUser1) ? User::find($divisiUser1->id) : null;

        // $divisi2Options = User::where('id_divisi', 2)->get();
        // $divisiUser2 = !empty($divisiUser2) ? User::find($divisiUser2->id) : null;

        // $divisi3Options = User::where('id_divisi', 3)->get();
        // $divisiUser3 = !empty($divisiUser3) ? User::find($divisiUser3->id) : null;

    // $total_keseluruhan = $request->input('total_keseluruhan');
    $divisi1Options = User::where('id_divisi', 3)->get();
    // $divisiUser1 = !empty($divisiUser1) ? User::find($divisiUser1->name) : null;
    $divisiUser1 = !empty($name) ? User::find($name[1]) : null;
    // Set divisiUser2Options dan divisiUser3Options hanya jika total_keseluruhan memenuhi kondisi tertentu
    // $divisiUser2Options = [];
    // $divisiUser3Options = [];

    // if ($total_keseluruhan > 3000000000 && $total_keseluruhan <= 20000000000) {
    //     $divisiUser2Options = User::where('id_divisi', 2)->get();
    // } elseif ($total_keseluruhan > 20000000000 && $total_keseluruhan <= 89000000000) {
    //     $divisiUser2Options = User::where('id_divisi', 2)->get();
    //     $divisiUser3Options = User::where('id_divisi', 3)->get();
    // }

    // $divisiUser2 = !empty($divisiUser2) ? User::find($divisiUser2->id) : null;
    // $divisiUser3 = !empty($divisiUser3) ? User::find($divisiUser3->id) : null;

        return view('rab.index', compact('rabData', 'newKodeBarang', 'kota', 'kotaOptions', 'divisi1Options', 'divisiUser1'));
    }
    // public function create($Kota, $ID_Pengadaan)
    // {
    // $newKodeBarang = $this->generateKodeBarang();
    // $kota = !empty($Kota) ? Kota::find($Kota) : null;
    // $kotaOptions = Kota::all();

    // return view('rab.create', compact('newKodeBarang', 'kota', 'kotaOptions', 'ID_Pengadaan'));
    // }
    public function store(Request $request, $ID_Pengadaan)
{
    try {
        // dd($request->all());
        $validatedData = $request->validate([
            'barang.*.Nama_Barang' => 'required|max:255',
            'barang.*.Deskripsi' => 'required|string',
            'barang.*.estimasi_jumlah' => 'required|numeric',
            'barang.*.Unit' => 'required|in:Buah,Pcs,Lembar,Set',
            'barang.*.Harga' => 'required|numeric',
            'barang.*.Total' => 'numeric',
            'barang.*.Keterangan' => 'nullable|string',
            'barang.*.total_keseluruhan' => 'numeric',
        ]);
        $namaKota = $request->input('kota');
        $kota = Kota::where('Kota', $namaKota)->first();
        $ID_Kota = $kota->ID_Kota;
        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $pengadaan->update(['id_status_rab' => 7]);
        $pengadaan->update(['id_status' => 10]);

        //  $request->validate([
        //     'divisUser1' => 'required|exists:users,id_user',
        //     // 'divisUser2' => 'required|exists:users,id_user',
        //     // 'divisUser3' => 'required|exists:users,id_user',
        // ]);
        // $pengadaan->update(['id_pejabat_user_tingkat_3' => $request->input('divisiUser1')]);
        // $pengadaan->update(['id_pejabat_user_tingkat_2' => $request->input('divisiUser2')]);
        // $pengadaan->update(['id_pejabat_user_tingkat_1' => $request->input('divisiUser3')]);

        $namaUser1 = $request->input('divisiUser1');
        $user1 = User::where('name', $namaUser1)->first();
        
        $jabatanUser1 = $user1->jabatan;
        if ($user1 && $user1->name) {
            $idUser1 = $user1->name;

        $barangIDs = [];

        foreach ($validatedData['barang'] as $barangData) {
            $barang = new Barang($barangData);
            $barang->ID_Pengadaan = $pengadaan->ID_Pengadaan;
            $barang->Kode_Barang = $this->generateKodeBarang();
            // $barang->Deskripsi = strip_tags($barangData['Deskripsi']);
            // $barang->Keterangan = strip_tags($barangData['Keterangan'] ?? null);

            // Hitung total untuk setiap barang
            $barang->Total = $barangData['estimasi_jumlah'] * $barangData['Harga'];
            $barang->save();
            $barangIDs[] = $barang->ID_Barang;
            \Log::info('Data Barang berhasil disimpan: ' . $barang->toJson());
            $transaksi = new Transaksi();

            // Akumulasi total keseluruhan
            $transaksi->ID_Barang = $barang->ID_Barang;
            $transaksi->estimasi_jumlah = $barangData['estimasi_jumlah'];
            $transaksi->Unit = $barangData['Unit'];
            $transaksi->Harga = $barangData['Harga'];
            $transaksi->Total = $barangData['estimasi_jumlah'] * $barangData['Harga'];
        $transaksi->save();
        }
        $rab = Rab::create([
            'ID_Kota' => $ID_Kota,// Sesuaikan dengan field 'kota' pada form
            'tanggal' => $request->input('Tanggal'),
            'total_keseluruhan' => $request->input('total_keseluruhan'),
            'ID_Pengadaan' => $ID_Pengadaan,
            'ID_Barang' =>  $barang->ID_Barang,
            'nama_user_1'=> $idUser1,
            'jabatan_user_1' => $jabatanUser1,
        ]);
        $rab->barang()->attach($barangIDs);
        $pengadaan->save();
    }else {
        // Log nilai-nilai yang diperlukan untuk debugging
        \Log::error('User1:', ['namaUser1' => $namaUser1, 'user1' => $user1]);
    
        // Tangani kasus ketika user tidak ditemukan atau properti 'name' tidak ada
        \Log::error('User dengan nama ' . $namaUser1 . ' tidak ditemukan atau properti "name" tidak ada.');
    }
    \Log::info('Validated Data: ' . json_encode($validatedData));

        \Log::info('Data Rab berhasil disimpan: ' . $rab->toJson());

        \Log::info('Data Barang dan Transaksi berhasil disimpan');
        
        return redirect()->route('pengadaan.detail', ['ID_Pengadaan' => $ID_Pengadaan])->with('success', 'Data Barang berhasil disimpan');
    } catch (\Exception $e) {
        \Log::error('Error saat menyimpan data: ' . $e->getMessage());

        return redirect()->route('pengadaan.detail', ['ID_Pengadaan' => $ID_Pengadaan])->with('error', 'Terjadi kesalahan saat menyimpan data Barang');
    }
}

public function edit($ID_Pengadaan, $ID_RAB)
{
    $rab = Rab::findorfail($ID_RAB);
    $barangData = Barang::where('ID_Pengadaan', $ID_Pengadaan)->get();
    $rabData = Pengadaan::findorfail($ID_Pengadaan);
    $newKodeBarang = $rab->barang->first()->Kode_Barang;
    // if ($rab->barang->isNotEmpty()) {
    //     $newKodeBarang = $rab->barang->first()->Kode_Barang;
    // } else {
    //     $newKodeBarang = null; // atau nilai default lainnya sesuai kebutuhan
    // }
    $kota = $rab->ID_Kota;
    $kotaOptions = Kota::all();

        // $divisi1Options = User::all();
        // $divisiTingkat = $this->getDivisiTingkat($request->input('total_keseluruhan'));
        // $divisiUser1 = !empty($divisiUser1) ? User::find($divisiUser1->id) : null;
        // // $divisiUser = $users->divisiUser;
        // $name = User::where('id_divisi', $divisiTingkat)->get();

        // $divisi1Options = User::where('id_divisi', 1)->get();
        // $divisiUser1 = !empty($divisiUser1) ? User::find($divisiUser1->id) : null;

        // $divisi2Options = User::where('id_divisi', 2)->get();
        // $divisiUser2 = !empty($divisiUser2) ? User::find($divisiUser2->id) : null;

        // $divisi3Options = User::where('id_divisi', 3)->get();
        // $divisiUser3 = !empty($divisiUser3) ? User::find($divisiUser3->id) : null;

    // $total_keseluruhan = $request->input('total_keseluruhan');
    $divisi1Options = User::where('id_divisi', 3)->get();
    // $divisiUser1 = !empty($divisiUser1) ? User::find($divisiUser1->name) : null;
    $divisiUser1 = $rab->nama_user_1;
    // Set divisiUser2Options dan divisiUser3Options hanya jika total_keseluruhan memenuhi kondisi tertentu
    // $divisiUser2Options = [];
    // $divisiUser3Options = [];

    // if ($total_keseluruhan > 3000000000 && $total_keseluruhan <= 20000000000) {
    //     $divisiUser2Options = User::where('id_divisi', 2)->get();
    // } elseif ($total_keseluruhan > 20000000000 && $total_keseluruhan <= 89000000000) {
    //     $divisiUser2Options = User::where('id_divisi', 2)->get();
    //     $divisiUser3Options = User::where('id_divisi', 3)->get();
    // }

    // $divisiUser2 = !empty($divisiUser2) ? User::find($divisiUser2->id) : null;
    // $divisiUser3 = !empty($divisiUser3) ? User::find($divisiUser3->id) : null;

        return view('rab.edit', compact('rabData','rab','barangData', 'newKodeBarang', 'kota', 'kotaOptions', 'divisi1Options', 'divisiUser1'));
    }

    public function update(Request $request, $ID_Pengadaan, $ID_RAB)
{
    try {
        $rab = Rab::findOrFail($ID_RAB);

        $validatedData = $request->validate([
            // 'barang.*.ID_Barang' => 'required', // Menambahkan validasi untuk ID_Barang
            'barang.*.Nama_Barang' => 'required|max:255',
            'barang.*.Deskripsi' => 'required|string',
            'barang.*.estimasi_jumlah' => 'required|numeric',
            'barang.*.Unit' => 'required|in:Buah,Pcs,Lembar,Set',
            'barang.*.Harga' => 'required|numeric',
            'barang.*.Total' => 'numeric',
            'barang.*.Keterangan' => 'nullable|string',
            'barang.*.total_keseluruhan' => 'numeric',
        ]);

        $namaKota = $request->input('kota');
        $kota = Kota::where('Kota', $namaKota)->firstOrFail();
        $ID_Kota = $kota->ID_Kota;
        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);

        // Update status pada pengadaan
        $pengadaan->update(['id_status_rab' => 7]);
        $pengadaan->update(['id_status' => 10]);

        // Mendapatkan data user 1
        $namaUser1 = $request->input('divisiUser1');
        $user1 = User::where('name', $namaUser1)->firstOrFail();
        $jabatanUser1 = $user1->jabatan;
        // $idUser1 = $user1->id; // Menggunakan ID user 1, karena ID yang diharapkan oleh relasi.
        $idUser1 = $user1->name;


        // Mendapatkan data barang dan transaksi yang sudah ada
        $barangIDs = [];
        $existingBarangIDs = $rab->barang->pluck('ID_Barang')->toArray();
        foreach ($validatedData['barang'] as $barangData) {
            // $barang = Barang::findOrFail($barangData['ID_Barang']);
            $barang = Barang::updateOrCreate(['ID_Barang' => $barangData['ID_Barang'] ?? null], $barangData);
            $barang->ID_Pengadaan = $pengadaan->ID_Pengadaan;
            $barang->Kode_Barang = $this->generateKodeBarang();
            $barang->update($barangData);

            // Hitung total untuk setiap barang
            $barang->Total = $barangData['estimasi_jumlah'] * $barangData['Harga'];
            $barang->save();

            $barangIDs[] = $barang->ID_Barang;

            // Update atau buat transaksi
            $transaksi = Transaksi::updateOrCreate(
                ['ID_Barang' => $barang->ID_Barang],
                [
                    'estimasi_jumlah' => $barangData['estimasi_jumlah'],
                    'Unit' => $barangData['Unit'],
                    'Harga' => $barangData['Harga'],
                    'Total' => $barang->Total,
                ]
            );
            $transaksi->ID_Barang = $barang->ID_Barang;
            $transaksi->save();
        }
        $deletedBarangIDs = array_diff($existingBarangIDs, $barangIDs);
        Transaksi::whereIn('ID_Barang', $deletedBarangIDs)->delete();
        Barang::whereIn('ID_Barang', $deletedBarangIDs)->delete();

        // Update data pada tabel RAB
        $rab->update([
            'ID_Kota' => $ID_Kota,
            'tanggal' => $request->input('Tanggal'),
            'total_keseluruhan' => $request->input('total_keseluruhan'),
            'ID_Pengadaan' => $ID_Pengadaan,
            'ID_Barang' => $barangIDs[0], // Pilih salah satu ID_Barang karena update pada tabel RAB
            'nama_user_1' => $idUser1,
            'jabatan_user_1' => $jabatanUser1,
        ]);

        // Detach dan attach untuk menyinkronkan relasi many-to-many dengan barang
        $rab->barang()->detach();
        $rab->barang()->attach($barangIDs);

        return redirect()->route('pengadaan.detail', ['ID_Pengadaan' => $ID_Pengadaan])
            ->with('success', 'Data Barang berhasil disimpan');
    } catch (\Exception $e) {
        \Log::error('Error saat menyimpan data: ' . $e->getMessage());

        return redirect()->route('pengadaan.detail', ['ID_Pengadaan' => $ID_Pengadaan])
            ->with('error', 'Terjadi kesalahan saat menyimpan data Barang');
    }
}
    public function status(Request $request)
    {
        $selectedStatus = $request->input('status', 'semua');
        $searchKeyword = $request->input('search');

        $query = Rab::query();

        if ($selectedStatus !== 'semua') {
            $query->where('status', $selectedStatus);
        }

        if ($searchKeyword) {
            $query->where('tujuan', 'like', '%' . $searchKeyword . '%');
        }

        // Hanya menampilkan pengadaan barang yang diajukan oleh pengguna yang sedang login.
        $query->where('id_user', auth()->user()->id_user);

        $query = Rab::query();
        $rabData = $query->get();
        $id_user = auth()->user()->id_user;
        $rabData->id_user = $id_user;
        $rabDataUser = Rab::where('id_user', $id_user)->get();


        return view('rab.status', compact('rabData', 'selectedStatus', 'rabDataUser', 'searchKeyword'));
    }
    public function detail($ID_Pengadaan)
    {
        $rabData = Rab::findOrFail($ID_Pengadaan);

        return view('rab.templatepdf.tampil', compact('rabData'));
    }

    public function generateKodeBarang()
    {

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $latestBarang = Barang::latest()->first(); // Ambil barang terakhir
        $newKodeBarang = 'B0001'; // Default jika belum ada barang

        if ($latestBarang) {
            $lastKodeNumber = intval(substr($latestBarang->Kode_Barang, 1));
            $newKodeNumber = $lastKodeNumber + 1;
            $randomString = 'B' . str_shuffle($characters);
            $newKodeBarang = substr($randomString, 0, 8);
        }

        return $newKodeBarang;
    }

    public function preview($ID_Pengadaan, $ID_RAB)
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
    // $typesuser1 = $rab->tanda_tangan_user_1->mime_type;
    // Mengambil path gambar dari direktori lokal
    $pathToImage = public_path('dashboard/template/images/logo1.jpg');

    // Memeriksa apakah file gambar ada
    if (file_exists($pathToImage)) {
    // Mengonversi gambar ke dalam base64
    $base64Image = base64_encode(File::get($pathToImage));
    $types = pathinfo($pathToImage, PATHINFO_EXTENSION);
    
    $pdf = PDF::loadView('rab.preview', compact('pengadaan', 'rab', 'kota','barangs', 'tanggalFormatted','base64Image','types'));

    return view('rab.templatepdf.tampil', compact('ID_Pengadaan','pengadaan', 'rab', 'kota','barangs', 'tanggalFormatted','base64Image','types', 'pdf'));
    } else {
        \Log::error('File gambar tidak ditemukan di path yang diinginkan: ' . $pathToImage);
        return redirect()->back()->with('error', 'File gambar tidak ditemukan.');
    }
} catch (\Exception $e) {
    \Log::error('Error saat membuat file PDF: ' . $e->getMessage());
    return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat file PDF preview.');
}
}

public function downloadPreview($ID_Pengadaan, $ID_RAB)
{
    try {
        // Ambil data berdasarkan ID_Pengadaan dan ID_RAB
        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
        $rab = Rab::findOrFail($ID_RAB);
        $kota = Kota::find($rab->ID_Kota);
        $barangs = $rab->barang()->with('transaksi')->get();
        $tanggalFormatted = Carbon::parse($rab->tanggal)->format('d F Y');
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

        $pdf = PDF::loadView('rab.preview', compact('pengadaan', 'rab', 'kota','barangs', 'tanggalFormatted','base64Image','types'));
    
        return $pdf->download('preview-rab.pdf');
        } else {
            \Log::error('File gambar tidak ditemukan di path yang diinginkan: ' . $pathToImage);
            return redirect()->back()->with('error', 'File gambar tidak ditemukan.');
        }
    } catch (\Exception $e) {
        \Log::error('Error saat membuat file PDF: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat file PDF preview.');
    }
}

public function kirimRab($ID_Pengadaan, $ID_RAB)
{
    // Logika pengiriman pengadaan
    $user = auth()->user();
    $divisi = $user->divisi;
    $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);
    $rab = Rab::findOrFail($ID_RAB);
    $tanggalPengajuan = Carbon::now('Asia/Jakarta');
    $pengadaan->update(['id_status_rab' => 8]);
    $rab->update(['tanggal_pengajuan' => $tanggalPengajuan]);
    // Redirect ke halaman detail
    return redirect()->route('pengadaan.detail', ['ID_Pengadaan' => $ID_Pengadaan, 'ID_RAB' => $ID_RAB])
                   ->with('success', 'Pengadaan berhasil dikirim.');
}


}
