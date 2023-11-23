@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="font-weight:bold">BOR (<i> Bed Occupancy Ratio </i>) - (Dikirim Periode Bulanan)</h1>
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
        formData.append('tgl_transaksi', $('input[name=tgl_transaksi]').val());
        formData.append('bor', $('input[name=bor]').val());
        formData.append('_token', $('input[name=_token]').val());
        $.ajax({
            url: "https://training-bios2.kemenkeu.go.id/api/ws/kesehatan/layanan/bor",
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
                    window.location.href = "{{ route('bor') }}"
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