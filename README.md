# Website Pengukuran Kualitas Layanan

Selamat datang di repositori **Website Pengukuran Kualitas Layanan**! Proyek ini adalah aplikasi web yang dirancang untuk mengukur dan menganalisis kualitas layanan yang diberikan oleh perusahaan atau organisasi.

## Fitur Utama

- **Formulir Penilaian:** Pengguna dapat memberikan penilaian tentang berbagai aspek layanan.
- **Dashboard Analisis:** Tampilkan hasil penilaian dalam bentuk grafik dan laporan.
- **Pengelolaan Data:** Kemampuan untuk menambahkan, mengedit, dan menghapus data penilaian.
- **Autentikasi Pengguna:** Sistem login untuk mengamankan akses ke fitur admin.

## Prasyarat

Sebelum menjalankan proyek ini, pastikan Anda telah menginstal:

- [Xampp](https://www.apachefriends.org/download.html (versi terbaru disarankan)

## Instalasi

Ikuti langkah-langkah berikut untuk menginstal dan menjalankan aplikasi:

1. **Clone Repositori:**

   ```bash
   git clone https://github.com/username/repository-name.git
   cd repository-name
2. **Download Zip**
   pilih download zip

3. **Import Database:**
   Jalankan Apache dan Mysql, buka phpmyadmin lalu create database kemudian import database
4. **Sesuaikan file koneksi.php:**
  seting kembali koneksi sesuai dengan nama database yang telah anda buat seperti dibawah ini
 
  ```bash
  host = 'localhost';
  $user = 'root';
  $password = '';
  $database = DB_NAME;
