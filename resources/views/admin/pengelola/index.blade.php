@extends('layouts.admin')
@section('title', 'Admin · Pengelola Aset')

@section('content')
<div class="space-y-8">
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-200/80 shadow-md shadow-gray-200/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-[#14315C] tracking-tight mt-0.5">Pengelola Aset</h1>
            <p class="text-xs sm:text-sm text-gray-500 font-medium mt-1">
                Atur penugasan pegawai atau pihak eksternal yang bertanggung jawab mengelola kawasan atau aset BUPA.
            </p>
        </div>
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-slate-50 border border-gray-200/80 rounded-2xl">
            <span class="text-xs font-bold text-[#14315C]">Total Penugasan: {{ $pengelola->count() }} item</span>
        </div>
    </div>

    <div class="bg-blue-50/70 border border-blue-100 rounded-2xl p-5 flex items-start gap-3.5">
        <svg class="w-5 h-5 text-[#14315C] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <div class="text-xs text-[#14315C] leading-relaxed font-medium">
            <strong class="font-bold">Catatan Penugasan:</strong> Satu aset boleh punya lebih dari satu pengelola, masing-masing dalam bagian berbeda (contoh: Guest House dikelola Pak A di bagian Keuangan dan Pak B di bagian Operasional sekaligus). Bagian yang dipilih harus sudah tercatat dipegang pegawai tersebut di menu Pegawai.
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-md shadow-gray-200/50 border border-gray-200/80 p-6 sm:p-8">
        <h2 class="text-base font-bold text-[#14315C] mb-5 tracking-tight flex items-center gap-2">
            <svg class="w-4 h-4 text-[#C89B3C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
            Tambah Penugasan Pengelola Baru
        </h2>
        
        <form method="POST" action="{{ route('admin.pengelola.store') }}" class="space-y-5">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Aset</label>
                    <select name="aset_id" required class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all">
                        <option value="">- Pilih Aset -</option>
                        @foreach ($asets as $a)
                            <option value="{{ $a->id }}">{{ $a->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Pegawai (Pengelola)</label>
                    <select name="pegawai_id" required class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all">
                        <option value="">- Pilih Pegawai -</option>
                        @foreach ($pegawais as $p)
                            <option value="{{ $p->id }}">{{ $p->nama }}{{ $p->asal === 'Eksternal' ? ' (Eksternal)' : '' }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Bagian / Kapasitas (Opsional)</label>
                    <select name="bagian_id" class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all">
                        <option value="">- Tidak spesifik -</option>
                        @foreach ($bagians as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_bagian }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-600 uppercase tracking-wider">Keterangan (Opsional)</label>
                    <input type="text" name="keterangan" placeholder="Mis. Menangani keuangan & pembukuan" class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all">
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="px-6 py-3 bg-[#14315C] text-white text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-[#0c203d] transition-all shadow-md shadow-blue-900/10">
                    + Tambahkan Pengelola
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-3xl shadow-md shadow-gray-200/50 border border-gray-200/80 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-slate-50/50 flex items-center justify-between">
            <h3 class="text-xs font-bold text-[#14315C] uppercase tracking-wider">Daftar Pengelola Aset</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100 text-xs">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-6 py-3.5 text-left font-bold text-gray-500 uppercase tracking-wider">Aset</th>
                        <th class="px-6 py-3.5 text-left font-bold text-gray-500 uppercase tracking-wider">Pengelola</th>
                        <th class="px-6 py-3.5 text-left font-bold text-gray-500 uppercase tracking-wider">Bagian</th>
                        <th class="px-6 py-3.5 text-left font-bold text-gray-500 uppercase tracking-wider">Keterangan</th>
                        <th class="px-6 py-3.5 text-right font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse ($pengelola as $p)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-6 py-4 font-bold text-[#14315C] text-sm">{{ $p->aset->nama ?? '-' }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-800">
                                {{ $p->pegawai->nama ?? '-' }}
                                @if(isset($p->pegawai->asal) && $p->pegawai->asal === 'Eksternal')
                                    <span class="ml-1.5 px-2 py-0.5 rounded-md text-[9px] font-extrabold bg-amber-50 text-amber-700 border border-amber-200 uppercase">Eksternal</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($p->bagian)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-[10px] font-bold bg-blue-50 text-[#14315C] border border-blue-100">
                                        {{ $p->bagian->nama_bagian }}
                                    </span>
                                @else
                                    <span class="text-gray-400 italic">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $p->keterangan ?? '-' }}</td>
                            <td class="px-6 py-4 text-right">
                                <form method="POST" action="{{ route('admin.pengelola.destroy', $p) }}" class="inline-block" onsubmit="return confirm('Lepas pengelola ini dari aset?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs font-bold text-rose-600 hover:text-rose-800 bg-rose-50 px-3.5 py-1.5 rounded-xl border border-rose-100 transition-colors">Lepas</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400 text-xs italic">Belum ada data penugasan pengelola aset.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection