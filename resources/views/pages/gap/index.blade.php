@extends('layouts.app')

@section('title', 'Analisis Skill Gap & Progres - ICL ITATS')

@section('content')
<div class="space-y-6">

    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-line dark:border-slate-700">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Analisis Skill Gap & Matrik Progres</h1>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
            Penjelasan terperinci mengenai selisih kemampuan (*gap*) antara tingkat target karier industri dan tingkat kemampuan riil mahasiswa.
        </p>
    </div>

    <!-- Analytics Charts Summary -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($gaps as $gap)
            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-slate-200 dark:border-slate-700 space-y-4">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="font-bold text-slate-900 dark:text-white text-base">{{ $gap['name'] }}</h3>
                        <span class="text-[10px] text-slate-400 font-semibold">{{ $gap['domain'] }}</span>
                    </div>
                    @if($gap['gap'] > 0)
                        <span class="px-2.5 py-1 bg-amber-100 text-amber-800 dark:bg-amber-900/50 dark:text-amber-300 font-bold text-xs rounded-full">
                            Selisih: -{{ number_format($gap['gap'], 1) }}
                        </span>
                    @else
                        <span class="px-2.5 py-1 bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300 font-bold text-xs rounded-full">
                            Tercapai (0.0)
                        </span>
                    @endif
                </div>

                <!-- Explanation Box -->
                <div class="p-3 bg-slate-50 dark:bg-slate-700/50 rounded-lg text-xs text-slate-700 dark:text-slate-300 leading-relaxed border border-slate-100 dark:border-slate-700">
                    <strong class="text-slate-900 dark:text-white block font-semibold mb-1">Penjelasan Sumber Skor:</strong>
                    {{ $gap['explanation'] }}
                </div>

                <div class="space-y-1">
                    <div class="flex justify-between text-xs font-semibold text-slate-600 dark:text-slate-300">
                        <span>Current Level: {{ number_format($gap['current_level'], 1) }}</span>
                        <span>Required Target: {{ number_format($gap['required_level'], 1) }}</span>
                    </div>
                    <div class="w-full h-3 bg-slate-100 dark:bg-slate-700 rounded-full overflow-hidden">
                        <div class="h-full bg-blue-600 rounded-full" style="width: {{ ($gap['current_level'] / 5.0) * 100 }}%"></div>
                    </div>
                </div>

                <div class="pt-2 flex justify-end">
                    <a href="{{ route('development-plans.index') }}" class="text-xs font-semibold text-blue-600 hover:underline flex items-center space-x-1">
                        <span>Buat Aktivitas Rencana Pengembangan</span>
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
