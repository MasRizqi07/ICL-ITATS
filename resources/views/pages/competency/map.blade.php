@extends('layouts.app')

@section('title', 'Peta Kompetensi Karier - ICL ITATS')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-line dark:border-slate-700">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Peta Kompetensi Karier Target</h1>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                    Target Karier: <strong class="text-blue-600 dark:text-blue-400">{{ $career->name }}</strong> • Versi Kurikulum: v{{ $career->version }}.0
                </p>
            </div>
            <a href="{{ route('assessment.show') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-lg transition flex items-center space-x-2">
                <span class="material-symbols-outlined text-base">quiz</span>
                <span>Asesmen Ulang Mandiri</span>
            </a>
        </div>
    </div>

    <!-- Competency Rows Detailed Card List -->
    <div class="space-y-4">
        @foreach($gaps as $item)
            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-slate-200 dark:border-slate-700 shadow-2xs">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-4">
                    <div>
                        <div class="flex items-center space-x-3">
                            <h3 class="text-base font-bold text-slate-900 dark:text-white">{{ $item['name'] }}</h3>
                            <span class="px-2.5 py-0.5 rounded text-[11px] font-semibold bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300">
                                {{ $item['domain'] }}
                            </span>
                            @if($item['priority'] === 'high')
                                <span class="px-2.5 py-0.5 rounded text-[11px] font-semibold bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300">
                                    Prioritas Tinggi
                                </span>
                            @endif
                        </div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">
                            {{ $item['explanation'] }}
                        </p>
                    </div>

                    <!-- Status Badge -->
                    <div>
                        @if($item['status'] === 'terverifikasi')
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300 font-bold text-xs rounded-full flex items-center space-x-1">
                                <span class="material-symbols-outlined text-sm">verified</span>
                                <span>Terverifikasi Reviewer</span>
                            </span>
                        @elseif($item['status'] === 'memenuhi')
                            <span class="px-3 py-1 bg-teal-100 text-teal-800 dark:bg-teal-900/50 dark:text-teal-300 font-bold text-xs rounded-full">
                                Memenuhi Target
                            </span>
                        @else
                            <span class="px-3 py-1 bg-amber-100 text-amber-800 dark:bg-amber-900/50 dark:text-amber-300 font-bold text-xs rounded-full">
                                Perlu Ditingkatkan
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Competency Level Visual Bar -->
                <div class="space-y-1.5 mb-4">
                    <div class="flex justify-between text-xs font-semibold">
                        <span class="text-slate-600 dark:text-slate-300">Tingkat Saat Ini: <strong class="text-blue-600 dark:text-blue-400">{{ number_format($item['current_level'], 1) }}</strong> / 5.0</span>
                        <span class="text-slate-500">Target Minimal: <strong>{{ number_format($item['required_level'], 1) }}</strong> / 5.0</span>
                    </div>

                    <div class="w-full h-3 bg-slate-100 dark:bg-slate-700 rounded-full overflow-hidden relative">
                        <!-- Current Level Fill -->
                        <div class="h-full bg-blue-600 rounded-full transition-all duration-500" style="width: {{ ($item['current_level'] / 5.0) * 100 }}%"></div>
                        <!-- Target Marker Line -->
                        <div class="absolute top-0 bottom-0 w-0.5 bg-red-500" style="left: {{ ($item['required_level'] / 5.0) * 100 }}%"></div>
                    </div>
                </div>

                <!-- Bottom Footer Info & Action -->
                <div class="pt-3 border-t border-slate-100 dark:border-slate-700/50 flex items-center justify-between text-xs">
                    <span class="text-slate-500">Jumlah Bukti Portofolio Terkait: <strong>{{ $item['evidence_count'] }} bukti</strong></span>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('evidence.create') }}" class="font-semibold text-blue-600 hover:underline">
                            + Unggah Bukti Kemampuan
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
