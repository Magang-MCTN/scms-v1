<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PengadaanController;
use App\Models\Pengadaan;
use App\Models\SignaturesVendor;
use App\Models\Vendor;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{
    public function index()
    {

        return view('vendor-page.index');
    }

    public function profile(...$ID_Vendor){

        $users = auth()->guard('web_vendor')->user(); // Mengambil pengguna yang sedang masuk
        $profile = Vendor::with('tabelPeserta');
        $users = $profile;

        return view('vendor-page.profile', compact('users'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'Nama_Peserta' => 'required|max:255' ,
            'jabatan' => 'required|max:255' ,
            'Email_Peserta' => 'required|max:255' ,
            'Nomor_Kontak_Peserta' => 'required|numeric' ,
    ]);

    $vendorId = Auth::guard('web_vendor')->id();
    $perwakilan = new Peserta;
    $perwakilan->ID_Vendor = $vendorId;
    $perwakilan->Nama_Peserta = $validatedData['Nama_Peserta'];
    $perwakilan->jabatan = $validatedData['jabatan'];
    $perwakilan->Email_Peserta = $validatedData['Email_Peserta'];
    $perwakilan->Nomor_Kontak_Peserta = $validatedData['Nomor_Kontak_Peserta'];
    $perwakilan->save();

        return redirect()->route('vendor-page.profile')->with('success', 'Data Perwakilan berhasil disimpan');
    }

    public function addSignature(Request $request, $ID_Peserta) {
        $validatedData = $request->validate([
            'signatures' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $peserta = Peserta::findOrFail($ID_Peserta);
        $signatures = new SignaturesVendor;
        $signaturesName = time() . '_' . $request->signatures->getClientOriginalName();
        $request->signatures->storeAs('signatures-vendor', $signaturesName, 'public');
        $signatures->signatures = $signaturesName;
        $peserta->signaturesVendor()->save($signatures);

        return redirect()->route('vendor-page.profile')->with('success', 'Tanda tangan berhasil ditambahkan');
    }
    public function addSignatureVendor(Request $request, $ID_Vendor) {
        $validatedData = $request->validate([
            'signatures' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $vendor = Vendor::findOrFail($ID_Vendor);
        $signatures = new SignaturesVendor;
        $signaturesName = time() . '_' . $request->signatures->getClientOriginalName();
        $request->signatures->storeAs('signatures-vendor', $signaturesName, 'public');
        $signatures->signatures = $signaturesName;
        $vendor->signaturesVendor()->save($signatures);
    
        return redirect()->route('vendor-page.profile')->with('success', 'Tanda tangan berhasil ditambahkan');
    }

    public function edit($ID_Vendor)
    {
        $perwakilan = Peserta::find($ID_Vendor);

        return view('vendor-page.edit', compact('perwakilan'));
    }

    public function editPeserta($ID_Peserta)
    {
        $perwakilan = Peserta::find($ID_Peserta);

        return view('vendor-page.edit', compact('perwakilan'));
    }

    public function update(Request $request, $ID_Peserta)
{
    $validatedData = $request->validate([
        'Nama_Peserta' => 'required|max:255' ,
        'jabatan' => 'required|max:255' ,
        'Email_Peserta' => 'required|max:255' ,
        'Nomor_Kontak_Peserta' => 'required|numeric' ,
    ]);

    $perwakilan = Peserta::find($ID_Peserta);

    $vendorId = Auth::guard('web_vendor')->id();
    $perwakilan->ID_Vendor = $vendorId;
    $perwakilan->Nama_Peserta = $validatedData['Nama_Peserta'];
    $perwakilan->jabatan = $validatedData['jabatan'];
    $perwakilan->Email_Peserta = $validatedData['Email_Peserta'];
    $perwakilan->Nomor_Kontak_Peserta = $validatedData['Nomor_Kontak_Peserta'];
    $perwakilan->save();

    return redirect()->route('vendor-page.profile')->with('success', 'Data Peserta berhasil diperbarui');
}


public function delete($ID_Peserta)
{

    $perwakilan = Peserta::find($ID_Peserta);

    if (!$perwakilan) {
        return redirect()->route('vendor-page.profile', compact('perwakilan'))->with('error', 'Data peserta tidak ditemukan');
    }

    $perwakilan->delete();

    return redirect()->route('vendor-page.profile',  compact('perwakilan'))->with('success', 'Data peserta berhasil dihapus');
}

public function approved(Request $request, ...$ID_Vendor){

    // $vendors = Vendor::find($ID_Vendor);

    // if ($vendors && auth()->guard('web_vendor')->user()->id_role === 8) {
    //     $vendors->update([
    //         'approved' => true,
    //     ]);

    //     return redirect()->back()->with('success', 'Vendor berhasil disetujui.');
    // }

    // return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan tindakan ini atau ID Vendor tidak valid.');
    $vendors = auth()->guard('web_vendor')->user();
    $approved = Vendor::all();
    $vendors = $approved;

    // if (auth()->guard('web_vendor')->user()->id_role === 1) {
    //     $vendors = Vendor::find($ID_Vendor);

    //     if ($vendors) {
    //         $vendors->update([
    //             'approved' => true,
    //         ]);

    //         return redirect()->back()->with('success', 'Vendor berhasil disetujui.');
    //     }
    // }
    // return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan tindakan ini.');
    return view('vendor-page.approved', compact('vendors'));
}

public function approvedSetuju($ID_Vendor){
    $vendors = Vendor::find($ID_Vendor);

    if ($vendors && auth()->guard('web_vendor')->user()->id_role === 1) {
        $vendors->update([
            'approved' => true,
        ]);

        return redirect()->back()->with('success', 'Vendor berhasil disetujui.');
    }

    return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan tindakan ini atau ID Vendor tidak valid.');
}
}