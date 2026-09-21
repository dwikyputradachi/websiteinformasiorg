@extends('layouts.admin')
@section('title', 'Tulis Artikel · Admin')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <!-- HEADER -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-200/80 shadow-md shadow-gray-200/50 flex items-center justify-between">
        <div>
            <span class="text-[11px] font-bold text-[#C89B3C] uppercase tracking-wider">Panel Admin / Info & Kegiatan</span>
            <h1 class="text-xl sm:text-2xl font-bold text-[#14315C] tracking-tight mt-0.5">Tulis Artikel Baru</h1>
        </div>
        <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 bg-slate-50 border border-gray-200/80 rounded-xl text-xs font-bold text-gray-600 hover:bg-gray-100 transition-all flex items-center gap-1.5">
            <span>&larr;</span> Kembali
        </a>
    </div>

    <!-- FORM ERROR ALERT (Jika ada validasi gagal) -->
    @if ($errors->any())
        <div class="bg-rose-50 border border-rose-200 text-rose-600 p-4 rounded-2xl text-xs font-medium">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- FORM UTAMA -->
    <div class="bg-white rounded-3xl shadow-md shadow-gray-200/50 border border-gray-200/80 p-6 sm:p-8">
        <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <!-- JUDUL (Full Width) -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider">Judul Artikel / Pengumuman <span class="text-rose-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-4 py-3 text-sm text-gray-800 font-semibold focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all" placeholder="Contoh: Peresmian Fasilitas Baru Taman Rusa...">
            </div>

            <!-- PENGATURAN KATEGORI & KAWASAN (Grid 2 Kolom) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-5 bg-slate-50/50 rounded-2xl border border-gray-100">
                <div class="space-y-1.5">
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider">Kategori Konten <span class="text-rose-500">*</span></label>
                    <select name="category" required class="w-full bg-white border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] outline-none transition-all">
                        <option value="">- Pilih Kategori -</option>
                        <option value="Kegiatan" {{ old('category') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                        <option value="Informasi" {{ old('category') == 'Informasi' ? 'selected' : '' }}>Informasi Umum</option>
                        <option value="Pengumuman" {{ old('category') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                        <option value="Pengelolaan Area" {{ old('category') == 'Pengelolaan Area' ? 'selected' : '' }}>Pengelolaan Area</option>
                        <option value="Dokumentasi" {{ old('category') == 'Dokumentasi' ? 'selected' : '' }}>Dokumentasi</option>
                    </select>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider">Terkait Kawasan / Aset (Opsional)</label>
                    <select name="aset_id" class="w-full bg-white border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] outline-none transition-all">
                        <option value="">-- Umum (Tidak Terikat Kawasan) --</option>
                        @foreach ($asets as $aset)
                            <option value="{{ $aset->id }}" {{ old('aset_id') == $aset->id ? 'selected' : '' }}>{{ $aset->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- KONTEN ARTIKEL -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider">Isi Artikel <span class="text-rose-500">*</span></label>
                <textarea name="content" rows="12" required class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-4 py-3 text-sm text-gray-800 leading-relaxed focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all placeholder:text-gray-400" placeholder="Tuliskan isi informasi, pengumuman, atau deskripsi kegiatan di sini..."></textarea>
            </div>

            <!-- STATUS & THUMBNAIL (Grid 2 Kolom) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider">Foto / Thumbnail (Opsional)</label>
                    <input type="file" name="thumbnail" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-[#14315C] hover:file:bg-blue-100 transition-all border border-gray-200/80 rounded-xl bg-slate-50">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider">Status Publikasi <span class="text-rose-500">*</span></label>
                    <select name="status" required class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs font-bold text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all">
                        <option value="Draft" {{ old('status') == 'Draft' ? 'selected' : '' }}>Simpan sebagai Draft</option>
                        <option value="Published" {{ old('status') == 'Published' ? 'selected' : '' }}>Langsung Publish</option>
                    </select>
                </div>
            </div>

            <!-- TOMBOL SUBMIT -->
            <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                <a href="{{ route('admin.posts.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-600 text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-gray-200 transition-all">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-[#14315C] text-white text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-[#0c203d] transition-all shadow-md shadow-blue-900/10">
                    Simpan Artikel
                </button>
            </div>
            
        </form>
    </div>
</div>
@endsection