@extends('layouts.guest')

@section('title', 'Pusat Bantuan & Panduan Pengguna - ICL ITATS')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16 space-y-12 animate-fade-in-up">

    <!-- Header Section with Search Bar -->
    <section class="text-center max-w-3xl mx-auto space-y-6">
        <div class="inline-flex items-center space-x-2 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 px-3.5 py-1.5 rounded-full text-xs font-bold border border-blue-200 dark:border-blue-800/60">
            <span class="material-symbols-outlined text-sm">help</span>
            <span>Knowledge Base & Panduan</span>
        </div>

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
            Pusat Bantuan & Panduan Pengguna
        </h1>

        <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed">
            Temukan panduan praktis, jawaban atas pertanyaan umum, dan standar operasional penggunaan platform ICL ITATS.
        </p>

        <!-- Search Input Box -->
        <div class="max-w-xl mx-auto relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                <span class="material-symbols-outlined text-xl">search</span>
            </div>
            <input type="text" id="faq-search" placeholder="Cari topik bantuan (misal: upload bukti, skor gap, asesmen)..."
                class="w-full pl-12 pr-4 py-3.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl text-xs font-medium text-slate-900 dark:text-white shadow-sm focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition">
        </div>
    </section>

    <!-- Quick Help Category Cards -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-line dark:border-slate-800 shadow-2xs hover-lift space-y-3">
            <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 flex items-center justify-center">
                <span class="material-symbols-outlined text-2xl">quiz</span>
            </div>
            <h3 class="font-bold text-slate-900 dark:text-white text-base">Asesmen Mandiri</h3>
            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                Panduan menjawab instrumen pertanyaan Likert scale dan interpretasi skor awal.
            </p>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-line dark:border-slate-800 shadow-2xs hover-lift space-y-3">
            <div class="w-12 h-12 rounded-xl bg-teal-50 dark:bg-teal-900/40 text-teal-600 dark:text-teal-400 flex items-center justify-center">
                <span class="material-symbols-outlined text-2xl">upload_file</span>
            </div>
            <h3 class="font-bold text-slate-900 dark:text-white text-base">Unggah Bukti (Evidence)</h3>
            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                Format berkas portofolio yang diterima, tautan repositori, dan verifikasi sertifikasi.
            </p>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-line dark:border-slate-800 shadow-2xs hover-lift space-y-3">
            <div class="w-12 h-12 rounded-xl bg-amber-50 dark:bg-amber-900/40 text-amber-600 dark:text-amber-400 flex items-center justify-center">
                <span class="material-symbols-outlined text-2xl">insights</span>
            </div>
            <h3 class="font-bold text-slate-900 dark:text-white text-base">Analisis Skill Gap</h3>
            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                Cara membaca grafik kesenjangan kompetensi dan menyusun rencana aktivitas.
            </p>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-line dark:border-slate-800 shadow-2xs hover-lift space-y-3">
            <div class="w-12 h-12 rounded-xl bg-purple-50 dark:bg-purple-900/40 text-purple-600 dark:text-purple-400 flex items-center justify-center">
                <span class="material-symbols-outlined text-2xl">history</span>
            </div>
            <h3 class="font-bold text-slate-900 dark:text-white text-base">Reassessment Snapshot</h3>
            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                Penjelasan versi snapshot (v1.0, v2.0) dan rekam jejak pertumbuhan kompetensi.
            </p>
        </div>
    </section>

    <!-- Detailed FAQ Accordion Section -->
    <section class="bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-10 border border-line dark:border-slate-800 shadow-sm space-y-6">
        <div class="border-b border-slate-100 dark:border-slate-800 pb-4">
            <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight">Pertanyaan yang Sering Diajukan (FAQ)</h2>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Jawaban langsung untuk pertanyaan umum seputar fitur platform.</p>
        </div>

        <div class="space-y-4">
            <!-- FAQ 1 -->
            <details class="group p-5 bg-slate-50 dark:bg-slate-800/60 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 transition" open>
                <summary class="flex items-center justify-between font-bold text-slate-900 dark:text-white text-sm cursor-pointer list-none">
                    <span class="flex items-center space-x-3">
                        <span class="w-6 h-6 rounded-full bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300 text-xs flex items-center justify-center font-bold">Q</span>
                        <span>Bagaimana cara mengikuti Asesmen Mandiri awal?</span>
                    </span>
                    <span class="material-symbols-outlined text-slate-400 group-open:rotate-180 transition-transform">expand_more</span>
                </summary>
                <div class="mt-4 pt-3 border-t border-slate-200/60 dark:border-slate-700/60 text-xs text-slate-600 dark:text-slate-300 leading-relaxed pl-9">
                    Masuk ke menu <strong>Asesmen Mandiri</strong> di sidebar, pilih target karier yang ingin dievaluasi, jawab seluruh butir pertanyaan instrumen berdasarkan pemahaman riil Anda, kemudian klik tombol <em>Submit Asesmen Mandiri</em>. Sistem akan otomatis menghitung <em>baseline current level</em> dan menghasilkan snapshot pertama Anda.
                </div>
            </details>

            <!-- FAQ 2 -->
            <details class="group p-5 bg-slate-50 dark:bg-slate-800/60 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 transition">
                <summary class="flex items-center justify-between font-bold text-slate-900 dark:text-white text-sm cursor-pointer list-none">
                    <span class="flex items-center space-x-3">
                        <span class="w-6 h-6 rounded-full bg-teal-100 dark:bg-teal-900/50 text-teal-700 dark:text-teal-300 text-xs flex items-center justify-center font-bold">Q</span>
                        <span>Bukti apa saja yang sah untuk diunggah sebagai portofolio?</span>
                    </span>
                    <span class="material-symbols-outlined text-slate-400 group-open:rotate-180 transition-transform">expand_more</span>
                </summary>
                <div class="mt-4 pt-3 border-t border-slate-200/60 dark:border-slate-700/60 text-xs text-slate-600 dark:text-slate-300 leading-relaxed pl-9">
                    Anda dapat melampirkan: (1) Tautan repositori kode GitHub/GitLab publik, (2) Sertifikat kursus kredibel (Coursera, Dicoding, dsb.), (3) Dokumen laporan proyek akademik, atau (4) Tautan aplikasi yang sudah ter-deploy live. Pastikan menyertakan deskripsi kontribusi Anda.
                </div>
            </details>

            <!-- FAQ 3 -->
            <details class="group p-5 bg-slate-50 dark:bg-slate-800/60 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 transition">
                <summary class="flex items-center justify-between font-bold text-slate-900 dark:text-white text-sm cursor-pointer list-none">
                    <span class="flex items-center space-x-3">
                        <span class="w-6 h-6 rounded-full bg-amber-100 dark:bg-amber-900/50 text-amber-700 dark:text-amber-300 text-xs flex items-center justify-center font-bold">Q</span>
                        <span>Bagaimana rumus penghitungan skor kesenjangan (*Skill Gap*)?</span>
                    </span>
                    <span class="material-symbols-outlined text-slate-400 group-open:rotate-180 transition-transform">expand_more</span>
                </summary>
                <div class="mt-4 pt-3 border-t border-slate-200/60 dark:border-slate-700/60 text-xs text-slate-600 dark:text-slate-300 leading-relaxed pl-9">
                    Skor dihitung secara <strong>Server-Authoritative</strong> dengan rumus: <code>Gap = Target Level - Current Level</code>. Jika <code>Gap &lt;= 0</code>, artinya kompetensi Anda sudah memenuhi standar industri. Jika bernilai positif (misal: -1.5), sistem akan menyarankan rekomendasi aktivitas rencana pengembangan.
                </div>
            </details>

            <!-- FAQ 4 -->
            <details class="group p-5 bg-slate-50 dark:bg-slate-800/60 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 transition">
                <summary class="flex items-center justify-between font-bold text-slate-900 dark:text-white text-sm cursor-pointer list-none">
                    <span class="flex items-center space-x-3">
                        <span class="w-6 h-6 rounded-full bg-purple-100 dark:bg-purple-900/50 text-purple-700 dark:text-purple-300 text-xs flex items-center justify-center font-bold">Q</span>
                        <span>Kapan Reassessment Snapshot baru akan diterbitkan?</span>
                    </span>
                    <span class="material-symbols-outlined text-slate-400 group-open:rotate-180 transition-transform">expand_more</span>
                </summary>
                <div class="mt-4 pt-3 border-t border-slate-200/60 dark:border-slate-700/60 text-xs text-slate-600 dark:text-slate-300 leading-relaxed pl-9">
                    Snapshot baru (misal: v2.0) akan diterbitkan saat dosen reviewer selesai memvalidasi bukti portofolio Anda atau ketika Anda menyelesaikan asesmen mandiri ulang berkala. Snapshot ini bersifat permanen dan tidak dapat dimanipulasi manual.
                </div>
            </details>
        </div>
    </section>

    <!-- Support Help Desk Banner -->
    <section class="bg-slate-100 dark:bg-slate-800/80 rounded-3xl p-6 sm:p-8 border border-line dark:border-slate-700 flex flex-col sm:flex-row items-center justify-between gap-6">
        <div class="flex items-center space-x-4 text-center sm:text-left">
            <div class="w-12 h-12 rounded-2xl bg-blue-600 text-white flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-2xl">support_agent</span>
            </div>
            <div>
                <h3 class="font-bold text-slate-900 dark:text-white text-base">Masih Membutuhkan Bantuan Lain?</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Tim pengembang ICL ITATS siap menjawab pertanyaan dan menerima umpan balik.</p>
            </div>
        </div>
        <a href="{{ route('support') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition hover-lift shrink-0">
            Hubungi Kontak Dukungan
        </a>
    </section>

</div>
@endsection
