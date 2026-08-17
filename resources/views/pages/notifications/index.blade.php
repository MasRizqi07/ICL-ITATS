@extends('layouts.app')

@section('title', 'Pusat Notifikasi & Umpan Balik - ICL ITATS')

@section('content')
<div class="space-y-6">

    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-line dark:border-slate-700">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Pusat Notifikasi & Feedback Reviewer</h1>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
            Riwayat pesan, hasil verifikasi bukti, dan catatan umpan balik dari Dosen/Reviewer.
        </p>
    </div>

    <!-- Feedbacks List -->
    <div class="space-y-4">
        @forelse($feedbacks as $fb)
            <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-slate-200 dark:border-slate-700 shadow-2xs space-y-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <span class="p-1.5 rounded bg-teal-100 text-teal-800 dark:bg-teal-900/50 dark:text-teal-300">
                            <span class="material-symbols-outlined text-base">rate_review</span>
                        </span>
                        <h4 class="font-bold text-slate-900 dark:text-white text-xs">
                            Feedback dari {{ $fb->reviewer->name }}
                        </h4>
                    </div>
                    <span class="text-[10px] text-slate-400">
                        {{ date('d M Y, H:i', strtotime($fb->created_at)) }}
                    </span>
                </div>

                <p class="text-xs text-slate-700 dark:text-slate-300 leading-relaxed bg-slate-50 dark:bg-slate-700/40 p-3 rounded-lg border border-slate-100 dark:border-slate-700">
                    {{ $fb->body }}
                </p>
            </div>
        @empty
            <div class="bg-white dark:bg-slate-800 p-8 text-center rounded-xl border border-slate-200 dark:border-slate-700">
                <p class="text-xs text-slate-500 font-medium">Belum ada notifikasi umpan balik baru saat ini.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection
