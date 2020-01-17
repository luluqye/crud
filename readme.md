INTRODUCTION
------------

Prorgam ini merupakan contoh sederhana penggunaan CRUD menggunakan laravel, baik dengan menggunakan database maupun file.

REQUIREMENT
------------

modul yang dibutuhkan yaitu:

 * PHP 7 keatas
 * Mysql DB
 * Git


Setup
------------

Gunakan Command untuk melakukan langkah sebagai berikut:
 * Ambil file project dari github dengan perintah :
`git clone https://github.com/luluqye/crud.git`
 * Install Composer (https://getcomposer.org) 
`composer install`
 
Konfigurasi
------------
Adapun langkah konfigurasinya adalah sebagai berikut :
#### Konfigurasi Database
* Install mysql atau database yang lainnya dan buat database dengan nama **crud**.
* Jalankan perintah  `php artisan migrate` untuk generate tabel.
* Jalankan perintah `php artisan db:seed`.
#### Konfigurasi File
* Jalankan perintah `php artisan storage:link` untuk mempublikasi folder penyimpanan/storage ke public.
* Edit file **.env** dan sesuaikan dengan konfigurasi baik database maupun konfigurasi yang lainnya.

Running Applikasi
------------
 * Gunakan perintah sebagai berikut :
 `php artisan serve --port=(port)`
