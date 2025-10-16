<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class PurchasedCoolingController extends Controller
{
    /**
     * Display the Purchased Cooling page.
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

        $locationsNeedingData = (clone $locationsQuery)->where('purchased_cooling_data_added', false)->get();
        $locationsCompleted = (clone $locationsQuery)->where('purchased_cooling_data_added', true)->get();

        return view('account.scope2.purchased-cooling', compact('locationsNeedingData', 'locationsCompleted'));
    }

    /**
     * Store purchased cooling data.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'cooling_method' => 'required|string|in:air_cooled,water_cooled',
            'amount' => 'required|numeric|min:0',
            'unit' => 'required|string|in:ton_hour,kwh,mwh,btu,therm',
        ]);

        $location = Location::findOrFail($validated['location_id']);

        $location->update([
            'purchased_cooling_data_added' => true,
            'purchased_cooling_amount' => $validated['amount'],
            'purchased_cooling_unit' => $validated['unit'],
            'purchased_cooling_method' => $validated['cooling_method'],
            'purchased_cooling_calculation_method' => 'own_data',
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Purchased cooling data saved successfully',
                'location' => $location
            ]);
        }

        return redirect()->back()->with('success', 'Purchased cooling data saved successfully.');
    }
}
