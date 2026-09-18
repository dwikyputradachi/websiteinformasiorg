<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsetFoto extends Model
{
    protected $table = 'aset_fotos';
    protected $guarded = ['id'];

    public function aset()
    {
        return $this->belongsTo(Aset::class, 'aset_id');
    }
}