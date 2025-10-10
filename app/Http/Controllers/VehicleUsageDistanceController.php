<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleUsageDistanceController extends Controller
{
    /**
     * Display the Vehicle Usage Distance page.
     */
    public function index()
    {
        $vehicles = Vehicle::all();
        $vehiclesNeedingData = $vehicles->where('distance_data_added', false);
        $vehiclesCompleted = $vehicles->where('distance_data_added', true);

        return view('admin.scope1.vehicle-usage-distance', compact('vehiclesNeedingData', 'vehiclesCompleted'));
    }

    /**
     * Store vehicle distance usage data.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'distance_amount' => 'required|numeric|min:0',
            'distance_unit' => 'required|string|in:kilometer,mile',
        ]);

        $vehicle = Vehicle::findOrFail($validated['vehicle_id']);

        $vehicle->update([
            'distance_data_added' => true,
            'distance_amount' => $validated['distance_amount'],
            'distance_unit' => $validated['distance_unit'],
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Vehicle distance data saved successfully',
                'vehicle' => $vehicle
            ]);
        }

        return redirect()->back()->with('success', 'Vehicle distance data saved successfully.');
    }
}
