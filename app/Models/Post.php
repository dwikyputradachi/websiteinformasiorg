<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'thumbnail',
        'content',
        'aset_id',
        'created_by',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function aset()
    {
        return $this->belongsTo(Aset::class, 'aset_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}