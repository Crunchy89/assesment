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

-   method:get endpoint:api/pegawai untuk melihat semua list pegawai request:[page:integer|nullable]
-   method:post endpoint:api/pegawai untuk menambah data kasbon request: [nama:varchar|required|unique|maks:10.tanggal_masuk:date|required|tidak_lebih_dari_tanggal_sekarang,total_gaji:integer|required|min:4000000|maks:100000000]
-   method:get endpoint:api/kasbon untuk menampilkan seluruh data karbon request:[bulan:string|required|format:yyyy-mm,belum_disetujui:integer|nullable|jika_1_maka_menampilkan_yang_belum_disetujui,page:integer|nullable]
-   method:post endpoint:api/kasbon request:[pegawai_id:integer|required|exist:pegawai,id|sudah_bekerja_lebih_dari_1_tahun|maksimal_3_kali_dalam_1_bulan]
