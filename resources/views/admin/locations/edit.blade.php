@extends('admin.layout')

@section('title', 'Edit Location')

@section('content')
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Edit Location</h1>
            <p class="text-muted mb-0">Update location information</p>
        </div>
        <div>
            <a href="{{ route('account.locations.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Locations
            </a>
        </div>
    </div>
</div>

<div class="content-body">
    <form action="{{ route('account.locations.update', $location) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Location Name *</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" value="{{ old('name', $location->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="city" class="form-label">City *</label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror"
                           id="city" name="city" value="{{ old('city', $location->city) }}" required>
                    @error('city')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address *</label>
            <textarea class="form-control @error('address') is-invalid @enderror"
                      id="address" name="address" rows="3" required>{{ old('address', $location->address) }}</textarea>
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="state" class="form-label">State *</label>
                    <input type="text" class="form-control @error('state') is-invalid @enderror"
                           id="state" name="state" value="{{ old('state', $location->state) }}" required>
                    @error('state')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="country" class="form-label">Country *</label>
                    <input type="text" class="form-control @error('country') is-invalid @enderror"
                           id="country" name="country" value="{{ old('country', $location->country) }}" required>
                    @error('country')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="postal_code" class="form-label">Postal Code</label>
                    <input type="text" class="form-control @error('postal_code') is-invalid @enderror"
                           id="postal_code" name="postal_code" value="{{ old('postal_code', $location->postal_code) }}">
                    @error('postal_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Location on Map</label>
            <p class="text-muted small">Click on the map to update the location coordinates</p>
            <div class="map-container">
                <div id="map"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="latitude" class="form-label">Latitude</label>
                    <input type="number" step="any" class="form-control @error('latitude') is-invalid @enderror"
                           id="latitude" name="latitude" value="{{ old('latitude', $location->latitude) }}" readonly>
                    @error('latitude')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="longitude" class="form-label">Longitude</label>
                    <input type="number" step="any" class="form-control @error('longitude') is-invalid @enderror"
                           id="longitude" name="longitude" value="{{ old('longitude', $location->longitude) }}" readonly>
                    @error('longitude')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror"
                      id="description" name="description" rows="4">{{ old('description', $location->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('account.locations.index') }}" class="btn btn-outline-secondary me-2">
                Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update Location
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get existing coordinates or default to Kuala Lumpur
    const existingLat = parseFloat(document.getElementById('latitude').value) || 3.1390;
    const existingLng = parseFloat(document.getElementById('longitude').value) || 101.6869;

    // Initialize map with existing coordinates
    const map = L.map('map').setView([existingLat, existingLng], existingLat && existingLng ? 15 : 10);

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    let marker = null;

    // Function to update coordinates
    function updateCoordinates(lat, lng) {
        document.getElementById('latitude').value = lat.toFixed(6);
        document.getElementById('longitude').value = lng.toFixed(6);
    }

    // Handle map clicks
    map.on('click', function(e) {
        const { lat, lng } = e.latlng;

        // Remove existing marker
        if (marker) {
            map.removeLayer(marker);
        }

        // Add new marker
        marker = L.marker([lat, lng]).addTo(map)
            .bindPopup(`Location: ${lat.toFixed(6)}, ${lng.toFixed(6)}`)
            .openPopup();

        // Update form fields
        updateCoordinates(lat, lng);
    });

    // Show existing marker if coordinates exist
    if (existingLat && existingLng) {
        marker = L.marker([existingLat, existingLng]).addTo(map)
            .bindPopup(`Current Location: ${existingLat.toFixed(6)}, ${existingLng.toFixed(6)}`)
            .openPopup();
    }
});
</script>
@endsection
