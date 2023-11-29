<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class VendorLoginController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showRegistrationVendorForm()
    {
        return view('auth.register-vendor');
    }

    public function storeVendor(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nama_perusahaan' => ['required', 'string', 'max:255'],
            'email_perusahaan' => ['required', 'string', 'email', 'max:255', 'unique:vendor'],
            'alamat_perusahaan' => ['required', 'string', 'max:255'],
            'no_telepon_perusahaan' => ['required', 'numeric'],
        ]);

        Vendor::create([
            'password' => Hash::make($request['password']),
            'nama_perusahaan' => $request['nama_perusahaan'],
            'email_perusahaan' => $request['email_perusahaan'],
            'alamat_perusahaan' => $request['alamat_perusahaan'],
            'no_telepon_perusahaan' => $request['no_telepon_perusahaan'],
            'id_role' => 8,
            'approved' => false,
            'perwakilan_daftar' => false,
        ]);
        return redirect('login/vendor')->with('success', 'Data berhasil ditambahkan.');
    }

    public function showLoginVendorForm()
    {
        return view('auth.login-vendor');
    }

    public function loginVendor(Request $request)
{
    $this->validate($request, [
        'email_perusahaan' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email_perusahaan', 'password');

    if (auth()->guard('web_vendor')->attempt($credentials)) {
        $vendor = auth()->guard('web_vendor')->user();

        if ($vendor->approved) {
            // Cek id_role dan arahkan sesuai kondisi
            if ($vendor->id_role === 1) {
                return redirect('/vendor/approved');
            } elseif ($vendor->id_role === 8) {
                return redirect('/vendor');
            }
        } else {
            auth()->guard('web_vendor')->logout();
            return redirect()->back()->withInput($request->only('email_perusahaan'))->withErrors([
                'email_perusahaan' => 'Your account has not been approved yet.',
            ]);
        }
    }

    return redirect()->back()->withInput($request->only('email_perusahaan'))->withErrors([
        'email_perusahaan' => 'These credentials do not match our records.',
    ]);
}

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }


    //tambahkan script di bawah ini
    public function handleProviderCallback(Request $request)
    {
        try {
            $user_google    = Socialite::driver('google')->user();
            $user           = Vendor::where('email_perusahaan', $user_google->getEmail())->first();

            //jika user ada maka langsung di redirect ke halaman home
            //jika user tidak ada maka simpan ke database
            //$user_google menyimpan data google account seperti email, foto, dsb

            if ($user != null) {
                auth()->login($user, true);
                return redirect()->route('dashboard');
            } else {
                $create = Vendor::Create([
                    'email_perusahaan'             => $user_google->getEmail(),
                    'name'              => $user_google->getName(),
                    'password'          => 0,
                    'email_verified_at' => now(),
                    'id_role' => 8,
                    'approved' => false,
                ]);


                auth()->login($create, true);
                return redirect()->route('dashboard');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('loginvendor');
    }
}
