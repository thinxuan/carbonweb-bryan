@extends('account.layout')

@section('title', 'Edit Equipment')

@section('content')
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Edit Equipment</h1>
            <p class="text-muted mb-0">Update equipment information</p>
        </div>
        <div>
            <a href="{{ route('account.equipment.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Equipment
            </a>
        </div>
    </div>
</div>

<div class="content-body">
    <form action="{{ route('account.equipment.update', $equipment) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Equipment Name *</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" value="{{ old('name', $equipment->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="type" class="form-label">Equipment Type *</label>
                    <select class="form-select @error('type') is-invalid @enderror"
                            id="type" name="type" required>
                        <option value="">Select equipment type</option>
                        <option value="sensor" {{ old('type', $equipment->type) == 'sensor' ? 'selected' : '' }}>Sensor</option>
                        <option value="monitor" {{ old('type', $equipment->type) == 'monitor' ? 'selected' : '' }}>Monitor</option>
                        <option value="meter" {{ old('type', $equipment->type) == 'meter' ? 'selected' : '' }}>Meter</option>
                        <option value="analyzer" {{ old('type', $equipment->type) == 'analyzer' ? 'selected' : '' }}>Analyzer</option>
                        <option value="controller" {{ old('type', $equipment->type) == 'controller' ? 'selected' : '' }}>Controller</option>
                        <option value="other" {{ old('type', $equipment->type) == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Please select the following that apply. You can always update these later.</label>
                    <div class="checkbox">
                        <div class="">
                            @php
                                $manufacturerValues = old('manufacturer', $equipment->manufacturer ? explode(',', $equipment->manufacturer) : []);
                            @endphp
                            <label class="checkbox-label">
                                <input type="checkbox" name="manufacturer[]" value="manufacturer_a" {{ in_array('manufacturer_a', $manufacturerValues) ? 'checked' : '' }}>
                                <div class="text-content">
                                    <span>Option 1</span>
                                    <h6>Description for option 1</h6>
                                </div>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="manufacturer[]" value="manufacturer_b" {{ in_array('manufacturer_b', $manufacturerValues) ? 'checked' : '' }}>
                                <div class="text-content">
                                    <span>Option 2</span>
                                    <h6>Description for option 2</h6>
                                </div>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="manufacturer[]" value="manufacturer_c" {{ in_array('manufacturer_c', $manufacturerValues) ? 'checked' : '' }}>
                                <div class="text-content">
                                    <span>Option 3</span>
                                    <h6>Description for option 3</h6>
                                </div>
                            </label>
                        </div>
                    </div>
                    @error('manufacturer')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="model_number" class="form-label">Model Number</label>
                    <input type="text" class="form-control @error('model_number') is-invalid @enderror"
                           id="model_number" name="model_number" value="{{ old('model_number', $equipment->model_number) }}">
                    @error('model_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="serial_number" class="form-label">Serial Number</label>
            <input type="text" class="form-control @error('serial_number') is-invalid @enderror"
                   id="serial_number" name="serial_number" value="{{ old('serial_number', $equipment->serial_number) }}">
            @error('serial_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="location_id" class="form-label">Location</label>
                    <select class="form-select @error('location_id') is-invalid @enderror"
                            id="location_id" name="location_id">
                        <option value="">Select a location (optional)</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}" {{ old('location_id', $equipment->location_id) == $location->id ? 'selected' : '' }}>
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
                    <label for="vehicle_id" class="form-label">Vehicle</label>
                    <select class="form-select @error('vehicle_id') is-invalid @enderror"
                            id="vehicle_id" name="vehicle_id">
                        <option value="">Select a vehicle (optional)</option>
                        @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}" {{ old('vehicle_id', $equipment->vehicle_id) == $vehicle->id ? 'selected' : '' }}>
                                {{ $vehicle->year }} {{ $vehicle->make }} {{ $vehicle->model }}
                            </option>
                        @endforeach
                    </select>
                    @error('vehicle_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="usage_hours" class="form-label">Usage Hours *</label>
                    <input type="number" class="form-control @error('usage_hours') is-invalid @enderror"
                           id="usage_hours" name="usage_hours" value="{{ old('usage_hours', $equipment->usage_hours) }}" min="0" required>
                    @error('usage_hours')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="power_consumption" class="form-label">Power Consumption (kW)</label>
                    <input type="number" step="0.001" class="form-control @error('power_consumption') is-invalid @enderror"
                           id="power_consumption" name="power_consumption" value="{{ old('power_consumption', $equipment->power_consumption) }}">
                    @error('power_consumption')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="purchase_date" class="form-label">Purchase Date</label>
                    <input type="date" class="form-control @error('purchase_date') is-invalid @enderror"
                           id="purchase_date" name="purchase_date" value="{{ old('purchase_date', $equipment->purchase_date?->format('Y-m-d')) }}">
                    @error('purchase_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="last_maintenance" class="form-label">Last Maintenance</label>
                    <input type="date" class="form-control @error('last_maintenance') is-invalid @enderror"
                           id="last_maintenance" name="last_maintenance" value="{{ old('last_maintenance', $equipment->last_maintenance?->format('Y-m-d')) }}">
                    @error('last_maintenance')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="specifications" class="form-label">Specifications</label>
            <textarea class="form-control @error('specifications') is-invalid @enderror"
                      id="specifications" name="specifications" rows="4">{{ old('specifications', $equipment->specifications) }}</textarea>
            @error('specifications')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control @error('notes') is-invalid @enderror"
                      id="notes" name="notes" rows="3">{{ old('notes', $equipment->notes) }}</textarea>
            @error('notes')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('account.equipment.index') }}" class="btn btn-outline-secondary me-2">
                Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update Equipment
            </button>
        </div>
    </form>
</div>
@endsection
