<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kota;
use App\Models\Rab;
use App\Models\Status;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class RabController extends Controller
{
    public function index(Request $request, $Kota)
    {
        $rabData = Rab::all();
        $newKodeBarang = $this->generateKodeBarang();
        $kota = !empty($Kota) ? Kota::find($Kota[1]) : null;
        $kotaOptions = Kota::all();
        return view('rab.index', compact('rabData','newKodeBarang', 'kota', 'kotaOptions'));
    }
    public function create()
    {
        return view('rab.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Kota'=> 'required',
            'Tanggal' => 'required|date',
            'Kode_Barang' => 'required|max:255',
            'Nama_Barang'=> 'required|max:255',
            'Deskripsi' => 'required|max:255',
            'Unit' => 'in:Buah,Pcs,Lembar,Set',
            'estimasi_jumlah' => 'required|numeric',
            'Harga' => 'required|numeric',
            'Total' => 'required|numeric',
            'Keterangan' => 'nullable',
            'total_keseluruhan' => 'required|numeric',
        ]);

        $rab = new Rab();
        $rab->ID_Kota = $request->input('Kota');
        $rab->Tanggal = $request->input('Tanggal');
        $rab->Deskripsi = $request->input('Deskripsi');
        $rab->save();

    foreach ($request->input('barang') as $barangData) {
        $barang = new Barang();
        $barang->ID_RAB = $rab->ID_RAB;
        $barang->Kode_Barang = $barangData['Kode_Barang'];
        $barang->Nama_Barang = $barangData['Nama_Barang'];
        $barang->Estimasi_Jumlah = $barangData['estimasi_jumlah'];
        $barang->Harga = $barangData['Harga'];
        $barang->Total = $barangData['Total'];
        $barang->Keterangan = $barangData['keterangan'];
        $barang->save();
    }

    $transaksi = new Transaksi();
    $transaksi->ID_RAB = $rab->ID_RAB;
    $transaksi->Total_Keseluruhan = $request->input('total_keseluruhan');
    $transaksi->save();

        return redirect()->route('pengadaan.index')->with('success', 'Data Barang berhasil disimpan');
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
