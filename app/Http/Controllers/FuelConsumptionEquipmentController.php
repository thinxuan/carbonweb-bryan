<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class FuelConsumptionEquipmentController extends Controller
{
    /**
     * Display the Fuel Consumption Equipment page.
     */
    public function index()
    {
        $equipment = Equipment::all();
        $equipmentNeedingData = $equipment->where('fuel_consumption_data_added', false);
        $equipmentCompleted = $equipment->where('fuel_consumption_data_added', true);

        return view('account.scope1.fuel-consumption-equipment', compact('equipmentNeedingData', 'equipmentCompleted'));
    }

    /**
     * Store equipment fuel consumption data.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'fuel_type' => 'required|string|in:gasoline,diesel,propane,natural_gas,coal,fuel_oil,kerosene,ethanol,biodiesel,other',
            'fuel_amount' => 'required|numeric|min:0',
            'fuel_unit' => 'required|string|in:liter,gallon,kilogram,pound,cubic_meter,cubic_feet',
        ]);

        $equipment = Equipment::findOrFail($validated['equipment_id']);

        $equipment->update([
            'fuel_consumption_data_added' => true,
            'fuel_type' => $validated['fuel_type'],
            'fuel_consumption_amount' => $validated['fuel_amount'],
            'fuel_consumption_unit' => $validated['fuel_unit'],
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Equipment fuel consumption data saved successfully',
                'equipment' => $equipment
            ]);
        }

        return redirect()->back()->with('success', 'Equipment fuel consumption data saved successfully.');
    }
}
