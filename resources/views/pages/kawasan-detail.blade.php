@extends('layouts.app')
@section('title', 'Detail - ' . $aset->nama)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" 
     x-data="{ 
        loading: true, 
        searchQuery: '',
        showGalleryModal: false,
        get filteredFasilitas() {
            if (!this.searchQuery) return this.fasilitasData;
            return this.fasilitasData.filter(f => f.nama.toLowerCase().includes(this.searchQuery.toLowerCase()));
        }
     }" 
     x-init="setTimeout(() => loading = false, 500)">
    
    <!-- ========================================== -->
    <!-- SHIMMER / SKELETON LOADING                 -->
    <!-- ========================================== -->
    <div x-show="loading" class="space-y-6 animate-pulse">
        <div class="h-9 w-44 bg-gray-200 rounded-xl"></div>
        <div class="bg-white rounded-3xl p-6 border border-gray-200 shadow-md h-24"></div>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-5 bg-gray-100 rounded-3xl h-80 border border-gray-200 shadow-md"></div>
            <div class="lg:col-span-7 bg-gray-100 rounded-3xl h-80 border border-gray-200 shadow-md"></div>
        </div>
        <div class="bg-gray-100 rounded-3xl h-36 border border-gray-200 shadow-md"></div>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-6 bg-gray-100 rounded-3xl h-60 border border-gray-200 shadow-md"></div>
            <div class="lg:col-span-6 bg-gray-100 rounded-3xl h-60 border border-gray-200 shadow-md"></div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- KONTEN UTAMA                               -->
    <!-- ========================================== -->
    <div x-cloak x-show="!loading" 
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="space-y-6">
        
        <!-- Tombol Kembali -->
        <div>
            <a href="{{ $aset->kategori_id ? route('aset.index', $aset->kategori_id) : route('kawasan') }}" class="inline-flex items-center gap-2 text-xs font-bold text-gray-600 hover:text-[#14315C] bg-white px-4 py-2.5 rounded-xl border border-gray-200/80 shadow-sm transition-all hover:bg-gray-50">
                &larr; Kembali ke Daftar Aset
            </a>
        </div>

        <!-- 1. JUDUL UTAMA DI ATAS -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-200/80 shadow-md shadow-gray-200/50 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-xs font-bold text-[#C89B3C] uppercase tracking-wider">
                        Kawasan / Aset / {{ $aset->kategori->nama_kategori ?? 'Umum' }}
                    </span>
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase {{ $aset->status_operasional == 'Aktif' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                        {{ $aset->status_operasional }}
                    </span>
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase bg-gray-50 text-gray-600 border border-gray-200">
                        {{ $aset->isOutdoor() ? 'Outdoor' : 'Indoor' }}
                    </span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-[#14315C] tracking-tight">
                    {{ $aset->nama }}
                </h1>
            </div>

            @if($aset->link_bfast)
                <a href="{{ $aset->link_bfast }}" target="_blank" class="px-6 py-3 bg-gradient-to-r from-[#C89B3C] to-[#b08531] hover:from-[#b08531] hover:to-[#966f28] text-white text-xs font-extrabold uppercase tracking-wider rounded-xl shadow-md transition-all flex items-center gap-2 transform hover:-translate-y-0.5">
                    <span>Transaksi via B-Fast</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            @endif
        </div>

        <!-- 2. KARTU CUACA (Jika ada) -->
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
            <div class="bg-gradient-to-r from-[#14315C] to-[#1c4270] rounded-3xl shadow-md p-5 flex items-center justify-between gap-4 text-white border border-blue-900/40">
                <div class="flex items-center gap-4">
                    <svg class="w-8 h-8 text-[#C89B3C] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">{!! $icon !!}</svg>
                    <div>
                        <div class="text-xl font-extrabold">{{ $cuaca['suhu'] }}&deg;C <span class="text-xs font-medium text-blue-100">&middot; {{ $cuaca['label'] }}</span></div>
                        <div class="text-[11px] text-blue-200 mt-0.5">Kondisi cuaca real-time di lokasi kawasan</div>
                    </div>
                </div>
                <div class="text-right hidden sm:block">
                    @if ($cuaca['cocok_kunjungan'])
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-400/20 text-emerald-100 border border-emerald-300/30">Cocok untuk kunjungan</span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-400/20 text-amber-100 border border-amber-300/30">Bawa payung / jas hujan</span>
                    @endif
                </div>
            </div>
        @endif

        <!-- 3. MAP + GALERI FOTO (Dinamis dari Database) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
            
            <!-- Peta GIS (Lebar 5) -->
            <div class="lg:col-span-5 bg-white rounded-3xl p-6 border border-gray-200/80 shadow-md shadow-gray-200/50 flex flex-col justify-between">
                <div class="text-xs font-extrabold text-[#14315C] mb-3 flex items-center justify-between uppercase tracking-wider">
                    <span>Titik Lokasi Peta (GIS)</span>
                    <span class="text-[10px] text-gray-400 font-normal">Google Maps</span>
                </div>
                <div class="w-full flex-grow rounded-2xl overflow-hidden bg-gray-100 border border-gray-200/60 relative min-h-[260px]">
                    @php
                        $lokasiPeta = $aset->koordinat_gis ?: ($aset->alamat_lokasi ?? $aset->nama);
                        if(str_contains($lokasiPeta, 'share.google') || str_contains($lokasiPeta, 'goo.gl/maps')) {
                            $lokasiPeta = $aset->nama . ' ' . $aset->alamat_lokasi;
                        }
                        $mapQuery = urlencode($lokasiPeta);
                    @endphp
                    <iframe width="100%" height="100%" frameborder="0" style="border:0; position: absolute; top:0; left:0; width:100%; height:100%;" src="https://maps.google.com/maps?q={{ $mapQuery }}&t=&z=15&ie=UTF8&iwloc=&output=embed" allowfullscreen></iframe>
                </div>
                <div class="mt-3 text-xs text-gray-600 flex items-center gap-1.5 font-medium">
                    <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                    <span class="truncate">{{ $aset->alamat_lokasi ?? 'Batam, Kepulauan Riau' }}</span>
                </div>
            </div>

            <!-- Galeri Foto & Dokumentasi (Lebar 7 - Dinamis) -->
            @php
                $fotoUtama = $aset->foto ? asset('storage/' . $aset->foto) : null;
                // Ambil hingga 3 foto dokumentasi secara acak untuk tampilan depan
                $galeriAcak = $aset->fotos()->inRandomOrder()->take(2)->get();
                $totalGaleri = $aset->fotos()->count();
            @endphp
            <div class="lg:col-span-7 bg-white rounded-3xl p-6 border border-gray-200/80 shadow-md shadow-gray-200/50 flex flex-col justify-between">
                <div class="text-xs font-extrabold text-[#14315C] mb-4 flex items-center justify-between uppercase tracking-wider">
                    <span>Dokumentasi & Galeri Kawasan</span>
                    @if($totalGaleri > 0)
                        <button @click="showGalleryModal = true" class="text-[11px] font-bold text-[#C89B3C] hover:underline normal-case">
                            Lihat Semua Foto ({{ $totalGaleri }}) &rarr;
                        </button>
                    @endif
                </div>

                <div class="grid grid-cols-3 gap-3 h-72 sm:h-80">
                    <!-- Foto Utama -->
                    <div class="col-span-2 rounded-2xl bg-gradient-to-br from-[#14315C] to-blue-800 overflow-hidden shadow-inner relative flex items-center justify-center text-white font-extrabold text-sm tracking-wide">
                        @if($fotoUtama)
                            <img src="{{ $fotoUtama }}" alt="{{ $aset->nama }}" class="w-full h-full object-cover">
                        @else
                            <div class="absolute inset-0 bg-black/20"></div>
                            <span class="relative z-10 text-center px-4">{{ $aset->nama }} - Utama</span>
                        @endif
                    </div>

                    <!-- Sudut Dokumentasi Acak (Maksimal 2 slot samping) -->
                    <div class="flex flex-col gap-3 h-full">
                        @if($galeriAcak->count() > 0)
                            @foreach($galeriAcak as $idx => $gFoto)
                                <div class="h-1/2 rounded-2xl bg-gray-50 overflow-hidden shadow-2xs flex items-center justify-center border border-gray-200/60 relative">
                                    <img src="{{ asset('storage/' . $gFoto->foto) }}" alt="Dokumentasi" class="w-full h-full object-cover">
                                    @if($idx === 1 && $totalGaleri > 2)
                                        <div @click="showGalleryModal = true" class="absolute inset-0 bg-black/50 backdrop-blur-2xs flex items-center justify-center text-white text-xs font-extrabold cursor-pointer hover:bg-black/60 transition-colors">
                                            +{{ $totalGaleri - 2 }} Foto
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                            <!-- Jika foto dokumentasi kurang dari 2, isi placeholder kosong yang rapi -->
                            @if($galeriAcak->count() == 1)
                                <div class="h-1/2 rounded-2xl bg-gray-50 overflow-hidden shadow-2xs flex items-center justify-center text-gray-400 text-xs font-bold border border-gray-200/60">
                                    Arsip BUPA
                                </div>
                            @endif
                        @else
                            <div class="h-1/2 rounded-2xl bg-gray-50 overflow-hidden shadow-2xs flex items-center justify-center text-gray-400 text-xs font-bold border border-gray-200/60">
                                Sudut 1
                            </div>
                            <div class="h-1/2 rounded-2xl bg-gray-50 overflow-hidden shadow-2xs flex items-center justify-center text-gray-400 text-xs font-bold border border-gray-200/60">
                                Sudut 2
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <!-- MODAL POPUP LIHAT SEMUA FOTO -->
        <div x-cloak x-show="showGalleryModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm p-4">
            <div @click.away="showGalleryModal = false" class="bg-white rounded-3xl max-w-4xl w-full max-h-[85vh] overflow-y-auto p-6 sm:p-8 space-y-6 shadow-2xl">
                <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                    <div>
                        <h3 class="text-lg font-extrabold text-[#14315C]">Galeri Dokumentasi Lengkap</h3>
                        <p class="text-xs text-gray-500 font-medium">Semua arsip foto dokumentasi untuk {{ $aset->nama }}</p>
                    </div>
                    <button @click="showGalleryModal = false" class="w-9 h-9 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 flex items-center justify-center font-bold transition-colors">
                        &times;
                    </button>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @if($fotoUtama)
                        <div class="rounded-2xl overflow-hidden h-48 border border-gray-200/60 relative group">
                            <img src="{{ $fotoUtama }}" class="w-full h-full object-cover">
                            <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/70 to-transparent p-3 text-white text-[11px] font-bold">Foto Utama Aset</div>
                        </div>
                    @endif
                    @foreach($aset->fotos as $allFoto)
                        <div class="rounded-2xl overflow-hidden h-48 border border-gray-200/60 relative group">
                            <img src="{{ asset('storage/' . $allFoto->foto) }}" class="w-full h-full object-cover">
                            <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/70 to-transparent p-3 text-white text-[11px] font-bold">Dokumentasi Lapangan</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- 4. DESKRIPSI KAWASAN -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-200/80 shadow-md shadow-gray-200/50 space-y-3">
            <h3 class="text-xs font-extrabold text-[#14315C] uppercase tracking-wider">Deskripsi Kawasan</h3>
            <p class="text-gray-600 text-xs sm:text-sm leading-relaxed font-medium">
                {{ $aset->deskripsi ?? 'Informasi terperinci mengenai fasilitas, titik lokasi geografis, serta penanggung jawab operasional di kawasan ini.' }}
            </p>
        </div>

        <!-- 5. BAGIAN BAWAH (Jam Operasional & Pengelola) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            
            <!-- KOLOM KIRI: Jam Operasional -->
            <div class="lg:col-span-6 bg-white rounded-3xl p-6 border border-gray-200/80 shadow-md shadow-gray-200/50 space-y-4">
                <h3 class="text-xs font-extrabold text-[#14315C] uppercase tracking-wider">Jam Operasional</h3>
                <div class="bg-slate-50/80 p-4 rounded-2xl border border-gray-200/60 space-y-2 text-xs">
                    @php
                        $jadwal = [
                            'Senin' => $aset->senin ?? '07:00 - 18:00',
                            'Selasa' => $aset->selasa ?? '07:00 - 18:00',
                            'Rabu' => $aset->rabu ?? '07:00 - 18:00',
                            'Kamis' => $aset->kamis ?? '07:00 - 18:00',
                            'Jumat' => $aset->jumat ?? '07:00 - 18:00',
                            'Sabtu' => $aset->sabtu ?? '07:00 - 18:00',
                            'Minggu' => $aset->minggu ?? '07:00 - 18:00',
                        ];
                    @endphp

                    @foreach($jadwal as $hari => $jam)
                        <div class="flex items-center justify-between py-1.5 border-b border-gray-200/60 last:border-b-0">
                            <span class="font-bold text-gray-700">{{ $hari }}</span>
                            <span class="font-extrabold text-[#14315C]">{{ $jam }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- KOLOM KANAN: Kontak & Pengelola -->
            <div class="lg:col-span-6 bg-white rounded-3xl p-6 border border-gray-200/80 shadow-md shadow-gray-200/50 space-y-4">
                <h3 class="text-xs font-extrabold text-[#14315C] uppercase tracking-wider">Kontak & Personil Pengelola</h3>
                
                <div class="space-y-4">
                    @if($aset->kontak_cs)
                        <div class="bg-slate-50/80 p-3.5 rounded-2xl border border-gray-200/60 flex items-center gap-3">
                            <div class="p-2 bg-white rounded-xl shadow-sm text-emerald-600 border border-gray-200 flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div>
                                <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $aset->kontak_cs)) }}" target="_blank" class="text-xs font-extrabold text-[#14315C] hover:underline">
                                    {{ $aset->kontak_cs }}
                                </a>
                                <div class="text-[10px] text-gray-500 font-bold uppercase tracking-wider mt-0.5">Customer Service Resmi</div>
                            </div>
                        </div>
                    @endif

                    <div class="bg-slate-50/80 p-3.5 rounded-2xl border border-gray-200/60">
                        <div class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider mb-1.5">Unit / Personil Pengelola</div>
                        <div class="space-y-1.5">
                            @forelse($pengelola as $p)
                                <div class="text-xs flex items-center justify-between bg-white px-3 py-2 rounded-xl border border-gray-200/60 shadow-2xs">
                                    <span class="font-bold text-gray-800">{{ $p->pegawai->nama ?? 'Pegawai' }}</span>
                                    <span class="text-[9px] {{ ($p->pegawai->asal ?? 'BUPA') == 'BUPA' ? 'bg-blue-50 text-[#14315C] border border-blue-100' : 'bg-amber-50 text-amber-800 border border-amber-100' }} px-2 py-0.5 rounded font-extrabold uppercase tracking-wider">
                                        {{ $p->pegawai->asal ?? 'BUPA' }}
                                    </span>
                                </div>
                            @empty
                                <div class="text-xs font-bold text-gray-600 bg-white px-3 py-2 rounded-xl border border-gray-200/60">
                                    Tim Pengelola Resmi BUPA
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- 6. DAFTAR FASILITAS -->
        <div class="space-y-6 pt-4" x-data="{ 
            fasilitasData: [
                @foreach($aset->fasilitas as $f)
                { nama: '{{ addslashes($f->nama) }}', deskripsi: '{{ addslashes($f->deskripsi ?? "Fasilitas amenitas resmi yang disediakan untuk menunjang aktivitas dan kenyamanan pengunjung di kawasan ini.") }}', foto: '{{ $f->foto ? asset("storage/" . $f->foto) : "" }}' },
                @endforeach
            ]
        }">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-2xl font-extrabold text-[#14315C]">Daftar Fasilitas</h3>
                    <p class="text-xs font-medium text-gray-500 mt-1">Fasilitas pendukung di area {{ $aset->nama }}.</p>
                </div>
                
                <div class="relative w-full sm:w-80">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" x-model="searchQuery" placeholder="Cari fasilitas di sini..." class="block w-full pl-10 pr-4 py-3 bg-white border border-gray-200/80 rounded-xl text-xs text-gray-900 shadow-sm focus:ring-2 focus:ring-[#14315C] focus:border-transparent outline-none transition-all">
                </div>
            </div>

            <div class="space-y-4">
                <template x-for="f in filteredFasilitas" :key="f.nama">
                    <div class="bg-white rounded-3xl p-5 border border-gray-200/80 shadow-md shadow-gray-200/50 hover:shadow-xl transition-all duration-300 flex flex-col sm:flex-row items-center gap-6">
                        <div class="w-full sm:w-36 h-28 rounded-2xl bg-gray-100 overflow-hidden flex-shrink-0 flex items-center justify-center text-gray-400 text-xs font-bold border border-gray-200/60">
                            <template x-if="f.foto">
                                <img :src="f.foto" :alt="f.nama" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!f.foto">
                                <span class="text-center px-2 text-gray-400">Preview</span>
                            </template>
                        </div>
                        <div class="flex-grow text-center sm:text-left">
                            <h4 class="font-extrabold text-[#14315C] text-lg mb-1" x-text="f.nama"></h4>
                            <p class="text-xs text-gray-500 font-medium leading-relaxed max-w-2xl" x-text="f.deskripsi"></p>
                        </div>
                    </div>
                </template>

                <div x-show="filteredFasilitas.length === 0" class="bg-white rounded-3xl p-12 text-center border border-gray-200/80 text-gray-400 text-sm shadow-md shadow-gray-200/50">
                    <p class="font-medium text-gray-600">Pencarian fasilitas tidak ditemukan.</p>
                </div>

                @if($aset->fasilitas->isEmpty())
                    <div class="bg-white rounded-3xl p-12 text-center border border-gray-200/80 text-gray-400 text-sm shadow-md shadow-gray-200/50">
                        <p class="font-medium text-gray-600">Belum ada data fasilitas khusus yang terdaftar pada aset ini.</p>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection