<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendLabParameter extends Command
{
    protected $signature = 'labparam:send';
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
            $jumlah = $this->getLabParameter($tanggal);

            $this->sendLabData('HEMATOLOGI', $tanggal, $jumlah['hematologi'], $accessToken);
            $this->sendLabData('KIMIA KLINIS', $tanggal, $jumlah['kimia_klinis'], $accessToken);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    private function getLabParameter($tanggal)
    {
        try {
            $hematologi = DB::table('periksa_lab as p')
                ->join('jns_perawatan_lab as j', 'j.kd_jenis_prw', '=', 'p.kd_jenis_prw')
                ->join('template_laboratorium as t', 'j.kd_jenis_prw', '=', 't.kd_jenis_prw')
                ->where(function ($query) {
                    $query->where(function ($sub) {
                        $sub->where(function ($q) {
                            $q->where('t.Pemeriksaan', 'like', '%Lekosit%')
                            ->orWhere('t.Pemeriksaan', 'like', '%Eritrosit%');
                        })->where('j.nm_perawatan', 'like', '%HEMATOLOGI%');
                    })
                    ->orWhere('t.Pemeriksaan', 'like', '%Hemoglobin%')
                    ->orWhere('t.Pemeriksaan', 'like', '%Trombosit%')
                    ->orWhere('t.Pemeriksaan', 'like', '%Retikulosit%')
                    ->orWhere('t.Pemeriksaan', 'like', '%HCT%')
                    ->orWhere('t.Pemeriksaan', 'like', '%MCH%')
                    ->orWhere('t.Pemeriksaan', 'like', '%MCV%')
                    ->orWhere('t.Pemeriksaan', 'like', '%MCHC%')
                    ->orWhere('t.Pemeriksaan', 'like', '%LED%')
                    ->orWhere('t.Pemeriksaan', 'like', '%Golongan Darah%')
                    ->orWhere('t.Pemeriksaan', 'like', '%Morfologi%')
                    ->orWhere('t.Pemeriksaan', 'like', '%Masa Perdarahan%')
                    ->orWhere('t.Pemeriksaan', 'like', '%Masa Pembekuan%')
                    ->orWhere('t.Pemeriksaan', 'like', '%PT%')
                    ->orWhere('t.Pemeriksaan', 'like', '%APTT%')
                    ->orWhere('t.Pemeriksaan', 'like', '%BMP%')
                    ->orWhere('j.nm_perawatan', 'like', '%Rhesus%')
                    ->orWhere('j.nm_perawatan', 'like', '%HAPUSAN DARAH TEPI%')
                    ->orWhere('j.nm_perawatan', 'like', '%Morofologi%')
                    ->orWhere('j.nm_perawatan', 'like', '%BMP%');
                })
                ->whereDate('p.tgl_periksa', $tanggal)
                ->count();

            $kimia_klinis = DB::table('periksa_lab as p')
                ->join('jns_perawatan_lab as j', 'j.kd_jenis_prw', '=', 'p.kd_jenis_prw')
                ->join('template_laboratorium as t', 'j.kd_jenis_prw', '=', 't.kd_jenis_prw')
                ->where(function ($query) {
                    $query->where('t.Pemeriksaan', 'like', '%T3%')
                        ->orWhere('t.Pemeriksaan', 'like', '%T4%')
                        ->orWhere('t.Pemeriksaan', 'like', '%TSH%')
                        ->orWhere('t.Pemeriksaan', 'like', '%Glukosa%')
                        ->orWhere('t.Pemeriksaan', 'like', '%Kolesterol%')
                        ->orWhere('t.Pemeriksaan', 'like', '%Trigliser%')
                        ->orWhere('t.Pemeriksaan', 'like', '%Ureum%')
                        ->orWhere('t.Pemeriksaan', 'like', '%Kreatinin%')
                        ->orWhere('t.Pemeriksaan', 'like', '%Uric Acid%')
                        ->orWhere('t.Pemeriksaan', 'like', '%Alkali%')
                        ->orWhere('t.Pemeriksaan', 'like', '%Bilirubin Direk%')
                        ->orWhere('t.Pemeriksaan', 'like', '%Bilirubin Total%')
                        ->orWhere('t.Pemeriksaan', 'like', '%Total Protein%')
                        ->orWhere('t.Pemeriksaan', 'like', '%Albumin%')
                        ->orWhere('t.Pemeriksaan', 'like', '%Globulin%')
                        ->orWhere('t.Pemeriksaan', 'like', '%Natrium%')
                        ->orWhere('t.Pemeriksaan', 'like', '%Kalium%')
                        ->orWhere('t.Pemeriksaan', 'like', '%Chlorida%')
                        ->orWhere('t.Pemeriksaan', 'like', '%BGA%')
                        ->orWhere('t.Pemeriksaan', 'like', '%Widal%')
                        ->orWhere('t.Pemeriksaan', 'like', '%VDRL%')
                        ->orWhere('t.Pemeriksaan', 'like', '%IgM SALMONELLA%')
                        ->orWhere('t.Pemeriksaan', 'like', '%Anti Dengue%')
                        ->orWhere('t.Pemeriksaan', 'like', '%HBsAg%')
                        ->orWhere('t.Pemeriksaan', 'like', '%ANTI HCV%')
                        ->orWhere('j.nm_perawatan', 'like', '%ANTI HIV%')
                        ->orWhere('t.Pemeriksaan', 'like', '%Malaria ICT%')
                        ->orWhere('t.Pemeriksaan', 'like', '%TROPONIN 1 RAPID%')
                        ->orWhere('t.Pemeriksaan', 'like', '%TROPONIN I ( RAPID )%');
                })
                ->whereDate('p.tgl_periksa', $tanggal)
                ->count();

            return [
                'hematologi' => $hematologi,
                'kimia_klinis' => $kimia_klinis
            ];
        } catch (\Exception $e) {
            \Log::error('Gagal menghitung parameter lab: ' . $e->getMessage());
            return 0;
        }
    }

    private function sendLabData($layanan, $tanggal, $jumlah, $accessToken)
    {
        $response = Http::withToken($accessToken)->post(env('LYN_LAB_PARAM'), [
            'tgl_transaksi' => $tanggal,
            'nama_layanan' => $layanan,
            'jumlah' => $jumlah,
        ]);

        if ($response->successful()) {
            Log::info("[$layanan] Data dikirim berhasil.", [
                'tanggal_transaksi' => $tanggal,
                'nama_layanan' => $layanan,
                'jumlah' => $jumlah,
                'response' => $response->json()
            ]);
            $this->info("[$layanan] (Pengiriman Data).");
            $this->line(json_encode($response->json(), JSON_PRETTY_PRINT));
            $this->line('Tanggal Transaksi : ' . $tanggal);
            $this->line('Jumlah : ' . $jumlah);
        } else {
            Log::error("[$layanan] Gagal mengirim data.", [
                'tanggal_transaksi' => $tanggal,
                'jumlah' => $jumlah,
                'response' => $response->body()
            ]);
            $this->error("❌ [$layanan] Gagal mengirim data.");
        }
    }
}
