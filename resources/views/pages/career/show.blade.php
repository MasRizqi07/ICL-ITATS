@extends('layouts.app')

@section('title', 'Detail Target Karier - ' . $career->name . ' - ICL ITATS')

@section('content')
<div class="space-y-8 animate-fade-in-up">

    <!-- Career Header Hero Banner -->
    <div class="relative overflow-hidden bg-gradient-to-r from-blue-900 via-indigo-900 to-slate-900 text-white p-6 sm:p-8 rounded-3xl shadow-lg border border-blue-700/30">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div class="space-y-2 max-w-2xl">
                <div class="flex items-center space-x-2.5">
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-500/30 text-blue-200 border border-blue-400/30">
                        Standar Industri Kurikulum ITATS
                    </span>
                    <span class="text-xs text-blue-200 font-mono">Versi {{ $career->version }}.0</span>
                </div>
                
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">{{ $career->name }}</h1>
                
                <p class="text-xs sm:text-sm text-blue-100 leading-relaxed">
                    {{ $career->description }}
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3 shrink-0">
                <a href="{{ route('assessment.show') }}" class="px-5 py-2.5 bg-white text-blue-900 hover:bg-blue-50 text-xs font-bold rounded-xl shadow-md transition hover-lift flex items-center space-x-2">
                    <span class="material-symbols-outlined text-base">quiz</span>
                    <span>Mulai Asesmen Mandiri</span>
                </a>
                <a href="{{ route('competency.map') }}" class="px-5 py-2.5 bg-blue-600/50 hover:bg-blue-600/70 text-white text-xs font-bold rounded-xl border border-blue-400/40 transition hover-lift flex items-center space-x-2">
                    <span class="material-symbols-outlined text-base">map</span>
                    <span>Peta Kompetensi</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Career Curriculum Metadata Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xs hover-lift">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Total Kompetensi Wajib</span>
                <span class="p-2 rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-900/40 dark:text-blue-400">
                    <span class="material-symbols-outlined text-xl">workspace_premium</span>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-slate-900 dark:text-white mt-3">{{ count($career->competencies) }} Standar</div>
            <span class="text-[11px] text-slate-400 font-medium">Domain Teknis & Metodologi</span>
        </div>

        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xs hover-lift">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Rata-rata Target Level</span>
                <span class="p-2 rounded-xl bg-teal-50 text-teal-600 dark:bg-teal-900/40 dark:text-teal-400">
                    <span class="material-symbols-outlined text-xl">trending_up</span>
                </span>
            </div>
            @php
                $avgReq = count($career->competencies) > 0 ? collect($career->competencies)->avg(fn($c) => $c->pivot->required_level) : 0;
            @endphp
            <div class="text-3xl font-extrabold text-teal-600 dark:text-teal-400 mt-3">{{ number_format($avgReq, 1) }} / 5.0</div>
            <span class="text-[11px] text-slate-400 font-medium">Standar Kualifikasi Mahir</span>
        </div>

        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xs hover-lift">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Status Kurikulum</span>
                <span class="p-2 rounded-xl bg-purple-50 text-purple-600 dark:bg-purple-900/40 dark:text-purple-400">
                    <span class="material-symbols-outlined text-xl">verified</span>
                </span>
            </div>
            <div class="text-xl font-extrabold text-slate-900 dark:text-white mt-4">Aktif & Terverifikasi</div>
            <span class="text-[11px] text-slate-400 font-medium">{{ $career->source_notes ?? 'Standar Industri 2026' }}</span>
        </div>
    </div>

    <!-- Competencies Grid List -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-line dark:border-slate-800 p-6 sm:p-8 shadow-sm space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 dark:border-slate-800 pb-4">
            <div>
                <h3 class="text-lg font-extrabold text-slate-900 dark:text-white tracking-tight">Rincian Indikator Kompetensi Kurikulum</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Daftar kemampuan yang harus dicapai dan dibuktikan dengan artefak portofolio.</p>
            </div>
            <span class="text-xs font-bold text-slate-400">Total: {{ count($career->competencies) }} Kompetensi</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($career->competencies as $comp)
                <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/80 dark:border-slate-700/80 hover-lift space-y-3">
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="px-2.5 py-0.5 rounded-md text-[10px] font-extrabold uppercase tracking-wider bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300">
                                {{ $comp->domain ?? 'Technical' }}
                            </span>
                            <h4 class="font-bold text-slate-900 dark:text-white text-sm sm:text-base mt-2">{{ $comp->name }}</h4>
                        </div>
                        <span class="px-2.5 py-1 bg-blue-50 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 text-xs font-extrabold rounded-xl shrink-0">
                            Req {{ number_format($comp->pivot->required_level, 1) }}
                        </span>
                    </div>

                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        {{ $comp->description }}
                    </p>

                    <div class="pt-2 border-t border-slate-200/60 dark:border-slate-700/60 flex items-center justify-between text-xs">
                        <span class="text-slate-500 dark:text-slate-400">Bobot Penilaian: <strong>{{ $comp->pivot->weight ?? '1.0' }}x</strong></span>
                        <a href="{{ route('evidence.create') }}" class="text-blue-600 dark:text-blue-400 font-bold hover:underline">
                            + Unggah Bukti
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
