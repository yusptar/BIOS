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
            ])->post(env('PROD_TOKEN'), [
                'satker' => env('KD_SATKER'),
                'key' => env('KEY_PROD'),
            ]);

            if (!$authResponse->successful()) {
                Log::error('Gagal login saat ambil token.', ['status' => $authResponse->status()]);
                return;
            }

            $accessToken = $authResponse->json('token'); 
            $tanggal = now()->subDay()->format('Y-m-d');
            $jumlah = $this->getRanap($tanggal);

            foreach ($jumlah as $kelas => $total_pasien) {
                $this->sendRanapData($kelas, $tanggal, $total_pasien, $accessToken);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    private function getRanap($tanggal)
    {
        try {
            $data = DB::table('reg_periksa as rp')
                ->join('kamar_inap', 'rp.no_rawat', '=', 'kamar_inap.no_rawat')
                ->join('kamar', 'kamar_inap.kd_kamar', '=', 'kamar.kd_kamar')
                ->select('kamar.kelas', DB::raw('COUNT(rp.no_rawat) as jml'))
                ->where('rp.status_lanjut', 'Ranap')
                ->whereDate('kamar_inap.tgl_masuk', $tanggal)
                ->groupBy('kamar.kelas')
                ->pluck('jml', 'kamar.kelas');

            return $data;

        } catch (\Exception $e) {
            \Log::error('Gagal mengambil jumlah pasien rawat inap: ' . $e->getMessage());
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
            Log::info("RANAP - [$kode_kelas] Data dikirim berhasil.", [
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
