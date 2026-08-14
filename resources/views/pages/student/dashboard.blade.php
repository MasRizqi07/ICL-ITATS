@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa - ICL ITATS')

@section('content')
<div class="space-y-6">
    
    <!-- Welcome Header Banner -->
    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-[#D9E0E8] dark:border-slate-700 shadow-2xs flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center space-x-2">
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Selamat Datang, {{ $user->name }}!</h1>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300">
                    Semester {{ $user->semester ?? 6 }}
                </span>
            </div>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                Program Studi {{ $user->program ?? 'Teknik Informatika' }} • Target Karier Utama: <strong class="text-blue-600 dark:text-blue-400">{{ $career->name }}</strong>
            </p>
        </div>

        <div class="flex items-center space-x-3">
            <a href="{{ route('assessment.show') }}" class="px-4 py-2.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-2xs transition flex items-center space-x-2">
                <span class="material-symbols-outlined text-base">quiz</span>
                <span>Kerjakan Asesmen</span>
            </a>
            <a href="{{ route('evidence.create') }}" class="px-4 py-2.5 text-xs font-semibold text-slate-700 dark:text-slate-200 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 rounded-lg transition flex items-center space-x-2">
                <span class="material-symbols-outlined text-base">add_circle</span>
                <span>Tambah Bukti</span>
            </a>
        </div>
    </div>

    <!-- Summary KPI Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-slate-200 dark:border-slate-700">
            <div class="flex items-center justify-between">
                <span class="text-xs font-medium text-slate-500 dark:text-slate-400">Total Kompetensi Karier</span>
                <span class="material-symbols-outlined text-blue-600">work</span>
            </div>
            <div class="text-2xl font-bold text-slate-900 dark:text-white mt-2">{{ count($gaps) }}</div>
            <span class="text-[11px] text-slate-400">Standar Kurikulum</span>
        </div>

        <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-slate-200 dark:border-slate-700">
            <div class="flex items-center justify-between">
                <span class="text-xs font-medium text-slate-500 dark:text-slate-400">Bukti Terverifikasi</span>
                <span class="material-symbols-outlined text-teal-600">verified</span>
            </div>
            <div class="text-2xl font-bold text-teal-600 mt-2">{{ $verifiedEvidence }}</div>
            <span class="text-[11px] text-slate-400">{{ $pendingEvidence }} Menunggu Review</span>
        </div>

        <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-slate-200 dark:border-slate-700">
            <div class="flex items-center justify-between">
                <span class="text-xs font-medium text-slate-500 dark:text-slate-400">Reassessment Snapshot</span>
                <span class="material-symbols-outlined text-purple-600">history</span>
            </div>
            <div class="text-2xl font-bold text-slate-900 dark:text-white mt-2">
                {{ $latestReassessment ? 'v1.0' : 'Belum ada' }}
            </div>
            <span class="text-[11px] text-slate-400">Reassessment Aktif</span>
        </div>

        <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-slate-200 dark:border-slate-700">
            <div class="flex items-center justify-between">
                <span class="text-xs font-medium text-slate-500 dark:text-slate-400">Aktivitas Rencana Aksi</span>
                <span class="material-symbols-outlined text-amber-600">checklist</span>
            </div>
            <div class="text-2xl font-bold text-slate-900 dark:text-white mt-2">
                {{ $plan ? $plan->activities->where('status', 'completed')->count() : 0 }} / {{ $plan ? $plan->activities->count() : 0 }}
            </div>
            <span class="text-[11px] text-slate-400">Aktivitas Selesai</span>
        </div>
    </div>

    <!-- Main Competency Map Table Preview -->
    <div class="bg-white dark:bg-slate-800 rounded-xl border border-[#D9E0E8] dark:border-slate-700 p-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="text-base font-bold text-slate-900 dark:text-white">Peta Ringkasan Kompetensi Karier Target</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400">Perbandingan antara *Required Level* industri dan *Current Level* mahasiswa.</p>
            </div>
            <a href="{{ route('competency.map') }}" class="text-xs font-semibold text-blue-600 hover:underline flex items-center space-x-1">
                <span>Lihat Detail Peta Kompetensi</span>
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 dark:bg-slate-700/50 text-slate-500 dark:text-slate-400 uppercase font-semibold border-b border-slate-200 dark:border-slate-700">
                    <tr>
                        <th class="py-3 px-4">Nama Kompetensi</th>
                        <th class="py-3 px-4">Domain</th>
                        <th class="py-3 px-4">Target (Req)</th>
                        <th class="py-3 px-4">Saat Ini (Curr)</th>
                        <th class="py-3 px-4">Skill Gap</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                    @foreach($gaps as $gap)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition">
                            <td class="py-3.5 px-4 font-semibold text-slate-900 dark:text-white">
                                {{ $gap['name'] }}
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 rounded font-medium">
                                    {{ $gap['domain'] }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 font-semibold text-slate-700 dark:text-slate-200">
                                {{ number_format($gap['required_level'], 1) }}
                            </td>
                            <td class="py-3.5 px-4 font-semibold text-blue-600 dark:text-blue-400">
                                {{ number_format($gap['current_level'], 1) }}
                            </td>
                            <td class="py-3.5 px-4">
                                @if($gap['gap'] > 0)
                                    <span class="text-amber-600 font-bold">-{{ number_format($gap['gap'], 1) }}</span>
                                @else
                                    <span class="text-emerald-600 font-bold">0.0 (Memenuhi)</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4">
                                @if($gap['status'] === 'terverifikasi')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300">
                                        <span class="material-symbols-outlined text-xs mr-1">verified</span> Terverifikasi
                                    </span>
                                @elseif($gap['status'] === 'memenuhi')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold bg-teal-100 text-teal-800 dark:bg-teal-900/50 dark:text-teal-300">
                                        Memenuhi
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold bg-amber-100 text-amber-800 dark:bg-amber-900/50 dark:text-amber-300">
                                        Perlu Ditingkatkan
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4">
                                <a href="{{ route('evidence.create') }}" class="text-blue-600 hover:underline font-semibold">
                                    Tambah Bukti
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- AI Assistance Panel for Skill Gap Recommendation -->
    <div class="bg-purple-50/70 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800 rounded-xl p-6 relative">
        <div class="flex items-center justify-between mb-3">
            <div class="flex items-center space-x-2">
                <span class="material-symbols-outlined text-purple-600 dark:text-purple-400">auto_awesome</span>
                <h4 class="font-bold text-slate-900 dark:text-white text-sm">Ringkasan Analisis AI Support</h4>
            </div>
            <span class="px-2 py-0.5 bg-purple-200 text-purple-800 dark:bg-purple-900 dark:text-purple-200 rounded text-[10px] font-bold tracking-wide">
                Dibantu AI (Non-Otoritatif)
            </span>
        </div>
        <p class="text-xs text-slate-700 dark:text-slate-300 leading-relaxed mb-4">
            Berdasarkan skor asesmen dan bukti Anda, fokus prioritas pengembangan minggu ini adalah menuntaskan aktivitas pada kompetensi <strong>RESTful API & Security Standard</strong> (selisih gap 2.0 tingkat).
        </p>
        <div class="flex items-center space-x-3">
            <a href="{{ route('development-plans.index') }}" class="px-3 py-1.5 bg-purple-600 hover:bg-purple-700 text-white rounded-lg text-xs font-semibold transition">
                Lihat Rencana Aksi Pengembangan
            </a>
        </div>
    </div>

</div>
@endsection
