@extends('layouts.app')
@section('title', 'Kawasan & Aset')

@section('content')
@php
    $semuaAsetAktif = \App\Models\Aset::where('status_operasional', 'Aktif')->whereNotNull('kategori_id')->get();
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-12" 
     x-data="katalogUtama()" 
     x-init="initGPS()">
    
    <!-- HEADER HALAMAN (Diseragamkan dengan card putih minimalis) -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-200/80 shadow-md shadow-gray-200/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <span class="text-[11px] font-extrabold text-[#C89B3C] uppercase tracking-wider">Direktori BUPA</span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#14315C] tracking-tight mt-0.5">
                Kawasan & Aset
            </h1>
            <p class="text-xs sm:text-sm text-gray-500 font-medium mt-1">
                Telusuri berbagai kawasan dan kategori aset strategis yang dikelola oleh Badan Usaha Pemanfaatan Aset BP Batam.
            </p>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- BAGIAN 1: REKOMENDASI TERDEKAT (GPS)       -->
    <!-- ========================================== -->
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center text-[#C89B3C] shadow-2xs border border-amber-100 flex-shrink-0">
                    <svg class="w-4 h-4 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <div>
                    <h2 class="text-lg font-extrabold text-[#14315C] tracking-tight">Rekomendasi Terdekat</h2>
                    <p class="text-xs font-medium text-gray-500" x-text="statusText"></p>
                </div>
            </div>
            
            <button x-show="status === 'ditolak'" @click="initGPS()" class="text-xs font-bold text-[#14315C] bg-white border border-gray-200/80 hover:bg-gray-50 px-4 py-2 rounded-xl transition-colors shadow-2xs flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                Aktifkan GPS
            </button>
        </div>

        <!-- Skeleton Loading GPS -->
        <div x-show="status === 'mencari'" class="grid grid-cols-1 sm:grid-cols-3 gap-6 animate-pulse">
            <div class="h-60 bg-gray-100 rounded-3xl border border-gray-200/80 shadow-md"></div>
            <div class="h-60 bg-gray-100 rounded-3xl border border-gray-200/80 shadow-md"></div>
            <div class="h-60 bg-gray-100 rounded-3xl border border-gray-200/80 shadow-md"></div>
        </div>

        <!-- Hasil Terdekat / Fallback Acak -->
        <div x-cloak x-show="status === 'ketemu' || status === 'ditolak'" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <template x-for="aset in (status === 'ketemu' ? nearbyAssets : randomAssets)" :key="aset.id">
                <a :href="aset.url" class="group bg-white rounded-3xl p-5 shadow-md shadow-gray-200/50 border border-gray-200/80 hover:shadow-xl hover:border-gray-300 transition-all duration-300 block transform hover:-translate-y-1">
                    
                    <div class="w-full h-40 rounded-2xl bg-gray-100 overflow-hidden relative mb-4 border border-gray-100">
                        <template x-if="aset.foto">
                            <img :src="aset.foto" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        </template>
                        <template x-if="!aset.foto">
                            <div class="w-full h-full bg-gradient-to-br from-[#14315C] to-[#1c4270] flex items-center justify-center text-white text-xs font-bold text-center px-4 leading-relaxed" x-text="aset.nama"></div>
                        </template>
                        
                        <div class="absolute top-3 right-3 bg-white/95 backdrop-blur-md px-3.5 py-1.5 rounded-xl shadow-sm text-xs font-bold text-[#14315C] border border-gray-100">
                            <span x-text="status === 'ketemu' ? (aset.jarak + ' Km') : 'Sorotan'"></span>
                        </div>
                    </div>

                    <h4 class="font-extrabold text-[#14315C] text-base mb-1 group-hover:text-[#C89B3C] transition-colors truncate" x-text="aset.nama"></h4>
                    <div class="text-xs text-gray-500 flex items-center gap-1.5 font-medium">
                        <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                        <span class="truncate" x-text="aset.alamat"></span>
                    </div>
                </a>
            </template>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- BAGIAN 2: DAFTAR KATEGORI ASET             -->
    <!-- ========================================== -->
    <div class="space-y-6 pt-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-[#14315C] shadow-2xs border border-blue-100 flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            </div>
            <h2 class="text-lg font-extrabold text-[#14315C] tracking-tight">Jelajahi Kategori</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($kategoris as $k)
                @php 
                    $initial = strtoupper(substr($k->nama_kategori, 0, 1));
                @endphp
                <a href="{{ route('aset.index', ['kategori' => $k->id]) }}" class="group bg-white rounded-3xl p-6 shadow-md shadow-gray-200/50 border border-gray-200/80 hover:shadow-xl hover:border-gray-300 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
                    
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-gray-50 border border-gray-200/60 text-[#14315C] flex items-center justify-center font-black text-base mb-4 group-hover:bg-[#14315C] group-hover:text-white transition-all duration-300">
                            {{ $initial }}
                        </div>

                        <h3 class="text-base font-extrabold text-[#14315C] group-hover:text-[#C89B3C] transition-colors mb-1.5 tracking-tight">
                            {{ $k->nama_kategori }}
                        </h3>
                        <p class="text-gray-500 text-xs font-medium leading-relaxed mb-6 line-clamp-2">
                            {{ $k->deskripsi ?? 'Jelajahi unit aset dan fasilitas di kategori ' . $k->nama_kategori . '.' }}
                        </p>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <span class="text-[10px] font-extrabold bg-gray-50 text-[#14315C] px-3 py-1 rounded-lg border border-gray-200/60 uppercase tracking-widest">
                            {{ $k->aset_utama_count ?? 0 }} Aset
                        </span>
                        <div class="w-7 h-7 rounded-full bg-gray-50 border border-gray-200/60 flex items-center justify-center text-gray-400 group-hover:bg-[#14315C] group-hover:text-white group-hover:border-transparent transition-colors">
                            <svg class="w-3.5 h-3.5 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

</div>

<!-- SCRIPT GPS HAVERSINE -->
<script>
    function katalogUtama() {
        return {
            status: 'mencari',
            statusText: 'Melacak lokasi GPS Anda...',
            semuaAset: [
                @foreach($semuaAsetAktif as $a)
                @php
                    $lat = $a->latitude ?? 0;
                    $lon = $a->longitude ?? 0;
                    if (!$lat || !$lon) {
                        if (preg_match('/^(-?\d+(\.\d+)?),\s*(-?\d+(\.\d+)?)$/', trim($a->koordinat_gis), $m)) {
                            $lat = (float)$m[1];
                            $lon = (float)$m[3];
                        }
                    }
                @endphp
                {
                    id: {{ $a->id }},
                    nama: '{{ addslashes($a->nama) }}',
                    alamat: '{{ addslashes($a->alamat_lokasi ?? "Batam, Kepulauan Riau") }}',
                    foto: '{{ $a->foto ? asset('storage/'.$a->foto) : "" }}',
                    url: '{{ route("aset.show", $a->id) }}',
                    lat: {{ $lat }},
                    lon: {{ $lon }},
                    jarak: 9999
                },
                @endforeach
            ],
            nearbyAssets: [],
            randomAssets: [],
            
            initGPS() {
                this.status = 'mencari';
                this.statusText = 'Melacak lokasi GPS Anda...';
                
                this.randomAssets = [...this.semuaAset].sort(() => 0.5 - Math.random()).slice(0, 3);

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            let userLat = position.coords.latitude;
                            let userLon = position.coords.longitude;
                            
                            this.semuaAset.forEach(a => {
                                if(a.lat !== 0 && a.lon !== 0) {
                                    a.jarak = this.hitungJarakBumi(userLat, userLon, a.lat, a.lon);
                                }
                            });
                            
                            this.nearbyAssets = [...this.semuaAset]
                                .filter(a => a.jarak !== 9999)
                                .sort((a,b) => parseFloat(a.jarak) - parseFloat(b.jarak))
                                .slice(0, 3);
                                
                            if(this.nearbyAssets.length > 0) {
                                this.status = 'ketemu';
                                this.statusText = 'Berdasarkan jarak aktual dari posisi Anda.';
                            } else {
                                this.status = 'ditolak';
                                this.statusText = 'Belum ada aset dengan koordinat yang valid.';
                            }
                        },
                        (error) => {
                            this.status = 'ditolak';
                            this.statusText = 'Akses lokasi ditolak. Menampilkan aset pilihan.';
                        },
                        { timeout: 7000 }
                    );
                } else {
                    this.status = 'ditolak';
                    this.statusText = 'Browser tidak mendukung fitur GPS.';
                }
            },
            
            hitungJarakBumi(lat1, lon1, lat2, lon2) {
                const R = 6371; 
                const dLat = (lat2 - lat1) * Math.PI / 180;
                const dLon = (lon2 - lon1) * Math.PI / 180;
                const a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                          Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                          Math.sin(dLon/2) * Math.sin(dLon/2);
                const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
                return (R * c).toFixed(1); 
            }
        }
    }
</script>
@endsection