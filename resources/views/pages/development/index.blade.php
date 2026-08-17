@extends('layouts.app')

@section('title', 'Rencana Pengembangan Diri - ICL ITATS')

@section('content')
<div class="space-y-6">

    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-line dark:border-slate-700 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Rencana Pengembangan Diri (Action Plan)</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                Aktivitas pembelajaran dan latihan mandiri untuk menutup *skill gap* kompetensi karier target Anda.
            </p>
        </div>
        <button onclick="document.getElementById('add-activity-modal').classList.remove('hidden')" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-xl shadow-xs transition flex items-center space-x-2">
            <span class="material-symbols-outlined text-base">add_task</span>
            <span>Tambah Aktivitas Baru</span>
        </button>
    </div>

    <!-- AI Suggestion Panel Trigger -->
    <div class="bg-purple-50 dark:bg-purple-900/30 border border-purple-200 dark:border-purple-800 rounded-xl p-5 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <div class="p-2 bg-purple-600 text-white rounded-lg">
                <span class="material-symbols-outlined text-xl">auto_awesome</span>
            </div>
            <div>
                <h4 class="font-bold text-slate-900 dark:text-white text-xs">Minta Rekomendasi Aktivitas Bantuan AI</h4>
                <p class="text-[11px] text-slate-600 dark:text-slate-300">Dapatkan ide tugas proyek atau kursus yang relevan secara otomatis.</p>
            </div>
        </div>
        <button id="btn-ai-generate" class="px-3 py-1.5 bg-purple-600 hover:bg-purple-700 text-white font-semibold text-xs rounded-lg transition">
            Generate Saran AI
        </button>
    </div>

    <!-- Activities Table / Cards List -->
    <div class="space-y-4">
        @forelse($activities as $act)
            <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-slate-200 dark:border-slate-700 shadow-2xs flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div class="space-y-1">
                    <div class="flex items-center space-x-3">
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300">
                            {{ $act->competency->name }}
                        </span>
                        <h3 class="font-bold text-slate-900 dark:text-white text-sm">{{ $act->title }}</h3>
                    </div>
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">{{ $act->description }}</p>
                    <div class="text-[11px] text-slate-400">
                        Target Selesai: <strong>{{ $act->target_date ? date('d M Y', strtotime($act->target_date)) : 'Segera' }}</strong>
                        • Ekspektasi Bukti: <em>{{ $act->expected_evidence ?? 'Repositori Project' }}</em>
                    </div>
                </div>

                <div class="flex items-center space-x-3 shrink-0">
                    <form action="{{ route('development-plans.activities.update', $act->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @if($act->status === 'completed')
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300 font-bold text-xs rounded-full inline-flex items-center space-x-1">
                                <span class="material-symbols-outlined text-xs">check_circle</span>
                                <span>Selesai</span>
                            </span>
                        @else
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs rounded-lg transition flex items-center space-x-1">
                                <span class="material-symbols-outlined text-xs">check</span>
                                <span>Tandai Selesai</span>
                            </button>
                        @endif
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white dark:bg-slate-800 p-8 text-center rounded-xl border border-slate-200 dark:border-slate-700">
                <p class="text-xs text-slate-500 font-medium">Belum ada aktivitas dalam rencana aksi Anda.</p>
            </div>
        @endforelse
    </div>

</div>

<!-- Modal Dialog Add Activity -->
<div id="add-activity-modal" class="hidden fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-50 flex items-center justify-center p-4">
    <div class="bg-white dark:bg-slate-800 rounded-2xl max-w-lg w-full p-6 space-y-4 border border-slate-200 dark:border-slate-700">
        <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-700 pb-3">
            <h3 class="font-bold text-slate-900 dark:text-white text-base">Tambah Aktivitas Pengembangan Baru</h3>
            <button onclick="document.getElementById('add-activity-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <form action="{{ route('development-plans.activities.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-1">Target Kompetensi *</label>
                <select name="competency_id" required class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-xs">
                    @foreach($competencies as $comp)
                        <option value="{{ $comp->id }}">{{ $comp->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-1">Judul Aktivitas *</label>
                <input type="text" name="title" required class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-xs" placeholder="Contoh: Membuat REST API Sanctum Authentication">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-1">Rincian Deskripsi *</label>
                <textarea name="description" rows="3" required class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-xs" placeholder="Tulis rincian langkah yang akan dikerjakan..."></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-1">Prioritas</label>
                    <select name="priority" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-xs">
                        <option value="high">Tinggi</option>
                        <option value="medium">Sedang</option>
                        <option value="low">Rendah</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-1">Target Tanggal Selesai</label>
                    <input type="date" name="target_date" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-xs">
                </div>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-3">
                <button type="button" onclick="document.getElementById('add-activity-modal').classList.add('hidden')" class="px-4 py-2 text-xs font-semibold text-slate-600 bg-white border border-slate-300 rounded-lg">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg">
                    Simpan Aktivitas
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
