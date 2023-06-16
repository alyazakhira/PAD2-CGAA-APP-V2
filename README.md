## Website Simulasi CGAA
Website simulasi CGAA <i>(Certified Government Accounting Associate)</i> adalah platform berbasis web yang menyediakan paket ujian simulasi CGAA Daerah dan Pusat. Pengguna dapat menggunakan website ini untuk mengukur kemampuan pemahaman dan kesiapan dalam memnghadapi ujian CGAA asli. Semua soal yang disediakan dibuat semirip mungkin dengan soal ujian asli. 
<hr>
Repository ini merupakan <i>front-end</i> aplikasi CGAA yang dapat diakses secara langsung oleh pengguna. Data-data yang dibutuhkan oleh aplikasi ini disediakan oleh Project bagian API (https://github.com/Luthfia39/WebCGAA-API).
<hr>

Langkah-langkah penggunaan :
- Clone repository dengan menjalankan perintah `git clone https://github.com/Luthfia39/WebCGAA-APP`.
- Install project di komputer `composer install`.
- Buat file env untuk konfigurasi `copy .env.example .env`.
- Sesuaikan database dan koneksinya.
- Jalankan migrasi dengan `php artisan migrate --seed`.
- Jalankan server di port selain 8000, misalnya 8080 `php artisan serve --port=8080`.
- Jalankan API sesuai instruksi pada repository API.
- App telah berjalan.
