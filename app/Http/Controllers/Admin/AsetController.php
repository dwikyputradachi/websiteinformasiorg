<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Aset;
use App\Models\KategoriAset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AsetController extends Controller
{
    public function index()
    {
        $asets = Aset::with(['kategori', 'parent', 'fotos'])->orderBy('nama')->get();
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
            'link_bfast' => 'nullable|url',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi foto
            'galeri.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 1. TANGKAP FOTO UTAMA SEBELUM CREATE
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('asets', 'public');
        }

        // 2. SIMPAN KE DATABASE
        $aset = Aset::create($data);

        // 3. TANGKAP GALERI FOTO (Jika ada)
        if ($request->hasFile('galeri')) {
            $files = array_slice($request->file('galeri'), 0, 5); // Ambil maks 5
            foreach ($files as $file) {
                $path = $file->store('aset-galeri', 'public');
                $aset->fotos()->create(['foto' => $path]);
            }
        }
        dd($request->all(), $request->hasFile('foto'));
        ActivityLog::catat('menambah', 'aset', $aset->id);

        return redirect()->route('admin.asets.index')->with('status', 'Aset berhasil ditambahkan.');
    }

    public function destroy(Aset $aset)
    {
        if ($aset->children()->exists() || $aset->fasilitas()->exists()) {
            return back()->withErrors('Aset masih memiliki sub-unit atau fasilitas. Hapus/pindahkan dahulu.');
        }

        // Hapus file foto utama fisik jika ada
        if ($aset->foto && Storage::disk('public')->exists($aset->foto)) {
            Storage::disk('public')->delete($aset->foto);
        }

        // Hapus file foto galeri fisik & record relasinya
        foreach ($aset->fotos as $fotoGaleri) {
            if (Storage::disk('public')->exists($fotoGaleri->foto)) {
                Storage::disk('public')->delete($fotoGaleri->foto);
            }
            $fotoGaleri->delete();
        }

        $id = $aset->id;
        $aset->delete();
        ActivityLog::catat('menghapus', 'aset', $id);

        return back()->with('status', 'Aset beserta seluruh fotonya berhasil dihapus.');
    }
    public function edit(Aset $aset)
    {
        $kategoris = KategoriAset::orderBy('nama_kategori')->get();
        return view('admin.asets.edit', compact('aset', 'kategoris'));
    }

    public function update(Request $request, Aset $aset)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'alamat_lokasi' => 'nullable|string|max:255',
            'koordinat_gis' => 'nullable|string|max:255',
            'status_operasional' => 'required|in:Aktif,Renovasi,Tidak Aktif',
            'kategori_id' => 'nullable|exists:kategori_asets,id',
            'link_bfast' => 'nullable|url',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'galeri.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Jika ada unggahan foto utama baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($aset->foto && Storage::disk('public')->exists($aset->foto)) {
                Storage::disk('public')->delete($aset->foto);
            }
            $data['foto'] = $request->file('foto')->store('asets', 'public');
        }

        $aset->update($data);

        // Tambahan galeri baru jika diunggah (maksimal total 5 atau tambah batch baru)
        if ($request->hasFile('galeri')) {
            $files = array_slice($request->file('galeri'), 0, 5);
            foreach ($files as $file) {
                $path = $file->store('aset-galeri', 'public');
                $aset->fotos()->create(['foto' => $path]);
            }
        }

        ActivityLog::catat('memperbarui', 'aset', $aset->id);

        return redirect()->route('admin.asets.index')->with('status', 'Aset berhasil diperbarui.');
    }
}