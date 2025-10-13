<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class HeatSteamController extends Controller
{
    /**
     * Display the Heat & Steam Usage page.
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

        $locationsNeedingData = (clone $locationsQuery)->where('heat_steam_data_added', false)->get();
        $locationsCompleted = (clone $locationsQuery)->where('heat_steam_data_added', true)->get();

        return view('admin.scope2.heat-steam-usage', compact('locationsNeedingData', 'locationsCompleted'));
    }

    /**
     * Store heat and steam usage data.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'amount' => 'required|numeric|min:0',
            'unit' => 'required|string|in:therm,mcf,ccf,cubic_meter,gigajoule,mwh,kwh',
        ]);

        $location = Location::findOrFail($validated['location_id']);

        $location->update([
            'heat_steam_data_added' => true,
            'heat_steam_amount' => $validated['amount'],
            'heat_steam_unit' => $validated['unit'],
            'heat_steam_calculation_method' => 'own_data',
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Heat & Steam usage data saved successfully',
                'location' => $location
            ]);
        }

        return redirect()->back()->with('success', 'Heat & Steam usage data saved successfully.');
    }
}
