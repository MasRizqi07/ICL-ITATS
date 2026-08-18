@extends('layouts.app')

@section('title', 'Manajemen Data Karier - Admin ICL ITATS')

@section('content')
<div class="space-y-8 animate-fade-in-up">

    <!-- Admin Header Banner -->
    <div class="relative overflow-hidden bg-gradient-to-r from-purple-950 via-purple-900 to-slate-900 text-white p-6 sm:p-8 rounded-3xl shadow-lg border border-purple-800/40">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-purple-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div>
                <div class="flex items-center space-x-3">
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Manajemen Profil Karier Industri 💼</h1>
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-purple-500/30 text-purple-200 border border-purple-400/30">
                        Admin Portal
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-purple-200 mt-2 max-w-xl leading-relaxed">
                    Kelola standar profil karier, versi kurikulum, dan pemetaan standar kompetensi institusi ITATS.
                </p>
            </div>

            <button onclick="document.getElementById('add-career-modal').classList.remove('hidden')" class="px-5 py-2.5 bg-white text-purple-950 hover:bg-purple-50 text-xs font-extrabold rounded-xl shadow-md transition hover-lift flex items-center space-x-2 shrink-0">
                <span class="material-symbols-outlined text-base">add</span>
                <span>Tambah Karier Baru</span>
            </button>
        </div>
    </div>

    <!-- Careers List Table Card -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-line dark:border-slate-800 p-6 sm:p-8 shadow-sm space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 dark:border-slate-800 pb-4">
            <div>
                <h3 class="text-lg font-extrabold text-slate-900 dark:text-white tracking-tight">Daftar Standar Profil Karier</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Daftar jalur profesi industri yang dapat dipilih oleh mahasiswa.</p>
            </div>
            <span class="text-xs font-bold text-slate-400">Total: {{ count($careers) }} Karier</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 dark:bg-slate-800/60 text-slate-500 dark:text-slate-400 uppercase font-bold border-b border-slate-200 dark:border-slate-800">
                    <tr>
                        <th class="py-3.5 px-4">Nama Karier</th>
                        <th class="py-3.5 px-4">Slug URL</th>
                        <th class="py-3.5 px-4">Jumlah Kompetensi</th>
                        <th class="py-3.5 px-4">Versi</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @foreach($careers as $career)
                        <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/40 transition">
                            <td class="py-4 px-4 font-bold text-slate-900 dark:text-white">
                                {{ $career->name }}
                            </td>
                            <td class="py-4 px-4 font-mono text-slate-500">
                                {{ $career->slug }}
                            </td>
                            <td class="py-4 px-4 font-bold text-blue-600 dark:text-blue-400">
                                {{ $career->competencies_count }} Standar
                            </td>
                            <td class="py-4 px-4 font-semibold text-slate-700 dark:text-slate-300">
                                v{{ $career->version }}.0
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-2.5 py-1 rounded-lg text-[11px] font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300">
                                    {{ strtoupper($career->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <a href="{{ route('careers.show', $career->slug) }}" class="text-purple-600 dark:text-purple-400 hover:underline font-bold text-xs">
                                    Detail & Peta
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal Dialog Add Career -->
<div id="add-career-modal" class="hidden fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 flex items-center justify-center p-4">
    <div class="bg-white dark:bg-slate-900 rounded-3xl max-w-md w-full p-6 sm:p-8 space-y-5 border border-line dark:border-slate-800 shadow-2xl animate-fade-in-up">
        <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-3">
            <h3 class="font-extrabold text-slate-900 dark:text-white text-base">Tambah Profil Karier Baru</h3>
            <button onclick="document.getElementById('add-career-modal').classList.add('hidden')" class="p-1 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                <span class="material-symbols-outlined text-xl">close</span>
            </button>
        </div>

        <form action="{{ route('admin.careers.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <div class="space-y-1.5">
                <label for="career-name" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Nama Karier <span class="text-red-500">*</span></label>
                <input type="text" id="career-name" name="name" required placeholder="Contoh: Cloud Solutions Architect"
                    class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-900 dark:text-white focus:ring-2 focus:ring-purple-600 focus:border-purple-600 outline-none transition">
            </div>

            <div class="space-y-1.5">
                <label for="career-status" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Status Publikasi</label>
                <select id="career-status" name="status"
                    class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-900 dark:text-white focus:ring-2 focus:ring-purple-600 focus:border-purple-600 outline-none transition">
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                </select>
            </div>

            <div class="space-y-1.5">
                <label for="career-desc" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Deskripsi Standar Industri <span class="text-red-500">*</span></label>
                <textarea id="career-desc" name="description" rows="3" required placeholder="Deskripsi mengenai peran, tanggung jawab, dan standar kualifikasi industri..."
                    class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-900 dark:text-white focus:ring-2 focus:ring-purple-600 focus:border-purple-600 outline-none transition"></textarea>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="document.getElementById('add-career-modal').classList.add('hidden')" class="px-5 py-2.5 text-xs font-bold text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                    Batal
                </button>
                <button type="submit" class="px-6 py-2.5 text-xs font-bold text-white bg-purple-600 hover:bg-purple-700 rounded-xl shadow-md transition hover-lift">
                    Simpan Karier
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
