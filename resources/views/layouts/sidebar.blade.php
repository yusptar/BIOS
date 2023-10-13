<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <div class="text-center">
            <img src="{{ asset('auth/images/logo-nagara.png') }}" alt="" width="60%" height="60%">
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
                <!-- <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.html" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index2.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index3.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v3</p>
                            </a>
                        </li>
                    </ul>
                </li> -->
                <!-- <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Widgets
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li> -->
                <li class="nav-header">RUMPUN KESEHATAN</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Data SDM
                            <i class="fas fa-angle-left right"></i>
                            <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dktr-spesialis') }}" class="nav-link">
                                <p>Jumlah Dokter Spesialis</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dktr-gigi') }}" class="nav-link">
                                <p>Jumlah Dokter Gigi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dktr-umum') }}" class="nav-link">
                                <p>Jumlah Dokter Umum</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tng-perawat') }}" class="nav-link">
                                <p>Jumlah Tenaga Perawat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tng-bidan') }}" class="nav-link">
                                <p>Jumlah Tenaga Bidan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pran-lab') }}" class="nav-link">
                                <p>Jumlah Pranata Laboratorium</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('radiographer') }}" class="nav-link">
                                <p>Jumlah Radiographer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('nutrisionist') }}" class="nav-link">
                                <p>Jumlah Nutrisionist</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('fisioterapis') }}" class="nav-link">
                                <p>Jumlah Fisioterapis</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pharmacist') }}" class="nav-link">
                                <p>Jumlah Pharmacist</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tng-professional') }}" class="nav-link">
                                <p>Jumlah Tenaga Professional Lainnya</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tng-non-medis') }}" class="nav-link">
                                <p>Jumlah Tenaga Non-Medis</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tng-non-medis-adm') }}" class="nav-link">
                                <p>Jumlah Tenaga Non-Medis Administrasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sanitarian') }}" class="nav-link">
                                <p>Jumlah Sanitarian</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Data Layanan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('psn-rawat-inap') }}" class="nav-link">
                                <p>Jumlah Pasien Rawat Inap</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('psn-rawat-darurat') }}" class="nav-link">
                                <p>Jumlah Pasien Rawat Darurat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('lab-sampel') }}" class="nav-link">
                                <p>Jumlah Layanan Laboratorium (sampel)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('lab-parameter') }}" class="nav-link">
                                <p>Jumlah Layanan Laboratorium (parameter)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tndkn-operasi') }}" class="nav-link">
                                <p>Jumlah Tindakan Operasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('lyn-radiologi') }}" class="nav-link">
                                <p>Jumlah Layanan Radiologi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('lyn-forensik') }}" class="nav-link">
                                <p>Jumlah Layanan Forensik</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kunj-rawat-jalan') }}" class="nav-link">
                                <p>Jumlah Kunjungan Rawat Jalan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('psn-rawat-jalan') }}" class="nav-link">
                                <p>Jumlah Pasien Rawat Jalan/Poli</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('psn-bpjs-nonbpjs') }}" class="nav-link">
                                <p>Jumlah Pasien BPJS / Non-BPJS</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('lyn-farmasi') }}" class="nav-link">
                                <p>Jumlah Layanan Farmasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('bor') }}" class="nav-link">
                                <p>BOR (Bed Occupancy Ratio)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('toi') }}" class="nav-link">
                                <p>TOI (Turn Over Interval)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('alos') }}" class="nav-link">
                                <p>ALOS (Average Length of Stay)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('bto') }}" class="nav-link">
                                <p>BTO (Bed Turn Over)</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="{{ route('kjd-pasien-jatuh') }}" class="nav-link">
                                <p>Prosentase Kejadian Pasien Jatuh (Khusus Balai Besar Kesehatan Paru)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dokpol') }}" class="nav-link">
                                <p>Jumlah Pelayanan Dokpol (Khusus RS Bhayangkara)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('lyn-sertifikat') }}" class="nav-link">
                                <p>Jumlah Sertifikat (Khusus Balai Kesehatan Perhubungan)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kalibrasi') }}" class="nav-link">
                                <p>Jumlah Barang yang dikalibrasi (Khusus Balai Kesehatan Perhubungan)</p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="{{ route('ikm') }}" class="nav-link">
                                <p>Indeks Kepuasan Masyarakat (IKM)</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            (IKT) Indikator Kinerja Terpilih
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('vst-psn-10') }}" class="nav-link">
                                <p>Jumlah Visite Pasien <= Jam 10.00</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('vst-psn-10=12') }}" class="nav-link">
                                <p>Jumlah Visite Pasien > 10.00 s.d. 12.00</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('vst-psn-12') }}" class="nav-link">
                                <p>Jumlah Visite Pasien > 12.00</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dpjp-non-visite') }}" class="nav-link">
                                <p>Jumlah DPJP tidak visite</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kgtn-visite-psn') }}" class="nav-link">
                                <p>Jumlah Kegiatan Visite Pasien Pertama</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pobo') }}" class="nav-link">
                                <p>Rasio POBO</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('aset-blu') }}" class="nav-link">
                                <p>Pertumbuhan Realisasi Pendapatan dari Pengelolaan Aset BLU</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('rkm-medis-elektronik') }}" class="nav-link">
                                <p>Penyelenggaran Rekam Medis Elektronik</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('protokol-kesehatan') }}" class="nav-link">
                                <p>Kepatuhan Pelaksanaan Protokol Kesehatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('alat-kesehatan') }}" class="nav-link">
                                <p>Persentase Pembelian Alat Kesehatan Produksi Dalam Negeri</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kpuasan-psn') }}" class="nav-link">
                                <p>Kepuasan Pasien</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('wkt-visite-dpjp') }}" class="nav-link">
                                <p>Kepatuhan Waktu Visite Dokter Penanggung Jawab Pelayanan/DPJP</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="{{ route('bblsr-1500') }}" class="nav-link">
                                <p>Kemampuan Menangani BBLSR < 1500g (Khusus RS Anak dan Ibu)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cabg-tof') }}" class="nav-link">
                                <p>Keberhasilan Tindakan Bedah Jantung Coronary Arterial Bypass (CABG) dan Tetralogy of
                                    Fallot Repair (ToF Repair) (Khusus RS Jantung)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kes-jiw-who') }}" class="nav-link">
                                <p>Penyelenggaraan Layanan Kesehatan Jiwa berbasis Safewards dan WHO - Quality Right
                                    (WHO - QR) (Khusus RS Jiwa)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('napza-who') }}" class="nav-link">
                                <p>Penyelenggaraan Layanan Napza berbasis Safewards dan WHO-Quality Right (Khusus RS
                                    Ketergantungan Obat)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('napza-who') }}" class="nav-link">
                                <p>Penyelenggaraan Layanan Napza berbasis Safewards dan WHO-Quality Right (Khusus RS
                                    Ketergantungan Obat)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tb-mdr-rs') }}" class="nav-link">
                                <p>Proporsi Pasien TB MDR diobati diantara Pasien TB MDR ditemukan (Enrollment Rate)
                                    (Khusus RS Paru)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('biometri-katarak') }}" class="nav-link">
                                <p>Presentase Pengulangan Pemeriksaan Biometri Pada Pasien Katarak (Khusus RS Mata
                                    Makassar)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('bedah-ortho') }}" class="nav-link">
                                <p>Persentase Kasus Infeksi Luka Operasi (ILO) Bedah Ortho (Khusus RS Orthopedi)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('door-to-needle') }}" class="nav-link">
                                <p>Door To Needle (Khusus RS Otak)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('ops-ca-mammae') }}" class="nav-link">
                                <p>Masa Tunggu Operasi Ca Mammae (Kanker Payudara) (Khusus RS Kanker)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('rehab-medik') }}" class="nav-link">
                                <p>Pelayanan Rehab Medik Respiratori Pasca Infeksi Berat (Khusus RS Penyakit Infeksi)
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('program-kesehatan-paru') }}" class="nav-link">
                                <p>Terlaksananya Program Kesehatan Paru Terintegrasi (Prioritas TBC) Lintas Sektor dan
                                    Program Wilayah Binaan (Khusus BBKPM)
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('prosentase-tersusun') }}" class="nav-link">
                                <p>Prosentase Tersusun dan Terimplementasinya Program Pembinaan Kesehatan Paru
                                    Terintegrasi (Prioritas TBC) di wilayah kerja BBKPM (Khusus BBKPM)
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tb-mdr-bbkpm') }}" class="nav-link">
                                <p>Proporsi Pasien TB MDR diobati diantara pasien TB MDR ditemukan (Enrollment Rate)
                                    (Khusus BBKPM)
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('plyn-lab-covid19') }}" class="nav-link">
                                <p>Waktu Pelayanan Pemeriksaan Laboratorium Covid-19 (Khusus BBLK)
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('penyelengaraan-pme') }}" class="nav-link">
                                <p>Tingkat Kepesertaan Penyelenggaraan PME (TKPP) (Khusus BBLK)
                                </p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="{{ route('kebersihan-tangan') }}" class="nav-link">
                                <p>Kepatuhan Kebersihan Tangan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('apd') }}" class="nav-link">
                                <p>Kepatuhan Penggunaan Alat Pelindung Diri (APD)
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('identifikasi-pasien') }}" class="nav-link">
                                <p>Kepatuhan Identifikasi Pasien
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('seksio-emergensi') }}" class="nav-link">
                                <p>Waktu Tanggap Operasi Seksio Sesarea Emergensi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('wkt-tunggu-rawat-jalan') }}" class="nav-link">
                                <p>Waktu Tunggu Rawat Jalan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('ops-elektif') }}" class="nav-link">
                                <p>Penundaan Operasi Elektif
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kepatuhan-wkt-visite-dokter') }}" class="nav-link">
                                <p>Kepatuhan Waktu Visite Dokter
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kritis-lab') }}" class="nav-link">
                                <p>Pelaporan Hasil Kritis Laboratorium
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('form-nasional') }}" class="nav-link">
                                <p>Kepatuhan Penggunaan Formularium Nasional
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('alur-klinis') }}" class="nav-link">
                                <p>Kepatuhan Terhadap Alur Klinis (Clinical Pathway)
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('resiko-psn-jatuh') }}" class="nav-link">
                                <p>Kepatuhan Upaya Pencegahan Resiko Pasien Jatuh
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tanggap-komplain') }}" class="nav-link">
                                <p>Kecepatan Waktu Tanggap Komplain
                                </p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="{{ route('mcu-pelaut') }}" class="nav-link">
                                <p>Indikator Pelayanan Medical Check Up Pelaut (Khusus Balai Kesehatan Perhubungan)
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kesling-pelayaran') }}" class="nav-link">
                                <p>Indikator Pelayanan Penilikan Kesehatan Lingkungan Kerja Pelayaran (Khusus Balai
                                    Kesehatan Perhubungan)
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kesehatan-pelaut') }}" class="nav-link">
                                <p>Indikator Penyediaan Dokumen Kesehatan Pelaut (Khusus Balai Kesehatan Perhubungan)
                                </p>
                            </a>
                        </li> -->
                    </ul>
                </li>
                <li class="nav-header">LOG OUT</li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" class="nav-link">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Log Out</p>
                    </a>
                </li>
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