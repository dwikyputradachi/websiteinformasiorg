@extends('layouts.app')
@section('title', $aset->nama)

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Breadcrumb Dinamis -->
    <nav class="flex text-sm text-gray-500 mb-8 overflow-x-auto pb-2" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rounded-lg bg-white px-4 py-2 shadow-sm border border-gray-100 whitespace-nowrap">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="inline-flex items-center hover:text-[#14315C] transition-colors">
                    Beranda
                </a>
            </li>
            @if ($aset->kategori)
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <a href="{{ route('aset.index', ['kategori' => $aset->kategori->id]) }}" class="hover:text-[#14315C] transition-colors">{{ $aset->kategori->nama_kategori }}</a>
                    </div>
                </li>
            @endif
            @if ($aset->parent)
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <a href="{{ route('aset.show', $aset->parent) }}" class="hover:text-[#14315C] transition-colors">{{ $aset->parent->nama }}</a>
                    </div>
                </li>
            @endif
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <span class="font-medium text-gray-800">{{ $aset->nama }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- KARTU HERO ASET -->
    @php
        $statusFormatted = str_replace(' ', '', $aset->status_operasional);
        $statusClasses = match($statusFormatted) {
            'Aktif' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'Renovasi' => 'bg-amber-50 text-amber-700 border-amber-200',
            'TidakAktif' => 'bg-rose-50 text-rose-700 border-rose-200',
            default => 'bg-gray-50 text-gray-700 border-gray-200'
        };
    @endphp

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-10">
        <div class="p-8 sm:p-10">
            <div class="flex flex-col md:flex-row justify-between gap-8">
                <!-- Info Utama -->
                <div class="flex-grow">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold border {{ $statusClasses }} mb-4 uppercase tracking-wider">
                        Status: {{ $aset->status_operasional }}
                    </span>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-[#14315C] mb-4">{{ $aset->nama }}</h1>
                    <p class="text-gray-600 text-base leading-relaxed mb-6">
                        {{ $aset->deskripsi }}
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 sm:gap-8 text-sm text-gray-600">
                        <div class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-[#C89B3C] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span>{{ $aset->alamat_lokasi }}</span>
                        </div>
                        @if ($aset->koordinat_gis)
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                                <a href="{{ $aset->koordinat_gis }}" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium hover:underline">
                                    Buka Peta Lokasi
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Tombol B-Fast -->
                @if ($aset->link_bfast)
                    <div class="md:w-64 flex-shrink-0 md:border-l md:border-gray-100 md:pl-8 flex flex-col justify-center">
                        <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 text-center">
                            <p class="text-xs text-gray-500 mb-3 font-medium uppercase tracking-wide">Penyewaan & Tarif</p>
                            <a href="{{ $aset->link_bfast }}" target="_blank" class="flex flex-col items-center gap-2 w-full bg-[#14315C] text-white px-4 py-3 rounded-lg hover:bg-[#0c203d] transition-colors shadow-sm font-medium text-sm group">
                                Cek di B-Fast
                                <svg class="w-4 h-4 text-[#C89B3C] group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- SUB-UNIT / KIOS (Jika Ada) -->
    @if ($aset->children->count())
        <div class="mb-10">
            <h2 class="text-xl font-bold text-[#14315C] mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#C89B3C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Sub-Unit / Kios / Gerai
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($aset->children as $c)
                    <a href="{{ route('aset.show', $c) }}" class="block bg-white border border-gray-100 rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-bold text-gray-900">{{ $c->nama }}</h3>
                            <span class="text-[10px] uppercase font-bold text-gray-500 bg-gray-100 px-2 py-0.5 rounded">{{ $c->status_operasional }}</span>
                        </div>
                        <p class="text-xs text-gray-500 line-clamp-2 mb-3">{{ $c->deskripsi }}</p>
                        <div class="text-xs font-medium text-[#14315C]">{{ $c->fasilitas_count }} fasilitas</div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- GRID 2 KOLOM (Fasilitas & Pengelola) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        <!-- FASILITAS -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden h-fit">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                <h3 class="font-bold text-[#14315C]">Fasilitas Tersedia</h3>
                <span class="bg-[#14315C] text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $aset->fasilitas->count() }}</span>
            </div>
            <ul class="divide-y divide-gray-50">
                @forelse ($aset->fasilitas as $f)
                    <li class="px-6 py-4 flex justify-between items-center hover:bg-gray-50/50 transition-colors">
                        <span class="font-medium text-gray-800 text-sm">{{ $f->nama }}</span>
                        <span class="text-xs text-gray-500 bg-gray-100 px-2.5 py-1 rounded-md">{{ $f->deskripsi }}</span>
                    </li>
                @empty
                    <li class="px-6 py-8 text-center text-gray-400 text-sm italic">
                        Belum ada fasilitas terdaftar.
                    </li>
                @endforelse
            </ul>
        </div>

        <!-- PENGELOLA -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden h-fit">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                <h3 class="font-bold text-[#14315C]">Unit / Personil Pengelola</h3>
                <span class="bg-[#C89B3C] text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $pengelola->count() }}</span>
            </div>
            <ul class="divide-y divide-gray-50">
                @forelse ($pengelola as $p)
                    <li class="px-6 py-4 hover:bg-gray-50/50 transition-colors">
                        <div class="flex items-center justify-between mb-1">
                            <a href="{{ route('pegawai.show', $p->pegawai) }}" class="font-semibold text-gray-800 hover:text-[#14315C] transition-colors text-sm">
                                {{ $p->pegawai->nama }}
                            </a>
                            @if ($p->pegawai->asal === 'Eksternal')
                                <span class="text-[10px] font-bold text-amber-600 bg-amber-50 px-2 py-0.5 rounded border border-amber-200">EKSTERNAL</span>
                            @endif
                        </div>
                        <div class="flex items-center text-xs text-gray-500 gap-2 mt-1.5">
                            <span class="bg-[#14315C]/5 text-[#14315C] font-medium px-2 py-0.5 rounded">{{ $p->bagian->nama_bagian ?? 'Pengelola' }}</span>
                            @if($p->keterangan) 
                                <span class="text-gray-400">&bull;</span> {{ $p->keterangan }} 
                            @endif
                        </div>
                    </li>
                @empty
                    <li class="px-6 py-8 text-center text-gray-400 text-sm italic">
                        Belum ada pengelola tercatat.
                    </li>
                @endforelse
            </ul>
        </div>

    </div>
</div>
@endsection