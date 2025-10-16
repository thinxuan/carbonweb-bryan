<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::latest()->paginate(10);
        return view('account.locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('account.locations.create');
    }

    /**
     * Show the form for creating a single location.
     */
    public function createSingle()
    {
        return view('account.locations.create-single');
    }

    /**
     * Show the form for creating multiple locations.
     */
    public function createMultiple()
    {
        return view('account.locations.create-multiple');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'primary' => 'required|string|max:255',
            'sub_category' => 'nullable|string|max:255',
            'gross' => 'nullable|numeric',
            'unit' => 'nullable|string|max:20',
        ]);

        // Set default values for missing fields
        $validated['address'] = $validated['city'] . ', ' . $validated['state'] . ', ' . $validated['country'];
        $validated['description'] = $validated['primary'] . ($validated['sub_category'] ? ' - ' . $validated['sub_category'] : '');
        $validated['latitude'] = null;
        $validated['longitude'] = null;

        Location::create($validated);

        return redirect()->route('account.locations.index')
            ->with('success', 'Location created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        return view('account.locations.show', compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        return view('account.locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'description' => 'nullable|string',
        ]);

        $location->update($validated);

        return redirect()->route('account.locations.index')
            ->with('success', 'Location updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->route('account.locations.index')
            ->with('success', 'Location deleted successfully.');
    }
}
