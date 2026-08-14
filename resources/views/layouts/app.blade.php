<!DOCTYPE html>
<html lang="id" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>@yield('title', 'ICL ITATS Career Intelligence')</title>

    <!-- Immediate Dark Mode Script in Head to Prevent Flicker (FOUC) -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('color-theme');
            const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (savedTheme === 'dark' || (!savedTheme && systemDark)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                screens: {
                    'xs': '360px',
                    'sm': '480px',
                    'md': '768px',
                    'lg': '1024px',
                    'xl': '1200px',
                    '2xl': '1920px',
                },
                extend: {
                    colors: {
                        "primary": "#2563eb",
                        "primary-dark": "#004ac6",
                        "secondary": "#0F766E",
                        "tertiary": "#B45309",
                        "ai-accent": "#6D28D9",
                        "ink": "#17202A",
                        "canvas": "#F8FAFC",
                        "surface": "#FFFFFF",
                        "line": "#D9E0E8",
                        "error": "#B42318"
                    },
                    fontFamily: {
                        sans: ["Inter", "sans-serif"]
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
    @stack('styles')
</head>
<body class="h-full flex flex-col bg-[#F8FAFC] dark:bg-slate-950 text-[#17202A] dark:text-slate-100 transition-colors duration-300 antialiased selection:bg-blue-600 selection:text-white">

    <!-- Top Navigation Bar with Responsive Breakpoints -->
    <header class="sticky top-0 z-40 bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border-b border-[#D9E0E8] dark:border-slate-800 transition-colors duration-300">
        <div class="max-w-[1400px] 2xl:max-w-[1600px] mx-auto px-3 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            
            <div class="flex items-center space-x-3">
                <!-- Mobile Hamburger Menu Button (< 768px) -->
                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition active:scale-95">
                    <span class="material-symbols-outlined text-2xl">menu</span>
                </button>

                <!-- Logo Brand -->
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 group">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-gradient-to-tr from-blue-700 to-blue-500 flex items-center justify-center text-white font-extrabold text-lg sm:text-xl shadow-md group-hover:scale-105 transition-transform duration-200">
                        ICL
                    </div>
                    <div class="leading-tight">
                        <span class="font-extrabold text-slate-900 dark:text-white text-sm sm:text-base tracking-tight block">ICL ITATS</span>
                        <span class="text-[10px] sm:text-[11px] text-slate-500 dark:text-slate-400 block font-medium">Career Intelligence</span>
                    </div>
                </a>
            </div>

            <!-- Header Quick Role Switcher & User Profile -->
            <div class="flex items-center space-x-2 sm:space-x-4">
                <!-- Role Switcher Pill for Demo (Hidden on Small Screens) -->
                <div class="hidden lg:flex items-center bg-slate-100 dark:bg-slate-800 p-1 rounded-xl text-xs font-semibold border border-slate-200 dark:border-slate-700">
                    <span class="px-2 text-slate-400 dark:text-slate-500">Role Demo:</span>
                    <a href="{{ route('login.quick', 'student') }}" class="px-2.5 py-1 rounded-lg transition {{ auth()->user()->isStudent() ? 'bg-white dark:bg-slate-700 text-blue-600 dark:text-blue-400 shadow-xs font-bold' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900' }}">Mahasiswa</a>
                    <a href="{{ route('login.quick', 'reviewer') }}" class="px-2.5 py-1 rounded-lg transition {{ auth()->user()->isReviewer() ? 'bg-white dark:bg-slate-700 text-teal-600 dark:text-teal-400 shadow-xs font-bold' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900' }}">Reviewer</a>
                    <a href="{{ route('login.quick', 'admin') }}" class="px-2.5 py-1 rounded-lg transition {{ auth()->user()->isAdmin() ? 'bg-white dark:bg-slate-700 text-purple-600 dark:text-purple-400 shadow-xs font-bold' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900' }}">Admin</a>
                </div>

                <!-- Instant Toggle Dark/Light Mode Button -->
                <button id="theme-toggle" type="button" aria-label="Toggle Theme" class="p-2 text-slate-500 hover:text-slate-700 dark:text-slate-300 dark:hover:text-white rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors duration-200 active:scale-95">
                    <span class="material-symbols-outlined text-xl dark:hidden text-slate-700">dark_mode</span>
                    <span class="material-symbols-outlined text-xl hidden dark:block text-amber-400">light_mode</span>
                </button>

                <!-- Notifications -->
                <a href="{{ route('notifications.index') }}" class="p-2 text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition relative active:scale-95">
                    <span class="material-symbols-outlined text-xl">notifications</span>
                    <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-blue-600 rounded-full border-2 border-white dark:border-slate-900 animate-pulse"></span>
                </a>

                <!-- User Profile Badge & Logout -->
                <div class="flex items-center space-x-2 sm:space-x-3 pl-2 sm:pl-3 border-l border-slate-200 dark:border-slate-800">
                    <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 text-white font-bold flex items-center justify-center text-xs sm:text-sm shadow-xs">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="hidden sm:block leading-tight text-xs">
                        <div class="font-bold text-slate-900 dark:text-slate-100 truncate max-w-[120px]">{{ auth()->user()->name }}</div>
                        <div class="text-slate-500 dark:text-slate-400 capitalize font-medium">{{ auth()->user()->role }}</div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" title="Keluar" class="p-1.5 sm:p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition">
                            <span class="material-symbols-outlined text-lg sm:text-xl">logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Slide-Over Drawer Navigation (< 768px) -->
    <div id="mobile-drawer" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden transition-opacity duration-300">
        <div class="fixed inset-y-0 left-0 max-w-xs w-full bg-white dark:bg-slate-900 p-5 shadow-2xl space-y-4 overflow-y-auto flex flex-col justify-between">
            <div class="space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-3">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 rounded-lg bg-blue-600 text-white font-bold flex items-center justify-center text-sm">ICL</div>
                        <span class="font-bold text-slate-900 dark:text-white text-sm">ICL ITATS Menu</span>
                    </div>
                    <button id="mobile-drawer-close" class="p-1 text-slate-400 hover:text-slate-600">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <!-- Quick Switcher on Mobile Drawer -->
                <div class="p-3 bg-slate-50 dark:bg-slate-800 rounded-xl space-y-2">
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider block">Ganti Role Demo:</span>
                    <div class="grid grid-cols-3 gap-1 text-center text-xs">
                        <a href="{{ route('login.quick', 'student') }}" class="py-1.5 bg-blue-50 text-blue-700 rounded font-semibold">Mahasiswa</a>
                        <a href="{{ route('login.quick', 'reviewer') }}" class="py-1.5 bg-teal-50 text-teal-700 rounded font-semibold">Reviewer</a>
                        <a href="{{ route('login.quick', 'admin') }}" class="py-1.5 bg-purple-50 text-purple-700 rounded font-semibold">Admin</a>
                    </div>
                </div>

                <nav class="space-y-1 text-xs">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">
                        <span class="material-symbols-outlined text-lg">dashboard</span>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('careers.show', 'fullstack-web-developer') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">
                        <span class="material-symbols-outlined text-lg">work</span>
                        <span>Target Karier</span>
                    </a>
                    <a href="{{ route('competency.map') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">
                        <span class="material-symbols-outlined text-lg">map</span>
                        <span>Peta Kompetensi</span>
                    </a>
                    <a href="{{ route('assessment.show') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">
                        <span class="material-symbols-outlined text-lg">quiz</span>
                        <span>Asesmen Mandiri</span>
                    </a>
                    <a href="{{ route('evidence.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">
                        <span class="material-symbols-outlined text-lg">folder_special</span>
                        <span>Bukti Kemampuan</span>
                    </a>
                    <a href="{{ route('skill-gaps') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">
                        <span class="material-symbols-outlined text-lg">insights</span>
                        <span>Analisis Skill Gap</span>
                    </a>
                    <a href="{{ route('development-plans.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">
                        <span class="material-symbols-outlined text-lg">checklist_rtl</span>
                        <span>Rencana Pengembangan</span>
                    </a>
                    <a href="{{ route('reassessments.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">
                        <span class="material-symbols-outlined text-lg">history</span>
                        <span>Penilaian Ulang</span>
                    </a>
                </nav>
            </div>

            <div class="pt-4 border-t border-slate-100 dark:border-slate-800 text-xs text-slate-400 text-center">
                ICL ITATS Mobile • 2026
            </div>
        </div>
    </div>

    <!-- Main Content Layout with Desktop Sidebar & Responsive Grid -->
    <div class="flex-1 max-w-[1400px] 2xl:max-w-[1600px] w-full mx-auto px-3 sm:px-6 lg:px-8 py-4 sm:py-6 flex flex-col md:flex-row gap-6">
        
        <!-- Desktop Sidebar Navigation (>= 768px) -->
        <aside class="hidden md:block w-60 xl:w-64 shrink-0">
            <nav class="bg-white/90 dark:bg-slate-900/90 backdrop-blur-md rounded-2xl border border-[#D9E0E8] dark:border-slate-800 p-3.5 space-y-1 shadow-sm sticky top-22">
                
                <div class="px-3 py-2 text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                    Menu Utama
                </div>

                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition hover-lift {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                    <span class="material-symbols-outlined text-lg">dashboard</span>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('careers.show', 'fullstack-web-developer') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition hover-lift {{ request()->routeIs('careers.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                    <span class="material-symbols-outlined text-lg">work</span>
                    <span>Target Karier</span>
                </a>

                <a href="{{ route('competency.map') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition hover-lift {{ request()->routeIs('competency.map') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                    <span class="material-symbols-outlined text-lg">map</span>
                    <span>Peta Kompetensi</span>
                </a>

                <a href="{{ route('assessment.show') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition hover-lift {{ request()->routeIs('assessment.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                    <span class="material-symbols-outlined text-lg">quiz</span>
                    <span>Asesmen Mandiri</span>
                </a>

                <a href="{{ route('evidence.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition hover-lift {{ request()->routeIs('evidence.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                    <span class="material-symbols-outlined text-lg">folder_special</span>
                    <span>Bukti Kemampuan</span>
                </a>

                <a href="{{ route('skill-gaps') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition hover-lift {{ request()->routeIs('skill-gaps') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                    <span class="material-symbols-outlined text-lg">insights</span>
                    <span>Analisis Skill Gap</span>
                </a>

                <a href="{{ route('development-plans.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition hover-lift {{ request()->routeIs('development-plans.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                    <span class="material-symbols-outlined text-lg">checklist_rtl</span>
                    <span>Rencana Pengembangan</span>
                </a>

                <a href="{{ route('reassessments.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition hover-lift {{ request()->routeIs('reassessments.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                    <span class="material-symbols-outlined text-lg">history</span>
                    <span>Penilaian Ulang</span>
                </a>

                <!-- Special Role Section -->
                @if(auth()->user()->isReviewer())
                    <div class="pt-3 pb-1 px-3 text-[11px] font-bold text-teal-600 dark:text-teal-400 uppercase tracking-widest">
                        Portal Reviewer
                    </div>
                    <a href="{{ route('reviewer.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-teal-700 bg-teal-50 dark:bg-teal-900/40 dark:text-teal-300 border border-teal-200 dark:border-teal-800 hover-lift">
                        <span class="material-symbols-outlined text-lg">fact_check</span>
                        <span>Verifikasi Bukti</span>
                    </a>
                @endif

                @if(auth()->user()->isAdmin())
                    <div class="pt-3 pb-1 px-3 text-[11px] font-bold text-purple-600 dark:text-purple-400 uppercase tracking-widest">
                        Manajemen Admin
                    </div>
                    <a href="{{ route('admin.careers') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover-lift">
                        <span class="material-symbols-outlined text-lg">work_history</span>
                        <span>Data Karier</span>
                    </a>
                    <a href="{{ route('admin.competencies') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover-lift">
                        <span class="material-symbols-outlined text-lg">menu_book</span>
                        <span>Kurikulum Kompetensi</span>
                    </a>
                @endif

                <div class="pt-3 pb-1 px-3 text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                    Informasi & Akun
                </div>

                <a href="{{ route('profile.show') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover-lift">
                    <span class="material-symbols-outlined text-lg">person</span>
                    <span>Profil Saya</span>
                </a>

                <a href="{{ route('flow') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover-lift">
                    <span class="material-symbols-outlined text-lg">schema</span>
                    <span>Alur Platform</span>
                </a>

                <a href="{{ route('about') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover-lift">
                    <span class="material-symbols-outlined text-lg">info</span>
                    <span>Tentang ICL ITATS</span>
                </a>
            </nav>
        </aside>

        <!-- Main Workspace Area -->
        <main class="flex-1 min-w-0 animate-fade-in-up">
            <!-- Flash Message Alerts -->
            @if(session('success'))
                <div class="mb-5 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-800 dark:text-emerald-300 flex items-center justify-between backdrop-blur-md animate-fade-in-up">
                    <div class="flex items-center space-x-3">
                        <span class="material-symbols-outlined text-emerald-600 dark:text-emerald-400">check_circle</span>
                        <span class="text-xs font-semibold">{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">
                        <span class="material-symbols-outlined text-lg">close</span>
                    </button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Robust & Smooth Dark Mode Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggleBtn = document.getElementById('theme-toggle');
            
            if (themeToggleBtn) {
                themeToggleBtn.addEventListener('click', function() {
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    }
                });
            }

            // Mobile Drawer Navigation Toggle
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileDrawer = document.getElementById('mobile-drawer');
            const mobileDrawerClose = document.getElementById('mobile-drawer-close');

            if (mobileMenuBtn && mobileDrawer && mobileDrawerClose) {
                mobileMenuBtn.addEventListener('click', () => {
                    mobileDrawer.classList.remove('hidden');
                });
                mobileDrawerClose.addEventListener('click', () => {
                    mobileDrawer.classList.add('hidden');
                });
                mobileDrawer.addEventListener('click', (e) => {
                    if (e.target === mobileDrawer) {
                        mobileDrawer.classList.add('hidden');
                    }
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
