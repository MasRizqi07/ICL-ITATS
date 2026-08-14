@extends('layouts.app')

@section('title', 'Dashboard Administrator - ICL ITATS')

@section('content')
<div class="space-y-6">

    <!-- Admin Welcome Header Banner -->
    <div class="relative overflow-hidden bg-gradient-to-r from-purple-950 via-purple-900 to-slate-900 text-white p-6 sm:p-8 rounded-3xl shadow-lg border border-purple-800/40">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-purple-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div>
                <div class="flex items-center space-x-3">
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Dashboard Administrator ITATS 🛠️</h1>
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-white/20 text-white backdrop-blur-md border border-white/20">
                        Admin Portal
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-purple-200 mt-2 max-w-xl leading-relaxed">
                    Pengelola Utama Kurikulum Kompetensi, Standar Profil Karier Industri, dan Sistem Intelijen Karier Mahasiswa ITATS.
                </p>
            </div>

            <div class="flex items-center space-x-3 shrink-0">
                <a href="{{ route('admin.careers') }}" class="px-4 py-2.5 text-xs font-bold text-slate-900 bg-white hover:bg-purple-50 rounded-xl shadow-md transition hover-lift flex items-center space-x-2">
                    <span class="material-symbols-outlined text-base">work_history</span>
                    <span>Kelola Karier</span>
                </a>
                <a href="{{ route('admin.competencies') }}" class="px-4 py-2.5 text-xs font-bold text-white bg-purple-600/50 hover:bg-purple-600/80 border border-purple-400/40 rounded-xl transition hover-lift flex items-center space-x-2">
                    <span class="material-symbols-outlined text-base">menu_book</span>
                    <span>Kelola Kurikulum</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Admin KPI Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xs hover-lift">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Total Profil Karier</span>
                <span class="p-2 rounded-xl bg-purple-50 text-purple-600 dark:bg-purple-900/40 dark:text-purple-400">
                    <span class="material-symbols-outlined text-xl">work</span>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-slate-900 dark:text-white mt-3">{{ $careersCount }}</div>
            <span class="text-[11px] text-slate-400 font-medium">Profil Karier Aktif</span>
        </div>

        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xs hover-lift">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Mahasiswa Terdaftar</span>
                <span class="p-2 rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-900/40 dark:text-blue-400">
                    <span class="material-symbols-outlined text-xl">group</span>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-blue-600 dark:text-blue-400 mt-3">{{ $studentsCount }}</div>
            <span class="text-[11px] text-slate-400 font-medium">Pengguna Role Mahasiswa</span>
        </div>

        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xs hover-lift">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Total Bukti Kemampuan</span>
                <span class="p-2 rounded-xl bg-teal-50 text-teal-600 dark:bg-teal-900/40 dark:text-teal-400">
                    <span class="material-symbols-outlined text-xl">folder_special</span>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-teal-600 dark:text-teal-400 mt-3">{{ $evidenceCount }}</div>
            <span class="text-[11px] text-slate-400 font-medium">Portofolio & Sertifikat</span>
        </div>

        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xs hover-lift">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Kamus Kompetensi</span>
                <span class="p-2 rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-900/40 dark:text-amber-400">
                    <span class="material-symbols-outlined text-xl">auto_stories</span>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-slate-900 dark:text-white mt-3">{{ $competenciesCount }}</div>
            <span class="text-[11px] text-slate-400 font-medium">Standar Indikator Institusi</span>
        </div>
    </div>

    <!-- Career Profiles List -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-[#D9E0E8] dark:border-slate-800 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h3 class="text-lg font-extrabold text-slate-900 dark:text-white tracking-tight">Daftar Profil Karier Industri</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Kelola versi kurikulum dan pemetaan standar kompetensi institusi ITATS.</p>
            </div>
            <a href="{{ route('admin.careers') }}" class="text-xs font-bold text-purple-600 hover:text-purple-700 dark:text-purple-400 flex items-center space-x-1 transition">
                <span>Buka Manajemen Karier Lengkap</span>
                <span class="material-symbols-outlined text-base">arrow_forward</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 dark:bg-slate-800/60 text-slate-500 dark:text-slate-400 uppercase font-bold border-b border-slate-200 dark:border-slate-800">
                    <tr>
                        <th class="py-3.5 px-4">Nama Profil Karier</th>
                        <th class="py-3.5 px-4">Slug URL</th>
                        <th class="py-3.5 px-4">Kompetensi Terikat</th>
                        <th class="py-3.5 px-4">Versi Kurikulum</th>
                        <th class="py-3.5 px-4">Status Publikasi</th>
                        <th class="py-3.5 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @foreach($careers as $career)
                        <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/40 transition-colors">
                            <td class="py-4 px-4 font-bold text-slate-900 dark:text-white">
                                {{ $career->name }}
                            </td>
                            <td class="py-4 px-4 font-mono text-slate-500">
                                {{ $career->slug }}
                            </td>
                            <td class="py-4 px-4 font-bold text-blue-600 dark:text-blue-400">
                                {{ $career->competencies_count }} Kompetensi
                            </td>
                            <td class="py-4 px-4 font-semibold text-slate-700 dark:text-slate-300">
                                v{{ $career->version }}.0
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-2.5 py-1 rounded-lg text-[11px] font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300">
                                    {{ strtoupper($career->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <a href="{{ route('careers.show', $career->slug) }}" class="text-purple-600 dark:text-purple-400 hover:underline font-bold text-xs">
                                    Detail & Peta
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
