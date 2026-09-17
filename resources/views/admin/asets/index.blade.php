@extends('layouts.admin')
@section('title', 'Admin · Aset')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- FORM TAMBAH ASET -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 mb-8">
        <h2 class="text-lg font-bold text-[#14315C] mb-4">Tambah Aset / Kawasan Baru</h2>
        
        <form method="POST" action="{{ route('admin.asets.store') }}" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Nama Aset</label>
                    <input type="text" name="nama" required class="w-full rounded-xl border-gray-200 text-sm focus:ring-[#C89B3C] focus:border-[#C89B3C]">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Lokasi / Alamat</label>
                    <input type="text" name="alamat_lokasi" class="w-full rounded-xl border-gray-200 text-sm focus:ring-[#C89B3C] focus:border-[#C89B3C]">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Kategori</label>
                    <select name="kategori_id" class="w-full rounded-xl border-gray-200 text-sm focus:ring-[#C89B3C] focus:border-[#C89B3C]">
                        <option value="">- Pilih kategori -</option>
                        @foreach ($kategoris as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Aset Induk (Opsional)</label>
                    <select name="parent_id" class="w-full rounded-xl border-gray-200 text-sm focus:ring-[#C89B3C] focus:border-[#C89B3C]">
                        <option value="">- Tanpa induk (Aset Utama) -</option>
                        @foreach ($asetIndukPilihan as $a)
                            <option value="{{ $a->id }}">{{ $a->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Status Operasional</label>
                    <select name="status_operasional" required class="w-full rounded-xl border-gray-200 text-sm focus:ring-[#C89B3C] focus:border-[#C89B3C]">
                        <option value="Aktif">Aktif</option>
                        <option value="Renovasi">Renovasi</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Link B-Fast (Opsional)</label>
                    <input type="url" name="link_bfast" placeholder="https://b-fast.bpbatam.go.id/..." class="w-full rounded-xl border-gray-200 text-sm focus:ring-[#C89B3C] focus:border-[#C89B3C]">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="2" class="w-full rounded-xl border-gray-200 text-sm focus:ring-[#C89B3C] focus:border-[#C89B3C]"></textarea>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Link Google Maps (Opsional)</label>
                    <input type="url" name="koordinat_gis" placeholder="https://maps.google.com/..." class="w-full rounded-xl border-gray-200 text-sm focus:ring-[#C89B3C] focus:border-[#C89B3C]">
                </div>
            </div>

            <button type="submit" class="px-5 py-2.5 bg-[#14315C] text-white text-sm font-medium rounded-xl hover:bg-[#C89B3C] transition-colors shadow-sm">
                + Tambah Aset
            </button>
        </form>
    </div>

    <!-- TABEL DATA ASET -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
            <h3 class="font-bold text-[#14315C]">Daftar Seluruh Aset</h3>
            <span class="text-xs text-gray-500 font-medium">Total: {{ $asets->count() }} item</span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100 text-sm">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Nama Aset</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Kategori</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Induk</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3.5 text-right text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 bg-white">
                    @forelse ($asets as $a)
                        @php
                            $statusFormatted = str_replace(' ', '', $a->status_operasional);
                            $statusClasses = match($statusFormatted) {
                                'Aktif' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                'Renovasi' => 'bg-amber-50 text-amber-700 border-amber-200',
                                'TidakAktif' => 'bg-rose-50 text-rose-700 border-rose-200',
                                default => 'bg-gray-50 text-gray-700 border-gray-200'
                            };
                        @endphp
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $a->nama }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $a->kategori->nama_kategori ?? '-' }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $a->parent->nama ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $statusClasses }}">
                                    {{ $a->status_operasional }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <!-- Tombol Edit (Bisa diarahkan ke route edit jika controllernya sudah siap) -->
                                <a href="{{ route('admin.asets.index') }}" class="text-xs font-medium text-blue-600 hover:text-blue-800 bg-blue-50 px-3 py-1.5 rounded-lg border border-blue-100 transition-colors">Edit</a>
                                
                                <form method="POST" action="{{ route('admin.asets.destroy', $a) }}" class="inline-block" onsubmit="return confirm('Hapus aset ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs font-medium text-rose-600 hover:text-rose-800 bg-rose-50 px-3 py-1.5 rounded-lg border border-rose-100 transition-colors">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-400 italic">Belum ada data aset tercatat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection