@extends('layouts.app')

@section('content')
@php($lockSeconds = (int) session('seconds', 0))
<main class="bios-auth-wrap">
    <section class="bios-auth-brand" aria-hidden="true">
        <div class="bios-auth-logos">
            <img src="{{ asset('auth/images/logo-rs.png') }}" alt="" width="64" height="64">
            <img src="{{ asset('img/logo-blu.png') }}" alt="" width="64" height="64">
        </div>
        <div>
            <p class="bios-auth-kicker">BIOS Web Service</p>
            <h1>Pengiriman data BLU<br>RS Tk. II dr. Soepraoen</h1>
            <p class="bios-auth-desc">Data keuangan, SDM, layanan, dan indikator kinerja rumah sakit dikirim ke BIOS Direktorat PPK BLU dari satu tempat.</p>
        </div>
        <ul class="bios-auth-points">
            <li><i class="fas fa-wallet"></i> Keuangan</li>
            <li><i class="fas fa-user-md"></i> SDM</li>
            <li><i class="fas fa-procedures"></i> Layanan</li>
            <li><i class="fas fa-bullseye"></i> IKT</li>
        </ul>
    </section>

    <section class="bios-auth-panel">
        <div class="bios-auth-card">
            <div class="bios-auth-mobile-brand">
                <img src="{{ asset('auth/images/logo-rs.png') }}" alt="" width="44" height="44">
                <div><strong>BIOS</strong><small>RS Tk. II dr. Soepraoen</small></div>
            </div>
            <h2>Masuk</h2>
            <p class="bios-auth-sub">Gunakan NIP/NRP dan password akun BIOS Anda.</p>

            @if (session('error'))
                <div class="bios-alert danger" role="alert" id="error-message">
                    <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                    <span>
                        @if ($lockSeconds > 0)
                            Terlalu banyak percobaan gagal. Coba lagi dalam <strong data-countdown="{{ $lockSeconds }}">{{ $lockSeconds }}</strong> detik.
                        @else
                            {{ session('error') }}
                        @endif
                    </span>
                </div>
            @endif
            @if (session('token_error'))
                <div class="bios-alert warn" role="alert">
                    <i class="fas fa-exclamation-triangle" aria-hidden="true"></i>
                    <span>{{ session('token_error') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="login-form" novalidate>
                @csrf
                <div class="form-group">
                    <label for="username">NIP/NRP</label>
                    <div class="bios-input-icon">
                        <i class="fas fa-id-badge" aria-hidden="true"></i>
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                            name="username" value="{{ old('username') }}" required autofocus autocomplete="username"
                            placeholder="Masukkan NIP/NRP">
                    </div>
                    @error('username')
                        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="bios-input-icon">
                        <i class="fas fa-lock" aria-hidden="true"></i>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password" placeholder="Masukkan password">
                        <button type="button" class="bios-eye" aria-label="Tampilkan password" aria-pressed="false" data-toggle-password>
                            <i class="far fa-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-block bios-auth-submit" id="login-button">
                    Masuk
                </button>
            </form>
            <p class="bios-auth-help">Lupa password? Hubungi admin BIOS / tim IT rumah sakit.</p>
        </div>
        <p class="bios-auth-foot">&copy; {{ date('Y') }} IT RS Tk. II dr. Soepraoen</p>
    </section>
</main>
@endsection

@push('scripts')
<script>
(function () {
    var form = document.getElementById('login-form');
    var btn = document.getElementById('login-button');
    var pw = document.getElementById('password');

    document.querySelector('[data-toggle-password]').addEventListener('click', function () {
        var show = pw.type === 'password';
        pw.type = show ? 'text' : 'password';
        this.setAttribute('aria-pressed', show);
        this.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
        this.firstElementChild.className = show ? 'far fa-eye-slash' : 'far fa-eye';
    });

    form.addEventListener('submit', function (e) {
        if (!form.checkValidity()) { e.preventDefault(); form.reportValidity(); return; }
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm mr-2" aria-hidden="true"></span>Memeriksa…';
    });

    // Terkunci karena terlalu banyak percobaan: hitung mundur lalu buka kembali
    var cd = document.querySelector('[data-countdown]');
    if (cd) {
        var left = parseInt(cd.getAttribute('data-countdown'), 10);
        var fields = form.querySelectorAll('input, button');
        fields.forEach(function (el) { el.disabled = true; });
        var t = setInterval(function () {
            left -= 1;
            cd.textContent = Math.max(left, 0);
            if (left <= 0) {
                clearInterval(t);
                fields.forEach(function (el) { el.disabled = false; });
                document.getElementById('error-message').remove();
            }
        }, 1000);
    }
})();
</script>
@endpush
