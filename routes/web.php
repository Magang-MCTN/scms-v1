<?php

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JustifikasiController;
use App\Http\Controllers\NotaDinasPermintaanPelaksanaanPengadaanController;
use App\Http\Controllers\NotaDinasPermintaanPengadaanController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\PengadaanScmController;
use App\Http\Controllers\RabController;
use App\Http\Controllers\RabPengajuanController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\TuanRumahController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorLoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/vendor', [VendorController::class, 'index'])->name('vendor');
// Route::get('/pengajuan-tamu', [TamuController::class, 'createForm'])->name('tamu.create');


//auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/login/vendor', [VendorLoginController::class, 'showLoginVendorForm'])->name('loginvendor');
Route::post('/login/vendor', [VendorLoginController::class, 'loginVendor']);

// Rute untuk registrasi
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('registerform');
Route::post('/store', [AuthController::class, 'store'])->name('store');

Route::get('/register/vendor', [VendorLoginController::class, 'showRegistrationVendorForm'])->name('registervendorform');
Route::post('/store/vendor', [VendorLoginController::class, 'storeVendor'])->name('store-vendor');

Route::middleware(['auth:web_vendor', 'role:1'])->group(function () {
    // Rute yang akan dilindungi oleh middleware role "Pejabat Lakdan"
    Route::get('/vendor/approved', [VendorController::class, 'approved'])->name('vendor-page.approved');
    Route::put('/vendor/approved/{ID_Vendor}', [VendorController::class, 'approvedSetuju'])->name('vendor-page.approved-setuju');
    // Route::get('/profile/vendor', [VendorController::class, 'profile'])->name('vendor-page.profile');
    // Route::post('/profile/peserta', [VendorController::class, 'store'])->name('profile-vendor.store');
    // Route::post('/profile/add-signature/{ID_Peserta}', [VendorController::class, 'addSignature'])->name('profile-vendor.add-signature');
    // Route::post('/profile/add-signature/{ID_Vendor}', [VendorController::class, 'addSignatureVendor'])->name('profile-vendor.add-signature-vendor');
    // Route::get('/profile/{ID_Vendor}/edit', [VendorController::class, 'edit'])->name('profile-vendor.edit');
    // Route::put('/profile/{ID_Vendor}', [VendorController::class, 'update'])->name('profile-vendor.update');
    // Route::delete('/profile/{ID_Vendor}', [VendorController::class, 'delete'])->name('profile-vendor.delete');
    // Route::get('/profile/{ID_Peserta}/edit', [VendorController::class, 'editPeserta'])->name('profile-vendor-peserta.edit');
    // Route::put('/profile/{ID_Peserta}', [VendorController::class, 'updatePeserta'])->name('profile-vendor-peserta.update');
    // Route::delete('/profile/{ID_Peserta}', [VendorController::class, 'deletePeserta'])->name('profile-vendor-peserta.delete');
});

// Route::middleware(['auth', 'role:1'])->group(function () {
//     // Rute yang akan dilindungi oleh middleware role "administrator"
//     Route::get('/pengadaan_scm', [PengadaanScmController::class, 'index'])->name('pengadaan_scm.index');
//     Route::get('/pengadaan_scm/create', [PengadaanScmController::class, 'create'])->name('pengadaan_scm.create');
//     Route::post('/pengadaan_scm', [PengadaanScmController::class, 'store'])->name('pengadaan_scm.store');
//     Route::get('/status_pengadaan_scm', [PengadaanScmController::class, 'status'])->name('pengadaan_scm.status');
//     Route::get('/status_pengadaan_scm/{id}', [PengadaanScmController::class, 'detail'])->name('pengadaan_scm.detail');
// });
// Route::middleware(['auth', 'role:2'])->group(function () {
//     // Rute yang akan dilindungi oleh middleware role "Admin User"
//     Route::get('/pengadaan_scm', [PengadaanScmController::class, 'index'])->name('pengadaan_scm.index');
//     Route::get('/pengadaan_scm/create', [PengadaanScmController::class, 'create'])->name('pengadaan_scm.create');
//     Route::post('/pengadaan_scm', [PengadaanScmController::class, 'store'])->name('pengadaan_scm.store');
//     Route::get('/status_pengadaan_scm', [PengadaanScmController::class, 'status'])->name('pengadaan_scm.status');
//     Route::get('/status_pengadaan_scm/{id}', [PengadaanScmController::class, 'detail'])->name('pengadaan_scm.detail');
// });
// Route::middleware(['auth', 'role:3'])->group(function () {
//     // Rute yang akan dilindungi oleh middleware role "Admin Rendan"
//     Route::get('/pengadaan_scm', [PengadaanScmController::class, 'index'])->name('pengadaan_scm.index');
//     Route::get('/pengadaan_scm/create', [PengadaanScmController::class, 'create'])->name('pengadaan_scm.create');
//     Route::post('/pengadaan_scm', [PengadaanScmController::class, 'store'])->name('pengadaan_scm.store');
//     Route::get('/status_pengadaan_scm', [PengadaanScmController::class, 'status'])->name('pengadaan_scm.status');
//     Route::get('/status_pengadaan_scm/{id}', [PengadaanScmController::class, 'detail'])->name('pengadaan_scm.detail');
// });

Route::middleware(['auth', 'role:1,2,3,4,'])->group(function () {
    // Rute yang akan dilindungi oleh middleware role "Admin Lakdan"
    //Nota Dinas
    Route::get('/pengadaan_scm', [PengadaanScmController::class, 'index'])->name('pengadaan_scm.index');
    Route::get('/pengadaan_scm/create', [PengadaanScmController::class, 'create'])->name('pengadaan_scm.create');
    Route::post('/pengadaan_scm', [PengadaanScmController::class, 'store'])->name('pengadaan_scm.store');
    Route::get('/status_pengadaan_scm', [PengadaanScmController::class, 'status'])->name('pengadaan_scm.status');
    Route::get('/status_pengadaan_scm/{id}', [PengadaanScmController::class, 'detail'])->name('pengadaan_scm.detail');

    //Pengadaan Barang
    Route::get('/pengadaan', [PengadaanController::class, 'index'])->name('pengadaan.index');
    Route::get('/pengadaan/create', [PengadaanController::class, 'create'])->name('pengadaan.create');
    Route::post('/pengadaan', [PengadaanController::class, 'store'])->name('pengadaan.store');
    Route::get('/status_pengadaan', [PengadaanController::class, 'status'])->name('pengadaan.status');
    Route::get('/status_pengadaan/{ID_Pengadaan}', [PengadaanController::class, 'detail'])->name('pengadaan.detail');
    Route::get('/pengadaan/{ID_Pengadaan}/edit', [PengadaanController::class, 'edit'])->name('pengadaan.edit');
    Route::put('/pengadaan/{ID_Pengadaan}', [PengadaanController::class, 'update'])->name('pengadaan.update');
    Route::delete('/pengadaan/{ID_Pengadaan}', [PengadaanController::class, 'delete'])->name('pengadaan.delete');

    // Route::get('/pengadaan/detail/{ID_Pengadaan}/{dokumen}', 'PengadaanController@detail')->name('nama_route_detail');

    //RAB
    Route::get('/rab/{ID_Pengadaan}', [RabController::class, 'index'])->name('rab.index');
    Route::get('/rab/create', [RabController::class, 'create'])->name('rab.create');
    Route::post('/rab/{ID_Pengadaan}', [RabController::class, 'store'])->name('rab.store');
    Route::get('/status_rab', [RabController::class, 'status'])->name('rab.status');
    Route::get('/status_rab/{id}', [RabController::class, 'detail'])->name('rab.detail');

    //Justifikasi Pengadaan Langsung
    Route::get('/justifikasi/{ID_Pengadaan}', [JustifikasiController::class, 'index'])->name('justifikasi.index');
    Route::get('/justifikasi/create', [JustifikasiController::class, 'create'])->name('justifikasi.create');
    Route::post('/justifikasi', [JustifikasiController::class, 'store'])->name('justifikasi.store');
    Route::get('/status_justifikasi', [JustifikasiController::class, 'status'])->name('justifikasi.status');
    Route::get('/status_justifikasi/{ID_Pengadaan}', [JustifikasiController::class, 'detail'])->name('justifikasi.detail');

    //Nota Dinas Permintaan Pengadaan
    Route::get('/nota_dinas_permintaan', [NotaDinasPermintaanPengadaanController::class, 'index'])->name('nota_dinas_permintaan.index');
    Route::get('/nota_dinas_permintaan/create', [NotaDinasPermintaanPengadaanController::class, 'create'])->name('nota_dinas_permintaan.create');
    Route::post('/nota_dinas_permintaan', [NotaDinasPermintaanPengadaanController::class, 'store'])->name('nota_dinas_permintaan.store');
    Route::get('/status_nota_dinas_permintaan', [NotaDinasPermintaanPengadaanController::class, 'status'])->name('nota_dinas_permintaan.status');
    Route::get('/status_nota_dinas_permintaan/{id}', [NotaDinasPermintaanPengadaanController::class, 'detail'])->name('nota_dinas_permintaan.detail');

    //Nota Dinas Permintaan Pelaksanaan Pengadaan
    Route::get('/nota_dinas_pelaksanaan', [NotaDinasPermintaanPelaksanaanPengadaanController::class, 'index'])->name('nota_dinas_pelaksanaan.index');
    Route::get('/nota_dinas_pelaksanaan/create', [NotaDinasPermintaanPelaksanaanPengadaanController::class, 'create'])->name('nota_dinas_pelaksanaan.create');
    Route::post('/nota_dinas_pelaksanaan', [NotaDinasPermintaanPelaksanaanPengadaanController::class, 'store'])->name('nota_dinas_pelaksanaan.store');
    Route::get('/status_nota_dinas_pelaksanaan', [NotaDinasPermintaanPelaksanaanPengadaanController::class, 'status'])->name('nota_dinas_pelaksanaan.status');
    Route::get('/status_nota_dinas_pelaksanaan/{id}', [NotaDinasPermintaanPelaksanaanPengadaanController::class, 'detail'])->name('nota_dinas_pelaksanaan.detail');
});
Route::middleware(['auth', 'role:5'])->group(function () {
    // Rute yang akan dilindungi oleh middleware role "Pejabat User"

});
Route::middleware(['auth', 'role:6'])->group(function () {
    // Rute yang akan dilindungi oleh middleware role "Pejabat Rendan"

});
Route::middleware(['auth', 'role:7'])->group(function () {
    // Rute yang akan dilindungi oleh middleware role "Pejabat Lakdan"
    // Route::get('/approve-vendor/{vendor_id}', 'ApprovalController@approveVendor')->name('approve.vendor');
});

// Route::group(['middleware' => ['web_vendor', 'vendor.approval']], function () {
//     // your vendor routes
// });

// Route::group(['middleware' => ['auth', 'role:7']], function () {
//     Route::get('/approve-vendor',  [ApprovalController::class, 'approveVendor'])->name('approve.vendor');
// });

Route::middleware(['auth:web_vendor', 'role:8'])->group(function () {
    // Rute yang akan dilindungi oleh middleware role "Pejabat Lakdan"
    Route::get('/profile/vendor', [VendorController::class, 'profile'])->name('vendor-page.profile');
    Route::post('/profile/peserta', [VendorController::class, 'store'])->name('profile-vendor.store');
    Route::post('/profile/add-signature/{ID_Peserta}', [VendorController::class, 'addSignature'])->name('profile-vendor.add-signature');
    Route::post('/profile/add-signature/{ID_Vendor}', [VendorController::class, 'addSignatureVendor'])->name('profile-vendor.add-signature-vendor');
    Route::get('/profile/{ID_Vendor}/edit', [VendorController::class, 'edit'])->name('profile-vendor.edit');
    Route::put('/profile/{ID_Vendor}', [VendorController::class, 'update'])->name('profile-vendor.update');
    Route::delete('/profile/{ID_Vendor}', [VendorController::class, 'delete'])->name('profile-vendor.delete');
    Route::get('/profile/{ID_Peserta}/edit', [VendorController::class, 'editPeserta'])->name('profile-vendor-peserta.edit');
    Route::put('/profile/{ID_Peserta}', [VendorController::class, 'updatePeserta'])->name('profile-vendor-peserta.update');
    Route::delete('/profile/{ID_Peserta}', [VendorController::class, 'deletePeserta'])->name('profile-vendor-peserta.delete');
});

// Route::get('/unauthorized', function () {
//     return 'Akses Ditolak!'; // Tampilkan pesan akses ditolak
// })->name('unauthorized');


// Rute untuk logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout/vendor', [VendorLoginController::class, 'logout'])->name('logoutvendor');
Route::get('/auth/redirect', [AuthController::class, 'redirectToProvider']);
Route::get('/auth/redirect', [VendorLoginController::class, 'redirectToProvider']);
Route::get('/google/callback', [AuthController::class, 'handleProviderCallback']);
Route::get('/google/callback', [VendorLoginController::class, 'handleProviderCallback']);
