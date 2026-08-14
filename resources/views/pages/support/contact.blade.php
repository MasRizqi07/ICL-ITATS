@extends('layouts.guest')

@section('title', 'Kontak Dukungan - ICL ITATS')

@section('content')
<div class="max-w-xl mx-auto px-4 py-12 space-y-6">
    <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-2xs space-y-4">
        <h1 class="text-2xl font-bold text-slate-900">Kontak Dukungan Tim ICL ITATS</h1>
        <p class="text-xs text-slate-600">Ada kendala teknis atau pertanyaan seputar partisipasi Gemastik? Hubungi kami via form berikut:</p>

        <form class="space-y-4" onsubmit="event.preventDefault(); alert('Pesan dukungan berhasil dikirim!');">
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                <input type="text" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-xs" placeholder="Nama Anda">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Email</label>
                <input type="email" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-xs" placeholder="email@itats.ac.id">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Pesan</label>
                <textarea rows="4" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-xs" placeholder="Tuliskan kendala Anda..."></textarea>
            </div>
            <button type="submit" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-lg shadow-2xs transition">
                Kirim Pesan Dukungan
            </button>
        </form>
    </div>
</div>
@endsection
