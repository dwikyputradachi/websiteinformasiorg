<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fasilitas extends Model
{
    protected $fillable = ['nama', 'deskripsi', 'foto', 'aset_id'];

    public function aset(): BelongsTo
    {
        return $this->belongsTo(Aset::class);
    }
}
