# Cara penggunaan Aplikasi

## requirement

-   composer
-   php 7,4 keatas
-   apache atau nginx
-   mysql

## cara install

-   silahkan download aplikasinya
-   lalu ketik composer install
-   setelah selesai buka terminal dan silakan ketik php artisan migrate untuk migrasi database atau php artisan migrate --seed untuk menggunakan faker
-   untuk menjalankan aplikasi ketik php artisan serve pada terminal
-   untuk mengetes API silahkan buka postman atau thunder client pada vscode

## enpoint

-   method:get endpoint:api/pegawai untuk melihat semua list pegawai
-   method:post endpoint:api/pegawai inputan: [nama:varchar|required|unique|maks:10.tanggal_masuk:date|required|tidak_lebih_dari_tanggal_sekarang,total_gaji:integer|required|min:4000000|maks:100000000]
