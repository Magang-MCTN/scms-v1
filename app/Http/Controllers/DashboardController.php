<?php

namespace App\Http\Controllers;

// use App\Models\PengadaanBarang;
// use App\Models\Signature;
use App\Models\User;
use App\Models\PengadaanScm;
use App\Models\Vendor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        //pengadaan barang
        // $totalBarang = PengadaanBarang::count();
        // $barangDisetujui2 = PengadaanBarang::where('status', 'disetujui_admin_manager')->count();
        // $barangDisetujui1 = PengadaanBarang::where('status', 'disetujui_admin_general')->count();
        // $barangDisetujui = PengadaanBarang::where('status', 'disetujui_admin_tim')->count();
        // $barangDitolak = PengadaanBarang::where('status', 'ditolak')->count();
        // $barangDiajukan = PengadaanBarang::where('status', 'diajukan')->count();

        //pengadaan scm
        $totalScm = PengadaanScm::count();
        $scmDisetujui2 = PengadaanScm::where('status', 'disetujui_pejabat_user')->count();
        $scmDisetujui1 = PengadaanScm::where('status', 'disetujui_pejabat_rendan')->count();
        $scmDisetujui = PengadaanScm::where('status', 'disetujui_pejabat_lakdan')->count();
        $scmDitolak = PengadaanScm::where('status', 'ditolak')->count();
        $scmDiajukan = PengadaanScm::where('status', 'diajukan')->count();

        // $id_user = auth()->user()->id_user;
        $query = PengadaanScm::query();
        $pengadaanScm = $query->get();
        // $pengadaanScm->id_user = $id_user;
        $pengadaanScmUser = PengadaanScm::where('id_user', auth()->user()->id_user)->paginate(10);

        return view('dashboard.home', compact( 'pengadaanScmUser', 'totalScm', 'scmDisetujui', 'scmDitolak', 'scmDiajukan', 'scmDisetujui1', 'scmDisetujui2'));
    }
    public function getChartData()
    {

        $totalScm = PengadaanScm::count();
        $scmDiajukan = PengadaanScm::where('status', 'diajukan')->count();
        $scmDisetujui2 = PengadaanScm::where('status', 'disetujui_pejabat_user')->count();
        $scmDisetujui1 = PengadaanScm::where('status', 'disetujui_pejabat_rendan')->count();
        $scmDisetujui = PengadaanScm::where('status', 'disetujui_pejabat_lakdan')->count();
        $scmDitolak = PengadaanScm::where('status', 'ditolak')->count();

        $data = [
            'total' => $totalScm,
            'diajukan' => $scmDiajukan,
            'disetujui' => $scmDisetujui,
            'disetujui1' => $scmDisetujui1,
            'disetujui2' => $scmDisetujui2,
            'ditolak' => $scmDitolak,
        ];

        return response()->json($data);
    }

    public function signature()
    {
        return view('dashboard.upload');
    }

    public function store(Request $request)
    {
        // Validasi request


        $request->validate([
            'signature' => 'required|image|mimes:png|max:2048', // Gambar tanda tangan harus berformat PNG dan tidak melebihi 2MB.
        ]);
        $user = auth()->user(); // Mendapatkan user yang sedang login
        $signaturePath = $request->file('signature')->store('signatures', 'public'); // Simpan gambar tanda tangan di direktori 'storage/app/public/signatures'

        // Simpan tanda tangan ke dalam basis data
        // $signature = Signature::updateOrCreate(
        //     ['id_user' => $user->id],
        //     ['signature' => $signaturePath]
        // );
        // Buat atau perbarui tanda tangan user



        return redirect()->route('dashboard')->with('success', 'Tanda tangan berhasil diunggah.');
    }

    public function showDashboard()
{
    // Mendapatkan data vendor, misalnya data vendor pertama
    $vendor = Vendor::first();

    // Menampilkan view dashboard dengan mengirimkan data vendor
    return view('dashboard.home', compact('vendor'));
}
}
