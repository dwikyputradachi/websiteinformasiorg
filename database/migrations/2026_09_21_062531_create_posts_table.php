<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('category', ['Kegiatan', 'Informasi', 'Pengumuman', 'Pengelolaan Area', 'Dokumentasi']);
            $table->string('thumbnail')->nullable();
            $table->longText('content');
            
            $table->foreignId('aset_id')->nullable()->constrained('asets')->onDelete('set null');
            
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            
            $table->enum('status', ['Draft', 'Published'])->default('Draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};