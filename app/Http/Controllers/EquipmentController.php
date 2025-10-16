<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Location;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipment = Equipment::with(['location', 'vehicle'])->latest()->paginate(10);
        return view('account.equipment.index', compact('equipment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::all();
        $vehicles = Vehicle::all();
        return view('account.equipment.create', compact('locations', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'equipment' => 'nullable|array',
            'equipment.*' => 'string|in:equipment_a,equipment_b,equipment_c',
            'equipment_icon' => 'nullable|string|max:255',
            'model_number' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255|unique:equipment',
            'location_id' => 'nullable|exists:locations,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'purchase_date' => 'nullable|date',
            'last_maintenance' => 'nullable|date',
            'usage_hours' => 'nullable|integer|min:0',
            'power_consumption' => 'nullable|numeric|min:0',
            'specifications' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        // Convert equipment array to comma-separated string
        if (isset($validated['equipment']) && is_array($validated['equipment'])) {
            $validated['manufacturer'] = implode(',', $validated['equipment']);
            unset($validated['equipment']);
        }

        // Set default values for required fields that aren't in the form
        $validated['usage_hours'] = $validated['usage_hours'] ?? 0;

        Equipment::create($validated);

        return redirect()->route('account.equipment.index')
            ->with('success', 'Equipment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipment $equipment)
    {
        $equipment->load('location', 'vehicle');
        return view('account.equipment.show', compact('equipment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipment $equipment)
    {
        $locations = Location::all();
        $vehicles = Vehicle::all();
        return view('account.equipment.edit', compact('equipment', 'locations', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipment $equipment)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'equipment' => 'nullable|array',
            'equipment.*' => 'string|in:equipment_a,equipment_b,equipment_c',
            'equipment_icon' => 'nullable|string|max:255',
            'model_number' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255|unique:equipment,serial_number,' . $equipment->id,
            'location_id' => 'nullable|exists:locations,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'purchase_date' => 'nullable|date',
            'last_maintenance' => 'nullable|date',
            'usage_hours' => 'nullable|integer|min:0',
            'power_consumption' => 'nullable|numeric|min:0',
            'specifications' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        // Convert equipment array to comma-separated string
        if (isset($validated['equipment']) && is_array($validated['equipment'])) {
            $validated['manufacturer'] = implode(',', $validated['equipment']);
            unset($validated['equipment']);
        }

        // Set default values for required fields that aren't in the form
        $validated['usage_hours'] = $validated['usage_hours'] ?? 0;

        $equipment->update($validated);

        return redirect()->route('account.equipment.index')
            ->with('success', 'Equipment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment)
    {
        $equipment->delete();

        return redirect()->route('account.equipment.index')
            ->with('success', 'Equipment deleted successfully.');
    }
}
