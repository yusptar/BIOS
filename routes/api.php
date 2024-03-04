<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::group(['prefix' => 'profil'], function () {
//     Route::apiResource('pages', PagesController::class);
//     Route::apiResource('jajarandireksi', JajaranDireksiController::class);
// });

// Route::get('berita/popular', [BeritaController::class, 'indexPopular']);
// Route::apiResource('berita', BeritaController::class);
// Route::get('artikel/popular', [ArtikelController::class, 'indexPopular']);
// Route::apiResource('artikel', ArtikelController::class);
// Route::apiResource('parkir', ParkirController::class);
// Route::apiResource('poliklinik', PoliklinikController::class);

// Route::post('encrypt-file', [ContohEncryptController::class, 'store']);
// Route::get('decrypt-file', [ContohEncryptController::class, 'decrypt']);
// Route::apiResource('review', ReviewController::class);
// Route::apiResource('pengaduan', PengaduanController::class);
// Route::apiResource('jenis-laporan-pengaduan', JenisLaporanPengaduanController::class);
// Route::apiResource('spesialis', SpesialisController::class);
// Route::apiResource('permintaan-ppid', PermintaanPPIDController::class);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// AUTH
Route::post('/authentikasi', [App\Http\Controllers\API\BIOSController::class, 'authentikasi']);

// SDM
Route::post('/dataSDM', [App\Http\Controllers\API\BIOSController::class, 'dataSDM']);

// LAYANAN
Route::post('/dataLayanan', [App\Http\Controllers\API\BIOSController::class, 'dataLayanan']);
Route::get('/get-psn-ralan',  [App\Http\Controllers\API\BIOSController::class, 'getPasienRalan'])->name('getPsnRalan');
Route::get('/get-psn-ranap',  [App\Http\Controllers\API\BIOSController::class, 'getPasienRanap'])->name('getPsnRanap');
Route::get('/get-psn-darurat',  [App\Http\Controllers\API\BIOSController::class, 'getDataPasienDarurat'])->name('getPasienIGD');
Route::get('/get-kunj-ralan',  [App\Http\Controllers\API\BIOSController::class, 'getKunjunganRalan'])->name('getRalan');
Route::get('/get-lab-sampel',  [App\Http\Controllers\API\BIOSController::class, 'getLabSampel'])->name('getSampel');
Route::get('/get-lab-param',  [App\Http\Controllers\API\BIOSController::class, 'getLabParameter'])->name('getParameter');
Route::get('/get-operasi',  [App\Http\Controllers\API\BIOSController::class, 'getOperasi'])->name('getOperasi');
Route::get('/get-radiologi',  [App\Http\Controllers\API\BIOSController::class, 'getRadiologi'])->name('getRadiologi');
Route::get('/get-bpjs-non-bpjs',  [App\Http\Controllers\API\BIOSController::class, 'getPasienBPJSdanNonBPJS'])->name('getBPJSNonBPJS');
Route::get('/get-farmasi',  [App\Http\Controllers\API\BIOSController::class, 'getFarmasi'])->name('getFarmasi');
Route::get('/get-bor',  [App\Http\Controllers\API\BIOSController::class, 'getBOR'])->name('getBOR');
Route::get('/get-toi',  [App\Http\Controllers\API\BIOSController::class, 'getTOI'])->name('getTOI');
Route::get('/get-alos',  [App\Http\Controllers\API\BIOSController::class, 'getALOS'])->name('getALOS');
Route::get('/get-bto',  [App\Http\Controllers\API\BIOSController::class, 'getBTO'])->name('getBTO');
Route::get('/get-ikm',  [App\Http\Controllers\API\BIOSController::class, 'getIKM'])->name('getIKM');

// IKT
Route::post('/IKT', [App\Http\Controllers\API\BIOSController::class, 'IKT']);
Route::get('/get-visite-10',  [App\Http\Controllers\API\BIOSController::class, 'getVisitePasien10'])->name('getVP10');
Route::get('/get-visite-10-12',  [App\Http\Controllers\API\BIOSController::class, 'getVisitePasien1012'])->name('getVP1012');
Route::get('/get-visite-12',  [App\Http\Controllers\API\BIOSController::class, 'getVisitePasien12'])->name('getVP12');
Route::get('/get-dpjp-non-visite',  [App\Http\Controllers\API\BIOSController::class, 'getDPJPNonVisite'])->name('getDPJP');
Route::get('/get-visite-pertama',  [App\Http\Controllers\API\BIOSController::class, 'getKegiatanVisitePertama'])->name('getVisitePertama');


