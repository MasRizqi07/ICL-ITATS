@extends('layouts.app')

@section('title', 'Riwayat Penilaian Ulang (Reassessment) - ICL ITATS')

@section('content')
<div class="space-y-6">

    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-line dark:border-slate-700 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Riwayat Penilaian Ulang (Reassessment Snapshots)</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                Catatan *snapshot* permanen yang memperlihatkan grafik perkembangan (*before vs after*) setiap kali Anda menambah bukti atau menyelesaikan aktivitas.
            </p>
        </div>
        <form action="{{ route('reassessments.trigger') }}" method="POST">
            @csrf
            <button type="submit" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-xl shadow-xs transition flex items-center space-x-2">
                <span class="material-symbols-outlined text-base">published_with_changes</span>
                <span>Trigger Snapshot Baru</span>
            </button>
        </form>
    </div>

    <!-- Reassessment Snapshots History Table -->
    @if($latestSnapshot)
        <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6 space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-700 pb-3">
                <h3 class="font-bold text-slate-900 dark:text-white text-base">
                    Snapshot Terakhir (Versi {{ $latestSnapshot->rule_version }}) — {{ date('d M Y, H:i', strtotime($latestSnapshot->completed_at)) }}
                </h3>
                <span class="px-2.5 py-0.5 bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300 font-semibold text-xs rounded-full">
                    Snapshot Aktif
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 dark:bg-slate-700/50 text-slate-500 dark:text-slate-400 uppercase font-semibold">
                        <tr>
                            <th class="py-3 px-4">Nama Kompetensi</th>
                            <th class="py-3 px-4">Required Target</th>
                            <th class="py-3 px-4">Current Level</th>
                            <th class="py-3 px-4">Skill Gap</th>
                            <th class="py-3 px-4">Ringkasan Bukti</th>
                            <th class="py-3 px-4">Penjelasan Engine</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        @foreach($latestSnapshot->snapshots as $snap)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30">
                                <td class="py-3.5 px-4 font-bold text-slate-900 dark:text-white">
                                    {{ $snap->competency->name }}
                                </td>
                                <td class="py-3.5 px-4 font-semibold text-slate-700 dark:text-slate-300">
                                    {{ number_format($snap->required_level, 1) }}
                                </td>
                                <td class="py-3.5 px-4 font-bold text-blue-600 dark:text-blue-400">
                                    {{ number_format($snap->current_level, 1) }}
                                </td>
                                <td class="py-3.5 px-4">
                                    @if($snap->gap > 0)
                                        <span class="font-bold text-amber-600">-{{ number_format($snap->gap, 1) }}</span>
                                    @else
                                        <span class="font-bold text-emerald-600">0.0 (Memenuhi)</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-slate-600 dark:text-slate-300">
                                    {{ $snap->evidence_summary }}
                                </td>
                                <td class="py-3.5 px-4 text-slate-500 dark:text-slate-400">
                                    {{ $snap->explanation }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="bg-white dark:bg-slate-800 p-8 text-center rounded-xl border border-slate-200 dark:border-slate-700">
            <p class="text-xs text-slate-500 font-medium">Belum ada riwayat snapshot penilaian ulang.</p>
        </div>
    @endif

</div>
@endsection
