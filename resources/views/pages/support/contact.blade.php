@extends('layouts.guest')

@section('title', 'Kontak Dukungan - ICL ITATS Career Intelligence')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16 space-y-12 animate-fade-in-up">

    <!-- Header Section -->
    <section class="text-center max-w-2xl mx-auto space-y-3">
        <div class="inline-flex items-center space-x-2 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 px-3.5 py-1.5 rounded-full text-xs font-bold border border-blue-200 dark:border-blue-800/60">
            <span class="material-symbols-outlined text-sm">contact_support</span>
            <span>Layanan Bantuan & Dukungan</span>
        </div>

        <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
            Hubungi Tim Dukungan ICL ITATS
        </h1>

        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
            Ada kendala teknis, pertanyaan seputar data kurikulum, atau masukan untuk platform? Tim kami siap membantu Anda.
        </p>
    </section>

    <!-- 2-Column Main Contact Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
        
        <!-- Left Side: Campus Contact Info & Channels (5 cols) -->
        <div class="lg:col-span-5 space-y-6">
            
            <div class="bg-gradient-to-br from-blue-900 via-indigo-900 to-slate-950 text-white rounded-3xl p-6 sm:p-8 shadow-xl border border-blue-700/30 space-y-6">
                <div class="flex items-center space-x-3 pb-4 border-b border-white/15">
                    <img src="{{ asset('images/mark.png') }}" alt="ICL ITATS Mark" class="w-9 h-9 object-contain">
                    <div>
                        <h3 class="font-extrabold text-base tracking-tight">Pusat Informasi ITATS</h3>
                        <p class="text-xs text-blue-200">Institut Teknologi Adhi Tama Surabaya</p>
                    </div>
                </div>

                <div class="space-y-4 text-xs text-blue-100">
                    <div class="flex items-start space-x-3.5">
                        <span class="material-symbols-outlined text-teal-300 text-xl shrink-0 mt-0.5">location_on</span>
                        <div>
                            <strong class="text-white block font-semibold">Alamat Kampus:</strong>
                            Jl. Arief Rahman Hakim No.100, Klampis Ngasem, Kec. Sukolilo, Surabaya, Jawa Timur 60117
                        </div>
                    </div>

                    <div class="flex items-start space-x-3.5">
                        <span class="material-symbols-outlined text-teal-300 text-xl shrink-0 mt-0.5">mail</span>
                        <div>
                            <strong class="text-white block font-semibold">Email Resmi:</strong>
                            <a href="mailto:icl-support@itats.ac.id" class="text-blue-300 hover:underline">icl-support@itats.ac.id</a>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3.5">
                        <span class="material-symbols-outlined text-teal-300 text-xl shrink-0 mt-0.5">schedule</span>
                        <div>
                            <strong class="text-white block font-semibold">Jam Operasional Layanan:</strong>
                            Senin – Jumat, 08:00 – 16:00 WIB
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-white/15 text-[11px] text-blue-300 flex items-center justify-between">
                    <span>Gemastik XIX 2026</span>
                    <span>Software Development</span>
                </div>
            </div>

            <!-- Quick FAQ Help Banner -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 border border-line dark:border-slate-800 shadow-2xs space-y-3">
                <div class="flex items-center space-x-3">
                    <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 text-2xl">menu_book</span>
                    <h4 class="font-bold text-slate-900 dark:text-white text-sm">Butuh Jawaban Cepat?</h4>
                </div>
                <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                    Sebagian besar pertanyaan terkait unggah bukti, asesmen mandiri, dan snapshot sudah terjawab di panduan kami.
                </p>
                <a href="{{ route('help') }}" class="inline-flex items-center space-x-1.5 text-xs font-bold text-blue-600 dark:text-blue-400 hover:underline">
                    <span>Buka Panduan FAQ</span>
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>

        </div>

        <!-- Right Side: Interactive Support Form (7 cols) -->
        <div class="lg:col-span-7 bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-8 border border-line dark:border-slate-800 shadow-sm space-y-6">
            <div class="border-b border-slate-100 dark:border-slate-800 pb-4">
                <h3 class="text-xl font-extrabold text-slate-900 dark:text-white tracking-tight">Kirim Tiket Pesan Bantuan</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Kami akan merespons pesan Anda melalui email terdaftar dalam 1x24 jam kerja.</p>
            </div>

            <!-- Success Alert Notification -->
            <div id="contact-success-alert" class="hidden p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-800 dark:text-emerald-300 flex items-center space-x-3 text-xs font-semibold">
                <span class="material-symbols-outlined text-emerald-600 dark:text-emerald-400">check_circle</span>
                <span>Terima kasih! Pesan dukungan Anda telah terkirim dan akan segera ditindaklanjuti.</span>
            </div>

            <form id="contact-form" class="space-y-4" onsubmit="event.preventDefault(); document.getElementById('contact-success-alert').classList.remove('hidden'); this.reset();">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Full Name -->
                    <div class="space-y-1.5">
                        <label for="contact-name" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input id="contact-name" name="name" type="text" required placeholder="Contoh: Budi Santoso"
                            class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition">
                    </div>

                    <!-- Email Address -->
                    <div class="space-y-1.5">
                        <label for="contact-email" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Email Institusi / Pribadi <span class="text-red-500">*</span></label>
                        <input id="contact-email" name="email" type="email" required placeholder="nama@mahasiswa.itats.ac.id"
                            class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition">
                    </div>
                </div>

                <!-- Category Selector -->
                <div class="space-y-1.5">
                    <label for="contact-category" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Kategori Pertanyaan <span class="text-red-500">*</span></label>
                    <select id="contact-category" name="category" required
                        class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition">
                        <option value="">-- Pilih Topik Pertanyaan --</option>
                        <option value="asesmen">Kendala Teknis Asesmen Mandiri</option>
                        <option value="evidence">Pengunggahan & Verifikasi Bukti Portofolio</option>
                        <option value="kurikulum">Kesesuaian Standar Kompetensi & Karier</option>
                        <option value="akun">Akses Akun & Autentikasi Kampus</option>
                        <option value="lainnya">Lainnya / Masukan Umum Platform</option>
                    </select>
                </div>

                <!-- Message Textarea -->
                <div class="space-y-1.5">
                    <label for="contact-message" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Rincian Pesan / Kendala <span class="text-red-500">*</span></label>
                    <textarea id="contact-message" name="message" rows="5" required placeholder="Jelaskan secara detail kendala yang dialami beserta konteks halamannya..."
                        class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition"></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition hover-lift flex items-center justify-center space-x-2">
                    <span class="material-symbols-outlined text-lg">send</span>
                    <span>Kirim Pesan Dukungan</span>
                </button>
            </form>
        </div>

    </div>

</div>
@endsection
