# 🚀 Railway Deployment Guide - Pittel Moto Laravel

## 📋 Langkah-langkah Deploy ke Railway

### 1️⃣ Setup Railway Project

1. **Buka Railway Dashboard**
   - Pergi ke https://railway.app
   - Login dengan GitHub account Anda
   - Klik **"New Project"**

2. **Deploy from GitHub**
   - Pilih **"Deploy from GitHub repo"**
   - Pilih repository: `pittel-moto-laravel`
   - Railway akan otomatis detect Laravel project

### 2️⃣ Tambahkan MySQL Database

1. Di Railway dashboard, klik **"+ New"**
2. Pilih **"Database"** → **"Add MySQL"**
3. MySQL akan otomatis dibuat dan connected

### 3️⃣ Setup Environment Variables

Klik service Laravel Anda → **Variables** tab, tambahkan:

```env
APP_NAME="Pittel Moto"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app.railway.app

# Railway akan auto-generate DB credentials, tapi pastikan format benar:
DB_CONNECTION=mysql
DB_HOST=${MYSQL_HOST}
DB_PORT=${MYSQL_PORT}
DB_DATABASE=${MYSQL_DATABASE}
DB_USERNAME=${MYSQL_USER}
DB_PASSWORD=${MYSQL_PASSWORD}

# Generate key baru untuk production
APP_KEY=base64:GENERATE_NEW_KEY_DI_BAWAH

SESSION_DRIVER=cookie
SESSION_LIFETIME=120

CACHE_DRIVER=file
QUEUE_CONNECTION=sync
```

### 4️⃣ Generate APP_KEY

Di Railway Variables, tambahkan:
- Buka terminal lokal
- Jalankan: `php artisan key:generate --show`
- Copy hasilnya (contoh: `base64:xxxxx...`)
- Paste ke `APP_KEY` di Railway

ATAU gunakan Railway CLI:
```bash
php artisan key:generate --show
```

### 5️⃣ Connect Database Variables

Railway biasanya auto-connect, tapi pastikan:

1. Klik MySQL service → **Variables** tab
2. Copy variable names: `MYSQL_HOST`, `MYSQL_PORT`, dll
3. Di Laravel service variables, reference dengan `${MYSQL_HOST}` format

### 6️⃣ Deploy!

1. Klik **"Deploy"** atau Railway auto-deploy saat push ke GitHub
2. Tunggu build selesai (3-5 menit)
3. Klik **"Deployments"** → lihat logs
4. Setelah sukses, klik domain yang digenerate Railway

### 7️⃣ Setup Domain (Optional)

1. Klik **"Settings"** → **"Domains"**
2. Railway berikan domain gratis: `*.railway.app`
3. Atau tambahkan custom domain Anda

---

## 🔧 Troubleshooting

### Error: "APP_KEY not set"
```bash
# Generate key baru
php artisan key:generate --show
# Copy hasilnya ke Railway Variables → APP_KEY
```

### Error: Database connection failed
- Pastikan MySQL service running
- Check variable names: `${MYSQL_HOST}` (dengan ${ })
- Restart deployment

### Error: "Mix manifest not found"
```bash
# Jika pakai Vite/Mix, jalankan di local:
npm run build
# Commit hasil build dan push
```

### Migration error
- Railway auto-run migration via Procfile
- Cek logs: Railway dashboard → Deployments → View logs
- Manual migration: Railway CLI → `railway run php artisan migrate`

---

## 📱 Akses Aplikasi

Setelah deploy sukses:
- URL: `https://pittel-moto-laravel-production.railway.app` (atau nama lain)
- Admin login: gunakan data dari seeder Anda

---

## 🔄 Update Aplikasi

1. Edit code di local
2. Commit: `git add . && git commit -m "Update feature"`
3. Push: `git push origin main`
4. Railway auto-deploy! 🎉

---

## 💡 Tips

- **Free Tier**: Railway beri $5 credit/month (cukup untuk development)
- **Logs**: Selalu check logs jika ada error
- **Database Backup**: Export database secara berkala
- **Environment**: Jangan pernah commit `.env` ke Git!

---

## 📞 Support

Railway Docs: https://docs.railway.app
Railway Discord: https://discord.gg/railway
