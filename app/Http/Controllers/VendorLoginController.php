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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:vendor'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nama_perusahaan' => ['required', 'string', 'max:255'],
            'email_perusahaan' => ['required', 'string', 'email', 'max:255', 'unique:vendor'],
            'jabatan' => ['required', 'string', 'max:255'],
            'no_telepon_perwakilan' => ['required', 'numeric'],
            'alamat_perusahaan' => ['required', 'string', 'max:255'],
            'no_telepon_perusahaan' => ['required', 'numeric'],
        ]);

        Vendor::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'nama_perusahaan' => $request['nama_perusahaan'],
            'email_perusahaan' => $request['email_perusahaan'],
            'jabatan' => $request['jabatan'],
            'no_telepon_perwakilan' => $request['no_telepon_perwakilan'],
            'alamat_perusahaan' => $request['alamat_perusahaan'],
            'no_telepon_perusahaan' => $request['no_telepon_perusahaan'],
            'id_role' => 8,
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
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->guard('web_vendor')->attempt($credentials)) {
            return redirect('/vendor');
        }

        return redirect()->back()->withInput($request->only('email'))->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }
    //tambahkan script di bawah ini
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }


    //tambahkan script di bawah ini
    public function handleProviderCallback(Request $request)
    {
        try {
            $user_google    = Socialite::driver('google')->user();
            $user           = Vendor::where('email', $user_google->getEmail())->first();

            //jika user ada maka langsung di redirect ke halaman home
            //jika user tidak ada maka simpan ke database
            //$user_google menyimpan data google account seperti email, foto, dsb

            if ($user != null) {
                auth()->login($user, true);
                return redirect()->route('dashboard');
            } else {
                $create = Vendor::Create([
                    'email'             => $user_google->getEmail(),
                    'name'              => $user_google->getName(),
                    'password'          => 0,
                    'email_verified_at' => now(),
                    'id_role' => 8,
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
