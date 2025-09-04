# Sistem Manajemen Rumah Sakit

Sistem manajemen rumah sakit berbasis web menggunakan Laravel 11 dengan fitur CRUD untuk mengelola data rumah sakit dan pasien.

## 📋 Fitur

- **Authentication System**
  - Login dengan username dan password
  - Session management
  - Middleware protection untuk halaman admin

- **Dashboard**
  - Statistik rumah sakit dan pasien
  - Overview data dalam bentuk cards dan tabel

- **CRUD Rumah Sakit**
  - Tambah, lihat, edit, hapus data rumah sakit
  - Validasi form lengkap
  - AJAX delete dengan konfirmasi

- **CRUD Pasien**
  - Tambah, lihat, edit, hapus data pasien
  - Relasi dengan tabel rumah sakit
  - Filter berdasarkan rumah sakit (AJAX)
  - AJAX delete dengan konfirmasi

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 11
- **Frontend**: Bootstrap 5.3, Font Awesome 6.0
- **Database**: MySQL
- **JavaScript**: Vanilla JS dengan AJAX

## 📦 Instalasi

### Prasyarat

Pastikan Anda memiliki:

- PHP >= 8.2
- Composer
- MySQL
- Node.js & NPM (opsional)

### Langkah Instalasi

Berikut adalah langkah instalasi project Sistem Manajemen Rumah Sakit

- **Clone repository**

```bash
    git clone https://github.com/LutfiyaAinurrahmanP/laravel_LutfiyaAinurrahmanP
    cd hospital-app
```

- **Install Dependencies**

```bash
    composer install
    npm install && npm run build
```

- **Salin file environment**

```bash
    cp .env.example .env
```

- **Generate application key**

```bash
    php artisan key:generate
```

- **Konfigurasi database**

```bash
    DB_DATABASE=hospital_app
    DB_USERNAME=root
    DB_PASSWORD=
```

- **Migrasi database**

```bash
    php artisan migrate --seed
```

- **Jalankan server**

```bash
    php artisan serve
```

- **Akses aplikasi**
   Buka browser dan masuk ke:

```bash
    http://127.0.0.1:8000
```
