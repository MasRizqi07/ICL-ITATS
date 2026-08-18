@extends('layouts.app')

@section('title', 'Riwayat Penilaian Ulang (Reassessment) - ICL ITATS')

@section('content')
<div class="space-y-8 animate-fade-in-up">

    <!-- Header Section -->
    <div class="relative overflow-hidden bg-gradient-to-r from-purple-950 via-slate-900 to-indigo-950 text-white p-6 sm:p-8 rounded-3xl shadow-lg border border-purple-800/30">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-purple-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div>
                <div class="flex items-center space-x-3">
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Riwayat Penilaian Ulang (Reassessment) 🔄</h1>
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-purple-500/30 text-purple-200 border border-purple-400/30">
                        Snapshot Engine
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-purple-100 mt-2 max-w-2xl leading-relaxed">
                    Catatan *snapshot* terenkripsi permanen yang memperlihatkan grafik rekam jejak pertumbuhan kompetensi (*before vs after*) setiap kali ada bukti baru yang terverifikasi.
                </p>
            </div>
            <form action="{{ route('reassessments.trigger') }}" method="POST" class="shrink-0">
                @csrf
                <button type="submit" class="px-5 py-2.5 bg-purple-500 hover:bg-purple-600 text-slate-950 text-xs font-extrabold rounded-xl shadow-md transition hover-lift flex items-center space-x-2">
                    <span class="material-symbols-outlined text-base">published_with_changes</span>
                    <span>Trigger Snapshot Baru</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Snapshot Metadata KPI Cards -->
    @if($latestSnapshot)
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xs hover-lift">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Versi Snapshot Aktif</span>
                    <span class="p-2 rounded-xl bg-purple-50 text-purple-600 dark:bg-purple-900/40 dark:text-purple-400">
                        <span class="material-symbols-outlined text-xl">history</span>
                    </span>
                </div>
                <div class="text-3xl font-extrabold text-purple-600 dark:text-purple-400 mt-3">v{{ $latestSnapshot->rule_version }}.0</div>
                <span class="text-[11px] text-slate-400 font-medium">Dirilis: {{ date('d M Y, H:i', strtotime($latestSnapshot->completed_at)) }}</span>
            </div>

            <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xs hover-lift">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Total Indikator Terekam</span>
                    <span class="p-2 rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-900/40 dark:text-blue-400">
                        <span class="material-symbols-outlined text-xl">dataset</span>
                    </span>
                </div>
                <div class="text-3xl font-extrabold text-slate-900 dark:text-white mt-3">{{ $latestSnapshot->snapshots->count() }} Standar</div>
                <span class="text-[11px] text-slate-400 font-medium">Standar Karier {{ $career->name }}</span>
            </div>

            <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xs hover-lift">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Rata-rata Skor Level</span>
                    <span class="p-2 rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-900/40 dark:text-emerald-400">
                        <span class="material-symbols-outlined text-xl">trending_up</span>
                    </span>
                </div>
                @php
                    $avgCurr = $latestSnapshot->snapshots->avg('current_level');
                @endphp
                <div class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400 mt-3">{{ number_format($avgCurr, 1) }} / 5.0</div>
                <span class="text-[11px] text-slate-400 font-medium">Tingkat Kemampuan Riil</span>
            </div>
        </div>

        <!-- Latest Snapshot Detailed Table -->
        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-line dark:border-slate-800 p-6 sm:p-8 shadow-sm space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 dark:border-slate-800 pb-4">
                <div>
                    <h3 class="text-lg font-extrabold text-slate-900 dark:text-white tracking-tight">
                        Rincian Matriks Snapshot Terkini (v{{ $latestSnapshot->rule_version }}.0)
                    </h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Rekam data kemampuan yang dikunci dan dapat diaudit oleh asesor universitas.</p>
                </div>
                <span class="px-3 py-1 bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300 font-extrabold text-xs rounded-full inline-flex items-center space-x-1">
                    <span class="material-symbols-outlined text-xs">verified</span>
                    <span>Snapshot Aktif</span>
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 dark:bg-slate-800/60 text-slate-500 dark:text-slate-400 uppercase font-bold border-b border-slate-200 dark:border-slate-800">
                        <tr>
                            <th class="py-3.5 px-4">Nama Kompetensi</th>
                            <th class="py-3.5 px-4">Required Target</th>
                            <th class="py-3.5 px-4">Current Level</th>
                            <th class="py-3.5 px-4">Skill Gap</th>
                            <th class="py-3.5 px-4">Ringkasan Bukti</th>
                            <th class="py-3.5 px-4">Penjelasan Engine</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @foreach($latestSnapshot->snapshots as $snap)
                            <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/40 transition">
                                <td class="py-4 px-4 font-bold text-slate-900 dark:text-white">
                                    {{ $snap->competency->name }}
                                </td>
                                <td class="py-4 px-4 font-extrabold text-slate-700 dark:text-slate-200">
                                    {{ number_format($snap->required_level, 1) }}
                                </td>
                                <td class="py-4 px-4 font-extrabold text-blue-600 dark:text-blue-400">
                                    {{ number_format($snap->current_level, 1) }}
                                </td>
                                <td class="py-4 px-4">
                                    @if($snap->gap > 0)
                                        <span class="px-2.5 py-1 bg-amber-100 text-amber-800 dark:bg-amber-900/50 dark:text-amber-300 font-bold text-[11px] rounded-lg">
                                            -{{ number_format($snap->gap, 1) }}
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300 font-bold text-[11px] rounded-lg">
                                            0.0 (Memenuhi)
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 text-slate-600 dark:text-slate-300">
                                    {{ $snap->evidence_summary }}
                                </td>
                                <td class="py-4 px-4 text-slate-500 dark:text-slate-400">
                                    {{ $snap->explanation }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="bg-white dark:bg-slate-900 p-12 text-center rounded-3xl border border-line dark:border-slate-800 space-y-4">
            <span class="material-symbols-outlined text-5xl text-slate-300 dark:text-slate-600">history_toggle_off</span>
            <div>
                <h4 class="font-bold text-slate-900 dark:text-white text-base">Belum Ada Snapshot Tersimpan</h4>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Selesaikan asesmen mandiri atau klik Trigger Snapshot Baru untuk mengunci snapshot pertama Anda.</p>
            </div>
        </div>
    @endif

</div>
@endsection
