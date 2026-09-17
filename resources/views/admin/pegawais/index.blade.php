@extends('layouts.admin')
@section('title', 'Admin · Pegawai')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 mb-8">
        <h2 class="text-lg font-bold text-[#14315C] mb-4">Tambah Pegawai Baru</h2>
        
        <form method="POST" action="{{ route('admin.pegawais.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" required class="w-full rounded-xl border-gray-200 text-sm focus:ring-[#C89B3C] focus:border-[#C89B3C]">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Kontak / No. HP</label>
                    <input type="text" name="kontak" class="w-full rounded-xl border-gray-200 text-sm focus:ring-[#C89B3C] focus:border-[#C89B3C]">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Jabatan</label>
                    <select name="jabatan_id" required class="w-full rounded-xl border-gray-200 text-sm focus:ring-[#C89B3C] focus:border-[#C89B3C]">
                        @foreach ($jabatans as $j)
                            <option value="{{ $j->id }}">{{ $j->nama_jabatan }} (Priority: {{ $j->priority }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Atasan Langsung</label>
                    <select name="atasan_id" class="w-full rounded-xl border-gray-200 text-sm focus:ring-[#C89B3C] focus:border-[#C89B3C]">
                        <option value="">- Tidak ada atasan (Paling Atas/Direktur) -</option>
                        @foreach ($calonAtasan as $c)
                            <option value="{{ $c->id }}">{{ $c->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Asal Kepegawaian</label>
                    <select name="asal" required class="w-full rounded-xl border-gray-200 text-sm focus:ring-[#C89B3C] focus:border-[#C89B3C]">
                        <option value="BUPA">Internal BUPA</option>
                        <option value="Eksternal">Eksternal</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Foto Profil (Opsional)</label>
                    <input type="file" name="foto" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-[#14315C] hover:file:bg-blue-100">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Bagian yang Dipegang (Tekan Ctrl / Cmd untuk pilih lebih dari satu)</label>
                <select name="bagian_ids[]" multiple class="w-full rounded-xl border-gray-200 text-sm focus:ring-[#C89B3C] focus:border-[#C89B3C] h-32">
                    @foreach ($bagians as $b)
                        <option value="{{ $b->id }}">{{ $b->nama_bagian }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="px-5 py-2.5 bg-[#14315C] text-white text-sm font-medium rounded-xl hover:bg-[#C89B3C] transition-colors shadow-sm">
                + Tambah Pegawai
            </button>
        </form>
    </div>

    <!-- TABEL DATA PEGAWAI -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
            <h3 class="font-bold text-[#14315C]">Daftar Seluruh Pegawai & Pengelola</h3>
            <span class="text-xs text-gray-500 font-medium">Total: {{ $pegawais->count() }} pegawai</span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100 text-sm">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Nama & Status</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Jabatan</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Atasan</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Bagian</th>
                        <th class="px-6 py-3.5 text-right text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 bg-white">
                    @forelse ($pegawais as $p)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 font-semibold text-gray-900 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-50 text-[#14315C] flex items-center justify-center text-xs font-bold flex-shrink-0 border border-gray-100">
                                    {{ strtoupper(substr($p->nama, 0, 2)) }}
                                </div>
                                <div>
                                    <span>{{ $p->nama }}</span>
                                    @if($p->asal === 'Eksternal')
                                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">EKSTERNAL</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $p->jabatan->nama_jabatan ?? '-' }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $p->atasan->nama ?? '-' }}</td>
                            <td class="px-6 py-4 text-gray-600">
                                @php $bgList = $p->bagian->pluck('nama_bagian')->join(', '); @endphp
                                {{ $bgList ?: '-' }}
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="#" class="text-xs font-medium text-blue-600 hover:text-blue-800 bg-blue-50 px-3 py-1.5 rounded-lg border border-blue-100 transition-colors">Edit</a>
                                
                                <form method="POST" action="{{ route('admin.pegawais.destroy', $p) }}" class="inline-block" onsubmit="return confirm('Hapus pegawai ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs font-medium text-rose-600 hover:text-rose-800 bg-rose-50 px-3 py-1.5 rounded-lg border border-rose-100 transition-colors">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-400 italic">Belum ada data pegawai tercatat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection