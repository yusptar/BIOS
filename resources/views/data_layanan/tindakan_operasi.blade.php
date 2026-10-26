@extends('layouts.main')
@section('content')
<div class="content-wrapper" id="main">
    @include('layouts.partials.page-header', ['title' => 'Jumlah Tindakan Operasi', 'freq' => 'Harian'])

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
                <form id="form-dokter-spesialis">
                    @csrf
                    <div class="card-body">
                        <input type="text" class="form-control" name="tgl_transaksi" id="tgl_transaksi" hidden>
                        <input type="text" name="_token" id="token" value="{{ Auth::user()->token }}" hidden>
                        <div class="form-group">
                            <label>Klasifikasi Operasi</label>
                            <select class="form-control custom-select" name="klasifikasi_operasi" id="kategori">
                                <option value="" selected disabled>--- Pilih Klasifikasi Operasi ---</option>
                                <option value="Khusus">Khusus</option>
                                <option value="Besar">Besar</option>
                                <option value="Sedang">Sedang</option>
                                <option value="Kecil">Kecil</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Pasien <span class="bios-tag-auto" title="Diisi otomatis dari SIMRS">SIMRS</span></label>
                            <input type="number" class="form-control" name="jumlah"
                                placeholder="Masukkan jumlah pasien" disabled>
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
                    @include('layouts.partials.form-info', ['notes' => ['Data yang dikirimkan merupakan posisi data pada saat tanggal transaksi, tidak bersifat akumulatif', 'Data dikirimkan per periode harian'], 'auto' => true])
                </div>
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
    // Mendapatkan nilai kategori yang dipilih
    var selectedCategory = $('#kategori').val();

    $.ajax({
        url: "{{ route('getOperasi') }}",
        method: 'GET',
        dataType: 'json',
        data: { kategori: selectedCategory }, // Mengirim nilai kategori ke server
        success: function(response, status, xhr) {
            // console.log(response); // Tambahkan ini untuk melihat respons lengkap di konsol
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
$('#kategori').change(fetchDataFromDatabase);

$('#btn-submit').click(function() {
    if ($('#form-dokter-spesialis')[0].checkValidity()) {
        var formData = new FormData();
        var token = $('#token').val(); 

        var tglTransaksi = $('input[name=tgl_transaksi]').val();
        var klasifikasi = $('select[name=klasifikasi_operasi]').val();
        var jumlah = $('input[name=jumlah]').val();
        
        formData.append('tgl_transaksi', $('input[name=tgl_transaksi]').val());
        formData.append('klasifikasi_operasi', $('select[name=klasifikasi_operasi]').val());
        formData.append('jumlah', $('input[name=jumlah]').val());
        formData.append('_token', $('input[name=_token]').val());
        $.ajax({
            url: '{{ env('LYN_OPERASI') }}',
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            },
            success: function(data) {
                // console.log(data);
                // console.log('tgl_transaksi:', tglTransaksi);
                // console.log('klasifikasi_operasi:', klasifikasi);
                // console.log('jumlah:', jumlah);
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