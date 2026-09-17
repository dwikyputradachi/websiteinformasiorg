<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aset extends Model
{
    protected $fillable = [
        'nama', 'deskripsi', 'alamat_lokasi', 'koordinat_gis', 'status_operasional',
        'kategori_id', 'parent_id', 'link_bfast',
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
}
