@extends('layouts.main')
@section('content')
<div class="content-wrapper" id="main">
    @include('layouts.partials.page-header', ['title' => 'Jumlah Layanan Forensik'])

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row bios-form-layout">
                <div class="col-lg-8 col-xl-7">
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
                        <input type="hidden" name="_token" value="Wm0qbXXO6oIkYEbFWl4as7auxZdxYa06" />
                        <div class="form-group">
                            <label>Jumlah Layanan Forensik per kunjungan pasien</label>
                            <input type="number" class="form-control" name="jumlah"
                                placeholder="Masukkan jumlah pasien">
                        </div>
                    </div>
                    <div class="card-footer bios-form-foot">
                        <span class="bios-foot-note"><i class="fas fa-lock" aria-hidden="true"></i> Dikirim langsung ke layanan BIOS dengan token akun Anda.</span>
                        <button type="button" id="btn-submit" class="btn btn-primary bios-submit"><i class="fas fa-paper-plane" aria-hidden="true"></i> Kirim ke BIOS</button>
                    </div>
                </form>
            </div>
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

$('#btn-submit').click(function() {
    if ($('#form-dokter-spesialis')[0].checkValidity()) {
        var formData = new FormData();
        formData.append('tgl_transaksi', $('input[name=tgl_transaksi]').val());
        formData.append('jumlah', $('input[name=jumlah]').val());
        formData.append('_token', $('input[name=_token]').val());
        $.ajax({
            url: "",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                // console.log(data.data);
                Swal.fire({
                    title: "Berhasil!",
                    text: "Data Berhasil ditambahkan",
                    icon: "success",
                    buttons: false,
                    timer: 2000,
                }).then(function() {
                    window.location.href = "{{ route('lyn-forensik') }}"
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