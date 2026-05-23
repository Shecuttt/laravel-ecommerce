<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Laravel E-Commerce

Aplikasi e-commerce sederhana berbasis Laravel dengan fitur katalog produk, keranjang belanja, dan checkout. Proyek ini menggunakan Laravel 13, Filament, Breeze, Vite, serta database SQLite untuk pengembangan lokal.

## Fitur Utama

- Halaman beranda yang menampilkan kategori aktif dan produk terbaru
- Daftar produk dengan filter kategori dan pencarian
- Halaman detail produk dengan daftar produk terkait
- Keranjang belanja menggunakan session
- Checkout hanya untuk pengguna yang terautentikasi
- Pembuatan pesanan lengkap dengan item pesanan dan pengurangan stok produk
- Halaman dashboard pengguna untuk melihat riwayat pesanan
- Autentikasi akun melalui fitur standar Laravel Breeze

## Struktur Proyek

- `app/Http/Controllers/StorefrontController.php` - Logika toko, termasuk katalog, keranjang, checkout, dan pesanan
- `app/Models/Product.php` - Model produk dengan relasi kategori
- `app/Models/Category.php` - Model kategori
- `app/Models/Order.php` - Model pesanan dengan relasi item pesanan
- `routes/web.php` - Rute frontend utama untuk toko dan proses checkout
- `resources/views/storefront` - Tampilan untuk halaman toko, produk, keranjang, checkout, dan konfirmasi

## Penggunaan

- Buka `/` untuk melihat halaman awal toko
- Buka `/products` untuk melihat semua produk dan menggunakan filter
- Buka detail produk melalui `/product/{slug}`
- Tambahkan produk ke keranjang lalu buka `/cart`
- Login untuk mengakses `/checkout` dan menyelesaikan pesanan
- Setelah checkout, lihat konfirmasi pesanan di `/order-confirmation/{id}`
- Dashboard pengguna tersedia di `/dashboard`

## Teknologi yang Digunakan

- Laravel 13
- Filament
- Laravel Breeze
- Vite + Tailwind CSS
- Alpine.js
- SQLite (untuk pengembangan)
