@extends('layouts.app')
@section('title', 'Kawasan & Aset')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 400)">
    
    <!-- SKELETON -->
    <div x-show="loading" class="space-y-6 animate-pulse">
        <div class="h-28 bg-gray-200 rounded-3xl w-full"></div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <div class="h-48 bg-gray-200 rounded-3xl"></div>
            <div class="h-48 bg-gray-200 rounded-3xl"></div>
            <div class="h-48 bg-gray-200 rounded-3xl"></div>
            <div class="h-48 bg-gray-200 rounded-3xl"></div>
        </div>
    </div>

    <!-- KONTEN UTAMA -->
    <div x-cloak x-show="!loading" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
        
        <!-- Header Banner -->
        <div class="bg-[#14315C] rounded-3xl p-8 mb-10 text-white shadow-xl relative overflow-hidden">
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-white opacity-5"></div>
            <h1 class="text-3xl font-extrabold mb-2">Kawasan/Aset</h1>
            <p class="text-blue-100 text-sm max-w-2xl leading-relaxed">
                Telusuri berbagai kawasan dan kategori aset strategis yang dikelola di bawah Badan Usaha Pemanfaatan Aset BP Batam secara terstruktur.
            </p>
        </div>

        <!-- Grid Kategori Card (Mendukung 4 Kolom ala A, B, C, D) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @php
                $colors = ['border-blue-500', 'border-emerald-500', 'border-amber-500', 'border-rose-500', 'border-indigo-500'];
            @endphp
            @foreach ($kategoris as $i => $k)
                @php 
                    $borderColor = $colors[$i % count($colors)]; 
                    $initial = strtoupper(substr($k->nama_kategori, 0, 1));
                @endphp
                <a href="{{ route('aset.index', ['kategori' => $k->id]) }}" class="group bg-white rounded-3xl p-6 border border-gray-100 border-l-8 {{ $borderColor }} shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <!-- Inisial Huruf Besar ala Card Wireframe -->
                        <div class="w-12 h-12 rounded-2xl bg-[#14315C] text-white flex items-center justify-center font-extrabold text-lg mb-4 group-hover:bg-[#C89B3C] transition-colors shadow-md">
                            {{ $initial }}
                        </div>

                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-xl font-bold text-[#14315C] group-hover:text-[#C89B3C] transition-colors">
                                {{ $k->nama_kategori }}
                            </h3>
                        </div>
                        <p class="text-gray-500 text-xs leading-relaxed mb-6 line-clamp-2">
                            {{ $k->deskripsi ?? 'Jelajahi unit aset dan fasilitas di kawasan ' . $k->nama_kategori . '.' }}
                        </p>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                        <span class="text-xs font-semibold bg-blue-50 text-[#14315C] px-3 py-1 rounded-xl border border-blue-100">
                            {{ $k->aset_utama_count ?? 0 }} Aset
                        </span>
                        <span class="text-xs font-semibold text-[#14315C] group-hover:translate-x-1 transition-transform inline-flex items-center gap-1">
                            Buka &rarr;
                        </span>
                    </div>
                </a>
            @endforeach
        </div>

    </div>
</div>
@endsection