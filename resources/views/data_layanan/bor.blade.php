@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="font-weight:bold">BOR (<i> Bed Occupancy Ratio </i>)</h1>
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
                            <label>Presentase BOR (%)</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="bor" placeholder="Masukkan presentase BOR" disabled>
                                <div class="input-group-prepend">
                                    <p class="input-group-text"><i class="fa fa-percent"></i></p>
                                </div>
                            </div>
                            
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
        <p>● Data dikirimkan per periode bulanan</p>
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

function fillFormWithData(data) {
    // Mengisi nilai jumlah pada formulir
    $('input[name=bor]').val(data.result.jumlah);
}

// Fungsi untuk mengambil data dari database
function fetchDataFromDatabase() {
    $.ajax({
        url: "{{ route('getBOR') }}",
        method: 'GET',
        dataType: 'json',
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

$('#btn-submit').click(function() {
    if ($('#form-dokter-spesialis')[0].checkValidity()) {
        var formData = new FormData();
        var token = $('#token').val(); 
        formData.append('tgl_transaksi', $('input[name=tgl_transaksi]').val());
        formData.append('bor', $('input[name=bor]').val());
        formData.append('_token', $('input[name=_token]').val());
        $.ajax({
            url: "https://training-bios2.kemenkeu.go.id/api/ws/kesehatan/layanan/bor",
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