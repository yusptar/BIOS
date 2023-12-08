@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="font-weight:bold">Jumlah Layanan Laboratorium (Parameter)</h1>
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
                        <input type="hidden" name="_token" value="Wm0qbXXO6oIkYEbFWl4as7auxZdxYa06" />
                        <div class="form-group">
                            <label>NAMA LAYANAN</label>
                            <select class="form-control" name="nama_layanan" id="nama_layanan">
                                <option disabled selected>-- Pilih Kategori --</option>
                                <option value="HEMATOLOGI">HEMATOLOGI</option>
                                <option value="KIMIA KLINIS">KIMIA KLINIS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Pasien</label>
                            <input type="number" class="form-control" name="jumlah" placeholder="Masukkan jumlah pasien" disabled>
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
    <!-- <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-info" data-toggle="modal" data-target="#modal"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Keterangan</button>
                        </div>
                        <div class="card-body">
                            <form id="form-lab-param">
                                @csrf
                                <table class="table table-bordered table-hover" id="table-rm">
                                    <thead>
                                        <tr>
                                            <th>Nama Layanan</th>
                                            <th>Jumlah Layanan Lab Parameter</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <input type="text" class="form-control" name="tgl_transaksi" id="tgl_transaksi" hidden>
                                        <input type="hidden" name="_token" value="Wm0qbXXO6oIkYEbFWl4as7auxZdxYa06" />
                                        <tr>
                                            <td scope="row">
                                                <input type="text" class="form-control" name="nama_layanan" disabled value="HEMATOLOGI">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" name="jumlah_h" placeholder="Masukkan Jumlah Layanan" disabled>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td scope="row">
                                                <input type="text" class="form-control" name="nama_layanan"  disabled value="KIMIA KLINIS">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" name="jumlah_k" placeholder="Masukkan Jumlah Layanan" disabled>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <div class=" card-footer">
                            <button type="button" id="btn-submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
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
        <p>● Data yang dikirimkan merupakan posisi data pada saat tanggal transaksi, bersifat akumulatif</p>
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

// Fungsi untuk mengisi formulir dengan data dari database
function fillFormWithData(data) {
    // Mengisi nilai jumlah pada formulir
    $('input[name=jumlah]').val(data.result.jumlah);
}

// Fungsi untuk mengambil data dari database
function fetchDataFromDatabase() {
    var selectedCategory = $('#nama_layanan').val();

    $.ajax({
        url: "{{ route('getParameter') }}",
        method: 'GET',
        dataType: 'json',
        data: { nama_layanan: selectedCategory }, 
        success: function(response, status, xhr) {
            console.log(response); // Tambahkan ini untuk melihat respons lengkap di konsol
            if (xhr.status === 200) { // Periksa status HTTP di sini
                fillFormWithData(response);
            } else if (xhr.status === 400) {
                console.error('Gagal mengambil data:', response.message); 
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

// Menambahkan event listener untuk memanggil fetchDataFromDatabase saat opsi kelas berubah
$('#nama_layanan').change(fetchDataFromDatabase);


$('#btn-submit').click(function() {
    if ($('#form-lab-param')[0].checkValidity()) {
        var formData = new FormData();
        formData.append('tgl_transaksi', $('input[name=tgl_transaksi]').val());
        formData.append('nama_layanan', $('input[name=nama_layanan]').val());
        formData.append('jumlah', $('input[name=jumlah]').val());
        formData.append('_token', $('input[name=_token]').val());
        $.ajax({
            url: "https://training-bios2.kemenkeu.go.id/api/ws/kesehatan/layanan/laboratorium_detail",
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
                    window.location.href = "{{ route('lab-parameter') }}"
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
        $('#form-lab-param')[0].reportValidity();
    }
});
</script>
@endsection