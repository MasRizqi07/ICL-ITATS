@extends('layouts.app')

@section('title', 'Pengaturan Privasi Data - ICL ITATS')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-line dark:border-slate-700">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Pengaturan Privasi & AI Data Consent</h1>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
            KontrolVisibilitas portofolio dan opsi penggunaan data anonim untuk fitur bantuan AI.
        </p>
    </div>

    <div class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-slate-200 dark:border-slate-700 space-y-4">
        <label class="flex items-center justify-between cursor-pointer">
            <div>
                <strong class="text-xs text-slate-900 dark:text-white block">Visibilitas Portofolio kepada Dosen Reviewer</strong>
                <span class="text-[11px] text-slate-500">Izinkan dosen pembimbing melihat bukti kompetensi Anda</span>
            </div>
            <input type="checkbox" checked class="rounded text-blue-600 focus:ring-blue-500">
        </label>

        <label class="flex items-center justify-between cursor-pointer pt-3 border-t border-slate-100 dark:border-slate-700">
            <div>
                <strong class="text-xs text-slate-900 dark:text-white block">Izinkan AI Mengakses Konteks Anonim</strong>
                <span class="text-[11px] text-slate-500">Kirim data skill gap secara terbatas tanpa identitas pribadi ke AI Engine</span>
            </div>
            <input type="checkbox" checked class="rounded text-blue-600 focus:ring-blue-500">
        </label>
    </div>
</div>
@endsection
