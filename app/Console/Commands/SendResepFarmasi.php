<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendResepFarmasi extends Command
{
    protected $signature = 'resep:send';
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

            $tanggal = now()->subDay()->format('Y-m-d');
            $jumlah = $this->getResep($tanggal);

            $sendResponse = Http::withToken($accessToken)->post(env('LYN_FARMASI'), [
                'tgl_transaksi' => $tanggal,
                'jumlah' => $jumlah,
            ]);

            if ($sendResponse->successful()) {
                Log::info('Data sent successfully.', [
                    'tanggal_transaksi' => $tanggal,
                    'jumlah' => $jumlah,
                    'response' => $sendResponse->json()
                ]);
                $this->info('JSON Response dari API:');
                $this->line(json_encode($sendResponse->json(), JSON_PRETTY_PRINT));
                $this->line('Tanggal Transaksi : ' . $tanggal);
                $this->line('Jumlah : ' . $jumlah);
               
            } else {
                Log::error('Failed to send.', ['body' => $sendResponse->body()]);
                $this->error('Gagal mengirim data.');
                $this->line('Tanggal Transaksi : ' . $tanggal);
                $this->line('Jumlah : ' . $jumlah);
            }

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    private function getResep($tanggal)
    {
        return \App\Models\ResepObat::whereDate('tgl_perawatan', $tanggal)->count();
    }
}
