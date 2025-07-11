<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendBPJSNonBPJS extends Command
{
    protected $signature = 'bpjsnonbpjs:send';
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
            $jumlah = $this->ambilDataBPJSNonBPJS($tanggal);

            $sendResponse = Http::withToken($accessToken)->post(env('LYN_PSN_BPJS_NONBPJS'), [
                'tgl_transaksi' => $tanggal,
                'jumlah_bpjs' => $jumlah['jumlah_bpjs'],
                'jumlah_non_bpjs' => $jumlah['jumlah_non_bpjs'],
            ]);

            if ($sendResponse->successful()) {
                Log::info('Data sent successfully.', [
                    'tgl_transaksi' => $tanggal,
                    'jumlah_bpjs' => $jumlah['jumlah_bpjs'],
                    'jumlah_non_bpjs' => $jumlah['jumlah_non_bpjs'],
                    'response' => $sendResponse->json()
                ]);
                $this->info('JSON Response dari API:');
                $this->line(json_encode($sendResponse->json(), JSON_PRETTY_PRINT));
                $this->line('Tanggal Transaksi : ' . $tanggal);
                $this->line('Jumlah BPJS : ' . $jumlah['jumlah_bpjs']);
                $this->line('Jumlah Non BPJS : ' . $jumlah['jumlah_non_bpjs']);
               
            } else {
                Log::error('Failed to send.', ['body' => $sendResponse->body()]);
            }

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    private function ambilDataBPJSNonBPJS($tanggal)
    {
        $bpjs_values = ['BPJ'];
        $non_bpjs_values = [
            '10', '11', '13', '14', '16', '21', '22', '3', 'A09', 'A22',
            'A23', 'A25', 'A26', 'A27', 'A28', 'A29', 'A30', 'A31', 'A32', 'A42', 'A63',
            'A70', 'A77', 'A78', 'B00', 'B1', 'INH', 'SPM', 'BTK', 'A65'
        ];

        try {
            $jumlah_bpjs = \App\Models\RegPeriksa::whereIn('kd_pj', $bpjs_values)
                ->whereDate('tgl_registrasi', $tanggal)
                ->count();

            $jumlah_non_bpjs = \App\Models\RegPeriksa::whereIn('kd_pj', $non_bpjs_values)
                ->whereDate('tgl_registrasi', $tanggal)
                ->count();

            return [
                'jumlah_bpjs' => $jumlah_bpjs,
                'jumlah_non_bpjs' => $jumlah_non_bpjs
            ];
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return [
                'jumlah_bpjs' => 0,
                'jumlah_non_bpjs' => 0
            ];
        }
    }

}
