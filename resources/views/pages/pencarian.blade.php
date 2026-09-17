@extends('layouts.app')
@section('title', 'Pencarian')

@section('content')

<div class="mb-8">
    <h1 class="text-2xl font-bold text-[#14315C]">Hasil pencarian</h1>
    <p class="text-sm text-gray-500 mt-1">Menampilkan hasil untuk <span class="font-semibold text-gray-700">"{{ $q }}"</span></p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse ($pegawais as $p)
        <a href="{{ route('pegawai.show', $p) }}" class="group flex items-center gap-4 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-gray-200 transition-all p-5">
            <div class="w-12 h-12 rounded-full bg-[#EAF0FA] text-[#14315C] flex items-center justify-center font-bold flex-shrink-0 overflow-hidden">
                @if ($p->foto)
                    <img src="{{ asset('storage/' . $p->foto) }}" class="w-full h-full object-cover" alt="{{ $p->nama }}">
                @else
                    {{ strtoupper(collect(explode(' ', $p->nama))->take(2)->map(fn($w)=>$w[0])->implode('')) }}
                @endif
            </div>
            <div class="min-w-0">
                <div class="font-semibold text-gray-800 group-hover:text-[#14315C] transition-colors truncate">{{ $p->nama }}</div>
                <div class="text-xs text-gray-500 truncate">{{ $p->jabatan->nama_jabatan }}</div>
            </div>
        </a>
    @empty
        <div class="col-span-full bg-white rounded-2xl border border-gray-100 p-12 text-center">
            <svg class="mx-auto h-10 w-10 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <h3 class="text-sm font-medium text-gray-900">Tidak ada hasil ditemukan</h3>
            <p class="mt-1 text-sm text-gray-500">Coba kata kunci lain, atau lihat langsung <a href="{{ route('struktur') }}" class="text-[#14315C] hover:underline">struktur organisasi</a>.</p>
        </div>
    @endforelse
</div>

@endsection
