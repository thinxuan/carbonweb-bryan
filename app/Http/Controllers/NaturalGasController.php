<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class NaturalGasController extends Controller
{
    /**
     * Display the Natural Gas Consumption page.
     */
    public function index()
    {
        $locations = Location::all();
        $locationsNeedingData = $locations->where('natural_gas_data_added', false);
        $locationsCompleted = $locations->where('natural_gas_data_added', true);

        return view('account.scope1.natural-gas', compact('locationsNeedingData', 'locationsCompleted'));
    }

    /**
     * Store natural gas consumption data for a location.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'amount' => 'required|numeric|min:0',
            'unit' => 'required|string|in:therm,mcf,ccf,cubic_meter,gigajoule',
        ]);

        // Find the location and update it
        $location = Location::findOrFail($validated['location_id']);

        // Update the location with natural gas data
        $location->update([
            'natural_gas_data_added' => true,
            'natural_gas_amount' => $validated['amount'],
            'natural_gas_unit' => $validated['unit'],
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Natural gas data saved successfully',
                'location' => $location
            ]);
        }

        return redirect()->back()->with('success', 'Natural gas data saved successfully.');
    }
}
