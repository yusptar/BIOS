<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendVisite12 extends Command
{
    protected $signature = 'visite12:send';
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
            $jumlah = $this->ambilDataVisite12($tanggal);

            $sendResponse = Http::withToken($accessToken)->post(env('IKT_VST_12'), [
                'tgl_transaksi' => $tanggal,
                'jumlah' => $jumlah,
            ]);

            if ($sendResponse->successful()) {
                Log::info('Visite 12 Data sent successfully.', [
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
                $this->line('Jumlah Pasien Visite 12 : ' . $jumlah);
            }

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    private function ambilDataVisite12($tanggal) {
        $data = DB::table('rawat_inap_drpr')
            ->whereDate('tgl_perawatan', now()->format('Y-m-d'))
            ->whereTime('jam_rawat', '>', '12:00:00')
            ->get();
             
        $count = count($data);
        return $count;
   }
}
