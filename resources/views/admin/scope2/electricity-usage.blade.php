@extends('admin.layout')

@section('title', 'Electricity Usage')

@section('content')
<div class="container-fluid">
    <div class="content-body">
        <div class="mb-4">
            <h1 class="h2">Electricity Usage</h1>
            <h4 class="mb-2">You have <span class="text-warning">3</span> locations that require data.</h4>
            <p class="text-muted">Click into each Location card in the left panel to add your related <a href="">electricity usage data</a>. You'll need the amount of electricity consumed (e.g. 230 kWh) during your reporting period. If you do not have actual usage data, you can use estimated emissions based on the purpose of the location and floor area.</p>
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
                                            <button class="btn btn-sm btn-primary" onclick="openElectricityModal({{ $location->id }}, '{{ $location->name }}', '{{ $location->city }}, {{ $location->state }} {{ $location->postal_code }}, {{ $location->country }}')">
                                                Add data
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center text-muted">
                                <i class="fas fa-check-circle fa-2x mb-2"></i>
                                <p>All locations have electricity data</p>
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
                                            <i class="fas fa-bolt"></i>
                                        </div>
                                        <div class="location-card-done-info">
                                            <div class="location-card-done-name">
                                                {{ $location->name }}
                                                <i class="fas fa-check-circle text-success ms-2"></i>
                                            </div>
                                            <div class="location-card-done-type">{{ $location->city }}, {{ $location->state }}</div>
                                            <div class="location-card-done-description">
                                                {{ $location->electricity_amount }} {{ $location->electricity_unit }}
                                                @if($location->electricity_calculation_method === 'estimates')
                                                    <span class="badge bg-warning ms-2">Estimated</span>
                                                @else
                                                    <span class="badge bg-success ms-2">Actual</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="location-card-done-emissions">
                                            <div class="emissions-amount">{{ number_format($location->electricity_amount * 0.5, 2) }} tCO₂e</div>
                                        </div>
                                        <div class="location-card-done-actions">
                                            <button class="btn btn-sm btn-outline-primary" onclick="openElectricityModal({{ $location->id }}, '{{ $location->name }}', '{{ $location->city }}, {{ $location->state }} {{ $location->postal_code }}, {{ $location->country }}', {{ $location->electricity_amount }}, '{{ $location->electricity_unit }}')">
                                                Edit data <i class="fas fa-external-link-alt ms-1"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center text-muted">
                                <i class="fas fa-bolt fa-2x mb-2"></i>
                                <p>No electricity data added yet</p>
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

<!-- Electricity Modal -->
<div class="modal fade" id="electricityModal" tabindex="-1" aria-labelledby="electricityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0 pb-2" style="text-align: center; position: relative;">
                <button type="button" class="btn-close position-absolute" style="top: 1rem; right: 1rem;" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="w-100">
                    <h4 class="modal-title fw-bold mb-3" id="electricityModalLabel">Add 2024 electricity usage data.</h4>
                    <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.4;">
                        To add your related electricity usage data, you'll need the amount of electricity consumed (e.g. 230 kWh) during your reporting period. If you do not have actual usage data, you can use estimated emissions based on the purpose of the location and floor area.
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

                <form id="electricityForm">
                    @csrf
                    <input type="hidden" id="locationId" name="location_id">

                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            How would you like to calculate your electricity emissions? *
                        </label>

                        <div class="mt-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="calculation_method" id="useEstimates" value="estimates" onchange="toggleCalculationMethod()" checked>
                                <label class="form-check-label" for="useEstimates">
                                    Use estimates
                                </label>
                                <div class="form-text text-muted">This is less accurate and will make you less likely to pass audits</div>
                            </div>

                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="calculation_method" id="useOwnData" value="own_data" onchange="toggleCalculationMethod()">
                                <label class="form-check-label" for="useOwnData">
                                    I want to use my own data
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Estimated Emissions Display (shown when "Use estimates" is selected) -->
                    <div id="estimatedEmissionsSection" class="mb-4">
                        <div class="card bg-light">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="d-flex align-items-baseline">
                                            <span class="h4 fw-bold me-2">17.21</span>
                                            <span class="text-muted">tCO₂e</span>
                                        </div>
                                        <small class="text-muted">Total Estimated Emissions</small>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <small class="text-muted">
                                        We will use these estimates to calculate your carbon footprint for purchased electricity for this location.
                                        These estimates are based off of CBECS and cannot be guaranteed to be accurate.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Own Data Inputs (shown when "I want to use my own data" is selected) -->
                    <div id="ownDataSection" style="display: none;">
                        <div class="mb-3">
                            <label class="form-label">
                                How much electricity does <span id="amountLocationName"></span> use?*
                            </label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="amount" name="amount" step="0.01" min="0" placeholder="Enter amount" style="border-right: 0;">
                                <select class="form-select" id="unit" name="unit" style="border-left: 0;">
                                    <option value="">Select unit</option>
                                    <option value="kwh">kWh</option>
                                    <option value="mwh">MWh</option>
                                    <option value="gwh">GWh</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveElectricityData()">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
let currentLocationId = null;
let currentLocationCard = null;

function openElectricityModal(locationId, locationName, locationAddress, amount = null, unit = null) {
    currentLocationId = locationId;
    currentLocationCard = document.querySelector(`[data-location-id="${locationId}"]`);

    // Populate modal with location data
    document.getElementById('modalLocationName').textContent = locationName;
    document.getElementById('modalLocationAddress').textContent = locationAddress;
    document.getElementById('amountLocationName').textContent = locationName;
    document.getElementById('locationId').value = locationId;

    // Reset form for new entry
    document.getElementById('electricityForm').reset();
    document.getElementById('locationId').value = locationId;

    // Set default state - "Use estimates" checked and shown
    document.getElementById('useEstimates').checked = true;
    document.getElementById('estimatedEmissionsSection').style.display = 'block';
    document.getElementById('ownDataSection').style.display = 'none';

    // Populate form fields if editing (existing data)
    if (amount !== null && unit !== null) {
        document.getElementById('useOwnData').checked = true;
        document.getElementById('useEstimates').checked = false;
        document.getElementById('amount').value = amount;
        document.getElementById('unit').value = unit;
        toggleCalculationMethod();
    }

    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('electricityModal'));
    modal.show();
}

function toggleCalculationMethod() {
    const useEstimates = document.getElementById('useEstimates').checked;
    const useOwnData = document.getElementById('useOwnData').checked;

    const estimatedSection = document.getElementById('estimatedEmissionsSection');
    const ownDataSection = document.getElementById('ownDataSection');

    if (useEstimates) {
        estimatedSection.style.display = 'block';
        ownDataSection.style.display = 'none';
        // Remove required attributes from own data inputs
        document.getElementById('amount').removeAttribute('required');
        document.getElementById('unit').removeAttribute('required');
    } else if (useOwnData) {
        estimatedSection.style.display = 'none';
        ownDataSection.style.display = 'block';
        // Add required attributes to own data inputs
        document.getElementById('amount').setAttribute('required', 'required');
        document.getElementById('unit').setAttribute('required', 'required');
    } else {
        estimatedSection.style.display = 'none';
        ownDataSection.style.display = 'none';
    }
}

function saveElectricityData() {
    const form = document.getElementById('electricityForm');
    const formData = new FormData(form);

    // Get the selected calculation method
    const calculationMethod = formData.get('calculation_method');

    // Validate that a method is selected
    if (!calculationMethod) {
        alert('Please select a calculation method');
        return;
    }

    // If using own data, validate required fields
    if (calculationMethod === 'own_data') {
        const amount = formData.get('amount');
        const unit = formData.get('unit');

        if (!amount || !unit) {
            alert('Please fill in all required fields for your own data');
            return;
        }
    }

    fetch('{{ route("account.scope2.electricity-usage.store") }}', {
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
            const modal = bootstrap.Modal.getInstance(document.getElementById('electricityModal'));
            modal.hide();

            // Move card to done section
            moveCardToDone(data.location);

            // Show success message
            showSuccessMessage(data.message);
        } else {
            alert('Error saving electricity data');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error saving electricity data');
    });
}

function moveCardToDone(location) {
    if (!currentLocationCard) return;

    // Create new card structure for "Done" section
    const doneCard = document.createElement('div');
    doneCard.className = 'location-card-done mb-3';
    doneCard.setAttribute('data-location-id', location.id);

    const calculationMethod = location.electricity_calculation_method || 'own_data';
    const methodBadge = calculationMethod === 'estimates'
        ? '<span class="badge bg-warning ms-2">Estimated</span>'
        : '<span class="badge bg-success ms-2">Actual</span>';

    doneCard.innerHTML = `
        <div class="location-card-done-content">
            <div class="location-card-done-icon">
                <i class="fas fa-bolt"></i>
            </div>
            <div class="location-card-done-info">
                <div class="location-card-done-name">
                    ${location.name}
                    <i class="fas fa-check-circle text-success ms-2"></i>
                </div>
                <div class="location-card-done-type">${location.city}, ${location.state}</div>
                <div class="location-card-done-description">
                    ${location.electricity_amount} ${location.electricity_unit}
                    ${methodBadge}
                </div>
            </div>
            <div class="location-card-done-emissions">
                <div class="emissions-amount">${(location.electricity_amount * 0.5).toFixed(2)} tCO₂e</div>
            </div>
            <div class="location-card-done-actions">
                <button class="btn btn-sm btn-outline-primary" onclick="openElectricityModal(${location.id}, '${location.name}', '${location.city}, ${location.state} ${location.postal_code}, ${location.country}', ${location.electricity_amount}, '${location.electricity_unit}')">
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
