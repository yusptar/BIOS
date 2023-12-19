@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="font-weight:bold">Jumlah Tenaga Non Medis</h1>
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
                        <div class=" form-group">
                            <label>PNS</label>
                            <input type="number" class="form-control" name="pns" placeholder="Masukkan jumlah PNS">
                        </div>
                        <div class="form-group">
                            <label>PPPK</label>
                            <input type="number" class="form-control" name="pppk" placeholder="Masukkan jumlah PPPK">
                        </div>
                        <div class="form-group">
                            <label>Anggota</label>
                            <input type="number" class="form-control" name="anggota"
                                placeholder="Masukkan jumlah Anggota">
                        </div>
                        <div class="form-group">
                            <label>Non PNS Tetap (Khusus Anggota TNI/Polri)</label>
                            <input type="number" class="form-control" name="non_pns_tetap"
                                placeholder="Masukkan jumlah Non PNS Tetap">
                        </div>
                        <div class="form-group">
                            <label>Kontrak</label>
                            <input type="number" class="form-control" name="kontrak"
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
        <p>● Data yang dikirimkan merupakan posisi data pada saat tanggal berkenaan, bersifat akumulatif. Data yang dikirimkan merupakan jumlah pegawai sesuai kriteria.</p>
        <p>● Data awal dikirimkan pada awal tahun berkenaan, updating data dikirimkan per periode semesteran/tahunan.</p>
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
            url: "https://training-bios2.kemenkeu.go.id/api/ws/kesehatan/sdm/non_medis",
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