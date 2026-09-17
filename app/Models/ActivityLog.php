<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    protected $fillable = ['user_id', 'aksi', 'tabel_terdampak', 'data_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function catat(string $aksi, string $tabel, int $dataId): void
    {
        static::create([
            'user_id' => auth()->id(),
            'aksi' => $aksi,
            'tabel_terdampak' => $tabel,
            'data_id' => $dataId,
        ]);
    }
}
