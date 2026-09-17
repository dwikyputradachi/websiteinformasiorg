<?php

namespace App\Rules;

use App\Models\Pegawai;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

// Saran dari review Gemini: saat admin menugaskan pegawai jadi pengelola aset dalam
// kapasitas bagian tertentu (mis. "Keuangan"), pastikan pegawai itu memang tercatat
// memegang bagian tersebut di tabel pegawai_bagian - supaya data konsisten.
class PegawaiPegangBagian implements ValidationRule
{
    public function __construct(private ?int $pegawaiId, private ?int $bagianId)
    {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $this->pegawaiId || ! $this->bagianId) {
            return; // bagian_id opsional; kalau kosong, lewati validasi ini
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
