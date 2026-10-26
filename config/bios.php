<?php

/*
| Konfigurasi koneksi ke layanan BIOS.
| Dibaca dari .env; jangan memanggil env() langsung di controller/view karena
| nilainya kosong setelah `php artisan config:cache`.
*/

return [
    'satker' => env('KD_SATKER'),
    'key' => env('KEY_DEV'),
    'auth_url' => env('AUTH_TOKEN'),
];
