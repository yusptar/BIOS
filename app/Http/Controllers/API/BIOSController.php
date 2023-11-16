<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Exception;
use \App\Models\PasienDarurat;
use Illuminate\Support\Carbon;
use App\Helpers\ApiFormatter;

class BIOSController extends Controller
{
    // AUTH
    public function authentikasi(Request $request) // CONTOH STORE ($POST)
    {
        try {
             // Mengirim data ke API menggunakan Guzzle
            $client = new Client();
            $response = $client->post('https://training-bios2.kemenkeu.go.id/api2/authenticate', [
                'json' => [
                    'username' => $request->username,
                    'password' => $request->password,
                ],
                // Tambahkan header sesuai kebutuhan (misalnya, header authorization)
                'headers' => [
                    'Authorization' => 'Bearer YOUR_ACCESS_TOKEN',
                    'Content-Type' => 'application/json',
                ],
            ]);

            // Mendapatkan respons dari API
            $apiResponse = json_decode($response->getBody(), true);
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', $apiResponse);
    }


    
    // DATA SDM
    public function dataSDM(Request $request) // CONTOH STORE ($POST)
    {
        try {
             // Mengirim data ke API menggunakan Guzzle
            $client = new Client();
            $response = $client->post('https://training-bios2.kemenkeu.go.id/api/ws/kesehatan/sdm/dokter_spesialis', [
                'json' => [
                    'tgl_transaksi' =>  Carbon::now()->format('Y-m-d'),
                    'pns' => $request->pns,
                    'pppk' => $request->pppk,
                    'anggota' => $request->anggota,
                    'non_pns_tetap' => $request->non_pns_tetap,
                    'kontrak' => $request->kontrak,
                ],
                // Tambahkan header sesuai kebutuhan (misalnya, header authorization)
                'headers' => [
                    'Authorization' => 'Bearer YOUR_ACCESS_TOKEN',
                    'Content-Type' => 'application/json',
                ],
            ]);

            // Mendapatkan respons dari API
            $apiResponse = json_decode($response->getBody(), true);
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', $apiResponse);
    }




    // DATA LAYANAN
    public function dataLayanan(Request $request) // CONTOH STORE ($POST)
    {
        try {
             // Mengirim data ke API menggunakan Guzzle
            $client = new Client();
            $response = $client->post('https://training-bios2.kemenkeu.go.id/api2/authenticate', [
                'json' => [
                    'username' => $request->username,
                    'password' => $request->password,
                ],
                // Tambahkan header sesuai kebutuhan (misalnya, header authorization)
                'headers' => [
                    'Authorization' => 'Bearer YOUR_ACCESS_TOKEN',
                    'Content-Type' => 'application/json',
                ],
            ]);

            // Mendapatkan respons dari API
            $apiResponse = json_decode($response->getBody(), true);
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', $apiResponse);
    }

    public function getDataPasienDarurat() // CONTOH GET ($GET)
    {
        try {
            $data = PasienDarurat::where('kd_poli', 'IGDK')->count();
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', $data);
    }
    // END DATA LAYANAN



    // IKT
    public function IKT(Request $request) // CONTOH STORE ($POST)
    {
        try {
             // Mengirim data ke API menggunakan Guzzle
            $client = new Client();
            $response = $client->post('https://training-bios2.kemenkeu.go.id/api2/authenticate', [
                'json' => [
                    'username' => $request->username,
                    'password' => $request->password,
                ],
                // Tambahkan header sesuai kebutuhan (misalnya, header authorization)
                'headers' => [
                    'Authorization' => 'Bearer YOUR_ACCESS_TOKEN',
                    'Content-Type' => 'application/json',
                ],
            ]);

            // Mendapatkan respons dari API
            $apiResponse = json_decode($response->getBody(), true);
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', $apiResponse);
    }
}
