<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    protected $fillable = [
        'make',
        'model',
        'year',
        'license_plate',
        'vin',
        'location_id',
        'fuel_type',
        'engine_size',
        'co2_emissions',
        'mileage',
        'purchase_date',
        'notes',
        'vehicle_type',
        'usage_data_type',
        'vehicle_icon',
        'fuel_data_added',
        'fuel_amount',
        'fuel_unit',
        'distance_data_added',
        'distance_amount',
        'distance_unit',
    ];

    protected $casts = [
        'year' => 'integer',
        'engine_size' => 'decimal:2',
        'co2_emissions' => 'decimal:3',
        'mileage' => 'integer',
        'purchase_date' => 'date',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function equipment(): HasMany
    {
        return $this->hasMany(Equipment::class);
    }
}
