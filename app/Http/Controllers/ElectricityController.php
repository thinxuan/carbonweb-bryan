<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class ElectricityController extends Controller
{
    /**
     * Display the Electricity Usage page.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $locationsQuery = Location::query();

        if ($search) {
            $locationsQuery->where(function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->orWhere('city', 'like', '%' . $search . '%');
            });
        }

        $locationsNeedingData = (clone $locationsQuery)->where('electricity_data_added', false)->get();
        $locationsCompleted = (clone $locationsQuery)->where('electricity_data_added', true)->get();

        return view('admin.scope2.electricity-usage', compact('locationsNeedingData', 'locationsCompleted'));
    }

    /**
     * Store electricity usage data.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'calculation_method' => 'required|string|in:estimates,own_data',
            'amount' => 'nullable|numeric|min:0',
            'unit' => 'nullable|string|in:kwh,mwh,gwh',
        ]);

        $location = Location::findOrFail($validated['location_id']);

        // If using estimates, set estimated values
        if ($validated['calculation_method'] === 'estimates') {
            $location->update([
                'electricity_data_added' => true,
                'electricity_amount' => 17.21, // Estimated value
                'electricity_unit' => 'kwh',
                'electricity_calculation_method' => 'estimates',
            ]);
        } else {
            // Using own data
            $location->update([
                'electricity_data_added' => true,
                'electricity_amount' => $validated['amount'],
                'electricity_unit' => $validated['unit'],
                'electricity_calculation_method' => 'own_data',
            ]);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Electricity usage data saved successfully',
                'location' => $location
            ]);
        }

        return redirect()->back()->with('success', 'Electricity usage data saved successfully.');
    }
}
