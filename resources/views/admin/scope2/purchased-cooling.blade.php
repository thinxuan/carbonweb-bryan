@extends('admin.layout')

@section('title', 'Purchased Cooling')

@section('content')
<div class="container-fluid">
    <div class="content-body">
        <div class="mb-4">
            <h1 class="h2">Purchased Cooling</h1>
            <h4 class="mb-2">You have <span class="text-warning">3</span> locations that require data.</h4>
            <p class="text-muted">Click into each Location card in the left panel to add your <a href="">purchased cooling data</a>. You'll need the amount of cooling purchased (e.g. 150 ton-hours) during your reporting period.</p>
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
                                            <button class="btn btn-sm btn-primary" onclick="openPurchasedCoolingModal({{ $location->id }}, '{{ $location->name }}', '{{ $location->city }}, {{ $location->state }} {{ $location->postal_code }}, {{ $location->country }}')">
                                                Add data
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center text-muted">
                                <i class="fas fa-check-circle fa-2x mb-2"></i>
                                <p>All locations have purchased cooling data</p>
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
                                            <i class="fas fa-snowflake"></i>
                                        </div>
                                        <div class="location-card-done-info">
                                            <div class="location-card-done-name">
                                                {{ $location->name }}
                                                <i class="fas fa-check-circle text-success ms-2"></i>
                                            </div>
                                            <div class="location-card-done-type">{{ $location->city }}, {{ $location->state }}</div>
                                            <div class="location-card-done-description">
                                                {{ $location->purchased_cooling_amount }} {{ $location->purchased_cooling_unit }}
                                                <span class="badge bg-success ms-2">Actual</span>
                                            </div>
                                        </div>
                                        <div class="location-card-done-emissions">
                                            <div class="emissions-amount">{{ number_format($location->purchased_cooling_amount * 0.4, 2) }} tCO₂e</div>
                                        </div>
                                        <div class="location-card-done-actions">
                                            <button class="btn btn-sm btn-outline-primary" onclick="openPurchasedCoolingModal({{ $location->id }}, '{{ $location->name }}', '{{ $location->city }}, {{ $location->state }} {{ $location->postal_code }}, {{ $location->country }}', {{ $location->purchased_cooling_amount }}, '{{ $location->purchased_cooling_unit }}', '{{ $location->purchased_cooling_method }}')">
                                                Edit data <i class="fas fa-external-link-alt ms-1"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center text-muted">
                                <i class="fas fa-snowflake fa-2x mb-2"></i>
                                <p>No purchased cooling data added yet</p>
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

<!-- Purchased Cooling Modal -->
<div class="modal fade" id="purchasedCoolingModal" tabindex="-1" aria-labelledby="purchasedCoolingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0 pb-2" style="text-align: center; position: relative;">
                <button type="button" class="btn-close position-absolute" style="top: 1rem; right: 1rem;" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="w-100">
                    <h4 class="modal-title fw-bold mb-3" id="purchasedCoolingModalLabel">Add 2024 purchased cooling data.</h4>
                    <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.4;">
                        To calculate the emissions for this location, we'll gather the amount of purchased cooling for this location during 2024.
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

                <form id="purchasedCoolingForm">
                    @csrf
                    <input type="hidden" id="locationId" name="location_id">

                    <div class="mb-3">
                        <label class="form-label">
                            What method of cooling was used for this location?*
                        </label>
                        <select class="form-select" id="coolingMethod" name="cooling_method" required>
                            <option value="">Select cooling method</option>
                            <option value="air_cooled">Air-cooled</option>
                            <option value="water_cooled">Water-cooled</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            How much purchased cooling was used for work in 2024?*
                        </label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="amount" name="amount" step="0.01" min="0" placeholder="Enter amount" style="border-right: 0;" required>
                            <select class="form-select" id="unit" name="unit" style="border-left: 0;" required>
                                <option value="">Select unit</option>
                                <option value="ton_hour">Ton-Hour</option>
                                <option value="kwh">kWh</option>
                                <option value="mwh">MWh</option>
                                <option value="btu">BTU</option>
                                <option value="therm">Therm</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="savePurchasedCoolingData()">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
let currentLocationId = null;
let currentLocationCard = null;

function openPurchasedCoolingModal(locationId, locationName, locationAddress, amount = null, unit = null, coolingMethod = null) {
    currentLocationId = locationId;
    currentLocationCard = document.querySelector(`[data-location-id="${locationId}"]`);

    document.getElementById('modalLocationName').textContent = locationName;
    document.getElementById('modalLocationAddress').textContent = locationAddress;
    document.getElementById('locationId').value = locationId;

    document.getElementById('purchasedCoolingForm').reset();
    document.getElementById('locationId').value = locationId;

    if (amount !== null && unit !== null && coolingMethod !== null) {
        document.getElementById('amount').value = amount;
        document.getElementById('unit').value = unit;
        document.getElementById('coolingMethod').value = coolingMethod;
    }

    const modal = new bootstrap.Modal(document.getElementById('purchasedCoolingModal'));
    modal.show();
}

function savePurchasedCoolingData() {
    const form = document.getElementById('purchasedCoolingForm');
    const formData = new FormData(form);

    const coolingMethod = formData.get('cooling_method');
    const amount = formData.get('amount');
    const unit = formData.get('unit');

    if (!coolingMethod || !amount || !unit) {
        alert('Please fill in all required fields');
        return;
    }

    fetch('{{ route("admin.scope2.purchased-cooling.store") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('purchasedCoolingModal'));
            modal.hide();

            moveCardToDone(data.location);
            showSuccessMessage(data.message);
        } else {
            alert('Error saving purchased cooling data');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error saving purchased cooling data');
    });
}

function moveCardToDone(location) {
    if (!currentLocationCard) return;

    const doneCard = document.createElement('div');
    doneCard.className = 'location-card-done mb-3';
    doneCard.setAttribute('data-location-id', location.id);

    const methodBadge = '<span class="badge bg-success ms-2">Actual</span>';

    doneCard.innerHTML = `
        <div class="location-card-done-content">
            <div class="location-card-done-icon">
                <i class="fas fa-snowflake"></i>
            </div>
            <div class="location-card-done-info">
                <div class="location-card-done-name">
                    ${location.name}
                    <i class="fas fa-check-circle text-success ms-2"></i>
                </div>
                <div class="location-card-done-type">${location.city}, ${location.state}</div>
                <div class="location-card-done-description">
                    ${location.purchased_cooling_amount} ${location.purchased_cooling_unit}
                    ${methodBadge}
                </div>
            </div>
            <div class="location-card-done-emissions">
                <div class="emissions-amount">${(location.purchased_cooling_amount * 0.4).toFixed(2)} tCO₂e</div>
            </div>
            <div class="location-card-done-actions">
                <button class="btn btn-sm btn-outline-primary" onclick="openPurchasedCoolingModal(${location.id}, '${location.name}', '${location.city}, ${location.state} ${location.postal_code}, ${location.country}', ${location.purchased_cooling_amount}, '${location.purchased_cooling_unit}', '${location.purchased_cooling_method}')">
                    Edit data <i class="fas fa-external-link-alt ms-1"></i>
                </button>
            </div>
        </div>
    `;

    currentLocationCard.remove();

    const doneSection = document.querySelector('.col-md-6:last-child .card-body');
    const doneCardsContainer = doneSection.querySelector('.text-center');

    if (doneCardsContainer && doneCardsContainer.classList.contains('text-center')) {
        doneSection.replaceChild(doneCard, doneCardsContainer);
    } else {
        doneSection.insertBefore(doneCard, doneCardsContainer);
    }

    updateCounters();
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

    toast.addEventListener('hidden.bs.toast', () => {
        toast.remove();
    });
}

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
