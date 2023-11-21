<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PengadaanController;
use App\Models\Pengadaan;
use App\Models\Vendor;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function index()
    {

        return view('vendor-page.index');
    }

    public function profile(...$ID_Vendor){

        $users = auth()->guard('web_vendor')->user(); // Mengambil pengguna yang sedang masuk
        // $signature = $user->signature; // Mengambil tanda tangan dari relasi
        // $signature = Signature::where('user_id', $id)->first();
        // Mengambil pengguna yang sedang masuk


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
            'signature'=> 'image|mimes:png|max:5024'
    ]);
    
    $vendorId = Auth::guard('web_vendor')->id();
    $perwakilan = new Peserta;
    $perwakilan->ID_Vendor = $vendorId;
    $perwakilan->Nama_Peserta = $validatedData['Nama_Peserta'];
    $perwakilan->jabatan = $validatedData['jabatan'];
    $perwakilan->Email_Peserta = $validatedData['Email_Peserta'];
    $perwakilan->Nomor_Kontak_Peserta = $validatedData['Nomor_Kontak_Peserta'];
    // if ($request->hasFile('signature')) {
    //     $file = $request->file('signature');
    //     $filename = time() . '.' . $file->getClientOriginalExtension();
    //     // $file->storeAs('public/storage/signatures-vendor', $filename);
    //     $file->storeAs('signatures-vendor', $filename, 'public');
    // }
    
    // $perwakilan->signature = $filename;
    $perwakilan->save();
        return redirect()->route('vendor-page.profile')->with('success', 'Data Perwakilan berhasil disimpan');
    }

}
