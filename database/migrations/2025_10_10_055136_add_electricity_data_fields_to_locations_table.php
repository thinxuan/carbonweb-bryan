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
            $table->boolean('electricity_data_added')->default(false)->after('natural_gas_unit');
            $table->decimal('electricity_amount', 10, 2)->nullable()->after('electricity_data_added');
            $table->string('electricity_unit')->nullable()->after('electricity_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn(['electricity_data_added', 'electricity_amount', 'electricity_unit']);
        });
    }
};
