<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('banners', 'public');
        }

        // Default aktif saat baru di-upload
        $data['is_active'] = 1;

        $banner = Banner::create($data);
        ActivityLog::catat('menambah', 'banner', $banner->id);

        return back()->with('status', 'Banner berhasil diunggah.');
    }

    // FITUR BARU: Mengubah status Aktif / Non-Aktif
    public function toggle(Banner $banner)
    {
        $banner->is_active = !$banner->is_active;
        $banner->save();

    return back()->with('status', 'Status banner berhasil diperbarui.');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->foto && Storage::disk('public')->exists($banner->foto)) {
            Storage::disk('public')->delete($banner->foto);
        }

        $id = $banner->id;
        $banner->delete();
        ActivityLog::catat('menghapus', 'banner', $id);

        return back()->with('status', 'Banner berhasil dihapus.');
    }
}