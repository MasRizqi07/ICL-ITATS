@extends('layouts.app')

@section('title', 'Daftar Bukti Kemampuan - ICL ITATS')

@section('content')
<div class="space-y-6">

    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-[#D9E0E8] dark:border-slate-700 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Daftar Bukti Kemampuan (Evidence)</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                Portofolio, proyek, sertifikat, dan dokumen resmi yang membuktikan penguasaan kompetensi Anda.
            </p>
        </div>
        <a href="{{ route('evidence.create') }}" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-xl shadow-xs transition flex items-center space-x-2">
            <span class="material-symbols-outlined text-base">add</span>
            <span>Tambah Bukti Baru</span>
        </a>
    </div>

    <!-- Evidence Cards List -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse($evidence as $item)
            <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-slate-200 dark:border-slate-700 flex flex-col justify-between space-y-4">
                <div>
                    <div class="flex items-start justify-between">
                        <div class="flex items-center space-x-2">
                            <span class="p-2 rounded-lg bg-blue-50 text-blue-600 dark:bg-blue-900/40 dark:text-blue-300">
                                <span class="material-symbols-outlined text-xl">
                                    {{ $item->type === 'certificate' ? 'workspace_premium' : 'folder_open' }}
                                </span>
                            </span>
                            <div>
                                <h3 class="font-bold text-slate-900 dark:text-white text-sm">{{ $item->title }}</h3>
                                <span class="text-[10px] text-slate-400 uppercase font-semibold">{{ $item->type }}</span>
                            </div>
                        </div>

                        <!-- Status Badge -->
                        @if($item->validation_status === 'verified')
                            <span class="px-2.5 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300 flex items-center space-x-1">
                                <span class="material-symbols-outlined text-xs">verified</span>
                                <span>Terverifikasi</span>
                            </span>
                        @elseif($item->validation_status === 'pending')
                            <span class="px-2.5 py-0.5 rounded text-[10px] font-bold bg-amber-100 text-amber-800 dark:bg-amber-900/50 dark:text-amber-300">
                                Menunggu Review
                            </span>
                        @else
                            <span class="px-2.5 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-700">
                                {{ $item->validation_status }}
                            </span>
                        @endif
                    </div>

                    <p class="text-xs text-slate-600 dark:text-slate-300 mt-3 leading-relaxed">
                        {{ $item->description }}
                    </p>

                    @if($item->source_url)
                        <a href="{{ $item->source_url }}" target="_blank" class="inline-flex items-center space-x-1 text-xs text-blue-600 dark:text-blue-400 font-medium mt-2 hover:underline mr-3">
                            <span class="material-symbols-outlined text-sm">link</span>
                            <span>Buka Tautan (External URL)</span>
                        </a>
                    @endif

                    @if($item->storage_key)
                        <a href="{{ route('evidence.download', $item->id) }}" class="inline-flex items-center space-x-1 text-xs text-emerald-600 dark:text-emerald-400 font-medium mt-2 hover:underline">
                            <span class="material-symbols-outlined text-sm">download</span>
                            <span>Unduh Berkas Privat</span>
                        </a>
                    @endif

                    @if($item->reviewer_note)
                        <div class="mt-3 p-3 bg-teal-50 dark:bg-teal-900/30 border border-teal-200 dark:border-teal-800 rounded-lg text-xs">
                            <strong class="text-teal-900 dark:text-teal-200 font-semibold block mb-0.5">Catatan Reviewer Dosen:</strong>
                            <p class="text-teal-800 dark:text-teal-300">{{ $item->reviewer_note }}</p>
                        </div>
                    @endif
                </div>

                <div class="pt-3 border-t border-slate-100 dark:border-slate-700 flex items-center justify-between text-[11px] text-slate-400">
                    <span>Diperoleh: {{ $item->obtained_at ? date('d M Y', strtotime($item->obtained_at)) : '-' }}</span>
                    <span>Kompetensi Terkait: {{ $item->competencies->pluck('name')->implode(', ') }}</span>
                </div>
            </div>
        @empty
            <div class="col-span-2 bg-white dark:bg-slate-800 p-12 text-center rounded-xl border border-slate-200 dark:border-slate-700">
                <span class="material-symbols-outlined text-4xl text-slate-300 mb-2">folder_off</span>
                <p class="text-xs text-slate-500 font-medium">Belum ada bukti kemampuan yang diunggah.</p>
                <a href="{{ route('evidence.create') }}" class="mt-3 inline-block px-4 py-2 bg-blue-600 text-white rounded-lg text-xs font-semibold">
                    Tambah Bukti Pertama
                </a>
            </div>
        @endforelse
    </div>

</div>
@endsection
