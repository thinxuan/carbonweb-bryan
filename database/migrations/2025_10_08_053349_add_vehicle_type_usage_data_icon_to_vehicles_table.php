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
            $table->string('vehicle_type')->nullable()->after('notes');
            $table->string('usage_data_type')->nullable()->after('vehicle_type');
            $table->string('vehicle_icon')->nullable()->after('usage_data_type');
            $table->dropForeign(['location_id']);
            $table->foreignId('location_id')->nullable()->change()->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn(['vehicle_type', 'usage_data_type', 'vehicle_icon']);
            $table->dropForeign(['location_id']);
            $table->foreignId('location_id')->change()->constrained()->onDelete('cascade');
        });
    }
};
