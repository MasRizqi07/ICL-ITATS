@extends('layouts.app')

@section('title', 'Peta Kompetensi Karier - ICL ITATS')

@section('content')
<div class="space-y-6 animate-fade-in-up">

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
                    Pemetaan indikator kemampuan teknis dan manajerial berdasarkan kebutuhan standar industri kurikulum ITATS.
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-3 shrink-0">
                <a href="{{ route('assessment.show') }}" class="px-5 py-2.5 bg-white text-blue-900 hover:bg-blue-50 text-xs font-bold rounded-xl shadow-md transition hover-lift flex items-center space-x-2">
                    <span class="material-symbols-outlined text-base">quiz</span>
                    <span>Asesmen Mandiri</span>
                </a>
                <a href="{{ route('skill-gaps') }}" class="px-5 py-2.5 bg-blue-600/50 hover:bg-blue-600/70 text-white text-xs font-bold rounded-xl border border-blue-400/40 transition hover-lift flex items-center space-x-2">
                    <span class="material-symbols-outlined text-base">insights</span>
                    <span>Analisis Skill Gap</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Domain Category Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @php
            $domains = collect($gaps)->groupBy('domain');
        @endphp
        @foreach($domains as $domainName => $items)
            <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xs hover-lift space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Domain {{ $domainName }}</span>
                    <span class="p-2 rounded-xl bg-blue-50 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 font-extrabold text-xs">
                        {{ count($items) }} Kompetensi
                    </span>
                </div>
                <div class="space-y-1.5">
                    @php
                        $avgReq = collect($items)->avg('required_level');
                        $avgCurr = collect($items)->avg('current_level');
                        $pct = $avgReq > 0 ? number_format(($avgCurr / $avgReq) * 100, 0) : 0;
                    @endphp
                    <div class="flex justify-between text-xs font-semibold text-slate-700 dark:text-slate-300">
                        <span>Kesiapan Domain</span>
                        <span class="text-blue-600 dark:text-blue-400 font-bold">{{ $pct }}%</span>
                    </div>
                    <div class="w-full h-2.5 bg-slate-100 dark:bg-slate-800 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-blue-600 to-indigo-500 rounded-full transition-all duration-500" style="width: {{ min($pct, 100) }}%"></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Competencies Detailed List Cards -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-line dark:border-slate-800 p-6 sm:p-8 shadow-sm space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 dark:border-slate-800 pb-4">
            <div>
                <h3 class="text-lg font-extrabold text-slate-900 dark:text-white tracking-tight">Rincian Matriks Indikator & Target Level</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Penilaian transparan menghubungkan bukti nyata dengan tingkat kualifikasi.</p>
            </div>
            <span class="text-xs font-bold text-slate-400">Total: {{ count($gaps) }} Indikator</span>
        </div>

        <div class="space-y-4">
            @foreach($gaps as $item)
                <div class="bg-slate-50 dark:bg-slate-800/60 p-6 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 hover-lift space-y-4">
                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                        <div class="space-y-1">
                            <div class="flex flex-wrap items-center gap-2">
                                <h4 class="text-base font-bold text-slate-900 dark:text-white">{{ $item['name'] }}</h4>
                                <span class="px-2.5 py-0.5 rounded-md text-[10px] font-extrabold uppercase tracking-wider bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300">
                                    {{ $item['domain'] }}
                                </span>
                                @if(isset($item['priority']) && $item['priority'] === 'high')
                                    <span class="px-2.5 py-0.5 rounded-md text-[10px] font-extrabold uppercase tracking-wider bg-red-100 dark:bg-red-900/50 text-red-700 dark:text-red-300">
                                        Prioritas Tinggi
                                    </span>
                                @endif
                            </div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                                {{ $item['explanation'] }}
                            </p>
                        </div>

                        <!-- Status Badges -->
                        <div class="shrink-0">
                            @if($item['status'] === 'terverifikasi')
                                <span class="px-3 py-1.5 bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300 font-bold text-xs rounded-xl flex items-center space-x-1.5 shadow-2xs">
                                    <span class="material-symbols-outlined text-sm">verified</span>
                                    <span>Terverifikasi Dosen</span>
                                </span>
                            @elseif($item['status'] === 'memenuhi')
                                <span class="px-3 py-1.5 bg-teal-100 text-teal-800 dark:bg-teal-900/50 dark:text-teal-300 font-bold text-xs rounded-xl flex items-center space-x-1.5 shadow-2xs">
                                    <span class="material-symbols-outlined text-sm">check_circle</span>
                                    <span>Memenuhi Target</span>
                                </span>
                            @else
                                <span class="px-3 py-1.5 bg-amber-100 text-amber-800 dark:bg-amber-900/50 dark:text-amber-300 font-bold text-xs rounded-xl flex items-center space-x-1.5 shadow-2xs">
                                    <span class="material-symbols-outlined text-sm">priority_high</span>
                                    <span>Perlu Ditingkatkan</span>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Visual Progress Stepper Level Bar -->
                    <div class="space-y-1.5">
                        <div class="flex justify-between text-xs font-semibold text-slate-600 dark:text-slate-300">
                            <span>Tingkat Saat Ini: <strong class="text-blue-600 dark:text-blue-400">{{ number_format($item['current_level'], 1) }}</strong> / 5.0</span>
                            <span>Target Industri: <strong>{{ number_format($item['required_level'], 1) }}</strong> / 5.0</span>
                        </div>

                        <div class="w-full h-3 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden relative">
                            <!-- Current Level Fill -->
                            <div class="h-full bg-gradient-to-r from-blue-600 to-indigo-500 rounded-full transition-all duration-500" style="width: {{ min(100, ($item['current_level'] / 5.0) * 100) }}%"></div>
                            <!-- Target Marker Line -->
                            <div class="absolute top-0 bottom-0 w-1 bg-red-500 rounded-full shadow-xs" style="left: {{ ($item['required_level'] / 5.0) * 100 }}%"></div>
                        </div>
                    </div>

                    <!-- Footer Action and Evidence Count -->
                    <div class="pt-3 border-t border-slate-200/60 dark:border-slate-700/60 flex items-center justify-between text-xs">
                        <span class="text-slate-500 dark:text-slate-400">
                            Portofolio Terkait: <strong class="text-slate-700 dark:text-slate-200">{{ $item['evidence_count'] ?? 0 }} bukti terunggah</strong>
                        </span>
                        <a href="{{ route('evidence.create') }}" class="font-bold text-blue-600 dark:text-blue-400 hover:underline flex items-center space-x-1">
                            <span class="material-symbols-outlined text-sm">upload_file</span>
                            <span>Unggah Bukti Portofolio</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
