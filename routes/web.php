<?php

use App\Http\Controllers\AlatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiskusiController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\KomentarDiskusiController;
use App\Http\Controllers\KomentarInformasiController;
use App\Http\Controllers\ManajemenUserController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'auth']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    //diskusi
    Route::get('/diskusi', [DiskusiController::class, 'index'])->name('diskusi.index');
    Route::get('/diskusi/{id}', [DiskusiController::class, 'show'])->name('diskusi.show');
    Route::get('/diskusi-create', [DiskusiController::class, 'create'])->name('diskusi.create');
    Route::post('/diskusi-store', [DiskusiController::class, 'store'])->name('diskusi.store');
    Route::get('/diskusi/{id}/edit', [DiskusiController::class, 'edit'])->name('diskusi.edit');
    Route::post('/diskusi-update/{id}', [DiskusiController::class, 'update'])->name('diskusi.update');

    //komentar diskusi
    Route::post('komentar-diskusi/{id}', [KomentarDiskusiController::class, 'store'])->name('komentar.store');
    Route::post('komentar-diskusi/{id}/update', [KomentarDiskusiController::class, 'update'])->name('komentar.update');
    Route::post('komentar-diskusi/{diskusi_id}/{komentar_id}', [KomentarDiskusiController::class, 'storeKomentar'])->name('komentar.store-komentar');
    
    // alat
    Route::get("/alat", [AlatController::class, 'index'])->name('alat.index');
    Route::post("/tambah_alat", [AlatController::class, 'tambah_alat']);
    Route::post("/edit_alat", [AlatController::class, 'edit_alat']);
    Route::delete("/hapus_alat", [AlatController::class, 'hapus_alat']);

    //penyewaan
    Route::get("/penyewaan", [PenyewaanController::class, 'index'])->name('penyewaan.index');
    Route::post("/tambah_nyewa", [PenyewaanController::class, 'store']);
    Route::post("/edit_nyewa", [PenyewaanController::class, 'update']);
    Route::get("/hapus_nyewa_detail/{id}", [PenyewaanController::class, 'hapus_nyewa_detail']);
    Route::get("/hapus_nyewa/{id}", [PenyewaanController::class, 'destroy']);
    Route::get("/detail_penyewa/{id}", [PenyewaanController::class, 'detail_penyewa']);
    Route::get("/tolak_approve/{id}", [PenyewaanController::class, 'tolak_approve']);
    Route::get("/nyewa_petani", [PenyewaanController::class, 'nyewa_petani']);
    Route::get("/tambah_data_nyewa", [PenyewaanController::class, 'tambah_data_nyewa']);
    Route::post("/pesan_sekarang", [PenyewaanController::class, 'pesan_sekarang']);
    Route::post("/approve", [PenyewaanController::class, 'approve']);
    Route::post("/edit_pesan_sekarang", [PenyewaanController::class, 'edit_pesan_sekarang']);

    //keuangan
    Route::get("/keuangan", [KeuanganController::class, 'index']);
    Route::post("/edit_bayar_sekarang", [KeuanganController::class, 'edit_bayar_sekarang']);
    Route::post("/bayar_sekarang", [KeuanganController::class, 'bayar_sekarang']);
    Route::get("/detail_penyewa_keuangan/{id}", [KeuanganController::class, 'detail_penyewa_keuangan']);
    Route::get("/bayar/{id}", [KeuanganController::class, 'bayar']);
    Route::get("/bayar_pekerjaan/{id}", [KeuanganController::class, 'bayar_pekerjaan']);
    Route::get("/hapus_bayar/{id}", [KeuanganController::class, 'hapus_bayar']);
    Route::get("/selesai_bayar/{id}/{user_id}", [KeuanganController::class, 'selesai_bayar']);

    //manajemen user
    Route::resource('/manajemen-user', ManajemenUserController::class)->only('index', 'create', 'store');
    Route::get('/manajemen-user/{id}/edit', [ManajemenUserController::class, 'edit'])->name('manajemen-user.edit');
    Route::post('/manajemen-user-update/{id}', [ManajemenUserController::class, 'update'])->name('manajemen-user.update');

    //profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile-password', [ProfileController::class, 'resetPassword'])->name('profile.password');

    //informasi
    Route::resource('informasi', InformasiController::class)->only('index', 'create', 'store');
    Route::get('/informasi/{id}/edit', [InformasiController::class, 'edit'])->name('informasi.edit');
    Route::post('/informasi/{id}', [InformasiController::class, 'update'])->name('informasi.update');
    Route::get('/informasi/{id}', [InformasiController::class, 'show'])->name('informasi.show');
    Route::post('/informasi/{id}/delete', [InformasiController::class, 'destroy'])->name('informasi.delete');

    //komentar informasi
    Route::post('komentar-informasi/{id}', [KomentarInformasiController::class, 'store'])->name('komentar-informasi.store');
    Route::post('komentar-informasi/{id}/update', [KomentarInformasiController::class, 'update'])->name('komentar-informasi.update');
    Route::post('komentar-informasi/{informasi_id}/{komentar_id}', [KomentarInformasiController::class, 'storeKomentar'])->name('komentar-informasi.store-komentar');
});
