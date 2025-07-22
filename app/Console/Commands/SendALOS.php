<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\KamarInap;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendALOS extends Command
{
    protected $signature = 'alos:send';
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

            $tanggal = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
            $alos = $this->getALOS();

            $sendResponse = Http::withToken($accessToken)->post(env('LYN_ALOS'), [
                'tgl_transaksi' => $tanggal,
                'alos' => $alos,
            ]);

            if ($sendResponse->successful()) {
                Log::info('ALOS sent successfully.', [
                    'tanggal_transaksi' => $tanggal,
                    'alos' => $alos,
                    'response' => $sendResponse->json()
                ]);
                $this->info('JSON Response dari API:');
                $this->line(json_encode($sendResponse->json(), JSON_PRETTY_PRINT));
                $this->line('Tanggal Transaksi : ' . $tanggal);
                $this->line('ALOS : ' . $alos);
               
            } else {
                Log::error('Failed to send.', ['body' => $sendResponse->body()]);
                $this->error('Gagal mengirim data.');
                $this->line('Tanggal Transaksi : ' . $tanggal);
                $this->line('ALOS : ' . $alos);
            }

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function getALOS()
    {
        $startDate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');

        $lamaInap = $this->getLamaInap($startDate, $endDate);
        $jumlahPasien = $this->getJumlahPasienInap($startDate, $endDate);
        $jumlahPasienKeluar = KamarInap::whereBetween('tgl_keluar', [$startDate, $endDate])
            ->distinct('no_rawat')
            ->count('no_rawat');

        if ($jumlahPasienKeluar > 0) {
            $alos = round($lamaInap / $jumlahPasienKeluar, 2);
        } else {
            $alos = 0;
        }

        return $alos;
    }


    public function getLamaInap($date1,$date2)
    {
        $dataQuery = KamarInap::selectRaw('SUM(lama) AS lama')
                ->whereBetween('tgl_masuk', [$date1,$date2])
                ->get();
        return $dataQuery[0]->lama;
    }

    public function getHariPerawatan($year, $month, $days)
    {
        $d = '';
        $lama = 0;
        for ($i = 1; $i <= $days; $i++) {
            if($i < 10){
                $d = '0'.$days;
            } else {
                $d = $days;
            }
            $m = ($month < 10) ? '0'.$month : $month;
            $dataQuery = KamarInap::selectRaw('COUNT(kd_kamar) AS jml')
                ->where('tgl_masuk', '<', $year.'-'.$m.'-'.$d)
                ->where('tgl_keluar', '>=', $year.'-'.$m.'-'.$d)
                ->get()
                ->first();
            $lama += $dataQuery['jml'];

        }
        return $lama;
    }

    public function getJumlahPasienInap($date1,$date2)
    {
        $dataQuery = KamarInap::groupBy('no_rawat')
                ->select('no_rawat')
                ->whereBetween('tgl_masuk', [$date1,$date2])
                ->get();
        return count($dataQuery);
    }

    public function getJumlahBed()
    {
        $dataQuery = DB::select(DB::raw("select count(*) as jmlbed from kamar where statusdata='1'"));
        return $dataQuery[0]->jmlbed;
    }
}
