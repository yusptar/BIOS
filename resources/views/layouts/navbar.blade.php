@php($biosPage = $biosPage ?? \App\Support\BiosMenu::current())
@php($biosUser = Auth::user())
@php($biosName = $biosUser->role === 'direktorat' ? 'Direktorat PPKBLU' : (optional($biosUser->pegawai)->nama ?? $biosUser->username))
<nav class="main-header navbar navbar-expand bios-topbar">
    <ul class="navbar-nav align-items-center">
        <li class="nav-item">
            <a class="nav-link bios-iconbtn" data-widget="pushmenu" href="#" role="button" aria-label="Buka/tutup menu">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item bios-crumb">
            @if ($biosPage['group_label'])
                <span class="bios-crumb-group">{{ $biosPage['group_short'] }}</span>
                <i class="fas fa-chevron-right" aria-hidden="true"></i>
                <span class="bios-crumb-page">{{ $biosPage['label'] }}</span>
            @else
                <span class="bios-crumb-page">Beranda</span>
            @endif
        </li>
    </ul>

    <ul class="navbar-nav ml-auto align-items-center">
        <li class="nav-item d-none d-md-block">
            <span class="bios-datechip" title="Tanggal yang dikirim pada setiap formulir (H-1)">
                <i class="far fa-calendar-alt" aria-hidden="true"></i>
                Tanggal transaksi <strong data-bios-txdate>—</strong>
            </span>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link bios-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="bios-avatar" aria-hidden="true">{{ mb_strtoupper(mb_substr(preg_replace('/^(dr|drg|Ns|apt)\.?\s+/i', '', $biosName), 0, 1)) }}</span>
                <span class="bios-user-text d-none d-sm-flex">
                    <strong>{{ $biosName }}</strong>
                    <small>{{ $biosUser->role === 'admin' ? 'Admin' : 'Direktorat PPKBLU' }}</small>
                </span>
                <i class="fas fa-chevron-down bios-user-caret" aria-hidden="true"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right bios-user-menu">
                <div class="bios-user-menu-head d-sm-none">
                    <strong>{{ $biosName }}</strong>
                    <small>{{ $biosUser->role === 'admin' ? 'Admin' : 'Direktorat PPKBLU' }}</small>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="fas fa-sign-out-alt mr-2" aria-hidden="true"></i> Keluar
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>
