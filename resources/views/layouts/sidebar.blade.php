<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <div class="text-center">
            <img src="{{ asset('auth/images/logo-rs.png') }}" alt="" width="60%" height="60%">
        </div>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <!-- SidebarSearch Form -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               @can('admin')
                <li class="nav-header">DASHBOARD</li>
                <li class="nav-item {{ (request()->routeIs('dashboard-layanan', 'dashboard-keuangan', 'dashboard-sdm', 'dashboard-pendukung')) ? 'menu-open' : '' }}" >
                    <a href="#" class="nav-link {{ (request()->routeIs('dashboard-layanan', 'dashboard-keuangan', 'dashboard-sdm', 'dashboard-pendukung')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard-layanan') }}" class="nav-link {{ (request()->routeIs('dashboard-layanan')) ? 'active' : '' }}">
                                <p>Dashboard Layanan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard-keuangan') }}" class="nav-link {{ (request()->routeIs('dashboard-keuangan')) ? 'active' : '' }}">
                                <p>Dashboard Keuangan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard-sdm') }}" class="nav-link {{ (request()->routeIs('dashboard-sdm')) ? 'active' : '' }}">
                                <p>Dashboard SDM</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard-pendukung') }}" class="nav-link {{ (request()->routeIs('dashboard-pendukung')) ? 'active' : '' }}">
                                <p>Dashboard Pendukung</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">RUMPUN KESEHATAN</li>
                <li
                    class="nav-item {{ (request()->routeIs('penerimaan', 'pengeluaran', 'sldo-rkn-ops', 'sldo-rkn-kas', 'sldo-rkn-dana-kl')) ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ (request()->routeIs('penerimaan', 'pengeluaran', 'sldo-rkn-ops', 'sldo-rkn-kas', 'sldo-rkn-dana-kl')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>
                            Data Keuangan
                            <i class="fas fa-angle-left right"></i>
                            <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('penerimaan') }}"
                                class="nav-link {{ (request()->routeIs('penerimaan')) ? 'active' : '' }}">
                                <p>Penerimaan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pengeluaran') }}"
                                class="nav-link {{ (request()->routeIs('pengeluaran')) ? 'active' : '' }}">
                                <p>Pengeluaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sldo-rkn-ops') }}"
                                class="nav-link {{ (request()->routeIs('sldo-rkn-ops')) ? 'active' : '' }}">
                                <p>Saldo Rekening - Operasional</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sldo-rkn-kas') }}"
                                class="nav-link {{ (request()->routeIs('sldo-rkn-kas')) ? 'active' : '' }}">
                                <p>Saldo Rekening - Pengelolaan Kas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sldo-rkn-dana-kl') }}"
                                class="nav-link {{ (request()->routeIs('sldo-rkn-dana-kl')) ? 'active' : '' }}">
                                <p>Saldo Rekening - Dana Kelolaan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class="nav-item {{ (request()->routeIs('dktr-spesialis', 'dktr-gigi', 'dktr-umum', 'tng-perawat', 'tng-bidan', 'pran-lab', 'radiographer', 'nutrisionist', 'fisioterapis', 'pharmacist', 'tng-professional', 'tng-non-medis', 'tng-non-medis-adm', 'sanitarian')) ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ (request()->routeIs('dktr-spesialis', 'dktr-gigi', 'dktr-umum', 'tng-perawat', 'tng-bidan', 'pran-lab', 'radiographer', 'nutrisionist', 'fisioterapis', 'pharmacist', 'tng-professional', 'tng-non-medis', 'tng-non-medis-adm', 'sanitarian')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            Data SDM
                            <i class="fas fa-angle-left right"></i>
                            <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dktr-spesialis') }}"
                                class="nav-link {{ (request()->routeIs('dktr-spesialis')) ? 'active' : '' }}">
                                <p>Jumlah Dokter Spesialis</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dktr-gigi') }}"
                                class="nav-link {{ (request()->routeIs('dktr-gigi')) ? 'active' : '' }}">
                                <p>Jumlah Dokter Gigi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dktr-umum') }}"
                                class="nav-link {{ (request()->routeIs('dktr-umum')) ? 'active' : '' }}">
                                <p>Jumlah Dokter Umum</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tng-perawat') }}"
                                class="nav-link {{ (request()->routeIs('tng-perawat')) ? 'active' : '' }}">
                                <p>Jumlah Tenaga Perawat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tng-bidan') }}"
                                class="nav-link {{ (request()->routeIs('tng-bidan')) ? 'active' : '' }}">
                                <p>Jumlah Tenaga Bidan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pran-lab') }}"
                                class="nav-link {{ (request()->routeIs('pran-lab')) ? 'active' : '' }}">
                                <p>Jumlah Pranata Laboratorium</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('radiographer') }}"
                                class="nav-link {{ (request()->routeIs('radiographer')) ? 'active' : '' }}">
                                <p>Jumlah Radiographer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('nutrisionist') }}"
                                class="nav-link {{ (request()->routeIs('nutrisionist')) ? 'active' : '' }}">
                                <p>Jumlah Nutrisionist</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('fisioterapis') }}"
                                class="nav-link {{ (request()->routeIs('fisioterapis')) ? 'active' : '' }}">
                                <p>Jumlah Fisioterapis</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pharmacist') }}"
                                class="nav-link {{ (request()->routeIs('pharmacist')) ? 'active' : '' }}">
                                <p>Jumlah Pharmacist</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tng-professional') }}"
                                class="nav-link {{ (request()->routeIs('tng-professional')) ? 'active' : '' }}">
                                <p>Jumlah Tenaga Professional Lainnya</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tng-non-medis') }}"
                                class="nav-link {{ (request()->routeIs('tng-non-medis')) ? 'active' : '' }}">
                                <p>Jumlah Tenaga Non-Medis</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tng-non-medis-adm') }}"
                                class="nav-link {{ (request()->routeIs('tng-non-medis-adm')) ? 'active' : '' }}">
                                <p>Jumlah Tenaga Non-Medis Administrasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sanitarian') }}"
                                class="nav-link {{ (request()->routeIs('sanitarian')) ? 'active' : '' }}">
                                <p>Jumlah Sanitarian</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class="nav-item {{ (request()->routeIs('psn-rawat-inap', 'psn-rawat-darurat', 'lab-sampel', 'lab-parameter', 'tndkn-operasi', 'lyn-radiologi', 'lyn-forensik', 'kunj-rawat-jalan', 'psn-rawat-jalan', 'psn-bpjs-nonbpjs', 'lyn-farmasi', 'bor', 'toi', 'alos', 'bto', 'ikm')) ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ (request()->routeIs('psn-rawat-inap', 'psn-rawat-darurat', 'lab-sampel', 'lab-parameter', 'tndkn-operasi', 'lyn-radiologi', 'lyn-forensik', 'kunj-rawat-jalan', 'psn-rawat-jalan', 'psn-bpjs-nonbpjs', 'lyn-farmasi', 'bor', 'toi', 'alos', 'bto', 'ikm')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-poll-h"></i>
                        <p>
                            Data Layanan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('psn-rawat-jalan') }}"
                                class="nav-link {{ (request()->routeIs('psn-rawat-jalan')) ? 'active' : '' }}">
                                <p>Jumlah Pasien Rawat Jalan/Poli</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('psn-rawat-inap') }}"
                                class="nav-link {{ (request()->routeIs('psn-rawat-inap')) ? 'active' : '' }}">
                                <p>Jumlah Pasien Rawat Inap</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('psn-rawat-darurat') }}"
                                class="nav-link {{ (request()->routeIs('psn-rawat-darurat')) ? 'active' : '' }}">
                                <p>Jumlah Pasien Rawat Darurat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kunj-rawat-jalan') }}"
                                class="nav-link {{ (request()->routeIs('kunj-rawat-jalan')) ? 'active' : '' }}">
                                <p>Jumlah Kunjungan Rawat Jalan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('lab-sampel') }}"
                                class="nav-link {{ (request()->routeIs('lab-sampel')) ? 'active' : '' }}">
                                <p>Jumlah Layanan Laboratorium (sampel)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('lab-parameter') }}"
                                class="nav-link {{ (request()->routeIs('lab-parameter')) ? 'active' : '' }}">
                                <p>Jumlah Layanan Laboratorium (parameter)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tndkn-operasi') }}"
                                class="nav-link {{ (request()->routeIs('tndkn-operasi')) ? 'active' : '' }}">
                                <p>Jumlah Tindakan Operasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('lyn-radiologi') }}"
                                class="nav-link {{ (request()->routeIs('lyn-radiologi')) ? 'active' : '' }}">
                                <p>Jumlah Layanan Radiologi</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="{{ route('lyn-forensik') }}"
                                class="nav-link {{ (request()->routeIs('lyn-forensik')) ? 'active' : '' }}">
                                <p>Jumlah Layanan Forensik</p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="{{ route('psn-bpjs-nonbpjs') }}"
                                class="nav-link {{ (request()->routeIs('psn-bpjs-nonbpjs')) ? 'active' : '' }}">
                                <p>Jumlah Pasien BPJS / Non-BPJS</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('lyn-farmasi') }}"
                                class="nav-link {{ (request()->routeIs('lyn-farmasi')) ? 'active' : '' }}">
                                <p>Jumlah Layanan Farmasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('bor') }}"
                                class="nav-link {{ (request()->routeIs('bor')) ? 'active' : '' }}">
                                <p>BOR (Bed Occupancy Ratio)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('toi') }}"
                                class="nav-link {{ (request()->routeIs('toi')) ? 'active' : '' }}">
                                <p>TOI (Turn Over Interval)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('alos') }}"
                                class="nav-link {{ (request()->routeIs('alos')) ? 'active' : '' }}">
                                <p>ALOS (Average Length of Stay)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('bto') }}"
                                class="nav-link {{ (request()->routeIs('bto')) ? 'active' : '' }}">
                                <p>BTO (Bed Turn Over)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('ikm') }}"
                                class="nav-link {{ (request()->routeIs('ikm')) ? 'active' : '' }}">
                                <p>Indeks Kepuasan Masyarakat (IKM)</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class="nav-item {{ (request()->routeIs('vst-psn-10', 'vst-psn-10-12', 'vst-psn-12', 'dpjp-non-visite', 'kgtn-visite-psn', 'pobo', 'aset-blu', 'rkm-medis-elektronik', 'protokol-kesehatan', 'alat-kesehatan', 'kpuasan-psn', 'wkt-visite-dpjp', 'kebersihan-tangan', 'apd', 'identifikasi-pasien', 'seksio-emergensi', 'wkt-tunggu-rawat-jalan', 'ops-elektif', 'kepatuhan-wkt-visite-dokter', 'kritis-lab', 'form-nasional', 'alur-klinis', 'resiko-psn-jatuh', 'tanggap-komplain')) ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ (request()->routeIs('vst-psn-10', 'vst-psn-10-12', 'vst-psn-12', 'dpjp-non-visite', 'kgtn-visite-psn', 'pobo', 'aset-blu', 'rkm-medis-elektronik', 'protokol-kesehatan', 'alat-kesehatan', 'kpuasan-psn', 'wkt-visite-dpjp', 'kebersihan-tangan', 'apd', 'identifikasi-pasien', 'seksio-emergensi', 'wkt-tunggu-rawat-jalan', 'ops-elektif', 'kepatuhan-wkt-visite-dokter', 'kritis-lab', 'form-nasional', 'alur-klinis', 'resiko-psn-jatuh', 'tanggap-komplain')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-universal-access"></i>
                        <p>
                            (IKT) Indikator Kinerja Terpilih
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('vst-psn-10') }}"
                                class="nav-link {{ (request()->routeIs('vst-psn-10')) ? 'active' : '' }}">
                                <p>Jumlah Visite Pasien <= Jam 10.00</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('vst-psn-10-12') }}"
                                class="nav-link {{ (request()->routeIs('vst-psn-10-12')) ? 'active' : '' }}">
                                <p>Jumlah Visite Pasien > 10.00 s.d. 12.00</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('vst-psn-12') }}"
                                class="nav-link {{ (request()->routeIs('vst-psn-12')) ? 'active' : '' }}">
                                <p>Jumlah Visite Pasien > 12.00</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dpjp-non-visite') }}"
                                class="nav-link {{ (request()->routeIs('dpjp-non-visite')) ? 'active' : '' }}">
                                <p>Jumlah DPJP tidak visite</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kgtn-visite-psn') }}"
                                class="nav-link {{ (request()->routeIs('kgtn-visite-psn')) ? 'active' : '' }}">
                                <p>Jumlah Kegiatan Visite Pasien Pertama</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pobo') }}"
                                class="nav-link {{ (request()->routeIs('pobo')) ? 'active' : '' }}">
                                <p>Rasio POBO</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('aset-blu') }}"
                                class="nav-link {{ (request()->routeIs('aset-blu')) ? 'active' : '' }}">
                                <p>Pertumbuhan Realisasi Pendapatan dari Pengelolaan Aset BLU</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('rkm-medis-elektronik') }}"
                                class="nav-link {{ (request()->routeIs('rkm-medis-elektronik')) ? 'active' : '' }}">
                                <p>Penyelenggaran Rekam Medis Elektronik</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('protokol-kesehatan') }}"
                                class="nav-link {{ (request()->routeIs('protokol-kesehatan')) ? 'active' : '' }}">
                                <p>Kepatuhan Pelaksanaan Protokol Kesehatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('alat-kesehatan') }}"
                                class="nav-link {{ (request()->routeIs('alat-kesehatan')) ? 'active' : '' }}">
                                <p>Persentase Pembelian Alat Kesehatan Produksi Dalam Negeri</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kpuasan-psn') }}"
                                class="nav-link {{ (request()->routeIs('kpuasan-psn')) ? 'active' : '' }}">
                                <p>Kepuasan Pasien</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('wkt-visite-dpjp') }}"
                                class="nav-link {{ (request()->routeIs('wkt-visite-dpjp')) ? 'active' : '' }}">
                                <p>Kepatuhan Waktu Visite Dokter Penanggung Jawab Pelayanan/DPJP</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kebersihan-tangan') }}"
                                class="nav-link {{ (request()->routeIs('kebersihan-tangan')) ? 'active' : '' }}">
                                <p>Kepatuhan Kebersihan Tangan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('apd') }}"
                                class="nav-link {{ (request()->routeIs('apd')) ? 'active' : '' }}">
                                <p>Kepatuhan Penggunaan Alat Pelindung Diri (APD)
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('identifikasi-pasien') }}"
                                class="nav-link {{ (request()->routeIs('identifikasi-pasien')) ? 'active' : '' }}">
                                <p>Kepatuhan Identifikasi Pasien
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('seksio-emergensi') }}"
                                class="nav-link {{ (request()->routeIs('seksio-emergensi')) ? 'active' : '' }}">
                                <p>Waktu Tanggap Operasi Seksio Sesarea Emergensi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('wkt-tunggu-rawat-jalan') }}"
                                class="nav-link {{ (request()->routeIs('wkt-tunggu-rawat-jalan')) ? 'active' : '' }}">
                                <p>Waktu Tunggu Rawat Jalan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('ops-elektif') }}"
                                class="nav-link {{ (request()->routeIs('ops-elektif')) ? 'active' : '' }}">
                                <p>Penundaan Operasi Elektif
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kepatuhan-wkt-visite-dokter') }}"
                                class="nav-link {{ (request()->routeIs('kepatuhan-wkt-visite-dokter')) ? 'active' : '' }}">
                                <p>Kepatuhan Waktu Visite Dokter
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kritis-lab') }}"
                                class="nav-link {{ (request()->routeIs('kritis-lab')) ? 'active' : '' }}">
                                <p>Pelaporan Hasil Kritis Laboratorium
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('form-nasional') }}"
                                class="nav-link {{ (request()->routeIs('form-nasional')) ? 'active' : '' }}">
                                <p>Kepatuhan Penggunaan Formularium Nasional
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('alur-klinis') }}"
                                class="nav-link {{ (request()->routeIs('alur-klinis')) ? 'active' : '' }}">
                                <p>Kepatuhan Terhadap Alur Klinis (Clinical Pathway)
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('resiko-psn-jatuh') }}"
                                class="nav-link {{ (request()->routeIs('resiko-psn-jatuh')) ? 'active' : '' }}">
                                <p>Kepatuhan Upaya Pencegahan Resiko Pasien Jatuh
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tanggap-komplain') }}"
                                class="nav-link {{ (request()->routeIs('tanggap-komplain')) ? 'active' : '' }}">
                                <p>Kecepatan Waktu Tanggap Komplain
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">LAINNYA</li>
                <li class="nav-item {{ (request()->routeIs('users')) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->routeIs('users'))  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users') }}"
                                class="nav-link {{ (request()->routeIs('users')) ? 'active' : '' }}">
                                <p>Users</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('direktorat')
                <li class="nav-header">DASHBOARD</li>
                <li class="nav-item {{ (request()->routeIs('dashboard-layanan', 'dashboard-keuangan', 'dashboard-sdm', 'dashboard-pendukung')) ? 'menu-open' : '' }}" >
                    <a href="#" class="nav-link {{ (request()->routeIs('dashboard-layanan', 'dashboard-keuangan', 'dashboard-sdm', 'dashboard-pendukung')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard-layanan') }}" class="nav-link {{ (request()->routeIs('dashboard-layanan')) ? 'active' : '' }}">
                                <p>Dashboard Layanan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard-keuangan') }}" class="nav-link {{ (request()->routeIs('dashboard-keuangan')) ? 'active' : '' }}">
                                <p>Dashboard Keuangan</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="{{ route('dashboard-sdm') }}" class="nav-link {{ (request()->routeIs('dashboard-sdm')) ? 'active' : '' }}">
                                <p>Dashboard SDM</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard-pendukung') }}" class="nav-link {{ (request()->routeIs('dashboard-pendukung')) ? 'active' : '' }}">
                                <p>Dashboard Pendukung</p>
                            </a>
                        </li> -->
                    </ul>
                </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<script>
// Mendapatkan semua elemen nav-link
var navLinks = document.querySelectorAll('.nav-link');

// Menambahkan event listener untuk setiap nav-link
navLinks.forEach(function(link) {
    link.addEventListener('click', function() {
        // Menghapus kelas "active" dari semua nav-link
        navLinks.forEach(function(navLink) {
            navLink.classList.remove('active');
        });

        // Menandai nav-link yang sedang diklik sebagai "active"
        link.classList.add('active');
    });
});
</script>