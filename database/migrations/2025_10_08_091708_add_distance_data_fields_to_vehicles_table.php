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
            $table->boolean('distance_data_added')->default(false)->after('fuel_unit');
            $table->decimal('distance_amount', 10, 2)->nullable()->after('distance_data_added');
            $table->string('distance_unit', 20)->nullable()->after('distance_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn(['distance_data_added', 'distance_amount', 'distance_unit']);
        });
    }
};
