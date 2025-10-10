<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Equipment extends Model
{
    protected $fillable = [
        'name',
        'type',
        'manufacturer',
        'equipment_icon',
        'model_number',
        'serial_number',
        'location_id',
        'vehicle_id',
        'purchase_date',
        'last_maintenance',
        'usage_hours',
        'power_consumption',
        'specifications',
        'notes',
        'fuel_consumption_data_added',
        'fuel_type',
        'fuel_consumption_amount',
        'fuel_consumption_unit',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'last_maintenance' => 'date',
        'usage_hours' => 'integer',
        'power_consumption' => 'decimal:3',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
