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
            $table->decimal('natural_gas_amount', 10, 2)->nullable()->after('natural_gas_data_added');
            $table->string('natural_gas_unit', 20)->nullable()->after('natural_gas_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn(['natural_gas_amount', 'natural_gas_unit']);
        });
    }
};
