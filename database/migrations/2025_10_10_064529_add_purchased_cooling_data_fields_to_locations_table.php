<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->boolean('purchased_cooling_data_added')->default(false)->after('heat_steam_calculation_method');
            $table->decimal('purchased_cooling_amount', 10, 2)->nullable()->after('purchased_cooling_data_added');
            $table->string('purchased_cooling_unit')->nullable()->after('purchased_cooling_amount');
        });
    }

    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn(['purchased_cooling_data_added', 'purchased_cooling_amount', 'purchased_cooling_unit']);
        });
    }
};
