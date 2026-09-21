<?php

use App\Http\Controllers\Admin\AsetController as AdminAsetController;
use App\Http\Controllers\Admin\BagianController;
use App\Http\Controllers\Admin\FasilitasController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\KategoriAsetController;
use App\Http\Controllers\Admin\PegawaiController as AdminPegawaiController;
use App\Http\Controllers\Admin\PengelolaController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Admin\BannerController; 

Route::get('/', [AsetController::class, 'kategoriIndex'])->name('home');
Route::get('/cari', [SearchController::class, 'cari'])->name('cari');
Route::get('/kawasan-aset', [AsetController::class, 'kategoriIndex'])->name('kawasan');
Route::get('/kategori/{kategori}', [AsetController::class, 'index'])->name('aset.index');
Route::get('/aset/{aset}', [AsetController::class, 'show'])->name('aset.show');
Route::get('/struktur-organisasi', [PegawaiController::class, 'struktur'])->name('struktur');
Route::get('/pegawai/{pegawai}', [PegawaiController::class, 'show'])->name('pegawai.show');
Route::view('/tentang-kami', 'pages.tentang-kami')->name('tentang');

Route::get('/dashboard', fn () => redirect()->route('admin.dashboard'))
    ->middleware('auth')
    ->name('dashboard');

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.pegawais.index'))->name('dashboard');

    Route::resource('jabatans', JabatanController::class)->except(['show', 'create']);
    Route::resource('bagians', BagianController::class)->except(['show', 'create']);
    Route::resource('pegawais', AdminPegawaiController::class)->except(['show', 'create']);
    Route::resource('kategoris', KategoriAsetController::class)->except(['show', 'create']);
    Route::resource('asets', AdminAsetController::class)->except(['show', 'create']);
    Route::resource('fasilitas', FasilitasController::class)->except(['show', 'create']);
    Route::resource('pengelola', PengelolaController::class)->except(['show', 'create', 'edit', 'update']); // Pengelola biasanya cukup tambah/hapus pivot
    Route::resource('banners', BannerController::class)->parameters(['banners' => 'banner']);
    Route::patch('banners/{banner}/toggle', [BannerController::class, 'toggle'])->name('banners.toggle');
    Route::resource('banners', BannerController::class)->parameters(['banners' => 'banner']);
});