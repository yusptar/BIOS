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
    // Route Data Keuangan
    Route::get('/penerimaan', [App\Http\Controllers\DataKeuanganController::class, 'penerimaan'])->name('penerimaan');
    Route::get('/pengeluaran', [App\Http\Controllers\DataKeuanganController::class, 'pengeluaran'])->name('pengeluaran');
    Route::get('/saldo-rekening-operasional', [App\Http\Controllers\DataKeuanganController::class, 'saldo_rekening_ops'])->name('sldo-rkn-ops');
    Route::get('/saldo-rekening-pengelolaan-kas', [App\Http\Controllers\DataKeuanganController::class, 'saldo_rekening_pengelolaan_kas'])->name('sldo-rkn-kas');
    Route::get('/saldo-rekening-dana-kelolaan', [App\Http\Controllers\DataKeuanganController::class, 'saldo_rekening_dana_kelolaan'])->name('sldo-rkn-dana-kl');

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
    Route::get('/vst-psn-kurang-dari-atau-sama-dengan-jam-10', [App\Http\Controllers\IKTController::class, 'visite_psn_10'])->name('vst-psn-10');
    Route::get('/vst-psn-jam-10-hingga-jam-12', [App\Http\Controllers\IKTController::class, 'visite_psn_10_12'])->name('vst-psn-10-12');
    Route::get('/vst-psn-lebih-dari-jam-12', [App\Http\Controllers\IKTController::class, 'visite_psn_12'])->name('vst-psn-12');
    Route::get('/dpjp-tidak-visite', [App\Http\Controllers\IKTController::class, 'dpjp_tidak_visite'])->name('dpjp-non-visite');
    Route::get('/kegiatan-visite-pertama', [App\Http\Controllers\IKTController::class, 'kegiatan_visite_pasien_pertama'])->name('kgtn-visite-psn');
    Route::get('/raiso-pobo', [App\Http\Controllers\IKTController::class, 'rasio_pobo'])->name('pobo');
    Route::get('/aset-blu', [App\Http\Controllers\IKTController::class, 'pertumbuhan_realisasi_pendapatan_dari_pengelolaan_asetBLU'])->name('aset-blu');
    Route::get('/rekam-medis-elektronik', [App\Http\Controllers\IKTController::class, 'penyelenggara_rekam_medis_elektronik'])->name('rkm-medis-elektronik');
    Route::get('/protokol-kesehatan', [App\Http\Controllers\IKTController::class, 'kepatuhan_pelaksanaan_protokol_kesehatan'])->name('protokol-kesehatan');
    Route::get('/alat-kesehatan-produksi', [App\Http\Controllers\IKTController::class, 'presentase_pembelian_alat_kesehatan_produksi_dalam_negeri'])->name('alat-kesehatan');
    Route::get('/kepuasan-pasien', [App\Http\Controllers\IKTController::class, 'kepuasan_pasien'])->name('kpuasan-psn');
    Route::get('/waktu-visite-dpjp', [App\Http\Controllers\IKTController::class, 'kepatuhan_waktu_visite_dpjp'])->name('wkt-visite-dpjp');
    Route::get('/kemampuan-menangani-bblsr-1500g', [App\Http\Controllers\IKTController::class, 'kemampuan_menangani_bblsr_1500g'])->name('bblsr-1500');
    Route::get('/keberhasilan-tindakan-bedah-jantung-cabg-tof', [App\Http\Controllers\IKTController::class, 'keberhasilan_tindakan_bedah_jantung_cabg_dan_tof'])->name('cabg-tof');
    Route::get('/kesehatan-jiwa-who', [App\Http\Controllers\IKTController::class, 'penyelenggaraan_layanan_kesehatan_jiwa_safewards_who'])->name('kes-jiw-who');
    Route::get('/napza-who', [App\Http\Controllers\IKTController::class, 'penyelenggaraan_layanan_napza__safewards_who'])->name('napza-who');
    Route::get('/proporsi-pasien-tb-mdr-rs', [App\Http\Controllers\IKTController::class, 'proporsi_pasien_tb_mdr_khusus_rs'])->name('tb-mdr-rs');
    Route::get('/retinopati-diabetika', [App\Http\Controllers\IKTController::class, 'progresivitas_retinopati_diabetika'])->name('retinopati-diabetika');
    Route::get('/biometri-katarak', [App\Http\Controllers\IKTController::class, 'persentase_pengulangan_pemeriksaan_biometri_katarak'])->name('biometri-katarak');
    Route::get('/bedah-ortho', [App\Http\Controllers\IKTController::class, 'persentase_kasus_ilo_bedah_ortho'])->name('bedah-ortho'); 
    Route::get('/door-to-needle', [App\Http\Controllers\IKTController::class, 'door_to_needle'])->name('door-to-needle');
    Route::get('/operasi-ca-mammae', [App\Http\Controllers\IKTController::class, 'masa_tunggu_operasi_ca_mamae'])->name('ops-ca-mammae');
    Route::get('/rehab-medik', [App\Http\Controllers\IKTController::class, 'pelayanan_rehab_medik_respiratori'])->name('rehab-medik');
    Route::get('/program-kesehatan-paru', [App\Http\Controllers\IKTController::class, 'terlaksananya_program_kesehatan_paru'])->name('program-kesehatan-paru');
    Route::get('/prosentase-tersusun', [App\Http\Controllers\IKTController::class, 'prosentase_tersusun_dan_terimplementasi'])->name('prosentase-tersusun');
    Route::get('/proporsi-tb-mdr-bbkpm', [App\Http\Controllers\IKTController::class, 'proporsi_pasien_tb_mdr_khusus_bbkpm'])->name('tb-mdr-bbkpm');
    Route::get('/waktu-pelayanan-lab-covid19', [App\Http\Controllers\IKTController::class, 'waktu_pelayanan_pemeriksaan_lab_covid19'])->name('plyn-lab-covid19');
    Route::get('/tingkat-pme', [App\Http\Controllers\IKTController::class, 'tingkat_kepesertaan_penyelenggaraan_pme'])->name('penyelengaraan-pme');
    Route::get('/sisfo-balkes', [App\Http\Controllers\IKTController::class, 'penyelenggaraan_sistem_informasi_balkes'])->name('sisfo-balkes');
    Route::get('/kebersihan-tangan', [App\Http\Controllers\IKTController::class, 'kepatuhan_kebersihan_tangan'])->name('kebersihan-tangan');
    Route::get('/penggunaan-apd', [App\Http\Controllers\IKTController::class, 'kepatuhan_penggunaan_apd'])->name('apd');
    Route::get('/identifikasi-pasien', [App\Http\Controllers\IKTController::class, 'kepatuhan_identifikasi_pasien'])->name('identifikasi-pasien');
    Route::get('/waktu-tanggap-operasi-seksio-sesarea-emergensi', [App\Http\Controllers\IKTController::class, 'waktu_tanggap_operasi_seksio_sesarea_emergensi'])->name('seksio-emergensi');
    Route::get('/waktu-tunggu-rawat-jalan', [App\Http\Controllers\IKTController::class, 'waktu_tunggu_rawat_jalan'])->name('wkt-tunggu-rawat-jalan');
    Route::get('/operasi-elektif', [App\Http\Controllers\IKTController::class, 'penundaan_operasi_elektif'])->name('ops-elektif');
    Route::get('/kepatuhan-waktu-visite-dokter', [App\Http\Controllers\IKTController::class, 'kepatuhan_waktu_visite_dokter'])->name('kepatuhan-wkt-visite-dokter');
    Route::get('/pelaporan-hasil-kritis-lab', [App\Http\Controllers\IKTController::class, 'pelaporan_hasil_kritis_lab'])->name('kritis-lab');
    Route::get('/kepatuhan-penggunaan-formularium-nasional', [App\Http\Controllers\IKTController::class, 'kepatuhan_penggunaan_formularium_nasional'])->name('form-nasional');
    Route::get('/alur-klinis', [App\Http\Controllers\IKTController::class, 'kepatuhan_terhadap_alur_klinis'])->name('alur-klinis');
    Route::get('/resiko-pasien-jatuh', [App\Http\Controllers\IKTController::class, 'kepatuhan_upaya_pencegahan_resiko_pasien_jatuh'])->name('resiko-psn-jatuh');
    Route::get('/tanggap-komplain', [App\Http\Controllers\IKTController::class, 'kecepatan_waktu_tanggap_komplain'])->name('tanggap-komplain');
    Route::get('/indikator-pelayanan-mcu-pelaut', [App\Http\Controllers\IKTController::class, 'indikator_pelayanan_mcu_pelaut'])->name('mcu-pelaut');
    Route::get('/indikator-pelayanan-penilikan-kesehatan-lingkungan-kerja-pelayaran', [App\Http\Controllers\IKTController::class, 'indikator_pelayanan_penilikan_kesling_kerja_pelayaran'])->name('kesling-pelayaran');
    Route::get('/indikator-penyediaan-dokumen-kesehatan-pelaut', [App\Http\Controllers\IKTController::class, 'indikator_penyediaan_dokumen_kesehatan_pelaut'])->name('kesehatan-pelaut');
});