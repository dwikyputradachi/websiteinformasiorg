<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('asets', function (Blueprint $table) {
            $table->string('jam_operasional')->nullable()->after('status_operasional');
            
            $table->string('kontak_cs')->nullable()->after('jam_operasional');
            
            $table->boolean('is_outdoor')->default(true)->after('kontak_cs');
        });
    }

    public function down(): void
    {
        Schema::table('asets', function (Blueprint $table) {
            $table->dropColumn(['jam_operasional', 'kontak_cs', 'is_outdoor']);
        });
    }
};