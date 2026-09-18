<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aset extends Model
{
    protected $fillable = [
        'kategori_id',
        'parent_id',
        'nama',
        'deskripsi',
        'alamat_lokasi',
        'koordinat_gis',
        'latitude',
        'longitude',
        'status_operasional',
        'foto',
        'jam_operasional', // <-- Tambahkan ini
        'kontak_cs',       // <-- Tambahkan ini
        'is_outdoor',      // <-- Tambahkan ini
        'link_bfast',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriAset::class, 'kategori_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Aset::class, 'parent_id');
    }

    // Sub-unit yang bisa disewa mandiri (Kios A, Kios B, Gerai A, dst) - punya link_bfast sendiri.
    public function children(): HasMany
    {
        return $this->hasMany(Aset::class, 'parent_id');
    }

    public function fasilitas(): HasMany
    {
        return $this->hasMany(Fasilitas::class);
    }

    // Semua pengelola aset ini beserta bagian/kapasitas & keterangan masing-masing.
    public function pengelola(): BelongsToMany
    {
        return $this->belongsToMany(Pegawai::class, 'aset_pengelola')
            ->withPivot('bagian_id', 'keterangan')
            ->withTimestamps();
    }

    // Cuaca cuma relevan buat kawasan outdoor - dipakai di AsetController buat memutuskan
    // apakah perlu panggil WeatherService atau tidak.
    public function isOutdoor(): bool
    {
        return (bool) $this->is_outdoor;
    }
    public function fotos()
    {
        return $this->hasMany(AsetFoto::class, 'aset_id');
    }
}
