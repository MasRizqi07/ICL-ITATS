@extends('layouts.app')

@section('title', 'Form Tambah Bukti Kemampuan - ICL ITATS')

@section('content')
<div class="max-w-3xl mx-auto space-y-8 animate-fade-in-up">

    <!-- Header Section -->
    <div class="relative overflow-hidden bg-gradient-to-r from-teal-950 via-slate-900 to-teal-900 text-white p-6 sm:p-8 rounded-3xl shadow-lg border border-teal-800/30">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-teal-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 space-y-2">
            <div class="flex items-center space-x-2.5">
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-teal-500/30 text-teal-200 border border-teal-400/30">
                    Form Pengajuan Portofolio
                </span>
                <span class="text-xs text-teal-200">Verifikasi Dosen Reviewer</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">Unggah Bukti Kemampuan (Evidence) 📤</h1>
            <p class="text-xs sm:text-sm text-teal-100 max-w-2xl leading-relaxed">
                Lampirkan tautan proyek nyata, repositori GitHub, berkas sertifikat, atau dokumen pendukung untuk divalidasi ke dalam profil kompetensi Anda.
            </p>
        </div>
    </div>

    <!-- Instructions Guidelines Alert -->
    <div class="bg-teal-50 dark:bg-teal-900/30 border border-teal-200 dark:border-teal-800 rounded-3xl p-6 flex items-start space-x-4">
        <span class="material-symbols-outlined text-teal-600 dark:text-teal-400 text-2xl shrink-0 mt-0.5">verified_user</span>
        <div class="space-y-1 text-xs text-teal-900 dark:text-teal-200 leading-relaxed">
            <strong class="font-bold text-sm block">Panduan Standar Bukti yang Valid:</strong>
            <p>Pastikan tautan atau berkas dapat diakses publik atau diunduh oleh dosen reviewer. Sertakan penjelasan peran spesifik Anda dalam proyek tim agar penilaian skor objektif.</p>
        </div>
    </div>

    <!-- Error Messages Alert -->
    @if($errors->any())
        <div class="p-4 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-700 dark:text-red-300 text-xs flex items-center space-x-2">
            <span class="material-symbols-outlined text-red-500 text-lg">error</span>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <!-- Main Evidence Form Card -->
    <form action="{{ route('evidence.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-slate-900 p-6 sm:p-8 rounded-3xl border border-line dark:border-slate-800 shadow-sm space-y-6">
        @csrf

        <!-- Title -->
        <div class="space-y-1.5">
            <label for="title" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Judul Bukti Kemampuan <span class="text-red-500">*</span></label>
            <input type="text" id="title" name="title" required value="{{ old('title') }}"
                class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition"
                placeholder="Contoh: Sertifikat Pemrograman Laravel Advanced / Project E-Commerce Backend">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <!-- Type Selector -->
            <div class="space-y-1.5">
                <label for="type" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Jenis Bukti <span class="text-red-500">*</span></label>
                <select id="type" name="type" required
                    class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition">
                    <option value="project" {{ old('type') === 'project' ? 'selected' : '' }}>Proyek Perangkat Lunak</option>
                    <option value="certificate" {{ old('type') === 'certificate' ? 'selected' : '' }}>Sertifikat Kelulusan / Kompetensi</option>
                    <option value="portfolio" {{ old('type') === 'portfolio' ? 'selected' : '' }}>Portofolio Desain / UI/UX</option>
                    <option value="test" {{ old('type') === 'test' ? 'selected' : '' }}>Hasil Ujian / Asesmen Resmi</option>
                    <option value="reflection" {{ old('type') === 'reflection' ? 'selected' : '' }}>Catatan Refleksi Belajar Mandiri</option>
                </select>
            </div>

            <!-- Date Obtained -->
            <div class="space-y-1.5">
                <label for="obtained_at" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Tanggal Diperoleh</label>
                <input type="date" id="obtained_at" name="obtained_at" value="{{ old('obtained_at', date('Y-m-d')) }}"
                    class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <!-- External URL -->
            <div class="space-y-1.5">
                <label for="source_url" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Tautan Repositori / Demo Live (URL)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <span class="material-symbols-outlined text-lg">link</span>
                    </div>
                    <input type="url" id="source_url" name="source_url" value="{{ old('source_url') }}"
                        class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition"
                        placeholder="https://github.com/username/project">
                </div>
            </div>

            <!-- Private File Upload -->
            <div class="space-y-1.5">
                <label for="evidence_file" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Unggah Berkas Privat (PDF/ZIP, Max 10MB)</label>
                <input type="file" id="evidence_file" name="evidence_file" accept=".pdf,.jpg,.jpeg,.png,.zip"
                    class="w-full px-3 py-1.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs text-slate-900 dark:text-white file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-blue-700 dark:file:bg-slate-700 dark:file:text-slate-200 cursor-pointer">
            </div>
        </div>

        <!-- Competency Multi-Select Checkboxes -->
        <div class="space-y-2">
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300">Kompetensi yang Terhubung & Didukung <span class="text-red-500">*</span></label>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 p-4 bg-slate-50 dark:bg-slate-800/60 rounded-2xl border border-slate-200 dark:border-slate-700/80 max-h-48 overflow-y-auto">
                @foreach($competencies as $comp)
                    <label class="flex items-center space-x-2.5 text-xs text-slate-700 dark:text-slate-200 cursor-pointer p-2 rounded-xl hover:bg-white dark:hover:bg-slate-800 transition">
                        <input type="checkbox" name="competency_ids[]" value="{{ $comp->id }}" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span class="font-medium">{{ $comp->name }} <span class="text-slate-400 text-[11px]">({{ $comp->domain }})</span></span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Description Textarea -->
        <div class="space-y-1.5">
            <label for="description" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Deskripsi Singkat & Penjelasan Kontribusi <span class="text-red-500">*</span></label>
            <textarea id="description" name="description" rows="4" required
                class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition"
                placeholder="Jelaskan peran Anda, tantangan teknis yang diselesaikan, teknologi yang digunakan, serta fitur inti yang dibangun...">{{ old('description') }}</textarea>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between pt-4 border-t border-slate-100 dark:border-slate-800">
            <a href="{{ route('evidence.index') }}" class="px-6 py-3 text-xs font-bold text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                Batal
            </a>
            <button type="submit" class="px-8 py-3.5 text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-md transition hover-lift flex items-center space-x-2">
                <span>Simpan & Ajukan Verifikasi</span>
                <span class="material-symbols-outlined text-base">send</span>
            </button>
        </div>
    </form>

</div>
@endsection
