@extends('layouts.app')

@section('title', 'Profil Pengguna & Keamanan - ICL ITATS')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 animate-fade-in-up">

    <!-- Profile Header Hero Banner -->
    <div class="relative overflow-hidden bg-gradient-to-r from-blue-900 via-indigo-900 to-slate-900 text-white p-6 sm:p-8 rounded-3xl shadow-lg border border-blue-700/30">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center gap-5">
            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white font-extrabold text-3xl flex items-center justify-center shadow-lg border-2 border-white/20 shrink-0">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div class="space-y-1">
                <div class="flex flex-wrap items-center gap-2.5">
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">{{ $user->name }}</h1>
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-500/30 text-blue-200 border border-blue-400/30 capitalize">
                        Role {{ $user->role }}
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-blue-100 font-normal">
                    {{ $user->email }} • Program Studi <strong class="text-white">{{ $user->program ?? 'Teknik Informatika' }}</strong>
                    @if($user->semester)
                        • Semester {{ $user->semester }}
                    @endif
                </p>
            </div>
        </div>
    </div>

    <!-- Edit Profile Form Card -->
    <div class="bg-white dark:bg-slate-900 p-6 sm:p-8 rounded-3xl border border-line dark:border-slate-800 shadow-sm space-y-6">
        <div class="border-b border-slate-100 dark:border-slate-800 pb-4">
            <h3 class="text-lg font-extrabold text-slate-900 dark:text-white tracking-tight">Informasi Data Pribadi & Akademik</h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Perbarui informasi profil dan biodata singkat Anda.</p>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Name -->
            <div class="space-y-1.5">
                <label for="name" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                    class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Program Study -->
                <div class="space-y-1.5">
                    <label for="program" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Program Studi</label>
                    <input type="text" id="program" name="program" value="{{ old('program', $user->program) }}"
                        class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition">
                </div>

                <!-- Semester -->
                <div class="space-y-1.5">
                    <label for="semester" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Semester Saat Ini</label>
                    <input type="number" id="semester" name="semester" value="{{ old('semester', $user->semester) }}"
                        class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition">
                </div>
            </div>

            <!-- Bio -->
            <div class="space-y-1.5">
                <label for="bio" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Bio & Minat Keahlian</label>
                <textarea id="bio" name="bio" rows="3"
                    class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition"
                    placeholder="Tuliskan minat karir, fokus penelitian skripsi, atau proyek unggulan yang sedang Anda kerjakan...">{{ old('bio', $user->bio) }}</textarea>
            </div>

            <div class="flex items-center justify-end pt-3 border-t border-slate-100 dark:border-slate-800">
                <button type="submit" class="px-7 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition hover-lift flex items-center space-x-2">
                    <span class="material-symbols-outlined text-base">save</span>
                    <span>Simpan Perubahan Profil</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Security & Session Info Card -->
    <div class="bg-white dark:bg-slate-900 p-6 sm:p-8 rounded-3xl border border-line dark:border-slate-800 shadow-sm space-y-4">
        <div class="flex items-center space-x-3">
            <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 text-2xl">security</span>
            <div>
                <h4 class="font-extrabold text-slate-900 dark:text-white text-base">Keamanan Akun & Hak Akses</h4>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Sesi login diautentikasi dengan standar keamanan ITATS Career Intelligence.</p>
            </div>
        </div>

        <div class="p-4 bg-slate-50 dark:bg-slate-800/60 rounded-2xl border border-slate-200 dark:border-slate-700 text-xs text-slate-600 dark:text-slate-300 leading-relaxed flex items-center justify-between">
            <div>
                <strong class="text-slate-900 dark:text-white font-bold block">Status Akun:</strong>
                <span>Terdaftar aktif sejak {{ date('d M Y', strtotime($user->created_at)) }}</span>
            </div>
            <span class="px-3 py-1 bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300 font-bold text-xs rounded-full inline-flex items-center space-x-1">
                <span class="material-symbols-outlined text-xs">verified</span>
                <span>Aktif & Terotentikasi</span>
            </span>
        </div>
    </div>

</div>
@endsection
