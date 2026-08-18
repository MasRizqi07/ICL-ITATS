@extends('layouts.app')

@section('title', 'Analisis Skill Gap & Progres - ICL ITATS')

@section('content')
<div class="space-y-8 animate-fade-in-up">

    <!-- Header Section -->
    <div class="relative overflow-hidden bg-gradient-to-r from-amber-950 via-slate-900 to-amber-900 text-white p-6 sm:p-8 rounded-3xl shadow-lg border border-amber-800/30">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-amber-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div>
                <div class="flex items-center space-x-3">
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Analisis Skill Gap Server-Authoritative 📊</h1>
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-500/30 text-amber-200 border border-amber-400/30">
                        Rule Engine v1.0
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-amber-100 mt-2 max-w-2xl leading-relaxed">
                    Kalkulasi selisih kemampuan (*Gap = Target Level - Current Level*) terverifikasi secara objektif oleh mesin scoring server.
                </p>
            </div>
            <a href="{{ route('development-plans.index') }}" class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-slate-950 text-xs font-extrabold rounded-xl shadow-md transition hover-lift flex items-center space-x-2 shrink-0">
                <span class="material-symbols-outlined text-base">checklist_rtl</span>
                <span>Rencana Aksi Pengembangan</span>
            </a>
        </div>
    </div>

    <!-- Summary Skill Gap Metrics -->
    @php
        $totalGaps = count($gaps);
        $fulfilledGaps = collect($gaps)->where('gap', '<=', 0)->count();
        $needImprovement = collect($gaps)->where('gap', '>', 0)->count();
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xs hover-lift">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Total Kompetensi Dievaluasi</span>
                <span class="p-2 rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-900/40 dark:text-blue-400">
                    <span class="material-symbols-outlined text-xl">analytics</span>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-slate-900 dark:text-white mt-3">{{ $totalGaps }}</div>
            <span class="text-[11px] text-slate-400 font-medium">Standar Karier {{ $career->name }}</span>
        </div>

        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xs hover-lift">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Kompetensi Memenuhi Target</span>
                <span class="p-2 rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-900/40 dark:text-emerald-400">
                    <span class="material-symbols-outlined text-xl">task_alt</span>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400 mt-3">{{ $fulfilledGaps }}</div>
            <span class="text-[11px] text-slate-400 font-medium">Gap 0.0 (Siap Industri)</span>
        </div>

        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xs hover-lift">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Membutuhkan Peningkatan</span>
                <span class="p-2 rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-900/40 dark:text-amber-400">
                    <span class="material-symbols-outlined text-xl">trending_up</span>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-amber-600 dark:text-amber-400 mt-3">{{ $needImprovement }}</div>
            <span class="text-[11px] text-slate-400 font-medium">Prioritas Rencana Aksi</span>
        </div>
    </div>

    <!-- Detailed Skill Gaps Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($gaps as $gap)
            <div class="bg-white dark:bg-slate-900 p-6 sm:p-7 rounded-3xl border border-line dark:border-slate-800 shadow-sm hover-lift space-y-4">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <span class="px-2.5 py-0.5 rounded-md text-[10px] font-extrabold uppercase tracking-wider bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300">
                            {{ $gap['domain'] }}
                        </span>
                        <h3 class="font-bold text-slate-900 dark:text-white text-base mt-2">{{ $gap['name'] }}</h3>
                    </div>
                    <div>
                        @if($gap['gap'] > 0)
                            <span class="px-3 py-1 bg-amber-100 text-amber-800 dark:bg-amber-900/50 dark:text-amber-300 font-extrabold text-xs rounded-xl flex items-center space-x-1 shadow-2xs">
                                <span>Selisih: -{{ number_format($gap['gap'], 1) }}</span>
                            </span>
                        @else
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300 font-extrabold text-xs rounded-xl flex items-center space-x-1 shadow-2xs">
                                <span class="material-symbols-outlined text-xs">check</span>
                                <span>Tercapai (0.0)</span>
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Explanation Box -->
                <div class="p-3.5 bg-slate-50 dark:bg-slate-800/80 rounded-2xl text-xs text-slate-600 dark:text-slate-300 leading-relaxed border border-slate-200/60 dark:border-slate-700/60">
                    <strong class="text-slate-900 dark:text-white block font-bold mb-1">Penjelasan Sumber Skor:</strong>
                    {{ $gap['explanation'] }}
                </div>

                <!-- Progress Comparison Bar -->
                <div class="space-y-1.5">
                    <div class="flex justify-between text-xs font-semibold text-slate-600 dark:text-slate-300">
                        <span>Current Level: <strong class="text-blue-600 dark:text-blue-400">{{ number_format($gap['current_level'], 1) }}</strong></span>
                        <span>Required Target: <strong>{{ number_format($gap['required_level'], 1) }}</strong></span>
                    </div>
                    <div class="w-full h-3 bg-slate-100 dark:bg-slate-800 rounded-full overflow-hidden relative">
                        <div class="h-full bg-gradient-to-r from-blue-600 to-indigo-500 rounded-full transition-all duration-500" style="width: {{ min(100, ($gap['current_level'] / 5.0) * 100) }}%"></div>
                        <div class="absolute top-0 bottom-0 w-1 bg-red-500" style="left: {{ ($gap['required_level'] / 5.0) * 100 }}%"></div>
                    </div>
                </div>

                <div class="pt-2 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between text-xs">
                    <a href="{{ route('evidence.create') }}" class="font-bold text-slate-500 hover:text-blue-600 dark:text-slate-400 dark:hover:text-blue-400 flex items-center space-x-1">
                        <span class="material-symbols-outlined text-sm">upload_file</span>
                        <span>+ Tambah Bukti</span>
                    </a>
                    <a href="{{ route('development-plans.index') }}" class="font-bold text-blue-600 hover:text-blue-700 dark:text-blue-400 flex items-center space-x-1">
                        <span>Buat Aktivitas Rencana Aksi</span>
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
