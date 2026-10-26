@extends('layouts.main')
@section('content')
@php
    // Skor maturity rating BLU (skala 1–5), sama dengan tabel pada tampilan sebelumnya.
    $maturity = [
        'Keuangan' => 2.38,
        'Pelayanan' => 2.90,
        'Kapabilitas Internal' => 3.25,
        'Tata Kelola & Kepemimpinan' => 3.00,
        'Inovasi' => 2.75,
        'Lingkungan' => 2.50,
    ];
    // Tampilan lama mewarnai skor < 2,6 jingga (perlu perhatian), sisanya kuning.
    $batas = 2.6;
    $rata = array_sum($maturity) / count($maturity);
    $perhatian = array_keys(array_filter($maturity, fn ($v) => $v < $batas));
@endphp
<div class="content-wrapper" id="main">
    @include('layouts.partials.page-header', ['title' => 'Dashboard Pendukung', 'lead' => 'Maturity rating BLU per dimensi, skala 1–5.'])

    <section class="content">
        <div class="container-fluid">
            <div class="bios-grid bios-grid-4">
                <div class="bios-kpi">
                    <p class="bios-kpi-label">Rata-rata skor</p>
                    <p class="bios-kpi-value">{{ number_format($rata, 2, ',', '.') }}<small>/ 5</small></p>
                    <p class="bios-kpi-sub">Dari {{ count($maturity) }} dimensi</p>
                </div>
                <div class="bios-kpi">
                    <p class="bios-kpi-label">Skor tertinggi</p>
                    <p class="bios-kpi-value">{{ number_format(max($maturity), 2, ',', '.') }}</p>
                    <p class="bios-kpi-sub">{{ array_search(max($maturity), $maturity) }}</p>
                </div>
                <div class="bios-kpi">
                    <p class="bios-kpi-label">Skor terendah</p>
                    <p class="bios-kpi-value">{{ number_format(min($maturity), 2, ',', '.') }}</p>
                    <p class="bios-kpi-sub">{{ array_search(min($maturity), $maturity) }}</p>
                </div>
                <div class="bios-kpi">
                    <p class="bios-kpi-label">Perlu perhatian</p>
                    <p class="bios-kpi-value">{{ count($perhatian) }}<small>dimensi</small></p>
                    <p class="bios-kpi-sub">Skor di bawah {{ number_format($batas, 1, ',', '.') }}</p>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h3 class="card-title">Maturity rating</h3></div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="bios-chart lg"><canvas id="maturityChart" role="img" aria-label="Grafik radar maturity rating per dimensi"></canvas></div>
                        </div>
                        <div class="col-lg-6">
                            <ul class="bios-score-list">
                                @foreach ($maturity as $nama => $skor)
                                    <li>
                                        <div class="bios-score-row">
                                            <span>{{ $nama }}
                                                @if ($skor < $batas)
                                                    <em class="bios-status warn">Perlu perhatian</em>
                                                @endif
                                            </span>
                                            <strong>{{ number_format($skor, 2, ',', '.') }} <small>/ 5</small></strong>
                                        </div>
                                        <div class="bios-score-track"><i class="{{ $skor < $batas ? 'warn' : '' }}" style="width: {{ $skor / 5 * 100 }}%"></i></div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="{{ asset('bios/vendor/chart.umd.min.js') }}"></script>
@endpush

@section('script')
<script>
(function () {
    BIOS.chartDefaults();
    var data = @json($maturity);
    new Chart(document.getElementById('maturityChart'), {
        type: 'radar',
        data: {
            labels: Object.keys(data),
            datasets: [{
                label: 'Skor',
                data: Object.values(data),
                borderColor: '#14284b',
                backgroundColor: 'rgba(43, 74, 126, .15)',
                pointBackgroundColor: Object.values(data).map(function (v) { return v < {{ $batas }} ? '#a8691a' : '#14284b'; }),
                pointRadius: 4,
                borderWidth: 2
            }]
        },
        options: {
            plugins: { legend: { display: false }, tooltip: { callbacks: { label: function (c) { return 'Skor ' + BIOS.num(c.parsed.r, 2) + ' / 5'; } } } },
            scales: { r: { min: 0, max: 5, ticks: { stepSize: 1, backdropColor: 'transparent' }, pointLabels: { font: { size: 12, weight: '600' }, color: '#1e2633' } } }
        }
    });
})();
</script>
@endsection
