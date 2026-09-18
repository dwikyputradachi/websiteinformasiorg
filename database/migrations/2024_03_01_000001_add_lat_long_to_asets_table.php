<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('asets', function (Blueprint $table) {
            if (! Schema::hasColumn('asets', 'latitude')) {
                $table->decimal('latitude', 10, 7)->nullable();
            }
            if (! Schema::hasColumn('asets', 'longitude')) {
                $table->decimal('longitude', 10, 7)->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('asets', function (Blueprint $table) {
            if (Schema::hasColumn('asets', 'latitude')) {
                $table->dropColumn('latitude');
            }
            if (Schema::hasColumn('asets', 'longitude')) {
                $table->dropColumn('longitude');
            }
        });
    }
};
