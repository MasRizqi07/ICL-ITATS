<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'ICL ITATS - Institutional Career Learning')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
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
                        "line": "#D9E0E8"
                    },
                    fontFamily: {
                        sans: ["Inter", "sans-serif"]
                    }
                }
            }
        }
    </script>
</head>
<body class="h-full flex flex-col bg-[#F8FAFC] text-[#17202A]">
    <!-- Navbar -->
    <nav class="bg-white border-b border-[#D9E0E8] sticky top-0 z-50">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="{{ route('landing') }}" class="flex items-center space-x-2">
                <div class="w-9 h-9 rounded-lg bg-blue-600 flex items-center justify-center text-white font-bold text-lg shadow-sm">
                    ICL
                </div>
                <div class="leading-tight">
                    <span class="font-bold text-slate-900 text-base tracking-tight block">ICL ITATS</span>
                    <span class="text-xs text-slate-500 block font-normal">Career Intelligence Platform</span>
                </div>
            </a>

            <div class="hidden md:flex items-center space-x-6 text-sm font-medium text-slate-600">
                <a href="{{ route('landing') }}" class="hover:text-blue-600 transition">Beranda</a>
                <a href="{{ route('flow') }}" class="hover:text-blue-600 transition">Alur Platform</a>
                <a href="{{ route('about') }}" class="hover:text-blue-600 transition">Tentang ICL ITATS</a>
                <a href="{{ route('help') }}" class="hover:text-blue-600 transition">Panduan</a>
                <a href="{{ route('support') }}" class="hover:text-blue-600 transition">Kontak Support</a>
            </div>

            <div class="flex items-center space-x-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-xs transition">
                        Buka Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-slate-700 hover:text-blue-600 transition">
                        Masuk
                    </a>
                    <a href="{{ route('login.quick', 'student') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-xs transition">
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
    <footer class="bg-white border-t border-[#D9E0E8] py-8 text-center text-xs text-slate-500">
        <div class="max-w-[1200px] mx-auto px-4">
            <p>© 2026 ICL ITATS — Gemastik XIX Software Development Competition. Hak Cipta Dilindungi Undang-Undang.</p>
        </div>
    </footer>
</body>
</html>
