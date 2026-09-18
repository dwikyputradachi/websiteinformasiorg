<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aset_pengelola', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aset_id')->constrained('asets')->cascadeOnDelete();
            $table->foreignId('pegawai_id')->constrained('pegawais')->cascadeOnDelete();
            $table->foreignId('bagian_id')->nullable()->constrained('bagians')->nullOnDelete();
            $table->string('keterangan')->nullable();
            $table->timestamps();
            $table->unique(['aset_id', 'pegawai_id', 'bagian_id'], 'aset_pengelola_unik');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aset_pengelola');
    }
};
