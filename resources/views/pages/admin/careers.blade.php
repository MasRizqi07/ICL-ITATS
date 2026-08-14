@extends('layouts.app')

@section('title', 'Manajemen Data Karier - Admin ICL ITATS')

@section('content')
<div class="space-y-6">

    <div class="bg-purple-900 text-white p-6 rounded-2xl flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold">Manajemen Profil Karier Industri</h1>
            <p class="text-xs text-purple-200 mt-1">
                Kelola profil target karier, versi kurikulum, dan pemetaan standar kompetensi institusi ITATS.
            </p>
        </div>
        <button onclick="document.getElementById('add-career-modal').classList.remove('hidden')" class="px-4 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-semibold text-xs rounded-xl transition flex items-center space-x-2">
            <span class="material-symbols-outlined text-base">add</span>
            <span>Tambah Karier Baru</span>
        </button>
    </div>

    <!-- Careers List Table -->
    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6 space-y-4">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 dark:bg-slate-700/50 text-slate-500 dark:text-slate-400 uppercase font-semibold">
                    <tr>
                        <th class="py-3 px-4">Nama Karier</th>
                        <th class="py-3 px-4">Slug URL</th>
                        <th class="py-3 px-4">Jumlah Kompetensi</th>
                        <th class="py-3 px-4">Versi</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                    @foreach($careers as $career)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30">
                            <td class="py-3.5 px-4 font-bold text-slate-900 dark:text-white">
                                {{ $career->name }}
                            </td>
                            <td class="py-3.5 px-4 text-slate-500">
                                {{ $career->slug }}
                            </td>
                            <td class="py-3.5 px-4 font-semibold text-blue-600">
                                {{ $career->competencies_count }} Kompetensi
                            </td>
                            <td class="py-3.5 px-4">
                                v{{ $career->version }}.0
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2.5 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300">
                                    {{ strtoupper($career->status) }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4">
                                <a href="{{ route('careers.show', $career->slug) }}" class="text-blue-600 hover:underline font-semibold">
                                    Detail & Map
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal Add Career -->
<div id="add-career-modal" class="hidden fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-50 flex items-center justify-center p-4">
    <div class="bg-white dark:bg-slate-800 rounded-2xl max-w-md w-full p-6 space-y-4 border border-slate-200 dark:border-slate-700">
        <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-700 pb-3">
            <h3 class="font-bold text-slate-900 dark:text-white text-base">Tambah Profil Karier Baru</h3>
            <button onclick="document.getElementById('add-career-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <form action="{{ route('admin.careers.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-1">Nama Karier *</label>
                <input type="text" name="name" required class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-xs" placeholder="Contoh: Data Engineer / Machine Learning Specialist">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-1">Status Publikasi</label>
                <select name="status" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-xs">
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-1">Deskripsi & Standar Industri *</label>
                <textarea name="description" rows="3" required class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-xs" placeholder="Deskripsi mengenai peran dan tanggung jawab karier..."></textarea>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-3">
                <button type="button" onclick="document.getElementById('add-career-modal').classList.add('hidden')" class="px-4 py-2 text-xs font-semibold text-slate-600 bg-white border border-slate-300 rounded-lg">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 text-xs font-semibold text-white bg-purple-600 hover:bg-purple-700 rounded-lg">
                    Simpan Karier
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
