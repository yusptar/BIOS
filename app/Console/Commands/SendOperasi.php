<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendOperasi extends Command
{
    protected $signature = 'operasi:send';
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
            $jumlah = $this->getOperasi($tanggal);

            $this->sendOperasiData('Khusus', $tanggal, $jumlah['Khusus'], $accessToken);
            $this->sendOperasiData('Besar', $tanggal, $jumlah['Besar'], $accessToken);
            $this->sendOperasiData('Sedang', $tanggal, $jumlah['Sedang'], $accessToken);
            $this->sendOperasiData('Kecil', $tanggal, $jumlah['Kecil'], $accessToken);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    private function getOperasi($tanggal)
    {
        try {
            $kategori_operasi = ['Khusus', 'Besar', 'Sedang', 'Kecil'];
            $jumlah = [];

            foreach ($kategori_operasi as $kategori) {
                $jumlah[$kategori] = DB::table('operasi')
                    ->whereDate('tgl_operasi', $tanggal)
                    ->where('kategori', $kategori)
                    ->count();
            }

            return $jumlah;

        } catch (\Exception $e) {
            \Log::error('Gagal menghitung jumlah operasi: ' . $e->getMessage());
            return [
                'Khusus' => 0,
                'Besar' => 0,
                'Sedang' => 0,
                'Kecil' => 0,
            ];
        }
    }


    private function sendOperasiData($operasi, $tanggal, $jumlah, $accessToken)
    {
        $response = Http::withToken($accessToken)->post(env('LYN_OPERASI'), [
            'tgl_transaksi' => $tanggal,
            'klasifikasi_operasi' => $operasi,
            'jumlah' => $jumlah,
        ]);

        if ($response->successful()) {
            Log::info("[$operasi] Data dikirim berhasil.", [
                'tanggal_transaksi' => $tanggal,
                'klasifikasi_operasi' => $operasi,
                'jumlah' => $jumlah,
                'response' => $response->json()
            ]);
            $this->info("[$operasi] (Pengiriman Data).");
            $this->line(json_encode($response->json(), JSON_PRETTY_PRINT));
            $this->line('Tanggal Transaksi : ' . $tanggal);
            $this->line('Jumlah : ' . $jumlah);
        } else {
            Log::error("[$operasi] Gagal mengirim data.", [
                'tanggal_transaksi' => $tanggal,
                'klasifikasi_operasi' => $operasi,
                'jumlah' => $jumlah,
                'response' => $response->json()
            ]);
            $this->error("❌ [$operasi] Gagal mengirim data.");
        }
    }
}
