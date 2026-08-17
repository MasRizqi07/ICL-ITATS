@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa - ICL ITATS')

@section('content')
<div class="space-y-6">
    
    <!-- Welcome Header Banner with Rich Gradient -->
    <div class="relative overflow-hidden bg-gradient-to-r from-blue-900 via-blue-800 to-indigo-900 text-white p-6 sm:p-8 rounded-3xl shadow-lg border border-blue-700/40">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div>
                <div class="flex items-center space-x-3">
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Selamat Datang, {{ $user->name }}! 👋</h1>
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-white/20 text-white backdrop-blur-md border border-white/20">
                        Semester {{ $user->semester ?? 6 }}
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-blue-100 mt-2 max-w-xl font-normal leading-relaxed">
                    Program Studi <strong class="text-white">{{ $user->program ?? 'Teknik Informatika' }}</strong> • Target Karier: <span class="px-2 py-0.5 bg-blue-500/30 rounded-md border border-blue-400/30 font-semibold">{{ $career->name }}</span>
                </p>
            </div>

            <div class="flex items-center space-x-3 shrink-0">
                <a href="{{ route('assessment.show') }}" class="px-4 py-2.5 text-xs font-bold text-blue-900 bg-white hover:bg-blue-50 rounded-xl shadow-md transition-all duration-200 hover-lift flex items-center space-x-2">
                    <span class="material-symbols-outlined text-base">quiz</span>
                    <span>Kerjakan Asesmen</span>
                </a>
                <a href="{{ route('evidence.create') }}" class="px-4 py-2.5 text-xs font-bold text-white bg-blue-600/50 hover:bg-blue-600/70 border border-blue-400/40 rounded-xl transition-all duration-200 hover-lift flex items-center space-x-2">
                    <span class="material-symbols-outlined text-base">add_circle</span>
                    <span>Tambah Bukti</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Summary KPI Metric Cards with Glassmorphism & Hover Lift -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xs hover-lift">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Total Kompetensi Karier</span>
                <span class="p-2 rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-900/40 dark:text-blue-400">
                    <span class="material-symbols-outlined text-xl">work</span>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-slate-900 dark:text-white mt-3">{{ count($gaps) }}</div>
            <span class="text-[11px] text-slate-400 font-medium">Standar Industri {{ $career->name }}</span>
        </div>

        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xs hover-lift">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Bukti Terverifikasi</span>
                <span class="p-2 rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-900/40 dark:text-emerald-400">
                    <span class="material-symbols-outlined text-xl">verified</span>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400 mt-3">{{ $verifiedEvidence }}</div>
            <span class="text-[11px] text-slate-400 font-medium">{{ $pendingEvidence }} Menunggu Peninjauan Dosen</span>
        </div>

        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xs hover-lift">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Reassessment Snapshot</span>
                <span class="p-2 rounded-xl bg-purple-50 text-purple-600 dark:bg-purple-900/40 dark:text-purple-400">
                    <span class="material-symbols-outlined text-xl">history</span>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-slate-900 dark:text-white mt-3">
                {{ $latestReassessment ? 'v1.0' : 'Belum Ada' }}
            </div>
            <span class="text-[11px] text-slate-400 font-medium">Snapshot Kemampuan Aktif</span>
        </div>

        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xs hover-lift">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Aktivitas Rencana Aksi</span>
                <span class="p-2 rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-900/40 dark:text-amber-400">
                    <span class="material-symbols-outlined text-xl">checklist</span>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-slate-900 dark:text-white mt-3">
                {{ $plan ? $plan->activities->where('status', 'completed')->count() : 0 }} <span class="text-sm font-semibold text-slate-400">/ {{ $plan ? $plan->activities->count() : 0 }}</span>
            </div>
            <span class="text-[11px] text-slate-400 font-medium">Aktivitas Pengembangan Selesai</span>
        </div>
    </div>

    <!-- Main Competency Map Table Preview -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-line dark:border-slate-800 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h3 class="text-lg font-extrabold text-slate-900 dark:text-white tracking-tight">Peta Ringkasan Kompetensi Karier Target</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Perbandingan antara *Required Target Level* industri dan *Current Level* mahasiswa.</p>
            </div>
            <a href="{{ route('competency.map') }}" class="text-xs font-bold text-blue-600 hover:text-blue-700 dark:text-blue-400 flex items-center space-x-1 transition">
                <span>Lihat Detail Peta Kompetensi</span>
                <span class="material-symbols-outlined text-base">arrow_forward</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 dark:bg-slate-800/60 text-slate-500 dark:text-slate-400 uppercase font-bold border-b border-slate-200 dark:border-slate-800">
                    <tr>
                        <th class="py-3.5 px-4">Nama Kompetensi</th>
                        <th class="py-3.5 px-4">Domain</th>
                        <th class="py-3.5 px-4">Target (Req)</th>
                        <th class="py-3.5 px-4">Saat Ini (Curr)</th>
                        <th class="py-3.5 px-4">Skill Gap</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @foreach($gaps as $gap)
                        <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/40 transition-colors">
                            <td class="py-4 px-4 font-bold text-slate-900 dark:text-white">
                                {{ $gap['name'] }}
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-2.5 py-1 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-lg font-semibold text-[11px]">
                                    {{ $gap['domain'] }}
                                </span>
                            </td>
                            <td class="py-4 px-4 font-extrabold text-slate-700 dark:text-slate-200">
                                {{ number_format($gap['required_level'], 1) }}
                            </td>
                            <td class="py-4 px-4 font-extrabold text-blue-600 dark:text-blue-400">
                                {{ number_format($gap['current_level'], 1) }}
                            </td>
                            <td class="py-4 px-4">
                                @if($gap['gap'] > 0)
                                    <span class="text-amber-600 font-bold bg-amber-50 dark:bg-amber-900/30 px-2 py-0.5 rounded-md">-{{ number_format($gap['gap'], 1) }}</span>
                                @else
                                    <span class="text-emerald-600 font-bold bg-emerald-50 dark:bg-emerald-900/30 px-2 py-0.5 rounded-md">0.0 (Memenuhi)</span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                @if($gap['status'] === 'terverifikasi')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[11px] font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300">
                                        <span class="material-symbols-outlined text-xs mr-1">verified</span> Terverifikasi
                                    </span>
                                @elseif($gap['status'] === 'memenuhi')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[11px] font-bold bg-teal-100 text-teal-800 dark:bg-teal-900/50 dark:text-teal-300">
                                        Memenuhi Target
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[11px] font-bold bg-amber-100 text-amber-800 dark:bg-amber-900/50 dark:text-amber-300">
                                        Perlu Ditingkatkan
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <a href="{{ route('evidence.create') }}" class="text-blue-600 dark:text-blue-400 hover:underline font-bold text-xs">
                                    + Tambah Bukti
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- AI Assistance Panel with Gradient Border Glow -->
    <div class="ai-gradient-border rounded-3xl p-6 relative overflow-hidden backdrop-blur-md shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <div class="flex items-center space-x-2.5">
                <span class="material-symbols-outlined text-purple-600 dark:text-purple-400 text-2xl animate-float">auto_awesome</span>
                <h4 class="font-extrabold text-slate-900 dark:text-white text-base">Ringkasan Analisis AI Support Layer</h4>
            </div>
            <span class="px-3 py-1 bg-purple-600 text-white rounded-full text-[10px] font-extrabold uppercase tracking-wider shadow-2xs">
                Dibantu AI (Non-Otoritatif)
            </span>
        </div>
        <p class="text-xs text-slate-700 dark:text-slate-300 leading-relaxed mb-4">
            Berdasarkan skor asesmen dan bukti Anda, fokus prioritas pengembangan minggu ini adalah menuntaskan aktivitas pada kompetensi <strong>RESTful API & Security Standard</strong> (selisih gap 2.0 tingkat).
        </p>
        <div class="flex items-center space-x-3">
            <a href="{{ route('development-plans.index') }}" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-xl text-xs font-bold transition shadow-xs hover-lift">
                Lihat Rencana Aksi Pengembangan
            </a>
        </div>
    </div>

</div>
@endsection
