<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Exception;
use App\Helpers\ApiFormatter;

class BIOSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authentikasi(Request $request)
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
