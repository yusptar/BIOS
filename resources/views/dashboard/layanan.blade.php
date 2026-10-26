@extends('layouts.main')
@section('content')
@php
    $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    $toSeries = function ($rows) {
        $s = array_fill(1, 12, 0);
        foreach ($rows as $r) {
            $s[(int) $r->month] = (int) $r->total;
        }
        return array_values($s);
    };
    $series = [
        'ralan' => ['label' => 'Rawat jalan', 'unit' => 'kunjungan', 'color' => '#14284b', 'data' => $toSeries($ralan)],
        'ranap' => ['label' => 'Rawat inap', 'unit' => 'pasien', 'color' => '#1f7a5c', 'data' => $toSeries($ranap)],
        'radiologi' => ['label' => 'Radiologi', 'unit' => 'pemeriksaan', 'color' => '#0b7f93', 'data' => $toSeries($radiologi)],
    ];
    $bulanIni = (int) now()->month;
    $tahun = now()->year;
    // Hasil survei IKM per triwulan (nilai sama dengan tampilan sebelumnya)
    $ikm = [
        ['Triwulan I', 85.03, 3.40],
        ['Triwulan II', 85.37, 3.41],
        ['Triwulan III', 85.49, 3.42],
        ['Triwulan IV', 86.74, 3.47],
    ];
@endphp
<div class="content-wrapper" id="main">
    @include('layouts.partials.page-header', ['title' => 'Dashboard Layanan', 'lead' => 'Jumlah pengguna layanan per bulan, tahun '.$tahun.'. Bulan berjalan ('.$bulan[$bulanIni - 1].') belum lengkap.'])

    <section class="content">
        <div class="container-fluid">
            <div class="bios-grid bios-grid-3">
                @foreach ($series as $key => $s)
                    @php
                        $ytd = array_sum($s['data']);
                        $last = $s['data'][$bulanIni - 1];
                        $prevFull = $bulanIni >= 2 ? $s['data'][$bulanIni - 2] : null;
                        $prevPrev = $bulanIni >= 3 ? $s['data'][$bulanIni - 3] : null;
                        $delta = ($prevFull !== null && $prevPrev) ? ($prevFull - $prevPrev) / $prevPrev * 100 : null;
                    @endphp
                    <div class="bios-kpi">
                        <p class="bios-kpi-label"><span class="dot" style="background: {{ $s['color'] }}"></span>{{ $s['label'] }} · {{ $tahun }}</p>
                        <p class="bios-kpi-value">{{ number_format($ytd, 0, ',', '.') }}<small>{{ $s['unit'] }}</small></p>
                        <p class="bios-kpi-sub">
                            @if ($prevFull !== null)
                                {{ $bulan[$bulanIni - 2] }}: <strong class="bios-num">{{ number_format($prevFull, 0, ',', '.') }}</strong>
                                @if ($delta !== null)
                                    <span class="bios-delta {{ $delta >= 0 ? 'up' : 'down' }}">{{ $delta >= 0 ? '▲' : '▼' }} {{ number_format(abs($delta), 1, ',', '.') }}%</span> dari {{ $bulan[$bulanIni - 3] }}
                                @endif
                            @else
                                Bulan berjalan: <strong class="bios-num">{{ number_format($last, 0, ',', '.') }}</strong>
                            @endif
                        </p>
                        <div class="bios-spark"><canvas id="spark-{{ $key }}" aria-label="Tren bulanan {{ $s['label'] }}" role="img"></canvas></div>
                    </div>
                @endforeach
            </div>

            <div class="card">
                <div class="card-header">
                    <div>
                        <h3 class="card-title">Pengguna layanan per bulan</h3>
                        <p class="text-muted mb-0" style="font-size:13px">Setiap layanan memakai skala sendiri agar tren rawat inap dan radiologi tetap terbaca di samping rawat jalan.</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="bios-grid bios-grid-3 mb-0">
                        @foreach ($series as $key => $s)
                            <div>
                                <p class="bios-kpi-label mb-2"><span class="dot" style="background: {{ $s['color'] }}"></span>{{ $s['label'] }}</p>
                                <div class="bios-chart sm"><canvas id="chart-{{ $key }}" aria-label="{{ $s['label'] }} per bulan" role="img"></canvas></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div>
                        <h3 class="card-title">Hasil survei kepuasan pengguna layanan (IKM)</h3>
                        <p class="text-muted mb-0" style="font-size:13px">Nilai konversi (skala 25–100) dan nilai indeks (skala 1–4) per triwulan.</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="bios-quarters">
                        @foreach ($ikm as [$tw, $konversi, $indeks])
                            <div class="bios-quarter">
                                <p>{{ $tw }}</p>
                                <strong>{{ number_format($konversi, 2, ',', '.') }}</strong>
                                <span>Indeks {{ number_format($indeks, 2, ',', '.') }}</span>
                            </div>
                        @endforeach
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
    var labels = @json($bulan);
    var series = @json($series);
    var current = {{ $bulanIni }};

    Object.keys(series).forEach(function (key) {
        var s = series[key];
        // Bulan setelah bulan berjalan tidak ditampilkan (bukan nol)
        var data = s.data.map(function (v, i) { return i < current ? v : null; });
        var colors = data.map(function (v, i) { return i === current - 1 ? s.color + '66' : s.color; });

        new Chart(document.getElementById('spark-' + key), {
            type: 'bar',
            data: { labels: labels.slice(0, current), datasets: [{ data: data.slice(0, current), backgroundColor: colors.slice(0, current), borderRadius: 2, barPercentage: .8, categoryPercentage: .9 }] },
            options: {
                plugins: { legend: { display: false }, tooltip: { callbacks: { label: function (c) { return BIOS.num(c.parsed.y) + ' ' + s.unit; } } } },
                scales: { x: { display: false }, y: { display: false, beginAtZero: true } }
            }
        });

        new Chart(document.getElementById('chart-' + key), {
            type: 'bar',
            data: { labels: labels, datasets: [{ label: s.label, data: data, backgroundColor: colors, borderRadius: 3, maxBarThickness: 22 }] },
            options: {
                plugins: { legend: { display: false }, tooltip: { callbacks: {
                    label: function (c) { return BIOS.num(c.parsed.y) + ' ' + s.unit + (c.dataIndex === current - 1 ? ' (bulan berjalan)' : ''); }
                } } },
                scales: {
                    x: { grid: { display: false }, ticks: { maxRotation: 0, autoSkip: true } },
                    y: { beginAtZero: true, ticks: { callback: function (v) { return BIOS.num(v); }, maxTicksLimit: 5 } }
                }
            }
        });
    });
})();
</script>
@endsection
