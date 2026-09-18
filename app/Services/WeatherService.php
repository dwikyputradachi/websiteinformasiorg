<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherService
{
    // Open-Meteo: gratis, tanpa API key, cukup kirim latitude & longitude.
    // Dokumentasi: https://open-meteo.com/en/docs
    private const BASE_URL = 'https://api.open-meteo.com/v1/forecast';

    // Pemetaan kode cuaca WMO (dipakai Open-Meteo) ke label & ikon Indonesia.
    // Referensi kode: https://open-meteo.com/en/docs#weathervariables
    private const KODE_CUACA = [
        0 => ['label' => 'Cerah', 'icon' => 'sun', 'cocok' => true],
        1 => ['label' => 'Cerah Berawan', 'icon' => 'sun-cloud', 'cocok' => true],
        2 => ['label' => 'Berawan Sebagian', 'icon' => 'sun-cloud', 'cocok' => true],
        3 => ['label' => 'Mendung', 'icon' => 'cloud', 'cocok' => true],
        45 => ['label' => 'Berkabut', 'icon' => 'cloud', 'cocok' => true],
        48 => ['label' => 'Berkabut', 'icon' => 'cloud', 'cocok' => true],
        51 => ['label' => 'Gerimis Ringan', 'icon' => 'rain', 'cocok' => false],
        53 => ['label' => 'Gerimis', 'icon' => 'rain', 'cocok' => false],
        55 => ['label' => 'Gerimis Lebat', 'icon' => 'rain', 'cocok' => false],
        61 => ['label' => 'Hujan Ringan', 'icon' => 'rain', 'cocok' => false],
        63 => ['label' => 'Hujan', 'icon' => 'rain', 'cocok' => false],
        65 => ['label' => 'Hujan Lebat', 'icon' => 'rain', 'cocok' => false],
        80 => ['label' => 'Hujan Sebentar', 'icon' => 'rain', 'cocok' => false],
        81 => ['label' => 'Hujan Sebentar Lebat', 'icon' => 'rain', 'cocok' => false],
        82 => ['label' => 'Hujan Deras', 'icon' => 'rain', 'cocok' => false],
        95 => ['label' => 'Badai Petir', 'icon' => 'storm', 'cocok' => false],
        96 => ['label' => 'Badai Petir & Hujan Es', 'icon' => 'storm', 'cocok' => false],
        99 => ['label' => 'Badai Petir & Hujan Es Lebat', 'icon' => 'storm', 'cocok' => false],
    ];

    /**
     * Ambil cuaca saat ini untuk satu titik koordinat.
     * Return null kalau gagal (API down, dsb) - halaman tetap harus jalan tanpa cuaca.
     */
    public function ambilCuacaSaatIni(float $latitude, float $longitude): ?array
    {
        $cacheKey = "cuaca:{$latitude}:{$longitude}";

        return Cache::remember($cacheKey, now()->addMinutes(30), function () use ($latitude, $longitude) {
            try {
                $response = Http::timeout(5)->get(self::BASE_URL, [
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'current_weather' => true,
                    'timezone' => 'Asia/Jakarta',
                ]);

                if (! $response->successful()) {
                    return null;
                }

                $cuaca = $response->json('current_weather');
                if (! $cuaca) {
                    return null;
                }

                $kode = (int) ($cuaca['weathercode'] ?? 0);
                $info = self::KODE_CUACA[$kode] ?? ['label' => 'Tidak diketahui', 'icon' => 'cloud', 'cocok' => true];

                return [
                    'suhu' => round($cuaca['temperature'] ?? 0),
                    'kecepatan_angin' => $cuaca['windspeed'] ?? null,
                    'label' => $info['label'],
                    'icon' => $info['icon'],
                    'cocok_kunjungan' => $info['cocok'],
                ];
            } catch (\Throwable $e) {
                Log::warning('Gagal ambil data cuaca: ' . $e->getMessage());

                return null;
            }
        });
    }
}
