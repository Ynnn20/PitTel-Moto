# Implementasi Sistem Role-Based User (Admin & Pelanggan)

## Fitur yang Ditambahkan

### 1. **Admin Role**
- Akses penuh ke semua fitur sistem
- Dapat mengelola: Servis, Motor, Pelanggan, Mekanik, Sparepart
- Melihat dashboard admin dengan statistik lengkap dan tabel data

### 2. **Pelanggan (Customer) Role**
- Hanya dapat melihat dashboard pribadi
- Melihat riwayat servis motor mereka sendiri
- Melakukan pembayaran untuk servis yang sudah selesai
- Melihat status pembayaran (Lunas/Belum Bayar)

## Perubahan Database

### Migration Files yang Ditambahkan:
1. `2025_12_12_add_role_to_users_table.php` - Menambah kolom `role` dan `pelanggan_id` ke tabel `users`
2. `2025_12_12_create_payments_table.php` - Membuat tabel `payments` untuk mencatat pembayaran

### Kolom Baru:
- **users**: `role` (admin/pelanggan), `pelanggan_id` (foreign key)
- **servis**: `paid` (boolean) - untuk menandai status pembayaran
- **payments**: Seluruh tabel baru untuk menyimpan data pembayaran

## File & Struktur yang Dibuat/Diubah

### Models:
- **User** - Ditambah: role(), isPelanggan(), isAdmin(), pelanggan relationship
- **Servis** - Ditambah: payment relationship, `paid` di fillable
- **Payment** (NEW) - Model untuk handle pembayaran

### Controllers:
- **DashboardController** - Diupdate untuk menampilkan dashboard berbeda per role
- **PaymentController** (NEW) - Handle proses pembayaran

### Middleware:
- **EnsureUserIsAdmin** (NEW) - Proteksi route admin
- **EnsureUserIsPelanggan** (NEW) - Proteksi route pelanggan

### Views:
- **dashboard/index.blade.php** - Admin dashboard (tidak berubah)
- **dashboard/customer.blade.php** (NEW) - Customer dashboard dengan riwayat servis
- **dashboard/customer-no-data.blade.php** (NEW) - Halaman jika customer belum terhubung
- **payment/receipt.blade.php** (NEW) - Bukti pembayaran
- **layouts/app.blade.php** - Navbar diupdate untuk menampilkan menu berdasarkan role

### Routes:
- **web.php** - Diupdate dengan middleware admin dan payment routes

## Cara Menggunakan

### Langkah 1: Jalankan Migration
```bash
php artisan migrate
```

### Langkah 2: Jalankan Seeder (Opsional)
```bash
php artisan db:seed --class=UserSeeder
```

Ini akan membuat:
- **Admin User**: 
  - Email: `admin@pittelmoto.com`
  - Password: `password`
  - Role: admin

- **Customer Users** (dari 3 pelanggan pertama):
  - Email: `pelanggan1@pittelmoto.com`, `pelanggan2@pittelmoto.com`, dst
  - Password: `password`
  - Role: pelanggan

### Langkah 3: Login dan Coba Fitur

#### Sebagai Admin:
1. Login dengan `admin@pittelmoto.com / password`
2. Akses semua fitur: Servis, Motor, Pelanggan, Mekanik, Sparepart
3. Lihat dashboard admin dengan statistik lengkap

#### Sebagai Pelanggan:
1. Login dengan `pelanggan1@pittelmoto.com / password`
2. Akses dashboard pelanggan
3. Lihat riwayat servis motor Anda
4. Klik tombol "💳 Bayar" untuk pembayaran servis yang sudah selesai
5. Pilih metode pembayaran (Tunai, Transfer, Kartu Kredit)
6. Konfirmasi pembayaran

## Fitur Detail

### Dashboard Admin
- Kartu statistik: Total Servis, Servis Selesai, Total Motor, Total Pelanggan
- Tabel 5 servis terbaru
- Tabel 5 motor terbaru
- Tabel 5 pelanggan terbaru
- Tabel sparepart dengan stok rendah (warning)
- Card management untuk setiap modul

### Dashboard Pelanggan
- Kartu statistik: Total Servis, Servis Selesai, Total Pembayaran, Pembayaran Lunas
- Tabel lengkap riwayat servis dengan status dan tombol pembayaran
- Modal dialog untuk proses pembayaran
- Informasi akun pribadi (nama, telepon, email)
- Status pembayaran per servis

### Sistem Pembayaran
- Modal popup untuk pilih metode pembayaran
- 3 metode: Tunai, Transfer Bank, Kartu Kredit
- Konfirmasi pembayaran
- Bukti pembayaran otomatis ditampilkan

## Navigasi Menu
- **Admin** melihat: Dashboard, Servis, Motor, Pelanggan, Mekanik, Spareparts
- **Pelanggan** hanya melihat: Dashboard + tombol Logout

## Keamanan
- Route admin dilindungi dengan middleware `admin`
- Route pelanggan dilindungi dengan middleware `pelanggan`
- Pelanggan hanya bisa melihat data servis mereka sendiri
- Pembayaran hanya dapat dilakukan untuk servis yang status-nya "selesai"

## Database Relationships
```
User (1) ──→ (N) Pelanggan
User (1) ──→ (1) Servis (via dashboard)
Servis (1) ──→ (1) Payment
Servis (1) ──→ (1) Pelanggan
Servis (1) ──→ (1) Motor
Servis (1) ──→ (1) Mekanik
```

## Testing Checklist
- [ ] Jalankan migration
- [ ] Jalankan seeder (atau login dengan akun existing)
- [ ] Login sebagai admin dan verifikasi akses penuh
- [ ] Login sebagai pelanggan dan verifikasi akses terbatas
- [ ] Test pembayaran dari dashboard pelanggan
- [ ] Verifikasi status pembayaran berubah ke "Lunas"
- [ ] Test navigasi menu berdasarkan role
