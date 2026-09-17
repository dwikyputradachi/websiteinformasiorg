<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\KategoriAset;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    // FR-05: halaman kategori (Wisata, Sport, Agribisnis, Hunian, KPLI3, dst.)
    public function kategoriIndex()
    {
        $kategoris = KategoriAset::withCount('asetUtama')->orderBy('nama_kategori')->get();

        return view('aset.kategori_index', compact('kategoris'));
    }

    // Daftar aset utama dalam satu kategori, dengan pencarian
    public function index(Request $request, KategoriAset $kategori)
    {
        $query = $kategori->asetUtama()->withCount('fasilitas');

        if ($request->filled('q')) {
            $query->where('nama', 'like', '%' . $request->q . '%');
        }

        $asets = $query->get();

        return view('aset.index', compact('kategori', 'asets'));
    }

    // FR-06, FR-07: detail aset - fasilitas, sub-unit (kios/gerai), pengelola per bagian, link B-Fast
    public function show(Aset $aset)
    {
        $aset->load([
            'fasilitas',
            'children' => fn ($q) => $q->withCount('fasilitas'),
            'kategori',
            'parent',
        ]);

        // Diambil lewat model pivot AsetPengelola langsung (bukan relasi belongsToMany biasa)
        // supaya kita bisa eager-load bagian + jabatan pegawai untuk masing-masing baris pengelolaan.
        $pengelola = \App\Models\AsetPengelola::where('aset_id', $aset->id)
            ->with(['pegawai.jabatan', 'bagian'])
            ->get();

        return view('aset.show', compact('aset', 'pengelola'));
    }
}
