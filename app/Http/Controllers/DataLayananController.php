<?php

namespace App\Http\Controllers;

use \App\Models\Poliklinik;
use Illuminate\Http\Request;

class DataLayananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pasien_rawat_inap()
    {
        return view('data_layanan.psn_rawat_inap');
    }

    public function pasien_rawat_darurat()
    {
        return view('data_layanan.psn_rawat_darurat');
    }

    public function layanan_lab_sampel()
    {
        return view('data_layanan.layanan_lab_sampel');
    }

    public function layanan_lab_parameter()
    {
        return view('data_layanan.layanan_lab_parameter');
    }

    public function tindakan_operasi()
    {
        return view('data_layanan.tindakan_operasi');
    }

    public function layanan_radiologi()
    {
        return view('data_layanan.layanan_radiologi');
    }

    public function layanan_forensik()
    {
        return view('data_layanan.layanan_forensik');
    }

    public function kunj_rawat_jalan()
    {
        return view('data_layanan.kunj_rawat_jalan');
    }

    public function pasien_rawat_jalan()
    {
        return view('data_layanan.psn_rawat_jalan');
    }

    public function pasien_bpjs_nonbpjs()
    {
        return view('data_layanan.psn_bpjs_nonbpjs');
    }
     
    public function layanan_farmasi()
    {
        return view('data_layanan.layanan_farmasi');
    }
    
    public function BOR()
    {
        return view('data_layanan.bor');
    }
    
    public function TOI()
    {
        return view('data_layanan.toi');
    }
    
    public function ALOS()
    {
        return view('data_layanan.alos');
    }
    
    public function BTO()
    {
        return view('data_layanan.bto');
    }
    
    public function indeks_kepuasan_masyarakat()
    {
        return view('data_layanan.ikm');
    } 
}