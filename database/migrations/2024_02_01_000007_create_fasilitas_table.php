<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Pakan Kelinci, Gazebo, Tiket Masuk, Wi-Fi, dst - tanpa rantai sewa sendiri.
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->foreignId('aset_id')->constrained('asets')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};
