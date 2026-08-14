# ICL-ITATS - Career Intelligence Platform for University

**Product:** ICL ITATS  
**Competition:** GEMASTIK XIX 2026 - Software Development  
**Tech Stack:** PHP 8.5, Laravel Framework, PostgreSQL / SQLite, Tailwind CSS  

---

## 📌 Ringkasan Produk

**ICL ITATS** (Institutional Career Learning Platform) membantu mahasiswa menghubungkan target karier industri dengan standar kompetensi, penilaian mandiri, verifikasi bukti portofolio, analisis kesenjangan (*skill gap*), rencana aksi pengembangan diri, serta pencatatan *reassessment snapshot* secara transparan dan terstruktur.

---

## 🚀 Fitur Utama

1. **Pemetaan Target Karier & Kompetensi**: Menampilkan profil karier industri (contoh: *Fullstack Web Developer*, *DevOps Engineer*) beserta indikator kompetensi target.
2. **Asesmen Mandiri & Pengumpulan Bukti**: Mahasiswa dapat mengerjakan asesmen dan mengunggah portofolio/sertifikat untuk diverifikasi oleh Reviewer/Dosen.
3. **Analisis Skill Gap Server-Authoritative**: Mesin *scoring* menghitung selisih kemampuan dan memberikan penjelasan berbasis *rule versioning* `v1.0`.
4. **Rencana Aksi Pengembangan Diri**: Penyusunan tugas belajar dan rekomendasi aktivitas berbasis dukungan AI non-otoritatif (*Human in the Loop*).
5. **Reassessment Snapshot**: Rekam jejak permanen nilai kompetensi mahasiswa (*before/after*) setiap kali terjadi pembaruan bukti.
6. **Multi-Role Support**: Modul terpisah untuk Mahasiswa, Reviewer Dosen, dan Admin Institusi (dengan fitur *Quick Demo Login*).

---

## 🔑 Akun Demo Pengujian

| Role | Email | Password |
|---|---|---|
| **Mahasiswa** | `student@itats.ac.id` | `password` |
| **Reviewer / Dosen** | `reviewer@itats.ac.id` | `password` |
| **Administrator** | `admin@itats.ac.id` | `password` |

---

## 🛠️ Cara Menjalankan Secara Lokal

1. **Clone Repositori:**
   ```bash
   git clone https://github.com/MasRizqi07/ICL-ITATS.git
   cd ICL-ITATS
   ```

2. **Instal Dependensi & Konfigurasi:**
   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   ```

3. **Migrasi & Seed Basis Data:**
   ```bash
   php artisan migrate:fresh --seed
   ```

4. **Jalankan Server Development:**
   ```bash
   php artisan serve
   ```
   Buka browser di `http://127.0.0.1:8000`

5. **Menjalankan Test Suite:**
   ```bash
   php artisan test
   ```

---

© 2026 ICL ITATS — Gemastik XIX Software Development Competition.
