<!-- SIS-RME Animated README -->

<p align="center">
  <img src="https://readme-typing-svg.demolab.com?font=Fira+Code&pause=900&color=3BAFDA&center=true&vCenter=true&width=500&lines=Selamat+Datang+di+SIS-RME!;Sistem+Rekam+Medis+Elektronik+Berbasis+Laravel;Praktis%2C+Aman%2C+dan+Modern" alt="Animated Welcome" />
</p>

<h1 align="center">
  🩺 Sistem Rekam Medis Elektronik (SIS-RME)
</h1>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-red?style=for-the-badge" alt="Laravel Version">
  <img src="https://img.shields.io/badge/PHP-8.1+-blue?style=for-the-badge" alt="PHP Version">
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License">
</p>

<p align="center">
  <!-- Medical GIF -->
  <img src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExdThsMDJ6emZ5b3ZheXRyN2NuZ3NoN2o2Ym1hdGJra3d5Z2E2dGVyMiZlcD12MV9naWZzX3NlYXJjaCZjdD1n/3oz8xKaR836UJOYeOc/giphy.gif" width="170" alt="Medical Animation"/>
  <!-- Dog Animation -->
  <img src="https://media.giphy.com/media/1kkxWqT5nvLXupUTwK/giphy.gif" width="140" alt="Dog Animation"/>
  <!-- Heartbeat Animation -->
  <img src="https://media.giphy.com/media/5VKbvrjxpVJCM/giphy.gif" width="110" alt="Heartbeat Animation"/>
</p>

---

## ✨ Tentang SIS-RME

**SIS-RME** adalah aplikasi web modern untuk mengelola data rekam medis pasien secara digital.  
Aplikasi ini memudahkan tenaga medis untuk mencatat, menyimpan, dan mengakses data pasien kapan saja dengan aman dan efisien.

---

## 🚀 Fitur Unggulan

- **👤 Manajemen Pasien:**  
  Pendaftaran, pencarian, dan pengelolaan data pasien secara terpusat dan mudah.
- **📋 Rekam Medis Elektronik:**  
  Pencatatan riwayat pemeriksaan, diagnosis, resep obat, tindakan medis, dan pengobatan yang terintegrasi.
- **👨‍⚕️ Manajemen Dokter dan Tenaga Medis:**  
  Registrasi, pengelolaan akun, serta monitoring aktivitas dokter dan perawat.
- **🏥 Manajemen Praktik & Jadwal:**  
  Pengaturan jadwal praktik dokter, jadwal kunjungan pasien, serta pengelolaan ruangan.
- **📄 Laporan Otomatis:**  
  Pembuatan serta pencetakan laporan pemeriksaan, laporan kunjungan, dan rekap data dalam format PDF.
- **🔒 Multi-Level Akses & Keamanan:**  
  Hak akses berdasarkan peran (admin, dokter, perawat, staf), serta proteksi data pasien sesuai standar keamanan.
- **📊 Dashboard Interaktif:**  
  Visualisasi data pasien, statistik kunjungan, grafik penyakit, dan laporan penting lainnya secara real-time.
- **🧾 Antrian Pasien Digital:**  
  Sistem antrian online yang memudahkan pengelolaan pasien harian.
- **💬 Notifikasi & Reminder:**  
  Notifikasi otomatis via email untuk jadwal kunjungan, pengingat kontrol, dan update status pasien.
- **🗂 Export/Import Data:**  
  Mendukung export (Excel, PDF) dan import data pasien atau rekam medis.
- **🌐 Multi Bahasa:**  
  Mendukung tampilan multi bahasa (Indonesia & Inggris).
- **🔗 Integrasi:**  
  Mudah diintegrasikan dengan sistem laboratorium, farmasi, atau sistem rumah sakit lain.

---

## 🛠️ Stack Teknologi

| Komponen      | Teknologi                |
| :------------ | :----------------------- |
| Backend       | Laravel 10.x             |
| Database      | MySQL                    |
| Frontend      | Blade, Tailwind CSS      |
| Autentikasi   | Laravel Breeze           |
| PDF           | DomPDF                   |
| Chart         | Chart.js                 |
| Notifikasi    | Laravel Notifications    |

---

## 🎯 Penggunaan SIS-RME

- Klinik dan praktek dokter pribadi
- Rumah sakit tipe C/D
- Puskesmas dan fasilitas kesehatan tingkat pertama
- Laboratorium kesehatan
- Klinik gigi, bidan, dan spesialis lain

---

## ⚙️ Persyaratan Sistem

- PHP **8.1** atau lebih tinggi
- Composer
- MySQL
- Web Server (Apache/Nginx)
- NodeJS & NPM (untuk development asset frontend)

---

## 🏗️ Cara Instalasi SIS-RME

> **Ikuti langkah berikut untuk instalasi:**

```shell
# 1. Clone repository
git clone https://github.com/fannass/sis_rme.git

# 2. Masuk ke direktori proyek
cd sis_rme

# 3. Install dependensi backend
composer install

# 4. Install dependensi frontend
npm install

# 5. Copy environment file
cp .env.example .env

# 6. Generate application key
php artisan key:generate

# 7. Konfigurasi database di file .env sesuai kebutuhan

# 8. Jalankan migrasi dan seeder untuk database
php artisan migrate --seed

# 9. Link storage
php artisan storage:link

# 10. Build asset frontend
npm run build

# 11. Jalankan server lokal
php artisan serve
```

**Akses aplikasi di browser:**  
[http://localhost:8000](http://localhost:8000)

---

## 🧑‍💻 Akun Default (Demo)

| Peran         | Email               | Password    |
| ------------- | ------------------- | ----------- |
| Administrator | admin@admin.com     | admin123    |
| Dokter        | budi@dokter.com     | dokter123   |

---

## 📁 Struktur Direktori Penting

```
├── app/Http/Controllers    # Controller aplikasi
├── app/Models              # Model database
├── database/migrations     # Skema basis data
├── database/seeders        # Data awal (seeder)
├── resources/views         # Template tampilan (Blade)
├── routes                  # Definisi rute aplikasi
├── public                  # Asset publik & logo
├── storage                 # File upload & dokumen
```

---

## 🤝 Cara Kontribusi

1. Fork repo ini
2. Buat branch fitur/bugfix baru
3. Commit perubahan kamu
4. Buka pull request
5. Tunggu review dari maintainer

Kontribusi sangat terbuka untuk fitur baru, perbaikan bug, maupun dokumentasi!

---

## ❓ FAQ

<details>
<summary>Apa aplikasi ini gratis?</summary>
Ya, SIS-RME open source dengan lisensi MIT.
</details>

<details>
<summary>Apakah bisa diinstall di shared hosting?</summary>
Bisa, selama memenuhi persyaratan sistem (PHP 8.1+, MySQL).
</details>

<details>
<summary>Apakah bisa custom fitur?</summary>
Tentu, silakan fork atau ajukan pull request untuk fitur tambahan.
</details>

<details>
<summary>Bagaimana cara reset password admin?</summary>
Gunakan fitur lupa password pada halaman login, atau ubah langsung di database.
</details>

<details>
<summary>Apakah aplikasi ini mendukung integrasi API eksternal?</summary>
Ya, SIS-RME mudah ditambahkan modul integrasi eksternal.
</details>

---

## 📄 Lisensi

Proyek ini menggunakan [MIT License](LICENSE).

---

<p align="center">
  <img src="https://readme-typing-svg.demolab.com?font=Fira+Code&pause=2000&color=F857A6&center=true&vCenter=true&width=430&lines=Developed+with+%E2%9D%A4%EF%B8%8F+by+fannass+%26+contributors" alt="Developed with Love" />
</p>
