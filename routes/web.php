<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\LayananTersediaController;
use App\Http\Controllers\ManajemenPenggunaController;
use App\Http\Controllers\ManajemenKaryawanController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\PemesananController;
use App\Models\Ulasan;


Route::get('/', [UlasanController::class, 'ulasanLandingPage'])->name('landing-page');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/logout', function () {
    return view('logout');
})->name('logout');

Route::get('/registrasi', function () {
    return view('registrasi');
})->name('registrasi');

// Route untuk halaman landing page
// Route::get('/landing-page', function () {
//     return view('landing-page');
// });

Route::get('layouts/layout', function () {
return view('layouts.layout');
})->name('layouts/layout');

Route::get('/pages-admin.dashboard-admin', function () {
    return view('pages-admin.dashboard-admin');
})->name('pages-admin.dashboard-admin');

Route::get('/dashboard-admin', [AdminController::class, 'index'])->name('pages-admin.dashboard-admin');

Route::get('/pages-admin.data-layanan', function () {
    return view('pages-admin.data-layanan');
})->name('pages-admin.data-layanan');

Route::get('/pages-admin.profile-admin', function () {
    return view('pages-admin.profile-admin');
})->name('pages-admin.profile-admin');

Route::get('/pages-admin.edit-profile', function () {
    return view('pages-admin.edit-profile');
})->name('pages-admin.edit-profile');

// Route untuk menampilkan form login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Route untuk handle login
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Route untuk handle logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logoutadmin', [AuthController::class, 'logoutAdmin'])->name('logout.admin');
Route::get('/logoutkaryawan', [AuthController::class, 'logoutKaryawan'])->name('logout.karyawan');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Show the password reset request form
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Handle the password reset link request
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::middleware(['auth:admin'])->group(function () {
    //tampilan route role admin
    Route::get('/pages-admin/dashboard-admin', [AdminController::class, 'dashboard'])->name('dashboard.admin');
    Route::get('/pages-admin/profile-admin', [AdminController::class, 'profile'])->name('profile.admin');
    Route::get('/pages-admin/edit-profile', [AdminController::class, 'editprofile'])->name('edit.profile');

    //route untuk tampilan data layanan
    Route::get('/pages-admin/data-layanan', [AdminController::class, 'datalayanan'])->name('data.layanan');
    Route::get('/pages-admin/data-layanan', [LayananController::class, 'index'])->name('data-layanan');
    Route::get('/pages-admin/tambah-layanan', [AdminController::class, 'tambahlayanan'])->name('tambah.layanan');

    //route untuk tampilan data pemesanan
    Route::get('/pages-admin/data-pemesanan', [AdminController::class, 'datapemesanan'])->name('data.pemesanan');
    Route::get('/pages-admin/tambah-pemesanan', [AdminController::class, 'tambahpemesanan'])->name('tambah.pemesanan');
    Route::get('/pages-admin/edit-pemesanan/{id}', [AdminController::class, 'editpemesanan'])->name('edit.pemesanan');
    Route::put('/pages-admin/update-pemesanan/{id}', [AdminController::class, 'updatepemesanan'])->name('update.pemesanan');

    //route untuk tampilan data transaksi
    Route::get('/pages-admin/data-transaksi', [AdminController::class, 'datatransaksi'])->name('data.transaksi');
    Route::get('/pages-admin/tambah-transaksi', [AdminController::class, 'tambahtransaksi'])->name('tambah.transaksi');
    Route::get('/pages-admin/edit-transaksi', [AdminController::class, 'edittransaksi'])->name('edit.transaksi');

    //route untuk tampilan manajemen karyawan
    Route::get('/pages-admin/manajemen-karyawan', [AdminController::class, 'manajemenkaryawan'])->name('manajemen.karyawan');
    Route::get('/pages-admin/tambah-karyawan', [AdminController::class, 'tambahkaryawan'])->name('tambah.karyawan');
    Route::get('/pages-admin/edit-karyawan', [AdminController::class, 'editkaryawan'])->name('edit.karyawan');

    //route untuk tampilan manajemen pengguna
    Route::get('/pages-admin/manajemen-pengguna', [AdminController::class, 'manajemenpengguna'])->name('manajemen.pengguna');
    Route::get('/pages-admin/tambah-pengguna', [AdminController::class, 'tambahpengguna'])->name('tambah.pengguna');
    Route::get('/pages-admin/edit-pengguna/{id}', [AdminController::class, 'editpengguna'])->name('edit.pengguna');

    //route untuk tampilan data pelanggan dan laporan
    Route::get('/pages-admin/data-pelanggan', [AdminController::class, 'datapelanggan'])->name('data.pelanggan');
    Route::get('/pages-admin/tambah-pelanggan', [AdminController::class, 'tambahpelanggan'])->name('tambah.pelanggan');
    Route::get('/pages-admin/laporan', [AdminController::class, 'laporan'])->name('laporan');

    //route untuk tampilan edit layanan, ulasan pengguna dan pendapatan
    Route::get('/pages-admin/edit-layanan', [AdminController::class, 'editlayanan'])->name('edit.layanan');
    Route::get('/detail-layanan/{id}', [AdminController::class, 'DetailLayanan'])->name('detail.order');
    Route::get('/pages-admin/ulasan-pengguna', [AdminController::class, 'ulasanpengguna'])->name('pages-admin.ulasan.pengguna');
    Route::get('/pages-admin/pendapatan', [AdminController::class, 'pendapatan'])->name('pendapatan');

    //ROUTE UNTUK BAGIAN DATABASE ADMIN

    //rote data layanan
    Route::get('tambah-layanan', [LayananController::class, 'create'])->name('tambah-layanan');
    Route::get('admin/tambah-layanan', [LayananController::class, 'create'])->name('tambah-layanan');
    // Menyimpan data layanan baru
    Route::post('admin/tambah-layanan', [LayananController::class, 'store'])->name('tambah-layanan');
    // Menampilkan data layanan
    Route::get('/data-layanan', [LayananController::class, 'index'])->name('data-layanan');
    //Menampilkan 
    Route::put('/layanan/{id}', [LayananController::class, 'update'])->name('update.layanan');

    Route::get('pages-admin/{id}/edit', [LayananController::class, 'edit'])->name('edit.layanan');
    Route::put('/layanan/{id}', [LayananController::class, 'update'])->name('update.layanan');

    // Rute untuk menghapus layanan
    Route::delete('/layanan/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');

    // route manajemen pengguna

    // Route untuk menampilkan halaman manajemen pengguna
    Route::get('/manajemen-pengguna', [ManajemenPenggunaController::class, 'index'])->name('manajemen-pengguna');

    // Route untuk menampilkan form tambah pengguna
    Route::get('/tambah-pengguna', [ManajemenPenggunaController::class, 'create'])->name('tambah-pengguna');

    // Route untuk menyimpan pengguna baru
    Route::post('/tambah-pengguna', [ManajemenPenggunaController::class, 'store'])->name('tambah-pengguna.store');

    // Route untuk menghapus pengguna
    Route::delete('/hapus-pengguna/{id}', [ManajemenKaryawanController::class, 'destroy'])->name('hapus.pengguna');

    // rote data transaksi 
    Route::post('/transaksi/store', [AdminController::class, 'store'])->name('store-transaksi');

    // route untuk manajemen karyawan

    // Route untuk menampilkan halaman manajemen karyawan
    Route::get('/manajemen-karyawan', [ManajemenKaryawanController::class, 'index'])->name('manajemen-karyawan');

    // Route untuk menampilkan form tambah karyawan
    Route::get('/tambah-karyawan', [ManajemenKaryawanController::class, 'create'])->name('tambah-karyawan');

    // Route untuk menyimpan karyawan baru
    Route::post('/tambah-karyawan', [ManajemenKaryawanController::class, 'store'])->name('tambah-karyawan.store');

    // Route untuk menghapus karyawan
    Route::delete('/karyawan/{id}', [ManajemenKaryawanController::class, 'destroy'])->name('hapus.pengguna');

    // route untuk tampilan profile admin
    Route::get('/admin/profile', [AdminController::class, 'show'])->name('admin.profile'); // Untuk menampilkan profile
    Route::get('/admin/profile/edit', [AdminController::class, 'edit'])->name('admin.profile.edit'); // Untuk form edit
    Route::match(['PUT', 'PATCH'], '/admin/profile/update', [AdminController::class, 'update'])->name('admin.profile.update');

    // route untuk search data admin
    Route::get('/admin/data-layanan', [AdminController::class, 'indexlayanan'])->name('pages-admin.data-layanan');
    Route::get('/admin/data-transaksi', [AdminController::class, 'indextransaksi'])->name('pages-admin.data-transaksi');
    Route::get('/admin/data-pemesanan', [AdminController::class, 'indexpemesanan'])->name('pages-admin.data-pemesanan');
    Route::get('/admin/data-pelanggan', [AdminController::class, 'indexpelanggan'])->name('pages-admin.data-pelanggan');
    Route::get('/admin/manajemen-pengguna', [AdminController::class, 'indexmanajemenpengguna'])->name('pages-admin.manajemen-pengguna');
    Route::get('/admin/manajemen-karyawan', [AdminController::class, 'indexmanajemenkaryawan'])->name('pages-admin.manajemen-karyawan');
    Route::get('/admin/laporan', [AdminController::class, 'indexmanajemenlaporan'])->name('pages-admin.laporan');

    Route::post('pages-admin/tambah-transaksi', [AdminController::class, 'storetransaksibyadmin'])->name('tambah.transaksibyadmin');
    Route::post('transaksi/paymentsuccessbyadmin', [AdminController::class, 'paymentsuccesstransaksibyadmin'])->name('success.transaksi');
});

// route untuk tampilan profile user
Route::get('/user/profile', [UserController::class, 'show'])->name('profil.user');
Route::get('/user/profile/edit', [UserController::class, 'edit'])->name('user.profile.edit');
Route::put('/profile', [UserController::class, 'update'])->name('user.profile.update');

// route untuk tampilan profile karyawan

Route::get('/karyawan/profile', [KaryawanController::class, 'show'])->name('karyawan.user');
Route::get('/karyawan/profile/edit', [KaryawanController::class, 'edit'])->name('karyawan.profile.edit');
Route::put('/karyawan/profile/', [KaryawanController::class, 'update'])->name('karyawan.profile.update');
Route::post('/orders/{id}/status', [KaryawanController::class, 'updateOrderStatus'])->name('orders.updateStatus');
Route::post('/orders/{id}/set-selesai', [KaryawanController::class, 'setOrderToSelesai'])->name('orders.setSelesai');
// Halaman riwayat pengerjaan
Route::get('/riwayat-pengerjaan', [KaryawanController::class, 'index'])->name('riwayat.pengerjaan');

// Route to handle saving the profile
Route::middleware(['auth'])->group(function () {
    Route::get('/edit-profile', [UserController::class, 'edit'])->name('edit-profile');
    Route::post('/save-profile', [UserController::class, 'saveProfile'])->name('save-profile');
});

// route print struck layanan dan laporan
Route::get('print-receipt/{id}', [AdminController::class, 'printReceipt'])->name('print-receipt');
Route::get('/laporan/cetak-pdf', [AdminController::class, 'cetakPdf'])->name('laporan.cetak-pdf');

// route filter tanggal laporan
Route::get('/laporan/filter', [AdminController::class, 'filter'])->name('laporan.filter');

    // Rute untuk menghapus ulasan
    Route::delete('ulasan/{id}', [UlasanController::class, 'destroy'])->name('ulasan.destroy');

Route::middleware(['auth:user'])->group(function () {
    //tampilan route role user
    Route::get('/pages-user/dashboard-user', [UserController::class, 'dashboard'])->name('dashboard.user');
    Route::get('/pages-user/status-pemesanan', [UserController::class, 'statuspemesanan'])->name('status.pemesanan');
    Route::get('/pages-user/layanan-tersedia', [UserController::class, 'layanantersedia'])->name('layanan.tersedia');
    // Route::get('/pages-user/status-antrian', [UserController::class, 'statusantrian'])->name('status.antrian');
    Route::get('/antrian', [UserController::class, 'showQueue'])->middleware('auth');
    Route::post('/queue/generate', [UserController::class, 'generateQueue'])->name('queue.generate');
    Route::get('/pages-user/riwayat-pemesanan', [UserController::class, 'riwayatpemesanan'])->name('riwayat.pemesanan');
    Route::get('/pages-user/profil-user', [UserController::class, 'profiluser'])->name('profil.user');
    Route::get('/pages-user/edit-profil', [UserController::class, 'editprofil'])->name('edit.profil');
    Route::get('/pages-user/ulasan', [UserController::class, 'ulasan'])->name('ulasan');
    Route::get('/pages-user/tulis-ulasan', [UserController::class, 'tulisulasan'])->name('tulis.ulasan');
    Route::get('/pages-user/form-pemesanan/{layananId}', [UserController::class, 'formpemesanan'])->name('form.pemesanan');
    Route::get('/pages-user/pemesanan-pelanggan/{layananId}', [UserController::class, 'pemesananpelanggan'])->name('pemesanan.pelanggan');
    Route::post('/checkout', [UserController::class, 'checkout'])->name('checkout');
    Route::post('/payment/success', [UserController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/pages-user/pelanggan', [UserController::class, 'pelanggan'])->name('pelanggan');
    Route::post('/pemesanan', [UserController::class, 'store'])->name('pemesanan.store');

    Route::post('/pemesanan', [UserController::class, 'store'])->name('pemesanan.store');



    // route ulasan user
    // Rute untuk menampilkan daftar ulasan
    Route::get('ulasan', [UlasanController::class, 'index'])->name('ulasan.index');

    Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');

    // Rute untuk menampilkan form edit ulasan
    Route::get('ulasan/{id}/edit', [UlasanController::class, 'edit'])->name('ulasan.edit');

    // Rute untuk memperbarui ulasan
    Route::put('ulasan/{id}', [UlasanController::class, 'update'])->name('ulasan.update');


    // route pemesanan
    Route::get('/pemesanan/{id}', [PemesananController::class, 'create'])->name('pages-user.form-pemesanan');
    Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');
    Route::post('/orders/update-status/{order}', [PemesananController::class, 'updateStatus'])->name('orders.updateStatus');
    // routes/web.php atau routes/api.php
    Route::post('/update-payment-status', [PemesananController::class, 'updatePaymentStatus'])->name('update.payment.status');
    Route::get('/tambah-pemesanan', [AdminController::class, 'showAddOrderForm'])->name('tambah-pemesanan');
    Route::post('/tambah-pemesanan', [AdminController::class, 'storeOrder'])->name('store-pemesanan');
    Route::post('/midtrans/callback', [UserController::class, 'handleCallback']);

    // Rute untuk menampilkan layanan yang tersedia
    Route::get('/user/layanan/tersedia', [UserController::class, 'indexlayanantersedia'])->name('pages-user.layanan-tersedia');
    // Rute untuk menampilkan status pemesanan
    Route::get('/user/layanan/status-pemesanan', [UserController::class, 'indexstatuspemesanan'])->name('pages-user.status-pemesanan');
    // Rute untuk menampilkan riwayat pemesanan
    Route::get('/user/layanan/riwayat-pemesanan', [UserController::class, 'indexriwayatpemesanan'])->name('pages-user.riwayat-pemesanan');
});

Route::middleware(['auth:karyawan'])->group(function () {
    //tampilan route role karyawan
    Route::get('/pages-karyawan/dashboard-karyawan', [KaryawanController::class, 'dashboard'])->name('dashboard.karyawan');
    Route::get('/pages-karyawan/tugas-harian', [KaryawanController::class, 'tugasharian'])->name('tugas.harian');
    Route::get('/pages-karyawan/update-status', [KaryawanController::class, 'updatestatus'])->name('update.status');
    // Route::get('/pages-karyawan/antrian', [KaryawanController::class, 'antrian'])->name('antrian');
    Route::get('/pages-karyawan/detail-pesanan', [KaryawanController::class, 'detailpesanan'])->name('detail.pesanan');
    Route::get('/pages-karyawan/riwayat-pengerjaan', [KaryawanController::class, 'riwayatpengerjaan'])->name('riwayat.pengerjaan');
    Route::get('/pages-karyawan/profil-karyawan', [KaryawanController::class, 'profilkaryawan'])->name('profil.karyawan');
    Route::get('/pages-karyawan/edit-profil', [KaryawanController::class, 'editprofil'])->name('edit.profil');
    Route::get('/pages-karyawan/ulasan-pengguna', [KaryawanController::class, 'ulasanpengguna'])->name('pages-karyawan.ulasan.pengguna');

    // route untuk tampilan profile karyawan
    Route::get('/karyawan/profile', [KaryawanController::class, 'show'])->name('karyawan.user');
    Route::get('/karyawan/profile/edit', [KaryawanController::class, 'edit'])->name('karyawan.profile.edit');
    Route::put('/karyawan/profile/', [KaryawanController::class, 'update'])->name('karyawan.profile.update');
    Route::post('/orders/{id}/status', [KaryawanController::class, 'updateOrderStatus'])->name('orders.updateStatus');
    Route::post('/orders/{id}/set-selesai', [KaryawanController::class, 'setOrderToSelesai'])->name('orders.setSelesai');
    Route::post('/orders/update-status/{order}', [PemesananController::class, 'updateStatus'])->name('orders.updateStatus');
    // Halaman riwayat pengerjaan
    Route::get('/riwayat-pengerjaan', [KaryawanController::class, 'index'])->name('riwayat.pengerjaan');

    // route search karyawan 
    Route::get('/karyawan/tugas-harian', [KaryawanController::class, 'indextugasharian'])->name('pages-karyawan.tugas-harian');
    Route::get('/karyawan/update-status', [KaryawanController::class, 'indexupdatestatus'])->name('pages-karyawan.update-status');
    Route::get('/karyawan/riwayat-pengerjaan', [KaryawanController::class, 'indexriwayatpengerjaan'])->name('pages-karyawan.riwayat-pengerjaan');
});