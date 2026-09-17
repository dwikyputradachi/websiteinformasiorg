<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function struktur()
{
        $roots = Pegawai::where('asal', 'BUPA')
            ->whereNull('atasan_id')
            ->with(['jabatan', 'bawahan' => function($query) {
                $query->where('asal', 'BUPA')->orderBy('nama');
            }])
            ->orderBy('nama')
            ->get();

        return view('pages.struktur', compact('roots'));
    }

    public function show(Pegawai $pegawai)
    {
        $pegawai->load(['jabatan', 'atasan', 'bagian', 'bawahan.jabatan']);

        $asetDikelola = \App\Models\AsetPengelola::where('pegawai_id', $pegawai->id)
            ->with(['aset.kategori', 'bagian'])
            ->get();

        return view('pages.pegawai', compact('pegawai', 'asetDikelola'));
    }

    public function search(Request $request)
    {
        $q = $request->query('q');
        $pegawais = $q ? Pegawai::where('nama', 'like', "%{$q}%")->with('jabatan')->get() : collect();

        return view('pages.pencarian', compact('q', 'pegawais'));
    }
}
