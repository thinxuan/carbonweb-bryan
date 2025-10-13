<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'latitude',
        'longitude',
        'description',
        'natural_gas_data_added',
        'natural_gas_amount',
        'natural_gas_unit',
        'electricity_data_added',
        'electricity_amount',
        'electricity_unit',
        'electricity_calculation_method',
        'heat_steam_data_added',
        'heat_steam_amount',
        'heat_steam_unit',
        'heat_steam_calculation_method',
        'purchased_cooling_data_added',
        'purchased_cooling_amount',
        'purchased_cooling_unit',
        'purchased_cooling_method',
        'purchased_cooling_calculation_method',
        'sub_category',
        'primary',
        'gross',
        'unit',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'natural_gas_data_added' => 'boolean',
        'electricity_data_added' => 'boolean',
        'heat_steam_data_added' => 'boolean',
        'purchased_cooling_data_added' => 'boolean',
    ];

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    public function equipment(): HasMany
    {
        return $this->hasMany(Equipment::class);
    }
}
