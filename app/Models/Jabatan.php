<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jabatan extends Model
{
    protected $fillable = ['nama_jabatan', 'priority'];

    public function pegawais(): HasMany
    {
        return $this->hasMany(Pegawai::class);
    }
}
