@extends('admin.layout')

@section('title', 'Edit Vehicle')

@section('content')
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Edit Vehicle</h1>
            <p class="text-muted mb-0">Update vehicle information</p>
        </div>
        <div>
            <a href="{{ route('admin.vehicles.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Vehicles
            </a>
        </div>
    </div>
</div>

<div class="content-body">
    <form action="{{ route('admin.vehicles.update', $vehicle) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="make" class="form-label">Make *</label>
                    <input type="text" class="form-control @error('make') is-invalid @enderror"
                           id="make" name="make" value="{{ old('make', $vehicle->make) }}" required>
                    @error('make')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="model" class="form-label">Model *</label>
                    <input type="text" class="form-control @error('model') is-invalid @enderror"
                           id="model" name="model" value="{{ old('model', $vehicle->model) }}" required>
                    @error('model')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="year" class="form-label">Year *</label>
                    <input type="number" class="form-control @error('year') is-invalid @enderror"
                           id="year" name="year" value="{{ old('year', $vehicle->year) }}"
                           min="1900" max="{{ date('Y') + 1 }}" required>
                    @error('year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="license_plate" class="form-label">License Plate *</label>
                    <input type="text" class="form-control @error('license_plate') is-invalid @enderror"
                           id="license_plate" name="license_plate" value="{{ old('license_plate', $vehicle->license_plate) }}" required>
                    @error('license_plate')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="vin" class="form-label">VIN</label>
                    <input type="text" class="form-control @error('vin') is-invalid @enderror"
                           id="vin" name="vin" value="{{ old('vin', $vehicle->vin) }}" maxlength="17">
                    @error('vin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="location_id" class="form-label">Location *</label>
                    <select class="form-select @error('location_id') is-invalid @enderror"
                            id="location_id" name="location_id" required>
                        <option value="">Select a location</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}" {{ old('location_id', $vehicle->location_id) == $location->id ? 'selected' : '' }}>
                                {{ $location->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('location_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="fuel_type" class="form-label">Fuel Type *</label>
                    <select class="form-select @error('fuel_type') is-invalid @enderror"
                            id="fuel_type" name="fuel_type" required>
                        <option value="gasoline" {{ old('fuel_type', $vehicle->fuel_type) == 'gasoline' ? 'selected' : '' }}>Gasoline</option>
                        <option value="diesel" {{ old('fuel_type', $vehicle->fuel_type) == 'diesel' ? 'selected' : '' }}>Diesel</option>
                        <option value="electric" {{ old('fuel_type', $vehicle->fuel_type) == 'electric' ? 'selected' : '' }}>Electric</option>
                        <option value="hybrid" {{ old('fuel_type', $vehicle->fuel_type) == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        <option value="lpg" {{ old('fuel_type', $vehicle->fuel_type) == 'lpg' ? 'selected' : '' }}>LPG</option>
                        <option value="cng" {{ old('fuel_type', $vehicle->fuel_type) == 'cng' ? 'selected' : '' }}>CNG</option>
                    </select>
                    @error('fuel_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="engine_size" class="form-label">Engine Size (L)</label>
                    <input type="number" step="0.01" class="form-control @error('engine_size') is-invalid @enderror"
                           id="engine_size" name="engine_size" value="{{ old('engine_size', $vehicle->engine_size) }}">
                    @error('engine_size')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="co2_emissions" class="form-label">CO2 Emissions (g/km)</label>
                    <input type="number" step="0.001" class="form-control @error('co2_emissions') is-invalid @enderror"
                           id="co2_emissions" name="co2_emissions" value="{{ old('co2_emissions', $vehicle->co2_emissions) }}">
                    @error('co2_emissions')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="mileage" class="form-label">Current Mileage (km) *</label>
                    <input type="number" class="form-control @error('mileage') is-invalid @enderror"
                           id="mileage" name="mileage" value="{{ old('mileage', $vehicle->mileage) }}" min="0" required>
                    @error('mileage')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="purchase_date" class="form-label">Purchase Date</label>
                    <input type="date" class="form-control @error('purchase_date') is-invalid @enderror"
                           id="purchase_date" name="purchase_date" value="{{ old('purchase_date', $vehicle->purchase_date?->format('Y-m-d')) }}">
                    @error('purchase_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control @error('notes') is-invalid @enderror"
                      id="notes" name="notes" rows="4">{{ old('notes', $vehicle->notes) }}</textarea>
            @error('notes')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.vehicles.index') }}" class="btn btn-outline-secondary me-2">
                Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update Vehicle
            </button>
        </div>
    </form>
</div>
@endsection
