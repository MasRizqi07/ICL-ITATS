@extends('layouts.app')

@section('title', 'Peta Kompetensi Karier - ICL ITATS')

@section('content')
<div class="space-y-6">

    <!-- Header Section with Hero Gradient -->
    <div class="relative overflow-hidden bg-gradient-to-r from-blue-900 via-indigo-900 to-slate-900 text-white p-6 sm:p-8 rounded-3xl shadow-lg border border-blue-700/30">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div>
                <div class="flex items-center space-x-3">
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Peta Kompetensi Karier Target 🗺️</h1>
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-500/30 text-blue-200 border border-blue-400/30">
                        {{ $career->name }}
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-blue-100 mt-2 max-w-2xl leading-relaxed">
                    Pemetaan indikator kemampuan teknis dan manajerial berdasarkan kebutuhan standar industri terkini.
                </p>
            </div>
            <a href="{{ route('skill-gaps') }}" class="px-5 py-2.5 bg-white text-blue-900 hover:bg-blue-50 text-xs font-bold rounded-xl shadow-md transition hover-lift flex items-center space-x-2 shrink-0">
                <span class="material-symbols-outlined text-base">insights</span>
                <span>Analisis Skill Gap</span>
            </a>
        </div>
    </div>

    <!-- Domain Category Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @php
            $domains = collect($gaps)->groupBy('domain');
        @endphp
        @foreach($domains as $domainName => $items)
            <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xs hover-lift space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Domain {{ $domainName }}</span>
                    <span class="p-2 rounded-xl bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-extrabold text-xs">
                        {{ count($items) }} Kompetensi
                    </span>
                </div>
                <div class="space-y-1.5">
                    @php
                        $avgReq = collect($items)->avg('required_level');
                        $avgCurr = collect($items)->avg('current_level');
                        $pct = number_format(($avgCurr / max($avgReq, 1)) * 100, 0);
                    @endphp
                    <div class="flex justify-between text-xs font-semibold text-slate-700 dark:text-slate-300">
                        <span>Pencapaian Domain</span>
                        <span class="text-blue-600 dark:text-blue-400 font-bold">{{ $pct }}%</span>
                    </div>
                    <div class="w-full h-2.5 bg-slate-100 dark:bg-slate-800 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-blue-600 to-indigo-500 rounded-full transition-all duration-500" style="width: {{ min($pct, 100) }}%"></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Competencies Interactive Cards Grid -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-line dark:border-slate-800 p-6 shadow-sm space-y-6">
        <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-4">
            <div>
                <h3 class="text-lg font-extrabold text-slate-900 dark:text-white tracking-tight">Rincian Kompetensi & Level Standar</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Matriks indikator penilaian kompetensi terstruktur.</p>
            </div>
            <span class="text-xs font-bold text-slate-400">Total: {{ count($gaps) }} Indikator</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($gaps as $gap)
                <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/80 dark:border-slate-800 hover-lift space-y-4">
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="px-2.5 py-0.5 rounded-md text-[10px] font-extrabold uppercase tracking-wider bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300">
                                {{ $gap['domain'] }}
                            </span>
                            <h4 class="font-bold text-slate-900 dark:text-white text-base mt-2">{{ $gap['name'] }}</h4>
                        </div>
                        <span class="p-2 rounded-xl bg-white dark:bg-slate-900 text-slate-400 shadow-2xs">
                            <span class="material-symbols-outlined text-xl text-blue-600 dark:text-blue-400">workspace_premium</span>
                        </span>
                    </div>

                    <!-- Progress Indicator Bar -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-slate-500 dark:text-slate-400 font-medium">Tingkat Kemampuan (Level)</span>
                            <div class="font-bold">
                                <span class="text-blue-600 dark:text-blue-400 font-extrabold text-sm">{{ number_format($gap['current_level'], 1) }}</span>
                                <span class="text-slate-400 font-normal"> / Req {{ number_format($gap['required_level'], 1) }}</span>
                            </div>
                        </div>
                        <div class="w-full h-3 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden p-0.5">
                            @php
                                $progressPct = min(100, ($gap['current_level'] / max($gap['required_level'], 1)) * 100);
                            @endphp
                            <div class="h-full bg-gradient-to-r from-blue-600 to-teal-400 rounded-full transition-all duration-500" style="width: {{ $progressPct }}%"></div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-2 border-t border-slate-200/60 dark:border-slate-700/60 text-xs">
                        <div>
                            @if($gap['gap'] > 0)
                                <span class="text-amber-600 dark:text-amber-400 font-bold bg-amber-50 dark:bg-amber-900/30 px-2 py-0.5 rounded">
                                    Gap: -{{ number_format($gap['gap'], 1) }}
                                </span>
                            @else
                                <span class="text-emerald-600 dark:text-emerald-400 font-bold bg-emerald-50 dark:bg-emerald-900/30 px-2 py-0.5 rounded">
                                    Target Memenuhi
                                </span>
                            @endif
                        </div>
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
