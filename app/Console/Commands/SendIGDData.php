<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendIGDData extends Command
{
    protected $signature = 'igd:send';
    protected $description = 'Kirim data IGD ke endpoint dengan token auto-login';

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
            $jumlah = $this->ambilDataIGD($tanggal);

            $sendResponse = Http::withToken($accessToken)->post(env('LYN_RAWAT_DARURAT'), [
                'tgl_transaksi' => $tanggal,
                'jumlah' => $jumlah,
            ]);

            if ($sendResponse->successful()) {
                Log::info('Data IGD sent successfully.', [
                    'tanggal_transaksi' => $tanggal,
                    'jumlah' => $jumlah,
                    'response' => $sendResponse->json()
                ]);
                $this->info('JSON Response dari API:');
                $this->line(json_encode($sendResponse->json(), JSON_PRETTY_PRINT));
                $this->line('Tanggal Transaksi : ' . $tanggal);
                $this->line('Jumlah Pasien IGD : ' . $jumlah);
               
            } else {
                Log::error('Failed to send IGD.', ['body' => $sendResponse->body()]);
                $this->error('Gagal mengirim data IGD.');
                $this->line('Tanggal Transaksi : ' . $tanggal);
                $this->line('Jumlah Pasien IGD : ' . $jumlah);
            }

        } catch (\Exception $e) {
            Log::error('Error in IGD Scheduler: ' . $e->getMessage());
        }
    }

    private function ambilDataIGD($tanggal)
    {
        return \App\Models\RegPeriksa::where('kd_poli', 'UGD')
            ->whereDate('tgl_registrasi', $tanggal)
            ->count();
    }
}
