@extends('layouts.admin')
@section('title', 'Edit Pegawai · Admin')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- HEADER KEMBALI -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-200/80 shadow-md shadow-gray-200/50 flex items-center justify-between">
        <div>
            <span class="text-[11px] font-extrabold text-[#C89B3C] uppercase tracking-wider">Panel Admin</span>
            <h1 class="text-xl font-extrabold text-[#14315C] tracking-tight mt-0.5">Edit Pegawai: {{ $pegawai->nama }}</h1>
        </div>
        <a href="{{ route('admin.pegawais.index') }}" class="px-4 py-2 bg-slate-50 border border-gray-200/80 rounded-xl text-xs font-bold text-gray-600 hover:bg-gray-100 transition-all">
            &larr; Kembali
        </a>
    </div>

    <!-- FORM EDIT -->
    <div class="bg-white rounded-3xl shadow-md shadow-gray-200/50 border border-gray-200/80 p-6 sm:p-8">
        <form method="POST" action="{{ route('admin.pegawais.update', $pegawai) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama', $pegawai->nama) }}" required class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Kontak / No. HP</label>
                    <input type="text" name="kontak" value="{{ old('kontak', $pegawai->kontak) }}" class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Jabatan</label>
                    <select name="jabatan_id" required class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all">
                        @foreach ($jabatans as $j)
                            <option value="{{ $j->id }}" {{ $pegawai->jabatan_id == $j->id ? 'selected' : '' }}>
                                {{ $j->nama_jabatan }} (Prioritas: {{ $j->priority }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Atasan Langsung</label>
                    <select name="atasan_id" class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all">
                        <option value="">- Tidak ada atasan (Paling Atas / Direktur) -</option>
                        @foreach ($calonAtasan as $c)
                            <option value="{{ $c->id }}" {{ $pegawai->atasan_id == $c->id ? 'selected' : '' }}>
                                {{ $c->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Asal Kepegawaian</label>
                    <select name="asal" required class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all">
                        <option value="BUPA" {{ $pegawai->asal == 'BUPA' ? 'selected' : '' }}>Internal BUPA</option>
                        <option value="Eksternal" {{ $pegawai->asal == 'Eksternal' ? 'selected' : '' }}>Eksternal</option>
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Ganti Foto Profil</label>
                    <input type="file" name="foto" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-[#14315C] hover:file:bg-blue-100 transition-all">
                </div>
            </div>

            @if($pegawai->foto)
                <div class="flex items-center gap-3 pt-2">
                    <div class="w-12 h-12 rounded-xl overflow-hidden border border-gray-200 flex-shrink-0">
                        <img src="{{ asset('storage/' . $pegawai->foto) }}" class="w-full h-full object-cover">
                    </div>
                    <span class="text-[11px] text-gray-400 font-medium">Foto profil saat ini</span>
                </div>
            @endif

            <div class="space-y-1.5">
                <div class="space-y-2">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">
                        Bagian / Unit yang Dipegang
                    </label>
                    <p class="text-[11px] text-gray-400 font-medium">Centang satu atau beberapa bagian sesuai dengan tugas pegawai ini.</p>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2 bg-slate-50 border border-gray-200/80 rounded-2xl p-4 max-h-48 overflow-y-auto custom-scrollbar">
                        @foreach ($bagians as $b)
                            @php
                                $isChecked = isset($pegawai) && $pegawai->bagian->contains($b->id);
                            @endphp
                            <label class="flex items-center gap-2.5 p-2 bg-white rounded-xl border border-gray-200/60 hover:border-blue-300 cursor-pointer transition-all shadow-2xs">
                                <input type="checkbox" name="bagian_ids[]" value="{{ $b->id }}" {{ $isChecked ? 'checked' : '' }} class="w-4 h-4 text-[#14315C] border-gray-300 rounded focus:ring-[#14315C]">
                                <span class="text-xs font-bold text-gray-700">{{ $b->nama_bagian }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="pt-2 flex items-center gap-3">
                <button type="submit" class="px-6 py-3 bg-[#14315C] text-white text-xs font-extrabold uppercase tracking-wider rounded-xl hover:bg-[#0c203d] transition-all shadow-md shadow-blue-900/10">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.pegawais.index') }}" class="px-5 py-3 bg-gray-100 text-gray-700 text-xs font-extrabold uppercase tracking-wider rounded-xl hover:bg-gray-200 transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection