@extends('layouts.app')
@section('title', 'Detail - ' . $aset->nama)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" 
     x-data="{ 
        loading: true, 
        searchQuery: '',
        get filteredFasilitas() {
            if (!this.searchQuery) return this.fasilitasData;
            return this.fasilitasData.filter(f => f.nama.toLowerCase().includes(this.searchQuery.toLowerCase()));
        }
     }" 
     x-init="setTimeout(() => loading = false, 500)">
    
    <div x-show="loading" class="space-y-6">
        <div class="h-10 w-40 bg-gray-200 rounded-xl animate-pulse"></div>
        <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm animate-pulse space-y-4">
            <div class="h-8 bg-gray-200 rounded-lg w-1/3"></div>
            <div class="h-4 bg-gray-200 rounded-lg w-3/4"></div>
            <div class="h-24 bg-gray-100 rounded-2xl w-full"></div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="h-80 bg-gray-200 rounded-3xl animate-pulse"></div>
            <div class="lg:col-span-2 h-80 bg-gray-200 rounded-3xl animate-pulse"></div>
        </div>
    </div>

    <div x-cloak x-show="!loading" 
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="space-y-8">
        
        <div>
            <a href="{{ $aset->kategori_id ? route('aset.index', $aset->kategori_id) : route('kawasan') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-gray-500 hover:text-[#14315C] bg-white px-4 py-2.5 rounded-xl border border-gray-200 shadow-sm transition-all hover:bg-gray-50">
                &larr; Kembali ke Daftar Aset
            </a>
        </div>

        <div class="bg-white rounded-3xl p-8 sm:p-10 border border-gray-100 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 left-0 w-2.5 h-full bg-[#14315C]"></div>
            
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-xs font-bold text-[#C89B3C] uppercase tracking-wider">
                            Kawasan / Aset / {{ $aset->kategori->nama_kategori ?? 'Umum' }}
                        </span>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $aset->status_operasional == 'Aktif' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                            {{ $aset->status_operasional }}
                        </span>
                    </div>
                    <h1 class="text-3xl font-extrabold text-[#14315C] tracking-tight">
                        {{ $aset->nama }}
                    </h1>
                </div>

                @if($aset->link_bfast)
                    <a href="{{ $aset->link_bfast }}" target="_blank" class="px-6 py-3 bg-gradient-to-r from-[#C89B3C] to-[#b08531] hover:from-[#b08531] hover:to-[#966f28] text-white text-xs font-bold rounded-xl shadow-md transition-all flex items-center gap-2 transform hover:-translate-y-0.5">
                        <span>Transaksi via B-Fast</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                @endif
            </div>

            <p class="text-gray-600 text-sm sm:text-base leading-relaxed max-w-4xl mb-8">
                {{ $aset->deskripsi ?? 'Informasi terperinci mengenai fasilitas, titik lokasi geografis, serta penanggung jawab operasional di kawasan ini.' }}
            </p>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 bg-blue-50/40 p-6 rounded-2xl border border-blue-100/60 text-xs sm:text-sm">
                <div class="flex items-start gap-3.5">
                    <div class="p-2.5 bg-white rounded-xl shadow-sm text-amber-500 mt-0.5 border border-amber-100">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <div>
                        <div class="font-bold text-[#14315C]">Alamat Lokasi</div>
                        <div class="text-gray-600 mt-0.5 leading-relaxed">{{ $aset->alamat_lokasi ?? 'Alamat wilayah BP Batam' }}</div>
                    </div>
                </div>

                <div class="flex items-start gap-3.5">
                    <div class="p-2.5 bg-white rounded-xl shadow-sm text-[#14315C] mt-0.5 border border-blue-100">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4"></path></svg>
                    </div>
                    <div>
                        <div class="font-bold text-[#14315C]">Unit / Personil Pengelola</div>
                        <div class="space-y-1.5 mt-1.5">
                            @forelse($pengelola as $p)
                                <div class="text-gray-700 flex items-center justify-between bg-white px-3 py-1.5 rounded-lg border border-gray-100 shadow-2xs">
                                    <span class="font-semibold text-gray-800">{{ $p->pegawai->nama ?? 'Pegawai' }}</span>
                                    <span class="text-[10px] {{ ($p->pegawai->asal ?? 'BUPA') == 'BUPA' ? 'bg-blue-100 text-[#14315C]' : 'bg-amber-100 text-amber-800' }} px-2.5 py-0.5 rounded-md font-bold uppercase tracking-wide">
                                        {{ $p->pegawai->asal ?? 'BUPA' }}
                                    </span>
                                </div>
                            @empty
                                <span class="text-gray-400 italic">Tim Pengelola Resmi BUPA BP Batam</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- KARTU CUACA (cuma muncul kalau kategori outdoor & koordinat sudah diisi) -->
        @if ($cuaca)
            @php
                $iconPaths = [
                    'sun' => '<circle cx="12" cy="12" r="4"></circle><path stroke-linecap="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"></path>',
                    'sun-cloud' => '<path stroke-linecap="round" stroke-linejoin="round" d="M17.5 19a4.5 4.5 0 10-1.44-8.76A6 6 0 006 12.11M9 5V3m5.66 2.34l1.42-1.42M4 12H2"></path><circle cx="9" cy="6" r="2"></circle>',
                    'cloud' => '<path stroke-linecap="round" stroke-linejoin="round" d="M17.5 19a4.5 4.5 0 10-1.44-8.76 6 6 0 10-9.82 6.5"></path>',
                    'rain' => '<path stroke-linecap="round" stroke-linejoin="round" d="M17.5 15a4.5 4.5 0 10-1.44-8.76A6 6 0 105 13.5m3 4v2m4-2v2m4-2v2"></path>',
                    'storm' => '<path stroke-linecap="round" stroke-linejoin="round" d="M17.5 15a4.5 4.5 0 10-1.44-8.76A6 6 0 105 13.5M13 12l-2 4h3l-2 4"></path>',
                ];
                $icon = $iconPaths[$cuaca['icon']] ?? $iconPaths['cloud'];
            @endphp
            <div class="bg-gradient-to-r from-[#14315C] to-[#1c4270] rounded-2xl shadow-sm p-6 flex items-center justify-between gap-4 text-white">
                <div class="flex items-center gap-4">
                    <svg class="w-10 h-10 text-[#C89B3C] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">{!! $icon !!}</svg>
                    <div>
                        <div class="text-2xl font-bold">{{ $cuaca['suhu'] }}&deg;C <span class="text-sm font-normal text-blue-100">&middot; {{ $cuaca['label'] }}</span></div>
                        <div class="text-xs text-blue-200 mt-0.5">Cuaca saat ini di lokasi kawasan</div>
                    </div>
                </div>
                <div class="text-right hidden sm:block">
                    @if ($cuaca['cocok_kunjungan'])
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-400/20 text-emerald-100 border border-emerald-300/30">Cocok untuk kunjungan</span>
                    @else
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-amber-400/20 text-amber-100 border border-amber-300/30">Bawa payung / jaket hujan</span>
                    @endif
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="bg-white rounded-3xl p-5 border border-gray-100 shadow-sm flex flex-col h-80 lg:h-auto overflow-hidden">
                <div class="text-xs font-bold text-[#14315C] mb-3 px-1 flex items-center justify-between">
                    <span> Titik Lokasi Peta (GIS)</span>
                    <span class="text-[10px] text-gray-400">Google Maps</span>
                </div>
                <div class="flex-grow rounded-2xl overflow-hidden bg-gray-100 border border-gray-100 relative min-h-[250px]">
                    @php
                        $lokasiPeta = $aset->koordinat_gis ?: ($aset->alamat_lokasi ?? $aset->nama);
                        
                        if(str_contains($lokasiPeta, 'share.google') || str_contains($lokasiPeta, 'goo.gl/maps')) {
                            $lokasiPeta = $aset->nama . ' ' . $aset->alamat_lokasi;
                        }

                        $mapQuery = urlencode($lokasiPeta);
                    @endphp
                    <iframe width="100%" height="100%" frameborder="0" style="border:0;" src="https://maps.google.com/maps?q={{ $mapQuery }}&t=&z=15&ie=UTF8&iwloc=&output=embed" allowfullscreen></iframe>
                </div>
            </div>

            <div class="lg:col-span-2 bg-white rounded-3xl p-6 border border-gray-100 shadow-sm flex flex-col justify-between">
                <div class="text-xs font-bold text-[#14315C] mb-4 flex items-center justify-between">
                    <span>Dokumentasi & Galeri Kawasan</span>
                </div>

                <div class="grid grid-cols-3 gap-3 h-64 sm:h-72">
                    <div class="col-span-2 rounded-2xl bg-gradient-to-br from-blue-900 to-blue-700 overflow-hidden shadow-inner relative flex items-center justify-center text-white font-bold text-sm tracking-wide">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <span class="relative z-10">{{ $aset->nama }} - Utama</span>
                    </div>
                    <div class="flex flex-col gap-3">
                        <div class="h-1/2 rounded-2xl bg-gray-100 overflow-hidden shadow-inner flex items-center justify-center text-gray-400 text-xs font-medium border border-gray-100">
                            Sudut Kawasan 1
                        </div>
                        <div class="h-1/2 rounded-2xl bg-gray-100 overflow-hidden shadow-inner flex items-center justify-center text-gray-400 text-xs font-medium border border-gray-100">
                            Sudut Kawasan 2
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="space-y-6 pt-4" x-data="{ 
            fasilitasData: [
                @foreach($aset->fasilitas as $f)
                { nama: '{{ addslashes($f->nama) }}', deskripsi: '{{ addslashes($f->deskripsi ?? "Fasilitas amenitas resmi yang disediakan untuk menunjang aktivitas dan kenyamanan pengunjung di kawasan ini.") }}', foto: '{{ $f->foto ? asset("storage/" . $f->foto) : "" }}' },
                @endforeach
            ]
        }">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-2xl font-bold text-[#14315C]">Daftar Fasilitas & Amenitas</h3>
                    <p class="text-xs text-gray-500 mt-1">Fasilitas pendukung di area {{ $aset->nama }}.</p>
                </div>
                
                <div class="relative w-full sm:w-80">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" x-model="searchQuery" placeholder="Cari fasilitas di sini..." class="block w-full pl-10 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-xs text-gray-900 shadow-sm focus:ring-2 focus:ring-[#14315C] focus:border-transparent outline-none transition-all">
                </div>
            </div>

            <div class="space-y-4">
                <template x-for="f in filteredFasilitas" :key="f.nama">
                    <div class="bg-white rounded-3xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col sm:flex-row items-center gap-6">
                        
                        <div class="w-full sm:w-36 h-28 rounded-2xl bg-gray-100 overflow-hidden flex-shrink-0 flex items-center justify-center text-gray-400 text-xs font-bold border border-gray-100">
                            <template x-if="f.foto">
                                <img :src="f.foto" :alt="f.nama" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!f.foto">
                                <span class="text-center px-2 text-gray-400">Preview</span>
                            </template>
                        </div>

                        <div class="flex-grow text-center sm:text-left">
                            <h4 class="font-extrabold text-[#14315C] text-lg mb-1" x-text="f.nama"></h4>
                            <p class="text-xs text-gray-500 leading-relaxed max-w-2xl" x-text="f.deskripsi"></p>
                        </div>
                    </div>
                </template>

                <div x-show="filteredFasilitas.length === 0" class="bg-white rounded-3xl p-12 text-center border border-gray-100 text-gray-400 text-sm shadow-sm">
                    <div class="text-3xl mb-2">🔍</div>
                    <p class="font-medium text-gray-600">Pencarian fasilitas tidak ditemukan.</p>
                    <p class="text-xs text-gray-400 mt-1">Coba kata kunci nama fasilitas yang lain.</p>
                </div>

                @if($aset->fasilitas->isEmpty())
                    <div class="bg-white rounded-3xl p-12 text-center border border-gray-100 text-gray-400 text-sm shadow-sm">
                        <div class="text-3xl mb-2">📂</div>
                        <p class="font-medium text-gray-600">Belum ada data fasilitas khusus yang terdaftar pada aset ini.</p>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection