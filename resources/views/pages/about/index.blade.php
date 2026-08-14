@extends('layouts.guest')

@section('title', 'Tentang ICL ITATS')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
    <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-2xs space-y-4">
        <div class="flex items-center space-x-4">
            <img src="{{ asset('images/logo.png') }}" alt="ICL ITATS Logo" class="h-12 w-auto object-contain bg-slate-50 p-2 rounded-xl border border-slate-200">
            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 border border-blue-200">
                GEMASTIK XIX 2026 - Software Development
            </span>
        </div>
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Tentang Platform ICL ITATS</h1>
        <p class="text-sm text-slate-600 leading-relaxed">
            <strong>ICL ITATS</strong> (Institutional Career Learning Platform) adalah inovasi perangkat lunak berbasis kecerdasan karier terstruktur yang menghubungkan cita-cita karier mahasiswa dengan bukti portofolio riil, asesmen terverifikasi, dan analisis kesenjangan kemampuan (*skill gap*).
        </p>
        <div class="pt-4 border-t border-slate-100 grid grid-cols-1 md:grid-cols-3 gap-4 text-xs text-slate-600">
            <div>
                <strong class="text-slate-900 block mb-1">Arsitektur</strong>
                Modular Monolith PHP 8.5 & Laravel Framework
            </div>
            <div>
                <strong class="text-slate-900 block mb-1">Basis Data</strong>
                PostgreSQL / SQLite dengan skema audit UUID
            </div>
            <div>
                <strong class="text-slate-900 block mb-1">Integritas AI</strong>
                Lapisan pendukung non-otoritatif (*Human in the Loop*)
            </div>
        </div>
    </div>
</div>
@endsection
