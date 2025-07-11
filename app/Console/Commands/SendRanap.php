<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendRanap extends Command
{
    protected $signature = 'ranap:send';
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
            $jumlah = $this->getRanap($tanggal);

            foreach ($jumlah as $kode_kelas => $total_pasien) {
                $this->sendRanapData($kode_kelas, $tanggal, $total_pasien, $accessToken);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    private function getRanap($tanggal)
    {
        try {
            $kode_kelas = ['KELAS III', 'KELAS II', 'KELAS I', 'VIP', 'VVIP', 'HCU', 'ICU'];
            $jumlah = [];

            foreach ($kode_kelas as $kode) {
                $jumlah[$kode] =  DB::table('reg_periksa')
                    ->join('kamar_inap', 'reg_periksa.no_rawat', '=', 'kamar_inap.no_rawat')
                    ->join('kamar', 'kamar_inap.kd_kamar', '=', 'kamar.kd_kamar')
                    ->where('reg_periksa.status_lanjut', 'Ranap')
                    ->whereDate('reg_periksa.tgl_registrasi', $tanggal)
                    ->where('kamar.kelas', $kode) 
                    ->count();
            }

            return $jumlah;

        } catch (\Exception $e) {
            \Log::error('Gagal menghitung jumlah pasien rawat inap: ' . $e->getMessage());
        }
    }


    private function sendRanapData($kode_kelas, $tanggal, $jumlah, $accessToken)
    {
        $response = Http::withToken($accessToken)->post(env('LYN_RAWAT_INAP'), [
            'tgl_transaksi' => $tanggal,
            'kode_kelas' => $kode_kelas,
            'jumlah' => $jumlah,
        ]);

        if ($response->successful()) {
            Log::info("[$kode_kelas] Data dikirim berhasil.", [
                'tanggal_transaksi' => $tanggal,
                'kode_kelas' => $kode_kelas,
                'jumlah' => $jumlah,
                'response' => $response->json()
            ]);
            $this->info("[$kode_kelas] (Pengiriman Data).");
            $this->line(json_encode($response->json(), JSON_PRETTY_PRINT));
            $this->line('Tanggal Transaksi : ' . $tanggal);
            $this->line('Jumlah : ' . $jumlah);
        } else {
            Log::error("[$kode_kelas] Gagal mengirim data.", [
                'tanggal_transaksi' => $tanggal,
                'kode_kelas' => $kode_kelas,
                'jumlah' => $jumlah,
                'response' => $response->json()
            ]);
            $this->error("❌ [$kode_kelas] Gagal mengirim data.");
        }
    }
}
