<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleUsageFuelController extends Controller
{
    /**
     * Display the Vehicle Usage Fuel page.
     */
    public function index()
    {
        $vehicles = Vehicle::all();
        $vehiclesNeedingData = $vehicles->where('fuel_data_added', false);
        $vehiclesCompleted = $vehicles->where('fuel_data_added', true);

        return view('account.scope1.vehicle-usage-fuel', compact('vehiclesNeedingData', 'vehiclesCompleted'));
    }

    /**
     * Store vehicle fuel usage data.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'fuel_type' => 'required|string|in:gasoline,diesel,propane,natural_gas,electricity,coal_industrial,other',
            'fuel_amount' => 'required|numeric|min:0',
            'fuel_unit' => 'required|string|in:liter,gallon,kilogram,pound,cubic_meter,cubic_feet,kwh',
        ]);

        // Find the vehicle and update it
        $vehicle = Vehicle::findOrFail($validated['vehicle_id']);

        // Update the vehicle with fuel data
        $vehicle->update([
            'fuel_data_added' => true,
            'fuel_type' => $validated['fuel_type'],
            'fuel_amount' => $validated['fuel_amount'],
            'fuel_unit' => $validated['fuel_unit'],
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Vehicle fuel data saved successfully',
                'vehicle' => $vehicle
            ]);
        }

        return redirect()->back()->with('success', 'Vehicle fuel data saved successfully.');
    }
}
