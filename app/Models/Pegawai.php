<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pegawai extends Model
{
    protected $fillable = ['nama', 'foto', 'kontak', 'asal', 'jabatan_id', 'atasan_id'];

    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function atasan(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'atasan_id');
    }

    public function bawahan(): HasMany
    {
        return $this->hasMany(Pegawai::class, 'atasan_id')->with('jabatan')->orderBy('nama');
    }

    public function bagian(): BelongsToMany
    {
        return $this->belongsToMany(Bagian::class, 'pegawai_bagian');
    }

    public function asetDikelola(): BelongsToMany
    {
        return $this->belongsToMany(Aset::class, 'aset_pengelola')
            ->withPivot('bagian_id', 'keterangan')
            ->withTimestamps();
    }

    public function scopeBupa($query)
    {
        return $query->where('asal', 'BUPA');
    }
}
