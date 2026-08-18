@extends('layouts.app')

@section('title', 'Penilaian Bukti Mahasiswa - Reviewer ICL ITATS')

@section('content')
<div class="max-w-3xl mx-auto space-y-8 animate-fade-in-up">

    <!-- Header Section -->
    <div class="relative overflow-hidden bg-gradient-to-r from-teal-950 via-teal-900 to-slate-900 text-white p-6 sm:p-8 rounded-3xl shadow-lg border border-teal-800/30">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-teal-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 space-y-2">
            <div class="flex items-center space-x-2.5">
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-teal-500/30 text-teal-200 border border-teal-400/30">
                    Form Evaluasi Reviewer Dosen
                </span>
                <span class="text-xs text-teal-200">Verifikasi Otoritatif</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">{{ $evidence->title }}</h1>
            <p class="text-xs sm:text-sm text-teal-100 max-w-2xl leading-relaxed">
                Pengaju: <strong class="text-white">{{ $evidence->user->name }}</strong> ({{ $evidence->user->program ?? 'Teknik Informatika' }}) • Jenis Bukti: {{ strtoupper($evidence->type) }}
            </p>
        </div>
    </div>

    <!-- Evidence Details Box Card -->
    <div class="bg-white dark:bg-slate-900 p-6 sm:p-8 rounded-3xl border border-line dark:border-slate-800 shadow-sm space-y-5">
        <div>
            <h3 class="font-extrabold text-slate-900 dark:text-white text-base">Deskripsi & Tautan Portofolio</h3>
            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed mt-2">
                {{ $evidence->description }}
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3 pt-2">
            @if($evidence->source_url)
                <a href="{{ $evidence->source_url }}" target="_blank" class="inline-flex items-center space-x-1.5 px-4 py-2 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-xl text-xs font-bold hover:bg-blue-100 transition">
                    <span class="material-symbols-outlined text-sm">open_in_new</span>
                    <span>Buka Tautan: {{ $evidence->source_url }}</span>
                </a>
            @endif

            @if($evidence->storage_key)
                <a href="{{ route('evidence.download', $evidence->id) }}" class="inline-flex items-center space-x-1.5 px-4 py-2 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 rounded-xl text-xs font-bold hover:bg-emerald-100 transition">
                    <span class="material-symbols-outlined text-sm">download</span>
                    <span>Unduh Berkas Privat Bukti (PDF/ZIP)</span>
                </a>
            @endif
        </div>

        <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between text-xs">
            <span class="text-slate-500 dark:text-slate-400">
                Kompetensi yang Didukung: <strong class="text-slate-800 dark:text-slate-200">{{ $evidence->competencies->pluck('name')->implode(', ') }}</strong>
            </span>
            <span class="text-slate-400">
                Diserahkan: {{ date('d M Y', strtotime($evidence->created_at)) }}
            </span>
        </div>
    </div>

    <!-- Verification Decision Form Card -->
    <form action="{{ route('reviewer.evidence.review', $evidence->id) }}" method="POST" class="bg-white dark:bg-slate-900 p-6 sm:p-8 rounded-3xl border border-line dark:border-slate-800 shadow-sm space-y-6">
        @csrf

        <div class="space-y-3">
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300">Keputusan Verifikasi Status <span class="text-red-500">*</span></label>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <label class="p-4 border border-slate-200 dark:border-slate-700 rounded-2xl cursor-pointer flex items-center space-x-3 hover:bg-teal-50/50 dark:hover:bg-slate-800 transition group has-checked:border-teal-600 has-checked:bg-teal-50/30 dark:has-checked:bg-teal-900/20">
                    <input type="radio" name="validation_status" value="verified" checked class="h-4 w-4 text-teal-600 focus:ring-teal-500">
                    <div>
                        <strong class="text-xs font-bold text-slate-900 dark:text-white block">Terverifikasi (Verified)</strong>
                        <span class="text-[11px] text-slate-500 dark:text-slate-400">Bukti valid & layak meningkatkan tingkat level</span>
                    </div>
                </label>

                <label class="p-4 border border-slate-200 dark:border-slate-700 rounded-2xl cursor-pointer flex items-center space-x-3 hover:bg-amber-50/50 dark:hover:bg-slate-800 transition group has-checked:border-amber-600 has-checked:bg-amber-50/30 dark:has-checked:bg-amber-900/20">
                    <input type="radio" name="validation_status" value="needs_revision" class="h-4 w-4 text-amber-600 focus:ring-amber-500">
                    <div>
                        <strong class="text-xs font-bold text-slate-900 dark:text-white block">Perlu Revisi</strong>
                        <span class="text-[11px] text-slate-500 dark:text-slate-400">Bukti belum mencukupi atau tautan tidak dapat diakses</span>
                    </div>
                </label>
            </div>
        </div>

        <div class="space-y-1.5">
            <label for="reviewer_note" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Umpan Balik & Catatan Dosen Reviewer <span class="text-red-500">*</span></label>
            <textarea id="reviewer_note" name="reviewer_note" rows="4" required
                class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs text-slate-900 dark:text-white focus:ring-2 focus:ring-teal-600 focus:border-teal-600 outline-none transition"
                placeholder="Tuliskan apresiasi, masukan pengayaan, atau alasan revisi bagi mahasiswa..."></textarea>
        </div>

        <div class="flex items-center justify-between pt-4 border-t border-slate-100 dark:border-slate-800">
            <a href="{{ route('reviewer.index') }}" class="px-6 py-3 text-xs font-bold text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                Kembali ke Antrean
            </a>
            <button type="submit" class="px-8 py-3.5 text-xs font-bold text-white bg-teal-600 hover:bg-teal-700 rounded-xl shadow-md transition hover-lift flex items-center space-x-2">
                <span>Simpan Keputusan Penilaian</span>
                <span class="material-symbols-outlined text-base">check</span>
            </button>
        </div>
    </form>

</div>
@endsection
