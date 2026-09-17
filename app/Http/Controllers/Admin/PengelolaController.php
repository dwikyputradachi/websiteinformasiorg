<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Aset;
use App\Models\AsetPengelola;
use App\Models\Bagian;
use App\Models\Pegawai;
use App\Rules\PegawaiPegangBagian;
use Illuminate\Http\Request;

class PengelolaController extends Controller
{
    // Menugaskan pegawai (BUPA atau eksternal) sebagai pengelola sebuah aset,
    // dalam kapasitas bagian tertentu. Satu aset bisa punya banyak baris pengelola sekaligus.
    public function index()
    {
        $pengelola = AsetPengelola::with(['aset', 'pegawai', 'bagian'])->latest()->get();
        $asets = Aset::orderBy('nama')->get();
        $pegawais = Pegawai::orderBy('nama')->get();
        $bagians = Bagian::orderBy('nama_bagian')->get();

        return view('admin.pengelola.index', compact('pengelola', 'asets', 'pegawais', 'bagians'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'aset_id' => 'required|exists:asets,id',
            'pegawai_id' => 'required|exists:pegawais,id',
            'bagian_id' => ['nullable', 'exists:bagians,id', new PegawaiPegangBagian(
                $request->integer('pegawai_id'),
                $request->filled('bagian_id') ? $request->integer('bagian_id') : null
            )],
            'keterangan' => 'nullable|string|max:255',
        ]);

        $item = AsetPengelola::create($data);
        ActivityLog::catat('menambah', 'aset_pengelola', $item->id);

        return back()->with('status', 'Pengelola berhasil ditambahkan ke aset.');
    }

    public function destroy(AsetPengelola $pengelola)
    {
        $id = $pengelola->id;
        $pengelola->delete();
        ActivityLog::catat('menghapus', 'aset_pengelola', $id);

        return back()->with('status', 'Pengelola berhasil dilepas dari aset.');
    }
}
