@extends('layouts.app')
@section('title', $post->title . ' · BUPA BP Batam')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 py-6">

    <div>
        <a href="{{ route('informasi.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-white border border-gray-200 rounded-xl text-xs font-bold text-gray-600 hover:bg-slate-50 transition-all shadow-2xs">
            <span>&larr;</span> Kembali ke Daftar Informasi
        </a>
    </div>

    <article class="bg-white rounded-3xl border border-gray-200/80 shadow-md shadow-gray-200/40 overflow-hidden p-6 sm:p-10 space-y-6">
        
        <div class="space-y-4">
            <div class="flex items-center gap-3">
                <span class="px-3 py-1 rounded-xl text-xs font-extrabold bg-blue-50 text-[#14315C] border border-blue-100 uppercase tracking-wider">
                    {{ $post->category }}
                </span>
                <span class="text-xs text-gray-400 font-medium">
                    Dipublikasikan pada {{ $post->published_at ? $post->published_at->format('d M Y, H:i') : '' }}
                </span>
            </div>

            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#14315C] tracking-tight leading-snug">
                {{ $post->title }}
            </h1>

            <div class="text-xs text-gray-500 font-medium pb-2 border-b border-gray-100 flex items-center justify-between">
                <span>Ditulis oleh: <strong class="text-gray-700">{{ $post->author->name ?? 'Admin BUPA' }}</strong></span>
                
                @if($post->aset)
                    <a href="{{ route('kawasan') }}" class="inline-flex items-center gap-1 text-[#C89B3C] font-bold hover:underline">
                        <span>Kawasan Terkait: {{ $post->aset->nama }}</span> &rarr;
                    </a>
                @endif
            </div>
        </div>

        @if($post->thumbnail)
            <div class="w-full h-72 sm:h-96 rounded-2xl overflow-hidden border border-gray-200 shadow-sm">
                <img src="{{ asset('storage/' . $post->thumbnail) }}" class="w-full h-full object-cover">
            </div>
        @endif

        <div class="text-gray-700 text-sm sm:text-base leading-relaxed space-y-4 pt-2">
            {!! nl2br(e($post->content)) !!}
        </div>

        @if($post->aset)
            <div class="p-6 bg-slate-50 border border-gray-200/80 rounded-2xl flex flex-col sm:flex-row items-center justify-between gap-4 mt-8">
                <div>
                    <span class="text-[10px] font-extrabold text-[#C89B3C] uppercase tracking-wider">Informasi Kawasan Terkait</span>
                    <h3 class="text-base font-extrabold text-[#14315C] mt-0.5">{{ $post->aset->nama }}</h3>
                    <p class="text-xs text-gray-500 mt-0.5">{{ $post->aset->alamat_lokasi ?? 'Lokasi aset di bawah pengelolaan BUPA BP Batam.' }}</p>
                </div>
                <a href="{{ route('kawasan') }}" class="px-5 py-2.5 bg-[#14315C] text-white text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-[#0c203d] transition-all shadow-md shadow-blue-900/10 flex-shrink-0">
                    Lihat Detail Aset
                </a>
            </div>
        @endif

    </article>

    @if($relatedPosts->count() > 0)
        <div class="space-y-6 pt-6">
            <h3 class="text-lg font-extrabold text-[#14315C] tracking-tight">Informasi Terkait Lainnya</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @foreach($relatedPosts as $rel)
                    <a href="{{ route('informasi.show', $rel) }}" class="bg-white p-5 rounded-3xl border border-gray-200/80 shadow-sm hover:shadow-md transition-all flex flex-col justify-between space-y-3">
                        <div class="space-y-2">
                            <span class="text-[10px] font-extrabold text-[#C89B3C] uppercase tracking-wider">{{ $rel->category }}</span>
                            <h4 class="text-xs sm:text-sm font-extrabold text-[#14315C] line-clamp-2 leading-snug">{{ $rel->title }}</h4>
                        </div>
                        <span class="text-[11px] text-gray-400">{{ $rel->published_at ? $rel->published_at->format('d M Y') : '' }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

</div>
@endsection