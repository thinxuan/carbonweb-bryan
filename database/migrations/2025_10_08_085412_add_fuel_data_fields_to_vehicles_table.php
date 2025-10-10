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
        Schema::table('vehicles', function (Blueprint $table) {
            $table->boolean('fuel_data_added')->default(false)->after('vehicle_icon');
            $table->decimal('fuel_amount', 10, 2)->nullable()->after('fuel_data_added');
            $table->string('fuel_unit', 20)->nullable()->after('fuel_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn(['fuel_data_added', 'fuel_amount', 'fuel_unit']);
        });
    }
};
