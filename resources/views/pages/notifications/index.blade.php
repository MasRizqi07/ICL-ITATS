@extends('layouts.app')

@section('title', 'Pusat Notifikasi & Umpan Balik - ICL ITATS')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 animate-fade-in-up">

    <!-- Header Section -->
    <div class="relative overflow-hidden bg-gradient-to-r from-blue-900 via-indigo-900 to-slate-900 text-white p-6 sm:p-8 rounded-3xl shadow-lg border border-blue-700/30">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
            <div>
                <div class="flex items-center space-x-3">
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Pusat Notifikasi & Umpan Balik 🔔</h1>
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-500/30 text-blue-200 border border-blue-400/30">
                        {{ count($feedbacks) }} Pesan
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-blue-100 mt-2 max-w-xl leading-relaxed">
                    Riwayat pesan evaluasi, hasil verifikasi bukti portofolio, dan catatan bimbingan langsung dari dosen reviewer.
                </p>
            </div>
        </div>
    </div>

    <!-- Feedbacks List Cards -->
    <div class="space-y-4">
        <div class="flex items-center justify-between px-1">
            <h3 class="text-lg font-extrabold text-slate-900 dark:text-white tracking-tight">Daftar Catatan & Umpan Balik Masuk</h3>
            <span class="text-xs text-slate-400 font-bold">Total: {{ count($feedbacks) }} Notifikasi</span>
        </div>

        @forelse($feedbacks as $fb)
            <div class="bg-white dark:bg-slate-900 p-6 sm:p-7 rounded-3xl border border-line dark:border-slate-800 shadow-sm hover-lift space-y-4">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-2xl bg-teal-50 dark:bg-teal-900/40 text-teal-700 dark:text-teal-300 font-bold text-sm flex items-center justify-center shrink-0">
                            {{ strtoupper(substr($fb->reviewer->name ?? 'Dosen', 0, 1)) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 dark:text-white text-sm sm:text-base">
                                Umpan Balik dari {{ $fb->reviewer->name ?? 'Dosen Reviewer' }}
                            </h4>
                            <span class="text-[11px] text-slate-400 font-medium">Tim Assessor Sertifikasi ITATS</span>
                        </div>
                    </div>

                    <span class="text-[11px] text-slate-400 shrink-0 font-medium">
                        {{ date('d M Y, H:i', strtotime($fb->created_at)) }}
                    </span>
                </div>

                <div class="p-4 bg-slate-50 dark:bg-slate-800/60 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 text-xs sm:text-sm text-slate-700 dark:text-slate-300 leading-relaxed">
                    {{ $fb->body }}
                </div>

                <div class="pt-2 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between text-xs">
                    <span class="text-slate-400">Status: <strong class="text-teal-600 dark:text-teal-400">Telah Diverifikasi</strong></span>
                    <a href="{{ route('evidence.index') }}" class="text-blue-600 dark:text-blue-400 font-bold hover:underline flex items-center space-x-1">
                        <span>Lihat Bukti Terkait</span>
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
            </div>
        @empty
            <div class="bg-white dark:bg-slate-900 p-12 text-center rounded-3xl border border-line dark:border-slate-800 space-y-4">
                <span class="material-symbols-outlined text-5xl text-slate-300 dark:text-slate-600">notifications_off</span>
                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white text-base">Belum Ada Notifikasi Umpan Balik</h4>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Notifikasi dan umpan balik dari dosen akan muncul di sini setelah bukti kemampuan Anda ditinjau.</p>
                </div>
                <a href="{{ route('evidence.index') }}" class="inline-block px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-bold shadow-md transition hover-lift">
                    Lihat Portofolio Saya
                </a>
            </div>
        @endforelse
    </div>

</div>
@endsection
