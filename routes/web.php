<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\EquipmentController;

Route::get('/', function () {
    return view('home');
});

Route::get('/contact', function () {
    return view('contact');
});

// Admin Dashboard Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('index');

    Route::resource('locations', LocationController::class);
    Route::get('locations/create/single', [LocationController::class, 'createSingle'])->name('locations.create.single');
    Route::get('locations/create/multiple', [LocationController::class, 'createMultiple'])->name('locations.create.multiple');

    Route::resource('vehicles', VehicleController::class);
    Route::resource('equipment', EquipmentController::class);

    // Scope 1 Routes
    Route::get('scope1/natural-gas', [App\Http\Controllers\NaturalGasController::class, 'index'])->name('scope1.natural-gas');
    Route::post('scope1/natural-gas', [App\Http\Controllers\NaturalGasController::class, 'store'])->name('scope1.natural-gas.store');
    Route::get('scope1/vehicle-usage-fuel', [App\Http\Controllers\VehicleUsageFuelController::class, 'index'])->name('scope1.vehicle-usage-fuel');
    Route::post('scope1/vehicle-usage-fuel', [App\Http\Controllers\VehicleUsageFuelController::class, 'store'])->name('scope1.vehicle-usage-fuel.store');
    Route::get('scope1/vehicle-usage-distance', [App\Http\Controllers\VehicleUsageDistanceController::class, 'index'])->name('scope1.vehicle-usage-distance');
    Route::post('scope1/vehicle-usage-distance', [App\Http\Controllers\VehicleUsageDistanceController::class, 'store'])->name('scope1.vehicle-usage-distance.store');
    Route::get('scope1/fuel-consumption-equipment', [App\Http\Controllers\FuelConsumptionEquipmentController::class, 'index'])->name('scope1.fuel-consumption-equipment');
    Route::post('scope1/fuel-consumption-equipment', [App\Http\Controllers\FuelConsumptionEquipmentController::class, 'store'])->name('scope1.fuel-consumption-equipment.store');
});
