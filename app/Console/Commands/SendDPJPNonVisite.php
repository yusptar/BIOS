<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SendDPJPNonVisite extends Command
{
    protected $signature = 'dpjp_non_visite:send';
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
            $jumlah = $this->ambilDataDPJPNonVisite($tanggal);

            $sendResponse = Http::withToken($accessToken)->post(env('IKT_DPJP_NON_VISITE'), [
                'tgl_transaksi' => $tanggal,
                'jumlah' => $jumlah,
            ]);

            if ($sendResponse->successful()) {
                Log::info('DPJP Non Visite Data sent successfully.', [
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
                $this->line('Jumlah Pasien DPJP Non Visite : ' . $jumlah);
            }

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    private function ambilDataDPJPNonVisite($tanggal) {
       $data = DB::table('dokter')
           ->leftJoin('rawat_inap_drpr', function($join) use ($tanggal) {
               $join->on('dokter.kd_dokter', '=', 'rawat_inap_drpr.kd_dokter')
                    ->whereDate('rawat_inap_drpr.tgl_perawatan', $tanggal);
           })
           ->whereNull('rawat_inap_drpr.kd_dokter')
           ->select('dokter.*')
           ->get();
       $count = count($data);
       return $count;
   }
}
