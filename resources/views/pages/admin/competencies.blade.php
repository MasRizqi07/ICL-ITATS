@extends('layouts.app')

@section('title', 'Manajemen Kurikulum Kompetensi - Admin ICL ITATS')

@section('content')
<div class="space-y-8 animate-fade-in-up">

    <!-- Admin Header Banner -->
    <div class="relative overflow-hidden bg-gradient-to-r from-purple-950 via-purple-900 to-slate-900 text-white p-6 sm:p-8 rounded-3xl shadow-lg border border-purple-800/40">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-purple-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div>
                <div class="flex items-center space-x-3">
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Kamus Kurikulum & Kompetensi 📚</h1>
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-purple-500/30 text-purple-200 border border-purple-400/30">
                        Admin Portal
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-purple-200 mt-2 max-w-xl leading-relaxed">
                    Kelola kamus indikator kompetensi teknis, soft-skill, metodologi, dan manajemen kurikulum ITATS.
                </p>
            </div>

            <button onclick="document.getElementById('add-competency-modal').classList.remove('hidden')" class="px-5 py-2.5 bg-white text-purple-950 hover:bg-purple-50 text-xs font-extrabold rounded-xl shadow-md transition hover-lift flex items-center space-x-2 shrink-0">
                <span class="material-symbols-outlined text-base">add</span>
                <span>Tambah Kompetensi Baru</span>
            </button>
        </div>
    </div>

    <!-- Competencies Catalog Table Card -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-line dark:border-slate-800 p-6 sm:p-8 shadow-sm space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 dark:border-slate-800 pb-4">
            <div>
                <h3 class="text-lg font-extrabold text-slate-900 dark:text-white tracking-tight">Daftar Modul & Indikator Kompetensi</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Daftar kemampuan yang dapat dipetakan ke profil target karier.</p>
            </div>
            <span class="text-xs font-bold text-slate-400">Total: {{ count($competencies) }} Indikator</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 dark:bg-slate-800/60 text-slate-500 dark:text-slate-400 uppercase font-bold border-b border-slate-200 dark:border-slate-800">
                    <tr>
                        <th class="py-3.5 px-4">Nama Kompetensi</th>
                        <th class="py-3.5 px-4">Domain</th>
                        <th class="py-3.5 px-4">Deskripsi Standar</th>
                        <th class="py-3.5 px-4">Terhubung ke Karier</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @foreach($competencies as $comp)
                        <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/40 transition">
                            <td class="py-4 px-4 font-bold text-slate-900 dark:text-white">
                                {{ $comp->name }}
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300">
                                    {{ $comp->domain }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-slate-600 dark:text-slate-300 max-w-md">
                                {{ $comp->description }}
                            </td>
                            <td class="py-4 px-4 font-bold text-blue-600 dark:text-blue-400">
                                {{ $comp->careers_count }} Karier
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal Dialog Add Competency -->
<div id="add-competency-modal" class="hidden fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 flex items-center justify-center p-4">
    <div class="bg-white dark:bg-slate-900 rounded-3xl max-w-md w-full p-6 sm:p-8 space-y-5 border border-line dark:border-slate-800 shadow-2xl animate-fade-in-up">
        <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-3">
            <h3 class="font-extrabold text-slate-900 dark:text-white text-base">Tambah Kompetensi Kurikulum Baru</h3>
            <button onclick="document.getElementById('add-competency-modal').classList.add('hidden')" class="p-1 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                <span class="material-symbols-outlined text-xl">close</span>
            </button>
        </div>

        <form action="{{ route('admin.competencies.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <div class="space-y-1.5">
                <label for="comp-name" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Nama Kompetensi <span class="text-red-500">*</span></label>
                <input type="text" id="comp-name" name="name" required placeholder="Contoh: Docker & Containerization"
                    class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-900 dark:text-white focus:ring-2 focus:ring-purple-600 focus:border-purple-600 outline-none transition">
            </div>

            <div class="space-y-1.5">
                <label for="comp-domain" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Domain Kompetensi</label>
                <select id="comp-domain" name="domain"
                    class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-900 dark:text-white focus:ring-2 focus:ring-purple-600 focus:border-purple-600 outline-none transition">
                    <option value="Technical">Technical</option>
                    <option value="SoftSkill">SoftSkill</option>
                    <option value="Management">Management</option>
                    <option value="Tooling">Tooling</option>
                </select>
            </div>

            <div class="space-y-1.5">
                <label for="comp-desc" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Deskripsi Standar & Indikator <span class="text-red-500">*</span></label>
                <textarea id="comp-desc" name="description" rows="3" required placeholder="Penjelasan standar indikator keberhasilan kompetensi..."
                    class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-900 dark:text-white focus:ring-2 focus:ring-purple-600 focus:border-purple-600 outline-none transition"></textarea>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="document.getElementById('add-competency-modal').classList.add('hidden')" class="px-5 py-2.5 text-xs font-bold text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                    Batal
                </button>
                <button type="submit" class="px-6 py-2.5 text-xs font-bold text-white bg-purple-600 hover:bg-purple-700 rounded-xl shadow-md transition hover-lift">
                    Simpan Kompetensi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
