@extends('layouts.main')
@section('content')
@php($groups = \App\Support\BiosMenu::groups())
@php($formTotal = collect($groups)->except(['dashboard', 'pengaturan'])->sum(fn ($g) => count($g['items'])))
<div class="content-wrapper" id="main">
    @include('layouts.partials.page-header', ['title' => 'Beranda', 'eyebrow' => 'BIOS Web Service'])

    <section class="content">
        <div class="container-fluid">
            <div class="bios-hero">
                <div>
                    <h2>Selamat datang{{ Auth::user()->role === 'direktorat' ? ', Direktorat PPK BLU' : '' }}</h2>
                    @can('admin')
                        <p>Kirim data keuangan, SDM, layanan, dan indikator kinerja RS Tk. II dr. Soepraoen ke BIOS. Setiap formulir otomatis memakai tanggal transaksi H-1.</p>
                    @else
                        <p>Pantau ringkasan layanan, SDM, keuangan, dan data pendukung RS Tk. II dr. Soepraoen.</p>
                    @endcan
                </div>
                <div class="bios-hero-facts">
                    <div><small>Tanggal transaksi</small><strong data-bios-txdate>—</strong></div>
                    @can('admin')
                        <div><small>Formulir</small><strong>{{ $formTotal }}</strong></div>
                    @endcan
                </div>
            </div>

            <h2 class="bios-section-title">Dashboard</h2>
            <div class="bios-grid bios-grid-4">
                @php($dash = [
                    'dashboard-layanan' => ['fas fa-stethoscope', 'Pengguna layanan rawat jalan, rawat inap, radiologi, dan survei IKM.'],
                    'dashboard-sdm' => ['fas fa-users', 'Komposisi pegawai menurut status kerja dan pendidikan.'],
                    'dashboard-keuangan' => ['fas fa-coins', 'Realisasi pendapatan, belanja, dan saldo (menunggu sumber data).'],
                    'dashboard-pendukung' => ['fas fa-layer-group', 'Maturity rating BLU per dimensi.'],
                ])
                @foreach ($dash as $route => [$icon, $desc])
                    <a href="{{ route($route) }}" class="bios-tile">
                        <span class="bios-tile-icon"><i class="{{ $icon }}" aria-hidden="true"></i></span>
                        <h3>{{ config('bios_menu.dashboard.items.'.$route) }}</h3>
                        <p>{{ $desc }}</p>
                        <span class="bios-tile-foot">Buka <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                    </a>
                @endforeach
            </div>

            @can('admin')
                <h2 class="bios-section-title">Pengiriman data BIOS</h2>
                <div class="bios-grid bios-grid-4">
                    @php($desc = [
                        'keuangan' => 'Penerimaan, pengeluaran, dan saldo rekening.',
                        'sdm' => 'Jumlah tenaga medis dan non-medis per status kepegawaian.',
                        'layanan' => 'Pasien, kunjungan, penunjang, BOR, TOI, ALOS, BTO, IKM.',
                        'ikt' => 'Visite, kepatuhan, waktu tanggap, dan indikator mutu lain.',
                    ])
                    @foreach (['keuangan', 'sdm', 'layanan', 'ikt'] as $key)
                        @continue(!isset($groups[$key]))
                        <a href="{{ route(array_key_first($groups[$key]['items'])) }}" class="bios-tile teal">
                            <span class="bios-tile-icon"><i class="{{ $groups[$key]['icon'] }}" aria-hidden="true"></i></span>
                            <h3>{{ $groups[$key]['label'] }}</h3>
                            <p>{{ $desc[$key] }}</p>
                            <span class="bios-tile-foot">{{ count($groups[$key]['items']) }} formulir <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                        </a>
                    @endforeach
                </div>
            @endcan
        </div>
    </section>
</div>
@endsection
