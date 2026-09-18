<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'judul', 
        'deskripsi', 
        'foto',      // Sesuai struktur lama
        'is_active', // Sesuai struktur lama
    ];
}