@extends('layouts.app')

@section('title', 'Analisis Skill Gap - ICL ITATS')

@section('content')
<div class="space-y-6">

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
        $criticalGaps = collect($gaps)->where('gap', '>=', 2.0)->count();
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
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Gap Prioritas Kritis (≥ 2.0)</span>
                <span class="p-2 rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-900/40 dark:text-amber-400">
                    <span class="material-symbols-outlined text-xl">priority_high</span>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-amber-600 dark:text-amber-400 mt-3">{{ $criticalGaps }}</div>
            <span class="text-[11px] text-slate-400 font-medium">Perlu Ditingkatkan Segera</span>
        </div>
    </div>

    <!-- Skill Gap Detailed Table -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-[#D9E0E8] dark:border-slate-800 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h3 class="text-lg font-extrabold text-slate-900 dark:text-white tracking-tight">Rincian Perhitungan Skill Gap</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Penilaian objektif berbasis riwayat bukti terverifikasi.</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 dark:bg-slate-800/60 text-slate-500 dark:text-slate-400 uppercase font-bold border-b border-slate-200 dark:border-slate-800">
                    <tr>
                        <th class="py-3.5 px-4">Nama Kompetensi</th>
                        <th class="py-3.5 px-4">Domain</th>
                        <th class="py-3.5 px-4 text-center">Req Target</th>
                        <th class="py-3.5 px-4 text-center">Current Level</th>
                        <th class="py-3.5 px-4 text-center">Skill Gap</th>
                        <th class="py-3.5 px-4">Status & Tindakan</th>
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
                            <td class="py-4 px-4 text-center font-extrabold text-slate-700 dark:text-slate-200">
                                {{ number_format($gap['required_level'], 1) }}
                            </td>
                            <td class="py-4 px-4 text-center font-extrabold text-blue-600 dark:text-blue-400">
                                {{ number_format($gap['current_level'], 1) }}
                            </td>
                            <td class="py-4 px-4 text-center">
                                @if($gap['gap'] > 0)
                                    <span class="inline-block px-3 py-1 bg-amber-100 dark:bg-amber-900/40 text-amber-800 dark:text-amber-300 rounded-lg font-extrabold text-xs">
                                        -{{ number_format($gap['gap'], 1) }}
                                    </span>
                                @else
                                    <span class="inline-block px-3 py-1 bg-emerald-100 dark:bg-emerald-900/40 text-emerald-800 dark:text-emerald-300 rounded-lg font-extrabold text-xs">
                                        0.0 (Memenuhi)
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                @if($gap['gap'] > 0)
                                    <a href="{{ route('evidence.create') }}" class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-bold text-[11px] inline-flex items-center space-x-1 shadow-xs hover-lift">
                                        <span>+ Bukti Baru</span>
                                    </a>
                                @else
                                    <span class="text-emerald-600 dark:text-emerald-400 font-bold text-xs flex items-center space-x-1">
                                        <span class="material-symbols-outlined text-sm">verified</span>
                                        <span>Terverifikasi</span>
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
