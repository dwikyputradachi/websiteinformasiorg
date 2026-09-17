<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pegawai_bagian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawais')->cascadeOnDelete();
            $table->foreignId('bagian_id')->constrained('bagians')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['pegawai_id', 'bagian_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawai_bagian');
    }
};
