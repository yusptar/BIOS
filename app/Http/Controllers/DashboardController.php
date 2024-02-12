<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Pegawai;
use Illuminate\Support\Facades\DB;
use \App\Models\RegPeriksa;
use \App\Models\PeriksaRadiologi;
use Illuminate\Support\Carbon;

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
        // PENGGUNA LAYANAN
        $year = Carbon::now()->year;
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = date('F', mktime(0, 0, 0, $i, 1));
        }

        $months_survey = [
            ['January', 'February', 'March'],
            ['April', 'May', 'June'],
            ['July', 'August', 'September'],
            ['October', 'November', 'December']
        ];

        $ralan = RegPeriksa::select(DB::raw('MONTH(tgl_registrasi) as month'), DB::raw('COUNT(*) as total'))
                    ->where('status_lanjut', 'Ralan')
                    ->whereYear('tgl_registrasi', $year)
                    ->groupBy('month')
                    ->orderBy(DB::raw('MONTH(tgl_registrasi)'))
                    ->get();

        $ranap = RegPeriksa::select(DB::raw('MONTH(tgl_registrasi) as month'), DB::raw('COUNT(*) as total'))
                    ->where('status_lanjut', 'Ranap')
                    ->whereYear('tgl_registrasi', $year)
                    ->groupBy('month')
                    ->orderBy(DB::raw('MONTH(tgl_registrasi)'))
                    ->get();

        $radiologi = PeriksaRadiologi::select(DB::raw('MONTH(tgl_periksa) as month'), DB::raw('COUNT(*) as total'))
                    ->whereYear('tgl_periksa', $year)
                    ->groupBy('month')
                    ->orderBy(DB::raw('MONTH(tgl_periksa)'))
                    ->get();
                    
        return view('dashboard.layanan', compact('ralan', 'ranap', 'radiologi', 'months', 'months_survey'));
    }

    public function sdm()
    {
        // KOMPOSISI SDM
        $kom_sdm = Pegawai::select('stts_kerja', DB::raw('COUNT(*) as total'))->groupBy('stts_kerja')->get();
        $labels1 = $kom_sdm->pluck('stts_kerja')->toArray(); 
        $data1 = $kom_sdm->pluck('total')->toArray(); 
        $backgroundColors1 = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'];
        while(count($backgroundColors1) < count($labels1)){
            $backgroundColors1 = array_merge($backgroundColors1, $backgroundColors1);
        }
        $backgroundColors1 = array_slice($backgroundColors1, 0, count($labels1));

        // PROFIL SDM
        $prof_sdm = Pegawai::select('pendidikan', DB::raw('COUNT(*) as total'))->groupBy('pendidikan')->get();
        $labels2 = $prof_sdm->pluck('pendidikan')->toArray(); 
        $data2 = $prof_sdm->pluck('total')->toArray(); 
        $backgroundColors2 = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'];
        while(count($backgroundColors2) < count($labels2)){
            $backgroundColors2 = array_merge($backgroundColors2, $backgroundColors2);
        }
        $backgroundColors2 = array_slice($backgroundColors2, 0, count($labels2));

        return view('dashboard.sdm', compact('labels1','labels2', 'data1','data2','backgroundColors1','backgroundColors2'));
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