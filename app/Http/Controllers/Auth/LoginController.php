<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use App\Models\Pegawai; 
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Session;
use Alert;
use Exception;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
            // Authenticate the user
        if (auth()->attempt($credentials)) {
            $user_data = Pegawai::where('nik', $credentials['username'])->first(); 
            $ses_data = [
                'id' => $user_data->nik, 
                'username' => $user_data->nama, 
            ];
            Session::put($ses_data);

            try {
                $client = new Client();
                $response = $client->post('https://training-bios2.kemenkeu.go.id/api/token', [
                    'json' => [
                        'satker' => $request->satker,
                        'key' => $request->key,
                    ],
                    'headers' => [
                        'Content-Type' => 'application/json',
                    ],
                ]);
                $apiResponse = json_decode($response->getBody(), true);
                $accessToken = $apiResponse['token'];
                auth()->user()->update(['token' => $accessToken]);
                echo "<script>console.log(" . json_encode($apiResponse) . ");</script>";
            } catch (Exception $errmsg) {
                echo "<script>console.error(" . $errmsg->getMessage() . ");</script>";
            }
            Alert::success('Login Berhasil!', 'Selamat Datang!');
            return redirect()->route('dashboard');    
        } else {
            Alert::error('Oops! Login Gagal.', 'Terdapat kesalahan pada username atau password! ');
            return redirect()->back();
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}