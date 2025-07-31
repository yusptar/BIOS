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
            $data = DB::table('reg_periksa as rp')
                ->join('poliklinik as poli', 'poli.kd_poli', '=', 'rp.kd_poli')
                ->select('poli.nm_poli', DB::raw('COUNT(rp.no_rawat) as jml'))
                ->whereDate('rp.tgl_registrasi', $tanggal)
                ->groupBy('rp.kd_poli', 'poli.nm_poli')
                ->pluck('jml', 'poli.nm_poli');

            return $data;

        } catch (\Exception $e) {
            \Log::error('Gagal mengambil jumlah pasien rawat jalan: ' . $e->getMessage());
            return [];
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
            Log::info("RALAN - [$nampol] Data dikirim berhasil.", [
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
