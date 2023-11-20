<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengadaanScm;
use Barryvdh\DomPDF\Facade\Pdf;

class PengadaanScmController extends Controller
{
    public function index()
    {
        $pengadaanScmData = PengadaanScm::all();
        return view('pengadaan_scm.index', compact('pengadaanScmData'));
    }

    public function create()
    {
        return view('pengadaan_scm.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nomor_pengadaan' => 'required|max:255',
            'tujuan' => 'in:Rendan,Lakdan',
            'nama_pekerjaan' => 'required|max:255',
            'ringkasan_pekerjaan' => 'required',
            'nama_pengguna' => 'required|max:255',
            'divisi_pengguna' => 'required|max:255',
            'jenis_pengadaan' => 'in:Barang,Jasa Kontruksi,Jasa Konsultasi,Jasa Lainnya, Pengadaan Khusus',
            'informasi_anggaran' => 'required|numeric',
            'sumber_anggaran' => 'in:Anggaran Investasi,Anggaran Operasi',
            'pagu_anggaran' => 'required|numeric',
            'cost_center' => 'required|numeric',
            'rencana_tanggal_terkontrak_mulai' => 'required|date',
            'rencana_tanggal_terkontrak_selesai' => 'required|date',
            'rencana_durasi_kontrak' => 'required|numeric',
            'rencana_durasi_kontrak_tanggal' => 'in:Hari Kerja,Hari Kalender,Bulan,Tahun',
            'url_kak' => 'nullable',
            'url_spesifikasi_teknis' => 'nullable',
            'perihal' => 'in:Permintaan dokumen rencana pengadaan,Permintaan pelaksanaan pengadaan',
            'judul_pengadaan' => 'in:Permintaan dokumen rencana pengadaan,Permintaan pelaksanaan pengadaan',
            'id_user',
            'status' => 'in:diajukan,ditolak,disetujui_pejabat_rendan_disetujui,disetujui_pejabat_user,disetujui_pejabat_lakdan',
            'alasan',
        ]);

        $validatedData['id_user'] = auth()->user()->id_user;
        PengadaanScm::create($validatedData);

        return redirect()->route('pengadaan_scm.index')->with('success', 'Data pengadaan berhasil disimpan');
    }

    public function status(Request $request)
    {
        $selectedStatus = $request->input('status', 'semua');
        $searchKeyword = $request->input('search');

        $query = PengadaanScm::query();

        if ($selectedStatus !== 'semua') {
            $query->where('status', $selectedStatus);
        }

        if ($searchKeyword) {
            $query->where('tujuan', 'like', '%' . $searchKeyword . '%');
        }

        // Hanya menampilkan pengadaan barang yang diajukan oleh pengguna yang sedang login.
        $query->where('id_user', auth()->user()->id_user);

        $query = PengadaanScm::query();
        $pengadaanScm = $query->get();
        $id_user = auth()->user()->id_user;
        $pengadaanScm->id_user = $id_user;
        $pengadaanScmUser = PengadaanScm::where('id_user', $id_user)->get();


        return view('pengadaan_scm.status', compact('pengadaanScm', 'selectedStatus', 'pengadaanScmUser', 'searchKeyword'));
    }
    public function detail($id)
    {
        $pengadaanScm = PengadaanScm::findOrFail($id);

        return view('pengadaan_scm.detail', compact('pengadaanScm'));
    }

    public function generatePDF(Request $request)
    {
        // Dapatkan data dari formulir
        $data = $request->all();

        // Buat PDF
        $pdf = PDF::loadView('pdf.view', ['data' => $data]);

        // Simpan PDF atau tampilkan dalam browser
        return $pdf->stream();
    }
}
