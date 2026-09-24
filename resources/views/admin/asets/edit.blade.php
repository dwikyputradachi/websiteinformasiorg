@extends('layouts.admin')
@section('title', 'Edit Aset · Admin')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-200/80 shadow-md shadow-gray-200/50 flex items-center justify-between">
        <div>
            <span class="text-[11px] font-extrabold text-[#C89B3C] uppercase tracking-wider">Panel Admin</span>
            <h1 class="text-xl font-extrabold text-[#14315C] tracking-tight mt-0.5">Edit Aset: {{ $aset->nama }}</h1>
        </div>
        <a href="{{ route('admin.asets.index') }}" class="px-4 py-2 bg-slate-50 border border-gray-200/80 rounded-xl text-xs font-bold text-gray-600 hover:bg-gray-100 transition-all">
            &larr; Kembali
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-md shadow-gray-200/50 border border-gray-200/80 p-6 sm:p-8">
        <form method="POST" action="{{ route('admin.asets.update', $aset) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Nama Aset</label>
                    <input type="text" name="nama" value="{{ old('nama', $aset->nama) }}" required class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Lokasi / Alamat</label>
                    <input type="text" name="alamat_lokasi" value="{{ old('alamat_lokasi', $aset->alamat_lokasi) }}" class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Kategori</label>
                    <select name="kategori_id" class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all">
                        <option value="">- Pilih kategori -</option>
                        @foreach ($kategoris as $k)
                            <option value="{{ $k->id }}" {{ $aset->kategori_id == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Status Operasional</label>
                    <select name="status_operasional" required class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all">
                        <option value="Aktif" {{ $aset->status_operasional == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Renovasi" {{ $aset->status_operasional == 'Renovasi' ? 'selected' : '' }}>Renovasi</option>
                        <option value="Tidak Aktif" {{ $aset->status_operasional == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Jenis Area</label>
                    <select name="is_outdoor" required class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all">
                        <option value="1" {{ $aset->is_outdoor == 1 ? 'selected' : '' }}>Outdoor (Luar Ruangan)</option>
                        <option value="0" {{ $aset->is_outdoor == 0 ? 'selected' : '' }}>Indoor (Dalam Ruangan)</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Koordinat GIS / Peta</label>
                    <input type="text" name="koordinat_gis" value="{{ old('koordinat_gis', $aset->koordinat_gis) }}" class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Latitude (Cuaca)</label>
                    <input type="text" name="latitude" value="{{ old('latitude', $aset->latitude) }}" placeholder="Contoh: 1.123825" class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Longitude (Cuaca)</label>
                    <input type="text" name="longitude" value="{{ old('longitude', $aset->longitude) }}" placeholder="Contoh: 103.935072" class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all">
                </div>
            </div>

            <div class="p-5 bg-slate-50/70 border border-gray-200/80 rounded-2xl space-y-4">
                <h3 class="text-xs font-extrabold text-[#14315C] uppercase tracking-wider flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#C89B3C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Jam Operasional Harian
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">
                    <div class="space-y-1">
                        <label class="block text-[11px] font-bold text-gray-600">Senin</label>
                        <input type="text" name="senin" value="{{ old('senin', $aset->senin) }}" class="w-full bg-white border border-gray-200 rounded-xl px-3 py-2 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] outline-none">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-[11px] font-bold text-gray-600">Selasa</label>
                        <input type="text" name="selasa" value="{{ old('selasa', $aset->selasa) }}" class="w-full bg-white border border-gray-200 rounded-xl px-3 py-2 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] outline-none">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-[11px] font-bold text-gray-600">Rabu</label>
                        <input type="text" name="rabu" value="{{ old('rabu', $aset->rabu) }}" class="w-full bg-white border border-gray-200 rounded-xl px-3 py-2 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] outline-none">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-[11px] font-bold text-gray-600">Kamis</label>
                        <input type="text" name="kamis" value="{{ old('kamis', $aset->kamis) }}" class="w-full bg-white border border-gray-200 rounded-xl px-3 py-2 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] outline-none">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-[11px] font-bold text-gray-600">Jumat</label>
                        <input type="text" name="jumat" value="{{ old('jumat', $aset->jumat) }}" class="w-full bg-white border border-gray-200 rounded-xl px-3 py-2 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] outline-none">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-[11px] font-bold text-gray-600">Sabtu</label>
                        <input type="text" name="sabtu" value="{{ old('sabtu', $aset->sabtu) }}" class="w-full bg-white border border-gray-200 rounded-xl px-3 py-2 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] outline-none">
                    </div>
                    <div class="space-y-1 sm:col-span-2">
                        <label class="block text-[11px] font-bold text-gray-600">Minggu</label>
                        <input type="text" name="minggu" value="{{ old('minggu', $aset->minggu) }}" class="w-full bg-white border border-gray-200 rounded-xl px-3 py-2 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] outline-none">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Ganti Foto Utama Aset</label>
                    <input type="file" name="foto" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-[#14315C] hover:file:bg-blue-100 transition-all">
                </div>
                @if($aset->foto)
                    <div class="flex items-center gap-3 pt-4">
                        <div class="w-14 h-14 rounded-xl overflow-hidden border border-gray-200 shadow-sm flex-shrink-0">
                            <img src="{{ asset('storage/' . $aset->foto) }}" class="w-full h-full object-cover">
                        </div>
                        <span class="text-[11px] text-gray-400 font-medium">Foto Utama saat ini</span>
                    </div>
                @endif
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Tambah Foto Galeri Dokumentasi</label>
                <input type="file" name="galeri[]" accept="image/*" multiple class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 transition-all">
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all">{{ old('deskripsi', $aset->deskripsi) }}</textarea>
            </div>

            <div class="pt-2 flex items-center gap-3">
                <button type="submit" class="px-6 py-3 bg-[#14315C] text-white text-xs font-extrabold uppercase tracking-wider rounded-xl hover:bg-[#0c203d] transition-all shadow-md shadow-blue-900/10">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.asets.index') }}" class="px-5 py-3 bg-gray-100 text-gray-700 text-xs font-extrabold uppercase tracking-wider rounded-xl hover:bg-gray-200 transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection