@extends('layouts.app')
@section('title', 'Pencarian - ' . $q)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-8" x-data="{ tab: 'semua' }">

    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <span class="text-[11px] font-bold text-[#C89B3C] uppercase tracking-wider">Pencarian Sistem</span>
            <h1 class="text-xl sm:text-2xl font-bold text-[#14315C] tracking-tight mt-0.5">
                Hasil untuk "{{ $q }}"
            </h1>
            <p class="text-xs text-gray-500 mt-0.5">
                Ditemukan <span class="font-semibold text-gray-700">{{ $asets->count() + $pegawais->count() }}</span> entri yang relevan di BUPA Info.
            </p>
        </div>

        <div class="flex items-center gap-1.5 bg-gray-50 p-1 rounded-xl border border-gray-200/60">
            <button @click="tab = 'semua'" :class="tab === 'semua' ? 'bg-[#14315C] text-white shadow-2xs' : 'text-gray-600 hover:text-[#14315C]'" class="px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-all">
                Semua ({{ $asets->count() + $pegawais->count() }})
            </button>
            <button @click="tab = 'aset'" :class="tab === 'aset' ? 'bg-[#14315C] text-white shadow-2xs' : 'text-gray-600 hover:text-[#14315C]'" class="px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-all">
                Aset ({{ $asets->count() }})
            </button>
            <button @click="tab = 'pegawai'" :class="tab === 'pegawai' ? 'bg-[#14315C] text-white shadow-2xs' : 'text-gray-600 hover:text-[#14315C]'" class="px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-all">
                Pegawai ({{ $pegawais->count() }})
            </button>
        </div>
    </div>

    @if($asets->isEmpty() && $pegawais->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-100 p-10 text-center shadow-sm max-w-lg mx-auto space-y-3">
            <svg class="mx-auto h-8 w-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <h3 class="text-sm font-bold text-[#14315C]">Tidak ada hasil ditemukan</h3>
            <p class="text-xs text-gray-500">Coba kata kunci lain, atau cek <a href="{{ route('kawasan') }}" class="text-[#14315C] font-semibold hover:underline">Daftar Kawasan</a> dan <a href="{{ route('struktur') }}" class="text-[#14315C] font-semibold hover:underline">Struktur Organisasi</a>.</p>
        </div>
    @else

        <div x-show="tab === 'semua' || tab === 'aset'" class="space-y-3" x-cloak>
            @if($asets->isNotEmpty())
                <div class="flex items-center justify-between px-1">
                    <h2 class="text-sm font-bold text-[#14315C] uppercase tracking-wider">Kawasan & Aset</h2>
                    <span class="text-xs text-gray-400 font-medium">{{ $asets->count() }} hasil</span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($asets as $aset)
                        <a href="{{ route('aset.show', $aset->id) }}" class="group bg-white rounded-2xl p-5 border border-gray-100 shadow-2xs hover:shadow-md hover:border-gray-200 transition-all flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="px-2.5 py-0.5 bg-blue-50 text-[#14315C] rounded-md text-[10px] font-bold uppercase tracking-wider border border-blue-100/60">
                                        {{ $aset->kategori->nama_kategori ?? 'Umum' }}
                                    </span>
                                    <span class="text-[10px] text-gray-400 font-medium">
                                        {{ $aset->isOutdoor() ? 'Outdoor' : 'Indoor' }}
                                    </span>
                                </div>
                                <h3 class="text-sm font-bold text-gray-800 group-hover:text-[#14315C] transition-colors mb-1 truncate">
                                    {{ $aset->nama }}
                                </h3>
                                <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed mb-3">
                                    {{ $aset->deskripsi ?? 'Informasi terperinci mengenai kawasan dan fasilitas aset.' }}
                                </p>
                            </div>
                            <div class="pt-2.5 border-t border-gray-50 flex items-center justify-between text-[11px] text-gray-400">
                                <span class="truncate">{{ $aset->alamat_lokasi ?? 'Batam, Kepulauan Riau' }}</span>
                                <span class="text-[#14315C] font-semibold group-hover:translate-x-0.5 transition-transform">&rarr;</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        <div x-show="tab === 'semua' || tab === 'pegawai'" class="space-y-3 pt-2" x-cloak>
            @if($pegawais->isNotEmpty())
                <div class="flex items-center justify-between px-1">
                    <h2 class="text-sm font-bold text-[#14315C] uppercase tracking-wider">Personil & Pegawai</h2>
                    <span class="text-xs text-gray-400 font-medium">{{ $pegawais->count() }} hasil</span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($pegawais as $p)
                        <a href="{{ route('pegawai.show', $p) }}" class="group flex items-center gap-3.5 bg-white rounded-2xl border border-gray-100 shadow-2xs hover:shadow-md hover:border-gray-200 transition-all p-4">
                            <div class="w-11 h-11 rounded-xl bg-blue-50 text-[#14315C] flex items-center justify-center font-bold text-xs flex-shrink-0 overflow-hidden border border-blue-100/60">
                                @if ($p->foto)
                                    <img src="{{ asset('storage/' . $p->foto) }}" class="w-full h-full object-cover" alt="{{ $p->nama }}">
                                @else
                                    {{ strtoupper(collect(explode(' ', $p->nama))->take(2)->map(fn($w)=>$w[0])->implode('')) }}
                                @endif
                            </div>
                            <div class="min-w-0 flex-grow">
                                <div class="text-xs font-bold text-gray-800 group-hover:text-[#14315C] transition-colors truncate">{{ $p->nama }}</div>
                                <div class="text-[11px] text-gray-500 truncate mt-0.5">{{ $p->jabatan->nama_jabatan ?? 'Staf / Pegawai' }}</div>
                                <span class="inline-block mt-1.5 px-2 py-0.5 bg-gray-50 text-gray-600 rounded text-[9px] font-bold uppercase tracking-wider border border-gray-200/60">
                                    {{ $p->asal ?? 'BUPA' }}
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    @endif
</div>
@endsection