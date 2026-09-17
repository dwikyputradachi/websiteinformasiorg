<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Bagian;
use Illuminate\Http\Request;

class BagianController extends Controller
{
    public function index()
    {
        $bagians = Bagian::withCount('pegawais')->orderBy('nama_bagian')->get();

        return view('admin.bagians.index', compact('bagians'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(['nama_bagian' => 'required|string|max:255|unique:bagians,nama_bagian']);

        $bagian = Bagian::create($data);
        ActivityLog::catat('menambah', 'bagian', $bagian->id);

        return back()->with('status', 'Bagian berhasil ditambahkan.');
    }

    public function destroy(Bagian $bagian)
    {
        if ($bagian->pegawais()->exists()) {
            return back()->withErrors('Bagian masih dipegang oleh pegawai.');
        }

        $id = $bagian->id;
        $bagian->delete();
        ActivityLog::catat('menghapus', 'bagian', $id);

        return back()->with('status', 'Bagian berhasil dihapus.');
    }
}
