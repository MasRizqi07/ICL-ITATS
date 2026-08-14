@extends('layouts.guest')

@section('title', 'Alur Platform - ICL ITATS')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
    <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-2xs space-y-4">
        <h1 class="text-3xl font-bold text-slate-900">Alur Kerja Platform ICL ITATS</h1>
        <p class="text-sm text-slate-600">Diagram runtutan proses mahasiswa dari menentukan target karier hingga rilis penilaian ulang.</p>

        <div class="p-6 bg-slate-50 rounded-xl border border-slate-200 text-xs space-y-4">
            <div class="flex items-center space-x-3">
                <span class="w-8 h-8 rounded-full bg-blue-600 text-white font-bold flex items-center justify-center">1</span>
                <div>
                    <strong class="text-slate-900 block text-sm">Pemilihan Target Karier & Peta Kompetensi</strong>
                    <span class="text-slate-500">Mahasiswa memilih profesi (misal: Fullstack Web Developer) dan sistem menampilkan standar kompetensi industri.</span>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <span class="w-8 h-8 rounded-full bg-teal-600 text-white font-bold flex items-center justify-center">2</span>
                <div>
                    <strong class="text-slate-900 block text-sm">Asesmen Mandiri & Pengumpulan Bukti</strong>
                    <span class="text-slate-500">Mahasiswa menjawab instrumen pertanyaan awal dan mengunggah repositori/sertifikat bukti pendukung.</span>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <span class="w-8 h-8 rounded-full bg-amber-600 text-white font-bold flex items-center justify-center">3</span>
                <div>
                    <strong class="text-slate-900 block text-sm">Kalkulasi Server-Authoritative Skill Gap</strong>
                    <span class="text-slate-500">Mesin scoring menghitung tingkat kemampuan riil, menetapkan status, dan menghasilkan saran rencana aksi.</span>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <span class="w-8 h-8 rounded-full bg-purple-600 text-white font-bold flex items-center justify-center">4</span>
                <div>
                    <strong class="text-slate-900 block text-sm">Review Dosen & Reassessment Snapshot</strong>
                    <span class="text-slate-500">Dosen reviewer memverifikasi bukti portofolio dan merilis snapshot riwayat perkembangan berkala.</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
