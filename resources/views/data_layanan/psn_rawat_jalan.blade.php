@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="font-weight:bold">Jumlah Pasien Rawat Jalan/Poli</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:600">Input Form</h3>
                </div>
                <form id="form-dokter-spesialis">
                    @csrf
                    <div class="card-body">
                        <input type="text" class="form-control" name="tgl_transaksi" id="tgl_transaksi" hidden>
                        <input type="hidden" name="_token" value="Wm0qbXXO6oIkYEbFWl4as7auxZdxYa06" />
                        <div class="form-group">
                            <label>Nama Poli</label>
                            <select class="form-control" name="nama_poli">
                                <option disabled selected>-- Pilih Nama Poli --</option>
                                <option value="REUMATOLOGI">003 - REUMATOLOGI</option>
                                <option value="ALERGI-IMMUNOLOGI KLINIK">004 - ALERGI-IMMUNOLOGI KLINIK</option>
                                <option value="GASTROENTROLOGI">005 - GASTROENTROLOGI</option>
                                <option value="GERIATRI">006 - GERIATRI</option>
                                <option value="GINJAL-HIPERTENSI">007 - GINJAL-HIPERTENSI</option>
                                <option value="HEMATOLOGI-ONKOLOGI MEDIK">008 - HEMATOLOGI-ONKOLOGI MEDIK</option>
                                <option value="HEPATOLOGI">009 - HEPATOLOGI</option>
                                <option value="ENDOKRIN-METABOLIK-DIABETES">010 - ENDOKRIN-METABOLIK-DIABETES</option>
                                <option value="PSIKOSOMATIK">011 - PSIKOSOMATIK</option>
                                <option value="PULMONOLOGI">012 - PULMONOLOGI</option>
                                <option value="PENYAKIT TROPIK-INFEKSI">014 - PENYAKIT TROPIK-INFEKSI</option>
                                <option value="KARDIOVASKULAR">015 - KARDIOVASKULAR</option>
                                <option value="BEDAH ONKOLOGI">017 - BEDAH ONKOLOGI</option>
                                <option value="BEDAH DIGESTIF">018 - BEDAH DIGESTIF</option>
                                <option value="FETOMATERNAL">020 - FETOMATERNAL</option>
                                <option value="ONKOLOGI GINEKOLOGI">021 - ONKOLOGI GINEKOLOGI</option>
                                <option value="UROGINEKOLOGI REKONTRUKSI">022 - UROGINEKOLOGI REKONTRUKSI</option>
                                <option value="OBSTETRI GINEKOLOGI SOSIAL">023 - OBSTETRI GINEKOLOGI SOSIAL</option>
                                <option value="ENDOKRINOLOGI">024 - ENDOKRINOLOGI</option>
                                <option value="FERTILITAS">025 - FERTILITAS</option>
                                <option value="ANAK ALERGI IMUNOLOGI">027 - ANAK ALERGI IMUNOLOGI</option>
                                <option value="ANAK ENDOKRINOLOGI">028 - ANAK ENDOKRINOLOGI</option>
                                <option value="ANAK GASTRO-HEPATOLOGI">029 - ANAK GASTRO-HEPATOLOGI</option>
                                <option value="ANAK HEMATOLOGI ONKOLOGI">030 - ANAK HEMATOLOGI ONKOLOGI</option>
                                <option value="ANAK INFEKSI & PEDIATRI TROPIS">031 - ANAK INFEKSI & PEDIATRI TROPIS
                                </option>
                                <option value="ANAK KARDIOLOGI">032 - ANAK KARDIOLOGI</option>
                                <option value="ANAK NEFROLOGI">033 - ANAK NEFROLOGI</option>
                                <option value="ANAK NEUROLOGI">034 - ANAK NEUROLOGI</option>
                                <option value="PEDIATRI GAWAT DARURAT">036 - PEDIATRI GAWAT DARURAT</option>
                                <option value="PENCITRAAN ANAK">037 - PENCITRAAN ANAK</option>
                                <option value="PERINATOLOGI">038 - PERINATOLOGI</option>
                                <option value="RESPIROLOGI ANAK">039 - RESPIROLOGI ANAK</option>
                                <option value="TUMBUH KEMBANG PED.SOSIAL">040 - TUMBUH KEMBANG PED.SOSIAL</option>
                                <option value="KESEHATAN REMAJA">041 - KESEHATAN REMAJA</option>
                                <option value="INTENSIVE CARE/ICU">043 - INTENSIVE CARE/ICU</option>
                                <option value="ANESTESI KARDIOVASKULAR">044 - ANESTESI KARDIOVASKULAR</option>
                                <option value="MANAJEMEN NYERI">045 - MANAJEMEN NYERI</option>
                                <option value="NEUROANESTESI">047 - NEUROANESTESI</option>
                                <option value="ANESTESI PEDIATRI">048 - ANESTESI PEDIATRI</option>
                                <option value="ANESTESI OBSTETRI">049 - ANESTESI OBSTETRI</option>
                                <option value="OTOLOGI">067 - OTOLOGI</option>
                                <option value="NEUROLOGI">068 - NEUROLOGI</option>
                                <option value="RINOLOGI">069 - RINOLOGI</option>
                                <option value="LARINGO-FARINGOLOGI">070 - LARINGO-FARINGOLOGI</option>
                                <option value="ONKOLOGI KEPALA LEHER">071 - ONKOLOGI KEPALA LEHER</option>
                                <option value="PLASTIK REKONSTRUKSI">072 - PLASTIK REKONSTRUKSI</option>
                                <option value="BRONKOESOFAGOLOGI">073 - BRONKOESOFAGOLOGI</option>
                                <option value="ALERGI IMUNOLOGI">074 - ALERGI IMUNOLOGI</option>
                                <option value="THT KOMUNITAS">075 - THT KOMUNITAS</option>
                                <option value="NEUROTRAUMA">078 - NEUROTRAUMA</option>
                                <option value="NEUROINFEKSI">079 - NEUROINFEKSI</option>
                                <option value="NEUROINFEKSI DAN IMUNOLOGI">080 - NEUROINFEKSI DAN IMUNOLOGI</option>
                                <option value="EPILEPSI">081 - EPILEPSI</option>
                                <option value="NEUROFISIOLOGI KLINIS">082 - NEUROFISIOLOGI KLINIS</option>
                                <option value="NEUROMSUKULAR, SARAF PERIFER">083 - NEUROMSUKULAR, SARAF PERIFER</option>
                                <option value="NEURO-INTENSIF">086 - NEURO-INTENSIF</option>
                                <option value="INFEKSI">095 - INFEKSI</option>
                                <option value="ONKOLOGI TORAKS">096 - ONKOLOGI TORAKS</option>
                                <option value="ASMA DAN PPOK">097 - ASMA DAN PPOK</option>
                                <option value="FAAL PARU KLINIK">099 - FAAL PARU KLINIK</option>
                                <option value="PARU KERJA DAN LINGKUNGAN">100 - PARU KERJA DAN LINGKUNGAN</option>
                                <option value="IMUNOLOGI KLINIK">101 - IMUNOLOGI KLINIK</option>
                                <option value="BURN (LUKA BAKAR)">104 - BURN (LUKA BAKAR)</option>
                                <option value="MICRO SURGERY">105 - MICRO SURGERY</option>
                                <option value="KRANIOFASIAL (KKF)">106 - KRANIOFASIAL (KKF)</option>
                                <option value="HAND (BEDAH TANGAN)">107 - HAND (BEDAH TANGAN)</option>
                                <option value="GENITALIA EKSTERNA">108 - GENITALIA EKSTERNA</option>
                                <option value="REKONSTRUKSI DAN ESTETIK">109 - REKONSTRUKSI DAN ESTETIK</option>
                                <option value="Akupuntur">AKP - Akupuntur</option>
                                <option value="Poli Anak">ANA - Poli Anak</option>
                                <option value="ANDROLOGI">AND - ANDROLOGI</option>
                                <option value="ANASTESI">ANT - ANASTESI</option>
                                <option value="APOTIK">APT - APOTIK</option>
                                <option value="BEDAH ANAK">BDA - BEDAH ANAK</option>
                                <option value="GIGI BEDAH MULUT">BDM - GIGI BEDAH MULUT</option>
                                <option value="BEDAH PLASTIK">BDP - BEDAH PLASTIK</option>
                                <option value="Poli Bedah">BED - Poli Bedah</option>
                                <option value="BEDAH SARAF">BSY - BEDAH SARAF</option>
                                <option value="BTKV (BEDAH THORAX KARDIOVASKU)">BTK - BTKV (BEDAH THORAX KARDIOVASKU)
                                </option>
                                <option value="Geriatri">GER - Geriatri</option>
                                <option value="Poli Gigi">GIG - Poli Gigi</option>
                                <option value="Gizi">GIZ - Gizi</option>
                                <option value="GIGI ENDODONSI">GND - GIGI ENDODONSI</option>
                                <option value="GIGI ORTHODONTI">GOR - GIGI ORTHODONTI</option>
                                <option value="GIGI PERIODONTI">GPR - GIGI PERIODONTI</option>
                                <option value="GIGI RADIOLOGI">GRD - GIGI RADIOLOGI</option>
                                <option value="Hemodialisa">HDL - Hemodialisa</option>
                                <option value="Unit IGD">IGDK - Unit IGD</option>
                                <option value="Poli Penyakit Dalam">INT - Poli Penyakit Dalam</option>
                                <option value="Instalasi Rehab Medik">IRM - Instalasi Rehab Medik</option>
                                <option value="Poli Jantung">JAN - Poli Jantung</option>
                                <option value="Poli Penyakit Jiwa">JIW - Poli Penyakit Jiwa</option>
                                <option value="KEDOKTERAN KELAUTAN">KDK - KEDOKTERAN KELAUTAN</option>
                                <option value="KEDOKTERAN NUKLIR">KDN - KEDOKTERAN NUKLIR</option>
                                <option value="KEDOKTERAN PENERBANGAN">KDP - KEDOKTERAN PENERBANGAN</option>
                                <option value="Kemoterapi">KEMO - Kemoterapi</option>
                                <option value="KULIT KELAMIN">KLT - KULIT KELAMIN</option>
                                <option value="GIGI PEDODONTIS">KON - GIGI PEDODONTIS</option>
                                <option value="KEDOKTERAN OLAHRAGA">KOR - KEDOKTERAN OLAHRAGA</option>
                                <option value="LABORATORIUM PATOLOGI ANATOMI">LPA - LABORATORIUM PATOLOGI ANATOMI
                                </option>
                                <option value="LABORATORIUM PATOLOGI KLINIS">LPK - LABORATORIUM PATOLOGI KLINIS</option>
                                <option value="Poli Penyakit Mata">MAT - Poli Penyakit Mata</option>
                                <option value="Medical Check Up">MCU - Medical Check Up</option>
                                <option value="Poli Obstetri/Gyn">OBG - Poli Obstetri/Gyn</option>
                                <option value="Poli Paru Paru">PAR - Poli Paru Paru</option>
                                <option value="GIGI PENYAKIT MULUT">PNM - GIGI PENYAKIT MULUT</option>
                                <option value="GIGI PROSTHODONTI">PTD - GIGI PROSTHODONTI</option>
                                <option value="RADIOLOGI">RAD - RADIOLOGI</option>
                                <option value="Poli Penyakit Saraf">SAR - Poli Penyakit Saraf</option>
                                <option value="Poli Telinga/Hidung/Tenggorokan">THT - Poli Telinga/Hidung/Tenggorokan
                                </option>
                                <option value="GIGI">U0114 - GIGI</option>
                                <option value="Unit Gawat Darurat">UGD - Unit Gawat Darurat</option>
                                <option value="UROLOGI">URO - UROLOGI</option>
                                <option value="VCT">VCT - VCT</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Pasien</label>
                            <input type="number" class="form-control" name="jumlah"
                                placeholder="Masukkan jumlah pasien">
                        </div>
                    </div>
                    <div class=" card-footer">
                        <button type="button" id="btn-submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- End Main content -->
</div>
@endsection

@section('script')
<script>
// Get the current date in the format YYYY-MM-DD
const today = new Date();
const year = today.getFullYear();
let month = today.getMonth() + 1;
let day = today.getDate();

// Add leading zero for single-digit months and days
if (month < 10) {
    month = '0' + month;
}

if (day < 10) {
    day = '0' + day;
}
// Format the date as YYYY-MM-DD
const formattedDate = `${year}-${month}-${day}`;
document.getElementById('tgl_transaksi').value = formattedDate;

$('#btn-submit').click(function() {
    if ($('#form-dokter-spesialis')[0].checkValidity()) {
        var formData = new FormData();
        formData.append('tgl_transaksi', $('input[name=tgl_transaksi]').val());
        formData.append('nama_poli', $('select[name=nama_poli]').val());
        formData.append('jumlah', $('input[name=jumlah]').val());
        formData.append('_token', $('input[name=_token]').val());
        $.ajax({
            url: "https://training-bios2.kemenkeu.go.id/api/ws/kesehatan/layanan/pasien_ralan_poli",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data.data);
                Swal.fire({
                    title: "Berhasil!",
                    text: "Data Berhasil ditambahkan",
                    icon: "success",
                    buttons: false,
                    timer: 2000,
                }).then(function() {
                    window.location.href = "{{ route('psn-rawat-jalan') }}"
                });
            },
            error: function(data) {
                console.log(data);
                Swal.fire({
                    title: "Gagal!",
                    text: "Data gagal ditambahkan",
                    icon: "error",
                    buttons: false,
                    timer: 2000,
                })
            }
        });
    } else {
        $('#form-dokter-spesialis')[0].reportValidity();
    }
});
</script>
@endsection