<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asets', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('alamat_lokasi')->nullable();
            $table->string('koordinat_gis')->nullable(); // link Google Maps atau "lat,long"
            $table->enum('status_operasional', ['Aktif', 'Renovasi', 'Tidak Aktif'])->default('Aktif');
            $table->foreignId('kategori_id')->nullable()->constrained('kategori_asets')->nullOnDelete();
            // parent_id: aset induk (mis. Taman Rusa) -> aset anak (mis. Kios A) yang punya link_bfast sendiri.
            $table->foreignId('parent_id')->nullable()->constrained('asets')->nullOnDelete();
            $table->string('link_bfast')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asets');
    }
};
