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
                <button class="btn btn-info" data-toggle="modal" data-target="#modal"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Keterangan</button>
                </div>
                <form id="form-dokter-spesialis">
                    @csrf
                    <div class="card-body">
                        <input type="text" class="form-control" name="tgl_transaksi" id="tgl_transaksi" hidden>
                        <input type="text" name="_token" id="token" value="{{ Auth::user()->token }}" hidden>
                        <div class="form-group">
                            <label>Nama Poli</label>
                            <select class="form-control col-sm-5" name="nama_poli" id="nm_poli">
                                <option disabled selected>-- Pilih Nama Poli --</option>
                                <option value="ALERGI-IMMUNOLOGI KLINIK">004 - ALERGI-IMMUNOLOGI KLINIK</option>
                                <option value="GERIATRI">006 - GERIATRI</option>
                                <option value="PULMONOLOGI">012 - PULMONOLOGI</option>
                                <option value="KARDIOVASKULAR">015 - KARDIOVASKULAR</option>
                                <option value="BEDAH ONKOLOGI">017 - BEDAH ONKOLOGI</option>
                                <option value="BEDAH DIGESTIF">018 - BEDAH DIGESTIF</option>
                                <option value="ONKOLOGI GINEKOLOGI">021 - ONKOLOGI GINEKOLOGI</option>
                                <option value="UROGINEKOLOGI REKONTRUKSI">022 - UROGINEKOLOGI REKONTRUKSI</option>
                                <option value="NEUROLOGI">068 - NEUROLOGI</option>
                                <option value="THT KOMUNITAS">075 - THT KOMUNITAS</option>
                                <option value="NEUROMSUKULAR, SARAF PERIFER">083 - NEUROMSUKULAR, SARAF PERIFER</option>
                                <option value="FAAL PARU KLINIK">099 - FAAL PARU KLINIK</option>
                                <option value="Poli Anak">ANA - Poli Anak</option>
                                <option value="GIGI BEDAH MULUT">BDM - GIGI BEDAH MULUT</option>
                                <option value="BEDAH PLASTIK">BDP - BEDAH PLASTIK</option>
                                <option value="Poli Bedah">BED - Poli Bedah</option>
                                <option value="BEDAH SARAF">BSY - BEDAH SARAF</option>
                                <option value="BTKV (BEDAH THORAX KARDIOVASKU)">BTK - BTKV (BEDAH THORAX KARDIOVASKU)</option>
                                <option value="Geriatri">GER - Geriatri</option>
                                <option value="Poli Gigi">GIG - Poli Gigi</option>
                                <option value="Gizi">GIZ - Gizi</option>
                                <option value="Hemodialisa">HDL - Hemodialisa</option>
                                <option value="Unit IGD">IGDK - Unit IGD</option>
                                <option value="Poli Penyakit Dalam">INT - Poli Penyakit Dalam</option>
                                <option value="Instalasi Rehab Medik">IRM - Instalasi Rehab Medik</option>
                                <option value="Poli Jantung">JAN - Poli Jantung</option>
                                <option value="Poli Penyakit Jiwa">JIW - Poli Penyakit Jiwa</option>
                                <option value="Kemoterapi">KEMO - Kemoterapi</option>
                                <option value="KULIT KELAMIN">KLT - KULIT KELAMIN</option>
                                <option value="GIGI PEDODONTIS">KON - GIGI PEDODONTIS</option>
                                <option value="LABORATORIUM PATOLOGI ANATOMI">LPA - LABORATORIUM PATOLOGI ANATOMI</option>
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
                                <option value="Unit Gawat Darurat">UGD - Unit Gawat Darurat</option>
                                <option value="UROLOGI">URO - UROLOGI</option>
                                <option value="VCT">VCT - VCT</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Pasien</label>
                            <input type="number" class="form-control" name="jumlah"
                                placeholder="Masukkan jumlah pasien" disabled>
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

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Keterangan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <p>1. Data transaksi pengeluaran yang dikirimkan di-grouping per tanggal transaksi per akun</p> -->
        <p>● Data yang dikirimkan merupakan posisi data pada saat tanggal transaksi, tidak bersifat akumulatif</p>
        <p>● Data dikirimkan per periode harian</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
// Get the current date in the format YYYY-MM-DD
const today = new Date();
// today.setDate(today.getDate() - 1);
const formattedDate = today.toISOString().slice(0, 10);
document.getElementById('tgl_transaksi').value = formattedDate;

// Fungsi untuk mengisi formulir dengan data dari database
function fillFormWithData(data) {
    // Mengisi nilai jumlah pada formulir
    $('input[name=jumlah]').val(data.result.jumlah);
}

// Fungsi untuk mengambil data dari database
function fetchDataFromDatabase() {
    var selectedCategory = $('#nm_poli').val();
    
    $.ajax({
        url: "{{ route('getPsnRalan') }}",
        method: 'GET',
        dataType: 'json',
        data: { nm_poli: selectedCategory }, // Mengirim nilai kategori ke server
        success: function(response, status, xhr) {
            console.log(response); // Tambahkan ini untuk melihat respons lengkap di konsol
            if (xhr.status === 200) { // Periksa status HTTP di sini
                fillFormWithData(response);
            } else if (xhr.status === 400) {
                console.error('Gagal mengambil data:', response.message); // Ubah pesan kesalahan sesuai respons dari server
            }
        },
        error: function(error) {
            console.error('Error fetching data from the database:', error);
        }
    });
}

// Mengisi formulir saat halaman dimuat
$(document).ready(function() {
    fetchDataFromDatabase();
});

// Menambahkan event listener untuk memanggil fetchDataFromDatabase saat opsi kategori berubah
$('#nm_poli').change(fetchDataFromDatabase);

$('#btn-submit').click(function() {
    if ($('#form-dokter-spesialis')[0].checkValidity()) {
        var formData = new FormData();
        var token = $('#token').val(); 
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
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            },
            success: function(data) {
                console.log(data);
                Swal.fire({
                    title: "Berhasil!",
                    text: "Data Berhasil ditambahkan",
                    icon: "success",
                    buttons: false,
                    timer: 2000,
                })
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