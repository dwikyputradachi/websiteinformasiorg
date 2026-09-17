<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Aset;
use App\Models\KategoriAset;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    public function index()
    {
        $asets = Aset::with(['kategori', 'parent'])->orderBy('nama')->get();
        $kategoris = KategoriAset::orderBy('nama_kategori')->get();
        $asetIndukPilihan = Aset::whereNull('parent_id')->orderBy('nama')->get();

        return view('admin.asets.index', compact('asets', 'kategoris', 'asetIndukPilihan'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'alamat_lokasi' => 'nullable|string|max:255',
            'koordinat_gis' => 'nullable|string|max:255',
            'status_operasional' => 'required|in:Aktif,Renovasi,Tidak Aktif',
            'kategori_id' => 'nullable|exists:kategori_asets,id',
            'parent_id' => 'nullable|exists:asets,id',
            'link_bfast' => 'nullable|url',
        ]);

        $aset = Aset::create($data);
        ActivityLog::catat('menambah', 'aset', $aset->id);

        return back()->with('status', 'Aset berhasil ditambahkan.');
    }

    public function destroy(Aset $aset)
    {
        if ($aset->children()->exists() || $aset->fasilitas()->exists()) {
            return back()->withErrors('Aset masih memiliki sub-unit atau fasilitas. Hapus/pindahkan dahulu.');
        }

        $id = $aset->id;
        $aset->delete();
        ActivityLog::catat('menghapus', 'aset', $id);

        return back()->with('status', 'Aset berhasil dihapus.');
    }
}
