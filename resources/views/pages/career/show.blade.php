@extends('layouts.app')

@section('title', 'Detail Target Karier - ICL ITATS')

@section('content')
<div class="space-y-6">

    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-[#D9E0E8] dark:border-slate-700 space-y-3">
        <div class="flex items-center space-x-2">
            <span class="px-2.5 py-0.5 rounded text-xs font-bold bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300">
                Profil Karier Standar Industri
            </span>
            <span class="text-xs text-slate-400">Versi {{ $career->version }}.0</span>
        </div>
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $career->name }}</h1>
        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed max-w-3xl">
            {{ $career->description }}
        </p>

        <div class="pt-3 flex items-center space-x-4 text-xs font-medium text-slate-500">
            <span>Kompetensi Terhubung: <strong>{{ count($career->competencies) }} Standar</strong></span>
            <span>Catatan Sumber: <em>{{ $career->source_notes }}</em></span>
        </div>
    </div>

    <!-- Competencies Map Grid -->
    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6 space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="font-bold text-slate-900 dark:text-white text-base">Standar Kompetensi & Tingkat Target</h3>
            <a href="{{ route('assessment.show') }}" class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-lg transition">
                Mulai Asesmen Karier Ini
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($career->competencies as $comp)
                <div class="p-4 rounded-xl border border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-700/30 space-y-2">
                    <div class="flex items-center justify-between">
                        <h4 class="font-bold text-slate-900 dark:text-white text-sm">{{ $comp->name }}</h4>
                        <span class="px-2 py-0.5 bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300 text-[10px] font-bold rounded">
                            Target Level: {{ number_format($comp->pivot->required_level, 1) }}
                        </span>
                    </div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $comp->description }}</p>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
