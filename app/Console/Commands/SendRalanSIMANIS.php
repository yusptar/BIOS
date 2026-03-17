<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendRalanSIMANIS extends Command
{
    protected $signature = 'ralansimanis:send';
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

            $tanggal = now()->format('Y-m-d');
            // $tanggal = '2026-03-15';

            $data = $this->getDataRalan($tanggal);

            foreach ($data as $row) {
                $this->sendRalanData($row, $accessToken);
            }

        } catch (\Exception $e) {
            Log::channel('simanis')->error($e->getMessage());
        }
    }

    private function getDataRalan($tanggal)
    {
        try {
            $data = DB::table('reg_periksa as r')
                ->join('bridging_sep as bs', 'bs.no_rawat', '=', 'r.no_rawat')
                ->leftJoin('simanis_encounter as se', 'se.no_rawat', '=', 'r.no_rawat')
                ->select(
                    'r.no_reg as id_kunjungan',
                    'r.tgl_registrasi',
                    'r.no_rawat',
                    'r.no_rkm_medis',
                    'r.kd_pj as jenis_pasien',
                    'bs.diagawal as ICD10',
                    'r.status_lanjut',
                    DB::raw("IFNULL(se.id_encounter,'') as id_encounter")
                )
                ->whereDate('r.tgl_registrasi', $tanggal)
                ->whereNull('se.id_encounter')
                ->distinct()
                ->get();

            return $data;

        } catch (\Exception $e) {
            Log::channel('simanis')->error('Gagal mengambil data SIMANIS: '.$e->getMessage());
        }
    }


    private function sendRalanData($row, $accessToken)
    {
        try {
            switch ($row->status_lanjut) {
                case 'Rujukan': $kodeTindakLanjut = '1'; break;
                case 'Ranap':   $kodeTindakLanjut = '2'; break;
                case 'Ralan':   $kodeTindakLanjut = '3'; break;
                default:        $kodeTindakLanjut = '0'; break;
            }

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

            $payload = [
                "ID_KUNJUNGAN_RS" => $row->id_kunjungan,
                "TANGGAL_KUNJUNGAN" => $row->tgl_registrasi,
                "NO_RM" => $row->no_rkm_medis,
                "JENIS_PASIEN" => $kodeJenisPasien,
                "ICD_10" => $row->ICD10,
                "TINDAK_LANJUT_PELAYANAN" => $kodeTindakLanjut
            ];
            

            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$accessToken,
                'Content-Type' => 'application/json'
            ])->post(env('POST_RALAN_SIMANIS'), $payload);

            $body = $response->body();
            $cleanBody = explode('<script', $body)[0];
            $result = json_decode($cleanBody, true);
            
            Log::channel('simanis')->info("DATA SIMANIS", [
                'no_rm' => $row->no_rkm_medis,
                'status' => $result['STATUS'] ?? 'UNKNOWN',
                'id' => $result['ID'] ?? null
            ]);
            $this->info(
                "SIMANIS | RM: ".$row->no_rkm_medis.
                " | STATUS: ".($result['STATUS'] ?? 'UNKNOWN').
                " | ID: ".($result['ID'] ?? '-')
            );

            $idEncounter = $result['ID'] ?? null;

            if ($idEncounter) {
                DB::table('simanis_encounter')->insert([
                    'no_rawat' => $row->no_rawat,
                    'id_encounter' => $idEncounter
                ]);
            }
            $this->info("Encounter berhasil: ".$idEncounter);
        } catch (\Exception $e) {
            Log::channel('simanis')->error('Error kirim SIMANIS: '.$e->getMessage());
        }
    }
}
