<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    // FR-02: struktur organisasi interaktif, berbasis rantai atasan_id.
    // Root = pegawai tanpa atasan (biasanya Direktur). Kalau ada lebih dari satu
    // root secara tidak sengaja, semuanya tetap ditampilkan berdampingan.
    public function struktur()
    {
        $roots = Pegawai::bupa()->whereNull('atasan_id')->with('jabatan')->orderBy('nama')->get();

        return view('struktur', compact('roots'));
    }

    // FR-03/FR-04 diperluas: klik profil menampilkan bagian yang dipegang,
    // aset yang dikelola, dan daftar bawahan - semua pegawai tetap masuk struktur.
    public function show(Pegawai $pegawai)
    {
        $pegawai->load(['jabatan', 'atasan', 'bagian', 'bawahan.jabatan']);

        $asetDikelola = \App\Models\AsetPengelola::where('pegawai_id', $pegawai->id)
            ->with(['aset.kategori', 'bagian'])
            ->get();

        return view('pegawai.show', compact('pegawai', 'asetDikelola'));
    }

    public function search(Request $request)
    {
        $q = $request->query('q');
        $pegawais = $q ? Pegawai::where('nama', 'like', "%{$q}%")->with('jabatan')->get() : collect();

        return view('pegawai.search', compact('q', 'pegawais'));
    }
}
