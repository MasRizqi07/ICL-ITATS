@extends('layouts.guest')

@section('title', 'Login - ICL ITATS Career Intelligence')

@section('content')
<div class="min-h-[calc(100vh-8rem)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-2xl border border-[#D9E0E8] shadow-sm">
        
        <div class="text-center">
            <div class="mx-auto w-12 h-12 rounded-xl bg-blue-600 flex items-center justify-center text-white font-bold text-xl mb-3 shadow-md">
                ICL
            </div>
            <h2 class="text-2xl font-bold text-[#17202A] tracking-tight">Masuk ke ICL ITATS</h2>
            <p class="mt-1 text-xs text-slate-500">Platform Kecerdasan Karier Mahasiswa ITATS</p>
        </div>

        @if($errors->any())
            <div class="p-3 bg-red-50 border border-red-200 text-red-700 text-xs rounded-lg">
                {{ $errors->first() }}
            </div>
        @endif

        <form class="mt-8 space-y-4" action="{{ route('login.post') }}" method="POST">
            @csrf
            <div>
                <label for="email" class="block text-xs font-semibold text-slate-700 mb-1">Email Institusi</label>
                <input id="email" name="email" type="email" required value="{{ old('email', 'student@itats.ac.id') }}" 
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-hidden" 
                    placeholder="nama@itats.ac.id">
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold text-slate-700 mb-1">Kata Sandi</label>
                <input id="password" name="password" type="password" required value="password" 
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-hidden" 
                    placeholder="••••••••">
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center text-slate-600">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 mr-2">
                    Ingat saya di perangkat ini
                </label>
                <a href="#" class="text-blue-600 hover:underline">Lupa kata sandi?</a>
            </div>

            <button type="submit" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-lg shadow-sm transition">
                Masuk Ke Akun
            </button>
        </form>

        <div class="pt-4 border-t border-slate-200">
            <p class="text-xs font-semibold text-slate-500 mb-2 text-center">Login Instan untuk Demo Gemastik:</p>
            <div class="grid grid-cols-3 gap-2 text-xs">
                <a href="{{ route('login.quick', 'student') }}" class="py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg font-medium text-center transition">
                    Mahasiswa
                </a>
                <a href="{{ route('login.quick', 'reviewer') }}" class="py-2 bg-teal-50 hover:bg-teal-100 text-teal-700 rounded-lg font-medium text-center transition">
                    Reviewer
                </a>
                <a href="{{ route('login.quick', 'admin') }}" class="py-2 bg-purple-50 hover:bg-purple-100 text-purple-700 rounded-lg font-medium text-center transition">
                    Admin
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
