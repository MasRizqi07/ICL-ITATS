@extends('layouts.guest')

@section('title', 'Tentang ICL ITATS - Institutional Career Learning')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16 space-y-16 animate-fade-in-up">

    <!-- Hero Section -->
    <section class="flex flex-col lg:flex-row items-center gap-10 lg:gap-16">
        <div class="flex-1 space-y-6 text-center lg:text-left">
            <div class="inline-flex items-center space-x-2 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 px-3.5 py-1.5 rounded-full text-xs font-bold border border-blue-200 dark:border-blue-800/60">
                <span class="material-symbols-outlined text-sm">lightbulb</span>
                <span>Visi & Misi Platform</span>
            </div>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                Menjembatani Kampus dan <span class="bg-gradient-to-r from-blue-600 to-teal-500 bg-clip-text text-transparent">Industri Global</span>
            </h1>

            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                Platform Career Intelligence <strong>ICL ITATS</strong> dirancang untuk memberdayakan mahasiswa dengan pemetaan kompetensi berbasis data, memastikan kesiapan lulusan untuk bersaing secara tangguh di pasar kerja internasional.
            </p>

            <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 pt-2">
                <a href="{{ route('login.quick', 'student') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition hover-lift flex items-center space-x-2">
                    <span>Mulai Eksplorasi Karier</span>
                    <span class="material-symbols-outlined text-base">arrow_forward</span>
                </a>
                <a href="{{ route('flow') }}" class="px-6 py-3 bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-slate-200 hover:bg-slate-200 dark:hover:bg-slate-700 font-bold text-xs rounded-xl transition hover-lift">
                    Lihat Alur Kerja
                </a>
            </div>
        </div>

        <div class="flex-1 w-full max-w-lg lg:max-w-none">
            <div class="relative rounded-3xl p-6 sm:p-8 bg-gradient-to-br from-blue-900 via-indigo-900 to-slate-950 text-white shadow-xl border border-blue-700/30 overflow-hidden space-y-6">
                <div class="absolute -right-12 -bottom-12 w-48 h-48 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
                
                <div class="flex items-center space-x-3 pb-4 border-b border-white/15">
                    <div class="p-2.5 bg-white/10 rounded-2xl backdrop-blur-md">
                        <img src="{{ asset('images/mark.png') }}" alt="ICL ITATS Mark" class="w-8 h-8 object-contain">
                    </div>
                    <div>
                        <span class="font-extrabold text-base block tracking-tight">ICL ITATS</span>
                        <span class="text-xs text-blue-200">Gemastik XIX Software Development 2026</span>
                    </div>
                </div>

                <blockquote class="text-sm sm:text-base italic text-blue-100 leading-relaxed">
                    "Setiap kompetensi mahasiswa harus dibuktikan dengan artefak portofolio riil, bukan sekadar transkrip nilai konvensional."
                </blockquote>

                <div class="grid grid-cols-2 gap-3 pt-2 text-xs font-semibold text-blue-200">
                    <div class="p-3 bg-white/5 rounded-xl border border-white/10">
                        <span class="block text-white font-extrabold text-lg">100%</span>
                        <span>Berbasis Evidence</span>
                    </div>
                    <div class="p-3 bg-white/5 rounded-xl border border-white/10">
                        <span class="block text-white font-extrabold text-lg">Otoritatif</span>
                        <span>Validasi Dosen/Reviewer</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mengapa Career Intelligence? Bento Grid -->
    <section class="space-y-8">
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <span class="text-xs font-bold text-blue-600 dark:text-blue-400 uppercase tracking-widest block">Keunggulan Sistem</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Mengapa Career Intelligence?</h2>
            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400">Pendekatan modern dalam pengembangan karier yang didukung oleh analisis objektif dan validasi industri.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 sm:p-8 border border-line dark:border-slate-800 shadow-2xs hover-lift space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 flex items-center justify-center">
                    <span class="material-symbols-outlined text-2xl">analytics</span>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Pemetaan Berbasis Data</h3>
                <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                    Menganalisis profil kompetensi mahasiswa secara real-time untuk mengidentifikasi celah keterampilan (*skill gap*) dan memberikan rekomendasi pembelajaran yang presisi.
                </p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 sm:p-8 border border-line dark:border-slate-800 shadow-2xs hover-lift space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-teal-50 dark:bg-teal-900/40 text-teal-600 dark:text-teal-400 flex items-center justify-center">
                    <span class="material-symbols-outlined text-2xl">handshake</span>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Standar Industri Global</h3>
                <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                    Indikator penilaian kurikulum diselaraskan langsung dengan kebutuhan terkini dari industri teknologi terkemuka.
                </p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 sm:p-8 border border-violet-200 dark:border-violet-800/60 shadow-2xs hover-lift space-y-4 relative overflow-hidden">
                <div class="absolute -right-8 -top-8 w-24 h-24 bg-violet-500/10 rounded-full blur-2xl pointer-events-none"></div>
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-2xl bg-violet-50 dark:bg-violet-900/40 text-violet-600 dark:text-violet-400 flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl">smart_toy</span>
                    </div>
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-violet-100 dark:bg-violet-900/50 text-violet-700 dark:text-violet-300 uppercase tracking-wide">
                        AI-Assisted
                    </span>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Dibantu Asisten AI</h3>
                <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                    Asisten cerdas yang membantu menyarankan rencana aksi pengembangan terstruktur, dengan tetap mempertahankan kendali penuh mahasiswa (*human in the loop*).
                </p>
            </div>
        </div>
    </section>

    <!-- Metodologi Penilaian Transparan -->
    <section class="bg-slate-50 dark:bg-slate-900/60 rounded-3xl p-6 sm:p-10 border border-line dark:border-slate-800 shadow-sm flex flex-col md:flex-row gap-8 items-center">
        <div class="flex-1 space-y-4">
            <span class="text-xs font-bold text-teal-600 dark:text-teal-400 uppercase tracking-widest block">Auditabilitas</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Metodologi Penilaian Transparan</h2>
            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                Sistem evaluasi kami memadukan asesmen mandiri (*self-assessment*), unggah bukti portofolio konkret, dan verifikasi reviewer/dosen. Hal ini menjamin bahwa setiap tingkat kompetensi yang dicapai dapat dipertanggungjawabkan secara transparan.
            </p>
            <ul class="space-y-2.5 pt-2 text-xs font-semibold text-slate-700 dark:text-slate-200">
                <li class="flex items-center space-x-2.5">
                    <span class="material-symbols-outlined text-teal-600 dark:text-teal-400 text-lg">check_circle</span>
                    <span>Penetapan Target Tingkat Kemampuan Minimum Industri</span>
                </li>
                <li class="flex items-center space-x-2.5">
                    <span class="material-symbols-outlined text-teal-600 dark:text-teal-400 text-lg">check_circle</span>
                    <span>Pengumpulan Evidence Portofolio Berkualitas (Link/Berkas)</span>
                </li>
                <li class="flex items-center space-x-2.5">
                    <span class="material-symbols-outlined text-teal-600 dark:text-teal-400 text-lg">check_circle</span>
                    <span>Validasi Otoritatif Dosen & Penerbitan Reassessment Snapshot</span>
                </li>
            </ul>
        </div>

        <div class="flex-1 w-full max-w-sm flex justify-center">
            <div class="w-full aspect-square bg-white dark:bg-slate-800 rounded-3xl p-6 border border-line dark:border-slate-700 shadow-md flex flex-col items-center justify-center text-center space-y-3">
                <div class="w-16 h-16 rounded-2xl bg-blue-50 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 flex items-center justify-center">
                    <span class="material-symbols-outlined text-3xl">hub</span>
                </div>
                <h4 class="font-extrabold text-slate-900 dark:text-white text-base">Siklus Tertutup & Terverifikasi</h4>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                    Mengintegrasikan kurikulum prodi, bukti mahasiswa, dan persetujuan dosen dalam satu basis data terstruktur.
                </p>
            </div>
        </div>
    </section>

    <!-- Tim Pengembang & Penasihat -->
    <section class="space-y-8">
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <span class="text-xs font-bold text-blue-600 dark:text-blue-400 uppercase tracking-widest block">Kolaborasi Kampus</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Tim Inovator ICL ITATS</h2>
            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400">Sinergi antara akademisi dan mahasiswa Institut Teknologi Adhi Tama Surabaya untuk Gemastik XIX 2026.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <!-- Member 1 -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-5 border border-line dark:border-slate-800 shadow-2xs hover-lift text-center space-y-3">
                <div class="w-16 h-16 mx-auto rounded-full bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300 font-extrabold text-xl flex items-center justify-center shadow-xs">
                    AF
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white text-sm">Ahmad Fauzi</h4>
                    <p class="text-xs text-blue-600 dark:text-blue-400 font-medium">Lead Software Architect</p>
                </div>
                <p class="text-[11px] text-slate-500 dark:text-slate-400">Teknik Informatika ITATS</p>
            </div>

            <!-- Member 2 -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-5 border border-line dark:border-slate-800 shadow-2xs hover-lift text-center space-y-3">
                <div class="w-16 h-16 mx-auto rounded-full bg-teal-100 dark:bg-teal-900/50 text-teal-700 dark:text-teal-300 font-extrabold text-xl flex items-center justify-center shadow-xs">
                    SA
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white text-sm">Dr. Siti Aminah</h4>
                    <p class="text-xs text-teal-600 dark:text-teal-400 font-medium">Academic Advisor & Reviewer</p>
                </div>
                <p class="text-[11px] text-slate-500 dark:text-slate-400">Dosen Pembimbing ITATS</p>
            </div>

            <!-- Member 3 -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-5 border border-line dark:border-slate-800 shadow-2xs hover-lift text-center space-y-3">
                <div class="w-16 h-16 mx-auto rounded-full bg-indigo-100 dark:bg-indigo-900/50 text-indigo-700 dark:text-indigo-300 font-extrabold text-xl flex items-center justify-center shadow-xs">
                    BS
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white text-sm">Budi Santoso</h4>
                    <p class="text-xs text-indigo-600 dark:text-indigo-400 font-medium">UI/UX & Frontend Engineer</p>
                </div>
                <p class="text-[11px] text-slate-500 dark:text-slate-400">Teknik Informatika ITATS</p>
            </div>

            <!-- Member 4 -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-5 border border-line dark:border-slate-800 shadow-2xs hover-lift text-center space-y-3">
                <div class="w-16 h-16 mx-auto rounded-full bg-purple-100 dark:bg-purple-900/50 text-purple-700 dark:text-purple-300 font-extrabold text-xl flex items-center justify-center shadow-xs">
                    RM
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white text-sm">Rina Melati</h4>
                    <p class="text-xs text-purple-600 dark:text-purple-400 font-medium">Data & Competency Analyst</p>
                </div>
                <p class="text-[11px] text-slate-500 dark:text-slate-400">Sistem Informasi ITATS</p>
            </div>
        </div>
    </section>

</div>
@endsection
