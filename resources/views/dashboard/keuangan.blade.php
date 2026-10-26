@extends('layouts.main')
@section('content')
<div class="content-wrapper" id="main">
    @include('layouts.partials.page-header', ['title' => 'Dashboard Keuangan'])

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="bios-empty">
                    <span class="bios-empty-icon"><i class="fas fa-plug" aria-hidden="true"></i></span>
                    <div>
                        <h3>Belum terhubung ke sumber data keuangan</h3>
                        <p>Grafik di halaman ini sebelumnya berisi angka contoh (acak), bukan data RS. Agar tidak terbaca sebagai data sebenarnya, grafik disembunyikan sampai sumber datanya tersedia:</p>
                        <ul>
                            <li>Realisasi pendapatan dan belanja per bulan</li>
                            <li>Analisis data keuangan</li>
                            <li>Jumlah saldo kas</li>
                            <li>Jumlah saldo rekening BLU</li>
                        </ul>
                        @can('admin')
                            <p class="mt-3">Data keuangan harian tetap bisa dikirim ke BIOS melalui menu
                                <a href="{{ route('penerimaan') }}">Keuangan → Penerimaan</a> dan seterusnya.</p>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
