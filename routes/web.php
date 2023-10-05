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

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

// add login middleware
Route::group(['middleware' => ['auth']], function () {
    // Route Data SDM
    Route::get('/dokter_spesialis', [App\Http\Controllers\DataSDMController::class, 'dokter_spesialis'])->name('dktr-spesialis');
    Route::get('/dokter_gigi', [App\Http\Controllers\DataSDMController::class, 'dokter_gigi'])->name('dktr-gigi');
    Route::get('/dokter_umum', [App\Http\Controllers\DataSDMController::class, 'dokter_umum'])->name('dktr-umum');
    Route::get('/tenaga_perawat', [App\Http\Controllers\DataSDMController::class, 'tenaga_perawat'])->name('tng-perawat');
    Route::get('/tenaga_bidan', [App\Http\Controllers\DataSDMController::class, 'tenaga_bidan'])->name('tng-bidan');
    Route::get('/pranata_lab', [App\Http\Controllers\DataSDMController::class, 'pranata_laboratorium'])->name('pran-lab');
    Route::get('/radiographer', [App\Http\Controllers\DataSDMController::class, 'radiographer'])->name('radiographer');
    Route::get('/nutrisionist', [App\Http\Controllers\DataSDMController::class, 'nutrisionist'])->name('nutrisionist');
    Route::get('/fisioterapis', [App\Http\Controllers\DataSDMController::class, 'fisioterapis'])->name('fisioterapis');
    Route::get('/pharmacist', [App\Http\Controllers\DataSDMController::class, 'pharmacist'])->name('pharmacist');
    Route::get('/tenaga_professional', [App\Http\Controllers\DataSDMController::class, 'tenaga_professional'])->name('tng-professional');
    Route::get('/tenaga_non-medis', [App\Http\Controllers\DataSDMController::class, 'tenaga_non_medis'])->name('tng-non-medis');
    Route::get('/tenaga_non-medis_adm', [App\Http\Controllers\DataSDMController::class, 'tenaga_non_medis_adm'])->name('tng-non-medis-adm');
    Route::get('/sanitarian', [App\Http\Controllers\DataSDMController::class, 'sanitarian'])->name('sanitarian');

    // Rote Data Layanan
    

    // Route Data IKT 

});