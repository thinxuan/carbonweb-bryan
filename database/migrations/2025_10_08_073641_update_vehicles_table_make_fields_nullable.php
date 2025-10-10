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
            $table->string('model')->nullable()->change();
            $table->year('year')->nullable()->change();
            $table->string('license_plate')->nullable()->change();
            $table->foreignId('location_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('model')->nullable(false)->change();
            $table->year('year')->nullable(false)->change();
            $table->string('license_plate')->nullable(false)->change();
            $table->foreignId('location_id')->nullable(false)->change();
        });
    }
};
