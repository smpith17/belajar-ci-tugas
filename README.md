# 📦 Aplikasi Toko Online - UAS Pemrograman Web Lanjut

Aplikasi ini merupakan hasil modifikasi dari project CodeIgniter 4 yang dikembangkan untuk memenuhi Ujian Akhir Semester (UAS) mata kuliah **Pemrograman Web Lanjut - A11.4410**.  
Aplikasi menyediakan berbagai fitur toko online, termasuk sistem diskon otomatis, checkout dengan ongkir (API RajaOngkir), dan dashboard web service berbasis REST API.

---

## 🧩 Fitur yang Telah Diimplementasikan

### ✅ Otentikasi Pengguna
- Login & logout
- Role-based access (admin & user)
- Validasi username dan password saat login

### ✅ Produk & Kategori
- CRUD produk lengkap
- Upload dan ubah gambar produk
- Manajemen kategori produk

### ✅ Keranjang & Transaksi
- Tambah, ubah, dan hapus produk dari keranjang
- Checkout dengan API ongkir (RajaOngkir)
- Simpan transaksi ke database dengan detail produk
- Sistem subtotal otomatis berdasarkan jumlah dan harga

### ✅ Diskon Otomatis
- Diskon otomatis diterapkan berdasarkan tanggal login
- Diskon tersimpan di session dan digunakan saat:
  - Menambahkan produk ke keranjang
  - Menyimpan transaksi ke database

### ✅ Dashboard Web Service
- Tampilkan seluruh data transaksi melalui API
- Gunakan `cURL` untuk mengambil data transaksi
- Hitung dan tampilkan **jumlah item per transaksi**
- Tampil dalam antarmuka yang responsif dengan Bootstrap

---

## 💡 Kelebihan Aplikasi

- Menggunakan framework **CodeIgniter 4** yang ringan dan terstruktur
- Integrasi dengan API eksternal (RajaOngkir) untuk estimasi ongkir
- RESTful API endpoint untuk keperluan integrasi / dashboard
- Dashboard terpisah dapat disalin dan di-deploy di folder `public/`
- Validasi sisi server dan flash message yang informatif
- Proses checkout memperhitungkan **harga diskon per tanggal**

---

## 🛠 Teknologi yang Digunakan

- PHP 8.1
- CodeIgniter 4
- MySQL/MariaDB
- Bootstrap 5
- RajaOngkir API
- GuzzleHttp (untuk panggil ongkir)
- cURL (untuk dashboard web service)

---

## 🗂 Struktur Folder Penting

belajar-ci/
├── app/
│ ├── Controllers/
│ ├── Models/
│ └── Views/
├── public/
│ ├── index.php
│ └── dashboard-toko/ <-- Dashboard Web Service (soal 4)
├── writable/
└── README.md <-- Dokumentasi ini


---

## 🔐 Data Pengguna untuk Login

| Role  | Username  | Password  |
|-------|-----------|-----------|
| Admin | yobbyazr  | 1234567   |
| Guest | mrajasa   | 1234567   |

---

## 🚀 Cara Menjalankan Aplikasi

    - urutan: 1
      judul: Clone Repository
      perintah: git clone https://github.com/namakamu/project-toko.git
      keterangan: Unduh source code dari GitHub ke local storage.

    - urutan: 2
      judul: Import Database
      tools: phpMyAdmin / XAMPP / Laragon
      
      tindakan:
        - Buat database baru (misal: db_ci_toko)
        - Import file db_ci_toko.sql dari folder project

    - urutan: 3
      judul: Konfigurasi File .env
      file: .env
      
      contoh_pengaturan:
        CI_ENVIRONMENT: development
        app.baseURL: 'http://localhost:8080/'
        database.default.hostname: localhost
        database.default.database: db_ci_toko
        database.default.username: root
        database.default.password: ''
        database.default.DBDriver: MySQLi
      
      catatan: |
        Jika file .env belum tersedia, salin dari .env.example
        dan sesuaikan konfigurasi database sesuai lokal Anda.

    - urutan: 4
      judul: Jalankan Server Lokal
      perintah: php spark serve
      hasil: |
        Server CodeIgniter akan berjalan di http://localhost:8080
        Pastikan tidak ada port yang bentrok

    - urutan: 5
      judul: Akses Aplikasi di Browser
      
      url:
        aplikasi_utama: http://localhost:8080/
        dashboard_webservice: http://localhost/dashboard-toko/
      
      catatan: |
        Pastikan folder dashboard-toko sudah disalin ke dalam folder public/
        agar bisa diakses via browser.

    - urutan: 6
      judul: Informasi Login (Testing)
      
      akun:
        - role: Admin
          username: yobbyazr
          password: 1234567
        - role: User/Guest
          username: mrajasa
          password: 1234567
