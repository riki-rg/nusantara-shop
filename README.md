# 🛒 Nusantara Shop

Aplikasi e-commerce bergaya Tokopedia/Shopee, dibangun dengan **Laravel 13** + **SQLite**.

## ✨ Fitur

### Pembeli
- 📦 Katalog produk dengan **pencarian, filter kategori, dan sorting** (harga, terbaru)
- 🖼️ Foto produk tampil di katalog & detail (fallback placeholder bila kosong)
- 🔍 Detail produk lengkap dengan **ulasan (reviews)** dari pembeli lain
- 🛒 Keranjang belanja (session-based) dengan anti-oversell (`lockForUpdate` + DB transaction)
- 💳 **Checkout + pembayaran Midtrans Snap** (QRIS, e-wallet, transfer bank, kartu)
- 🧾 Invoice otomatis format `INV-YYYYMMDD-XXXXXX`
- 📋 Riwayat pesanan dengan status: pending → paid → processing → shipped → completed → cancelled
- 🔔 **Notifikasi otomatis**: email, WhatsApp (Fonnte), & Telegram saat pesanan dibuat / status berubah
- ❤️ Wishlist produk
- 🔐 Login email/password (Laravel Breeze) atau **Login via Google** (Socialite)

### Admin
- 📊 Dashboard ringkasan (order, pendapatan, produk)
- 📝 CRUD produk — termasuk **upload foto** (jpg/png/webp/gif, maks 2MB, foto lama auto-dihapus)
- 🗂️ Manajemen kategori
- 🚚 Manajemen pesanan — ubah status memicu notifikasi email/WA/Telegram

## 🛠️ Teknologi

| Komponen | Keterangan |
|---|---|
| Laravel 13.40 | Framework utama |
| Laravel Breeze | Autentikasi email/password |
| Laravel Socialite | Login via Google OAuth |
| Midtrans Snap | Payment gateway |
| Fonnte API | Notifikasi WhatsApp |
| Telegram Bot API | Notifikasi Telegram |
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
php artisan storage:link
php artisan serve
```

Buka `http://localhost:8000`.

## ⚙️ Konfigurasi Opsional (.env)

Semua integrasi berjalan **graceful** — aplikasi tetap normal walau kredensial kosong.

```env
# Midtrans (https://dashboard.sandbox.midtrans.com)
MIDTRANS_SERVER_KEY=SB-Mid-server-xxx
MIDTRANS_CLIENT_KEY=SB-Mid-client-xxx
MIDTRANS_IS_PRODUCTION=false

# Login Google (https://console.cloud.google.com → OAuth Client ID)
# Redirect URI: http://localhost:8000/auth/google/callback
GOOGLE_CLIENT_ID=xxx.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=xxx

# WhatsApp via Fonnte (https://fonnte.com)
FONNTE_TOKEN=xxx

# Telegram (token dari @BotFather, chat_id dari @userinfobot)
TELEGRAM_BOT_TOKEN=xxx
TELEGRAM_CHAT_ID=xxx
```

Webhook Midtrans: `POST /payment/midtrans/webhook` (verifikasi signature sha512 + re-check ke API Midtrans).

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
├── CheckoutController.php   # checkout + invoice + notifikasi
├── OrderController.php      # riwayat pesanan
├── PaymentController.php    # Midtrans Snap + webhook
├── ReviewController.php     # ulasan produk
├── WishlistController.php   # wishlist
├── Auth/GoogleAuthController.php  # login via Google
└── Admin/                   # dashboard, produk (dgn upload foto), order, kategori

app/Services/
├── MidtransService.php      # Snap token + verifikasi transaksi
└── NotificationService.php  # Email + WhatsApp + Telegram
```

Harga disimpan sebagai `price_cents` (integer) untuk menghindari floating-point error, ditampilkan dalam Rupiah.

## 🧪 Testing

```bash
php artisan test
```

## 📄 License

MIT
