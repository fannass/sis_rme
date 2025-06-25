# Sistem Rekam Medis Elektronik (SIS-RME)

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-red" alt="Laravel Version">
  <img src="https://img.shields.io/badge/PHP-8.1+-blue" alt="PHP Version">
  <img src="https://img.shields.io/badge/License-MIT-green" alt="License">
</p>

## Tentang Aplikasi

Sistem Rekam Medis Elektronik (SIS-RME) adalah aplikasi berbasis web yang dirancang untuk mengelola data rekam medis pasien secara elektronik. Aplikasi ini memungkinkan dokter dan staf medis untuk mencatat, menyimpan, dan mengakses informasi medis pasien dengan mudah, cepat, dan aman.

Sistem ini dikembangkan menggunakan framework Laravel dan dirancang untuk membantu praktik dokter, klinik, dan fasilitas kesehatan dalam mengelola rekam medis pasien dan meningkatkan efisiensi pelayanan kesehatan.

## Fitur Utama

- **Manajemen Pasien**: Pendaftaran, pencarian, dan pengelolaan data pasien
- **Rekam Medis**: Pencatatan riwayat pemeriksaan, diagnosis, dan pengobatan
- **Manajemen Dokter**: Pendaftaran dan pengelolaan akun dokter
- **Manajemen Praktik**: Pengaturan jadwal dan informasi tempat praktik
- **Laporan**: Pembuatan dan pencetakan laporan pemeriksaan dalam format PDF
- **Multi-level Akses**: Pembagian hak akses sesuai peran (admin, dokter)
- **Keamanan Data**: Perlindungan data pasien sesuai standar keamanan

## Teknologi

- **Framework**: Laravel 10.x
- **Database**: MySQL
- **Frontend**: Blade Template, Tailwind CSS
- **Autentikasi**: Laravel Breeze
- **PDF Generation**: DomPDF

## Persyaratan Sistem

- PHP 8.1 atau lebih tinggi
- Composer
- MySQL Database
- Web Server (Apache/Nginx)

## Instalasi

1. Clone repositori:
   ```bash
   git clone https://github.com/fannass/sis_rme.git
   ```

2. Masuk ke direktori proyek:
   ```bash
   cd sis_rme
   ```

3. Install dependensi PHP:
   ```bash
   composer install
   ```

4. Salin file .env.example menjadi .env:
   ```bash
   cp .env.example .env
   ```

5. Generate application key:
   ```bash
   php artisan key:generate
   ```

6. Konfigurasi database di file .env

7. Jalankan migrasi dan seeder:
   ```bash
   php artisan migrate --seed
   ```

8. Link storage:
   ```bash
   php artisan storage:link
   ```

9. Jalankan server:
   ```bash
   php artisan serve
   ```

10. Akses aplikasi melalui browser: `http://localhost:8000`

## Akun Default

### Administrator
- Email: admin@admin.com
- Password: admin123

### Dokter
- Email: budi@dokter.com
- Password: dokter123

## Struktur Aplikasi

- **/app/Http/Controllers**: Controller untuk logika aplikasi
- **/app/Models**: Model untuk interaksi dengan database
- **/database/migrations**: Skema database
- **/database/seeders**: Data awal untuk database
- **/resources/views**: Template tampilan (Blade)
- **/routes**: Definisi rute aplikasi

## Kontributor

- Fauzan 

## Lisensi

Sistem Rekam Medis Elektronik (SIS-RME) adalah perangkat lunak open-source yang dilisensikan di bawah [Lisensi MIT](https://opensource.org/licenses/MIT).
