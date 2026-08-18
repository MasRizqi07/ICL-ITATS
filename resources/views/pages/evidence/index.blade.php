@extends('layouts.app')

@section('title', 'Daftar Bukti Kemampuan - ICL ITATS')

@section('content')
<div class="space-y-6 animate-fade-in-up">

    <!-- Header Section -->
    <div class="relative overflow-hidden bg-gradient-to-r from-teal-950 via-slate-900 to-teal-900 text-white p-6 sm:p-8 rounded-3xl shadow-lg border border-teal-800/30">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-teal-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div>
                <div class="flex items-center space-x-3">
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Portofolio Bukti Kemampuan 📁</h1>
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-teal-500/30 text-teal-200 border border-teal-400/30">
                        Evidence Layer
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-teal-100 mt-2 max-w-2xl leading-relaxed">
                    Kumpulan artefak proyek, sertifikasi, repositori kode, dan berkas privat yang diverifikasi langsung oleh dosen reviewer.
                </p>
            </div>
            <a href="{{ route('evidence.create') }}" class="px-5 py-2.5 bg-teal-500 hover:bg-teal-600 text-slate-950 text-xs font-extrabold rounded-xl shadow-md transition hover-lift flex items-center space-x-2 shrink-0">
                <span class="material-symbols-outlined text-base">add_circle</span>
                <span>Tambah Bukti Baru</span>
            </a>
        </div>
    </div>

    <!-- Summary Metrics Badges -->
    @php
        $totalCount = $evidence->count();
        $verifiedCount = $evidence->where('validation_status', 'verified')->count();
        $pendingCount = $evidence->where('validation_status', 'pending')->count();
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xs hover-lift">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Total Bukti Terunggah</span>
                <span class="p-2 rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-900/40 dark:text-blue-400">
                    <span class="material-symbols-outlined text-xl">folder</span>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-slate-900 dark:text-white mt-3">{{ $totalCount }}</div>
            <span class="text-[11px] text-slate-400 font-medium">Artefak Portofolio</span>
        </div>

        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xs hover-lift">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Terverifikasi Dosen</span>
                <span class="p-2 rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-900/40 dark:text-emerald-400">
                    <span class="material-symbols-outlined text-xl">verified</span>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400 mt-3">{{ $verifiedCount }}</div>
            <span class="text-[11px] text-slate-400 font-medium">Validasi Otoritatif Selesai</span>
        </div>

        <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xs hover-lift">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Menunggu Peninjauan</span>
                <span class="p-2 rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-900/40 dark:text-amber-400">
                    <span class="material-symbols-outlined text-xl">pending_actions</span>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-amber-600 dark:text-amber-400 mt-3">{{ $pendingCount }}</div>
            <span class="text-[11px] text-slate-400 font-medium">Dalam Antrean Review</span>
        </div>
    </div>

    <!-- Evidence Cards List Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($evidence as $item)
            <div class="bg-white dark:bg-slate-900 p-6 sm:p-7 rounded-3xl border border-line dark:border-slate-800 shadow-sm hover-lift flex flex-col justify-between space-y-4">
                <div class="space-y-3">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex items-center space-x-3">
                            <span class="p-2.5 rounded-2xl bg-blue-50 text-blue-600 dark:bg-blue-900/40 dark:text-blue-300">
                                <span class="material-symbols-outlined text-2xl">
                                    {{ $item->type === 'certificate' ? 'workspace_premium' : ($item->type === 'project' ? 'code' : 'folder_open') }}
                                </span>
                            </span>
                            <div>
                                <h3 class="font-bold text-slate-900 dark:text-white text-base">{{ $item->title }}</h3>
                                <span class="px-2 py-0.5 rounded text-[10px] font-extrabold uppercase tracking-wider bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 mt-1 inline-block">
                                    {{ $item->type }}
                                </span>
                            </div>
                        </div>

                        <!-- Status Badge -->
                        @if($item->validation_status === 'verified')
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300 font-extrabold text-xs rounded-xl flex items-center space-x-1 shadow-2xs shrink-0">
                                <span class="material-symbols-outlined text-xs">verified</span>
                                <span>Terverifikasi</span>
                            </span>
                        @elseif($item->validation_status === 'pending')
                            <span class="px-3 py-1 bg-amber-100 text-amber-800 dark:bg-amber-900/50 dark:text-amber-300 font-extrabold text-xs rounded-xl flex items-center space-x-1 shadow-2xs shrink-0">
                                <span class="material-symbols-outlined text-xs">hourglass_empty</span>
                                <span>Menunggu Review</span>
                            </span>
                        @else
                            <span class="px-3 py-1 bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 font-bold text-xs rounded-xl shrink-0">
                                {{ $item->validation_status }}
                            </span>
                        @endif
                    </div>

                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                        {{ $item->description }}
                    </p>

                    <!-- Links & Downloads -->
                    <div class="flex flex-wrap items-center gap-3 pt-1">
                        @if($item->source_url)
                            <a href="{{ $item->source_url }}" target="_blank" class="inline-flex items-center space-x-1.5 px-3 py-1.5 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-xl text-xs font-bold hover:bg-blue-100 transition">
                                <span class="material-symbols-outlined text-sm">open_in_new</span>
                                <span>Tautan Repositori / Sertifikat</span>
                            </a>
                        @endif

                        @if($item->storage_key)
                            <a href="{{ route('evidence.download', $item->id) }}" class="inline-flex items-center space-x-1.5 px-3 py-1.5 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 rounded-xl text-xs font-bold hover:bg-emerald-100 transition">
                                <span class="material-symbols-outlined text-sm">download</span>
                                <span>Unduh Berkas Portofolio</span>
                            </a>
                        @endif
                    </div>

                    <!-- Reviewer Note -->
                    @if($item->reviewer_note)
                        <div class="p-3.5 bg-teal-50/80 dark:bg-teal-900/30 border border-teal-200 dark:border-teal-800 rounded-2xl text-xs space-y-1">
                            <strong class="text-teal-900 dark:text-teal-200 font-bold flex items-center space-x-1">
                                <span class="material-symbols-outlined text-sm">chat</span>
                                <span>Catatan Umpan Balik Dosen Reviewer:</span>
                            </strong>
                            <p class="text-teal-800 dark:text-teal-300 pl-5">{{ $item->reviewer_note }}</p>
                        </div>
                    @endif
                </div>

                <div class="pt-3 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between text-[11px] text-slate-400 dark:text-slate-500">
                    <span>Diperoleh: {{ $item->obtained_at ? date('d M Y', strtotime($item->obtained_at)) : '-' }}</span>
                    <span>Kompetensi: <strong class="text-slate-600 dark:text-slate-300">{{ $item->competencies->pluck('name')->implode(', ') }}</strong></span>
                </div>
            </div>
        @empty
            <div class="col-span-2 bg-white dark:bg-slate-900 p-12 text-center rounded-3xl border border-line dark:border-slate-800 space-y-4">
                <span class="material-symbols-outlined text-5xl text-slate-300 dark:text-slate-600">folder_off</span>
                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white text-base">Belum Ada Bukti Portofolio</h4>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Unggah sertifikat, tugas proyek, atau repositori untuk diverifikasi dosen pembimbing.</p>
                </div>
                <a href="{{ route('evidence.create') }}" class="inline-block px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-bold shadow-md transition hover-lift">
                    + Tambah Bukti Pertama
                </a>
            </div>
        @endforelse
    </div>

</div>
@endsection
