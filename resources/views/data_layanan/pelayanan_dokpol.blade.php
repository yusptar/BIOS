@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="font-weight:bold">Jumlah Pelayanan Dokpol</h1>
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
                        <div class="form-group">
                            <label>Jumlah Kedokteran Forensik</label>
                            <input type="number" class="form-control" name="kedokteran_forensik"
                                placeholder="Masukkan jumlah kedokteran forensik">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Psikiatri Forensik</label>
                            <input type="number" class="form-control" name="psikiatri_forensik"
                                placeholder="Masukkan jumlah psikiatri forensik">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Sentra Visum dan Medikolegal</label>
                            <input type="number" class="form-control" name="sentra_visum_dan_medikolegal"
                                placeholder="Masukkan jumlah sentra visum dan medikolegal">
                        </div>
                        <div class="form-group">
                            <label>Jumlah PPAT</label>
                            <input type="number" class="form-control" name="ppat" placeholder="Masukkan jumlah PPAT">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Odontologi Forensik</label>
                            <input type="number" class="form-control" name="odontologi_forensik"
                                placeholder="Masukkan jumlah odontologi forensik">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Psikologi Forensik</label>
                            <input type="number" class="form-control" name="psikologi_forensik"
                                placeholder="Masukkan jumlah psikologi forensik">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Antropologi Forensik</label>
                            <input type="number" class="form-control" name="antropologi_forensik"
                                placeholder="Masukkan jumlah antropologi forensik">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Olah TKP Medis</label>
                            <input type="number" class="form-control" name="olah_tkp_medis"
                                placeholder="Masukkan jumlah olah tkp medis">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Kesehatan Tahanan</label>
                            <input type="number" class="form-control" name="kesehatan_tahanan"
                                placeholder="Masukkan jumlah kesehatan tahanan">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Narkoba</label>
                            <input type="number" class="form-control" name="narkoba"
                                placeholder="Masukkan jumlah narkoba">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Toksiologi Medik</label>
                            <input type="number" class="form-control" name="toksikologi_medik"
                                placeholder="Masukkan jumlah toksiologi medik">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Pelayanan DNA</label>
                            <input type="number" class="form-control" name="pelayanan_dna"
                                placeholder="Masukkan jumlah pelayanan dna">
                        </div>
                        <div class="form-group">
                            <label>Jumlah PAM keslap food security</label>
                            <input type="number" class="form-control" name="pam_keslap_food_security"
                                placeholder="Masukkan jumlah PAM keslap food security">
                        </div>
                        <div class="form-group">
                            <label>Jumlah DVI</label>
                            <input type="number" class="form-control" name="dvi" placeholder="Masukkan DVI">
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
        formData.append('kedokteran_forensik', $('input[name=kedokteran_forensik]').val());
        formData.append('psikiatri_forensik', $('input[name=psikiatri_forensik]').val());
        formData.append('sentra_visum_dan_medikolegal', $('input[name=sentra_visum_dan_medikolegal]').val());
        formData.append('ppat', $('input[name=ppat]').val());
        formData.append('odontologi_forensik', $('input[name=odontologi_forensik]').val());
        formData.append('psikologi_forensik', $('input[name=psikologi_forensik]').val());
        formData.append('antropologi_forensik', $('input[name=antropologi_forensik]').val());
        formData.append('olah_tkp_medis', $('input[name=olah_tkp_medis]').val());
        formData.append('kesehatan_tahanan', $('input[name=kesehatan_tahanan]').val());
        formData.append('narkoba', $('input[name=narkoba]').val());
        formData.append('toksikologi_medik', $('input[name=toksikologi_medik]').val());
        formData.append('pelayanan_dna', $('input[name=pelayanan_dna]').val());
        formData.append('pam_keslap_food_security', $('input[name=pam_keslap_food_security]').val());
        formData.append('dvi', $('input[name=dvi]').val());
        formData.append('_token', $('input[name=_token]').val());
        $.ajax({
            url: "https://training-bios2.kemenkeu.go.id/api/ws/kesehatan/layanan/dokpol",
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
                    window.location.href = "{{ route('dktr-spesialis') }}"
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