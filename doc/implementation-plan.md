# 📋 Rencana Implementasi PUD-MTIC

**Portal Ujian Digital MTI Canduang**

---

## Overview

Dokumen ini berisi rencana implementasi berdasarkan master plan di `rmd.md`. Project menggunakan:
- **CodeIgniter 4** (PHP 8.2+)
- **Tailwind CSS**
- **MySQL Database**
- **Google Forms** untuk engine soal
- **Google Apps Script** untuk webhook nilai

---

## Fase 1: Setup Environment & Database

### Task 1.1 - Setup Project CodeIgniter
| No | Task | Lokasi | Estimasi |
|----|------|--------|----------|
| 1.1.1 | Buat folder `pud-mtic` di `htdocs` | `C:\xampp\htdocs\pud-mtic\` | - |
| 1.1.2 | Install CodeIgniter 4 via Composer | Terminal | 10 menit |
| 1.1.3 | Konfigurasi base URL di `.env` | `app/Config/App.php` | 5 menit |

### Task 1.2 - Setup Database
| No | Task | Lokasi | Estimasi |
|----|------|--------|----------|
| 1.2.1 | Buat database `db_pudmtic` | phpMyAdmin | 5 menit |
| 1.2.2 | Jalankan Migration | `php spark migrate` | 10 menit |
| 1.2.3 | Jalankan Seeder | `php spark db:seed MtiMapelSeeder` dll | 10 menit |

### Task 1.3 - Migration Files (Sudah Dibuat)
| File | Tabel |
|------|-------|
| `app/Database/Migrations/2026-02-24-001-CreateMtiUsersTable.php` | mti_users |
| `app/Database/Migrations/2026-02-24-002-CreateMtiMapelTable.php` | mti_mapel |
| `app/Database/Migrations/2026-02-24-003-CreateMtiJadwalTable.php` | mti_jadwal |
| `app/Database/Migrations/2026-02-24-004-CreateMtiLogUjianTable.php` | mti_log_ujian |
| `app/Database/Migrations/2026-02-24-005-CreateMtiLogPelanggaranTable.php` | mti_log_pelanggaran |

### Task 1.4 - Seeder Files (Sudah Dibuat)
| File | Data |
|------|------|
| `app/Database/Seeds/MtiMapelSeeder.php` | 5 mata pelajaran |
| `app/Database/Seeds/MtiUserSeeder.php` | 1 admin + 20 siswa |
| `app/Database/Seeds/MtiJadwalSeeder.php` | 3 jadwal ujian |
| `app/Database/Seeds/MtiLogUjianSeeder.php` | 7 log + 3 pelanggaran |

### Cara Menjalankan Migration & Seeder
```bash
# 1. Buat database db_pudmtic di phpMyAdmin

# 2. Konfigurasi .env untuk koneksi database
# database.default.dbname = db_pudmtic

# 3. Jalankan migration
php spark migrate

# 4. Jalankan seeder (urutan penting!)
php spark db:seed MtiMapelSeeder
php spark db:seed MtiUserSeeder
php spark db:seed MtiJadwalSeeder
php spark db:seed MtiLogUjianSeeder
```

### Akun Testing ( dari Seeder )
| Role | Username | Password |
|------|----------|----------|
| Admin | admin001 | admin123 |
| Santri | 123001 | password123 |

---

## Struktur Tabel Database

```sql
-- Table: mti_users (Santri & Admin)
CREATE TABLE mti_users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    kelas VARCHAR(20),
    role ENUM('admin', 'santri') DEFAULT 'santri',
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table: mti_mapel (Mata Pelajaran)
CREATE TABLE mti_mapel (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama_mapel VARCHAR(100) NOT NULL,
    ustadz_pengampu VARCHAR(100),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table: mti_jadwal (Jadwal Ujian)
CREATE TABLE mti_jadwal (
    id INT PRIMARY KEY AUTO_INCREMENT,
    mapel_id INT NOT NULL,
    link_gform VARCHAR(500) NOT NULL,
    tgl_ujian DATE NOT NULL,
    jam_mulai TIME NOT NULL,
    jam_selesai TIME NOT NULL,
    token VARCHAR(20) NOT NULL,
    status_publish_nilai TINYINT(1) DEFAULT 0,
    status_ujian ENUM('draft', 'aktif', 'selesai') DEFAULT 'draft',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (mapel_id) REFERENCES mti_mapel(id)
);

-- Table: mti_log_ujian (Log Pelaksanaan Ujian)
CREATE TABLE mti_log_ujian (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    jadwal_id INT NOT NULL,
    jam_masuk DATETIME,
    jam_selesai DATETIME,
    nilai_akhir FLOAT NULL,
    jumlah_pelanggaran INT DEFAULT 0,
    is_submit TINYINT(1) DEFAULT 0,
    status ENUM('waiting', 'mengerjakan', 'selesai') DEFAULT 'waiting',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES mti_users(id),
    FOREIGN KEY (jadwal_id) REFERENCES mti_jadwal(id)
);

-- Table: mti_log_pelanggaran (Cheat Detection)
CREATE TABLE mti_log_pelanggaran (
    id INT PRIMARY KEY AUTO_INCREMENT,
    log_ujian_id INT NOT NULL,
    jenis_pelanggaran VARCHAR(100),
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (log_ujian_id) REFERENCES mti_log_ujian(id)
);
```

---

## Fase 2: Backend - Auth & Manajemen Data

### Task 2.1 - Sistem Autentikasi
| No | Task | Endpoint/File | Estimasi |
|----|------|---------------|----------|
| 2.1.1 | Setup Session Auth | `app/Controllers/Auth.php` | 30 menit |
| 2.1.2 | Halaman Login | `app/Views/auth/login.php` | 20 menit |
| 2.1.3 | Logout & Session Destroy | `Auth::logout()` | 5 menit |

### Task 2.2 - Manajemen Santri
| No | Task | Endpoint/File | Estimasi |
|----|------|---------------|----------|
| 2.2.1 | CRUD Daftar Santri | `app/Controllers/Admin/Santri.php` | 45 menit |
| 2.2.2 | Import Data Santri (CSV) | `Admin/Santri::import()` | 30 menit |
| 2.2.3 | Edit/Hapus Santri | `Admin/Santri::edit(), ::delete()` | 20 menit |

### Task 2.3 - Manajemen Mata Pelajaran
| No | Task | Endpoint/File | Estimasi |
|----|------|---------------|----------|
| 2.3.1 | CRUD Mata Pelajaran | `app/Controllers/Admin/Mapel.php` | 30 menit |
| 2.3.2 | Tambah/Edit/Delete Mapel | `Mapel::create(), ::update(), ::delete()` | 20 menit |

### Task 2.4 - Manajemen Jadwal Ujian
| No | Task | Endpoint/File | Estimasi |
|----|------|---------------|----------|
| 2.4.1 | CRUD Jadwal | `app/Controllers/Admin/Jadwal.php` | 45 menit |
| 2.4.2 | Generate Token Otomatis | Helper `generate_token()` | 10 menit |
| 2.4.3 | Validasi Link Google Form | Validasi format URL | 10 menit |

---

## Fase 3: Frontend - Dashboard Santri

### Task 3.1 - Setup Tailwind CSS
| No | Task | Estimasi |
|----|------|----------|
| 3.1.1 | Install Tailwind via NPM | 15 menit |
| 3.1.2 | Konfigurasi `tailwind.config.js` | 10 menit |
| 3.1.3 | Buat layout utama dengan component | 20 menit |

### Task 3.2 - Halaman Login Santri
| No | Task | File | Estimasi |
|----|------|------|----------|
| 3.2.1 | Form Login (NIS + Password) | `app/Views/santri/login.php` | 15 menit |
| 3.2.2 | Validasi input & error handling | `Auth::login()` | 10 menit |
| 3.2.3 | Styling dengan Tailwind | Primary: emerald-800 | 10 menit |

### Task 3.3 - Dashboard Jadwal Santri
| No | Task | File | Estimasi |
|----|------|------|----------|
| 3.3.1 | Tampilkan kartu ujian | `app/Views/santri/dashboard.php` | 30 menit |
| 3.3.2 | Status indicator (Aktif/Belum) | AJAX polling 30 detik | 20 menit |
| 3.3.3 | Empty state (Tidak ada ujian) | Tampilan rapi | 10 menit |

### Task 3.4 - Ruang Ujian (Exam Room)
| No | Task | File | Estimasi |
|----|------|------|----------|
| 3.4.1 | Mode Fullscreen | JavaScript Fullscreen API | 15 menit |
| 3.4.2 | Sticky Timer (Hitung mundur) | `app/Views/santri/exam.php` | 30 menit |
| 3.4.3 | Embed Google Form (Iframe) | Responsive iframe | 20 menit |
| 3.4.4 | Konfirmasi Selesai (Portal) | Tombol submit final | 15 menit |

### Task 3.5 - Cheat Detection (Blur Detection)
| No | Task | File | Estimasi |
|----|------|------|----------|
| 3.5.1 | Detect visibility change | `$(document).on('visibilitychange')` | 20 menit |
| 3.5.2 | Detect window blur | `$(window).on('blur')` | 15 menit |
| 3.5.3 | Kirim log ke server via AJAX | `Api::log_pelanggaran()` | 20 menit |
| 3.5.4 | Alert modal (Peringatan) | Modal popup | 10 menit |

---

## Fase 4: Backend - Monitoring Admin

### Task 4.1 - API Webhook Nilai
| No | Task | Endpoint | Estimasi |
|----|------|----------|----------|
| 4.1.1 | Buat endpoint `/api/update_nilai` | `app/Controllers/Api/Nilai.php` | 30 menit |
| 4.1.2 | Validasi data dari Google Sheets | Check NIS, jadwal_id | 15 menit |
| 4.1.3 | Update nilai di `mti_log_ujian` | Update query | 10 menit |
| 4.1.4 | Response JSON | Success/Error | 5 menit |

### Task 4.2 - Monitoring Real-time
| No | Task | File | Estimasi |
|----|------|------|----------|
| 4.2.1 | Tabel Monitoring | `app/Views/admin/monitoring.php` | 30 menit |
| 4.2.2 | AJAX polling (10-30 detik) | Auto-refresh data | 20 menit |
| 4.2.3 | Status indicator (Warna) | Kuning/Biru/Hijau/Merah | 15 menit |

### Task 4.3 - Live Score Feed
| No | Task | File | Estimasi |
|----|------|------|----------|
| 4.3.1 | Tampilkan nilai langsung | Kolom `nilai_akhir` | 15 menit |
| 4.3.2 | Update otomatis via polling | AJAX | 10 menit |

### Task 4.4 - Fitur Admin Lainnya
| No | Task | File | Estimasi |
|----|------|------|----------|
| 4.4.1 | Reset Session Santri | `Admin::reset_session()` | 20 menit |
| 4.4.2 | Log Pelanggaran | `app/Views/admin/pelanggaran.php` | 20 menit |
| 4.4.3 | Publish Nilai | Toggle `status_publish_nilai` | 15 menit |
| 4.4.4 | Kill Switch (Emergency Stop) | Matikan akses ujian | 15 menit |

### Task 4.5 - Export & Laporan
| No | Task | File | Estimasi |
|----|------|------|----------|
| 4.5.1 | Export Excel (XLSX) | `PhpSpreadsheet` atau `PHPExcel` | 30 menit |
| 4.5.2 | Rekap Kehadiran | Filter tanggal & mapel | 20 menit |

---

## Fase 5: Testing & Deployment

### Task 5.1 - Testing
| No | Task | Deskripsi | Estimasi |
|----|------|-----------|----------|
| 5.1.1 | Unit Testing | Test setiap function/controller | 1 jam |
| 5.1.2 | Integration Testing | Test alur lengkap | 1 jam |
| 5.1.3 | Stress Test | Simulasi banyak user | 2 jam |

### Task 5.2 - Google Apps Script Integration
| No | Task | Deskripsi | Estimasi |
|----|------|-----------|----------|
| 5.2.1 | Buat Google Apps Script | Script untuk webhook | 30 menit |
| 5.2.2 | Deploy sebagai Web App | Get URL endpoint | 15 menit |
| 5.2.3 | Test Kirim Data | Simulasi submit form | 20 menit |

### Task 5.3 - Deployment
| No | Task | Deskripsi | Estimasi |
|----|------|-----------|----------|
| 5.3.1 | Upload ke Server Production | Via FTP/cPanel | 30 menit |
| 5.3.2 | Konfigurasi Domain | `exam.mticanduang.sch.id` | 15 menit |
| 5.3.3 | Setup SSL/HTTPS | Let's Encrypt | 15 menit |

---

## Struktur Folder Project

```
pud-mtic/
├── app/
│   ├── Config/
│   │   ├── App.php
│   │   ├── Database.php
│   │   └── Routes.php
│   ├── Controllers/
│   │   ├── Auth.php
│   │   ├── Santri/
│   │   │   ├── Dashboard.php
│   │   │   └── Exam.php
│   │   ├── Admin/
│   │   │   ├── Dashboard.php
│   │   │   ├── Santri.php
│   │   │   ├── Mapel.php
│   │   │   ├── Jadwal.php
│   │   │   └── Monitoring.php
│   │   └── Api/
│   │       └── Nilai.php
│   ├── Models/
│   │   ├── UserModel.php
│   │   ├── MapelModel.php
│   │   ├── JadwalModel.php
│   │   └── LogUjianModel.php
│   ├── Views/
│   │   ├── layouts/
│   │   │   ├── admin.php
│   │   │   └── siswa.php
│   │   ├── auth/
│   │   │   └── login.php
│   │   ├── admin/
│   │   │   ├── dashboard.php
│   │   │   ├── santri.php
│   │   │   ├── sant
│   │   │   ├── mapel.php
│   │   │   ├── jadwal.php
│   │   │   └── monitoring.php
│   │   └── siswa/
│   │       ├── dashboard.php
│   │       ├── exam.php
│   │       └── result.php
├── public/
│   ├── assets/
│   │   ├── css/
│   │   └── js/
│   └── uploads/
├── vendor/
├── .env
└── spark
```

---

## Warna Tailwind CSS

| Warna | Class | Penggunaan |
|-------|-------|------------|
| Primary | `bg-emerald-800` | Header, tombol utama |
| Secondary | `bg-slate-100` | Background halaman |
| Accent | `bg-amber-500` | Timer, peringatan |
| Danger | `bg-red-600` | Tombol berbahaya, pelanggaran |
| Success | `bg-green-600` | Status selesai, berhasil |
| Warning | `bg-yellow-500` | Status menunggu |

---

## API Endpoints

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| POST | `/api/update_nilai` | Webhook dari Google Sheets |
| GET | `/api/monitoring` | Data monitoring real-time |
| POST | `/api/log_pelanggaran` | Catat pelanggaran |
| GET | `/api/jadwal/aktif` | Jadwal aktif saat ini |

---

## Catatan

- Untuk pengembangan lokal, akses: `http://localhost/pud-mtic/`
- Untuk Google Apps Script webhook, gunakan URL: `http://localhost/pud-mtic/api/update_nilai`
- Pastikan firewall mengizinkan akses dari Google Sheets

---

**Last Updated:** February 24, 2026

**Status:** Migration & Seeder files sudah dibuat
