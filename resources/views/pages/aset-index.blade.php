@extends('layouts.app')
@section('title', 'Kawasan - ' . $kategori->nama_kategori)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 400)">
    
    <div x-show="loading" class="space-y-6 animate-pulse">
        <div class="h-40 bg-gray-200 rounded-3xl w-full"></div>
        <div class="space-y-4">
            <div class="h-48 bg-gray-200 rounded-3xl w-full"></div>
            <div class="h-48 bg-gray-200 rounded-3xl w-full"></div>
        </div>
    </div>

    <div x-cloak x-show="!loading" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
        
        <div class="mb-6">
            <a href="{{ route('kawasan') }}" class="inline-flex items-center gap-2 text-xs font-bold text-gray-500 hover:text-[#14315C] bg-white px-4 py-2.5 rounded-xl border border-gray-200/80 shadow-sm transition-all hover:bg-gray-50">
                &larr; Kembali ke Daftar Kategori
            </a>
        </div>

        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-200/80 shadow-md shadow-gray-200/50 mb-8 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-2.5 h-full bg-[#14315C]"></div>
            
            <div class="max-w-3xl pl-3">
                <span class="text-[11px] font-extrabold text-[#C89B3C] uppercase tracking-wider">Kawasan / Aset</span>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-[#14315C] mt-1 mb-2 tracking-tight">
                    Kawasan - {{ $kategori->nama_kategori }}
                </h1>
                <p class="text-gray-500 text-xs sm:text-sm font-medium leading-relaxed">
                    {{ $kategori->deskripsi ?? 'Telusuri berbagai unit kawasan dan fasilitas unggulan yang berada di bawah pengelolaan kategori ini.' }}
                </p>
            </div>

            <div class="w-full lg:w-auto flex flex-col sm:flex-row items-center gap-4 bg-slate-50 p-4 rounded-2xl border border-gray-200/60 shadow-inner">
                <div class="text-right hidden sm:block">
                    <div class="text-xs font-extrabold text-[#14315C]">Penyewaan & Tarif</div>
                    <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mt-0.5">Terintegrasi B-Fast</div>
                </div>
                <a href="{{ $kategori->link_bfast ?? 'https://b-fast.bpbatam.go.id' }}" target="_blank" class="w-full sm:w-auto px-6 py-3 bg-[#14315C] hover:bg-[#0f2546] text-white text-xs font-extrabold rounded-xl shadow-md transition-all duration-300 flex items-center justify-center gap-2 transform hover:-translate-y-0.5">
                    <span>Transaksi via B-Fast</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>

        <form method="GET" action="" class="flex flex-col sm:flex-row gap-3 mb-8">
            <div class="relative flex-grow">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari aset di kawasan ini..." class="block w-full pl-11 pr-4 py-3 bg-white border border-gray-200/80 rounded-xl text-gray-900 shadow-sm focus:ring-2 focus:ring-[#14315C] text-xs font-medium outline-none transition-all">
            </div>
            <button type="submit" class="px-8 py-3 bg-[#14315C] hover:bg-[#0f2546] text-white text-xs font-extrabold uppercase tracking-wider rounded-xl shadow-sm transition-colors">
                Cari Aset
            </button>
        </form>

        <div class="space-y-6">
            @forelse ($asets as $aset)
                <a href="{{ route('aset.show', $aset->id) }}" class="group block bg-white rounded-3xl p-5 sm:p-6 border border-gray-200/80 shadow-md shadow-gray-200/50 hover:shadow-xl hover:border-blue-200 hover:-translate-y-1 transition-all duration-300">
                    <div class="flex flex-col md:flex-row gap-6 items-stretch">
                        
                        <div class="w-full md:w-72 h-48 rounded-2xl bg-gray-100 overflow-hidden flex-shrink-0 relative border border-gray-200/60">
                            @if(!empty($aset->foto))
                                <img src="{{ asset('storage/' . $aset->foto) }}" alt="{{ $aset->nama }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-[#14315C] to-blue-800 flex items-center justify-center text-white font-extrabold text-sm tracking-wide">
                                    {{ $aset->nama }}
                                </div>
                            @endif
                        </div>

                        <div class="flex flex-col justify-between flex-grow py-1">
                            <div>
                                <div class="flex items-start justify-between gap-4 mb-2">
                                    <h3 class="text-xl font-extrabold text-[#14315C] group-hover:text-[#C89B3C] transition-colors leading-tight">
                                        {{ $aset->nama }}
                                    </h3>
                                    
                                    @php
                                        $isAktif = $aset->status_operasional == 'Aktif';
                                    @endphp
                                    <div class="flex items-center gap-1.5 text-[10px] font-extrabold uppercase tracking-wider bg-slate-50 px-2.5 py-1 rounded-lg border border-gray-100 flex-shrink-0">
                                        <span class="w-2 h-2 rounded-full {{ $isAktif ? 'bg-emerald-500 animate-pulse' : 'bg-rose-500' }}"></span>
                                        <span class="{{ $isAktif ? 'text-emerald-700' : 'text-rose-700' }}">
                                            {{ $isAktif ? 'Tersedia' : 'Pemeliharaan' }}
                                        </span>
                                    </div>
                                </div>

                                <p class="text-gray-500 text-xs font-medium leading-relaxed mb-4 line-clamp-2">
                                    {{ $aset->deskripsi ?? 'Fasilitas pendukung di area ' . $aset->nama . ' yang dikelola untuk memberikan layanan maksimal bagi pengunjung dan penyewa.' }}
                                </p>
                            </div>

                            <div class="space-y-2 pt-4 border-t border-gray-100 text-xs font-medium text-gray-500">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span class="truncate">{{ $aset->alamat_lokasi ?? 'Lokasi kawasan di wilayah BP Batam' }}</span>
                                </div>

                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    <span>
                                        Pengelola: 
                                        @php
                                            $pengelolaUtama = \App\Models\AsetPengelola::where('aset_id', $aset->id)->with('pegawai')->first();
                                        @endphp
                                        <strong class="text-gray-700">{{ $pengelolaUtama ? $pengelolaUtama->pegawai->nama : 'Tim Pengelola BUPA' }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                </a>
            @empty
                <div class="bg-white rounded-3xl p-12 text-center border border-gray-200/80 shadow-md shadow-gray-200/50">
                    <div class="text-4xl mb-4">📂</div>
                    <h3 class="text-lg font-extrabold text-[#14315C] mb-1">Belum Ada Aset Terdaftar</h3>
                    <p class="text-xs font-medium text-gray-500">Kawasan ini belum memiliki unit aset atau fasilitas yang diinput ke dalam sistem.</p>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection