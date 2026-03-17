<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendRanapSIMANIS extends Command
{
    protected $signature = 'ranapsimanis:send';
    protected $description = '';

    public function handle()
    {
        try {

            $authResponse = Http::post(env('URL_AUTH_SIMANIS'), [
                'USER' => env('KEY_SIMANIS'),
                'PASS' => env('SECRET_KEY_SIMANIS'),
            ]);

            if (!$authResponse->successful()) {
                Log::channel('simanis')->error('Gagal ambil token SIMANIS');
                return;
            }

            $accessToken = $authResponse->json('access_token');

            $data = $this->getDataRanap();

            foreach ($data as $row) {
                $this->sendRanapData($row, $accessToken);
            }

        } catch (\Exception $e) {
            Log::channel('simanis')->error($e->getMessage());
        }
    }

    private function getDataRanap()
    {
        try {
            $data = DB::table('reg_periksa as r')
                ->join('bridging_sep as bs', 'bs.no_rawat', '=', 'r.no_rawat')
                ->join('kamar_inap as ki', 'ki.no_rawat', '=', 'r.no_rawat')
                ->leftJoin('simanis_ranap_encounter as se', 'se.no_rawat', '=', 'r.no_rawat')
                ->select(
                    'r.no_reg as id_kunjungan',
                    'r.tgl_registrasi',
                    'r.no_rawat',
                    'r.no_rkm_medis',
                    'r.kd_pj as jenis_pasien',
                    'bs.diagawal as ICD10',
                    'ki.tgl_keluar as tanggal_pulang',
                    'ki.lama as lama_rawat',

                    DB::raw("
                        CASE 
                            WHEN ki.stts_pulang = 'Sehat' THEN 'Pulang'
                            WHEN ki.stts_pulang = 'Rujuk' THEN 'Pindah ke Rumkit Lain'
                            WHEN ki.stts_pulang = 'APS' THEN 'Pulang'
                            WHEN ki.stts_pulang = 'Meninggal' THEN 'Pulang'
                            WHEN ki.stts_pulang = 'Sembuh' THEN 'Pulang'
                            WHEN ki.stts_pulang = 'Membaik' THEN 'Pulang'
                            WHEN ki.stts_pulang = 'Pulang Paksa' THEN 'Pulang Paksa'
                            WHEN ki.stts_pulang = '-' THEN NULL
                            ELSE 'Pulang'
                        END as cara_pulang
                    "),

                    DB::raw("
                        CASE 
                            WHEN ki.stts_pulang IN ('Sehat','Sembuh','Membaik') THEN 'Hidup Sembuh'
                            WHEN ki.stts_pulang = 'Meninggal' THEN 'Meninggal < 48 Jam'
                            WHEN ki.stts_pulang = '-' THEN NULL
                            ELSE 'Belum Sembuh'
                        END as kondisi_pulang
                    "),

                    DB::raw("IFNULL(se.id_encounter,'') as id_encounter")
                )
                ->whereBetween('r.tgl_registrasi', [
                    now()->startOfMonth(),
                    now()->endOfDay()
                ])
                ->whereNull('se.id_encounter')
                ->whereNotNull('ki.tgl_keluar')
                ->where('ki.tgl_keluar', '!=', '0000-00-00')
                ->where('ki.stts_pulang', '!=', '-')
                ->distinct()
                ->get();

            return $data;

        } catch (\Exception $e) {
            Log::channel('simanis')->error('Gagal mengambil data SIMANIS: '.$e->getMessage());
        }
    }


    private function sendRanapData($row, $accessToken)
    {
        try {

            // mapping jenis pasien
            switch ($row->jenis_pasien) {
                case '16':  $kodeJenisPasien = '7'; break;
                case 'BPJ': $kodeJenisPasien = '8'; break;
                case 'A09':
                case '13':
                case '21':
                case '22':
                case '11':
                case '14':
                    $kodeJenisPasien = '9'; break;
                default: $kodeJenisPasien = '0';
            }

            if (!$row->tanggal_pulang || !$row->cara_pulang || !$row->kondisi_pulang) {
                Log::channel('simanis')->warning("Data tidak valid", [
                    'no_rawat' => $row->no_rawat
                ]);
                return;
            }

            $payload = [
                "ID_KUNJUNGAN_RS" => $row->id_kunjungan,
                "TANGGAL_KUNJUNGAN" => $row->tgl_registrasi,
                "NO_RM" => $row->no_rkm_medis,
                "JENIS_PASIEN" => $kodeJenisPasien,
                "ICD_10" => $row->ICD10,
                "TANGGAL_PULANG" => $row->tanggal_pulang,
                "HARI_DIRAWAT" => $row->lama_rawat,
                "CARA_PULANG" => $row->cara_pulang,
                "KEADAAN_PULANG" => $row->kondisi_pulang
            ];

            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$accessToken,
                'Content-Type' => 'application/json'
            ])->post(env('POST_RANAP_SIMANIS'), $payload);

            $body = $response->body();
            $cleanBody = explode('<script', $body)[0];
            $result = json_decode($cleanBody, true);

            Log::channel('simanis')->info("SIMANIS RANAP", [
                'no_rm' => $row->no_rkm_medis,
                'status' => $result['STATUS'] ?? 'UNKNOWN',
                'id' => $result['ID'] ?? null
            ]);

            $this->info(
                "SIMANIS RANAP | RM: ".$row->no_rkm_medis.
                " | STATUS: ".($result['STATUS'] ?? 'UNKNOWN').
                " | ID: ".($result['ID'] ?? '-')
            );

            $idEncounter = $result['ID'] ?? null;

            if ($idEncounter) {
                DB::table('simanis_ranap_encounter')->insert([
                    'no_rawat' => $row->no_rawat,
                    'id_encounter' => $idEncounter
                ]);

                $this->info("Encounter berhasil: ".$idEncounter);
            }

        } catch (\Exception $e) {
            Log::channel('simanis')->error('Error kirim SIMANIS: '.$e->getMessage());
        }
    }
}
