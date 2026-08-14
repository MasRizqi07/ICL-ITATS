@extends('layouts.guest')

@section('title', 'Pusat Bantuan & Panduan - ICL ITATS')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
    <div class="text-center max-w-2xl mx-auto space-y-2">
        <h1 class="text-3xl font-bold text-slate-900">Pusat Bantuan & Panduan Pengguna</h1>
        <p class="text-sm text-slate-600">Pelajari cara menggunakan ICL ITATS untuk mengembangkan karier Anda.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-2xs space-y-2">
            <span class="material-symbols-outlined text-2xl text-blue-600">quiz</span>
            <h3 class="font-bold text-slate-900 text-sm">Bagaimana Cara Mengikuti Asesmen?</h3>
            <p class="text-xs text-slate-600">Masuk ke menu Asesmen Mandiri, jawab instrumen pertanyaan, dan submit hasil untuk menghitung current level awal.</p>
        </div>

        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-2xs space-y-2">
            <span class="material-symbols-outlined text-2xl text-teal-600">upload_file</span>
            <h3 class="font-bold text-slate-900 text-sm">Bagaimana Cara Mengunggah Bukti?</h3>
            <p class="text-xs text-slate-600">Masuk ke menu Bukti Kemampuan, isi form judul, jenis bukti, tautan repositori/sertifikat, dan pilih kompetensi terkait.</p>
        </div>

        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-2xs space-y-2">
            <span class="material-symbols-outlined text-2xl text-purple-600">published_with_changes</span>
            <h3 class="font-bold text-slate-900 text-sm">Apa itu Reassessment Snapshot?</h3>
            <p class="text-xs text-slate-600">Snapshot adalah rekam jejak permanen nilai kompetensi Anda. Setiap ada bukti terverifikasi baru, snapshot baru akan terbentuk.</p>
        </div>
    </div>
</div>
@endsection
