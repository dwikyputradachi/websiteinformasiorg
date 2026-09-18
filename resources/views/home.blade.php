@extends('layouts.app')
@section('title', 'Beranda')

@section('content')
@php
    $displayBanners = (isset($banners) && count($banners) > 0) ? $banners : collect([
        (object)[
            'judul' => 'Informasi Kawasan & Organisasi BUPA', 
            'deskripsi' => 'Telusuri kawasan/aset berdasarkan kategori, fasilitas, dan pengelola secara resmi.', 
            'foto' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1200&auto=format&fit=crop'
        ]
    ]);
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 400)">
    
    <div x-show="loading" class="space-y-6 animate-pulse">
        <div class="h-[420px] bg-gray-200 rounded-[2.5rem] w-full"></div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 pt-4">
            <div class="h-48 bg-gray-200 rounded-3xl"></div>
            <div class="h-48 bg-gray-200 rounded-3xl"></div>
            <div class="h-48 bg-gray-200 rounded-3xl"></div>
        </div>
    </div>

    <div x-cloak x-show="!loading" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
        
        <div x-data="{ 
                activeSlide: 0, 
                totalSlides: {{ count($displayBanners) }},
                timer: null,
                next() { this.activeSlide = (this.activeSlide + 1) % this.totalSlides; },
                startTimer() { this.timer = setInterval(() => this.next(), 6000); },
                stopTimer() { clearInterval(this.timer); }
             }" 
             x-init="startTimer()"
             @mouseenter="stopTimer()"
             @mouseleave="startTimer()"
             class="relative w-full h-[480px] lg:h-[420px] rounded-[2.5rem] overflow-hidden shadow-2xl shadow-blue-900/10 mb-16 bg-[#14315C] group">
            
            <div class="flex h-full w-full transition-transform duration-1000 ease-[cubic-bezier(0.25,1,0.5,1)]" :style="`transform: translateX(-${activeSlide * 100}%)`">
                
                @foreach($displayBanners as $banner)
                    @php
                        $imageUrl = filter_var($banner->foto, FILTER_VALIDATE_URL) ? $banner->foto : asset('storage/' . $banner->foto);
                    @endphp
                    <div class="w-full flex-shrink-0 h-full flex flex-col lg:flex-row relative">
                        
                        <div class="absolute inset-0 lg:left-1/3 lg:w-2/3 h-full">
                            <img src="{{ $imageUrl }}" alt="{{ $banner->judul }}" class="w-full h-full object-cover mix-blend-luminosity opacity-60">
                            <div class="absolute inset-0 bg-gradient-to-t lg:bg-gradient-to-r from-[#14315C] via-[#14315C]/95 lg:via-[#14315C]/80 to-transparent"></div>
                        </div>

                        <div class="relative z-10 w-full lg:w-[60%] flex flex-col justify-center px-8 sm:px-14 py-10 h-full">
                            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white mb-5 tracking-tight leading-tight drop-shadow-lg">
                                {{ $banner->judul }}
                            </h1>
                            <p class="text-blue-100/90 text-sm sm:text-base mb-10 leading-relaxed max-w-lg font-light">
                                {{ $banner->deskripsi }} Untuk transaksi layanan, kunjungi <a href="https://b-fast.bpbatam.go.id/" target="_blank" class="font-bold text-[#C89B3C] hover:text-white transition-colors underline decoration-dotted underline-offset-4">B-Fast</a>.
                            </p>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="absolute z-20 bottom-8 left-8 sm:left-14 w-[calc(100%-4rem)] lg:w-[45%]">
                <form method="GET" action="{{ route('cari') }}" class="flex flex-col sm:flex-row gap-3 p-2.5 bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20 shadow-2xl transition-all hover:bg-white/15">
                    <div class="relative flex-grow">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="q" placeholder="Cari Kawasan, Aset, Pegawai..." class="block w-full pl-12 pr-4 py-3.5 bg-transparent border-none rounded-xl text-white placeholder-white/70 text-sm outline-none focus:ring-0 focus:bg-white/5 transition-colors">
                    </div>
                    <button type="submit" class="px-8 py-3.5 bg-gradient-to-r from-[#C89B3C] to-[#b08531] hover:from-[#b08531] hover:to-[#966f28] text-white font-bold rounded-xl shadow-lg transition-all duration-300 text-sm whitespace-nowrap transform hover:-translate-y-0.5">
                        Cari Data
                    </button>
                </form>
            </div>

            @if(count($displayBanners) > 1)
                <div class="absolute bottom-8 right-10 z-20 flex items-center gap-2.5">
                    <template x-for="i in totalSlides" :key="i">
                        <button @click="activeSlide = i - 1" 
                                :class="activeSlide === i - 1 ? 'w-10 bg-[#C89B3C]' : 'w-2.5 bg-white/30 hover:bg-white/60'"
                                class="h-2.5 rounded-full transition-all duration-500 ease-out shadow-sm"></button>
                    </template>
                </div>
            @endif
        </div>

        <div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-gray-100 pb-5">
            <div>
                <h2 class="text-3xl font-extrabold text-[#14315C] tracking-tight">Kategori Kawasan & Aset</h2>
                <p class="text-sm text-gray-500 mt-1.5">Jelajahi berbagai kategori unit aset strategis yang dikelola BUPA.</p>
            </div>
            <a href="{{ route('kawasan') }}" class="text-sm font-bold text-[#C89B3C] hover:text-[#14315C] transition-colors hidden sm:inline-flex items-center gap-1">
                Lihat Semua Aset <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach ($kategoris as $k)
                <a href="{{ route('aset.index', ['kategori' => $k->id]) }}" class="group block bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-2xl hover:shadow-blue-900/5 transition-all duration-500 flex flex-col justify-between relative overflow-hidden transform hover:-translate-y-1.5">
                    <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-[#14315C] to-[#14315C]/80 group-hover:from-[#C89B3C] group-hover:to-[#b08531] transition-all duration-500"></div>
                    
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <h3 class="text-2xl font-extrabold text-[#14315C] group-hover:text-[#C89B3C] transition-colors duration-300 tracking-tight">
                                {{ $k->nama_kategori }}
                            </h3>
                            <div class="w-12 h-12 rounded-2xl bg-blue-50/80 group-hover:bg-[#C89B3C]/10 text-[#14315C] group-hover:text-[#C89B3C] flex items-center justify-center transition-colors duration-300">
                                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                            </div>
                        </div>
                        
                        <p class="text-gray-500 text-sm mb-8 line-clamp-2 leading-relaxed">
                            {{ $k->deskripsi ?? 'Lihat daftar aset, fasilitas, dan detail pengelola di bawah kategori ' . $k->nama_kategori }}
                        </p>
                    </div>
                    
                    <div class="inline-flex items-center gap-2 px-3.5 py-2 bg-gray-50 group-hover:bg-blue-50/70 text-[#14315C] rounded-xl text-xs font-bold w-fit border border-gray-100 group-hover:border-blue-100/50 transition-colors duration-300">
                        <svg class="w-4 h-4 text-[#C89B3C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <span>{{ $k->aset_utama_count ?? 0 }} Unit Aset Resmi</span>
                    </div>
                </a>
            @endforeach
        </div>

    </div>
</div>
@endsection