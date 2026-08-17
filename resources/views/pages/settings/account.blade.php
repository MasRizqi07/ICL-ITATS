@extends('layouts.app')

@section('title', 'Pengaturan Akun & Keamanan - ICL ITATS')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-line dark:border-slate-700">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Pengaturan Akun & Keamanan</h1>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
            Kelola kata sandi, email institusi, dan proteksi sesi login ICL ITATS.
        </p>
    </div>

    <div class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-slate-200 dark:border-slate-700 space-y-4">
        <h3 class="font-bold text-slate-900 dark:text-white text-sm">Ganti Kata Sandi</h3>
        <div>
            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-1">Kata Sandi Saat Ini</label>
            <input type="password" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-xs" value="••••••••">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-200 mb-1">Kata Sandi Baru</label>
            <input type="password" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg text-xs" placeholder="••••••••">
        </div>
        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg text-xs font-semibold">
            Simpan Kata Sandi Baru
        </button>
    </div>
</div>
@endsection
