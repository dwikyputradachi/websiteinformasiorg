<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('foto')->nullable();
            $table->string('kontak')->nullable();
            $table->enum('asal', ['BUPA', 'Eksternal'])->default('BUPA');
            $table->foreignId('jabatan_id')->constrained('jabatans')->cascadeOnDelete();
            // atasan_id: rantai pelaporan (Direktur = null). Ini yang membentuk cabang org chart,
            // bukan priority - dua Wadir otomatis jadi dua cabang karena sama-sama atasan_id = Direktur.
            $table->foreignId('atasan_id')->nullable()->constrained('pegawais')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
