@extends('layouts.app')

@section('title', 'Manajemen Kurikulum Kompetensi - Admin ICL ITATS')

@section('content')
<div class="space-y-6">

    <div class="bg-purple-900 text-white p-6 rounded-2xl flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold">Kurikulum & Kamus Kompetensi</h1>
            <p class="text-xs text-purple-200 mt-1">
                Kelola daftar modul kompetensi teknis, soft-skill, dan manajemen institusi ITATS.
            </p>
        </div>
        <button onclick="document.getElementById('add-competency-modal').classList.remove('hidden')" class="px-4 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-semibold text-xs rounded-xl transition flex items-center space-x-2">
            <span class="material-symbols-outlined text-base">add</span>
            <span>Tambah Kompetensi Baru</span>
        </button>
    </div>

    <!-- Competency Table -->
    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6 space-y-4">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 dark:bg-slate-700/50 text-slate-500 dark:text-slate-400 uppercase font-semibold">
                    <tr>
                        <th class="py-3 px-4">Nama Kompetensi</th>
                        <th class="py-3 px-4">Domain</th>
                        <th class="py-3 px-4">Deskripsi Standar</th>
                        <th class="py-3 px-4">Terhubung ke Karier</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                    @foreach($competencies as $comp)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30">
                            <td class="py-3.5 px-4 font-bold text-slate-900 dark:text-white">
                                {{ $comp->name }}
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2.5 py-0.5 rounded text-[10px] font-bold bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300">
                                    {{ $comp->domain }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-slate-600 dark:text-slate-300">
                                {{ $comp->description }}
                            </td>
                            <td class="py-3.5 px-4 font-semibold text-blue-600">
                                {{ $comp->careers_count }} Karier
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal Add Competency -->
<div id="add-competency-modal" class="hidden fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-50 flex items-center justify-center p-4">
    <div class="bg-white dark:bg-slate-800 rounded-2xl max-w-md w-full p-6 space-y-4 border border-slate-200 dark:border-slate-700">
        <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-700 pb-3">
            <h3 class="font-bold text-slate-900 dark:text-white text-base">Tambah Kompetensi Kurikulum Baru</h3>
            <button onclick="document.getElementById('add-competency-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <form action="{{ route('admin.competencies.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-1">Nama Kompetensi *</label>
                <input type="text" name="name" required class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-xs" placeholder="Contoh: Docker & Containerization">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-1">Domain Kompetensi</label>
                <select name="domain" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-xs">
                    <option value="Technical">Technical</option>
                    <option value="SoftSkill">SoftSkill</option>
                    <option value="Management">Management</option>
                    <option value="Tooling">Tooling</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-1">Deskripsi Standar *</label>
                <textarea name="description" rows="3" required class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-xs" placeholder="Penjelasan standar indikator keberhasilan kompetensi..."></textarea>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-3">
                <button type="button" onclick="document.getElementById('add-competency-modal').classList.add('hidden')" class="px-4 py-2 text-xs font-semibold text-slate-600 bg-white border border-slate-300 rounded-lg">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 text-xs font-semibold text-white bg-purple-600 hover:bg-purple-700 rounded-lg">
                    Simpan Kompetensi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
