@extends('layouts.app')
@section('title', 'Beranda')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="bg-[#14315C] rounded-3xl p-8 sm:p-12 mb-12 shadow-lg relative overflow-hidden">
        <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-white opacity-5"></div>
        <div class="absolute bottom-0 right-32 -mb-20 w-48 h-48 rounded-full bg-white opacity-5"></div>
        
        <div class="relative z-10 max-w-2xl">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-4 tracking-tight">
                Informasi Kawasan & Organisasi BUPA
            </h1>
            <p class="text-blue-100 text-sm sm:text-base mb-8 leading-relaxed max-w-xl">
                Telusuri kawasan/aset berdasarkan kategori, lihat fasilitasnya, dan siapa yang mengelola. 
                Untuk transaksi sewa dan harga layanan, kunjungi <span class="font-semibold text-[#C89B3C]">B-Fast</span>.
            </p>
            
            <form method="GET" action="{{ route('cari') }}" class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-grow">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="q" placeholder="Cari nama kawasan, unit, atau pegawai..." class="block w-full pl-11 pr-4 py-3.5 bg-white border-none rounded-xl text-gray-900 shadow-sm focus:ring-2 focus:ring-[#C89B3C] placeholder-gray-400 text-sm">
                </div>
                <button type="submit" class="px-8 py-3.5 bg-[#C89B3C] hover:bg-[#a68032] text-white font-medium rounded-xl shadow-sm transition-colors duration-200">
                    Cari
                </button>
            </form>
        </div>
    </div>

    <div class="mb-6 flex items-end justify-between">
        <div>
            <h2 class="text-2xl font-bold text-[#14315C]">Kategori Kawasan/Aset</h2>
            <p class="text-sm text-gray-500 mt-1">Jelajahi berbagai aset yang dikelola oleh BP Batam.</p>
        </div>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($kategoris as $k)
            <a href="{{ route('aset.index', ['kategori' => $k->id]) }}" class="group block bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-gray-200 transition-all duration-300">
                
                <h3 class="text-lg font-bold text-[#14315C] mb-2 group-hover:text-[#C89B3C] transition-colors">
                    {{ $k->nama_kategori }}
                </h3>
                
                <p class="text-gray-500 text-sm mb-5 line-clamp-2">
                    {{ $k->deskripsi ?? 'Lihat daftar aset di bawah kategori ' . $k->nama_kategori }}
                </p>
                
                <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-[#14315C]/5 text-[#14315C] rounded-full text-xs font-semibold">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    {{ $k->aset_utama_count ?? 0 }} aset
                </div>
                
            </a>
        @endforeach
    </div>

</div>
@endsection