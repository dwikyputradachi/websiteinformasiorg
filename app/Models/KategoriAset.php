<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriAset extends Model
{
    protected $fillable = ['nama_kategori', 'deskripsi'];

    public function asetUtama(): HasMany
    {
        return $this->hasMany(Aset::class, 'kategori_id')->whereNull('parent_id');
    }
}
