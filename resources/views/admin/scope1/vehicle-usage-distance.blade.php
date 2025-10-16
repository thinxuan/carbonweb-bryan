@extends('admin.layout')

@section('title', 'Vehicle Usage (Distance)')

@section('content')
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Vehicle Usage (Distance)</h1>
            <p class="text-muted mb-0">Add your 2024 vehicle distance data for your Internal Combustion Engine Vehicles (ICEVs).</p>
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

    {{-- Header Section --}}
    <div class="text-center mb-5">
        <h2 class="h4 mb-3">Vehicle Usage (Distance)</h2>
        <p class="text-muted mb-0">To calculate the emissions for your vehicles, we'll gather the distance each vehicle traveled during 2024.</p>
    </div>

    {{-- Search Bar --}}
    <div class="mb-4">
        <input type="text" class="form-control" placeholder="Search added vehicles" id="vehicleSearch">
    </div>

    {{-- Two Column Layout --}}
    <div class="row">
        {{-- Vehicles Needing Data --}}
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Vehicle needs data added <span class="badge bg-warning" id="needingDataCount">{{ $vehiclesNeedingData->count() }}</span></h5>
                </div>
                <div class="card-body">
                    @if($vehiclesNeedingData->count() > 0)
                        @foreach($vehiclesNeedingData as $vehicle)
                            <div class="vehicle-card mb-3" data-vehicle-id="{{ $vehicle->id }}">
                                <div class="vehicle-card-content">
                                    <div class="vehicle-icon">
                                        @if($vehicle->vehicle_icon)
                                            <img src="/images/admin/vehicles/{{ $vehicle->vehicle_icon }}" alt="Vehicle" />
                                        @else
                                            <i class="fas fa-car"></i>
                                        @endif
                                    </div>
                                    <div class="vehicle-info">
                                        <div class="vehicle-name">{{ $vehicle->make }}</div>
                                        <div class="vehicle-type">{{ ucfirst($vehicle->vehicle_type ?? 'car') }}-{{ ucfirst($vehicle->usage_data_type ?? 'average') }}</div>
                                    </div>
                                    <div class="vehicle-actions">
                                        <button class="btn btn-sm btn-primary" onclick="openVehicleDistanceModal({{ $vehicle->id }}, '{{ $vehicle->make }}', '{{ ucfirst($vehicle->vehicle_type ?? 'car') }}-{{ ucfirst($vehicle->usage_data_type ?? 'average') }}', '{{ $vehicle->vehicle_icon }}')">
                                            Add data
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-check-circle fa-3x mb-3"></i>
                            <p>All vehicles have distance data added!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Completed Vehicles --}}
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Done <span class="badge bg-success" id="completedCount">{{ $vehiclesCompleted->count() }}</span></h5>
                </div>
                <div class="card-body">
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
                                        <div class="emissions-amount">{{ number_format($vehicle->distance_amount * 0.1, 2) }} tCO₂e</div>
                                    </div>
                                    <div class="vehicle-card-done-actions">
                                        <button class="btn btn-sm btn-outline-primary" onclick="openVehicleDistanceModal({{ $vehicle->id }}, '{{ $vehicle->make }} {{ $vehicle->model }}', '{{ ucfirst($vehicle->vehicle_type ?? 'car') }}-{{ ucfirst($vehicle->usage_data_type ?? 'average') }}', '{{ $vehicle->vehicle_icon }}', {{ $vehicle->distance_amount }}, '{{ $vehicle->distance_unit }}')">
                                            Edit data <i class="fas fa-external-link-alt ms-1"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-car fa-3x mb-3"></i>
                            <p>No vehicles with distance data yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sticky Continue Footer -->
<div class="sticky-continue-footer">
    <div class="container-fluid">
        <div class="d-flex justify-content-end">
            <a href="{{ route('account.equipment.index') }}" class="btn btn-success btn-lg">
                Continue to Equipment <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</div>

<!-- Vehicle Distance Modal -->
<div class="modal fade" id="vehicleDistanceModal" tabindex="-1" aria-labelledby="vehicleDistanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vehicleDistanceModalLabel">Add 2024 vehicle usage distance data.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted mb-4">To calculate the emissions for this vehicle, we'll gather the distance this vehicle used during 2024.</p>

                {{-- Vehicle Card --}}
                <div class="vehicle-card-modal mb-4">
                    <div class="vehicle-card-content">
                        <div class="vehicle-icon">
                            <img id="modalVehicleIcon" src="" alt="Vehicle" />
                        </div>
                        <div class="vehicle-info">
                            <div class="vehicle-name" id="modalVehicleName"></div>
                            <div class="vehicle-type" id="modalVehicleType"></div>
                        </div>
                    </div>
                </div>

                <form id="vehicleDistanceForm">
                    @csrf
                    <input type="hidden" id="vehicleId" name="vehicle_id">

                    <div class="mb-3">
                        <label for="distanceQuestion" class="form-label">
                            What was the total distance traveled for <span id="distanceVehicleName"></span> in 2024?*
                        </label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="distanceAmount" name="distance_amount" placeholder="Field required" step="0.01" min="0" required>
                            <select class="form-select" id="distanceUnit" name="distance_unit" required>
                                <option value="">Select unit</option>
                                <option value="kilometer">kilometer</option>
                                <option value="mile">mile</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveVehicleDistanceData()">
                    <span id="saveButtonText">Save</span>
                    <span id="saveButtonSpinner" class="spinner-border spinner-border-sm ms-2" style="display: none;"></span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Vehicle search functionality
document.addEventListener('DOMContentLoaded', function() {
    const vehicleSearch = document.getElementById('vehicleSearch');
    const vehicleCards = document.querySelectorAll('.vehicle-card');

    if (vehicleSearch) {
        vehicleSearch.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();

            vehicleCards.forEach(card => {
                const vehicleName = card.querySelector('.vehicle-name').textContent.toLowerCase();
                const vehicleType = card.querySelector('.vehicle-type').textContent.toLowerCase();

                if (vehicleName.includes(searchTerm) || vehicleType.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
});

function openVehicleDistanceModal(vehicleId, vehicleName, vehicleType, vehicleIcon, distanceAmount = null, distanceUnit = null) {
    // Populate modal with vehicle data
    document.getElementById('vehicleId').value = vehicleId;
    document.getElementById('modalVehicleName').textContent = vehicleName;
    document.getElementById('modalVehicleType').textContent = vehicleType;
    document.getElementById('distanceVehicleName').textContent = vehicleName;

    // Set vehicle icon
    const iconImg = document.getElementById('modalVehicleIcon');
    if (vehicleIcon) {
        iconImg.src = `/images/admin/vehicles/${vehicleIcon}`;
        iconImg.style.display = 'block';
    } else {
        iconImg.style.display = 'none';
    }

    // Reset form
    document.getElementById('vehicleDistanceForm').reset();
    document.getElementById('vehicleId').value = vehicleId;

    // If editing existing data, populate fields
    if (distanceAmount && distanceUnit) {
        document.getElementById('distanceAmount').value = distanceAmount;
        document.getElementById('distanceUnit').value = distanceUnit;
        document.getElementById('saveButtonText').textContent = 'Update';
    } else {
        document.getElementById('saveButtonText').textContent = 'Save';
    }

    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('vehicleDistanceModal'));
    modal.show();
}

function saveVehicleDistanceData() {
    const form = document.getElementById('vehicleDistanceForm');
    const formData = new FormData(form);
    const saveButton = document.querySelector('#vehicleDistanceModal .btn-primary');
    const saveButtonText = document.getElementById('saveButtonText');
    const saveButtonSpinner = document.getElementById('saveButtonSpinner');

    // Show loading state
    saveButton.disabled = true;
    saveButtonText.style.display = 'none';
    saveButtonSpinner.style.display = 'inline-block';

    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('{{ route("account.scope1.vehicle-usage-distance.store") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            vehicle_id: formData.get('vehicle_id'),
            distance_amount: formData.get('distance_amount'),
            distance_unit: formData.get('distance_unit')
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Hide modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('vehicleDistanceModal'));
            modal.hide();

            // Move card to done section
            moveCardToDone(data.vehicle);

            // Show success message
            showSuccessMessage(data.message);
        } else {
            throw new Error(data.message || 'An error occurred');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error saving vehicle distance data: ' + error.message);
    })
    .finally(() => {
        // Reset loading state
        saveButton.disabled = false;
        saveButtonText.style.display = 'inline';
        saveButtonSpinner.style.display = 'none';
    });
}

function moveCardToDone(vehicle) {
    const vehicleId = vehicle.id;
    const card = document.querySelector(`[data-vehicle-id="${vehicleId}"]`);

    if (card) {
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
                    <div class="emissions-amount">${(vehicle.distance_amount * 0.1).toFixed(2)} tCO₂e</div>
                </div>
                <div class="vehicle-card-done-actions">
                    <button class="btn btn-sm btn-outline-primary" onclick="openVehicleDistanceModal(${vehicle.id}, '${vehicle.make} ${vehicle.model}', '${vehicle.vehicle_type}-${vehicle.usage_data_type}', '${vehicle.vehicle_icon}', ${vehicle.distance_amount}, '${vehicle.distance_unit}')">
                        Edit data <i class="fas fa-external-link-alt ms-1"></i>
                    </button>
                </div>
            </div>
        `;

        // Remove the original card
        card.remove();

        // Add to "Done" section
        const doneSection = document.querySelector('.col-md-6:last-child .card-body');
        doneSection.appendChild(doneCard);

        // Update counters
        updateCounters();
    }
}

function updateCounters() {
    const needingDataCount = document.querySelectorAll('.col-md-6:first-child .vehicle-card:not(.completed)').length;
    const completedCount = document.querySelectorAll('.col-md-6:last-child .vehicle-card.completed').length;

    document.getElementById('needingDataCount').textContent = needingDataCount;
    document.getElementById('completedCount').textContent = completedCount;
}

function showSuccessMessage(message) {
    // Create and show a toast notification
    const toastHtml = `
        <div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    `;

    // Add toast to page
    const toastContainer = document.createElement('div');
    toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
    toastContainer.innerHTML = toastHtml;
    document.body.appendChild(toastContainer);

    // Show toast
    const toast = new bootstrap.Toast(toastContainer.querySelector('.toast'));
    toast.show();

    // Remove toast container after it's hidden
    toastContainer.addEventListener('hidden.bs.toast', function() {
        toastContainer.remove();
    });
}
</script>

@endsection
