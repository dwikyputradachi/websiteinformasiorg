@extends('layouts.app')
@section('title', 'Kawasan - ' . $kategori->nama_kategori)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 400)">
    <div x-show="loading" class="space-y-6 animate-pulse">
        <div class="h-40 bg-gray-200 rounded-3xl w-full"></div>
        <div class="space-y-4">
            <div class="h-40 bg-gray-200 rounded-2xl w-full"></div>
            <div class="h-40 bg-gray-200 rounded-2xl w-full"></div>
        </div>
    </div>

    <div x-cloak x-show="!loading" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
        
        <div class="mb-6">
            <a href="{{ route('kawasan') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-gray-500 hover:text-[#14315C] bg-white px-3.5 py-2 rounded-xl border border-gray-200 shadow-sm transition-colors">
                &larr; Kembali ke Daftar Kategori
            </a>
        </div>

        <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm mb-8 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-2 h-full bg-[#14315C]"></div>
            
            <div class="max-w-3xl pl-2">
                <span class="text-xs font-bold text-[#C89B3C] uppercase tracking-wider">Kawasan / Aset</span>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-[#14315C] mt-1 mb-2">
                    Kawasan/Aset - {{ $kategori->nama_kategori }}
                </h1>
                <p class="text-gray-500 text-sm leading-relaxed">
                    {{ $kategori->deskripsi ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Telusuri unit fasilitas di bawah kategori ini.' }}
                </p>
            </div>

            <div class="w-full lg:w-auto flex flex-col sm:flex-row items-center gap-3 bg-blue-50/50 p-4 rounded-2xl border border-blue-100">
                <div class="text-right hidden sm:block">
                    <div class="text-xs font-bold text-[#14315C]">Penyewaan & Tarif</div>
                    <div class="text-[10px] text-gray-400">Terintegrasi B-Fast</div>
                </div>
                <a href="{{ $kategori->link_bfast ?? 'https://b-fast.bpbatam.go.id' }}" target="_blank" class="w-full sm:w-auto px-6 py-3.5 bg-[#14315C] hover:bg-[#C89B3C] text-white font-bold rounded-xl shadow-md transition-all duration-300 flex items-center justify-center gap-3 text-sm group">
                    <span>Link B-Fast</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>

        <form method="GET" action="" class="flex flex-col sm:flex-row gap-3 mb-8">
            <div class="relative flex-grow">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari Kawasan/Aset..." class="block w-full pl-11 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-900 shadow-sm focus:ring-2 focus:ring-[#14315C] text-sm outline-none">
            </div>
            <button type="submit" class="px-6 py-3 bg-[#14315C] hover:bg-[#0f2546] text-white font-semibold rounded-xl shadow-sm transition-colors text-sm">
                Filter
            </button>
        </form>

        <div class="space-y-6">
            @forelse ($asets as $aset)
                <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col md:flex-row gap-6 items-stretch">
                    
                    <div class="w-full md:w-72 h-48 rounded-2xl bg-gray-100 overflow-hidden flex-shrink-0 relative">
                        @if(!empty($aset->foto))
                            <img src="{{ asset('storage/' . $aset->foto) }}" alt="{{ $aset->nama }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-900 to-blue-700 flex items-center justify-center text-white font-bold text-lg">
                                {{ $aset->nama }}
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-col justify-between flex-grow py-1">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-xl font-extrabold text-[#14315C]">
                                    <a href="{{ route('aset.show', $aset->id) }}" class="hover:text-[#C89B3C] transition-colors">
                                        {{ $aset->nama }}
                                    </a>
                                </h3>
                                
                                @php
                                    $isAktif = $aset->status_operasional == 'Aktif';
                                @endphp
                                <div class="flex items-center gap-1.5 text-xs font-bold">
                                    <span class="w-2 h-2 rounded-full {{ $isAktif ? 'bg-emerald-500 animate-pulse' : 'bg-rose-500' }}"></span>
                                    <span class="{{ $isAktif ? 'text-emerald-600' : 'text-rose-600' }}">
                                        {{ $isAktif ? 'Tersedia' : 'Tidak Tersedia' }}
                                    </span>
                                </div>
                            </div>

                            <p class="text-gray-500 text-xs sm:text-sm leading-relaxed mb-4 line-clamp-2">
                                {{ $aset->deskripsi ?? 'Kawasan dan fasilitas pendukung yang dikelola secara profesional untuk memberikan kenyamanan maksimal bagi pengunjung.' }}
                            </p>
                        </div>

                        <div class="space-y-2 pt-4 border-t border-gray-50 text-xs text-gray-500">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="truncate">{{ $aset->alamat_lokasi ?? 'Lokasi kawasan di wilayah BP Batam' }}</span>
                            </div>

                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                <span class="font-medium text-gray-700">
                                    Pengelola: 
                                    @php
                                        $pengelolaUtama = \App\Models\AsetPengelola::where('aset_id', $aset->id)->with('pegawai')->first();
                                    @endphp
                                    {{ $pengelolaUtama ? $pengelolaUtama->pegawai->nama : 'Tim Pengelola BUPA' }}
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <div class="bg-white rounded-3xl p-12 text-center border border-gray-100 shadow-sm">
                    <div class="text-4xl mb-3">📂</div>
                    <h3 class="text-lg font-bold text-[#14315C] mb-1">Belum Ada Aset</h3>
                    <p class="text-sm text-gray-500">Belum ada data aset yang terdaftar di dalam kategori ini.</p>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection