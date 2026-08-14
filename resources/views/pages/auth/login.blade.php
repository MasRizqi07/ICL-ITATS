@extends('layouts.guest')

@section('title', 'Login - ICL ITATS Career Intelligence')

@section('content')
<div class="min-h-[calc(100vh-4rem)] flex flex-col md:flex-row w-full bg-slate-50 dark:bg-slate-950">
    
    <!-- Left Side: Visual Hero Branding (Split Screen) -->
    <div class="hidden md:flex md:w-1/2 relative overflow-hidden bg-blue-900 text-white items-center justify-center p-8 lg:p-12">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-950 opacity-95"></div>
        <div class="absolute inset-0 bg-dots-pattern opacity-10 pointer-events-none"></div>

        <div class="relative z-10 flex flex-col justify-between h-full max-w-lg space-y-8">
            <div class="space-y-4">
                <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-bold text-blue-200">
                    <span class="w-2 h-2 rounded-full bg-blue-400 animate-ping"></span>
                    <span>GEMASTIK XIX 2026 - Software Development</span>
                </div>
                <div class="bg-white/95 backdrop-blur-md p-3.5 rounded-2xl shadow-xl border border-white/40 inline-block">
                    <img src="{{ asset('images/logo.png') }}" alt="ICL ITATS Logo" class="h-12 w-auto object-contain">
                </div>
                <p class="text-sm text-blue-200 font-medium">
                    Institute of Technology Adhi Tama Surabaya (ITATS)
                </p>
            </div>

            <!-- Quote Container Card -->
            <div class="bg-white/10 backdrop-blur-md p-6 lg:p-8 rounded-3xl border border-white/20 shadow-xl space-y-4">
                <span class="material-symbols-outlined text-4xl text-blue-300">format_quote</span>
                <p class="text-sm lg:text-base font-medium text-white leading-relaxed italic">
                    "Petakan potensimu, kumpulkan bukti keahlianmu, dan bangun masa depan karier yang terukur sejak dari bangku kuliah."
                </p>
                <div class="flex items-center space-x-3 pt-2">
                    <div class="w-8 h-[2px] bg-teal-400"></div>
                    <span class="text-[11px] font-bold uppercase tracking-widest text-teal-300">Platform Pengembangan Karier ITATS</span>
                </div>
            </div>

            <div class="text-xs text-blue-300">
                © 2026 ICL ITATS • Institutional Career Learning System
            </div>
        </div>
    </div>

    <!-- Right Side: Login Form Card -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-6 sm:p-12">
        <div class="w-full max-w-md bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-8 shadow-xl border border-slate-200 dark:border-slate-800 space-y-6 animate-fade-in-up">
            
            <!-- Mobile Header Logo -->
            <div class="md:hidden text-center space-y-2">
                <img src="{{ asset('images/logo.png') }}" alt="ICL ITATS Logo" class="mx-auto h-12 w-auto object-contain">
                <p class="text-xs text-slate-500 dark:text-slate-400">Career Intelligence Platform</p>
            </div>

            <!-- Header Title -->
            <div class="flex items-center space-x-3.5 pb-2 border-b border-slate-100 dark:border-slate-800">
                <img src="{{ asset('images/mark.png') }}" alt="ICL ITATS Mark" class="w-10 h-10 object-contain drop-shadow-xs">
                <div>
                    <h2 class="text-xl font-extrabold text-slate-900 dark:text-white tracking-tight">Masuk ke Akun Anda</h2>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400">Akses dashboard karier Anda menggunakan kredensial kampus.</p>
                </div>
            </div>

            <!-- Flash Error Message -->
            @if($errors->any())
                <div class="p-4 bg-red-500/10 border border-red-500/30 text-red-700 dark:text-red-300 text-xs rounded-2xl flex items-center space-x-2">
                    <span class="material-symbols-outlined text-lg text-red-500">error</span>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Email Input -->
                <div class="space-y-1.5">
                    <label for="email" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Email Institusi (@itats.ac.id)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <span class="material-symbols-outlined text-xl">mail</span>
                        </div>
                        <input id="email" name="email" type="email" required value="{{ old('email', 'student@itats.ac.id') }}"
                            class="w-full pl-11 pr-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition"
                            placeholder="npm@mahasiswa.itats.ac.id">
                    </div>
                </div>

                <!-- Password Input -->
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-xs font-bold text-slate-700 dark:text-slate-300">Kata Sandi</label>
                        <a href="{{ route('help') }}" class="text-[11px] font-bold text-blue-600 dark:text-blue-400 hover:underline">Lupa Kata Sandi?</a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <span class="material-symbols-outlined text-xl">lock</span>
                        </div>
                        <input id="password" name="password" type="password" required value="password"
                            class="w-full pl-11 pr-11 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition"
                            placeholder="••••••••">
                    </div>
                </div>

                <!-- Remember Me Checkbox -->
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded dark:bg-slate-800 dark:border-slate-700 cursor-pointer">
                    <label for="remember" class="ml-2 block text-xs font-medium text-slate-600 dark:text-slate-400 cursor-pointer">
                        Ingat saya di perangkat ini
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition hover-lift flex items-center justify-center space-x-2">
                    <span class="material-symbols-outlined text-lg">login</span>
                    <span>Masuk Ke Akun</span>
                </button>
            </form>

            @if(app()->environment(['local', 'testing', 'demo']) || config('app.debug'))
            <!-- Quick Demo Login Switcher -->
            <div class="pt-4 border-t border-slate-100 dark:border-slate-800 space-y-2">
                <p class="text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider text-center">Login Instan untuk Pengujian Demo:</p>
                <div class="grid grid-cols-3 gap-2 text-xs">
                    <a href="{{ route('login.quick', 'student') }}" class="py-2.5 bg-blue-50 dark:bg-blue-900/40 hover:bg-blue-100 text-blue-700 dark:text-blue-300 rounded-xl font-bold text-center transition hover-lift">
                        Mahasiswa
                    </a>
                    <a href="{{ route('login.quick', 'reviewer') }}" class="py-2.5 bg-teal-50 dark:bg-teal-900/40 hover:bg-teal-100 text-teal-700 dark:text-teal-300 rounded-xl font-bold text-center transition hover-lift">
                        Reviewer
                    </a>
                    <a href="{{ route('login.quick', 'admin') }}" class="py-2.5 bg-purple-50 dark:bg-purple-900/40 hover:bg-purple-100 text-purple-700 dark:text-purple-300 rounded-xl font-bold text-center transition hover-lift">
                        Admin
                    </a>
                </div>
            </div>
            @endif

        </div>
    </div>

</div>
@endsection
