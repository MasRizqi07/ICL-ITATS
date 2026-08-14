@extends('layouts.app')

@section('title', 'Dashboard Reviewer Dosen - ICL ITATS')

@section('content')
<div class="space-y-6">

    <div class="bg-teal-900 text-white p-6 rounded-2xl shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold">Portal Penilaian & Reviewer Dosen</h1>
            <p class="text-xs text-teal-200 mt-1">
                Selamat Datang, {{ $user->name }} • Tim Assessor Sertifikasi Kompetensi Perangkat Lunak ITATS
            </p>
        </div>
        <div class="flex items-center space-x-3">
            <span class="px-3 py-1.5 bg-teal-800 text-teal-100 rounded-lg text-xs font-semibold">
                {{ count($pendingEvidence) }} Bukti Menunggu Review
            </span>
        </div>
    </div>

    <!-- Reviewer Metrics -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-slate-200 dark:border-slate-700">
            <span class="text-xs text-slate-500 font-medium">Pending Review</span>
            <div class="text-2xl font-bold text-amber-600 mt-1">{{ count($pendingEvidence) }}</div>
            <span class="text-[11px] text-slate-400">Bukti mahasiswa yang perlu diverifikasi</span>
        </div>

        <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-slate-200 dark:border-slate-700">
            <span class="text-xs text-slate-500 font-medium">Total Terverifikasi</span>
            <div class="text-2xl font-bold text-teal-600 mt-1">{{ $verifiedCount }}</div>
            <span class="text-[11px] text-slate-400">Bukti portofolio valid</span>
        </div>

        <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-slate-200 dark:border-slate-700">
            <span class="text-xs text-slate-500 font-medium">Peran Assessor</span>
            <div class="text-2xl font-bold text-slate-900 dark:text-white mt-1">Dosen Reviewer</div>
            <span class="text-[11px] text-slate-400">Prodi {{ $user->program }}</span>
        </div>
    </div>

    <!-- Pending Evidence Queue Table -->
    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6 space-y-4">
        <h3 class="font-bold text-slate-900 dark:text-white text-base">Antrean Bukti Mahasiswa Menunggu Penilaian</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 dark:bg-slate-700/50 text-slate-500 dark:text-slate-400 uppercase font-semibold">
                    <tr>
                        <th class="py-3 px-4">Mahasiswa</th>
                        <th class="py-3 px-4">Judul Bukti Kemampuan</th>
                        <th class="py-3 px-4">Jenis</th>
                        <th class="py-3 px-4">Kompetensi Terkait</th>
                        <th class="py-3 px-4">Tanggal Submit</th>
                        <th class="py-3 px-4">Aksi Penilaian</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                    @forelse($pendingEvidence as $ev)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30">
                            <td class="py-3.5 px-4 font-bold text-slate-900 dark:text-white">
                                {{ $ev->user->name }}
                            </td>
                            <td class="py-3.5 px-4 font-medium text-slate-800 dark:text-slate-200">
                                {{ $ev->title }}
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 text-slate-600 rounded font-semibold uppercase text-[10px]">
                                    {{ $ev->type }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-slate-600 dark:text-slate-300">
                                {{ $ev->competencies->pluck('name')->implode(', ') }}
                            </td>
                            <td class="py-3.5 px-4 text-slate-400">
                                {{ date('d M Y', strtotime($ev->created_at)) }}
                            </td>
                            <td class="py-3.5 px-4">
                                <a href="{{ route('reviewer.evidence.show', $ev->id) }}" class="px-3 py-1.5 bg-teal-600 hover:bg-teal-700 text-white font-semibold text-xs rounded-lg transition inline-flex items-center space-x-1">
                                    <span class="material-symbols-outlined text-xs">rate_review</span>
                                    <span>Tinjau & Beri Nilai</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-400">
                                Tidak ada antrean bukti yang menunggu verifikasi saat ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
