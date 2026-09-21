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
        'jam_operasional', 
        'kontak_cs',       
        'is_outdoor',      
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

    public function children(): HasMany
    {
        return $this->hasMany(Aset::class, 'parent_id');
    }

    public function fasilitas(): HasMany
    {
        return $this->hasMany(Fasilitas::class);
    }

    public function pengelola(): BelongsToMany
    {
        return $this->belongsToMany(Pegawai::class, 'aset_pengelola')
            ->withPivot('bagian_id', 'keterangan')
            ->withTimestamps();
    }

    public function isOutdoor(): bool
    {
        return (bool) $this->is_outdoor;
    }
    public function fotos()
    {
        return $this->hasMany(AsetFoto::class, 'aset_id');
    }
}
