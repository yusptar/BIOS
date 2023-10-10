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
    Route::get('/pasien-rawat-inap', [App\Http\Controllers\DataLayananController::class, 'pasien_rawat_inap'])->name('psn-rawat-inap');
    Route::get('/pasien-rawat-darurat', [App\Http\Controllers\DataLayananController::class, 'pasien_rawat_darurat'])->name('psn-rawat-darurat');
    Route::get('/layanan-lab-sampel', [App\Http\Controllers\DataLayananController::class, 'layanan_lab_sampel'])->name('lab-sampel');
    Route::get('/layanan-lab-parameter', [App\Http\Controllers\DataLayananController::class, 'layanan_lab_parameter'])->name('lab-parameter');
    Route::get('/tindakan-operasi', [App\Http\Controllers\DataLayananController::class, 'tindakan_operasi'])->name('tndkn-operasi');
    Route::get('/layanan-radiologi', [App\Http\Controllers\DataLayananController::class, 'layanan_radiologi'])->name('lyn-radiologi');
    Route::get('/layanan-forensik', [App\Http\Controllers\DataLayananController::class, 'layanan_forensik'])->name('lyn-forensik');
    Route::get('/kunj-rawat-jalan', [App\Http\Controllers\DataLayananController::class, 'kunj_rawat_jalan'])->name('kunj-rawat-jalan');
    Route::get('/pasien-rawat-jalan', [App\Http\Controllers\DataLayananController::class, 'pasien_rawat_jalan'])->name('psn-rawat-jalan');
    Route::get('/pasien-bpjs-nonbpjs', [App\Http\Controllers\DataLayananController::class, 'pasien_bpjs_nonbpjs'])->name('psn-bpjs-nonbpjs');
    Route::get('/layanan-farmasi', [App\Http\Controllers\DataLayananController::class, 'layanan_farmasi'])->name('lyn-farmasi');
    Route::get('/bed-occupancy-ratio', [App\Http\Controllers\DataLayananController::class, 'BOR'])->name('bor');
    Route::get('/turn-over-interval', [App\Http\Controllers\DataLayananController::class, 'TOI'])->name('toi');
    Route::get('/average-length-of-stay', [App\Http\Controllers\DataLayananController::class, 'ALOS'])->name('alos');
    Route::get('/bed-turn-over', [App\Http\Controllers\DataLayananController::class, 'BTO'])->name('bto');
    Route::get('/prosentase-kejadian-pasien-jatuh', [App\Http\Controllers\DataLayananController::class, 'prosentase_kejadian_pasien_jatuh'])->name('kjd-pasien-jatuh');
    Route::get('/pelayanan-dokpol', [App\Http\Controllers\DataLayananController::class, 'pelayanan_dokpol'])->name('dokpol');
    Route::get('/layanan-sertifikat', [App\Http\Controllers\DataLayananController::class, 'sertifikat'])->name('lyn-sertifikat');
    Route::get('/barang-kalibrasi', [App\Http\Controllers\DataLayananController::class, 'brg_kalibrasi'])->name('kalibrasi');
    Route::get('/indeks-kepuasan-masyarakat', [App\Http\Controllers\DataLayananController::class, 'indeks_kepuasan_masyarakat'])->name('ikm');
    
    // Route Data IKT 

});