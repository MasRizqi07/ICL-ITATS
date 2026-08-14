@extends('layouts.app')

@section('title', 'Profil Saya - ICL ITATS')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-[#D9E0E8] dark:border-slate-700 flex items-center space-x-4">
        <div class="w-16 h-16 rounded-full bg-blue-600 text-white font-bold text-2xl flex items-center justify-center shadow-md">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $user->name }}</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                {{ $user->email }} • Peran: <span class="capitalize font-semibold text-blue-600 dark:text-blue-400">{{ $user->role }}</span>
            </p>
        </div>
    </div>

    <!-- Edit Profile Form -->
    <form action="{{ route('profile.update') }}" method="POST" class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-slate-200 dark:border-slate-700 space-y-4">
        @csrf

        <div>
            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-1">Nama Lengkap *</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-xs">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-1">Program Studi</label>
                <input type="text" name="program" value="{{ old('program', $user->program) }}" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-xs">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-1">Semester</label>
                <input type="number" name="semester" value="{{ old('semester', $user->semester) }}" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-xs">
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-1">Bio & Ringkasan Pengalaman</label>
            <textarea name="bio" rows="3" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-xs">{{ old('bio', $user->bio) }}</textarea>
        </div>

        <div class="flex items-center justify-end pt-3">
            <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-lg shadow-xs transition">
                Simpan Perubahan Profil
            </button>
        </div>
    </form>

</div>
@endsection
