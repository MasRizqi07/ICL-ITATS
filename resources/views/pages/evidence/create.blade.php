@extends('layouts.app')

@section('title', 'Form Tambah Bukti Kemampuan - ICL ITATS')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-[#D9E0E8] dark:border-slate-700">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Tambah Bukti Kemampuan Baru</h1>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
            Unggah rincian portofolio, sertifikat, atau repositori proyek yang relevan dengan peta kompetensi Anda.
        </p>
    </div>

    <form action="{{ route('evidence.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-slate-200 dark:border-slate-700 space-y-4">
        @csrf

        <div>
            <label for="title" class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-1">Judul Bukti Kemampuan *</label>
            <input type="text" id="title" name="title" required class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-xs" placeholder="Contoh: Sertifikat Pemrograman Laravel Advanced / Repo Project E-Commerce">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="type" class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-1">Jenis Bukti *</label>
                <select id="type" name="type" required class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-xs">
                    <option value="project">Proyek Perangkat Lunak</option>
                    <option value="certificate">Sertifikat Kelulusan/Kompetensi</option>
                    <option value="portfolio">Portofolio UI/UX</option>
                    <option value="test">Hasil Ujian/Asesmen</option>
                    <option value="reflection">Catatan Refleksi Belajar</option>
                </select>
            </div>

            <div>
                <label for="obtained_at" class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-1">Tanggal Diperoleh</label>
                <input type="date" id="obtained_at" name="obtained_at" value="{{ date('Y-m-d') }}" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-xs">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="source_url" class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-1">Tautan Bukti (URL Github/Drive)</label>
                <input type="url" id="source_url" name="source_url" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-xs" placeholder="https://github.com/username/project-repo">
            </div>

            <div>
                <label for="evidence_file" class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-1">Unggah Berkas Privat (PDF/JPG/PNG/ZIP, Max 10MB)</label>
                <input type="file" id="evidence_file" name="evidence_file" accept=".pdf,.jpg,.jpeg,.png,.zip" class="w-full px-3 py-1.5 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-xs file:mr-3 file:py-1 file:px-2.5 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 dark:file:bg-slate-600 dark:file:text-slate-200">
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-1">Kompetensi yang Didukung *</label>
            <div class="space-y-2 p-3 bg-slate-50 dark:bg-slate-700/50 rounded-lg max-h-48 overflow-y-auto">
                @foreach($competencies as $comp)
                    <label class="flex items-center space-x-2 text-xs text-slate-700 dark:text-slate-200 cursor-pointer">
                        <input type="checkbox" name="competency_ids[]" value="{{ $comp->id }}" class="rounded text-blue-600 focus:ring-blue-500">
                        <span>{{ $comp->name }} ({{ $comp->domain }})</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div>
            <label for="description" class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-1">Deskripsi Singkat & Penjelasan Peran *</label>
            <textarea id="description" name="description" rows="4" required class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-xs" placeholder="Jelaskan kontribusi Anda, fitur yang dibangun, serta teknologi yang digunakan..."></textarea>
        </div>

        <div class="flex items-center justify-between pt-4">
            <a href="{{ route('evidence.index') }}" class="px-4 py-2 text-xs font-semibold text-slate-600 bg-white border border-slate-300 rounded-lg">
                Batal
            </a>
            <button type="submit" class="px-5 py-2 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-xs transition">
                Simpan & Ajukan Verifikasi
            </button>
        </div>
    </form>

</div>
@endsection
