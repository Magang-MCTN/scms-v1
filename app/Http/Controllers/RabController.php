<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\Kota;
use App\Models\Pengadaan;
use App\Models\Rab;
use App\Models\Status;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class RabController extends Controller
{
    public function index($ID_Pengadaan)
    {
        // $barangId = Pengadaan::findorfail($ID_Pengadaan);
        $rabData = Pengadaan::findorfail($ID_Pengadaan);
        // $pengadaan = Pengadaan::find($ID_Pengadaan);
        // $pengadaanData = Pengadaan::find($ID_Pengadaan);
        $newKodeBarang = $this->generateKodeBarang();
        // $kota = !empty($Kota) ? Kota::find($Kota[1]) : null;
        // $kotaOptions = Kota::all();
        return view('rab.index', compact('rabData', 'newKodeBarang'));
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

        $pengadaan = Pengadaan::findOrFail($ID_Pengadaan);

        foreach ($validatedData['barang'] as $barangData) {
            $barang = new Barang($barangData);
            $barang->ID_Pengadaan = $pengadaan->ID_Pengadaan;
            $barang->Kode_Barang = $this->generateKodeBarang();

            // Hitung total untuk setiap barang
            $barang->Total = $barangData['estimasi_jumlah'] * $barangData['Harga'];
            $barang->total_keseluruhan += $barang->Total;
            $barang->save();
        }

        $transaksi = new Transaksi();

            // Akumulasi total keseluruhan
            $transaksi->ID_Barang = $barang->ID_Barang;
            $transaksi->estimasi_jumlah = $barangData['estimasi_jumlah'];
            $transaksi->Unit = $barangData['Unit'];
            $transaksi->Harga = $barangData['Harga'];
            $transaksi->Total = $barangData['estimasi_jumlah'] * $barangData['Harga'];
            $transaksi->total_keseluruhan += $transaksi->Total;

            $barang = new Barang($barangData);
            // $barang->ID_Pengadaan = $barangId->ID_Pengadaan;

        $transaksi->save();

        \Log::info('Data Barang dan Transaksi berhasil disimpan');
        
        return redirect()->route('pengadaan.index')->with('success', 'Data Barang berhasil disimpan');
    } catch (\Exception $e) {
        \Log::error('Error saat menyimpan data: ' . $e->getMessage());

        return redirect()->route('pengadaan.index')->with('error', 'Terjadi kesalahan saat menyimpan data Barang');
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
    public function detail($id)
    {
        $rabData = Rab::findOrFail($id);

        return view('rab.detail', compact('rabData'));
    }

    public function generateKodeBarang()
    {
        $latestBarang = Barang::latest()->first(); // Ambil barang terakhir
        $newKodeBarang = 'B0001'; // Default jika belum ada barang

        if ($latestBarang) {
            // Jika ada barang sebelumnya, generate kode berikutnya
            $lastKodeNumber = intval(substr($latestBarang->Kode_Barang, 1)); // Ambil angka dari kode terakhir
            $newKodeNumber = $lastKodeNumber + 1;
            $newKodeBarang = 'B' . sprintf('%04d', $newKodeNumber);
        }

        return $newKodeBarang;
    }

}
