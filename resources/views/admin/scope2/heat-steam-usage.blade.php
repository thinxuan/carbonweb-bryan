@extends('admin.layout')

@section('title', 'Heat & Steam Usage')

@section('content')
<div class="container-fluid">
    <div class="content-body">
        <div class="mb-4">
            <h1 class="h2">Heat & Steam Usage</h1>
            <h4 class="mb-2">You have <span class="text-warning">3</span> locations that require data.</h4>
            <p class="text-muted">Click into each Location card in the left panel to add your <a href="">heat and steam usage data</a>. You'll need the amount of heat and steam purchased (e.g. 230 kWh) during your reporting period.</p>
        </div>

        <!-- Search Bar -->
        <div class="mb-4">
            <input type="text" class="form-control" placeholder="Search added locations" id="locationSearch">
        </div>

        <div class="row">
            <!-- Locations Needing Data -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            Location needs data added
                            <span class="badge bg-warning" id="needsDataCount">{{ $locationsNeedingData->count() }}</span>
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($locationsNeedingData->count() > 0)
                            @foreach($locationsNeedingData as $location)
                                <div class="location-card mb-3" data-location-id="{{ $location->id }}">
                                    <div class="location-card-content">
                                        <div class="location-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="location-info">
                                            <div class="location-name">{{ $location->name }}</div>
                                            <div class="location-address">{{ $location->city }}, {{ $location->state }} {{ $location->postal_code }}, {{ $location->country }}</div>
                                        </div>
                                        <div class="location-action">
                                            <button class="btn btn-sm btn-primary" onclick="openHeatSteamModal({{ $location->id }}, '{{ $location->name }}', '{{ $location->city }}, {{ $location->state }} {{ $location->postal_code }}, {{ $location->country }}')">
                                                Add data
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center text-muted">
                                <i class="fas fa-check-circle fa-2x mb-2"></i>
                                <p>All locations have heat & steam data</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Completed Locations -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            Done
                            <span class="badge bg-success" id="completedCount">{{ $locationsCompleted->count() }}</span>
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($locationsCompleted->count() > 0)
                            @foreach($locationsCompleted as $location)
                                <div class="location-card-done mb-3" data-location-id="{{ $location->id }}">
                                    <div class="location-card-done-content">
                                        <div class="location-card-done-icon">
                                            <i class="fas fa-fire"></i>
                                        </div>
                                        <div class="location-card-done-info">
                                            <div class="location-card-done-name">
                                                {{ $location->name }}
                                                <i class="fas fa-check-circle text-success ms-2"></i>
                                            </div>
                                            <div class="location-card-done-type">{{ $location->city }}, {{ $location->state }}</div>
                                            <div class="location-card-done-description">
                                                {{ $location->heat_steam_amount }} {{ $location->heat_steam_unit }}
                                                <span class="badge bg-success ms-2">Actual</span>
                                            </div>
                                        </div>
                                        <div class="location-card-done-emissions">
                                            <div class="emissions-amount">{{ number_format($location->heat_steam_amount * 0.3, 2) }} tCO₂e</div>
                                        </div>
                                        <div class="location-card-done-actions">
                                            <button class="btn btn-sm btn-outline-primary" onclick="openHeatSteamModal({{ $location->id }}, '{{ $location->name }}', '{{ $location->city }}, {{ $location->state }} {{ $location->postal_code }}, {{ $location->country }}', {{ $location->heat_steam_amount }}, '{{ $location->heat_steam_unit }}')">
                                                Edit data <i class="fas fa-external-link-alt ms-1"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center text-muted">
                                <i class="fas fa-fire fa-2x mb-2"></i>
                                <p>No heat & steam data added yet</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sticky Footer -->
    <div class="sticky-continue-footer">
        <div class="container-fluid">
            <div class="row justify-content-end">
                <div class="col-auto">
                    <a href="#" class="btn btn-lg btn-primary">
                        Continue to Scope 3
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Heat & Steam Modal -->
<div class="modal fade" id="heatSteamModal" tabindex="-1" aria-labelledby="heatSteamModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0 pb-2" style="text-align: center; position: relative;">
                <button type="button" class="btn-close position-absolute" style="top: 1rem; right: 1rem;" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="w-100">
                    <h4 class="modal-title fw-bold mb-3" id="heatSteamModalLabel">Add 2024 heat & steam usage data.</h4>
                    <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.4;">
                        To calculate the emissions for this location, we'll gather the amount of heat & steam purchased for this location during 2024.
                    </p>
                </div>
            </div>
            <div class="modal-body">
                <div class="location-card mb-4">
                    <div class="location-card-content">
                        <div class="location-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="location-info">
                            <div class="location-name" id="modalLocationName"></div>
                            <div class="location-address" id="modalLocationAddress"></div>
                        </div>
                    </div>
                </div>

                <form id="heatSteamForm">
                    @csrf
                    <input type="hidden" id="locationId" name="location_id">

                    <div class="mb-3">
                        <label class="form-label">
                            How much heat & steam was purchased for work in 2024?*
                        </label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="amount" name="amount" step="0.01" min="0" placeholder="Enter amount" style="border-right: 0;" required>
                            <select class="form-select" id="unit" name="unit" style="border-left: 0;" required>
                                <option value="">Select unit</option>
                                <option value="therm">Therm</option>
                                <option value="mcf">MCF</option>
                                <option value="ccf">CCF</option>
                                <option value="cubic_meter">Cubic Meter</option>
                                <option value="gigajoule">Gigajoule</option>
                                <option value="mwh">MWh</option>
                                <option value="kwh">kWh</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveHeatSteamData()">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
let currentLocationId = null;
let currentLocationCard = null;

function openHeatSteamModal(locationId, locationName, locationAddress, amount = null, unit = null) {
    currentLocationId = locationId;
    currentLocationCard = document.querySelector(`[data-location-id="${locationId}"]`);

    // Populate modal with location data
    document.getElementById('modalLocationName').textContent = locationName;
    document.getElementById('modalLocationAddress').textContent = locationAddress;
    document.getElementById('locationId').value = locationId;

    // Reset form for new entry
    document.getElementById('heatSteamForm').reset();
    document.getElementById('locationId').value = locationId;

    // Populate form fields if editing (existing data)
    if (amount !== null && unit !== null) {
        document.getElementById('amount').value = amount;
        document.getElementById('unit').value = unit;
    }

    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('heatSteamModal'));
    modal.show();
}

function saveHeatSteamData() {
    const form = document.getElementById('heatSteamForm');
    const formData = new FormData(form);

    // Validate required fields
    const amount = formData.get('amount');
    const unit = formData.get('unit');

    if (!amount || !unit) {
        alert('Please fill in all required fields');
        return;
    }

    fetch('{{ route("account.scope2.heat-steam-usage.store") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('heatSteamModal'));
            modal.hide();

            // Move card to done section
            moveCardToDone(data.location);

            // Show success message
            showSuccessMessage(data.message);
        } else {
            alert('Error saving heat & steam data');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error saving heat & steam data');
    });
}

function moveCardToDone(location) {
    if (!currentLocationCard) return;

    // Create new card structure for "Done" section
    const doneCard = document.createElement('div');
    doneCard.className = 'location-card-done mb-3';
    doneCard.setAttribute('data-location-id', location.id);

    const methodBadge = '<span class="badge bg-success ms-2">Actual</span>';

    doneCard.innerHTML = `
        <div class="location-card-done-content">
            <div class="location-card-done-icon">
                <i class="fas fa-fire"></i>
            </div>
            <div class="location-card-done-info">
                <div class="location-card-done-name">
                    ${location.name}
                    <i class="fas fa-check-circle text-success ms-2"></i>
                </div>
                <div class="location-card-done-type">${location.city}, ${location.state}</div>
                <div class="location-card-done-description">
                    ${location.heat_steam_amount} ${location.heat_steam_unit}
                    ${methodBadge}
                </div>
            </div>
            <div class="location-card-done-emissions">
                <div class="emissions-amount">${(location.heat_steam_amount * 0.3).toFixed(2)} tCO₂e</div>
            </div>
            <div class="location-card-done-actions">
                <button class="btn btn-sm btn-outline-primary" onclick="openHeatSteamModal(${location.id}, '${location.name}', '${location.city}, ${location.state} ${location.postal_code}, ${location.country}', ${location.heat_steam_amount}, '${location.heat_steam_unit}')">
                    Edit data <i class="fas fa-external-link-alt ms-1"></i>
                </button>
            </div>
        </div>
    `;

    // Remove the original card
    currentLocationCard.remove();

    // Add to "Done" section
    const doneSection = document.querySelector('.col-md-6:last-child .card-body');
    const doneCardsContainer = doneSection.querySelector('.text-center');

    if (doneCardsContainer && doneCardsContainer.classList.contains('text-center')) {
        // Replace the "no completed locations" message
        doneSection.replaceChild(doneCard, doneCardsContainer);
    } else {
        // Add to existing cards
        doneSection.insertBefore(doneCard, doneCardsContainer);
    }

    // Update counters
    updateCounters();

    // Clear current references
    currentLocationId = null;
    currentLocationCard = null;
}

function updateCounters() {
    const needsDataCount = document.querySelectorAll('.col-md-6:first-child .location-card').length;
    const completedCount = document.querySelectorAll('.col-md-6:last-child .location-card-done').length;

    document.getElementById('needsDataCount').textContent = needsDataCount;
    document.getElementById('completedCount').textContent = completedCount;
}

function showSuccessMessage(message) {
    // Create toast notification
    const toast = document.createElement('div');
    toast.className = 'toast align-items-center text-white bg-success border-0';
    toast.setAttribute('role', 'alert');
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;

    document.body.appendChild(toast);

    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();

    // Remove toast after it's hidden
    toast.addEventListener('hidden.bs.toast', () => {
        toast.remove();
    });
}

// Search functionality
document.getElementById('locationSearch').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const locationCards = document.querySelectorAll('.location-card, .location-card-done');

    locationCards.forEach(card => {
        const name = card.querySelector('.location-name, .location-card-done-name').textContent.toLowerCase();
        const address = card.querySelector('.location-address, .location-card-done-type').textContent.toLowerCase();

        if (name.includes(searchTerm) || address.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});
</script>
@endsection
