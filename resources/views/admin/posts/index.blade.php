@extends('layouts.admin')
@section('title', 'Admin · Info & Kegiatan')

@section('content')
<div class="space-y-8">

    <!-- HEADER -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-200/80 shadow-md shadow-gray-200/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="text-[11px] font-bold text-[#C89B3C] uppercase tracking-wider"></span>
            <h1 class="text-2xl sm:text-3xl font-bold text-[#14315C] tracking-tight mt-0.5">Informasi & Kegiatan</h1>
            <p class="text-xs sm:text-sm text-gray-500 font-medium mt-1">
                Kelola pengumuman, dokumentasi, dan berita kegiatan terkait kawasan BUPA.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-slate-50 border border-gray-200/80 rounded-2xl shadow-2xs">
                <span class="text-xs font-bold text-[#14315C]">Total: {{ $posts->count() }} Artikel</span>
            </div>
            <a href="{{ route('admin.posts.create') }}" class="px-5 py-2.5 bg-[#14315C] text-white text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-[#0c203d] transition-all shadow-md shadow-blue-900/10 flex items-center gap-2">
                <span>+ Tulis Baru</span>
            </a>
        </div>
    </div>

    <!-- TABEL DATA -->
    <div class="bg-white rounded-3xl shadow-md shadow-gray-200/50 border border-gray-200/80 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-slate-50/50 flex items-center justify-between">
            <h3 class="text-xs font-bold text-[#14315C] uppercase tracking-wider">Daftar Publikasi</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100 text-xs">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-6 py-3.5 text-left font-bold text-gray-500 uppercase tracking-wider">Judul & Thumbnail</th>
                        <th class="px-6 py-3.5 text-left font-bold text-gray-500 uppercase tracking-wider">Kategori / Area</th>
                        <th class="px-6 py-3.5 text-left font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3.5 text-right font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse ($posts as $post)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-16 h-12 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0 border border-gray-200/60 flex items-center justify-center text-[10px] text-gray-400 font-bold">
                                        @if($post->thumbnail)
                                            <img src="{{ asset('storage/' . $post->thumbnail) }}" class="w-full h-full object-cover">
                                        @else
                                            <span>No Img</span>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-bold text-[#14315C] text-sm line-clamp-1">{{ $post->title }}</div>
                                        <div class="text-[11px] text-gray-400 mt-0.5">
                                            Oleh: {{ $post->author->name ?? 'Sistem' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-700">{{ $post->category }}</div>
                                @if($post->aset)
                                    <div class="text-[10px] font-semibold text-[#C89B3C] mt-0.5 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        {{ $post->aset->nama }}
                                    </div>
                                @else
                                    <div class="text-[10px] text-gray-400 mt-0.5">Umum (Tidak terikat aset)</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($post->status === 'Published')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 uppercase tracking-wider">
                                        Published
                                    </span>
                                    <div class="text-[10px] text-gray-400 mt-1">{{ $post->published_at ? $post->published_at->format('d M Y') : '' }}</div>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-gray-100 text-gray-600 border border-gray-200 uppercase tracking-wider">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 bg-blue-50 px-3 py-1.5 rounded-xl border border-blue-100 transition-colors">Edit</a>
                                    
                                    <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" class="inline-block" onsubmit="return confirm('Hapus artikel ini secara permanen?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-xs font-bold text-rose-600 hover:text-rose-800 bg-rose-50 px-3 py-1.5 rounded-xl border border-rose-100 transition-colors">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="text-gray-400 text-xs font-medium">Belum ada artikel yang ditulis.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection