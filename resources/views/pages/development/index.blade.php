@extends('layouts.app')

@section('title', 'Rencana Pengembangan Diri - ICL ITATS')

@section('content')
<div class="space-y-8 animate-fade-in-up">

    <!-- Header Section -->
    <div class="relative overflow-hidden bg-gradient-to-r from-blue-900 via-indigo-900 to-slate-900 text-white p-6 sm:p-8 rounded-3xl shadow-lg border border-blue-700/30">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div>
                <div class="flex items-center space-x-3">
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Rencana Aksi Pengembangan Diri 🎯</h1>
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-500/30 text-blue-200 border border-blue-400/30">
                        {{ $career->name }}
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-blue-100 mt-2 max-w-2xl leading-relaxed">
                    Aktivitas pembelajaran, proyek mandiri, dan penugasan terarah untuk menutup *skill gap* kompetensi karier target Anda.
                </p>
            </div>
            <button onclick="document.getElementById('add-activity-modal').classList.remove('hidden')" class="px-5 py-2.5 bg-white text-blue-900 hover:bg-blue-50 text-xs font-extrabold rounded-xl shadow-md transition hover-lift flex items-center space-x-2 shrink-0">
                <span class="material-symbols-outlined text-base">add_task</span>
                <span>Tambah Aktivitas Baru</span>
            </button>
        </div>
    </div>

    <!-- Progress Indicator Banner -->
    @php
        $totalActivities = $activities->count();
        $completedActivities = $activities->where('status', 'completed')->count();
        $progressPct = $totalActivities > 0 ? number_format(($completedActivities / $totalActivities) * 100, 0) : 0;
    @endphp

    <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-line dark:border-slate-800 shadow-2xs space-y-3">
        <div class="flex items-center justify-between text-xs font-bold">
            <span class="text-slate-700 dark:text-slate-200">Progres Rencana Aksi Saat Ini</span>
            <span class="text-blue-600 dark:text-blue-400">{{ $completedActivities }} dari {{ $totalActivities }} Aktivitas Selesai ({{ $progressPct }}%)</span>
        </div>
        <div class="w-full h-3 bg-slate-100 dark:bg-slate-800 rounded-full overflow-hidden">
            <div class="h-full bg-gradient-to-r from-blue-600 to-teal-400 rounded-full transition-all duration-500" style="width: {{ $progressPct }}%"></div>
        </div>
    </div>

    <!-- AI Assistance Panel with Violet Gradient Glow -->
    <div class="ai-gradient-border rounded-3xl p-6 sm:p-7 relative overflow-hidden backdrop-blur-md shadow-sm space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-violet-600 text-white rounded-xl shadow-xs">
                    <span class="material-symbols-outlined text-xl animate-float">auto_awesome</span>
                </div>
                <div>
                    <h4 class="font-extrabold text-slate-900 dark:text-white text-base">Rekomendasi AI Assistant (Non-Otoritatif)</h4>
                    <p class="text-xs text-slate-600 dark:text-slate-300">Dapatkan saran tugas latihan terstruktur yang disesuaikan dengan selisih *skill gap* terbesar Anda.</p>
                </div>
            </div>
            <form action="{{ route('development-plans.ai-suggest') }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 bg-violet-600 hover:bg-violet-700 text-white rounded-xl text-xs font-bold transition shadow-md hover-lift flex items-center space-x-2 shrink-0">
                    <span class="material-symbols-outlined text-sm">smart_toy</span>
                    <span>Generate Saran AI</span>
                </button>
            </form>
        </div>

        <div class="p-4 bg-white/70 dark:bg-slate-900/70 rounded-2xl border border-violet-200/60 dark:border-violet-800/40 text-xs text-slate-700 dark:text-slate-300 leading-relaxed">
            <strong class="text-violet-900 dark:text-violet-300 font-bold block mb-1">Rekomendasi Minggu Ini:</strong>
            Fokuskan waktu Anda untuk membangun proyek autentikasi multi-guard menggunakan <em>Laravel Sanctum & PostgreSQL</em> untuk menutup kesenjangan kompetensi teknis backend (gap 0.5 tingkat).
        </div>
    </div>

    <!-- Activities List Cards -->
    <div class="space-y-4">
        <div class="flex items-center justify-between px-1">
            <h3 class="text-lg font-extrabold text-slate-900 dark:text-white tracking-tight">Daftar Aktivitas Pembelajaran & Latihan</h3>
            <span class="text-xs text-slate-400 font-bold">Total: {{ $totalActivities }} Aktivitas</span>
        </div>

        @forelse($activities as $act)
            <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-line dark:border-slate-800 shadow-sm hover-lift flex flex-col md:flex-row items-start md:items-center justify-between gap-5">
                <div class="space-y-2 flex-1">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="px-2.5 py-0.5 rounded-md text-[10px] font-extrabold uppercase tracking-wider bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300">
                            {{ $act->competency->name }}
                        </span>
                        @if($act->priority === 'high')
                            <span class="px-2.5 py-0.5 rounded-md text-[10px] font-extrabold uppercase tracking-wider bg-red-100 dark:bg-red-900/50 text-red-700 dark:text-red-300">
                                Prioritas Tinggi
                            </span>
                        @elseif($act->priority === 'medium')
                            <span class="px-2.5 py-0.5 rounded-md text-[10px] font-extrabold uppercase tracking-wider bg-amber-100 dark:bg-amber-900/50 text-amber-700 dark:text-amber-300">
                                Prioritas Sedang
                            </span>
                        @else
                            <span class="px-2.5 py-0.5 rounded-md text-[10px] font-extrabold uppercase tracking-wider bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300">
                                Prioritas Rendah
                            </span>
                        @endif
                    </div>

                    <h4 class="font-bold text-slate-900 dark:text-white text-base">{{ $act->title }}</h4>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">{{ $act->description }}</p>

                    <div class="pt-1 flex flex-wrap items-center gap-4 text-[11px] text-slate-400 dark:text-slate-500">
                        <span>Target Selesai: <strong class="text-slate-700 dark:text-slate-300">{{ $act->target_date ? date('d M Y', strtotime($act->target_date)) : 'Segera' }}</strong></span>
                        <span>Ekspektasi Bukti: <strong class="text-slate-700 dark:text-slate-300">{{ $act->expected_evidence ?? 'Repositori Project' }}</strong></span>
                    </div>
                </div>

                <div class="shrink-0">
                    <form action="{{ route('development-plans.activities.update', $act->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @if($act->status === 'completed')
                            <span class="px-4 py-2 bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300 font-extrabold text-xs rounded-xl inline-flex items-center space-x-1.5 shadow-2xs">
                                <span class="material-symbols-outlined text-sm">check_circle</span>
                                <span>Aktivitas Selesai</span>
                            </span>
                        @else
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-md transition hover-lift flex items-center space-x-1.5">
                                <span class="material-symbols-outlined text-sm">check</span>
                                <span>Tandai Selesai</span>
                            </button>
                        @endif
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white dark:bg-slate-900 p-12 text-center rounded-3xl border border-line dark:border-slate-800 space-y-4">
                <span class="material-symbols-outlined text-5xl text-slate-300 dark:text-slate-600">checklist_rtl</span>
                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white text-base">Belum Ada Rencana Aktivitas</h4>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Tambahkan aktivitas mandiri atau klik Generate Saran AI di atas untuk mulai membuat rencana aksi.</p>
                </div>
                <button onclick="document.getElementById('add-activity-modal').classList.remove('hidden')" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-bold shadow-md transition hover-lift">
                    + Tambah Aktivitas Pertama
                </button>
            </div>
        @endforelse
    </div>

</div>

<!-- Modal Dialog Add Activity -->
<div id="add-activity-modal" class="hidden fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 flex items-center justify-center p-4">
    <div class="bg-white dark:bg-slate-900 rounded-3xl max-w-lg w-full p-6 sm:p-8 space-y-5 border border-line dark:border-slate-800 shadow-2xl animate-fade-in-up">
        <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-3">
            <h3 class="font-extrabold text-slate-900 dark:text-white text-base">Tambah Aktivitas Pengembangan Baru</h3>
            <button onclick="document.getElementById('add-activity-modal').classList.add('hidden')" class="p-1 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                <span class="material-symbols-outlined text-xl">close</span>
            </button>
        </div>

        <form action="{{ route('development-plans.activities.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <div class="space-y-1.5">
                <label for="modal-competency" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Target Kompetensi <span class="text-red-500">*</span></label>
                <select id="modal-competency" name="competency_id" required
                    class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition">
                    @foreach($competencies as $comp)
                        <option value="{{ $comp->id }}">{{ $comp->name }} ({{ $comp->domain }})</option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-1.5">
                <label for="modal-title" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Judul Aktivitas <span class="text-red-500">*</span></label>
                <input type="text" id="modal-title" name="title" required placeholder="Contoh: Membangun REST API Sanctum Authentication"
                    class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition">
            </div>

            <div class="space-y-1.5">
                <label for="modal-desc" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Rincian Langkah Pengerjaan <span class="text-red-500">*</span></label>
                <textarea id="modal-desc" name="description" rows="3" required placeholder="Tuliskan langkah-langkah latihan atau materi kursus yang akan dipelajari..."
                    class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition"></textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label for="modal-priority" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Tingkat Prioritas</label>
                    <select id="modal-priority" name="priority"
                        class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition">
                        <option value="high">Tinggi</option>
                        <option value="medium" selected>Sedang</option>
                        <option value="low">Rendah</option>
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label for="modal-date" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Target Tanggal Selesai</label>
                    <input type="date" id="modal-date" name="target_date"
                        class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition">
                </div>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="document.getElementById('add-activity-modal').classList.add('hidden')" class="px-5 py-2.5 text-xs font-bold text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                    Batal
                </button>
                <button type="submit" class="px-6 py-2.5 text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-md transition hover-lift">
                    Simpan Aktivitas
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
