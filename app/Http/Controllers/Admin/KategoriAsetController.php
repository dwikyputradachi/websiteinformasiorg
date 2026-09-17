<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\KategoriAset;
use Illuminate\Http\Request;

class KategoriAsetController extends Controller
{
    public function index()
    {
        $kategoris = KategoriAset::withCount('asetUtama')->orderBy('nama_kategori')->get();

        return view('admin.kategoris.index', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        $kategori = KategoriAset::create($data);
        ActivityLog::catat('menambah', 'kategori_aset', $kategori->id);

        return back()->with('status', 'Kategori berhasil ditambahkan.');
    }

    public function destroy(KategoriAset $kategori)
    {
        if ($kategori->asetUtama()->exists()) {
            return back()->withErrors('Kategori masih memiliki aset di dalamnya.');
        }

        $id = $kategori->id;
        $kategori->delete();
        ActivityLog::catat('menghapus', 'kategori_aset', $id);

        return back()->with('status', 'Kategori berhasil dihapus.');
    }
}
