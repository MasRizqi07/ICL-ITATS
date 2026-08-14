@extends('layouts.guest')

@section('title', 'ICL ITATS - Career Intelligence Platform for University')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-b from-blue-50/50 to-white py-16 md:py-24 border-b border-slate-100">
    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-flex items-center space-x-2 bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full mb-4">
            <span class="w-2 h-2 rounded-full bg-blue-600"></span>
            <span>GEMASTIK XIX 2026 - Software Development</span>
        </span>
        <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight max-w-4xl mx-auto">
            Hubungkan Target Karier dengan <span class="text-blue-600">Bukti Kompetensi Realisitik</span> & Analisis Skill Gap Presisi
        </h1>
        <p class="mt-4 text-base md:text-lg text-slate-600 max-w-2xl mx-auto font-normal">
            ICL ITATS membantu mahasiswa mengukur kesenjangan kemampuan, mengumpulkan portofolio terverifikasi, menyusun rencana aksi terarah, dan merekam *reassessment snapshot* secara berkelanjutan.
        </p>

        <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('login.quick', 'student') }}" class="w-full sm:w-auto px-6 py-3.5 text-base font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-md transition flex items-center justify-center space-x-2">
                <span>Demo Mahasiswa (Instant Login)</span>
                <span class="material-symbols-outlined text-lg">arrow_forward</span>
            </a>
            <a href="{{ route('flow') }}" class="w-full sm:w-auto px-6 py-3.5 text-base font-semibold text-slate-700 bg-white hover:bg-slate-50 border border-slate-300 rounded-xl transition flex items-center justify-center space-x-2">
                <span class="material-symbols-outlined text-lg">schema</span>
                <span>Lihat Alur Kerja Produk</span>
            </a>
        </div>
    </div>
</section>

<!-- Core Product Loop Section -->
<section class="py-16 bg-white">
    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold text-slate-900">Siklus Pengembangan Karier Berkelanjutan</h2>
            <p class="text-slate-600 mt-2 text-sm">Setiap langkah terukur, terbukti dengan portofolio, dan dapat diaudit secara transparan.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="p-6 rounded-xl bg-slate-50 border border-slate-200">
                <div class="w-12 h-12 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xl mb-4">1</div>
                <h3 class="font-bold text-slate-900 text-base mb-2">Target & Peta Kompetensi</h3>
                <p class="text-xs text-slate-600 leading-relaxed">Pilih target karier industri dan lihat standar kompetensi yang dibutuhkan beserta tingkat targetnya.</p>
            </div>

            <div class="p-6 rounded-xl bg-slate-50 border border-slate-200">
                <div class="w-12 h-12 rounded-lg bg-teal-100 text-teal-600 flex items-center justify-center font-bold text-xl mb-4">2</div>
                <h3 class="font-bold text-slate-900 text-base mb-2">Asesmen & Unggah Bukti</h3>
                <p class="text-xs text-slate-600 leading-relaxed">Kerjakan asesmen mandiri dan unggah bukti sertifikat, proyek, atau portofolio untuk diverifikasi dosen/reviewer.</p>
            </div>

            <div class="p-6 rounded-xl bg-slate-50 border border-slate-200">
                <div class="w-12 h-12 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center font-bold text-xl mb-4">3</div>
                <h3 class="font-bold text-slate-900 text-base mb-2">Analisis Skill Gap & Aksi</h3>
                <p class="text-xs text-slate-600 leading-relaxed">Sistem menghitung selisih kemampuan dan menghasilkan rencana aksi pengembangan diri dengan dukungan AI.</p>
            </div>

            <div class="p-6 rounded-xl bg-slate-50 border border-slate-200">
                <div class="w-12 h-12 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center font-bold text-xl mb-4">4</div>
                <h3 class="font-bold text-slate-900 text-base mb-2">Reassessment Snapshot</h3>
                <p class="text-xs text-slate-600 leading-relaxed">Setiap perkembangan baru direkam ke dalam *snapshot* permanen untuk memperlihatkan grafik progres *before/after*.</p>
            </div>
        </div>
    </div>
</section>

<!-- Role Selector Cards Section -->
<section class="py-16 bg-slate-50 border-t border-slate-200">
    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-slate-900 text-center mb-8">Uji Coba Langsung dengan Akun Demo Multi-Role</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold">M</div>
                        <div>
                            <h4 class="font-bold text-slate-900">Mahasiswa</h4>
                            <span class="text-xs text-slate-500">student@itats.ac.id</span>
                        </div>
                    </div>
                    <p class="text-xs text-slate-600 mb-4">Akses dashboard utama, pilih target karier, submit bukti sertifikat, dan lihat grafik perkembangan kompetensi.</p>
                </div>
                <a href="{{ route('login.quick', 'student') }}" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium text-xs rounded-lg text-center transition">
                    Masuk Sebagai Mahasiswa
                </a>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-teal-100 text-teal-700 flex items-center justify-center font-bold">R</div>
                        <div>
                            <h4 class="font-bold text-slate-900">Reviewer / Dosen</h4>
                            <span class="text-xs text-slate-500">reviewer@itats.ac.id</span>
                        </div>
                    </div>
                    <p class="text-xs text-slate-600 mb-4">Review dan verifikasi sertifikat & portofolio mahasiswa, serta berikan umpan balik langsung.</p>
                </div>
                <a href="{{ route('login.quick', 'reviewer') }}" class="w-full py-2.5 bg-teal-600 hover:bg-teal-700 text-white font-medium text-xs rounded-lg text-center transition">
                    Masuk Sebagai Reviewer
                </a>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-purple-100 text-purple-700 flex items-center justify-center font-bold">A</div>
                        <div>
                            <h4 class="font-bold text-slate-900">Administrator</h4>
                            <span class="text-xs text-slate-500">admin@itats.ac.id</span>
                        </div>
                    </div>
                    <p class="text-xs text-slate-600 mb-4">Kelola data kurikulum, tambah profil karier baru, dan atur pemetaan bobot kompetensi.</p>
                </div>
                <a href="{{ route('login.quick', 'admin') }}" class="w-full py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-medium text-xs rounded-lg text-center transition">
                    Masuk Sebagai Admin
                </a>
            </div>

        </div>
    </div>
</section>
@endsection
