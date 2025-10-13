<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->boolean('heat_steam_data_added')->default(false)->after('electricity_calculation_method');
            $table->decimal('heat_steam_amount', 10, 2)->nullable()->after('heat_steam_data_added');
            $table->string('heat_steam_unit')->nullable()->after('heat_steam_amount');
            $table->string('heat_steam_calculation_method')->nullable()->after('heat_steam_unit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn(['heat_steam_data_added', 'heat_steam_amount', 'heat_steam_unit', 'heat_steam_calculation_method']);
        });
    }
};
