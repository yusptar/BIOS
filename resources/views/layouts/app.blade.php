<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#14284b">
    <title>Masuk · BIOS RS Tk. II dr. Soepraoen</title>
    <link rel="icon" type="image/png" href="{{ asset('auth/images/logo-rs.png') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bios/bios.css') }}?v=1">
</head>

<body class="bios bios-auth">
    @yield('content')
    <script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    @include('sweetalert::alert')
    @stack('scripts')
</body>

</html>
