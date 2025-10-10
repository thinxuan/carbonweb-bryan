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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('make');
            $table->string('model');
            $table->year('year');
            $table->string('license_plate')->unique();
            $table->string('vin')->unique()->nullable();
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->string('fuel_type')->default('gasoline');
            $table->decimal('engine_size', 5, 2)->nullable();
            $table->decimal('co2_emissions', 8, 3)->nullable(); // g/km
            $table->integer('mileage')->default(0);
            $table->date('purchase_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
