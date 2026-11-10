# 🛒 Nusantara Shop

Aplikasi e-commerce bergaya Tokopedia/Shopee, dibangun dengan **Laravel 13** + **SQLite**.

## ✨ Fitur

### Pembeli
- 📦 Katalog produk dengan **pencarian, filter kategori, dan sorting** (harga, terbaru)
- 🔍 Detail produk lengkap dengan **ulasan (reviews)** dari pembeli lain
- 🛒 Keranjang belanja (session-based) dengan anti-oversell (`lockForUpdate` + DB transaction)
- 💳 Checkout → invoice otomatis format `INV-YYYYMMDD-XXXXXX`
- 📋 Riwayat pesanan dengan status: pending → paid → processing → shipped → completed → cancelled
- ❤️ Wishlist produk
- 🔐 Autentikasi (Laravel Breeze): register, login, logout

### Admin
- 📊 Dashboard ringkasan (order, pendapatan, produk)
- 📝 CRUD produk (nama, slug, harga, diskon, stok, kategori)
- 🗂️ Manajemen kategori
- 🚚 Manajemen pesanan (ubah status pengiriman)

## 🛠️ Teknologi

| Komponen | Keterangan |
|---|---|
| Laravel 13.40 | Framework utama |
| Laravel Breeze | Autentikasi |
| SQLite | Database |
| Tailwind CSS | Styling (bawaan Breeze) |
| PHP 8.3 | Runtime |

## 🚀 Instalasi

```bash
git clone git@github.com:riki-rg/nusantara-shop.git
cd nusantara-shop
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

Buka `http://localhost:8000`.

## 👤 Akun

| Role | Akses |
|---|---|
| Admin | Panel admin di `/admin` (user dengan `is_admin = true`) |
| Pembeli | Register langsung dari halaman utama |

## 📁 Struktur Penting

```
app/Http/Controllers/
├── CatalogController.php    # katalog, search, filter, sort
├── CartController.php       # keranjang session
├── CheckoutController.php   # checkout + invoice
├── OrderController.php      # riwayat pesanan
├── ReviewController.php     # ulasan produk
├── WishlistController.php   # wishlist
└── Admin/                   # dashboard, produk, order, kategori
```

Harga disimpan sebagai `price_cents` (integer) untuk menghindari floating-point error, ditampilkan dalam Rupiah.

## 📄 License

MIT
