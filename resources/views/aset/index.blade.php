@extends('layouts.app')
@section('title', $kategori->nama_kategori)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Breadcrumb -->
    <nav class="flex text-sm text-gray-500 mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rounded-lg bg-white px-4 py-2 shadow-sm border border-gray-100">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="inline-flex items-center hover:text-[#14315C] transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Beranda
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <span class="ml-1 font-medium text-gray-800">{{ $kategori->nama_kategori }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header & Pencarian -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-[#14315C] tracking-tight">Kawasan/Aset</h1>
            <p class="text-sm text-gray-500 mt-2">Menampilkan semua aset di bawah kategori <span class="font-semibold">{{ $kategori->nama_kategori }}</span>.</p>
        </div>
        
        <form method="GET" action="{{ route('aset.index', ['kategori' => $kategori->id]) }}" class="flex w-full md:w-auto gap-2">
            <div class="relative flex-grow md:w-64">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama kawasan..." class="block w-full pl-9 pr-3 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:ring-[#C89B3C] focus:border-[#C89B3C] shadow-sm transition-colors">
            </div>
            <button type="submit" class="px-4 py-2 bg-[#14315C] text-white text-sm font-medium rounded-lg hover:bg-[#0c203d] transition-colors shadow-sm">
                Cari
            </button>
        </form>
    </div>

    <!-- Grid Aset -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($asets as $a)
            @php
                $statusFormatted = str_replace(' ', '', $a->status_operasional);
                $statusClasses = match($statusFormatted) {
                    'Aktif' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                    'Renovasi' => 'bg-amber-50 text-amber-700 border-amber-200',
                    'TidakAktif' => 'bg-rose-50 text-rose-700 border-rose-200',
                    default => 'bg-gray-50 text-gray-700 border-gray-200'
                };
            @endphp
            
            <a href="{{ route('aset.show', $a) }}" class="group flex flex-col bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-gray-300 transition-all duration-300 overflow-hidden">
                <div class="p-6 flex-grow">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold border {{ $statusClasses }} mb-3 uppercase tracking-wider">
                        {{ $a->status_operasional }}
                    </span>
                    <h3 class="text-lg font-bold text-[#14315C] mb-2 group-hover:text-[#C89B3C] transition-colors line-clamp-1">
                        {{ $a->nama }}
                    </h3>
                    <p class="text-sm text-gray-500 line-clamp-2 mb-4">
                        {{ $a->deskripsi }}
                    </p>
                </div>
                
                <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-50 flex flex-col gap-2">
                    <div class="flex items-center text-xs text-gray-500 gap-2 truncate">
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="truncate">{{ $a->alamat_lokasi }}</span>
                    </div>
                    <div class="flex items-center text-xs text-gray-500 gap-2">
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                        <span>{{ $a->fasilitas_count }} fasilitas</span>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full bg-white rounded-2xl border border-gray-100 p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada aset ditemukan</h3>
                <p class="mt-1 text-sm text-gray-500">Coba sesuaikan kata kunci pencarian Anda.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection