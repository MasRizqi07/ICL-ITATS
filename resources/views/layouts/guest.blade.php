<!DOCTYPE html>
<html lang="id" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'ICL ITATS - Institutional Career Learning')</title>

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

    <!-- Favicon & Brand Icons -->
    <link rel="icon" type="image/png" href="{{ asset('images/mark.png') }}"/>
    <link rel="shortcut icon" href="{{ asset('images/mark.png') }}" type="image/x-icon"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
</head>
<body class="h-full flex flex-col bg-canvas dark:bg-slate-950 text-ink dark:text-slate-100 transition-colors duration-300 antialiased selection:bg-blue-600 selection:text-white">
    <!-- Navbar -->
    <nav class="bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border-b border-line dark:border-slate-800 sticky top-0 z-50 transition-colors duration-300">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="{{ route('landing') }}" class="flex items-center space-x-2.5 group">
                <img src="{{ asset('images/mark.png') }}" alt="ICL ITATS Mark" class="w-10 h-10 object-contain drop-shadow-xs group-hover:scale-105 transition-transform duration-200">
                <div class="leading-tight">
                    <span class="font-extrabold text-slate-900 dark:text-white text-base tracking-tight block">ICL ITATS</span>
                    <span class="text-xs text-slate-500 dark:text-slate-400 block font-normal">Career Intelligence Platform</span>
                </div>
            </a>

            <div class="hidden md:flex items-center space-x-6 text-xs font-semibold text-slate-600 dark:text-slate-300">
                <a href="{{ route('landing') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Beranda</a>
                <a href="{{ route('flow') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Alur Platform</a>
                <a href="{{ route('about') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Tentang ICL ITATS</a>
                <a href="{{ route('help') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Panduan</a>
                <a href="{{ route('support') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Kontak Support</a>
            </div>

            <div class="flex items-center space-x-3">
                <!-- Dark Mode Toggle Button for Guest Pages -->
                <button id="guest-theme-toggle" type="button" aria-label="Toggle Theme" class="p-2 text-slate-500 hover:text-slate-700 dark:text-slate-300 dark:hover:text-white rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors duration-200 active:scale-95">
                    <span class="material-symbols-outlined text-xl dark:hidden text-slate-700">dark_mode</span>
                    <span class="material-symbols-outlined text-xl hidden dark:block text-amber-400">light_mode</span>
                </button>

                @auth
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-xs transition">
                        Buka Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-xs font-bold text-slate-700 dark:text-slate-200 hover:text-blue-600 transition">
                        Masuk
                    </a>
                    <a href="{{ route('login.quick', 'student') }}" class="px-4 py-2 text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-xs transition">
                        Coba Demo Mahasiswa
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Section -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white dark:bg-slate-900 border-t border-line dark:border-slate-800 py-8 text-center text-xs text-slate-500 dark:text-slate-400 transition-colors duration-300">
        <div class="max-w-[1200px] mx-auto px-4">
            <p>© 2026 ICL ITATS — Gemastik XIX Software Development Competition. Hak Cipta Dilindungi Undang-Undang.</p>
        </div>
    </footer>

    <!-- Theme Toggle Handler -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('guest-theme-toggle');
            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    }
                });
            }
        });
    </script>
</body>
</html>
