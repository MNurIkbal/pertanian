<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiskusiController;
use App\Http\Controllers\KomentarDiskusiController;
use App\Http\Controllers\PenyewaanController;
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
    Route::get('/diskusi', [DiskusiController::class, 'index'])->name('diskusi.index');
    Route::get('/diskusi/{id}', [DiskusiController::class, 'show'])->name('diskusi.show');
    Route::get('/diskusi-create', [DiskusiController::class, 'create'])->name('diskusi.create');
    Route::post('/diskusi-store', [DiskusiController::class, 'store'])->name('diskusi.store');
    Route::get('/diskusi/{id}/edit', [DiskusiController::class, 'edit'])->name('diskusi.edit');
    Route::post('/diskusi-update/{id}', [DiskusiController::class, 'update'])->name('diskusi.update');

    Route::post('komentar-diskusi/{id}', [KomentarDiskusiController::class, 'store'])->name('komentar.store');
    Route::post('komentar-diskusi/{id}/update', [KomentarDiskusiController::class, 'update'])->name('komentar.update');
    Route::post('komentar-diskusi/{diskusi_id}/{komentar_id}', [KomentarDiskusiController::class, 'storeKomentar'])->name('komentar.store-komentar');
    Route::get("/penyewaan",[PenyewaanController::class,'index'])->name('penyewaan.index');
    Route::post("/tambah_nyewa",[PenyewaanController::class,'store']);
    Route::post("/edit_nyewa",[PenyewaanController::class,'update']);
    Route::get("/hapus_nyewa_detail/{id}",[PenyewaanController::class,'hapus_nyewa_detail']);
    Route::get("/hapus_nyewa/{id}",[PenyewaanController::class,'destroy']);
    Route::get("/detail_penyewa/{id}",[PenyewaanController::class,'detail_penyewa']);
    Route::get("/tolak_approve/{id}",[PenyewaanController::class,'tolak_approve']);
    Route::get("/nyewa_petani",[PenyewaanController::class,'nyewa_petani']);
    Route::get("/tambah_data_nyewa",[PenyewaanController::class,'tambah_data_nyewa']);
    Route::post("/pesan_sekarang",[PenyewaanController::class,'pesan_sekarang']);
    Route::post("/approve",[PenyewaanController::class,'approve']);
});