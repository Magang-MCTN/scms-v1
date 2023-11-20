<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\JenisPengadaan;
use App\Models\Pengadaan;
use App\Models\Peserta;
use Illuminate\Http\Request;
use App\Models\JustifikasiPenunjukanLangsung;

class JustifikasiController extends Controller
{
    public function index(Request $request, $ID_Pengadaan, ...$ID_Jenis_Pengadaan)
    {
        $pengadaan = Pengadaan::find($ID_Pengadaan);

        $jenisPengadaan = !empty($ID_Jenis_Pengadaan) ? JenisPengadaan::find($ID_Jenis_Pengadaan[1]) : null;

        $namaPeserta = !empty($Nama_Peserta) ? Peserta::find($Nama_Peserta[]) : null;

        $justifikasiData = JustifikasiPenunjukanLangsung::all();

        $jenisPengadaanOptions = JenisPengadaan::all();

        $namaPesertaOptions = Peserta::all();

        return view('justifikasi.index', compact('justifikasiData', 'pengadaan', 'jenisPengadaan', 'jenisPengadaanOptions', 'namaPeserta', 'namaPesertaOptions'));
    }
    // public function create()
    // {
    //     return view('justifikasi.create');
    // }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Nama_Pekerjaan',
            // 'Jenis_Pengadaan' => 'in:Barang,Jasa Kontruksi,Jasa Konsultasi,Jasa Lainnya, Pengadaan Khusus',
            'Peserta_Penunjukan_Langsung',
            'Pagu_Anggaran' => 'required|numeric',
            'Rincian_Status_Kondisi',
            'Rincian_Alasan_Metode',
            'Rincian_Kriteria_Peserta_Teknis',
            'Rincian_Kriteria_Peserta_Komersial',
            'Rincian_Kriteria_Peserta_Lainnya',
            // 'kriteria' => 'nullable',
        ]);

        $anggaran = new Anggaran([
            'Pagu_Anggaran' => $validatedData['Pagu_Anggaran'],
            
        ]);
        $anggaran->save();
    
        
        $justifikasi = new JustifikasiPenunjukanLangsung([
           
        ]);
        $anggaran->justifikasi()->save($justifikasi);

        JustifikasiPenunjukanLangsung::create($validatedData);

        return redirect()->route('justifikasi.index')->with('success', 'Data Barang berhasil disimpan');
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
    public function detail($id)
    {
        $justifikasiData = JustifikasiPenunjukanLangsung::findOrFail($id);

        return view('justifikasi.detail', compact('justifikasiData'));
    }
}
