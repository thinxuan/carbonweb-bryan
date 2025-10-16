@extends('admin.layout')

@section('title', 'Locations')

@section('content')
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Locations</h1>
        </div>
        <div>
            <button class="btn btn-primary" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i> Menu
            </button>
        </div>
    </div>
</div>

<div class="content-body">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        {{-- Interactive Map (col-8) --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-body p-0">
                    <div class="map-container" style="height: 500px;">
                        <div id="locations-map"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Locations Info (col-4) --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Locations</h5>
                    <p class="card-text">Locations are physical places where your company operates. This may include offices, factories, and warehouses. <a href="#" class="text-primary">Learn more</a></p>

                    <p class="card-text text-muted small">Not sure? You can always change this later.</p>

                    <div class="mt-4">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-plus"></i> Add location(s)
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('account.locations.create.single') }}">
                                    <i class="fas fa-map-marker-alt"></i> Single Location
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('account.locations.create.multiple') }}">
                                    <i class="fas fa-list"></i> Multiple Locations
                                </a></li>
                            </ul>
                        </div>
                    </div>

                    {{-- Search Bar --}}
                    <div class="mt-4">
                        <input type="text" class="form-control" placeholder="Search added locations" id="locationSearch">
                    </div>

                    {{-- Locations Count --}}
                    @if($locations->count() > 0)
                        <div class="mt-3">
                            <p class="text-muted small">Displaying {{ $locations->count() }} locations</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Location Cards Container (Outside Content Body) --}}
@if($locations->count() > 0)
<div class="location-cards-container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="location-cards-wrapper">
                    @foreach($locations as $location)
                        <div class="location-card" data-location-name="{{ strtolower($location->name) }}" data-location-address="{{ strtolower($location->city . ' ' . $location->state . ' ' . $location->country) }}">
                            <div class="location-card-content">
                                <div class="location-name">
                                    {{ $location->name }} →
                                </div>
                                <div class="location-address">
                                    @if($location->city && $location->state && $location->country)
                                        {{ $location->city }},
                                        @if($location->postal_code){{ $location->postal_code }} @endif
                                        {{ $location->state }},
                                        {{ $location->country }}
                                    @else
                                        {{ $location->city }}, {{ $location->state }}, {{ $location->country }}
                                    @endif
                                </div>
                                <div class="location-actions">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('account.locations.show', $location) }}">
                                                <i class="fas fa-eye"></i> View Details
                                            </a></li>
                                            <li><a class="dropdown-item" href="{{ route('account.locations.edit', $location) }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('account.locations.destroy', $location) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger"
                                                            onclick="return confirm('Are you sure you want to delete this location?')">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Sticky Continue Footer -->
<div class="sticky-continue-footer">
    <div class="container-fluid">
        <div class="d-flex justify-content-end">
            <a href="{{ route('account.vehicles.index') }}" class="btn btn-success btn-lg">
                Continue to Vehicles <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize map centered on Kuala Lumpur, Malaysia
    const map = L.map('locations-map').setView([3.1390, 101.6869], 10);

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Add markers for existing locations
    @if($locations->count() > 0)
        @foreach($locations as $location)
            @if($location->latitude && $location->longitude)
                const marker{{ $location->id }} = L.marker([{{ $location->latitude }}, {{ $location->longitude }}]).addTo(map);
                marker{{ $location->id }}.bindPopup(`
                    <strong>{{ $location->name }}</strong><br>
                    {{ $location->address }}<br>
                    {{ $location->city }}, {{ $location->state }}, {{ $location->country }}
                `);
            @endif
        @endforeach
    @endif

    // Handle map clicks to add new locations
    map.on('click', function(e) {
        const { lat, lng } = e.latlng;

        // Create a temporary marker
        const tempMarker = L.marker([lat, lng]).addTo(map);
        tempMarker.bindPopup(`
            <strong>New Location</strong><br>
            Coordinates: ${lat.toFixed(6)}, ${lng.toFixed(6)}<br>
            <a href="{{ route('account.locations.create.single') }}?lat=${lat}&lng=${lng}" class="btn btn-primary btn-sm mt-2">
                <i class="fas fa-plus"></i> Add Location Here
            </a>
        `).openPopup();

        // Remove temporary marker after 10 seconds
        setTimeout(() => {
            map.removeLayer(tempMarker);
        }, 10000);
    });

    // Location search functionality
    const locationSearch = document.getElementById('locationSearch');
    const locationCards = document.querySelectorAll('.location-card');

    if (locationSearch) {
        locationSearch.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();

            locationCards.forEach(card => {
                const locationName = card.dataset.locationName || '';
                const locationAddress = card.dataset.locationAddress || '';

                if (locationName.includes(searchTerm) || locationAddress.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
});
</script>
@endsection
