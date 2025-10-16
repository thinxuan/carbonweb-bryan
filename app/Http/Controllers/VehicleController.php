<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Location;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::with('location')->latest()->paginate(10);
        return view('account.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::all();
        return view('account.vehicles.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'license_plate' => 'nullable|string|max:20|unique:vehicles',
            'vin' => 'nullable|string|max:17|unique:vehicles',
            'location_id' => 'nullable|exists:locations,id',
            'fuel_type' => 'nullable|string|max:50',
            'engine_size' => 'nullable|numeric|min:0',
            'co2_emissions' => 'nullable|numeric|min:0',
            'mileage' => 'nullable|integer|min:0',
            'purchase_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'vehicle_type' => 'nullable|string|max:255',
            'usage_data_type' => 'nullable|string|max:255',
            'vehicle_icon' => 'nullable|string|max:255',
        ]);

        // Set sensible defaults for required database fields that aren't in the form
        $validated['fuel_type'] = $validated['fuel_type'] ?? 'gasoline';
        $validated['mileage'] = $validated['mileage'] ?? 0;
        $validated['fuel_data_added'] = false;

        Vehicle::create($validated);

        return redirect()->route('account.vehicles.index')
            ->with('success', 'Vehicle created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        $vehicle->load('location', 'equipment');
        return view('account.vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        $locations = Location::all();
        return view('account.vehicles.edit', compact('vehicle', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'license_plate' => 'nullable|string|max:20|unique:vehicles,license_plate,' . $vehicle->id,
            'vin' => 'nullable|string|max:17|unique:vehicles,vin,' . $vehicle->id,
            'location_id' => 'nullable|exists:locations,id',
            'fuel_type' => 'nullable|string|max:50',
            'engine_size' => 'nullable|numeric|min:0',
            'co2_emissions' => 'nullable|numeric|min:0',
            'mileage' => 'nullable|integer|min:0',
            'purchase_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'vehicle_type' => 'nullable|string|max:255',
            'usage_data_type' => 'nullable|string|max:255',
            'vehicle_icon' => 'nullable|string|max:255',
        ]);

        // Set sensible defaults for required database fields that aren't in the form
        $validated['fuel_type'] = $validated['fuel_type'] ?? 'gasoline';
        $validated['mileage'] = $validated['mileage'] ?? 0;

        $vehicle->update($validated);

        return redirect()->route('account.vehicles.index')
            ->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('account.vehicles.index')
            ->with('success', 'Vehicle deleted successfully.');
    }
}
