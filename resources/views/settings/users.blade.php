@extends('layouts.main')
@section('content')
<div class="content-wrapper" id="main">
    @include('layouts.partials.page-header', ['title' => 'Pengguna', 'lead' => 'Akun yang bisa masuk ke BIOS Web Service. NIP/NRP harus sama dengan NIK pegawai di SIMRS.'])

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="bios-card-head">
                            <div>
                                <h2>Tambah pengguna</h2>
                                <p>Semua kolom wajib diisi.</p>
                            </div>
                        </div>
                        <form id="form-users" autocomplete="off">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="role" id="role" class="form-control custom-select" required>
                                        <option value="" disabled selected>Pilih role</option>
                                        <option value="admin">Admin (kirim data BIOS)</option>
                                        <option value="direktorat">Direktorat PPKBLU (lihat dashboard)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="username">NIP/NRP</label>
                                    <input id="username" type="text" class="form-control" name="username" required placeholder="Masukkan NIP/NRP" inputmode="numeric">
                                </div>
                                <div class="form-group">
                                    <label for="new-password">Password</label>
                                    <input id="new-password" type="password" class="form-control" name="password" required minlength="8" autocomplete="new-password" placeholder="Minimal 8 karakter">
                                </div>
                                <div class="form-group">
                                    <label for="new-password-confirm">Konfirmasi password</label>
                                    <input id="new-password-confirm" type="password" class="form-control" name="password_confirmation" required minlength="8" autocomplete="new-password" placeholder="Ulangi password">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" id="btn-submit" class="btn btn-primary btn-block"><i class="fas fa-user-plus mr-2" aria-hidden="true"></i>Tambah pengguna</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="bios-card-head">
                            <div>
                                <h2>Daftar pengguna</h2>
                                <p>Ubah password atau hapus akun dari kolom aksi.</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="users_table" class="table table-hover dt-responsive" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>NIP/NRP</th>
                                        <th>Role</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th class="text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade user_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="update_user" action="{{ route('user-update') }}" method="POST" autocomplete="off">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel">Ubah password <span class="text-muted" data-user-label></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="upd-password">Password baru</label>
                        <input id="upd-password" type="password" class="form-control" name="password" required minlength="8" autocomplete="new-password">
                        <span class="text-danger small password_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="upd-password-confirm">Konfirmasi password baru</label>
                        <input id="upd-password-confirm" type="password" class="form-control" name="password_confirmation" required minlength="8" autocomplete="new-password">
                        <span class="text-danger small password_confirmation_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan password</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$('#btn-submit').click(function() {
    if ($('#form-users')[0].checkValidity()) {
        var formData = new FormData();
        formData.append('role', $('select[name=role]').val());
        formData.append('username', $('input[name=username]').val());
        formData.append('password', $('input[name=password]').val());
        formData.append('password_confirmation', $('input[name=password_confirmation]').val());
        formData.append('_token', $('input[name=_token]').val());
        $.ajax({
            url: "{{ route('user-store') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#form-users')[0].reset();
                $('#users_table').DataTable().ajax.reload(null, false);
                Swal.fire({
                    title: "Berhasil!",
                    text: "Pengguna berhasil ditambahkan",
                    icon: "success",
                    timer: 2500,
                })
            },
            error: function(xhr) {
                var errs = (xhr.responseJSON && xhr.responseJSON.error) || {};
                var msg = Object.keys(errs).map(function (k) { return [].concat(errs[k])[0]; }).join('\n');
                Swal.fire({
                    title: "Gagal!",
                    text: msg || "Pengguna gagal ditambahkan",
                    icon: "error",
                })
            }
        });
    } else {
        $('#form-users')[0].reportValidity();
    }
});

$('#users_table').DataTable({
    processing: true,
    info: true,
    responsive: true,
    language: {
        search: "", searchPlaceholder: "Cari pengguna…", lengthMenu: "_MENU_ per halaman",
        info: "_START_–_END_ dari _TOTAL_ pengguna", infoEmpty: "Belum ada pengguna", infoFiltered: "(disaring dari _MAX_)",
        zeroRecords: "Tidak ada pengguna yang cocok", processing: "Memuat…", emptyTable: "Belum ada pengguna",
        paginate: { previous: "‹", next: "›" }
    },
    ajax: "{{ route('user-list') }}",
    columns: [{
            data: "username",
            name: "username"
        },
        {
            data: "role",
            name: "role",
            render: function (v) {
                return v === 'admin' ? '<span class="bios-freq">Admin</span>'
                     : v === 'direktorat' ? '<span class="bios-tag-auto">Direktorat PPKBLU</span>'
                     : $('<span>').text(v || '-').html();
            }
        },
        {
            data: "nama",
            name: "nama"
        },
        {
            data: "no_ktp",
            name: "no_ktp"
        },
        {
            data: "actions",
            name: "actions",
            orderable: false,
            searchable: false,
            className: "text-right"
        },
    ]
});


$(document).on('click', '#edit_user_btn', function() {
    const id = $(this).data('id');
    const url = "{{ route('user.detail') }}";
    $('.user_modal').find('form')[0].reset();
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            id: id,
        },
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        },
        dataType: 'json',
        success: function(data) {
            $('.user_modal').find('input[name="id"]').val(data.details.id);
            // $('.user_modal').find('input[name="username"]').val(data.details.username);
            // Password tidak diisi otomatis: dulu kolom ini berisi hash password
            // sehingga menekan "Update" tanpa mengetik membuat akun terkunci.
            $('.user_modal').find('[data-user-label]').text('· ' + (data.details.username || ''));
            $('.user_modal').find('span.text-danger').text('');
            $('.user_modal').modal('show');
        },
        error: function(xhr, status, error) {
            console.log('Error: ' + error);
        }
    });
});

$('#update_user').on('submit', function(e) {
    e.preventDefault();
    var form = this;
    $.ajax({
        url: $(form).attr('action'),
        method: $(form).attr('method'),
        data: new FormData(form),
        processData: false,
        dataType: 'json',
        contentType: false,
        beforeSend: function() {
            $(form).find('span.text-danger').text('');
        },
        error: function(xhr) {
            var errs = (xhr.responseJSON && xhr.responseJSON.errors) || {};
            $.each(errs, function(prefix, val) {
                $(form).find('span.' + prefix + '_error').text(val[0]);
            });
            if ($.isEmptyObject(errs)) { Swal.fire('Gagal', 'Password gagal diperbarui.', 'error'); }
        },
        success: function(data) {
            if (data.code == 0) {
                $.each(data.error, function(prefix, val) {
                    $(form).find('span.' + prefix + '_error').text(val[0]);
                });
            } else {
                $(form)[0].reset();
                $('#users_table').DataTable().ajax.reload(null, false);
                $('.user_modal').modal('hide');
                Swal.fire(
                    'Updated!',
                    'Password telah diperbarui!',
                    'success'
                )
            }
        }
    });
});


$(document).on('click', '#delete_user_btn', function(e) {
    e.preventDefault();
    let id = $(this).data('id');
    Swal.fire({
        title: 'Apakah anda yakin untuk menghapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Tidak',
    }).then((result) => {
        if (result.isConfirmed) {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ route('user-delete') }}",
                method: "POST",
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
                dataType: 'json',
                success: function(response) {
                    if (response.code == 0) {
                        Swal.fire(
                            'Oops!',
                            'Something went wrong!.',
                            'error'
                        )
                    } else {
                        $('#users_table').DataTable().ajax.reload(null,
                            false);
                        Swal.fire(
                            'Deleted!',
                            'Data berhasil dihapus!.',
                            'success'
                        )
                    }
                }
            });
        }
    })
});
</script>
@endsection