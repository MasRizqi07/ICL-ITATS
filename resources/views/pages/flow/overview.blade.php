@extends('layouts.guest')

@section('title', 'Alur Platform - ICL ITATS Career Intelligence')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16 space-y-16 animate-fade-in-up">

    <!-- Hero Flow Header -->
    <section class="text-center max-w-3xl mx-auto space-y-4">
        <div class="inline-flex items-center space-x-2 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 px-3.5 py-1.5 rounded-full text-xs font-bold border border-blue-200 dark:border-blue-800/60">
            <span class="material-symbols-outlined text-sm">schema</span>
            <span>Siklus 5 Tahapan Terstruktur</span>
        </div>

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
            Alur Pengembangan Karier <span class="bg-gradient-to-r from-blue-600 to-teal-500 bg-clip-text text-transparent">Berbasis Evidence</span>
        </h1>

        <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed">
            Diagram runtutan proses mahasiswa dari menentukan target karier impian hingga merilis rekam jejak penilaian ulang (*reassessment*) yang dapat diaudit.
        </p>
    </section>

    <!-- 5-Step Interactive Process Roadmap -->
    <section class="space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 lg:gap-6">
            
            <!-- Step 1 -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-line dark:border-slate-800 shadow-2xs hover-lift space-y-4 relative flex flex-col justify-between">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="w-10 h-10 rounded-xl bg-blue-600 text-white font-extrabold text-base flex items-center justify-center shadow-xs">1</span>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/40 px-2 py-0.5 rounded-md">Tahap 1</span>
                    </div>
                    <h3 class="font-bold text-slate-900 dark:text-white text-base">Target Karier & Peta Kompetensi</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        Mahasiswa memilih profil profesi (misal: Fullstack Developer) dan melihat standar level kurikulum yang dibutuhkan.
                    </p>
                </div>
                <div class="pt-3 border-t border-slate-100 dark:border-slate-800 flex items-center space-x-1 text-xs font-semibold text-blue-600 dark:text-blue-400">
                    <span class="material-symbols-outlined text-sm">flag</span>
                    <span>Penetapan Sasaran</span>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-line dark:border-slate-800 shadow-2xs hover-lift space-y-4 relative flex flex-col justify-between">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="w-10 h-10 rounded-xl bg-teal-600 text-white font-extrabold text-base flex items-center justify-center shadow-xs">2</span>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-teal-600 dark:text-teal-400 bg-teal-50 dark:bg-teal-900/40 px-2 py-0.5 rounded-md">Tahap 2</span>
                    </div>
                    <h3 class="font-bold text-slate-900 dark:text-white text-base">Asesmen & Unggah Bukti</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        Mahasiswa menjawab instrumen asesmen mandiri dan melampirkan portofolio nyata (URL GitHub, link sertifikat, dokumen).
                    </p>
                </div>
                <div class="pt-3 border-t border-slate-100 dark:border-slate-800 flex items-center space-x-1 text-xs font-semibold text-teal-600 dark:text-teal-400">
                    <span class="material-symbols-outlined text-sm">upload_file</span>
                    <span>Pengumpulan Bukti</span>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-line dark:border-slate-800 shadow-2xs hover-lift space-y-4 relative flex flex-col justify-between">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="w-10 h-10 rounded-xl bg-amber-600 text-white font-extrabold text-base flex items-center justify-center shadow-xs">3</span>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400 bg-amber-50 dark:bg-amber-900/40 px-2 py-0.5 rounded-md">Tahap 3</span>
                    </div>
                    <h3 class="font-bold text-slate-900 dark:text-white text-base">Kalkulasi Server-Authoritative Gap</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        Mesin scoring server menghitung selisih kemampuan (*Gap = Target - Current*) secara objektif dan transparan.
                    </p>
                </div>
                <div class="pt-3 border-t border-slate-100 dark:border-slate-800 flex items-center space-x-1 text-xs font-semibold text-amber-600 dark:text-amber-400">
                    <span class="material-symbols-outlined text-sm">calculate</span>
                    <span>Scoring Objektif</span>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-line dark:border-slate-800 shadow-2xs hover-lift space-y-4 relative flex flex-col justify-between">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="w-10 h-10 rounded-xl bg-purple-600 text-white font-extrabold text-base flex items-center justify-center shadow-xs">4</span>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-purple-600 dark:text-purple-400 bg-purple-50 dark:bg-purple-900/40 px-2 py-0.5 rounded-md">Tahap 4</span>
                    </div>
                    <h3 class="font-bold text-slate-900 dark:text-white text-base">Validasi Otoritatif Reviewer</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        Dosen reviewer mengevaluasi mutu bukti, memberikan feedback kualitatif, dan menyetujui verifikasi level kompetensi.
                    </p>
                </div>
                <div class="pt-3 border-t border-slate-100 dark:border-slate-800 flex items-center space-x-1 text-xs font-semibold text-purple-600 dark:text-purple-400">
                    <span class="material-symbols-outlined text-sm">verified</span>
                    <span>Review Otoritatif</span>
                </div>
            </div>

            <!-- Step 5 -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-line dark:border-slate-800 shadow-2xs hover-lift space-y-4 relative flex flex-col justify-between">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="w-10 h-10 rounded-xl bg-indigo-600 text-white font-extrabold text-base flex items-center justify-center shadow-xs">5</span>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/40 px-2 py-0.5 rounded-md">Tahap 5</span>
                    </div>
                    <h3 class="font-bold text-slate-900 dark:text-white text-base">Reassessment Snapshot</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        Sistem merekam versi snapshot (v1.0, v2.0) secara permanen untuk melacak rekam jejak pertumbuhan kompetensi.
                    </p>
                </div>
                <div class="pt-3 border-t border-slate-100 dark:border-slate-800 flex items-center space-x-1 text-xs font-semibold text-indigo-600 dark:text-indigo-400">
                    <span class="material-symbols-outlined text-sm">history_edu</span>
                    <span>Snapshot Pertumbuhan</span>
                </div>
            </div>

        </div>
    </section>

    <!-- Role Responsibilities Comparison Table -->
    <section class="bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-10 border border-line dark:border-slate-800 shadow-sm space-y-6">
        <div class="border-b border-slate-100 dark:border-slate-800 pb-4">
            <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight">Peran dan Tanggung Jawab dalam Siklus</h2>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Pembagian peran yang jelas untuk menjamin tata kelola akademik yang transparan.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 dark:border-slate-800 text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wider">
                        <th class="py-3 px-4">Peran Pengguna</th>
                        <th class="py-3 px-4">Aksi Utama</th>
                        <th class="py-3 px-4">Artefak Output</th>
                        <th class="py-3 px-4">Tanggung Jawab Otoritas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                    <tr>
                        <td class="py-4 px-4 font-bold text-slate-900 dark:text-white flex items-center space-x-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-blue-600"></span>
                            <span>Mahasiswa</span>
                        </td>
                        <td class="py-4 px-4">Pilih karier target, isi asesmen mandiri, upload berkas portofolio, kerjakan aktivitas pengembangan.</td>
                        <td class="py-4 px-4 font-mono text-[11px] text-blue-600 dark:text-blue-400">Evidence Submission & Activity Plan</td>
                        <td class="py-4 px-4">Menyajikan bukti autentik karya sendiri</td>
                    </tr>
                    <tr>
                        <td class="py-4 px-4 font-bold text-slate-900 dark:text-white flex items-center space-x-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-teal-600"></span>
                            <span>Reviewer / Dosen</span>
                        </td>
                        <td class="py-4 px-4">Tinjau kesesuaian berkas bukti, berikan rating validasi, kirim umpan balik perbaikan.</td>
                        <td class="py-4 px-4 font-mono text-[11px] text-teal-600 dark:text-teal-400">Verified Evidence & Review Feedback</td>
                        <td class="py-4 px-4">Memvalidasi kelayakan standar kompetensi riil</td>
                    </tr>
                    <tr>
                        <td class="py-4 px-4 font-bold text-slate-900 dark:text-white flex items-center space-x-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-purple-600"></span>
                            <span>Administrator</span>
                        </td>
                        <td class="py-4 px-4">Kelola katalog kurikulum karier, atur bobot indikator, kelola akun pengguna.</td>
                        <td class="py-4 px-4 font-mono text-[11px] text-purple-600 dark:text-purple-400">Curriculum Version & Career Matrix</td>
                        <td class="py-4 px-4">Menjaga relevansi kurikulum dengan industri</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Bottom CTA -->
    <section class="bg-gradient-to-r from-blue-900 via-indigo-900 to-slate-950 text-white rounded-3xl p-8 sm:p-12 text-center space-y-6 shadow-xl border border-blue-700/30">
        <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Siap Memulai Perjalanan Karier Terukur Anda?</h2>
        <p class="text-xs sm:text-sm text-blue-100 max-w-xl mx-auto leading-relaxed">
            Gunakan akun demo mahasiswa untuk langsung mencoba alur asesmen dan pengunggahan portofolio dalam 2 menit.
        </p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('login.quick', 'student') }}" class="px-8 py-3.5 bg-white text-blue-900 hover:bg-blue-50 font-bold text-xs rounded-xl shadow-lg transition hover-lift">
                Mulai Demo Mahasiswa
            </a>
            <a href="{{ route('landing') }}" class="px-8 py-3.5 bg-white/10 hover:bg-white/20 text-white font-bold text-xs rounded-xl backdrop-blur-md transition hover-lift">
                Kembali ke Beranda
            </a>
        </div>
    </section>

</div>
@endsection
