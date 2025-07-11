<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendRalan extends Command
{
    protected $signature = 'ralan:send';
    protected $description = '';

    public function handle()
    {
        try {
            $authResponse = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post(env('AUTH_TOKEN'), [
                'satker' => env('KD_SATKER'),
                'key' => env('KEY_DEV'),
            ]);

            if (!$authResponse->successful()) {
                Log::error('Gagal login saat ambil token.', ['status' => $authResponse->status()]);
                return;
            }

            $accessToken = $authResponse->json('token'); 
            $tanggal = now()->format('Y-m-d');
            $jumlah = $this->getRalan($tanggal);

            foreach ($jumlah as $nama_poli => $total_pasien) {
                $this->sendRalanData($nama_poli, $tanggal, $total_pasien, $accessToken);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    private function getRalan($tanggal)
    {
        try {
           $poli = [
                'BEDAH ONKOLOGI',
                'ONKOLOGI GINEKOLOGI',
                'NEUROMUSKULAR, SARAF PERIFER',
                'RADIOTERAPI',
                'Akupuntur',
                'Poli Anak',
                'GIGI BEDAH MULUT',
                'BEDAH PLASTIK',
                'Poli Bedah',
                'BEDAH SARAF',
                'BTKV (BEDAH THORAX KARDIOVASKU',
                'ENDOSKOPI',
                'GIGI PERIODONTI',
                'Hemodialisa',
                'Unit IGD',
                'Poli Penyakit Dalam',
                'Instalasi Rehab Medik',
                'Poli Jantung',
                'Poli Penyakit Jiwa',
                'Kemoterapi',
                'KULIT KELAMIN',
                'GIGI PEDODONTIS',
                'LABORATORIUM PATOLOGI KLINIS',
                'Poli Penyakit Mata',
                'Medical Check Up',
                'Poli Obstetri/Gyn',
                'ORTHOPEDI',
                'Poli Paru-Paru',
                'GIGI PROSTHODONTI',
                'RADIOLOGI',
                'SARANA RADIOTERAPI',
                'Poli Penyakit Syaraf',
                'Poli Telinga/Hidung/Tenggorok',
                'Unit Gawat Darurat',
                'UROLOGI',
                'VCT'
            ];
            $jumlah = [];

            foreach ($poli as $nama_poli) {
                $jumlah[$nama_poli] = DB::table('reg_periksa')
                    ->join('poliklinik', 'reg_periksa.kd_poli', '=', 'poliklinik.kd_poli')
                    ->where('reg_periksa.status_lanjut', 'Ralan')
                    ->whereDate('reg_periksa.tgl_registrasi', $tanggal)
                    ->where('poliklinik.nm_poli', $nama_poli) 
                    ->count();
            }
            return $jumlah;

        } catch (\Exception $e) {
            \Log::error('Gagal menghitung jumlah pasien rawat jalan: ' . $e->getMessage());
        }
    }


    private function sendRalanData($nampol, $tanggal, $jumlah, $accessToken)
    {
        $response = Http::withToken($accessToken)->post(env('LYN_RAWAT_JALAN'), [
            'tgl_transaksi' => $tanggal,
            'nama_poli' => $nampol,
            'jumlah' => $jumlah,
        ]);

        if ($response->successful()) {
            Log::info("[$nampol] Data dikirim berhasil.", [
                'tanggal_transaksi' => $tanggal,
                'nama_poli' => $nampol,
                'jumlah' => $jumlah,
                'response' => $response->json()
            ]);
            $this->info("[$nampol] (Pengiriman Data).");
            $this->line(json_encode($response->json(), JSON_PRETTY_PRINT));
            $this->line('Tanggal Transaksi : ' . $tanggal);
            $this->line('Jumlah : ' . $jumlah);
        } else {
            Log::error("[$nampol] Gagal mengirim data.", [
                'tanggal_transaksi' => $tanggal,
                'nama_poli' => $nampol,
                'jumlah' => $jumlah,
                'response' => $response->json()
            ]);
            $this->error("❌ [$nampol] Gagal mengirim data.");
        }
    }
}
