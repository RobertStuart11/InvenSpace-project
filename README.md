# InvenSpace

Aplikasi manajemen peminjaman inventaris sekolah (barang, peminjaman, komplain, dan mutasi stok) dibangun dengan Laravel, mengikuti ERD `InvenBarang`.

## Struktur Basis Data

Project ini mengimplementasikan 7 tabel utama sesuai ERD:

| Tabel | Deskripsi |
|---|---|
| `roles` | Peran pengguna (admin, guru, siswa) |
| `users` | Pengguna sistem, dengan `kelas` (khusus siswa) dan `nip` (khusus guru) |
| `items` | Data barang inventaris |
| `loans` | Pengajuan peminjaman barang oleh siswa, divalidasi oleh guru |
| `loan_items` | Detail barang yang dipinjam per pengajuan peminjaman |
| `complaints` | Komplain siswa terkait barang/peminjaman |
| `stock_mutations` | Riwayat mutasi stok barang (masuk/keluar) |

## Requirement

- **PHP 8.3 atau lebih tinggi** (⚠️ XAMPP resmi untuk Windows saat ini hanya menyediakan sampai PHP 8.2 — lihat catatan di bawah)
- [Composer](https://getcomposer.org/)
- MySQL / MariaDB (bisa lewat XAMPP untuk servernya, database-nya saja)
- Node.js & npm (opsional, hanya jika ingin compile asset front-end)

### Catatan khusus pengguna XAMPP (Windows)

XAMPP untuk Windows saat ini paling tinggi menyediakan PHP 8.2.12, sedangkan project ini butuh PHP 8.3+. Solusinya:

1. Download PHP 8.3+ (Non Thread Safe, x64) dari https://windows.php.net/download/
2. Extract ke folder terpisah, misalnya `C:\Php83`
3. Copy `php.ini-development` menjadi `php.ini` di folder yang sama
4. Di `php.ini`, aktifkan (hapus `;` di depan) baris berikut:
   ```
   extension=curl
   extension=fileinfo
   extension=mbstring
   extension=openssl
   extension=pdo_mysql
   extension=zip
   ```
5. Set `extension_dir` ke path absolut, misalnya:
   ```
   extension_dir = "C:\Php83\ext"
   ```
6. Gunakan `C:\Php83\php.exe` untuk menjalankan composer dan `artisan` (lihat langkah instalasi di bawah). MySQL dari XAMPP tetap dipakai seperti biasa — cukup pastikan service **MySQL** running di XAMPP Control Panel. Apache XAMPP tidak diperlukan karena project ini dijalankan lewat `artisan serve`, bukan lewat virtual host Apache.

## Instalasi

1. **Clone repository**
   ```
   git clone https://github.com/RobertStuart11/InvenSpace-project.git
   cd InvenSpace-project
   ```

2. **Install dependency PHP**
   ```
   composer install
   ```
   (pengguna XAMPP: `C:\Php83\php.exe C:\ProgramData\ComposerSetup\bin\composer.phar install`)

3. **Salin file environment**
   ```
   copy .env.example .env
   ```
   (Linux/Mac: `cp .env.example .env`)

4. **Buat database**
   Buat database baru bernama `InvenSpace` lewat phpMyAdmin atau MySQL CLI. Sesuaikan kredensial di `.env` bila perlu (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

5. **Generate application key**
   ```
   php artisan key:generate
   ```

6. **Jalankan migration & seeder**
   ```
   php artisan migrate --seed
   ```
   Ini akan membuat semua tabel dan mengisi 3 data pengguna contoh (admin, guru, siswa) dengan password default `password`.

7. **Jalankan server development**
   ```
   php artisan serve
   ```
   Buka `http://127.0.0.1:8000` di browser.

## Akun Contoh (dari Seeder)

| Username | Role | Password |
|---|---|---|
| `admin` | admin | `password` |
| `budiguru` | guru | `password` |
| `sitisiswa` | siswa | `password` |

## Lisensi

Project ini dibangun di atas kerangka [Laravel](https://laravel.com), open-source dengan lisensi [MIT](https://opensource.org/licenses/MIT).
