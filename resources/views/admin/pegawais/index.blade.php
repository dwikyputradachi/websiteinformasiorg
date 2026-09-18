@extends('layouts.admin')
@section('title', 'Admin · Pegawai')

@section('content')
<div class="space-y-8">
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-200/80 shadow-md shadow-gray-200/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>            
            <h1 class="text-2xl sm:text-3xl font-bold text-[#14315C] tracking-tight mt-0.5">Manajemen Pegawai</h1>
            <p class="text-xs sm:text-sm text-gray-500 font-medium mt-1">
                Tambah dan kelola data profil pegawai serta penugasan bagian unit kerja.
            </p>
        </div>
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-slate-50 border border-gray-200/80 rounded-2xl shadow-2xs">
            <span class="text-xs font-bold text-[#14315C]">Total: {{ $pegawais->count() }} orang</span>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-md shadow-gray-200/50 border border-gray-200/80 p-6 sm:p-8">
        <h2 class="text-base font-extrabold text-[#14315C] mb-5 tracking-tight flex items-center gap-2">
            <svg class="w-4 h-4 text-[#C89B3C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
            Tambah Pegawai Baru
        </h2>
        
        <form method="POST" action="{{ route('admin.pegawais.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Nama Lengkap</label>
                    <input type="text" name="nama" required class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all" placeholder="Contoh: Budi Santoso, S.E.">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Kontak / No. HP</label>
                    <input type="text" name="kontak" class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all" placeholder="Contoh: 081234567890">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Jabatan</label>
                    <select name="jabatan_id" required class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all">
                        <option value="">- Pilih Jabatan -</option>
                        @foreach ($jabatans as $j)
                            <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Atasan Langsung</label>
                    <select name="atasan_id" class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all">
                        <option value="">- Tidak ada (Paling Atas / Direktur) -</option>
                        @foreach ($calonAtasan as $c)
                            <option value="{{ $c->id }}">{{ $c->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Asal Kepegawaian</label>
                    <select name="asal" required class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all">
                        <option value="BUPA">Internal BUPA</option>
                        <option value="Eksternal">Eksternal</option>
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Foto Profil (Opsional)</label>
                    <input type="file" name="foto" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-[#14315C] hover:file:bg-blue-100 transition-all">
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Pilih Bagian / Unit Kerja</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2 bg-slate-50 border border-gray-200/80 rounded-2xl p-4 max-h-48 overflow-y-auto">
                    @foreach ($bagians as $b)
                        <label class="flex items-center gap-2.5 p-2 bg-white rounded-xl border border-gray-200/60 hover:border-blue-300 cursor-pointer transition-all shadow-2xs">
                            <input type="checkbox" name="bagian_ids[]" value="{{ $b->id }}" class="w-4 h-4 text-[#14315C] border-gray-300 rounded focus:ring-[#14315C]">
                            <span class="text-xs font-bold text-gray-700">{{ $b->nama_bagian }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="px-6 py-3 bg-[#14315C] text-white text-xs font-extrabold uppercase tracking-wider rounded-xl hover:bg-[#0c203d] transition-all shadow-md shadow-blue-900/10">
                    + Simpan Pegawai Baru
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-3xl shadow-md shadow-gray-200/50 border border-gray-200/80 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-slate-50/50 flex items-center justify-between">
            <h3 class="text-xs font-extrabold text-[#14315C] uppercase tracking-wider">Daftar Seluruh Pegawai</h3>
            <span class="text-xs text-gray-500 font-medium">Total: {{ $pegawais->count() }} orang</span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100 text-xs">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-6 py-3.5 text-left font-extrabold text-gray-500 uppercase tracking-wider">Nama & Status</th>
                        <th class="px-6 py-3.5 text-left font-extrabold text-gray-500 uppercase tracking-wider">Jabatan</th>
                        <th class="px-6 py-3.5 text-left font-extrabold text-gray-500 uppercase tracking-wider">Atasan Langsung</th>
                        <th class="px-6 py-3.5 text-left font-extrabold text-gray-500 uppercase tracking-wider">Bagian</th>
                        <th class="px-6 py-3.5 text-right font-extrabold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse ($pegawais as $p)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-blue-50 text-[#14315C] flex items-center justify-center text-xs font-extrabold flex-shrink-0 border border-blue-100">
                                        @if($p->foto)
                                            <img src="{{ asset('storage/' . $p->foto) }}" class="w-full h-full object-cover rounded-xl">
                                        @else
                                            {{ strtoupper(substr($p->nama, 0, 2)) }}
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-extrabold text-[#14315C] text-sm">{{ $p->nama }}</div>
                                        @if($p->asal === 'Eksternal')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[9px] font-extrabold bg-amber-50 text-amber-700 border border-amber-200 uppercase mt-0.5">Eksternal</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[9px] font-extrabold bg-blue-50 text-[#14315C] border border-blue-100 uppercase mt-0.5">Internal</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-600">{{ $p->jabatan->nama_jabatan ?? '-' }}</td>
                            <td class="px-6 py-4 font-medium text-gray-600">{{ $p->atasan->nama ?? '-' }}</td>
                            <td class="px-6 py-4 font-medium text-gray-600">
                                @php $bgList = $p->bagian->pluck('nama_bagian')->join(', '); @endphp
                                {{ $bgList ?: '-' }}
                            </td>
                            <td class="px-6 py-4 text-right flex justify-end gap-2">
                                <a href="{{ route('admin.pegawais.edit', $p) }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 bg-blue-50 px-3 py-1.5 rounded-xl border border-blue-100 transition-colors">Edit</a>
                                
                                <form method="POST" action="{{ route('admin.pegawais.destroy', $p) }}" class="inline-block" onsubmit="return confirm('Hapus data pegawai ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs font-bold text-rose-600 hover:text-rose-800 bg-rose-50 px-3 py-1.5 rounded-xl border border-rose-100 transition-colors">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400 text-xs italic">Belum ada data pegawai tercatat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection