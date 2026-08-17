@extends('layouts.app')

@section('title', 'Penilaian Bukti Mahasiswa - Reviewer ICL ITATS')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-line dark:border-slate-700">
        <span class="px-2.5 py-0.5 rounded text-[10px] font-bold bg-teal-100 text-teal-800 dark:bg-teal-900/50 dark:text-teal-300">
            Form Evaluasi Reviewer Dosen
        </span>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white mt-2">{{ $evidence->title }}</h1>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
            Pengaju: <strong>{{ $evidence->user->name }}</strong> ({{ $evidence->user->program }}) • Jenis: {{ strtoupper($evidence->type) }}
        </p>
    </div>

    <!-- Evidence Details Box -->
    <div class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-slate-200 dark:border-slate-700 space-y-4">
        <h3 class="font-bold text-slate-900 dark:text-white text-sm">Deskripsi Bukti & Tautan</h3>
        <p class="text-xs text-slate-700 dark:text-slate-300 leading-relaxed">
            {{ $evidence->description }}
        </p>

        @if($evidence->source_url)
            <div class="p-3 bg-blue-50 dark:bg-slate-700/50 rounded-lg">
                <a href="{{ $evidence->source_url }}" target="_blank" class="text-xs text-blue-600 dark:text-blue-400 font-semibold hover:underline flex items-center space-x-1">
                    <span class="material-symbols-outlined text-sm">open_in_new</span>
                    <span>Buka Tautan Bukti: {{ $evidence->source_url }}</span>
                </a>
            </div>
        @endif

        @if($evidence->storage_key)
            <div class="p-3 bg-emerald-50 dark:bg-emerald-900/30 rounded-lg">
                <a href="{{ route('evidence.download', $evidence->id) }}" class="text-xs text-emerald-700 dark:text-emerald-300 font-semibold hover:underline flex items-center space-x-1">
                    <span class="material-symbols-outlined text-sm">download</span>
                    <span>Unduh Berkas Privat Bukti Kemampuan (PDF/JPG/PNG/ZIP)</span>
                </a>
            </div>
        @endif

        <div class="text-xs text-slate-500 pt-2 border-t border-slate-100 dark:border-slate-700">
            Kompetensi Terkait: <strong>{{ $evidence->competencies->pluck('name')->implode(', ') }}</strong>
        </div>
    </div>

    <!-- Verification Form -->
    <form action="{{ route('reviewer.evidence.review', $evidence->id) }}" method="POST" class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-slate-200 dark:border-slate-700 space-y-4">
        @csrf

        <div>
            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-2">Keputusan Verifikasi Status *</label>
            <div class="grid grid-cols-2 gap-3">
                <label class="p-3 border border-slate-200 dark:border-slate-700 rounded-lg cursor-pointer flex items-center space-x-2 hover:bg-teal-50 dark:hover:bg-slate-700">
                    <input type="radio" name="validation_status" value="verified" checked class="text-teal-600 focus:ring-teal-500">
                    <div>
                        <strong class="text-xs text-teal-800 dark:text-teal-300 block">Terverifikasi (Verified)</strong>
                        <span class="text-[10px] text-slate-400">Bukti valid & sesuai standar</span>
                    </div>
                </label>

                <label class="p-3 border border-slate-200 dark:border-slate-700 rounded-lg cursor-pointer flex items-center space-x-2 hover:bg-amber-50 dark:hover:bg-slate-700">
                    <input type="radio" name="validation_status" value="needs_revision" class="text-amber-600 focus:ring-amber-500">
                    <div>
                        <strong class="text-xs text-amber-800 dark:text-amber-300 block">Perlu Revisi</strong>
                        <span class="text-[10px] text-slate-400">Memerlukan bukti tambahan</span>
                    </div>
                </label>
            </div>
        </div>

        <div>
            <label for="reviewer_note" class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-1">Umpan Balik & Catatan Dosen Reviewer *</label>
            <textarea id="reviewer_note" name="reviewer_note" rows="4" required class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-xs" placeholder="Tuliskan apresiasi, masukan, atau alasan hasil penilaian..."></textarea>
        </div>

        <div class="flex items-center justify-between pt-3">
            <a href="{{ route('reviewer.index') }}" class="px-4 py-2 text-xs font-semibold text-slate-600 bg-white border border-slate-300 rounded-lg">
                Kembali
            </a>
            <button type="submit" class="px-5 py-2 text-xs font-semibold text-white bg-teal-600 hover:bg-teal-700 rounded-lg shadow-xs transition">
                Simpan Penilaian
            </button>
        </div>
    </form>

</div>
@endsection
