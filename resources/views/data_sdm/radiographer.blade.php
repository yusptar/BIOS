@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="font-weight:bold">Jumlah Radiographer</h1>
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
                        <input type="hidden" name="tgl_transaksi">
                        <div class="form-group">
                            <label>PNS</label>
                            <input type="number" class="form-control" id="pns" name="pns"
                                placeholder="Masukkan jumlah PNS">
                        </div>
                        <div class="form-group">
                            <label>PPPK</label>
                            <input type="number" class="form-control" id="pppk" name="pppk"
                                placeholder="Masukkan jumlah PPPK">
                        </div>
                        <div class="form-group">
                            <label>Anggota</label>
                            <input type="number" class="form-control" id="anggota" name="anggota"
                                placeholder="Masukkan jumlah Anggota">
                        </div>
                        <div class="form-group">
                            <label>Non PNS Tetap (Khusus Anggota TNI/Polri)</label>
                            <input type="number" class="form-control" id="non_pns_tetap" name="non_pns_tetap"
                                placeholder="Masukkan jumlah Non PNS Tetap">
                        </div>
                        <div class="form-group">
                            <label>Kontrak</label>
                            <input type="number" class="form-control" id="kontrak" name="kontrak"
                                placeholder="Masukkan Jumlah Kontrak">
                        </div>
                    </div>
                    <div class="card-footer">
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
$('#btn-submit').click(function() {
    if ($('#form-dokter-spesialis')[0].checkValidity()) {
        var formData = new FormData();
        formData.append('pns', $('input[name=pns]').val());
        formData.append('pppk', $('input[name=pppk]').val());
        formData.append('anggota', $('input[name=anggota]').val());
        formData.append('non_pns_tetap', $('input[non_pns_tetap]').val());
        formData.append('kontrak', $('input[name=kontrak]').val());
        formData.append('_token', $('input[name=_token]').val());
        $.ajax({
            url: "https://training-bios2.kemenkeu.go.id/api/ws/kesehatan/sdm/dokter_spesialis",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data.data);
                Swal({
                    title: "Berhasil!",
                    text: "Data parkir berhasil ditambahkan",
                    icon: "success",
                    buttons: false,
                    timer: 2000,
                }).then(function() {
                    window.location.href = "{{ route('dktr-spesialis') }}"
                });
            },
            error: function(data) {
                console.log(data);
                swal({
                    title: "Gagal!",
                    text: "Data parkir gagal ditambahkan",
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