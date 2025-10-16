@extends('admin.layout')

@section('title', 'Vehicle Usage (Fuel)')

@section('content')
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Vehicle Usage (Fuel)</h1>
        </div>
    </div>
</div>

<div class="content-body">
    {{-- Summary Header --}}
    <div class="mb-4">
        <h4 class="mb-2">You have <span class="text-warning">{{ $vehiclesNeedingData->count() }}</span> vehicle that requires data.</h4>
        <p class="text-muted">Click into each Vehicle card in the left panel to add your vehicle fuel usage data. You'll need the fuel type and amount of fuel this vehicle used during your reporting period.</p>
    </div>

    {{-- Search Bar --}}
    <div class="mb-4">
        <div class="position-relative">
            <input type="text" class="form-control" id="vehicleSearch" placeholder="Search added vehicles" style="padding-left: 2.5rem;">
            <i class="fas fa-search position-absolute" style="left: 1rem; top: 50%; transform: translateY(-50%); color: #6c757d;"></i>
        </div>
    </div>

    {{-- Two Column Layout --}}
    <div class="row">
        {{-- Vehicle needs data added --}}
        <div class="col-md-6">
            <div class="mb-3">
                <h5><strong>{{ $vehiclesNeedingData->count() }} Vehicle needs data added</strong></h5>
            </div>

            @if($vehiclesNeedingData->count() > 0)
                @foreach($vehiclesNeedingData as $vehicle)
                    <div class="vehicle-card mb-3">
                        <div class="vehicle-card-content">
                            <div class="vehicle-icon">
                                @if($vehicle->vehicle_icon)
                                    <img src="/images/admin/vehicles/{{ $vehicle->vehicle_icon }}" alt="Vehicle" />
                                @else
                                    <i class="fas fa-car"></i>
                                @endif
                            </div>
                            <div class="vehicle-info">
                                <div class="vehicle-name">
                                    <strong>{{ $vehicle->make }} {{ $vehicle->model }}</strong>
                                </div>
                                <div class="vehicle-details">
                                    {{ ucfirst($vehicle->vehicle_type ?? 'car') }}-{{ ucfirst($vehicle->usage_data_type ?? 'average') }}<br>
                                    @if($vehicle->year)
                                        {{ $vehicle->year }}
                                    @endif
                                </div>
                                <div class="vehicle-action mt-2">
                                    <button class="btn btn-primary btn-sm" onclick="openVehicleFuelModal({{ $vehicle->id }}, '{{ $vehicle->make }} {{ $vehicle->model }}', '{{ ucfirst($vehicle->vehicle_type ?? 'car') }}-{{ ucfirst($vehicle->usage_data_type ?? 'average') }}')">
                                        <i class="fas fa-plus"></i> Add data
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-4">
                    <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                    <p class="text-muted">All vehicles have data added!</p>
                </div>
            @endif
        </div>

        {{-- Done --}}
        <div class="col-md-6">
            <div class="mb-3">
                <h5><strong>{{ $vehiclesCompleted->count() }} Done</strong></h5>
            </div>

            @if($vehiclesCompleted->count() > 0)
                @foreach($vehiclesCompleted as $vehicle)
                    <div class="vehicle-card-done mb-3" data-vehicle-id="{{ $vehicle->id }}">
                        <div class="vehicle-card-done-content">
                            <div class="vehicle-card-done-icon">
                                <img src="/images/admin/vehicles/{{ $vehicle->vehicle_icon }}" alt="{{ $vehicle->make }} {{ $vehicle->model }}" />
                            </div>
                            <div class="vehicle-card-done-info">
                                <div class="vehicle-card-done-name">
                                    {{ $vehicle->make }} {{ $vehicle->model }}
                                    <i class="fas fa-check-circle text-success ms-2"></i>
                                </div>
                                <div class="vehicle-card-done-type">{{ ucfirst($vehicle->vehicle_type ?? 'car') }}-{{ ucfirst($vehicle->usage_data_type ?? 'average') }}</div>
                                <div class="vehicle-card-done-description">{{ $vehicle->year ?? 'work' }}</div>
                            </div>
                            <div class="vehicle-card-done-emissions">
                                <div class="emissions-amount">{{ number_format($vehicle->fuel_amount * 0.1, 2) }} tCO₂e</div>
                            </div>
                            <div class="vehicle-card-done-actions">
                                <button class="btn btn-sm btn-outline-primary" onclick="openVehicleFuelModal({{ $vehicle->id }}, '{{ $vehicle->make }} {{ $vehicle->model }}', '{{ $vehicle->vehicle_type }}', '{{ $vehicle->vehicle_icon }}', {{ $vehicle->fuel_amount }}, '{{ $vehicle->fuel_unit }}', '{{ $vehicle->fuel_type }}')">
                                    Edit data <i class="fas fa-external-link-alt ms-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-4">
                    <i class="fas fa-hourglass-half fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No completed vehicles yet</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Vehicle Fuel Usage Modal -->
<div class="modal fade" id="vehicleFuelModal" tabindex="-1" aria-labelledby="vehicleFuelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vehicleFuelModalLabel">Add 2024 vehicle usage fuel data.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">To calculate the emissions for this vehicle, we'll gather the fuel type and amount of fuel this equipment used during 2024.</p>

                <!-- Vehicle Card in Modal -->
                <div class="vehicle-card-modal mb-3">
                    <div class="vehicle-card-content">
                        <div class="vehicle-icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <div class="vehicle-info">
                            <div class="vehicle-name" id="modalVehicleName">
                                <!-- Vehicle name will be populated here -->
                            </div>
                            <div class="vehicle-details" id="modalVehicleDetails">
                                <!-- Vehicle details will be populated here -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form id="vehicleFuelForm">
                    <input type="hidden" id="vehicleId" name="vehicle_id">
                    <div class="mb-3">
                        <label for="fuelType" class="form-label">What kind of fuel does <span id="vehicleNameText"></span> use? *</label>
                        <select class="form-select" id="fuelType" name="fuel_type" required>
                            <option value="">Select fuel type</option>
                            <option value="gasoline">Gasoline</option>
                            <option value="diesel">Diesel</option>
                            <option value="propane">Propane</option>
                            <option value="natural_gas">Natural Gas</option>
                            <option value="electricity">Electricity</option>
                            <option value="coal_industrial">Coal (industrial)</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fuelAmount" class="form-label">How much fuel did this <span id="vehicleNameText2"></span> use in 2024? *</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="fuelAmount" name="fuel_amount" step="0.01" min="0" required>
                            <select class="form-select" id="fuelUnit" name="fuel_unit" style="max-width: 120px;">
                                <option value="liter">liter</option>
                                <option value="gallon">gallon</option>
                                <option value="kilogram">kilogram</option>
                                <option value="pound">pound</option>
                                <option value="cubic_meter">cubic meter</option>
                                <option value="cubic_feet">cubic feet</option>
                                <option value="kwh">kWh</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveVehicleFuelData()">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Sticky Continue Footer -->
<div class="sticky-continue-footer">
    <div class="container-fluid">
        <div class="d-flex justify-content-end">
            <a href="{{ route('account.vehicles.index') }}" class="btn btn-success btn-lg">
                Continue to Vehicle Usage (Distance) <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</div>

<script>
// Global variables
let currentVehicleId = null;
let currentVehicleCard = null;

// Open modal function
function openVehicleFuelModal(vehicleId, vehicleName, vehicleDetails) {
    currentVehicleId = vehicleId;

    // Find the current vehicle card
    const vehicleCards = document.querySelectorAll('.vehicle-card');
    vehicleCards.forEach(card => {
        const nameElement = card.querySelector('.vehicle-name strong');
        if (nameElement && nameElement.textContent.trim() === vehicleName) {
            currentVehicleCard = card;
        }
    });

    // Populate modal
    document.getElementById('modalVehicleName').innerHTML = `<strong>${vehicleName}</strong>`;
    document.getElementById('modalVehicleDetails').textContent = vehicleDetails;
    document.getElementById('vehicleNameText').textContent = vehicleName;
    document.getElementById('vehicleNameText2').textContent = vehicleName;
    document.getElementById('vehicleId').value = vehicleId;

    // Reset form
    document.getElementById('fuelType').value = '';
    document.getElementById('fuelAmount').value = '';
    document.getElementById('fuelUnit').value = 'liter';

    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('vehicleFuelModal'));
    modal.show();
}

// Save vehicle fuel data
function saveVehicleFuelData() {
    const fuelType = document.getElementById('fuelType').value;
    const fuelAmount = document.getElementById('fuelAmount').value;
    const fuelUnit = document.getElementById('fuelUnit').value;

    if (!fuelType) {
        alert('Please select a fuel type');
        return;
    }

    if (!fuelAmount || fuelAmount <= 0) {
        alert('Please enter a valid fuel amount');
        return;
    }

    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
        alert('CSRF token not found. Please refresh the page and try again.');
        return;
    }

    // Create form data
    const formData = new FormData();
    formData.append('vehicle_id', currentVehicleId);
    formData.append('fuel_type', fuelType);
    formData.append('fuel_amount', fuelAmount);
    formData.append('fuel_unit', fuelUnit);
    formData.append('_token', csrfToken.getAttribute('content'));

    // Show loading state
    const saveButton = document.querySelector('#vehicleFuelModal .btn-primary');
    const originalText = saveButton.innerHTML;
    saveButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
    saveButton.disabled = true;

    // Send AJAX request
    fetch('{{ route("account.scope1.vehicle-usage-fuel.store") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrfToken.getAttribute('content')
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Move card to done section
            moveVehicleCardToDone(data.vehicle);

            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('vehicleFuelModal'));
            modal.hide();

            // Show success message
            showSuccessMessage('Vehicle fuel data saved successfully!');
        } else {
            alert('Error saving data: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error saving data. Please try again.');
    })
    .finally(() => {
        // Reset button state
        saveButton.innerHTML = originalText;
        saveButton.disabled = false;
    });
}

// Move card from needs data to done
function moveVehicleCardToDone(vehicle) {
    if (!currentVehicleCard) return;

    // Create new card structure for "Done" section
    const doneCard = document.createElement('div');
    doneCard.className = 'vehicle-card-done mb-3';
    doneCard.setAttribute('data-vehicle-id', vehicle.id);

    doneCard.innerHTML = `
        <div class="vehicle-card-done-content">
            <div class="vehicle-card-done-icon">
                <img src="/images/admin/vehicles/${vehicle.vehicle_icon}" alt="${vehicle.make} ${vehicle.model}" />
            </div>
            <div class="vehicle-card-done-info">
                <div class="vehicle-card-done-name">
                    ${vehicle.make} ${vehicle.model}
                    <i class="fas fa-check-circle text-success ms-2"></i>
                </div>
                <div class="vehicle-card-done-type">${vehicle.vehicle_type ? vehicle.vehicle_type.charAt(0).toUpperCase() + vehicle.vehicle_type.slice(1) : 'Car'}-${vehicle.usage_data_type ? vehicle.usage_data_type.charAt(0).toUpperCase() + vehicle.usage_data_type.slice(1) : 'Average'}</div>
                <div class="vehicle-card-done-description">${vehicle.year || 'work'}</div>
            </div>
            <div class="vehicle-card-done-emissions">
                <div class="emissions-amount">${(vehicle.fuel_amount * 0.1).toFixed(2)} tCO₂e</div>
            </div>
            <div class="vehicle-card-done-actions">
                <button class="btn btn-sm btn-outline-primary" onclick="openVehicleFuelModal(${vehicle.id}, '${vehicle.make} ${vehicle.model}', '${vehicle.vehicle_type}', '${vehicle.vehicle_icon}', ${vehicle.fuel_amount}, '${vehicle.fuel_unit}', '${vehicle.fuel_type}')">
                    Edit data <i class="fas fa-external-link-alt ms-1"></i>
                </button>
            </div>
        </div>
    `;

    // Remove the original card
    currentVehicleCard.remove();

    // Add to "Done" section
    const doneSection = document.querySelector('.col-md-6:last-child');
    const doneCardsContainer = doneSection.querySelector('.text-center');

    if (doneCardsContainer && doneCardsContainer.classList.contains('text-center')) {
        // Replace the "no completed vehicles" message
        doneCardsContainer.parentNode.replaceChild(doneCard, doneCardsContainer);
    } else {
        // Add to existing cards
        doneCardsContainer.parentNode.insertBefore(doneCard, doneCardsContainer);
    }

    // Update counters
    updateVehicleCounters();

    // Clear current references
    currentVehicleId = null;
    currentVehicleCard = null;
}

// Update counters
function updateVehicleCounters() {
    const needsDataCards = document.querySelectorAll('.col-md-6:first-child .vehicle-card');
    const doneCards = document.querySelectorAll('.col-md-6:last-child .vehicle-card');

    // Update needs data counter
    const needsDataCounter = document.querySelector('.col-md-6:first-child h5 strong');
    needsDataCounter.textContent = `${needsDataCards.length} Vehicle needs data added`;

    // Update done counter
    const doneCounter = document.querySelector('.col-md-6:last-child h5 strong');
    doneCounter.textContent = `${doneCards.length} Done`;

    // Update summary header
    const summaryHeader = document.querySelector('.content-body h4 span');
    summaryHeader.textContent = needsDataCards.length;
}

// Show success message
function showSuccessMessage(message) {
    // Create toast notification
    const toast = document.createElement('div');
    toast.className = 'toast align-items-center text-white bg-success border-0 position-fixed';
    toast.style.top = '20px';
    toast.style.right = '20px';
    toast.style.zIndex = '9999';
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
        document.body.removeChild(toast);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('vehicleSearch');
    const vehicleCards = document.querySelectorAll('.vehicle-card');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();

        vehicleCards.forEach(card => {
            const vehicleName = card.querySelector('.vehicle-name').textContent.toLowerCase();
            const vehicleDetails = card.querySelector('.vehicle-details').textContent.toLowerCase();

            if (vehicleName.includes(searchTerm) || vehicleDetails.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
});
</script>
@endsection
