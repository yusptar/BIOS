<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Exception;
use \App\Models\RegPeriksa;
use \App\Models\PermintaanLab;
use \App\Models\DetailPeriksaLab;
use \App\Models\ResepObat;
use \App\Models\PeriksaRadiologi;
use \App\Models\Operasi;
use \App\Models\Kamar;
use \App\Models\KamarInap;
use Illuminate\Support\Carbon;
use App\Helpers\ApiFormatter;
use Illuminate\Support\Facades\DB;

class BIOSController extends Controller
{
    // AUTH
    public function authentikasi(Request $request) // CONTOH STORE ($POST)
    {
        try {
             // Mengirim data ke API menggunakan Guzzle
            $client = new Client();
            $response = $client->post('https://training-bios2.kemenkeu.go.id/api2/authenticate', [
                'json' => [
                    'username' => $request->username,
                    'password' => $request->password,
                ],
                // Tambahkan header sesuai kebutuhan (misalnya, header authorization)
                'headers' => [
                    'Authorization' => 'Bearer YOUR_ACCESS_TOKEN',
                    'Content-Type' => 'application/json',
                ],
            ]);

            // Mendapatkan respons dari API
            $apiResponse = json_decode($response->getBody(), true);
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', $apiResponse);
    }


    
    // DATA SDM
    public function dataSDM(Request $request) // CONTOH STORE ($POST)
    {
        try {
            // Mengirim data ke API menggunakan Guzzle
            $client = new Client();
            $response = $client->post('https://training-bios2.kemenkeu.go.id/api/ws/kesehatan/sdm/dokter_spesialis', [
                'json' => [
                    'tgl_transaksi' =>  Carbon::now()->format('Y-m-d'),
                    'pns' => $request->pns,
                    'pppk' => $request->pppk,
                    'anggota' => $request->anggota,
                    'non_pns_tetap' => $request->non_pns_tetap,
                    'kontrak' => $request->kontrak,
                ],
                // Tambahkan header sesuai kebutuhan (misalnya, header authorization)
                'headers' => [
                    'Authorization' => 'Bearer YOUR_ACCESS_TOKEN',
                    'Content-Type' => 'application/json',
                ],
            ]);

            // Mendapatkan respons dari API
            $apiResponse = json_decode($response->getBody(), true);
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', $apiResponse);
    }




    // DATA LAYANAN
    public function dataLayanan(Request $request) // CONTOH STORE ($POST)
    {
        try {
             // Mengirim data ke API menggunakan Guzzle
            $client = new Client();
            $response = $client->post('https://training-bios2.kemenkeu.go.id/api2/authenticate', [
                'json' => [
                    'tgl_transaksi' =>  Carbon::now()->format('Y-m-d'),
                    'pns' => $request->pns,
                    'pppk' => $request->pppk,
                    'anggota' => $request->anggota,
                    'non_pns_tetap' => $request->non_pns_tetap,
                    'kontrak' => $request->kontrak,
                ],
                // Tambahkan header sesuai kebutuhan (misalnya, header authorization)
                'headers' => [
                    'Authorization' => 'Bearer YOUR_ACCESS_TOKEN',
                    'Content-Type' => 'application/json',
                ],
            ]);

            // Mendapatkan respons dari API
            $apiResponse = json_decode($response->getBody(), true);
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', $apiResponse);
    }

    public function getPasienRalan(Request $request)
    {
        try {
            $nm_poli = $request->input('nm_poli');

            $data = DB::table('reg_periksa')
                ->join('poliklinik', 'reg_periksa.kd_poli', '=', 'poliklinik.kd_poli')
                ->where('reg_periksa.status_lanjut', 'Ralan')
                ->whereDate('reg_periksa.tgl_registrasi', now()->format('Y-m-d'))
                ->where('poliklinik.nm_poli', $nm_poli) // Tambahkan kondisi where untuk kelas
                ->get();

            $count = count($data);
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', ['jumlah' => $count]);
    }

    public function getPasienRanap(Request $request)
    {
        try {
            $kelas = $request->input('kelas');

            $data = DB::table('reg_periksa')
                ->join('kamar_inap', 'reg_periksa.no_rawat', '=', 'kamar_inap.no_rawat')
                ->join('kamar', 'kamar_inap.kd_kamar', '=', 'kamar.kd_kamar')
                ->where('reg_periksa.status_lanjut', 'Ranap')
                ->whereDate('reg_periksa.tgl_registrasi', now()->format('Y-m-d'))
                ->where('kamar.kelas', $kelas) // Tambahkan kondisi where untuk kelas
                ->get();
                
            $count = count($data);
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }

        return ApiFormatter::createAPI(200, 'Success', ['jumlah' => $count]);
    }


    public function getDataPasienDarurat()
    {
        try {
            $data = RegPeriksa::where('kd_poli', 'UGD')
                    ->whereDate('tgl_registrasi', now()->format('Y-m-d'))
                    ->get();
            
            $count = count($data);
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', ['jumlah' => $count]);
    }

    public function getKunjunganRalan()
    {
        try {
            $data = RegPeriksa::where('status_lanjut', 'Ralan')
                    ->whereDate('tgl_registrasi', now()->format('Y-m-d'))
                    ->get();
            
            $count = count($data);
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', ['jumlah' => $count]);
    }

    public function getLabSampel()
    {
        try {
            $data = PermintaanLab::whereDate('tgl_permintaan', now()->format('Y-m-d'))
                    ->get();

            $count = count($data);
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', ['jumlah' => $count]);
    }

    public function getLabParameter(Request $request)
    {
        try {
            $nama_layanan = $request->input('nama_layanan');  
            if ($nama_layanan == 'HEMATOLOGI'){
                $hematologi = DB::table('jns_perawatan_lab')
                ->join('permintaan_detail_permintaan_lab', 'jns_perawatan_lab.kd_jenis_prw', '=', 'permintaan_detail_permintaan_lab.kd_jenis_prw')
                ->where(function($query) {
                    $query->where('jns_perawatan_lab.nm_perawatan', 'like', '%HEMATOLOGI%')
                          ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%FAAL HEMOSTASIS%')
                          ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%Retikulosit%')
                          ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%LED%')
                          ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%Golongan Darah%')
                          ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%TIBC%')
                          ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%Evaluasi%')
                          ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%APTT%')
                          ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%D-Dimer%')
                          ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%BMP%');
                          
                })
                ->select('jns_perawatan_lab.nm_perawatan')
                ->get();
                $count_h = count($hematologi);
                return ApiFormatter::createAPI(200, 'Success', ['jumlah' => $count_h]);
            } elseif ($nama_layanan == 'KIMIA KLINIS'){
                $kimia_klinis = DB::table('jns_perawatan_lab')
                ->join('permintaan_detail_permintaan_lab', 'jns_perawatan_lab.kd_jenis_prw', '=', 'permintaan_detail_permintaan_lab.kd_jenis_prw')
                ->where(function($query) {
                    $query->where('jns_perawatan_lab.nm_perawatan', 'like', '%LEMAK%')
                        ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%FAAL GINJAL%')
                        ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%FAAL HATI%')
                        ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%ELEKTROLIT%')
                        ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%JANTUNG%')
                        ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%ANALISA CAIRAN%')
                        ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%Malaria%')
                        ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%Urine%')
                        ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%Protein%')
                        ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%Bilirubin%')
                        ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%Sedmien%')
                        ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%Troponin I%')
                        ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%Glukosa%')
                        ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%Hba1C%')
                        ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%Cholesterol%')
                        ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%Trigliserida%')
                        ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%Ureum%')
                        ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%Kreatin%')
                        ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%Alkali%')
                        ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%SGOT%')
                        ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%SGPT%')
                        ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%Albumin%')
                        ->orWhere('jns_perawatan_lab.nm_perawatan', 'like', '%DIABETES%');
                })
                ->select('jns_perawatan_lab.nm_perawatan')
                ->get();
                $count_k = count($kimia_klinis);
                return ApiFormatter::createAPI(200, 'Success', ['jumlah' => $count_k]);
            } else {
                return ApiFormatter::createAPI(200, 'Success', ['jumlah' => 0]);
            }
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
    }

    public function getOperasi(Request $request)
    {
        try {
            $kategori = $request->input('kategori');
            
            $data = DB::table('operasi')
                ->whereDate('tgl_operasi', now()->format('Y-m-d'))
                ->where('kategori', $kategori)
                ->get();
        
            $count = count($data);
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', ['jumlah' => $count]);
    }

    public function getRadiologi()
    {
        try {
            $data = PeriksaRadiologi::whereDate('tgl_periksa', now()->format('Y-m-d'))
                    ->get();

            $count = count($data);
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', ['jumlah' => $count]);
    }

    public function getPasienBPJSdanNonBPJS()
    {
        $bpjs_values = ['BPJ'];
        $non_bpjs_values = [
            '10', '11', '13', '14', '16', '21', '22', '3', 'A09', 'A22',
            'A23', 'A25', 'A26', 'A27', 'A28', 'A29', 'A30', 'A31', 'A32', 'A42', 'A63',
            'A70', 'A77', 'A78', 'B00', 'B1', 'INH', 'SPM', 'BTK', 'A65'
        ];
        try {
            $bpjs = RegPeriksa::whereIn('kd_pj', $bpjs_values)
                    ->whereDate('tgl_registrasi', now()->format('Y-m-d'))
                    ->get();
            $non_bpjs = RegPeriksa::whereIn('kd_pj', $non_bpjs_values)
                    ->whereDate('tgl_registrasi', now()->format('Y-m-d'))
                    ->get();

            $count_bpjs = count($bpjs);
            $count_non_bpjs = count($non_bpjs);
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', ['jumlah_bpjs' => $count_bpjs, 'jumlah_non_bpjs' => $count_non_bpjs]);
    }

    public function getFarmasi()
    {
        try {
            $data = ResepObat::whereDate('tgl_perawatan', now()->format('Y-m-d'))
                    ->get();

            $count = count($data);
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', ['jumlah' => $count]);
    }

    public function getBOR()
    {
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        try {
            $data_rawat = KamarInap::with(['regPeriksa.pasien', 'kamar.bangsal'])
                ->selectRaw("SUM(kamar_inap.lama) AS jumlah_hari")
                ->whereMonth('kamar_inap.tgl_masuk', now()->format('m'))
                ->whereYear('kamar_inap.tgl_masuk', now()->format('Y'))
                ->first();

            $data_kamar = Kamar::where('statusdata', '=', '1')
                ->get();

            // PENGAMBILAN DATA JUMLAH UNTUK PERHITUNGAN RUMUS BOR
            $jumlah_hari_perawatan = $data_rawat ? $data_rawat->jumlah_hari : 0;
            $jumlah_kamar = count($data_kamar);
            $jumlah_hari = $startDate->diffInDays($endDate) + 1;
    
            // RUMUS BOR
            $rumus_bor = ($jumlah_hari_perawatan / ($jumlah_kamar * $jumlah_hari)) * 100;
            $format_bor = number_format($rumus_bor, 2);
            $bor = (int)$format_bor;
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', ['jumlah' => $bor]);
    }

    public function getTOI()
    {
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        try {
            $data_rawat = KamarInap::with(['regPeriksa.pasien', 'kamar.bangsal'])
                ->selectRaw("SUM(kamar_inap.lama) AS jumlah_hari")
                ->whereMonth('kamar_inap.tgl_masuk', now()->format('m'))
                ->whereYear('kamar_inap.tgl_masuk', now()->format('Y'))
                ->first();

            $data_kamar = Kamar::where('statusdata', '=', '1')
                ->get();

            $data_pasien = KamarInap::with(['regPeriksa.pasien', 'kamar.bangsal'])
                ->whereBetween('tgl_masuk', [now()->startOfMonth(), now()->endOfMonth()])
                ->orderBy('tgl_masuk')
                ->get();
            
            $jumlah_kamar = count($data_kamar);
            $periode = $startDate->diffInDays($endDate) + 1;
            $jumlah_hari_perawatan = $data_rawat ? $data_rawat->jumlah_hari : 0;
            $jumlah_pasien = count($data_pasien);

            // RUMUS TOI
            $rumus_toi = (($jumlah_kamar * $periode) - $jumlah_hari_perawatan) / $jumlah_pasien;
            $format_toi = number_format($rumus_toi, 2);
            $toi = (int)$format_toi;
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', ['jumlah' => $toi]);
    }

    public function getALOS()
    {
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        try {
            $data_rawat = KamarInap::with(['regPeriksa.pasien', 'kamar.bangsal'])
                ->selectRaw("SUM(kamar_inap.lama) AS jumlah_hari")
                ->whereMonth('kamar_inap.tgl_masuk', now()->format('m'))
                ->whereYear('kamar_inap.tgl_masuk', now()->format('Y'))
                ->first();
            
            $data_pasien = KamarInap::with(['regPeriksa.pasien', 'kamar.bangsal'])
                ->whereBetween('tgl_masuk', [now()->startOfMonth(), now()->endOfMonth()])
                ->orderBy('tgl_masuk')
                ->get();

            $jumlah_hari_perawatan = $data_rawat ? $data_rawat->jumlah_hari : 0;
            $jumlah_pasien = count($data_pasien);

            $rumus_alos = ($jumlah_hari_perawatan / $jumlah_pasien);
            $format_alos = number_format($rumus_alos, 2);
            $alos = (int)$format_alos;
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', ['jumlah' => $alos]);
    }

    public function getBTO()
    {
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        try {
            $data_pasien = KamarInap::with(['regPeriksa.pasien', 'kamar.bangsal'])
                ->whereBetween('tgl_masuk', [now()->startOfMonth(), now()->endOfMonth()])
                ->orderBy('tgl_masuk')
                ->get();

            $data_kamar = Kamar::where('statusdata', '=', '1')
                ->get();

            $jumlah_pasien = count($data_pasien);
            $jumlah_kamar = count($data_kamar);
    
            $rumus_bto = ($jumlah_pasien / $jumlah_kamar);
            $format_bto = number_format($rumus_bto, 2);
            $bto = (int)$format_bto;
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', ['jumlah' => $bto]);
    }

    public function getIKM()
    {
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        try {
            // BELUM TERDAPAT REFERENSI DATA PENGAMBILAN
            $count = count($data);
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', ['jumlah' => $count]);
    }
    // END DATA LAYANAN

    // IKT
    public function IKT(Request $request) // CONTOH STORE ($POST)
    {
        try {
             // Mengirim data ke API menggunakan Guzzle
            $client = new Client();
            $response = $client->post('https://training-bios2.kemenkeu.go.id/api2/authenticate', [
                'json' => [
                    'tgl_transaksi' =>  Carbon::now()->format('Y-m-d'),
                    'pns' => $request->pns,
                    'pppk' => $request->pppk,
                    'anggota' => $request->anggota,
                    'non_pns_tetap' => $request->non_pns_tetap,
                    'kontrak' => $request->kontrak,
                ],
                // Tambahkan header sesuai kebutuhan (misalnya, header authorization)
                'headers' => [
                    'Authorization' => 'Bearer YOUR_ACCESS_TOKEN',
                    'Content-Type' => 'application/json',
                ],
            ]);

            // Mendapatkan respons dari API
            $apiResponse = json_decode($response->getBody(), true);
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', $apiResponse);
    }
}
