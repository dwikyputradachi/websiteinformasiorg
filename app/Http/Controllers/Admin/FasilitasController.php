<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Aset;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::with('aset')->orderBy('nama')->get();
        $asets = Aset::orderBy('nama')->get();

        return view('admin.fasilitas.index', compact('fasilitas', 'asets'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'aset_id' => 'required|exists:asets,id',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fasilitas', 'public');
        }

        $item = Fasilitas::create($data);
        ActivityLog::catat('menambah', 'fasilitas', $item->id);

        return back()->with('status', 'Fasilitas berhasil ditambahkan.');
    }

    public function destroy(Fasilitas $fasilita)
    {
        $id = $fasilita->id;
        $fasilita->delete();
        ActivityLog::catat('menghapus', 'fasilitas', $id);

        return back()->with('status', 'Fasilitas berhasil dihapus.');
    }
}
