<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'ICL ITATS Career Intelligence')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
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
<body class="h-full flex flex-col bg-[#F8FAFC] dark:bg-slate-900 text-[#17202A] dark:text-slate-100 transition-colors duration-200">

    <!-- Top Navigation Bar -->
    <header class="bg-white dark:bg-slate-800 border-b border-[#D9E0E8] dark:border-slate-700 sticky top-0 z-30">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <div class="w-9 h-9 rounded-lg bg-blue-600 flex items-center justify-center text-white font-bold text-lg shadow-sm">
                        ICL
                    </div>
                    <div class="leading-tight">
                        <span class="font-bold text-slate-900 dark:text-white text-base tracking-tight block">ICL ITATS</span>
                        <span class="text-xs text-slate-500 dark:text-slate-400 block font-normal">Career Intelligence Platform</span>
                    </div>
                </a>
            </div>

            <!-- Header Quick Role Switcher & User Profile -->
            <div class="flex items-center space-x-4">
                <!-- Role Switcher Pill for Demo -->
                <div class="hidden sm:flex items-center bg-slate-100 dark:bg-slate-700 p-1 rounded-lg text-xs font-medium">
                    <span class="px-2 text-slate-500 dark:text-slate-400">Demo Role:</span>
                    <a href="{{ route('login.quick', 'student') }}" class="px-2 py-1 rounded {{ auth()->user()->isStudent() ? 'bg-white dark:bg-slate-600 text-blue-600 font-semibold shadow-xs' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900' }}">Mahasiswa</a>
                    <a href="{{ route('login.quick', 'reviewer') }}" class="px-2 py-1 rounded {{ auth()->user()->isReviewer() ? 'bg-white dark:bg-slate-600 text-teal-600 font-semibold shadow-xs' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900' }}">Reviewer</a>
                    <a href="{{ route('login.quick', 'admin') }}" class="px-2 py-1 rounded {{ auth()->user()->isAdmin() ? 'bg-white dark:bg-slate-600 text-purple-600 font-semibold shadow-xs' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900' }}">Admin</a>
                </div>

                <!-- Dark Mode Toggle -->
                <button id="theme-toggle" class="p-2 text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                    <span class="material-symbols-outlined text-xl dark:hidden">dark_mode</span>
                    <span class="material-symbols-outlined text-xl hidden dark:block">light_mode</span>
                </button>

                <!-- Notifications -->
                <a href="{{ route('notifications.index') }}" class="p-2 text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition relative">
                    <span class="material-symbols-outlined text-xl">notifications</span>
                    <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-blue-600 rounded-full"></span>
                </a>

                <!-- User Dropdown & Logout -->
                <div class="flex items-center space-x-3 pl-3 border-l border-slate-200 dark:border-slate-700">
                    <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 font-bold flex items-center justify-center text-sm border border-blue-200">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="hidden md:block leading-tight text-xs">
                        <div class="font-semibold text-slate-800 dark:text-slate-100">{{ auth()->user()->name }}</div>
                        <div class="text-slate-500 dark:text-slate-400 capitalize">{{ auth()->user()->role }}</div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" title="Keluar" class="p-1.5 text-slate-400 hover:text-red-600 transition">
                            <span class="material-symbols-outlined text-lg">logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Layout with Sidebar -->
    <div class="flex-1 max-w-[1200px] w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col md:flex-row gap-6">
        
        <!-- Sidebar Navigation -->
        <aside class="w-full md:w-64 shrink-0">
            <nav class="bg-white dark:bg-slate-800 rounded-xl border border-[#D9E0E8] dark:border-slate-700 p-3 space-y-1 shadow-2xs sticky top-22">
                
                <div class="px-3 py-2 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                    Menu Utama
                </div>

                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700/50' }}">
                    <span class="material-symbols-outlined text-xl">dashboard</span>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('careers.show', 'fullstack-web-developer') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('careers.*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700/50' }}">
                    <span class="material-symbols-outlined text-xl">work</span>
                    <span>Target Karier</span>
                </a>

                <a href="{{ route('competency.map') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('competency.map') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700/50' }}">
                    <span class="material-symbols-outlined text-xl">map</span>
                    <span>Peta Kompetensi</span>
                </a>

                <a href="{{ route('assessment.show') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('assessment.*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700/50' }}">
                    <span class="material-symbols-outlined text-xl">quiz</span>
                    <span>Asesmen Mandiri</span>
                </a>

                <a href="{{ route('evidence.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('evidence.*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700/50' }}">
                    <span class="material-symbols-outlined text-xl">folder_special</span>
                    <span>Bukti Kemampuan</span>
                </a>

                <a href="{{ route('skill-gaps') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('skill-gaps') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700/50' }}">
                    <span class="material-symbols-outlined text-xl">insights</span>
                    <span>Analisis Skill Gap</span>
                </a>

                <a href="{{ route('development-plans.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('development-plans.*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700/50' }}">
                    <span class="material-symbols-outlined text-xl">checklist_rtl</span>
                    <span>Rencana Pengembangan</span>
                </a>

                <a href="{{ route('reassessments.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('reassessments.*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700/50' }}">
                    <span class="material-symbols-outlined text-xl">history</span>
                    <span>Penilaian Ulang</span>
                </a>

                <!-- Special Role Section -->
                @if(auth()->user()->isReviewer())
                    <div class="pt-3 pb-1 px-3 text-xs font-semibold text-teal-600 dark:text-teal-400 uppercase tracking-wider">
                        Portal Reviewer
                    </div>
                    <a href="{{ route('reviewer.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium text-teal-700 bg-teal-50 dark:bg-teal-900/30 dark:text-teal-300">
                        <span class="material-symbols-outlined text-xl">fact_check</span>
                        <span>Verifikasi Bukti</span>
                    </a>
                @endif

                @if(auth()->user()->isAdmin())
                    <div class="pt-3 pb-1 px-3 text-xs font-semibold text-purple-600 dark:text-purple-400 uppercase tracking-wider">
                        Manajemen Admin
                    </div>
                    <a href="{{ route('admin.careers') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-50">
                        <span class="material-symbols-outlined text-xl">work_history</span>
                        <span>Data Karier</span>
                    </a>
                    <a href="{{ route('admin.competencies') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-50">
                        <span class="material-symbols-outlined text-xl">menu_book</span>
                        <span>Kurikulum Kompetensi</span>
                    </a>
                @endif

                <div class="pt-3 pb-1 px-3 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                    Informasi & Akun
                </div>

                <a href="{{ route('profile.show') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-50">
                    <span class="material-symbols-outlined text-xl">person</span>
                    <span>Profil Saya</span>
                </a>

                <a href="{{ route('flow') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-50">
                    <span class="material-symbols-outlined text-xl">schema</span>
                    <span>Alur Platform</span>
                </a>

                <a href="{{ route('about') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-50">
                    <span class="material-symbols-outlined text-xl">info</span>
                    <span>Tentang ICL ITATS</span>
                </a>
            </nav>
        </aside>

        <!-- Main Workspace Area -->
        <main class="flex-1 min-w-0">
            <!-- Flash Message Alerts -->
            @if(session('success'))
                <div class="mb-4 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 dark:bg-emerald-900/30 dark:border-emerald-800 dark:text-emerald-200 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">
                        <span class="material-symbols-outlined text-lg">close</span>
                    </button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Script for Dark Mode & Dynamic JS -->
    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        themeToggleBtn.addEventListener('click', function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        });

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    @stack('scripts')
</body>
</html>
