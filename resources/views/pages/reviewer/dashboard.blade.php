@extends('layouts.app')

@section('title', 'Dashboard Reviewer Dosen - ICL ITATS')

@section('content')
<div class="space-y-8 animate-fade-in-up">

    <!-- Reviewer Welcome Header Banner -->
    <div class="relative overflow-hidden bg-gradient-to-r from-teal-950 via-teal-900 to-slate-900 text-white p-6 sm:p-8 rounded-3xl shadow-lg border border-teal-800/30">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-teal-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div>
                <div class="flex items-center space-x-3">
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Portal Penilaian & Reviewer Dosen 🎓</h1>
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-teal-500/30 text-teal-200 border border-teal-400/30">
                        Otoritatif Layer
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-teal-100 mt-2 max-w-xl leading-relaxed">
                    Selamat Datang, <strong>{{ $user->name }}</strong> • Tim Assessor Sertifikasi & Validasi Portofolio Mahasiswa ITATS.
                </p>
            </div>

            <div class="flex items-center space-x-3 shrink-0">
                <span class="px-4 py-2 bg-teal-500 text-slate-950 rounded-xl text-xs font-extrabold shadow-md flex items-center space-x-1.5">
                    <span class="material-symbols-outlined text-base">pending_actions</span>
                    <span>{{ count($pendingEvidence) }} Bukti Menunggu Review</span>
                </span>
            </div>
        </div>
    </div>

    <!-- Reviewer KPI Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xs hover-lift">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Antrean Pending Review</span>
                <span class="p-2 rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-900/40 dark:text-amber-400">
                    <span class="material-symbols-outlined text-xl">hourglass_top</span>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-amber-600 dark:text-amber-400 mt-3">{{ count($pendingEvidence) }}</div>
            <span class="text-[11px] text-slate-400 font-medium">Bukti mahasiswa yang perlu diverifikasi</span>
        </div>

        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xs hover-lift">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Total Portofolio Terverifikasi</span>
                <span class="p-2 rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-900/40 dark:text-emerald-400">
                    <span class="material-symbols-outlined text-xl">verified</span>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400 mt-3">{{ $verifiedCount }}</div>
            <span class="text-[11px] text-slate-400 font-medium">Validasi Otoritatif Selesai</span>
        </div>

        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xs hover-lift">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Peran Assessor Terdaftar</span>
                <span class="p-2 rounded-xl bg-teal-50 text-teal-600 dark:bg-teal-900/40 dark:text-teal-400">
                    <span class="material-symbols-outlined text-xl">school</span>
                </span>
            </div>
            <div class="text-xl font-extrabold text-slate-900 dark:text-white mt-4">Dosen Reviewer</div>
            <span class="text-[11px] text-slate-400 font-medium">Program Studi {{ $user->program ?? 'Teknik Informatika' }}</span>
        </div>
    </div>

    <!-- Pending Evidence Queue Table Card -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-line dark:border-slate-800 p-6 sm:p-8 shadow-sm space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 dark:border-slate-800 pb-4">
            <div>
                <h3 class="text-lg font-extrabold text-slate-900 dark:text-white tracking-tight">
                    Antrean Bukti Portofolio Mahasiswa Menunggu Penilaian
                </h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Tinjau artefak kode, dokumen, atau sertifikat untuk memverifikasi tingkat kompetensi.</p>
            </div>
            <span class="text-xs font-bold text-slate-400">Total: {{ count($pendingEvidence) }} Pengajuan</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 dark:bg-slate-800/60 text-slate-500 dark:text-slate-400 uppercase font-bold border-b border-slate-200 dark:border-slate-800">
                    <tr>
                        <th class="py-3.5 px-4">Mahasiswa</th>
                        <th class="py-3.5 px-4">Judul Bukti Kemampuan</th>
                        <th class="py-3.5 px-4">Jenis</th>
                        <th class="py-3.5 px-4">Kompetensi Terkait</th>
                        <th class="py-3.5 px-4">Tanggal Submit</th>
                        <th class="py-3.5 px-4">Aksi Penilaian</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($pendingEvidence as $ev)
                        <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/40 transition">
                            <td class="py-4 px-4 font-bold text-slate-900 dark:text-white">
                                <div class="flex items-center space-x-2.5">
                                    <div class="w-7 h-7 rounded-full bg-teal-100 dark:bg-teal-900/50 text-teal-800 dark:text-teal-300 font-bold text-xs flex items-center justify-center">
                                        {{ strtoupper(substr($ev->user->name, 0, 1)) }}
                                    </div>
                                    <span>{{ $ev->user->name }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-4 font-medium text-slate-800 dark:text-slate-200">
                                {{ $ev->title }}
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-2.5 py-1 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-lg font-bold uppercase text-[10px]">
                                    {{ $ev->type }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-slate-600 dark:text-slate-300">
                                {{ $ev->competencies->pluck('name')->implode(', ') }}
                            </td>
                            <td class="py-4 px-4 text-slate-400 dark:text-slate-500">
                                {{ date('d M Y', strtotime($ev->created_at)) }}
                            </td>
                            <td class="py-4 px-4">
                                <a href="{{ route('reviewer.evidence.show', $ev->id) }}" class="px-3.5 py-1.5 bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs rounded-xl shadow-xs transition hover-lift inline-flex items-center space-x-1.5">
                                    <span class="material-symbols-outlined text-xs">rate_review</span>
                                    <span>Tinjau & Beri Nilai</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-400 dark:text-slate-500">
                                <span class="material-symbols-outlined text-4xl block mb-2 text-slate-300 dark:text-slate-600">task_alt</span>
                                Tidak ada antrean bukti yang menunggu verifikasi saat ini. Semua portofolio telah tertinjau.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
