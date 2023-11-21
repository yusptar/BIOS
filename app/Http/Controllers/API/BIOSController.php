<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Exception;
use \App\Models\RegPeriksa;
use \App\Models\PeriksaLab;
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
            $data = PeriksaLab::whereDate('tgl_periksa', now()->format('Y-m-d'))
                    ->groupBy(['jam', 'kd_jenis_prw'])
                    ->selectRaw('jam, kd_jenis_prw, COUNT(*) as total')
                    ->get();

            $count = count($data);
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', ['jumlah' => $count]);
    }

    public function getLabParameter()
    {
        try {
            $data = DetailPeriksaLab::whereDate('tgl_periksa', now()->format('Y-m-d'))
                    ->groupBy(['jam', 'kd_jenis_prw'])
                    ->selectRaw('jam, kd_jenis_prw, COUNT(*) as total')
                    ->get();

            $count = count($data);
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', ['jumlah' => $count]);
    }

    public function getOperasi(Request $request)
    {
        try {
            $kategori = $request->input('kategori');

            $data = Operasi::when($kategori, function ($query) use ($kategori) {
                    return $query->where('kategori', $kategori);
                })
                ->whereDate('tgl_operasi', now()->format('Y-m-d'))
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
        try {
            $data_hari = DB::table('kamar_inap')
                ->join('reg_periksa', 'kamar_inap.no_rawat', '=', 'reg_periksa.no_rawat')
                ->join('pasien', 'reg_periksa.no_rkm_medis', '=', 'pasien.no_rkm_medis')
                ->join('kamar', 'kamar_inap.kd_kamar', '=', 'kamar.kd_kamar')
                ->join('bangsal', 'kamar.kd_bangsal', '=', 'bangsal.kd_bangsal')
                ->select(
                    'kamar_inap.no_rawat',
                    'reg_periksa.no_rkm_medis',
                    'pasien.nm_pasien',
                    DB::raw("CONCAT(kamar.kd_kamar, ' ', bangsal.nm_bangsal) AS kamar"),
                    'kamar_inap.tgl_masuk',
                    DB::raw("IF(kamar_inap.tgl_keluar = '0000-00-00', CURRENT_DATE(), kamar_inap.tgl_keluar) AS tgl_keluar"),
                    'kamar_inap.lama',
                    'kamar_inap.stts_pulang'
                )
                ->whereDate('kamar_inap.tgl_masuk', now()->format('Y-m-d'))
                ->orderBy('kamar_inap.tgl_masuk')
                ->get();
            
            $data_kamar = DB::table('kamar')
                ->where('statusdata', '=', '1')
                ->get();

            $jumlah_hari = count($data_hari);
            $jumlah_kamar = count($data_kamar);

            // RUMUS BOR
            $rumus_bor = ($jumlah_hari / ($jumlah_kamar * 1)) * 100;
            $format_bor = number_format($rumus_bor, 2, '.', '');
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', ['jumlah' => $format_bor]);
    }

    public function getTOI()
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

    public function getALOS()
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

    public function getBTO()
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

    public function getIKM()
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
