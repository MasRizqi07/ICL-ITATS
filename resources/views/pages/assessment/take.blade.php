@extends('layouts.app')

@section('title', 'Asesmen Mandiri Kompetensi - ICL ITATS')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-[#D9E0E8] dark:border-slate-700">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $assessment->title }}</h1>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
            Target Karier: <strong>{{ $career->name }}</strong> • Versi Instrumen: {{ $assessment->version }}
        </p>
        <p class="text-xs text-slate-600 dark:text-slate-300 mt-3 leading-relaxed bg-blue-50 dark:bg-blue-900/30 p-3 rounded-lg border border-blue-100 dark:border-blue-800">
            Jawablah setiap instrumen penilaian mandiri di bawah ini secara jujur berdasarkan pengalaman, proyek, dan sertifikat yang Anda miliki. Jawaban Anda akan langsung membentuk profil *current level* dan *skill gap*.
        </p>
    </div>

    <form action="{{ route('assessment.store') }}" method="POST" class="space-y-6">
        @csrf

        @foreach($assessment->items as $index => $item)
            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-slate-200 dark:border-slate-700 space-y-4">
                <div class="flex items-start justify-between">
                    <div class="flex items-center space-x-3">
                        <span class="w-7 h-7 rounded-full bg-blue-100 text-blue-700 font-bold text-xs flex items-center justify-center">
                            {{ $index + 1 }}
                        </span>
                        <h3 class="font-bold text-slate-900 dark:text-white text-sm">
                            {{ $item->competency->name }}
                        </h3>
                    </div>
                    <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-[10px] font-semibold rounded">
                        Skala 1.0 - 5.0
                    </span>
                </div>

                <p class="text-xs text-slate-700 dark:text-slate-300 leading-relaxed pl-10">
                    {{ $item->prompt }}
                </p>

                <!-- Radio Rating Scale 1 to 5 -->
                <div class="pl-10 grid grid-cols-5 gap-3 pt-2">
                    @for($score = 1; $score <= 5; $score++)
                        <label class="flex flex-col items-center justify-center p-3 border border-slate-200 dark:border-slate-700 rounded-lg cursor-pointer hover:bg-blue-50 dark:hover:bg-slate-700 transition group">
                            <input type="radio" name="scores[{{ $item->competency_id }}]" value="{{ $score }}" class="text-blue-600 focus:ring-blue-500 mb-1" {{ $score == 3 ? 'checked' : '' }}>
                            <span class="text-xs font-bold text-slate-800 dark:text-slate-200 group-hover:text-blue-600">{{ $score }}.0</span>
                            <span class="text-[10px] text-slate-400">
                                @if($score == 1) Pemula
                                @elseif($score == 3) Menengah
                                @elseif($score == 5) Ahli
                                @endif
                            </span>
                        </label>
                    @endfor
                </div>
            </div>
        @endforeach

        <div class="flex items-center justify-between pt-4">
            <a href="{{ route('dashboard') }}" class="px-5 py-2.5 text-xs font-semibold text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-sm transition flex items-center space-x-2">
                <span>Submit Asesmen & Rilis Snapshot</span>
                <span class="material-symbols-outlined text-base">send</span>
            </button>
        </div>
    </form>

</div>
@endsection
