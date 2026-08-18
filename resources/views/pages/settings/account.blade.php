@extends('layouts.app')

@section('title', 'Pengaturan Akun & Keamanan - ICL ITATS')

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
                <span class="text-xs text-blue-200">Keamanan Akun</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">Pengaturan Akun & Kata Sandi 🔐</h1>
            <p class="text-xs sm:text-sm text-blue-100 max-w-2xl leading-relaxed">
                Kelola kredensial akun, pembaruan kata sandi, dan proteksi sesi otentikasi login institusi ITATS Anda.
            </p>
        </div>
    </div>

    <!-- Navigation Sub-tabs -->
    <div class="flex items-center space-x-3 border-b border-line dark:border-slate-800 pb-2">
        <a href="{{ route('settings.account') }}" class="px-4 py-2 bg-blue text-white text-xs font-bold rounded-xl shadow-xs">
            Akun & Kata Sandi
        </a>
        <a href="{{ route('settings.privacy') }}" class="px-4 py-2 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 text-xs font-bold rounded-xl transition">
            Privasi & Izin Data AI
        </a>
        <a href="{{ route('profile.show') }}" class="px-4 py-2 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 text-xs font-bold rounded-xl transition">
            Biodata Profil
        </a>
    </div>

    <!-- Account Details & Password Card -->
    <div class="bg-surface dark:bg-slate-900 p-6 sm:p-8 rounded-3xl border border-line dark:border-slate-800 shadow-sm space-y-6">
        <div class="border-b border-line dark:border-slate-800 pb-4">
            <h3 class="text-lg font-extrabold text-ink dark:text-white tracking-tight">Kredensial & Autentikasi</h3>
            <p class="text-xs text-muted dark:text-slate-400 mt-0.5">Informasi akun terdaftar pada sistem single identity ITATS.</p>
        </div>

        <div class="space-y-4">
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-ink dark:text-slate-300">Alamat Email Institusi (Akun ITATS)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-muted">
                        <span class="material-symbols-outlined text-lg">mail</span>
                    </div>
                    <input type="email" value="{{ $user->email }}" disabled
                        class="w-full pl-10 pr-4 py-2.5 bg-slate-100 dark:bg-slate-800/80 border border-line dark:border-slate-700 rounded-xl text-xs font-medium text-muted dark:text-slate-400 cursor-not-allowed">
                </div>
                <p class="text-[11px] text-muted">Email institusi disinkronisasi langsung dengan pusat data akademik ITATS.</p>
            </div>

            <div class="pt-4 border-t border-line dark:border-slate-800 space-y-4">
                <h4 class="font-bold text-ink dark:text-white text-sm">Pembaruan Kata Sandi</h4>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label for="current_password" class="block text-xs font-bold text-ink dark:text-slate-300">Kata Sandi Saat Ini</label>
                        <input type="password" id="current_password" placeholder="••••••••"
                            class="w-full px-4 py-2.5 bg-canvas dark:bg-slate-800 border border-line dark:border-slate-700 rounded-xl text-xs text-ink dark:text-white focus:ring-2 focus:ring-blue focus:border-blue outline-none transition">
                    </div>
                    <div class="space-y-1.5">
                        <label for="new_password" class="block text-xs font-bold text-ink dark:text-slate-300">Kata Sandi Baru</label>
                        <input type="password" id="new_password" placeholder="Minimal 8 karakter..."
                            class="w-full px-4 py-2.5 bg-canvas dark:bg-slate-800 border border-line dark:border-slate-700 rounded-xl text-xs text-ink dark:text-white focus:ring-2 focus:ring-blue focus:border-blue outline-none transition">
                    </div>
                </div>

                <div class="flex items-center justify-end pt-2">
                    <button type="button" class="px-6 py-2.5 bg-blue hover:opacity-90 text-white font-bold text-xs rounded-xl shadow-md transition hover-lift flex items-center space-x-2">
                        <span class="material-symbols-outlined text-base">lock_reset</span>
                        <span>Perbarui Kata Sandi</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Sessions Info Card -->
    <div class="bg-surface dark:bg-slate-900 p-6 sm:p-8 rounded-3xl border border-line dark:border-slate-800 shadow-sm space-y-4">
        <div class="flex items-center space-x-3">
            <span class="material-symbols-outlined text-blue dark:text-blue-400 text-2xl">devices</span>
            <div>
                <h4 class="font-extrabold text-ink dark:text-white text-base">Sesi Perangkat Aktif</h4>
                <p class="text-xs text-muted dark:text-slate-400 mt-0.5">Perangkat yang saat ini terhubung dengan akun Anda.</p>
            </div>
        </div>

        <div class="p-4 bg-canvas dark:bg-slate-800/60 rounded-2xl border border-line dark:border-slate-700 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <span class="material-symbols-outlined text-teal text-2xl">desktop_windows</span>
                <div>
                    <strong class="text-xs text-ink dark:text-white block font-bold">Browser Saat Ini (Web Session)</strong>
                    <span class="text-[11px] text-muted">Aktif sekarang • IP Terproteksi</span>
                </div>
            </div>
            <span class="px-3 py-1 bg-teal/10 text-teal dark:bg-teal/20 dark:text-teal-300 font-bold text-xs rounded-full border border-teal/20">
                Sesi Ini
            </span>
        </div>
    </div>

</div>
@endsection
