@extends('layouts.admin')
@section('title', 'Admin · Fasilitas')

@section('content')
<div class="space-y-8">
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-200/80 shadow-md shadow-gray-200/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-[#14315C] tracking-tight mt-0.5">Manajemen Fasilitas Aset</h1>
            <p class="text-xs sm:text-sm text-gray-500 font-medium mt-1">
                Kelola daftar fasilitas, layanan, atau daya tarik yang tersedia di setiap kawasan/aset BUPA.
            </p>
        </div>
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-slate-50 border border-gray-200/80 rounded-2xl">
            <span class="text-xs font-bold text-[#14315C]">Total Fasilitas: {{ $fasilitas->count() }} item</span>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-md shadow-gray-200/50 border border-gray-200/80 p-6 sm:p-8">
        <h2 class="text-base font-extrabold text-[#14315C] mb-5 tracking-tight flex items-center gap-2">
            <svg class="w-4 h-4 text-[#C89B3C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
            Tambah Fasilitas Baru
        </h2>
        
        <form method="POST" action="{{ route('admin.fasilitas.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Nama Fasilitas</label>
                    <input type="text" name="nama" required class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all" placeholder="Contoh: Pakan Kelinci, Gazebo, Tiket Masuk...">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Aset Induk</label>
                    <select name="aset_id" required class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all">
                        <option value="">- Pilih Aset Induk -</option>
                        @foreach ($asets as $a)
                            <option value="{{ $a->id }}">{{ $a->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Deskripsi</label>
                    <textarea name="deskripsi" rows="2" class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all" placeholder="Tulis deskripsi singkat fasilitas..."></textarea>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Foto (Opsional)</label>
                    <input type="file" name="foto" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-[#14315C] hover:file:bg-blue-100 transition-all border border-gray-200/80 rounded-xl bg-slate-50">
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="px-6 py-3 bg-[#14315C] text-white text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-[#0c203d] transition-all shadow-md shadow-blue-900/10">
                    + Tambah Fasilitas
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-3xl shadow-md shadow-gray-200/50 border border-gray-200/80 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-slate-50/50 flex items-center justify-between">
            <h3 class="text-xs font-bold text-[#14315C] uppercase tracking-wider">Daftar Seluruh Fasilitas</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100 text-xs">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-6 py-3.5 text-left font-bold text-gray-500 uppercase tracking-wider">Nama & Foto</th>
                        <th class="px-6 py-3.5 text-left font-bold text-gray-500 uppercase tracking-wider">Aset Induk</th>
                        <th class="px-6 py-3.5 text-left font-bold text-gray-500 uppercase tracking-wider">Deskripsi</th>
                        <th class="px-6 py-3.5 text-right font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse ($fasilitas as $f)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0 border border-gray-200/60 flex items-center justify-center text-[10px] text-gray-400 font-bold">
                                        @if($f->foto)
                                            <img src="{{ asset('storage/' . $f->foto) }}" class="w-full h-full object-cover">
                                        @else
                                            <span>No Foto</span>
                                        @endif
                                    </div>
                                    <div class="font-bold text-[#14315C] text-sm">{{ $f->nama }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-[10px] font-bold bg-blue-50 text-[#14315C] border border-blue-100">
                                    {{ $f->aset->nama ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600 max-w-xs truncate">{{ $f->deskripsi ?? '-' }}</td>
                            <td class="px-6 py-4 text-right">
                                <form method="POST" action="{{ route('admin.fasilitas.destroy', $f) }}" class="inline-block" onsubmit="return confirm('Hapus fasilitas ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs font-bold text-rose-600 hover:text-rose-800 bg-rose-50 px-3.5 py-1.5 rounded-xl border border-rose-100 transition-colors">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-400 text-xs italic">Belum ada data fasilitas tercatat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection