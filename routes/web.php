<?php

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

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index']);

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

// add login middleware
Route::group(['middleware' => ['auth']], function () {
    // Route::resource('berita', App\Http\Controllers\BeritaController::class);
    // Route::resource('artikel', App\Http\Controllers\ArtikelController::class);
    Route::resource('parkir', App\Http\Controllers\ParkirController::class);
    Route::get('cetak', [App\Http\Controllers\ParkirController::class, 'cetakPDF'])->name('cetakPDF');
    // Route::resource('minat-klinis', App\Http\Controllers\MinatKlinisController::class);
    // Route::resource('prestasi-dokter', App\Http\Controllers\PrestasiDokterController::class);
    // Route::resource('pendidikan-dokter', App\Http\Controllers\PendidikanDokterController::class);
    // Route::resource('pengaduan', App\Http\Controllers\PengaduanController::class);
    // Route::resource('respon-pengaduan', App\Http\Controllers\ResponPengaduanController::class);
    // Route::resource('review', App\Http\Controllers\ReviewController::class);
    // Route::resource('laporan-spi', App\Http\Controllers\LaporanSPIController::class);
    // Route::get('images/berita/{path}',[App\Http\Controllers\ImagesController::class, 'show'])->where('path', '.*');
});
// Route::resource('berita', App\Http\Controllers\BeritaController::class);
// Route::resource('artikel', App\Http\Controllers\ArtikelController::class);