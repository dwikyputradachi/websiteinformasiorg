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

    // Dipakai untuk render org chart secara rekursif (lazy per-node, dipanggil dari Blade).
    // Dua orang dengan atasan_id sama otomatis jadi dua cabang terpisah di chart -
    // priority di tabel jabatan cuma dipakai untuk urutan/label, bukan penentu percabangan.
    public function bawahan(): HasMany
    {
        return $this->hasMany(Pegawai::class, 'atasan_id')->with('jabatan')->orderBy('nama');
    }

    public function bagian(): BelongsToMany
    {
        return $this->belongsToMany(Bagian::class, 'pegawai_bagian');
    }

    // Aset yang dikelola pegawai ini, beserta bagian/kapasitas & keterangan dari pivot aset_pengelola.
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
