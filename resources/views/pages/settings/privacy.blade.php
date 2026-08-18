@extends('layouts.app')

@section('title', 'Pengaturan Privasi & Data - ICL ITATS')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 animate-fade-in-up">

    <!-- Header Section -->
    <div class="relative overflow-hidden bg-gradient-to-r from-blue-900 via-indigo-900 to-slate-900 text-white p-6 sm:p-8 rounded-3xl shadow-lg border border-blue-700/30">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 space-y-2">
            <div class="flex items-center space-x-2.5">
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-500/30 text-blue-200 border border-blue-400/30">
                    Pengaturan Pengguna
                </span>
                <span class="text-xs text-blue-200">Privasi & Kontrol Data</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">Privasi Data & Persetujuan AI 🛡️</h1>
            <p class="text-xs sm:text-sm text-blue-100 max-w-2xl leading-relaxed">
                Kelola hak akses visibilitas portofolio bukti, izin evaluasi dosen reviewer, dan persetujuan transmisi konteks anonim AI.
            </p>
        </div>
    </div>

    <!-- Navigation Sub-tabs -->
    <div class="flex items-center space-x-3 border-b border-line dark:border-slate-800 pb-2">
        <a href="{{ route('settings.account') }}" class="px-4 py-2 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 text-xs font-bold rounded-xl transition">
            Akun & Kata Sandi
        </a>
        <a href="{{ route('settings.privacy') }}" class="px-4 py-2 bg-blue text-white text-xs font-bold rounded-xl shadow-xs">
            Privasi & Izin Data AI
        </a>
        <a href="{{ route('profile.show') }}" class="px-4 py-2 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 text-xs font-bold rounded-xl transition">
            Biodata Profil
        </a>
    </div>

    <!-- Privacy Controls Card -->
    <div class="bg-surface dark:bg-slate-900 p-6 sm:p-8 rounded-3xl border border-line dark:border-slate-800 shadow-sm space-y-6">
        <div class="border-b border-line dark:border-slate-800 pb-4">
            <h3 class="text-lg font-extrabold text-ink dark:text-white tracking-tight">Opsi Visibilitas & Izin Akses</h3>
            <p class="text-xs text-muted dark:text-slate-400 mt-0.5">Tentukan bagaimana data dan artefak Anda dapat diakses oleh pihak kampus.</p>
        </div>

        <div class="space-y-4">
            <!-- Reviewer Visibility -->
            <label class="p-4 bg-canvas dark:bg-slate-800/60 rounded-2xl border border-line dark:border-slate-700/80 flex items-start justify-between gap-4 cursor-pointer hover:bg-slate-100/80 dark:hover:bg-slate-800 transition">
                <div class="space-y-1">
                    <strong class="text-sm font-bold text-ink dark:text-white block">Visibilitas Portofolio kepada Dosen Reviewer</strong>
                    <p class="text-xs text-muted dark:text-slate-400 leading-relaxed">
                        Izinkan tim dosen penilai untuk meninjau artefak kode GitHub, dokumen sertifikat, dan detail pengajuan bukti Anda untuk keperluan penilaian akreditasi.
                    </p>
                </div>
                <input type="checkbox" checked class="h-5 w-5 rounded border-line text-blue focus:ring-blue mt-0.5">
            </label>

            <!-- AI Context Consent -->
            <label class="p-4 bg-canvas dark:bg-slate-800/60 rounded-2xl border border-line dark:border-slate-700/80 flex items-start justify-between gap-4 cursor-pointer hover:bg-slate-100/80 dark:hover:bg-slate-800 transition">
                <div class="space-y-1">
                    <div class="flex items-center space-x-2">
                        <strong class="text-sm font-bold text-ink dark:text-white block">Transmisi Konteks Anonim ke AI Recommendation Engine</strong>
                        <span class="px-2.5 py-0.5 bg-violet/10 text-violet dark:bg-violet/20 dark:text-violet-300 text-[10px] font-extrabold rounded-md border border-violet/20">
                            Fitur AI
                        </span>
                    </div>
                    <p class="text-xs text-muted dark:text-slate-400 leading-relaxed">
                        Kirim data agregat selisih *skill gap* (tanpa menyertakan nama/NPM/email pribadi) untuk menghasilkan rekomendasi tugas dan aktivitas pengembangan mandiri secara otomatis.
                    </p>
                </div>
                <input type="checkbox" checked class="h-5 w-5 rounded border-line text-blue focus:ring-blue mt-0.5">
            </label>

            <!-- Public Portfolio Sharing -->
            <label class="p-4 bg-canvas dark:bg-slate-800/60 rounded-2xl border border-line dark:border-slate-700/80 flex items-start justify-between gap-4 cursor-pointer hover:bg-slate-100/80 dark:hover:bg-slate-800 transition">
                <div class="space-y-1">
                    <strong class="text-sm font-bold text-ink dark:text-white block">Tautan Portofolio Publik (Public Career Resume)</strong>
                    <p class="text-xs text-muted dark:text-slate-400 leading-relaxed">
                        Izinkan pembuatan tautan publik terverifikasi yang dapat Anda cantumkan pada CV atau profil LinkedIn untuk industri perekrut.
                    </p>
                </div>
                <input type="checkbox" class="h-5 w-5 rounded border-line text-blue focus:ring-blue mt-0.5">
            </label>
        </div>

        <div class="flex items-center justify-end pt-3 border-t border-line dark:border-slate-800">
            <button type="button" class="px-7 py-3 bg-blue hover:opacity-90 text-white font-bold text-xs rounded-xl shadow-md transition hover-lift flex items-center space-x-2">
                <span class="material-symbols-outlined text-base">check</span>
                <span>Simpan Preferensi Privasi</span>
            </button>
        </div>
    </div>

</div>
@endsection
