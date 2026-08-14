# ICL-ITATS — Career Intelligence Platform for University

[![ICL ITATS CI Pipeline](https://github.com/MasRizqi07/ICL-ITATS/actions/workflows/ci.yml/badge.svg)](https://github.com/MasRizqi07/ICL-ITATS/actions/workflows/ci.yml)

**Product:** ICL ITATS (Institutional Career Learning Platform)
**Competition:** GEMASTIK XIX 2026 — Software Development Division
**Tech Stack:** PHP 8.3+, Laravel 12.x/13.x, PostgreSQL / SQLite, Blade + Vanilla CSS / Tailwind CSS

---

## 📌 Ringkasan Produk

**ICL ITATS** membantu mahasiswa perguruan tinggi dalam menghubungkan target karier industri dengan standar kompetensi, penilaian mandiri (*self-assessment*), pengunggahan dan verifikasi bukti portofolio privat, analisis kesenjangan (*skill gap*), rencana aksi pengembangan diri (*development plan*), serta rekam jejak penilaian ulang berkala (*reassessment snapshot*) secara transparan dan terstruktur.

> [!NOTE]
> **Catatan Data Demo**: Seluruh data pengguna, instrumen asesmen, dan statistik pada repositori ini merupakan **data sintetis/demo** yang disusun khusus untuk prototype kompetensi GEMASTIK XIX 2026.

---

## 🚀 Fitur Utama & Keunggulan

1. **Pemetaan Target Karier & Kompetensi**: Menampilkan profil karier industri (contoh: *Fullstack Web Developer*, *DevOps Engineer*) beserta indikator kompetensi target.
2. **Asesmen Mandiri & Pengusulan Bukti**: Mahasiswa dapat mengerjakan asesmen mandiri dan mengunggah portofolio/sertifikat (berupa tautan URL maupun berkas privat PDF/JPG/PNG/ZIP max 10MB) untuk diverifikasi oleh Reviewer Dosen.
3. **Penyimpanan Berkas Privat (Private Storage)**: Berkas bukti disimpan secara privat di `storage/app/private/evidence` dan hanya dapat diunduh melalui endpoint otorisasi aman (`GET /evidence/{id}/download`) oleh pemilik berkas, reviewer, atau administrator.
4. **Analisis Skill Gap Server-Authoritative**: Mesin *scoring* di server menghitung selisih kemampuan dan memberikan penjelasan berbasis *rule versioning* `v1.0`.
5. **Human-in-the-Loop AI Supporting Layer**: AI berfungsi murni sebagai penunjang rekomendasi aktivitas belajar (*fallback layer*), bukan penentu skor atau keputusan karier.
6. **Reassessment Snapshot & Versioning**: Rekam jejak permanen nilai kompetensi mahasiswa (*before/after*) secara terversi dan tidak dapat diubah (*immutable snapshot*) setiap kali terjadi pembaruan bukti.
7. **Otorisasi Multi-Role Strict**: Pembatasan akses berbasis peran (`student`, `reviewer`, `admin`) di tingkat server via middleware `role:x`.

---

## 🔑 Akun Demo Pengujian

| Role | Email | Password | Hak Akses Utama |
| --- | --- | --- | --- |
| **Mahasiswa** | `student@itats.ac.id` | `password` | Workflow Asesmen, Skill Gap, Dev Plan, Upload Evidence |
| **Reviewer / Dosen** | `reviewer@itats.ac.id` | `password` | Portal Evaluasi & Verifikasi Bukti Mahasiswa |
| **Administrator** | `admin@itats.ac.id` | `password` | Manajemen Profil Karier & Pemetaan Kompetensi |

---

## 🛠️ Panduan Menjalankan Aplikasi Secara Lokal

### 1. Prasyarat Sistem
- PHP `^8.3` (atau PHP 8.5)
- Composer `^2.0`
- Node.js `^20` atau `^22` & npm `^10`
- SQLite / PostgreSQL

### 2. Langkah Instalasi & Konfigurasi

```bash
# 1. Clone repositori
git clone https://github.com/MasRizqi07/ICL-ITATS.git
cd ICL-ITATS

# 2. Instal dependensi PHP & Node.js
composer install
npm ci

# 3. Setup lingkungan .env
cp .env.example .env
php artisan key:generate

# 4. Migrasi & Seed Basis Data Sintetis
php artisan migrate:fresh --seed

# 5. Build aset frontend produksi (Vite)
npm run build

# 6. Menjalankan Server Lokal Development
php artisan serve
```

Aplikasi dapat diakses di browser melalui `http://127.0.0.1:8000`.

---

## 🧪 Pengujian Terotomatisasi (Automated Testing)

Jalankan seluruh test suite terotomatisasi (PHPUnit Feature & Unit Tests):

```bash
php artisan test
```

Test suite mencakup 45 pengujian terotomatisasi yang memverifikasi:
- Otorisasi rute multi-role dan pencegahan self-review oleh reviewer.
- Validasi instrumen asesmen, kelengkapan jawaban, dan dynamic `max_score`.
- Validasi berkas bukti (`required_without` antara URL dan file upload max 10MB) serta otorisasi unduh berkas privat.
- Alur transaksi atomic DB dan pembentukan *reassessment snapshot history*.
- Regression journey end-to-end dari mahasiswa hingga dosen reviewer.

---

© 2026 ICL ITATS — GEMASTIK XIX Software Development Competition.
