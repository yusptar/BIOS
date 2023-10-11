<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IKTController extends Controller
{
    // Auth
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dokter_spesialis()
    {
        return view('data_sdm.dokter_spesialis');
    }

}