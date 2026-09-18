<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function cari(Request $request)
    {
        $q = trim($request->input('q'));

        if (!$q) {
            return redirect()->back();
        }

        $asets = Aset::with('kategori')
            ->where(function ($query) use ($q) {
                $query->where('nama', 'like', "%{$q}%")
                      ->orWhere('alamat_lokasi', 'like', "%{$q}%")
                      ->orWhere('deskripsi', 'like', "%{$q}%")
                      ->orWhereHas('kategori', function ($k) use ($q) {
                          $k->where('nama_kategori', 'like', "%{$q}%");
                      });
            })
            ->get();

        $pegawais = Pegawai::with('jabatan')
            ->where(function ($query) use ($q) {
                $query->where('nama', 'like', "%{$q}%")
                      ->orWhereHas('jabatan', function ($j) use ($q) {
                          $j->where('nama_jabatan', 'like', "%{$q}%");
                      });
            })
            ->get();

        return view('pages.pencarian', compact('asets', 'pegawais', 'q'));
    }
}