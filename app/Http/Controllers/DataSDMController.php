<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataSDMController extends Controller
{
    // Auth
    public function __construct()
    {
        $this->middleware('auth');
    }

    //  View Dokter Spesialis
    public function dokter_spesialis()
    {
        return view('data_sdm.dokter_spesialis');
    }

    // View Dokter Gigi
    public function dokter_gigi()
    {
        return view('data_sdm.dokter_gigi');
    }

    // View Dokter Umum
    public function dokter_umum()
    {
        return view('data_sdm.dokter_umum');
    }

    // View Tenaga Perawat
    public function tenaga_perawat()
    {
        return view('data_sdm.tng_perawat');
    }

    // View Tenaga Bidan
    public function tenaga_bidan()
    {
        return view('data_sdm.tng_bidan');
    }

    // View Pranata Laboratorium
    public function pranata_laboratorium()
    {
        return view('data_sdm.pran_lab');
    }

    // View Radiographer
    public function radiographer()
    {
        return view('data_sdm.radiographer');
    }

    // View Nutrisionist
    public function nutrisionist()
    {
        return view('data_sdm.nutrisionist');
    }

    // View Fisioterapis
    public function fisioterapis()
    {
        return view('data_sdm.fisioterapis');
    }

    // View Pharmacist
    public function pharmacist()
    {
        return view('data_sdm.pharmacist');
    } 
    
    // View Tenaga Professional Lainnya
    public function tenaga_professional()
    {
        return view('data_sdm.tng_professional');
    }
    
    // View Tenaga Non-Medis
    public function tenaga_non_medis()
    {
        return view('data_sdm.tng_non-medis');
    }

    // View Tenaga Medis Administrasi
    public function tenaga_non_medis_adm()
    {
        return view('data_sdm.tng_non-medis_adm');
    }

    // View Sanitarian
    public function sanitarian()
    {
        return view('data_sdm.sanitarian');
    }
}