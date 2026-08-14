@extends('layouts.guest')

@section('title', 'ICL ITATS - Career Intelligence Platform for University')

@section('content')
<!-- Hero Section with Animated Gradient Background -->
<section class="relative pt-20 pb-24 md:pt-28 md:pb-32 overflow-hidden bg-gradient-to-b from-blue-950 via-slate-900 to-slate-950 text-white">
    <div class="absolute inset-0 bg-dots-pattern opacity-10 pointer-events-none"></div>
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-blue-600/20 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="inline-flex items-center space-x-2 bg-blue-500/20 border border-blue-400/30 text-blue-300 text-xs font-bold px-4 py-1.5 rounded-full mb-6 backdrop-blur-md animate-float">
            <span class="w-2.5 h-2.5 rounded-full bg-blue-400 animate-ping"></span>
            <span>GEMASTIK XIX 2026 - Software Development Competition</span>
        </span>

        <h1 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight leading-tight max-w-4xl mx-auto">
            Hubungkan Target Karier dengan <span class="bg-gradient-to-r from-blue-400 to-teal-300 bg-clip-text text-transparent">Bukti Kompetensi Nyata</span>
        </h1>

        <p class="mt-6 text-base md:text-lg text-slate-300 max-w-2xl mx-auto font-normal leading-relaxed">
            ICL ITATS membantu mahasiswa mengukur kesenjangan kemampuan (*skill gap*), mengumpulkan portofolio terverifikasi, menyusun rencana aksi terarah, dan merekam *reassessment snapshot* secara berkelanjutan.
        </p>

        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('login.quick', 'student') }}" class="w-full sm:w-auto px-8 py-4 text-sm font-bold text-slate-900 bg-white hover:bg-slate-100 rounded-2xl shadow-xl transition-all duration-200 hover-lift flex items-center justify-center space-x-2">
                <span>Demo Mahasiswa (Instant Login)</span>
                <span class="material-symbols-outlined text-lg">arrow_forward</span>
            </a>
            <a href="{{ route('flow') }}" class="w-full sm:w-auto px-8 py-4 text-sm font-bold text-white bg-slate-800/80 hover:bg-slate-800 border border-slate-700 rounded-2xl backdrop-blur-md transition-all duration-200 hover-lift flex items-center justify-center space-x-2">
                <span class="material-symbols-outlined text-lg">schema</span>
                <span>Lihat Alur Kerja Produk</span>
            </a>
        </div>
    </div>
</section>

<!-- Core Product Loop Section -->
<section class="py-20 bg-white dark:bg-slate-900">
    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-xs font-bold text-blue-600 uppercase tracking-widest block mb-2">Workflow System</span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">Siklus Pengembangan Karier Berkelanjutan</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-2 text-sm max-w-lg mx-auto">Setiap langkah terukur, terbukti dengan portofolio, dan dapat diaudit secara transparan.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="p-6 rounded-3xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-800 hover-lift space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-blue-600 text-white flex items-center justify-center font-extrabold text-xl shadow-md">1</div>
                <h3 class="font-bold text-slate-900 dark:text-white text-base">Target & Peta Kompetensi</h3>
                <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">Pilih target karier industri dan lihat standar kompetensi yang dibutuhkan beserta tingkat targetnya.</p>
            </div>

            <div class="p-6 rounded-3xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-800 hover-lift space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-teal-600 text-white flex items-center justify-center font-extrabold text-xl shadow-md">2</div>
                <h3 class="font-bold text-slate-900 dark:text-white text-base">Asesmen & Unggah Bukti</h3>
                <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">Kerjakan asesmen mandiri dan unggah bukti sertifikat, proyek, atau portofolio untuk diverifikasi dosen/reviewer.</p>
            </div>

            <div class="p-6 rounded-3xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-800 hover-lift space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-600 text-white flex items-center justify-center font-extrabold text-xl shadow-md">3</div>
                <h3 class="font-bold text-slate-900 dark:text-white text-base">Analisis Skill Gap & Aksi</h3>
                <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">Sistem menghitung selisih kemampuan dan menghasilkan rencana aksi pengembangan diri dengan dukungan AI.</p>
            </div>

            <div class="p-6 rounded-3xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-800 hover-lift space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-purple-600 text-white flex items-center justify-center font-extrabold text-xl shadow-md">4</div>
                <h3 class="font-bold text-slate-900 dark:text-white text-base">Reassessment Snapshot</h3>
                <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">Setiap perkembangan baru direkam ke dalam *snapshot* permanen untuk memperlihatkan grafik progres *before/after*.</p>
            </div>
        </div>
    </div>
</section>

<!-- Role Selector Cards Section -->
<section class="py-20 bg-slate-50 dark:bg-slate-950 border-t border-slate-200 dark:border-slate-800">
    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white text-center mb-12">Uji Coba Langsung dengan Akun Demo Multi-Role</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm hover-lift flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 flex items-center justify-center font-bold text-lg">M</div>
                        <div>
                            <h4 class="font-bold text-slate-900 dark:text-white text-base">Mahasiswa</h4>
                            <span class="text-xs text-slate-400 font-mono">student@itats.ac.id</span>
                        </div>
                    </div>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed mb-6">Akses dashboard utama, pilih target karier, submit bukti sertifikat, dan lihat grafik perkembangan kompetensi.</p>
                </div>
                <a href="{{ route('login.quick', 'student') }}" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl text-center shadow-md transition">
                    Masuk Sebagai Mahasiswa
                </a>
            </div>

            <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm hover-lift flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-teal-100 dark:bg-teal-900/40 text-teal-700 dark:text-teal-300 flex items-center justify-center font-bold text-lg">R</div>
                        <div>
                            <h4 class="font-bold text-slate-900 dark:text-white text-base">Reviewer / Dosen</h4>
                            <span class="text-xs text-slate-400 font-mono">reviewer@itats.ac.id</span>
                        </div>
                    </div>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed mb-6">Review dan verifikasi sertifikat & portofolio mahasiswa, serta berikan umpan balik langsung.</p>
                </div>
                <a href="{{ route('login.quick', 'reviewer') }}" class="w-full py-3 bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs rounded-xl text-center shadow-md transition">
                    Masuk Sebagai Reviewer
                </a>
            </div>

            <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm hover-lift flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-purple-100 dark:bg-purple-900/40 text-purple-700 dark:text-purple-300 flex items-center justify-center font-bold text-lg">A</div>
                        <div>
                            <h4 class="font-bold text-slate-900 dark:text-white text-base">Administrator</h4>
                            <span class="text-xs text-slate-400 font-mono">admin@itats.ac.id</span>
                        </div>
                    </div>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed mb-6">Kelola data kurikulum, tambah profil karier baru, dan atur pemetaan bobot kompetensi.</p>
                </div>
                <a href="{{ route('login.quick', 'admin') }}" class="w-full py-3 bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs rounded-xl text-center shadow-md transition">
                    Masuk Sebagai Admin
                </a>
            </div>

        </div>
    </div>
</section>
@endsection
