@extends('layouts.app') 
@section('title', 'Informasi & Kegiatan BUPA')

@section('content')
<div class="space-y-10 py-6">

    <div class="text-center max-w-2xl mx-auto space-y-3">
        <span class="text-xs font-bold text-[#C89B3C] uppercase tracking-wider">Pusat Publikasi BUPA</span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-[#14315C] tracking-tight">Informasi, Kegiatan & Pengumuman</h1>
        <p class="text-sm text-gray-500 leading-relaxed">
            Ikuti perkembangan terbaru, dokumentasi pengelolaan kawasan, serta pengumuman resmi dari Badan Usaha Pemanfaatan Aset BP Batam.
        </p>
    </div>

    <div class="flex flex-wrap items-center justify-center gap-2">
        <a href="{{ route('informasi.index') }}" class="px-4 py-2 rounded-2xl text-xs font-bold transition-all {{ request('category') == '' ? 'bg-[#14315C] text-white shadow-md shadow-blue-900/10' : 'bg-white border border-gray-200 text-gray-600 hover:bg-slate-50' }}">
            Semua
        </a>
        @foreach($categories as $cat)
            <a href="{{ route('informasi.index', ['category' => $cat]) }}" class="px-4 py-2 rounded-2xl text-xs font-bold transition-all {{ request('category') == $cat ? 'bg-[#14315C] text-white shadow-md shadow-blue-900/10' : 'bg-white border border-gray-200 text-gray-600 hover:bg-slate-50' }}">
                {{ $cat }}
            </a>
        @endforeach
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($posts as $post)
            <article class="bg-white rounded-3xl border border-gray-200/80 shadow-md shadow-gray-200/40 overflow-hidden flex flex-col hover:shadow-lg transition-all duration-300">
                <div class="h-48 bg-gray-100 overflow-hidden relative">
                    @if($post->thumbnail)
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs font-bold bg-slate-50">BUPA BP Batam</div>
                    @endif
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 rounded-xl text-[10px] font-extrabold bg-white/90 backdrop-blur-md text-[#14315C] shadow-sm uppercase tracking-wider">
                            {{ $post->category }}
                        </span>
                    </div>
                </div>

                <div class="p-6 flex flex-col flex-grow space-y-4">
                    <div class="text-[11px] text-gray-400 font-medium flex items-center gap-2">
                        <span>{{ $post->published_at ? $post->published_at->format('d M Y') : '' }}</span>
                        <span>&bull;</span>
                        <span>Oleh: {{ $post->author->name ?? 'Admin' }}</span>
                    </div>

                    <h2 class="text-base font-extrabold text-[#14315C] tracking-tight line-clamp-2 hover:text-[#C89B3C] transition-colors">
                        <a href="{{ route('informasi.show', $post) }}">{{ $post->title }}</a>
                    </h2>

                    <p class="text-xs text-gray-500 line-clamp-3 leading-relaxed">
                        {{ Str::limit(strip_tags($post->content), 120) }}
                    </p>

                    <div class="pt-4 mt-auto border-t border-gray-100 flex items-center justify-between">
                        @if($post->aset)
                            <span class="text-[10px] font-bold text-[#C89B3C] truncate max-w-[150px]">
                                &infin; {{ $post->aset->nama }}
                            </span>
                        @else
                            <span></span>
                        @endif

                        <a href="{{ route('informasi.show', $post) }}" class="text-xs font-bold text-[#14315C] hover:text-[#C89B3C] inline-flex items-center gap-1 transition-colors">
                            <span>Baca Detail</span> &rarr;
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full py-16 text-center space-y-2">
                <div class="text-gray-400 text-sm font-semibold">Belum ada publikasi artikel untuk kategori ini.</div>
                <p class="text-xs text-gray-400">Silakan pilih kategori lainnya atau cek kembali nanti.</p>
            </div>
        @endforelse
    </div>

    <div class="pt-4">
        {{ $posts->links() }}
    </div>

</div>
@endsection