<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\KategoriAset;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    public function kategoriIndex()
    {
        $kategoris = KategoriAset::withCount('asetUtama')->orderBy('nama_kategori')->get();
        if (request()->routeIs('kawasan')) {
            return view('pages.kawasan', compact('kategoris'));
        }

        return view('home', compact('kategoris'));
    }

    public function index(Request $request, KategoriAset $kategori)
    {
        $query = $kategori->asetUtama()->withCount('fasilitas');

        if ($request->filled('q')) {
            $query->where('nama', 'like', '%' . $request->q . '%');
        }

        $asets = $query->get();

        return view('pages.aset-index', compact('kategori', 'asets'));
    }

    public function show(Aset $aset)
    {
        $aset->load([
            'fasilitas',
            'children' => fn ($q) => $q->withCount('fasilitas'),
            'kategori',
            'parent',
        ]);

        $pengelola = \App\Models\AsetPengelola::where('aset_id', $aset->id)
            ->with(['pegawai.jabatan', 'bagian'])
            ->get();

        return view('pages.kawasan-detail', compact('aset', 'pengelola'));
    }
}
