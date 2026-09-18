<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('asets', function (Blueprint $table) {
            $table->string('senin')->nullable()->default('07:00 - 18:00');
            $table->string('selasa')->nullable()->default('07:00 - 18:00');
            $table->string('rabu')->nullable()->default('07:00 - 18:00');
            $table->string('kamis')->nullable()->default('07:00 - 18:00');
            $table->string('jumat')->nullable()->default('07:00 - 18:00');
            $table->string('sabtu')->nullable()->default('07:00 - 18:00');
            $table->string('minggu')->nullable()->default('07:00 - 18:00');
        });
    }

    public function down(): void
    {
        Schema::table('asets', function (Blueprint $table) {
            $table->dropColumn(['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu']);
        });
    }
};