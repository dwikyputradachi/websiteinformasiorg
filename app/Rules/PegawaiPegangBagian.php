<?php

namespace App\Rules;

use App\Models\Pegawai;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PegawaiPegangBagian implements ValidationRule
{
    public function __construct(private ?int $pegawaiId, private ?int $bagianId)
    {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $this->pegawaiId || ! $this->bagianId) {
            return;
        }

        $pegawai = Pegawai::find($this->pegawaiId);
        if (! $pegawai) {
            return;
        }

        if (! $pegawai->bagian()->where('bagians.id', $this->bagianId)->exists()) {
            $fail("{$pegawai->nama} belum tercatat memegang bagian ini di data pegawai. Tambahkan bagiannya dulu di menu Pegawai, atau kosongkan bagian pengelolaan ini.");
        }
    }
}
