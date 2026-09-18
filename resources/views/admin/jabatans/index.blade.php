@extends('layouts.admin')
@section('title', 'Admin · Posisi Jabatan')

@section('content')
<div class="space-y-8">
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-200/80 shadow-md shadow-gray-200/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-[#14315C] tracking-tight mt-0.5">Posisi Jabatan</h1>
            <p class="text-xs sm:text-sm text-gray-500 font-medium mt-1">
                Atur level hierarki dan nama posisi jabatan untuk struktur kepegawaian.
            </p>
        </div>
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-slate-50 border border-gray-200/80 rounded-2xl">
            <span class="text-xs font-bold text-[#14315C]">Total Jabatan: {{ $jabatans->count() }} level</span>
        </div>
    </div>

    <!-- FORM TAMBAH JABATAN -->
    <div class="bg-white rounded-3xl shadow-md shadow-gray-200/50 border border-gray-200/80 p-6 sm:p-8">
        <h2 class="text-base font-semibold text-[#14315C] mb-5 tracking-tight flex items-center gap-2">
            <svg class="w-4 h-4 text-[#C89B3C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
            Tambah Level Jabatan Baru
        </h2>
        
        <form method="POST" action="{{ route('admin.jabatans.store') }}" class="space-y-5">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Jabatan</label>
                    <input type="text" name="nama_jabatan" required class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all" placeholder="Contoh: Kepala Divisi Aset">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider">Priority (1 = Paling Atas)</label>
                    <input type="number" name="priority" min="1" max="99" value="99" required class="w-full bg-slate-50 border border-gray-200/80 rounded-xl px-3.5 py-2.5 text-xs text-gray-800 focus:ring-2 focus:ring-[#14315C] focus:bg-white outline-none transition-all" placeholder="Contoh: 1">
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="px-6 py-3 bg-[#14315C] text-white text-xs font-semibold uppercase tracking-wider rounded-xl hover:bg-[#0c203d] transition-all shadow-md shadow-blue-900/10">
                    + Tambah Jabatan
                </button>
            </div>
        </form>
    </div>

    <!-- TABEL DAFTAR JABATAN -->
    <div class="bg-white rounded-3xl shadow-md shadow-gray-200/50 border border-gray-200/80 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-slate-50/50 flex items-center justify-between">
            <h3 class="text-xs font-semibold text-[#14315C] uppercase tracking-wider">Daftar Level Jabatan</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100 text-xs">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-6 py-3.5 text-left font-semibold text-gray-500 uppercase tracking-wider">Nama Jabatan</th>
                        <th class="px-6 py-3.5 text-left font-semibold text-gray-500 uppercase tracking-wider">Priority Level</th>
                        <th class="px-6 py-3.5 text-right font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse ($jabatans as $j)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-6 py-4 font-semibold text-[#14315C] text-sm">{{ $j->nama_jabatan }}</td>
                            <td class="px-6 py-4 font-semibold text-[#C89B3C]">Level {{ $j->priority }}</td>
                            <td class="px-6 py-4 text-right">
                                <form method="POST" action="{{ route('admin.jabatans.destroy', $j) }}" class="inline-block" onsubmit="return confirm('Hapus jabatan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs font-semibold text-rose-600 hover:text-rose-800 bg-rose-50 px-3.5 py-1.5 rounded-xl border border-rose-100 transition-colors">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-10 text-center text-gray-400 text-xs italic">Belum ada data jabatan tercatat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection