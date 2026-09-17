<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatans = Jabatan::orderBy('priority')->get();

        return view('admin.jabatans.index', compact('jabatans'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'priority' => 'required|integer|min:1|max:99',
        ]);

        $jabatan = Jabatan::create($data);
        ActivityLog::catat('menambah', 'jabatan', $jabatan->id);

        return back()->with('status', 'Jabatan berhasil ditambahkan.');
    }

    public function destroy(Jabatan $jabatan)
    {
        if ($jabatan->pegawais()->exists()) {
            return back()->withErrors('Jabatan masih dipakai oleh pegawai.');
        }

        $id = $jabatan->id;
        $jabatan->delete();
        ActivityLog::catat('menghapus', 'jabatan', $id);

        return back()->with('status', 'Jabatan berhasil dihapus.');
    }
}
