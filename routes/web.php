<?php

use App\Http\Controllers\AdminRendanController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenKualifikasiController;
use App\Http\Controllers\HPEController;
use App\Http\Controllers\JustifikasiController;
use App\Http\Controllers\NotaDinasPermintaanPelaksanaanPengadaanController;
use App\Http\Controllers\NotaDinasPermintaanPengadaanController;
use App\Http\Controllers\PejabatRendanController;
use App\Http\Controllers\PejabatUserController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\PengadaanScmController;
use App\Http\Controllers\RabController;
use App\Http\Controllers\RabPengajuanController;
use App\Http\Controllers\RingkasanRKSController;
use App\Http\Controllers\SignaturesController;
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

Route::get('/tanda_tangan/create', [SignaturesController::class, 'create'])->name('tanda_tangan.create');
Route::post('/tanda_tangan', [SignaturesController::class, 'store'])->name('tanda_tangan.store');
Route::get('/tanda_tangan/edit', [SignaturesController::class, 'edit'])->name('tanda_tangan.edit');
Route::post('/tanda_tangan/update', [SignaturesController::class, 'update'])->name('tanda_tangan.update');

Route::middleware(['auth:web_vendor', 'role:1'])->group(function () {
    // Rute yang akan dilindungi oleh middleware role "Pejabat Lakdan"
    // Route::get('/vendor', [VendorController::class, 'index'])->name('vendor');
    Route::get('/vendor/approved', [VendorController::class, 'approved'])->name('vendor-page.approved');
    Route::get('/vendor/list', [VendorController::class, 'list'])->name('vendor-page.list');
    Route::put('/vendor/approved/setuju/{ID_Vendor}', [VendorController::class, 'approvedSetuju'])->name('vendor-page.approved-setuju');
    Route::put('/vendor/approved/tolak/{ID_Vendor}', [VendorController::class, 'approvedTolak'])->name('vendor-page.approved-tolak');
    Route::delete('/vendor/approved/hapus/{ID_Vendor}', [VendorController::class, 'approvedHapus'])->name('vendor-page.approved-hapus');
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
Route::middleware(['auth', 'role:2,3,4,5,6,7'])->group(function () {
    Route::get('/rab/preview/{ID_Pengadaan}/{ID_RAB}', [RabController::class, 'preview'])->name('rab.preview');
    Route::get('/rab/preview/download/{ID_Pengadaan}/{ID_RAB}', [RabController::class, 'downloadPreview'])->name('rab.preview.download');
    Route::get('/justifikasi/preview/download/{ID_Pengadaan}/{ID_JPL}', [JustifikasiController::class, 'downloadPreview'])->name('justifikasi.preview.download');
    Route::get('/nota_dinas_permintaan/preview/{ID_Pengadaan}/{id_nota_dinas_permintaan}', [NotaDinasPermintaanPengadaanController::class, 'preview'])->name('nota_dinas_permintaan.preview');
    Route::get('/nota_dinas_permintaan/preview/download/{ID_Pengadaan}/{id_nota_dinas_permintaan}', [NotaDinasPermintaanPengadaanController::class, 'downloadPreview'])->name('nota_dinas_permintaan.preview.download');
    Route::get('/detail/pejabatrendan/{ID_Pengadaan}', [PejabatRendanController::class, 'detail'])->name('pejabatrendan.detail');
    Route::get('/hpe/preview/download/{ID_Pengadaan}/{ID_HPE}', [HPEController::class, 'downloadPreview'])->name('hpe.preview.download');
    Route::get('/hpe/preview/{ID_Pengadaan}/{ID_HPE}', [HPEController::class, 'preview'])->name('hpe.preview');
    Route::get('/rks/preview/{ID_Pengadaan}/{ID_Ringkasan_Rks}', [RingkasanRKSController::class, 'preview'])->name('rks.preview');
    Route::get('/ringkasan-rks/preview/{ID_Pengadaan}/{ID_Ringkasan_Rks}', [RingkasanRKSController::class, 'previewRingkasan'])->name('ringkasan.preview');
    Route::get('/ringkasan-rks/preview/download/{ID_Pengadaan}/{ID_Ringkasan_Rks}', [RingkasanRKSController::class, 'downloadPreview'])->name('ringkasan.preview.download');
    Route::get('/dokumen-kualifikasi/preview/{ID_Pengadaan}/{ID_Dokumen_Kualifikasi}', [DokumenKualifikasiController::class, 'preview'])->name('dokumen.preview');
    Route::get('/nota_dinas_pelaksanaan/preview/{ID_Pengadaan}/{id_nota_dinas_permintaan}', [NotaDinasPermintaanPelaksanaanPengadaanController::class, 'preview'])->name('nota_dinas_pelaksanaan.preview');
    Route::get('/nota_dinas_pelaksanaan/preview/download/{ID_Pengadaan}/{id_nota_dinas_permintaan}', [NotaDinasPermintaanPelaksanaanPengadaanController::class, 'downloadPreview'])->name('nota_dinas_pelaksanaan.preview.download');

});

Route::middleware(['auth', 'role:1,2,4,'])->group(function () {
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
    Route::get('/export-pdf/{ID_Pengadaan}/{ID_RAB}', [RabController::class, 'rabPDFExport'])->name('export.pdf');

    //RAB
    Route::get('/rab/{ID_Pengadaan}', [RabController::class, 'index'])->name('rab.index');
    // Route::get('/rab/create', [RabController::class, 'create'])->name('rab.create');
    Route::post('/rab/{ID_Pengadaan}', [RabController::class, 'store'])->name('rab.store');
    Route::get('/rab/edit/{ID_Pengadaan}/{ID_RAB}', [RabController::class, 'edit'])->name('rab.edit');
    Route::put('/rab/update/{ID_Pengadaan}/{ID_RAB}', [RabController::class, 'update'])->name('rab.update');
    Route::post('/rab/rangkum/{ID_Pengadaan}', [RabController::class, 'rangkum'])->name('rab.rangkum');
    Route::get('/status_rab', [RabController::class, 'status'])->name('rab.status');
    Route::get('/status_rab/{ID_Pengadaan}', [RabController::class, 'detail'])->name('rab.detail');
    // Route::get('/rab/preview/{ID_Pengadaan}/{ID_RAB}', [RabController::class, 'preview'])->name('rab.preview');
    // Route::get('/rab/preview/download/{ID_Pengadaan}/{ID_RAB}', [RabController::class, 'downloadPreview'])->name('rab.preview.download');
    Route::get('/pengadaan/kirim/rab/{ID_Pengadaan}/{ID_RAB}', [RabController::class, 'kirimRab'])->name('rab.kirim');
    // Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    // Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');

    //Justifikasi Pengadaan Langsung
    Route::get('/justifikasi/{ID_Pengadaan}', [JustifikasiController::class, 'index'])->name('justifikasi.index');
    // Route::get('/justifikasi/create', [JustifikasiController::class, 'create'])->name('justifikasi.create');
    Route::post('/justifikasi/{ID_Pengadaan}', [JustifikasiController::class, 'store'])->name('justifikasi.store');
    Route::get('/justifikasi/edit/{ID_Pengadaan}/{ID_JPL}', [JustifikasiController::class, 'edit'])->name('justifikasi.edit');
    Route::put('/justifikasi/update/{ID_Pengadaan}/{ID_JPL}', [JustifikasiController::class, 'update'])->name('justifikasi.update');
    Route::get('/status_justifikasi', [JustifikasiController::class, 'status'])->name('justifikasi.status');
    Route::get('/status_justifikasi/{ID_Pengadaan}', [JustifikasiController::class, 'detail'])->name('justifikasi.detail');
    Route::get('/justifikasi/preview/{ID_Pengadaan}/{ID_JPL}', [JustifikasiController::class, 'preview'])->name('justifikasi.preview');
    // Route::get('/justifikasi/preview/download/{ID_Pengadaan}/{ID_JPL}', [JustifikasiController::class, 'downloadPreview'])->name('justifikasi.preview.download');
    Route::get('/pengadaan/kirim/justifikasi/{ID_Pengadaan}/{ID_JPL}', [JustifikasiController::class, 'kirimJustifikasi'])->name('justifikasi.kirim');

    //Nota Dinas Permintaan Pengadaan
    Route::get('/nota_dinas_permintaan/{ID_Pengadaan}', [NotaDinasPermintaanPengadaanController::class, 'index'])->name('nota_dinas_permintaan.index');
    // Route::get('/nota_dinas_permintaan/create', [NotaDinasPermintaanPengadaanController::class, 'create'])->name('nota_dinas_permintaan.create');
    Route::post('/nota_dinas_permintaan/{ID_Pengadaan}', [NotaDinasPermintaanPengadaanController::class, 'store'])->name('nota_dinas_permintaan.store');
    Route::get('/nota_dinas_permintaan/edit/{ID_Pengadaan}/{id_nota_dinas_permintaan}', [NotaDinasPermintaanPengadaanController::class, 'edit'])->name('nota_dinas_permintaan.edit');
    Route::put('/nota_dinas_permintaan/update/{ID_Pengadaan}/{id_nota_dinas_permintaan}', [NotaDinasPermintaanPengadaanController::class, 'update'])->name('nota_dinas_permintaan.update');
    Route::get('/status_nota_dinas_permintaan', [NotaDinasPermintaanPengadaanController::class, 'status'])->name('nota_dinas_permintaan.status');
    Route::get('/status_nota_dinas_permintaan/{ID_Pengadaan}', [NotaDinasPermintaanPengadaanController::class, 'detail'])->name('nota_dinas_permintaan.detail');
    // Route::get('/nota_dinas_permintaan/preview/download/{ID_Pengadaan}/{id_nota_dinas_permintaan}', [NotaDinasPermintaanPengadaanController::class, 'downloadPreview'])->name('nota_dinas_permintaan.preview.download');
    Route::get('/pengadaan/kirim/nota_dinas_permintaan/{ID_Pengadaan}/{id_nota_dinas_permintaan}', [NotaDinasPermintaanPengadaanController::class, 'kirimNotaDinasPermintaan'])->name('nota_dinas_permintaan.kirim');

    //Nota Dinas Permintaan Pelaksanaan Pengadaan
    Route::get('/nota_dinas_pelaksanaan/{ID_Pengadaan}/{id_nota_dinas_permintaan}', [NotaDinasPermintaanPelaksanaanPengadaanController::class, 'index'])->name('nota_dinas_pelaksanaan.index');
    // Route::get('/nota_dinas_permintaan/create', [NotaDinasPermintaanPelaksanaanPengadaanController::class, 'create'])->name('nota_dinas_permintaan.create');
    Route::post('/nota_dinas_pelaksanaan/{ID_Pengadaan}/{id_nota_dinas_permintaan}', [NotaDinasPermintaanPelaksanaanPengadaanController::class, 'store'])->name('nota_dinas_pelaksanaan.store');
    Route::get('/nota_dinas_pelaksanaan/edit/{ID_Pengadaan}/{id_nota_dinas_permintaan}', [NotaDinasPermintaanPelaksanaanPengadaanController::class, 'edit'])->name('nota_dinas_pelaksanaan.edit');
    Route::put('/nota_dinas_pelaksanaan/update/{ID_Pengadaan}/{id_nota_dinas_permintaan}', [NotaDinasPermintaanPelaksanaanPengadaanController::class, 'update'])->name('nota_dinas_pelaksanaan.update');
    Route::get('/status_nota_dinas_pelaksanaan/{ID_Pengadaan}', [NotaDinasPermintaanPelaksanaanPengadaanController::class, 'detail'])->name('nota_dinas_pelaksanaan.detail');
    Route::get('/pengadaan/kirim/nota_dinas_pelaksanaan/{ID_Pengadaan}/{id_nota_dinas_permintaan}', [NotaDinasPermintaanPelaksanaanPengadaanController::class, 'kirimNotaDinasPelaksanaan'])->name('nota_dinas_pelaksanaan.kirim');

});

Route::middleware(['auth', 'role:3'])->group(function () {
    // Rute yang akan dilindungi oleh middleware role "Pejabat Lakdan"
    Route::get('/pengadaan/rendan', [AdminRendanController::class, 'index'])->name('pengadaan.rendan.index');
    Route::get('/detail/adminrendan/{ID_Pengadaan}', [AdminRendanController::class, 'detail'])->name('adminrendan.detail');
    Route::get('/detail/notadinas/adminrendan/{ID_Pengadaan}', [AdminRendanController::class, 'detailNotaDinas'])->name('adminrendan.notadinas.detail');

    //HPE
    Route::get('/hpe/{ID_Pengadaan}', [HPEController::class, 'index'])->name('hpe.index');
    // Route::get('/justifikasi/create', [JustifikasiController::class, 'create'])->name('justifikasi.create');
    Route::post('/hpe/{ID_Pengadaan}', [HPEController::class, 'store'])->name('hpe.store');
    Route::get('/hpe/edit/{ID_Pengadaan}/{ID_HPE}', [HPEController::class, 'edit'])->name('hpe.edit');
    Route::put('/hpe/update/{ID_Pengadaan}/{ID_HPE}', [HPEController::class, 'update'])->name('hpe.update');
    // Route::get('/status_justifikasi', [JustifikasiController::class, 'status'])->name('justifikasi.status');
    // Route::get('/status_justifikasi/{ID_Pengadaan}', [JustifikasiController::class, 'detail'])->name('justifikasi.detail');
    Route::get('/pengadaan/kirim/hpe/{ID_Pengadaan}/{ID_HPE}', [HPEController::class, 'kirimHpe'])->name('hpe.kirim');

    //RKS
    // Route::get('/hpe/{ID_Pengadaan}', [HPEController::class, 'index'])->name('hpe.index');
    // Route::get('/justifikasi/create', [JustifikasiController::class, 'create'])->name('justifikasi.create');
    // Route::post('/hpe/{ID_Pengadaan}', [HPEController::class, 'store'])->name('hpe.store');
    // Route::get('/status_justifikasi', [JustifikasiController::class, 'status'])->name('justifikasi.status');
    // Route::get('/status_justifikasi/{ID_Pengadaan}', [JustifikasiController::class, 'detail'])->name('justifikasi.detail');
    // Route::get('/pengadaan/kirim/hpe/{ID_Pengadaan}/{ID_HPE}', [HPEController::class, 'kirimHpe'])->name('hpe.kirim');

    //Ringkasan RKS
    Route::get('/ringkasan-rks/{ID_Pengadaan}', [RingkasanRKSController::class, 'index'])->name('rks.index');
    // Route::get('/justifikasi/create', [JustifikasiController::class, 'create'])->name('justifikasi.create');
    Route::post('/ringkasan-rks/{ID_Pengadaan}', [RingkasanRKSController::class, 'store'])->name('rks.store');
    Route::get('/ringkasan-rks/edit/{ID_Pengadaan}/{ID_Ringkasan_Rks}', [RingkasanRKSController::class, 'edit'])->name('rks.edit');
    Route::put('/ringkasan-rks/update/{ID_Pengadaan}/{ID_Ringkasan_Rks}', [RingkasanRKSController::class, 'update'])->name('rks.update');
    // Route::get('/status_justifikasi', [JustifikasiController::class, 'status'])->name('justifikasi.status');
    // Route::get('/status_justifikasi/{ID_Pengadaan}', [JustifikasiController::class, 'detail'])->name('justifikasi.detail');
    Route::get('/pengadaan/kirim/rks/{ID_Pengadaan}/{ID_Ringkasan_Rks}', [RingkasanRKSController::class, 'kirimRKS'])->name('ringkasan.kirim');

    //Dokumen Kualifikasi
    Route::get('/dokumen-kualifikasi/{ID_Pengadaan}', [DokumenKualifikasiController::class, 'index'])->name('dokumen.index');
    // // Route::get('/justifikasi/create', [JustifikasiController::class, 'create'])->name('justifikasi.create');
    Route::post('/dokumen/{ID_Pengadaan}', [DokumenKualifikasiController::class, 'store'])->name('dokumen.store');
    // // Route::get('/status_justifikasi', [JustifikasiController::class, 'status'])->name('justifikasi.status');
    // // Route::get('/status_justifikasi/{ID_Pengadaan}', [JustifikasiController::class, 'detail'])->name('justifikasi.detail');
    // Route::get('/pengadaan/kirim/hpe/{ID_Pengadaan}/{ID_HPE}', [HPEController::class, 'kirimHpe'])->name('hpe.kirim');

});

Route::middleware(['auth', 'role:5'])->group(function () {
    // Rute yang akan dilindungi oleh middleware role "Pejabat User"
    Route::get('/persetujuan/pengadaan', [PejabatUserController::class, 'index'])->name('persetujuan.pengadaan.index');
    // Route::get('/status_pengadaan', [PengadaanController::class, 'status'])->name('pengadaan.status');
    // Route::get('/status_pengadaan/{ID_Pengadaan}', [PengadaanController::class, 'detail'])->name('pengadaan.detail');
    // Route::get('/pejabatuser', [PejabatUserController::class, 'status'])->name('pejabatuser.status');
    // Route::get('/pejabatuser/{ID_Pengadaan}', [PejabatUserController::class, 'detail'])->name('pejabatuser.detail');
    Route::get('/detail/pejabatuser/{ID_Pengadaan}', [PejabatUserController::class, 'detail'])->name('pejabatuser.detail');
    Route::get('/approve/rab/{ID_Pengadaan}/{ID_RAB}', [PejabatUserController::class, 'approveRab'])->name('pejabatuser.approve.rab');
    Route::post('/rab/approve/{ID_Pengadaan}/{ID_RAB}', [PejabatUserController::class, 'approveFileRab'])->name('pejabatuser.approve-rab');
    Route::post('/rab/reject/{ID_Pengadaan}/{ID_RAB}', [PejabatUserController::class, 'rejectFileRab'])->name('pejabatuser.reject-rab');
    // Route::get('/rab/preview/download/{ID_Pengadaan}/{ID_RAB}', [RabController::class, 'downloadPreview'])->name('rab.preview.download');

    Route::get('/approve/justifikasi/{ID_Pengadaan}/{ID_JPL}', [PejabatUserController::class, 'approveJustifikasi'])->name('pejabatuser.approve.justifikasi');
    Route::post('/justifikasi/approve/{ID_Pengadaan}/{ID_JPL}', [PejabatUserController::class, 'approveFileJustifikasi'])->name('pejabatuser.approve-justifikasi');
    Route::post('/justifikasi/reject/{ID_Pengadaan}/{ID_JPL}', [PejabatUserController::class, 'rejectFileJustifikasi'])->name('pejabatuser.reject-justifikasi');
    // Route::get('/justifikasi/preview/download/{ID_Pengadaan}/{ID_JPL}', [JustifikasiController::class, 'downloadPreview'])->name('justifikasi.preview.download');

    Route::get('/approve/nota_dinas_permintaan/{ID_Pengadaan}/{id_nota_dinas_permintaan}', [PejabatUserController::class, 'approveNotaDinasPermintaan'])->name('pejabatuser.approve.nota-dinas-permintaan');
    Route::post('/nota_dinas_permintaan/approve/{ID_Pengadaan}/{id_nota_dinas_permintaan}', [PejabatUserController::class, 'approveFileNotaDinasPermintaan'])->name('pejabatuser.approve-nota-dinas-permintaan');
    Route::post('/nota_dinas_permintaan/reject/{ID_Pengadaan}/{id_nota_dinas_permintaan}', [PejabatUserController::class, 'rejectFileNotaDinasPermintaan'])->name('pejabatuser.reject-nota-dinas-permintaan');
    // Route::get('/nota_dinas_permintaan/preview/download/{ID_Pengadaan}/{id_nota_dinas_permintaan}', [JustifikasiController::class, 'downloadPreview'])->name('nota_dinas_permintaan.preview.download');

    //Nota Dinas Pelaksanaan
    Route::get('/approve/nota_dinas_pelaksanaan/{ID_Pengadaan}/{id_nota_dinas_permintaan}', [PejabatUserController::class, 'approveNotaDinasPelaksanaan'])->name('pejabatuser.approve.nota-dinas-pelaksanaan');
    Route::post('/nota_dinas_pelaksanaan/approve/{ID_Pengadaan}/{id_nota_dinas_permintaan}', [PejabatUserController::class, 'approveFileNotaDinasPelaksanaan'])->name('pejabatuser.approve-nota-dinas-pelaksanaan');
    Route::post('/nota_dinas_pelaksanaan/reject/{ID_Pengadaan}/{id_nota_dinas_permintaan}', [PejabatUserController::class, 'rejectFileNotaDinasPelaksanaan'])->name('pejabatuser.reject-nota-dinas-pelaksanaan');

    //HPE
    Route::get('/approve/user/hpe/{ID_Pengadaan}/{ID_HPE}', [PejabatUserController::class, 'approveHPE'])->name('pejabatuser.approve.hpe');
    Route::post('/hpe/user/approve/{ID_Pengadaan}/{ID_HPE}', [PejabatUserController::class, 'approveFileHPE'])->name('pejabatuser.approve-hpe');
    Route::post('/hpe/user/reject/{ID_Pengadaan}/{ID_HPE}', [PejabatUserController::class, 'rejectFileHPE'])->name('pejabatuser.reject-hpe');

    //RKS
    Route::get('/approve/rks/user/{ID_Pengadaan}/{ID_Ringkasan_Rks}', [PejabatUserController::class, 'approveRKS'])->name('pejabatuser.approve.rks');
    Route::post('/rks/approve/user/{ID_Pengadaan}/{ID_Ringkasan_Rks}', [PejabatUserController::class, 'approveFileRKS'])->name('pejabatuser.approve-rks');
    Route::post('/rks/reject/user/{ID_Pengadaan}/{ID_Ringkasan_Rks}', [PejabatUserController::class, 'rejectFileRKS'])->name('pejabatuser.reject-rks');

});
Route::middleware(['auth', 'role:6'])->group(function () {
    // Rute yang akan dilindungi oleh middleware role "Pejabat Rendan"
    Route::get('/persetujuan/pengadaan/rendan', [PejabatRendanController::class, 'index'])->name('persetujuan.pengadaan-rendan.index');
    Route::get('/detail/pejabatrendan/{ID_Pengadaan}', [PejabatRendanController::class, 'detail'])->name('pejabatrendan.detail');
    Route::get('/detail/pejabatrendan/pekerjaan/{ID_Pengadaan}', [PejabatRendanController::class, 'detailPekerjaan'])->name('pejabatrendan.pekerjaan.detail');
    // Route::get('/rab/preview/download/{ID_Pengadaan}/{ID_RAB}', [RabController::class, 'downloadPreview'])->name('rab.preview.download');
    Route::post('/pengadaan/kirim/{ID_Pengadaan}', [PejabatRendanController::class, 'kirimPegawai'])->name('pejabatrendan.kirim');
    // Route::get('/rab/preview/download/{ID_Pengadaan}/{ID_RAB}', [RabController::class, 'downloadPreview'])->name('rab.preview.download');
    // Route::get('/justifikasi/preview/download/{ID_Pengadaan}/{ID_JPL}', [JustifikasiController::class, 'downloadPreview'])->name('justifikasi.preview.download');
    // Route::get('/nota_dinas_permintaan/preview/download/{ID_Pengadaan}/{id_nota_dinas_permintaan}', [JustifikasiController::class, 'downloadPreview'])->name('nota_dinas_permintaan.preview.download');

    //HPE
    Route::get('/approve/hpe/{ID_Pengadaan}/{ID_HPE}', [PejabatRendanController::class, 'approveHPE'])->name('pejabatrendan.approve.hpe');
    Route::post('/hpe/approve/{ID_Pengadaan}/{ID_HPE}', [PejabatRendanController::class, 'approveFileHPE'])->name('pejabatrendan.approve-hpe');
    Route::post('/hpe/reject/{ID_Pengadaan}/{ID_HPE}', [PejabatRendanController::class, 'rejectFileHPE'])->name('pejabatrendan.reject-hpe');

    //RKS
    Route::get('/approve/rks/{ID_Pengadaan}/{ID_Ringkasan_Rks}', [PejabatRendanController::class, 'approveRKS'])->name('pejabatrendan.approve.rks');
    Route::post('/rks/approve/{ID_Pengadaan}/{ID_Ringkasan_Rks}', [PejabatRendanController::class, 'approveFileRKS'])->name('pejabatrendan.approve-rks');
    Route::post('/rks/reject/{ID_Pengadaan}/{ID_Ringkasan_Rks}', [PejabatRendanController::class, 'rejectFileRKS'])->name('pejabatrendan.reject-rks');

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
    Route::get('/vendor', [VendorController::class, 'index'])->name('vendor')->middleware('check_perwakilan_daftar');
    Route::get('/profile/vendor', [VendorController::class, 'profile'])->name('vendor-page.profile');
    Route::post('/profile/peserta', [VendorController::class, 'store'])->name('profile-vendor.store');
    Route::post('/profile/add-signature/{ID_Peserta}', [VendorController::class, 'addSignature'])->name('profile-vendor.add-signature');
    Route::delete('/profile/delete-signature/{ID_Peserta}', [VendorController::class, 'deleteSignature'])->name('profile-vendor.delete-signature');
    // Route::post('/profile/update-signature/{ID_Peserta}', [VendorController::class, 'updateSignature'])->name('profile-vendor.store-update-signature');
    Route::post('/profile/add-signature/{ID_Vendor}', [VendorController::class, 'addSignatureVendor'])->name('profile-vendor.add-signature-vendor');
    Route::get('/profile/{ID_Vendor}/edit', [VendorController::class, 'edit'])->name('profile-vendor.edit');
    Route::put('/profile/{ID_Vendor}', [VendorController::class, 'update'])->name('profile-vendor.update');
    Route::delete('/profile/{ID_Vendor}', [VendorController::class, 'delete'])->name('profile-vendor.delete');
    Route::get('/profile/{ID_Peserta}/edit', [VendorController::class, 'editPeserta'])->name('profile-vendor-peserta.edit');
    Route::put('/profile/{ID_Peserta}', [VendorController::class, 'updatePeserta'])->name('profile-vendor-peserta.update');
    Route::delete('/profile/{ID_Peserta}', [VendorController::class, 'deletePeserta'])->name('profile-vendor-peserta.delete');

    // Route::get('/profile/perwakilan', [VendorController::class, 'isiPerwakilan'])->name('vendor-page.perwakilan');
});

// Rute untuk logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout/vendor', [VendorLoginController::class, 'logout'])->name('logoutvendor');
Route::get('/auth/redirect', [AuthController::class, 'redirectToProvider']);
Route::get('/auth/redirect', [VendorLoginController::class, 'redirectToProvider']);
Route::get('/google/callback', [AuthController::class, 'handleProviderCallback']);
Route::get('/google/callback', [VendorLoginController::class, 'handleProviderCallback']);
