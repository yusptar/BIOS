<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use App\Models\Pegawai; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use Alert;
use Exception;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('username', 'password');

        // Rate limiting
        $key = Str::lower($request->input('username')).'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            return redirect()->back()->with([
                'error' => 'Terlalu banyak melakukan kesalahan login, coba lagi setelah ' . $seconds . ' detik',
                'seconds' => $seconds
            ]);
        }

        // Authenticate the user
        if (auth()->attempt($credentials)) {
            RateLimiter::clear($key); // Clear the rate limit on successful login

            $user = auth()->user();

            if ($user->role == 'admin') {
                $user_data = Pegawai::where('nik', $credentials['username'])->first();
                $ses_data = [
                    'id' => $user_data->nik,
                    'username' => $user_data->nama,
                ];
                Session::put($ses_data);

                try {
                    $client = new Client();
                    $response = $client->post(getenv('AUTH_TOKEN'), [
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
                    $user->update(['token' => $accessToken]);
                } catch (Exception $errmsg) {
                    return redirect()->back()->with('error', 'Kesalahan pada saat mendapatkan token: ' . $errmsg->getMessage());
                }

                Alert::success('Login Berhasil!', 'Selamat Datang! Admin.');
                return redirect()->route('dashboard');
            } else {
                Alert::success('Login Berhasil!', 'Selamat Datang! Direktorat PPKBLU.');
                return redirect()->route('dashboard');
            }
        } else {
            RateLimiter::hit($key); // Hit the rate limit
            Alert::error('Login Gagal!', 'Terdapat kesalahan pada username atau password! ');
            return redirect()->back();
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
