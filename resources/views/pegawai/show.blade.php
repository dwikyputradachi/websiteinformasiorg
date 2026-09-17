@extends('layouts.app')
@section('title', 'Profil ' . $pegawai->nama)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <nav class="flex text-sm text-gray-500 mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rounded-lg bg-white px-4 py-2 shadow-sm border border-gray-100">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="inline-flex items-center hover:text-[#14315C] transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Beranda
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <a href="{{ route('struktur') }}" class="ml-1 hover:text-[#14315C] transition-colors">Struktur Organisasi</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <span class="ml-1 font-medium text-gray-800">{{ $pegawai->nama }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-8 relative">
        <div class="h-24 bg-gradient-to-r from-[#14315C] to-[#1e4a8a]"></div>
        
        <div class="px-8 pb-8">
            <div class="flex flex-col sm:flex-row gap-6 items-start sm:items-end -mt-12 mb-6">               
                <div class="w-28 h-28 rounded-full bg-white p-1.5 shadow-md flex-shrink-0">
                    <div class="w-full h-full rounded-full bg-blue-50 text-[#14315C] flex items-center justify-center font-bold text-3xl tracking-wide overflow-hidden border border-gray-100">
                        @if ($pegawai->foto)
                            <img src="{{ asset('storage/' . $pegawai->foto) }}" alt="{{ $pegawai->nama }}" class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(collect(explode(' ', $pegawai->nama))->take(2)->map(fn($w)=>$w[0])->implode('')) }}
                        @endif
                    </div>
                </div>

                <div class="flex-grow pt-2 sm:pt-0">
                    <div class="flex items-center gap-3 mb-1">
                        <h1 class="text-2xl font-bold text-gray-900">{{ $pegawai->nama }}</h1>
                        @if ($pegawai->asal === 'Eksternal')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200">
                                Eksternal
                            </span>
                        @endif
                    </div>
                    
                    <div class="flex flex-wrap items-center gap-x-6 gap-y-2 text-sm text-gray-600 font-medium">
                        <div class="flex items-center gap-1.5 text-[#14315C]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            {{ $pegawai->jabatan->nama_jabatan }}
                        </div>
                        
                        @if ($pegawai->atasan)
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                                <span class="text-gray-500">Lapor ke:</span>
                                <a href="{{ route('pegawai.show', $pegawai->atasan) }}" class="text-[#C89B3C] hover:underline font-semibold">
                                    {{ $pegawai->atasan->nama }}
                                </a>
                            </div>
                        @endif

                        @if ($pegawai->kontak)
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                {{ $pegawai->kontak }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <hr class="border-gray-100 my-6">

            <div>
                <h3 class="text-sm font-bold tracking-wider text-gray-400 uppercase mb-3">Bagian yang Dipegang</h3>
                <div class="flex flex-wrap gap-2">
                    @forelse ($pegawai->bagian as $b)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-[#14315C] border border-blue-100">
                            {{ $b->nama_bagian }}
                        </span>
                    @empty
                        <span class="text-sm text-gray-400 italic">Belum ada bagian tercatat</span>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                <h3 class="font-bold text-[#14315C]">Aset yang Dikelola</h3>
                <span class="bg-[#14315C] text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $asetDikelola->count() }}</span>
            </div>
            
            <ul class="divide-y divide-gray-100">
                @forelse ($asetDikelola as $ap)
                    <li class="px-6 py-4 hover:bg-gray-50/50 transition-colors">
                        <a href="{{ route('aset.show', $ap->aset) }}" class="group block">
                            <div class="font-semibold text-gray-800 group-hover:text-[#C89B3C] transition-colors mb-1">
                                {{ $ap->aset->nama }}
                            </div>
                            <div class="flex items-center text-xs text-gray-500 gap-2">
                                <span class="bg-gray-100 px-2 py-1 rounded-md">{{ $ap->bagian->nama_bagian ?? 'Pengelola' }}</span>
                                @if($ap->keterangan) 
                                    <span class="text-gray-400">&bull;</span> {{ $ap->keterangan }} 
                                @endif
                            </div>
                        </a>
                    </li>
                @empty
                    <li class="px-6 py-8 text-center text-gray-400 text-sm italic">
                        Tidak mengelola aset apa pun saat ini.
                    </li>
                @endforelse
            </ul>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                <h3 class="font-bold text-[#14315C]">Tim / Bawahan Langsung</h3>
                <span class="bg-[#C89B3C] text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $pegawai->bawahan->count() }}</span>
            </div>
            
            <ul class="divide-y divide-gray-100">
                @forelse ($pegawai->bawahan as $b)
                    <li class="px-6 py-3 hover:bg-gray-50/50 transition-colors">
                        <a href="{{ route('pegawai.show', $b) }}" class="flex items-center gap-4 group">
                            <div class="w-10 h-10 rounded-full bg-blue-50 text-[#14315C] flex items-center justify-center font-bold text-xs flex-shrink-0 border border-gray-100">
                                @if ($b->foto)
                                    <img src="{{ asset('storage/' . $b->foto) }}" class="w-full h-full object-cover rounded-full">
                                @else
                                    {{ strtoupper(collect(explode(' ', $b->nama))->take(2)->map(fn($w)=>$w[0])->implode('')) }}
                                @endif
                            </div>
                            <div>
                                <div class="font-semibold text-sm text-gray-800 group-hover:text-[#14315C] transition-colors">
                                    {{ $b->nama }}
                                </div>
                                <div class="text-xs text-gray-500 mt-0.5">
                                    {{ $b->jabatan->nama_jabatan }}
                                </div>
                            </div>
                            <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-4 h-4 text-[#C89B3C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </div>
                        </a>
                    </li>
                @empty
                    <li class="px-6 py-8 text-center text-gray-400 text-sm italic">
                        Tidak memiliki bawahan.
                    </li>
                @endforelse
            </ul>
        </div>

    </div>
</div>
@endsection