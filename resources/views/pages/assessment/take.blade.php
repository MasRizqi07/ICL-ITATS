@extends('layouts.app')

@section('title', 'Asesmen Mandiri Kompetensi - ICL ITATS')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 animate-fade-in-up">

    <!-- Header Assessment Banner -->
    <div class="relative overflow-hidden bg-gradient-to-r from-blue-900 via-indigo-900 to-slate-900 text-white p-6 sm:p-8 rounded-3xl shadow-lg border border-blue-700/30">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 space-y-2">
            <div class="flex items-center space-x-2.5">
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-500/30 text-blue-200 border border-blue-400/30">
                    Instrumen Asesmen Mandiri Mahasiswa
                </span>
                <span class="text-xs text-blue-200 font-mono">Versi {{ $assessment->version }}.0</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">{{ $assessment->title }}</h1>
            <p class="text-xs sm:text-sm text-blue-100 max-w-2xl leading-relaxed">
                Target Karier: <strong class="text-white">{{ $career->name }}</strong> • Total {{ count($assessment->items) }} Butir Evaluasi Kemampuan.
            </p>
        </div>
    </div>

    <!-- Rating Scale Guidelines Card -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 border border-line dark:border-slate-800 shadow-2xs space-y-4">
        <div class="flex items-center space-x-3">
            <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 text-2xl">info</span>
            <h3 class="font-bold text-slate-900 dark:text-white text-base">Panduan Skala Penilaian Tingkat Kemampuan (Level)</h3>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-5 gap-2.5 text-center text-xs">
            <div class="p-3 bg-slate-50 dark:bg-slate-800/60 rounded-xl border border-slate-200 dark:border-slate-700">
                <span class="block font-bold text-slate-900 dark:text-white text-sm">1.0</span>
                <span class="text-[11px] font-semibold text-slate-500 dark:text-slate-400">Dasar (Beginner)</span>
            </div>
            <div class="p-3 bg-slate-50 dark:bg-slate-800/60 rounded-xl border border-slate-200 dark:border-slate-700">
                <span class="block font-bold text-slate-900 dark:text-white text-sm">2.0</span>
                <span class="text-[11px] font-semibold text-slate-500 dark:text-slate-400">Berkembang</span>
            </div>
            <div class="p-3 bg-slate-50 dark:bg-slate-800/60 rounded-xl border border-slate-200 dark:border-slate-700">
                <span class="block font-bold text-slate-900 dark:text-white text-sm">3.0</span>
                <span class="text-[11px] font-semibold text-slate-500 dark:text-slate-400">Kompeten (Standard)</span>
            </div>
            <div class="p-3 bg-slate-50 dark:bg-slate-800/60 rounded-xl border border-slate-200 dark:border-slate-700">
                <span class="block font-bold text-slate-900 dark:text-white text-sm">4.0</span>
                <span class="text-[11px] font-semibold text-slate-500 dark:text-slate-400">Mahir (Advanced)</span>
            </div>
            <div class="p-3 bg-slate-50 dark:bg-slate-800/60 rounded-xl border border-slate-200 dark:border-slate-700">
                <span class="block font-bold text-slate-900 dark:text-white text-sm">5.0</span>
                <span class="text-[11px] font-semibold text-slate-500 dark:text-slate-400">Ahli (Expert)</span>
            </div>
        </div>
    </div>

    <!-- Assessment Form -->
    <form action="{{ route('assessment.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="space-y-5">
            @foreach($assessment->items as $index => $item)
                <div class="bg-white dark:bg-slate-900 p-6 sm:p-7 rounded-3xl border border-line dark:border-slate-800 shadow-sm space-y-4">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex items-center space-x-3.5">
                            <span class="w-8 h-8 rounded-xl bg-blue-50 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 font-extrabold text-xs flex items-center justify-center shrink-0">
                                {{ $index + 1 }}
                            </span>
                            <div>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300">
                                    {{ $item->competency->domain ?? 'Technical' }}
                                </span>
                                <h3 class="font-bold text-slate-900 dark:text-white text-base mt-1">
                                    {{ $item->competency->name }}
                                </h3>
                            </div>
                        </div>
                    </div>

                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed pl-11">
                        {{ $item->prompt }}
                    </p>

                    <!-- Interactive 5-Point Rating Scale Selection -->
                    <div class="pl-0 sm:pl-11 grid grid-cols-5 gap-2.5 pt-2">
                        @for($score = 1; $score <= 5; $score++)
                            <label class="flex flex-col items-center justify-center p-3 sm:p-3.5 border border-slate-200 dark:border-slate-700/80 rounded-2xl cursor-pointer hover:bg-blue-50 dark:hover:bg-slate-800/80 transition-all duration-200 hover-lift text-center group has-checked:bg-blue-600 has-checked:border-blue-600 has-checked:text-white">
                                <input type="radio" name="scores[{{ $item->competency_id }}]" value="{{ $score }}" class="sr-only" {{ $score == 3 ? 'checked' : '' }}>
                                <span class="text-sm font-extrabold block text-slate-800 dark:text-slate-200 group-has-checked:text-white">{{ $score }}.0</span>
                                <span class="text-[10px] text-slate-400 dark:text-slate-500 group-has-checked:text-blue-100 mt-0.5">
                                    @if($score == 1) Dasar
                                    @elseif($score == 2) Berkembang
                                    @elseif($score == 3) Kompeten
                                    @elseif($score == 4) Mahir
                                    @elseif($score == 5) Ahli
                                    @endif
                                </span>
                            </label>
                        @endfor
                    </div>
                </div>
            @endforeach
        </div>

        <div class="flex items-center justify-between pt-4 pb-8">
            <a href="{{ route('dashboard') }}" class="px-6 py-3 text-xs font-bold text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                Batal & Kembali
            </a>
            <button type="submit" class="px-8 py-3.5 text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-md transition hover-lift flex items-center space-x-2">
                <span>Submit Asesmen & Rilis Snapshot</span>
                <span class="material-symbols-outlined text-base">send</span>
            </button>
        </div>
    </form>

</div>
@endsection
