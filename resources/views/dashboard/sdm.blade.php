@extends('layouts.main')
@section('content')
@php
    $toRows = function ($labels, $data) {
        $rows = [];
        foreach ($labels as $i => $label) {
            $rows[] = ['label' => ($label === null || $label === '' || $label === '-') ? 'Tidak diisi' : $label, 'total' => (int) ($data[$i] ?? 0)];
        }
        usort($rows, fn ($a, $b) => $b['total'] <=> $a['total']);
        return $rows;
    };
    $status = $toRows($labels1, $data1);
    $pendidikan = $toRows($labels2, $data2);
    $total = array_sum(array_column($status, 'total'));
    $maxStatus = max(array_column($status, 'total') ?: [1]);
    $maxPend = max(array_column($pendidikan, 'total') ?: [1]);
@endphp
<div class="content-wrapper" id="main">
    @include('layouts.partials.page-header', ['title' => 'Dashboard SDM', 'lead' => 'Data pegawai dari SIMRS, dikelompokkan menurut status kerja dan pendidikan terakhir.'])

    <section class="content">
        <div class="container-fluid">
            <div class="bios-grid bios-grid-4">
                <div class="bios-kpi">
                    <p class="bios-kpi-label">Total pegawai</p>
                    <p class="bios-kpi-value">{{ number_format($total, 0, ',', '.') }}</p>
                    <p class="bios-kpi-sub">Tercatat di SIMRS</p>
                </div>
                @foreach (array_slice($status, 0, 3) as $row)
                    <div class="bios-kpi">
                        <p class="bios-kpi-label">{{ $row['label'] }}</p>
                        <p class="bios-kpi-value">{{ number_format($row['total'], 0, ',', '.') }}</p>
                        <p class="bios-kpi-sub">{{ $total ? number_format($row['total'] / $total * 100, 1, ',', '.') : 0 }}% dari total pegawai</p>
                    </div>
                @endforeach
            </div>

            <div class="bios-grid bios-grid-2">
                <div class="card mb-0">
                    <div class="card-header"><h3 class="card-title">Komposisi menurut status kerja</h3></div>
                    <div class="card-body">
                        <ul class="bios-bars">
                            @forelse ($status as $row)
                                <li>
                                    <span class="name" title="{{ $row['label'] }}">{{ $row['label'] }}</span>
                                    <span class="track"><span class="fill" style="width: {{ $row['total'] / $maxStatus * 100 }}%"></span></span>
                                    <span class="val">{{ number_format($row['total'], 0, ',', '.') }}<small>{{ $total ? number_format($row['total'] / $total * 100, 1, ',', '.') : 0 }}%</small></span>
                                </li>
                            @empty
                                <li class="text-muted">Belum ada data pegawai.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="card mb-0">
                    <div class="card-header"><h3 class="card-title">Profil menurut pendidikan</h3></div>
                    <div class="card-body">
                        <ul class="bios-bars">
                            @forelse ($pendidikan as $row)
                                <li>
                                    <span class="name" title="{{ $row['label'] }}">{{ $row['label'] }}</span>
                                    <span class="track"><span class="fill" style="width: {{ $row['total'] / $maxPend * 100 }}%; background: #0b7f93"></span></span>
                                    <span class="val">{{ number_format($row['total'], 0, ',', '.') }}<small>{{ $total ? number_format($row['total'] / $total * 100, 1, ',', '.') : 0 }}%</small></span>
                                </li>
                            @empty
                                <li class="text-muted">Belum ada data pegawai.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="bios-empty">
                    <span class="bios-empty-icon"><i class="fas fa-hourglass-half" aria-hidden="true"></i></span>
                    <div>
                        <h3>Analisis lanjutan belum terhubung ke sumber data</h3>
                        <p>Panel berikut belum memiliki data di sistem, sehingga tidak ditampilkan sebagai grafik:</p>
                        <ul>
                            <li>Analisis kebutuhan pegawai</li>
                            <li>Analisis beban kerja</li>
                            <li>Analisis kinerja pegawai</li>
                            <li>Training need analysis</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
