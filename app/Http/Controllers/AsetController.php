<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Banner;
use App\Models\KategoriAset;
use App\Services\WeatherService;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    public function kategoriIndex()
    {
        $kategoris = KategoriAset::withCount('asetUtama')->orderBy('nama_kategori')->get();

        if (request()->routeIs('kawasan')) {
            return view('pages.kawasan', compact('kategoris'));
        }

        $banners = [];
        if (class_exists(Banner::class)) {
            try {
                $banners = Banner::where('is_active', true)->latest()->take(4)->get();
            } catch (\Exception $e) {
            }
        }

        return view('home', compact('kategoris', 'banners'));
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

    public function show(Aset $aset, WeatherService $weather)
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

        $cuaca = null;
        if ($aset->isOutdoor() && $aset->latitude && $aset->longitude) {
            $cuaca = $weather->ambilCuacaSaatIni((float) $aset->latitude, (float) $aset->longitude);
        }

        $allAsets = Aset::where('id', '!=', $aset->id)->where('status_operasional', 'Aktif')->get();
        $nearbyAsets = collect();

        $currentLat = $aset->latitude ?? null;
        $currentLon = $aset->longitude ?? null;

        if (!$currentLat || !$currentLon) {
            if (preg_match('/^(-?\d+(\.\d+)?),\s*(-?\d+(\.\d+)?)$/', trim($aset->koordinat_gis), $currMatch)) {
                $currentLat = (float)$currMatch[1];
                $currentLon = (float)$currMatch[3];
            }
        }

        if ($currentLat && $currentLon) {
            foreach ($allAsets as $otherAset) {
                $otherLat = $otherAset->latitude ?? null;
                $otherLon = $otherAset->longitude ?? null;

                if (!$otherLat || !$otherLon) {
                    if (preg_match('/^(-?\d+(\.\d+)?),\s*(-?\d+(\.\d+)?)$/', trim($otherAset->koordinat_gis), $othMatch)) {
                        $otherLat = (float)$othMatch[1];
                        $otherLon = (float)$othMatch[3];
                    }
                }

                if ($otherLat && $otherLon) {
                    $earthRadius = 6371; 
                    $dLat = deg2rad($otherLat - $currentLat);
                    $dLon = deg2rad($otherLon - $currentLon);
                    $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($currentLat)) * cos(deg2rad($otherLat)) * sin($dLon/2) * sin($dLon/2);
                    $c = 2 * asin(sqrt($a));
                    $distance = $earthRadius * $c;

                    $otherAset->jarak_km = round($distance, 1);
                    $nearbyAsets->push($otherAset);
                }
            }
            $nearbyAsets = $nearbyAsets->sortBy('jarak_km')->take(3);
        }

        if ($nearbyAsets->isEmpty()) {
            $nearbyAsets = Aset::where('id', '!=', $aset->id)
                               ->where('kategori_id', $aset->kategori_id)
                               ->inRandomOrder()
                               ->take(3)
                               ->get();
        }

        return view('pages.kawasan-detail', compact('aset', 'pengelola', 'cuaca', 'nearbyAsets'));
    }
}