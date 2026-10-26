@extends('layouts.main')
@section('content')
<div class="content-wrapper" id="main">
    @include('layouts.partials.page-header', ['title' => 'Jumlah Pranata Laboratorium', 'freq' => 'Awal tahun + semesteran/tahunan'])

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
                            <label>PNS</label>
                            <input type="number" class="form-control" name="pns" placeholder="Masukkan jumlah PNS">
                        </div>
                        <div class="form-group">
                            <label>PPPK</label>
                            <input type="number" class="form-control" name="pppk" placeholder="Masukkan jumlah PPPK">
                        </div>
                        <div class="form-group">
                            <label>Anggota (Khusus Anggota TNI/Polri)</label>
                            <input type="number" class="form-control" name="anggota"
                                placeholder="Masukkan jumlah Anggota">
                        </div>
                        <div class="form-group">
                            <label>Non PNS Tetap</label>
                            <input type="number" class="form-control" name="non_pns_tetap"
                                placeholder="Masukkan jumlah Non PNS Tetap">
                        </div>
                        <div class="form-group">
                            <label>Kontrak</label>
                            <input type="number" class="form-control" name="kontrak"
                                placeholder="Masukkan Jumlah Kontrak">
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
                    @include('layouts.partials.form-info', ['notes' => ['Data yang dikirimkan merupakan posisi data pada saat tanggal berkenaan, bersifat akumulatif. Data yang dikirimkan merupakan jumlah pegawai sesuai kriteria.', 'Data awal dikirimkan pada awal tahun berkenaan, updating data dikirimkan per periode semesteran/tahunan.']])
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
        var token = $('#token').val(); 
        
        formData.append('tgl_transaksi', $('input[name=tgl_transaksi]').val());
        formData.append('pns', $('input[name=pns]').val());
        formData.append('pppk', $('input[name=pppk]').val());
        formData.append('anggota', $('input[name=anggota]').val());
        formData.append('non_pns_tetap', $('input[name=non_pns_tetap]').val());
        formData.append('kontrak', $('input[name=kontrak]').val());
        formData.append('_token', $('input[name=_token]').val());
        $.ajax({
            url: '{{ env('SDM_PRAN_LAB') }}',
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