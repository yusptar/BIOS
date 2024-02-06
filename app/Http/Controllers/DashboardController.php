<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.index');
    }

    public function layanan()
    {
        return view('dashboard.layanan');
    }

    public function sdm()
    {
        return view('dashboard.sdm');
    }

    public function keuangan()
    {
        return view('dashboard.keuangan');
    }

    public function pendukung()
    {
        return view('dashboard.pendukung');
    }
}