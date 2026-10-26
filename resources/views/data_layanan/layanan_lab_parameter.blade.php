@extends('layouts.main')
@section('content')
<div class="content-wrapper" id="main">
    @include('layouts.partials.page-header', ['title' => 'Jumlah Layanan Laboratorium (Parameter)', 'freq' => 'Harian'])

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row bios-form-layout">
                <div class="col-lg-7 col-xl-8">
            <div class="card bios-card bios-form-card">
                <div class="bios-card-head">
                    <div>
                        <h2>Data yang dikirim</h2>
                        <p>Periksa angka, lalu tekan <strong>Kirim ke BIOS</strong>.</p>
                    </div>
                    <span class="bios-pill"><i class="far fa-calendar-alt" aria-hidden="true"></i> <span data-bios-txdate>—</span></span>
                </div>
                <form id="form-lab-param">
                    @csrf
                    <div class="card-body">
                        <input type="text" class="form-control" name="tgl_transaksi" id="tgl_transaksi" hidden>
                        <input type="text" name="_token" id="token" value="{{ Auth::user()->token }}" hidden>
                        <div class="form-group">
                            <label>Nama Layanan</label>
                            <select class="form-control custom-select" name="nama_layanan" id="nama_layanan">
                                <option disabled selected>-- Pilih Kategori --</option>
                                <option value="HEMATOLOGI">HEMATOLOGI</option>
                                <option value="KIMIA KLINIS">KIMIA KLINIS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah <span class="bios-tag-auto" title="Diisi otomatis dari SIMRS">SIMRS</span></label>
                            <input type="number" class="form-control" name="jumlah" placeholder="Masukkan jumlah pasien" disabled>
                        </div>
                    </div>
                    <div class="card-footer bios-form-foot">
                        <span class="bios-foot-note"><i class="fas fa-lock" aria-hidden="true"></i> Dikirim langsung ke layanan BIOS dengan token akun Anda.</span>
                        <button type="button" id="btn-submit" class="btn btn-primary bios-submit"><i class="fas fa-paper-plane" aria-hidden="true"></i> Kirim ke BIOS</button>
                    </div>
                </form>
            </div>
                </div>
                <div class="col-lg-5 col-xl-4">
                    @include('layouts.partials.form-info', ['notes' => ['Data yang dikirimkan merupakan posisi data terakhir pada saat tanggal berkenaan, tidak bersifat akumulatif', 'Data dikirimkan per periode harian'], 'auto' => true])
                </div>
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

@endsection

@section('script')
<script>
// Get the current date in the format YYYY-MM-DD
const today = new Date();
today.setDate(today.getDate() - 1);
const formattedDate = BIOS.localDate(today);
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
            // console.log(response); // Tambahkan ini untuk melihat respons lengkap di konsol
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
        var token = $('#token').val();
    
        var tglTransaksi = $('input[name=tgl_transaksi]').val();
        var nmLayanan = $('select[name=nama_layanan]').val();
        var jumlah = $('input[name=jumlah]').val();

        formData.append('tgl_transaksi', $('input[name=tgl_transaksi]').val());
        formData.append('nama_layanan', $('select[name=nama_layanan]').val());
        formData.append('jumlah', $('input[name=jumlah]').val());
        formData.append('_token', $('input[name=_token]').val());
        $.ajax({
            url: '{{ env('LYN_LAB_PARAM') }}',
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            },
            success: function(data) {
                console.log(data);
                console.log('tgl_transaksi:', tglTransaksi);
                console.log('nama_layanan:', nmLayanan);
                console.log('jumlah:', jumlah);
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
        $('#form-lab-param')[0].reportValidity();
    }
});
</script>
@endsection