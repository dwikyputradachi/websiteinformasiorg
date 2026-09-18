<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Bagian;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::with(['jabatan', 'atasan', 'bagian'])->orderBy('nama')->get();
        $jabatans = Jabatan::orderBy('priority')->get();
        $bagians = Bagian::orderBy('nama_bagian')->get();
        $calonAtasan = Pegawai::orderBy('nama')->get();

        return view('admin.pegawais.index', compact('pegawais', 'jabatans', 'bagians', 'calonAtasan'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'kontak' => 'nullable|string|max:255',
            'asal' => 'required|in:BUPA,Eksternal',
            'jabatan_id' => 'required|exists:jabatans,id',
            'atasan_id' => 'nullable|exists:pegawais,id',
            'foto' => 'nullable|image|max:2048',
            'bagian_ids' => 'nullable|array',
            'bagian_ids.*' => 'exists:bagians,id',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pegawai', 'public');
        }

        $pegawai = Pegawai::create(collect($data)->except('bagian_ids')->toArray());
        $pegawai->bagian()->sync($data['bagian_ids'] ?? []);
        ActivityLog::catat('menambah', 'pegawai', $pegawai->id);

        return back()->with('status', 'Pegawai berhasil ditambahkan.');
    }

    public function edit(Pegawai $pegawai)
    {
        $jabatans = Jabatan::orderBy('priority')->get();
        $bagians = Bagian::orderBy('nama_bagian')->get();
        // Mencegah pegawai memilih dirinya sendiri sebagai atasan
        $calonAtasan = Pegawai::where('id', '!=', $pegawai->id)->orderBy('nama')->get();

        return view('admin.pegawais.edit', compact('pegawai', 'jabatans', 'bagians', 'calonAtasan'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'kontak' => 'nullable|string|max:255',
            'asal' => 'required|in:BUPA,Eksternal',
            'jabatan_id' => 'required|exists:jabatans,id',
            'atasan_id' => 'nullable|exists:pegawais,id|not_in:' . $pegawai->id,
            'foto' => 'nullable|image|max:2048',
            'bagian_ids' => 'nullable|array',
            'bagian_ids.*' => 'exists:bagians,id',
        ]);

        // Jika mengunggah foto baru
        if ($request->hasFile('foto')) {
            if ($pegawai->foto && Storage::disk('public')->exists($pegawai->foto)) {
                Storage::disk('public')->delete($pegawai->foto);
            }
            $data['foto'] = $request->file('foto')->store('pegawai', 'public');
        }

        $pegawai->update(collect($data)->except('bagian_ids')->toArray());
        $pegawai->bagian()->sync($data['bagian_ids'] ?? []);
        ActivityLog::catat('memperbarui', 'pegawai', $pegawai->id);

        return redirect()->route('admin.pegawais.index')->with('status', 'Data pegawai berhasil diperbarui.');
    }

    public function destroy(Pegawai $pegawai)
    {
        if ($pegawai->bawahan()->exists()) {
            return back()->withErrors('Pegawai ini masih membawahi orang lain. Pindahkan atasan bawahannya dahulu.');
        }

        if ($pegawai->foto && Storage::disk('public')->exists($pegawai->foto)) {
            Storage::disk('public')->delete($pegawai->foto);
        }

        $id = $pegawai->id;
        $pegawai->delete();
        ActivityLog::catat('menghapus', 'pegawai', $id);

        return back()->with('status', 'Pegawai berhasil dihapus.');
    }
}