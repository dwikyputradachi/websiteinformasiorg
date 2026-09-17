<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AsetPengelola extends Model
{
    protected $table = 'aset_pengelola';

    protected $fillable = ['aset_id', 'pegawai_id', 'bagian_id', 'keterangan'];

    public function aset(): BelongsTo
    {
        return $this->belongsTo(Aset::class);
    }

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function bagian(): BelongsTo
    {
        return $this->belongsTo(Bagian::class);
    }
}
