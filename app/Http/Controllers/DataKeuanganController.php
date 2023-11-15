<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataKeuanganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function penerimaan()
    {
        return view('data_keuangan.penerimaan');
    }

    public function pengeluaran()
    {
        return view('data_keuangan.pengeluaran');
    }

    public function saldo_rekening_ops()
    {
        return view('data_keuangan.saldo_rekening_ops');
    }

    public function saldo_rekening_pengelolaan_kas()
    {
        return view('data_keuangan.saldo_rekening_pengelolaan_kas');
    }

    public function saldo_rekening_dana_kelolaan()
    {
        return view('data_keuangan.saldo_rekening_dana_kelolaan');
    }

}