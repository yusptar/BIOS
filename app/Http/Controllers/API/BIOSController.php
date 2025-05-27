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
            $response = $client->post('*', [
                'json' => [
                    'satker' => $request->satker,
                    'key' => $request->key,
                ],
                // Tambahkan header sesuai kebutuhan (misalnya, header authorization)
                'headers' => [
                    'Authorization' => 'Bearer BEARER_TOKEN',
                    'Content-Type' => 'application/json',
                ],
            ]);
            // Mendapatkan respons dari API
            $apiResponse = json_decode($response->getBody(), true);
            $accessToken = $apiResponse['token'];
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
            $response = $client->post('*', [
                'json' => [
                    'tgl_transaksi' =>  Carbon::now()->format('Y-m-d'),
                    'pns' => $request->pns,
                    'pppk' => $request->pppk,
                    'anggota' => $request->anggota,
                    'non_pns_tetap' => $request->non_pns_tetap,
                    'kontrak' => $request->kontrak,
                    'token' => $request->token,
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
            $response = $client->post('*', [
                'json' => [
                    'tgl_transaksi' =>  Carbon::now()->format('Y-m-d'),
                    'kode_kelas' => $request->kode_kelas,
                    'jumlah' => $request->jumlah,
                    'token' => $request->token,
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
                ->where('poliklinik.nm_poli', $nm_poli) 
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
                ->where('kamar.kelas', $kelas) 
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
            if ($nama_layanan == 'HEMATOLOGI') {
                $hematologi = DB::table('periksa_lab as p')
                    ->join('jns_perawatan_lab as j', 'j.kd_jenis_prw', '=', 'p.kd_jenis_prw')
                    ->join('template_laboratorium as t', 'j.kd_jenis_prw', '=', 't.kd_jenis_prw')
                    ->where(function ($query) {
                        $query->where(function ($sub) {
                            $sub->where(function ($q) {
                                $q->where('t.Pemeriksaan', 'like', '%Lekosit%')
                                ->orWhere('t.Pemeriksaan', 'like', '%Eritrosit%');
                            })->where('j.nm_perawatan', 'like', '%HEMATOLOGI%');
                        })
                        ->orWhere('t.Pemeriksaan', 'like', '%Hemoglobin%')
                        ->orWhere('t.Pemeriksaan', 'like', '%Trombosit%')
                        ->orWhere('t.Pemeriksaan', 'like', '%Retikulosit%')
                        ->orWhere('t.Pemeriksaan', 'like', '%HCT%')
                        ->orWhere('t.Pemeriksaan', 'like', '%MCH%')
                        ->orWhere('t.Pemeriksaan', 'like', '%MCV%')
                        ->orWhere('t.Pemeriksaan', 'like', '%MCHC%')
                        ->orWhere('t.Pemeriksaan', 'like', '%LED%')
                        ->orWhere('t.Pemeriksaan', 'like', '%Golongan Darah%')
                        ->orWhere('t.Pemeriksaan', 'like', '%Morfologi%')
                        ->orWhere('t.Pemeriksaan', 'like', '%Masa Perdarahan%')
                        ->orWhere('t.Pemeriksaan', 'like', '%Masa Pembekuan%')
                        ->orWhere('t.Pemeriksaan', 'like', '%PT%')
                        ->orWhere('t.Pemeriksaan', 'like', '%APTT%')
                        ->orWhere('t.Pemeriksaan', 'like', '%BMP%')
                        ->orWhere('j.nm_perawatan', 'like', '%Rhesus%')
                        ->orWhere('j.nm_perawatan', 'like', '%HAPUSAN DARAH TEPI%')
                        ->orWhere('j.nm_perawatan', 'like', '%Morofologi%')
                        ->orWhere('j.nm_perawatan', 'like', '%BMP%');
                    })
                    ->whereDate('p.tgl_periksa', Carbon::today())
                    ->select('p.tgl_periksa', 'j.nm_perawatan', 't.Pemeriksaan', 'p.no_rawat')
                    ->get();

                $count_h = count($hematologi);
                return ApiFormatter::createAPI(200, 'Success', ['jumlah' => $count_h]);
            } elseif ($nama_layanan == 'KIMIA KLINIS') {
                $kimia_klinis = DB::table('periksa_lab as p')
                    ->join('jns_perawatan_lab as j', 'j.kd_jenis_prw', '=', 'p.kd_jenis_prw')
                    ->join('template_laboratorium as t', 'j.kd_jenis_prw', '=', 't.kd_jenis_prw')
                    ->where(function ($query) {
                        $query->where('t.Pemeriksaan', 'like', '%T3%')
                            ->orWhere('t.Pemeriksaan', 'like', '%T4%')
                            ->orWhere('t.Pemeriksaan', 'like', '%TSH%')
                            ->orWhere('t.Pemeriksaan', 'like', '%Glukosa%')
                            ->orWhere('t.Pemeriksaan', 'like', '%Kolesterol%')
                            ->orWhere('t.Pemeriksaan', 'like', '%Trigliser%')
                            ->orWhere('t.Pemeriksaan', 'like', '%Ureum%')
                            ->orWhere('t.Pemeriksaan', 'like', '%Kreatinin%')
                            ->orWhere('t.Pemeriksaan', 'like', '%Uric Acid%')
                            ->orWhere('t.Pemeriksaan', 'like', '%Alkali%')
                            ->orWhere('t.Pemeriksaan', 'like', '%Bilirubin Direk%')
                            ->orWhere('t.Pemeriksaan', 'like', '%Bilirubin Total%')
                            ->orWhere('t.Pemeriksaan', 'like', '%Total Protein%')
                            ->orWhere('t.Pemeriksaan', 'like', '%Albumin%')
                            ->orWhere('t.Pemeriksaan', 'like', '%Globulin%')
                            ->orWhere('t.Pemeriksaan', 'like', '%Natrium%')
                            ->orWhere('t.Pemeriksaan', 'like', '%Kalium%')
                            ->orWhere('t.Pemeriksaan', 'like', '%Chlorida%')
                            ->orWhere('t.Pemeriksaan', 'like', '%BGA%')
                            ->orWhere('t.Pemeriksaan', 'like', '%Widal%')
                            ->orWhere('t.Pemeriksaan', 'like', '%VDRL%')
                            ->orWhere('t.Pemeriksaan', 'like', '%IgM SALMONELLA%')
                            ->orWhere('t.Pemeriksaan', 'like', '%Anti Dengue%')
                            ->orWhere('t.Pemeriksaan', 'like', '%HBsAg%')
                            ->orWhere('t.Pemeriksaan', 'like', '%ANTI HCV%')
                            ->orWhere('j.nm_perawatan', 'like', '%ANTI HIV%')
                            ->orWhere('t.Pemeriksaan', 'like', '%Malaria ICT%')
                            ->orWhere('t.Pemeriksaan', 'like', '%TROPONIN 1 RAPID%')
                            ->orWhere('t.Pemeriksaan', 'like', '%TROPONIN I ( RAPID )%');
                    })
                    ->whereDate('p.tgl_periksa', Carbon::today())
                    ->select('p.tgl_periksa', 'j.nm_perawatan', 't.Pemeriksaan', 'p.no_rawat')
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

    // START DATA IKT
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
    
    public function getVisitePasien10(Request $request)
    {
    
        try {
            $data = DB::table('rawat_inap_drpr')
            ->whereDate('tgl_perawatan', now()->format('Y-m-d'))
            ->whereTime('jam_rawat', '<=', '10:00:00')
            ->get();
            
            $count = count($data);

        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', ['jumlah' => $count]);
    }

    public function getVisitePasien1012(Request $request)
    {
    
        try {
            $data = DB::table('rawat_inap_drpr')
            ->whereDate('tgl_perawatan', now()->format('Y-m-d'))
            ->whereTime('jam_rawat', '>', '10:00:00')
            ->whereTime('jam_rawat', '<=', '12:00:00')
            ->get();
            
            $count = count($data);

        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', ['jumlah' => $count]);
    }

    
    public function getVisitePasien12(Request $request)
    {
    
        try {
            $data = DB::table('rawat_inap_drpr')
            ->whereDate('tgl_perawatan', now()->format('Y-m-d'))
            ->whereTime('jam_rawat', '>', '12:00:00')
            ->get();
            
            $count = count($data);

        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', ['jumlah' => $count]);
    }


    public function getDPJPNonVisite(Request $request)
    {
        try {
            $data = DB::table('dokter')
                ->leftJoin('rawat_inap_drpr', function($join) {
                    $join->on('dokter.kd_dokter', '=', 'rawat_inap_drpr.kd_dokter')
                        ->whereDate('rawat_inap_drpr.tgl_perawatan', now()->format('Y-m-d'));
                })
                ->whereNull('rawat_inap_drpr.kd_dokter')
                ->select('dokter.*')
                ->get();

            $count = count($data);
        
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', ['jumlah' => $count]);
    }
    
    public function getKegiatanVisitePertama(Request $request)
    {
        try {
            $data = DB::table('rawat_inap_drpr')
            ->whereDate('tgl_perawatan', now()->format('Y-m-d'))
            ->get();
            
            $count = count($data);

        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', ['jumlah' => $count]);
    }
    // END DATA IKT
}

