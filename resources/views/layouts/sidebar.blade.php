@php($biosGroups = \App\Support\BiosMenu::groups())
<aside class="main-sidebar bios-sidebar" aria-label="Menu utama">
    <a href="{{ route('dashboard') }}" class="brand-link bios-brand">
        <img src="{{ asset('auth/images/logo-rs.png') }}" alt="" class="bios-brand-logo" width="36" height="36">
        <span class="brand-text">
            <strong>BIOS</strong>
            <small>RS Tk. II dr. Soepraoen</small>
        </span>
    </a>

    <div class="sidebar">
        <div class="bios-menu-search">
            <i class="fas fa-search" aria-hidden="true"></i>
            <input type="search" id="bios-menu-filter" placeholder="Cari menu…" aria-label="Cari menu" autocomplete="off">
        </div>

        <nav>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Beranda</p>
                    </a>
                </li>

                @foreach ($biosGroups as $key => $group)
                    @if ($key === 'dashboard')
                        <li class="nav-header">Dashboard</li>
                        @foreach ($group['items'] as $route => $label)
                            <li class="nav-item" data-menu-item>
                                <a href="{{ route($route) }}" class="nav-link {{ request()->routeIs($route) ? 'active' : '' }}">
                                    <i class="nav-icon {{ ['dashboard-layanan' => 'fas fa-stethoscope', 'dashboard-keuangan' => 'fas fa-coins', 'dashboard-sdm' => 'fas fa-users', 'dashboard-pendukung' => 'fas fa-layer-group'][$route] ?? 'fas fa-chart-pie' }}"></i>
                                    <p>{{ trim(str_replace('Dashboard', '', $label)) }}</p>
                                </a>
                            </li>
                        @endforeach
                    @else
                        @if ($loop->index === 1 || ($key === 'pengaturan'))
                            <li class="nav-header">{{ $key === 'pengaturan' ? 'Lainnya' : 'Pengiriman data BIOS' }}</li>
                        @endif
                        @php($open = request()->routeIs(...array_keys($group['items'])))
                        @if (count($group['items']) === 1)
                            @php($only = array_key_first($group['items']))
                            <li class="nav-item" data-menu-item>
                                <a href="{{ route($only) }}" class="nav-link {{ $open ? 'active' : '' }}">
                                    <i class="nav-icon {{ $group['icon'] }}"></i>
                                    <p>{{ $group['items'][$only] }}</p>
                                </a>
                            </li>
                            @continue
                        @endif
                        <li class="nav-item {{ $open ? 'menu-open' : '' }}" data-menu-group>
                            <a href="#" class="nav-link {{ $open ? 'active' : '' }}">
                                <i class="nav-icon {{ $group['icon'] }}"></i>
                                <p>
                                    {{ $group['short'] }}
                                    <span class="bios-count">{{ count($group['items']) }}</span>
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @foreach ($group['items'] as $route => $label)
                                    <li class="nav-item" data-menu-item>
                                        <a href="{{ route($route) }}" class="nav-link {{ request()->routeIs($route) ? 'active' : '' }}">
                                            <p>{{ $label }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
            <p class="bios-menu-empty" hidden>Menu tidak ditemukan.</p>
        </nav>
    </div>
</aside>
