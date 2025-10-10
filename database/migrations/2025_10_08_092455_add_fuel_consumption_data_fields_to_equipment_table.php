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
        Schema::table('equipment', function (Blueprint $table) {
            $table->boolean('fuel_consumption_data_added')->default(false)->after('equipment_icon');
            $table->decimal('fuel_consumption_amount', 10, 2)->nullable()->after('fuel_consumption_data_added');
            $table->string('fuel_consumption_unit', 20)->nullable()->after('fuel_consumption_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipment', function (Blueprint $table) {
            $table->dropColumn(['fuel_consumption_data_added', 'fuel_consumption_amount', 'fuel_consumption_unit']);
        });
    }
};
