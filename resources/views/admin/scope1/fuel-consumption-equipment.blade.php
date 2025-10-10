@extends('admin.layout')

@section('title', 'Fuel Consumption (Equipment)')

@section('content')
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Fuel Consumption (Equipment)</h1>
            <p class="text-muted mb-0">Add your 2024 fuel consumption data for your equipment.</p>
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
        <h2 class="h4 mb-3">Fuel Consumption (Equipment)</h2>
        <p class="text-muted mb-0">To calculate the emissions for your equipment, we'll gather the amount of fuel each piece of equipment used during 2024.</p>
    </div>

    {{-- Search Bar --}}
    <div class="mb-4">
        <input type="text" class="form-control" placeholder="Search added equipment" id="equipmentSearch">
    </div>

    {{-- Two Column Layout --}}
    <div class="row">
        {{-- Equipment Needing Data --}}
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Equipment needs data added <span class="badge bg-warning" id="needingDataCount">{{ $equipmentNeedingData->count() }}</span></h5>
                </div>
                <div class="card-body">
                    @if($equipmentNeedingData->count() > 0)
                        @foreach($equipmentNeedingData as $equipment)
                            <div class="equipment-card mb-3" data-equipment-id="{{ $equipment->id }}">
                                <div class="equipment-card-content">
                                    <div class="equipment-icon">
                                        @if($equipment->equipment_icon)
                                            <img src="/images/admin/equipment/{{ $equipment->equipment_icon }}" alt="Equipment" />
                                        @else
                                            <i class="fas fa-cogs"></i>
                                        @endif
                                    </div>
                                    <div class="equipment-info">
                                        <div class="equipment-name">{{ $equipment->name }}</div>
                                        <div class="equipment-type">{{ $equipment->type }}</div>
                                    </div>
                                    <div class="equipment-actions">
                                        <button class="btn btn-sm btn-primary" onclick="openFuelConsumptionModal({{ $equipment->id }}, '{{ $equipment->name }}', '{{ $equipment->type }}', '{{ $equipment->equipment_icon }}')">
                                            Add data
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-check-circle fa-3x mb-3"></i>
                            <p>All equipment have fuel consumption data added!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Completed Equipment --}}
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Done <span class="badge bg-success" id="completedCount">{{ $equipmentCompleted->count() }}</span></h5>
                </div>
                <div class="card-body">
                    @if($equipmentCompleted->count() > 0)
                        @foreach($equipmentCompleted as $equipment)
                            <div class="equipment-card-done mb-3" data-equipment-id="{{ $equipment->id }}">
                                <div class="equipment-card-done-content">
                                    <div class="equipment-card-done-icon">
                                        <img src="/images/admin/equipment/{{ $equipment->equipment_icon }}" alt="{{ $equipment->name }}" />
                                    </div>
                                    <div class="equipment-card-done-info">
                                        <div class="equipment-card-done-name">
                                            {{ $equipment->name }}
                                            <i class="fas fa-check-circle text-success ms-2"></i>
                                        </div>
                                        <div class="equipment-card-done-type">{{ $equipment->type }}</div>
                                        <div class="equipment-card-done-description">{{ $equipment->manufacturer ?? 'work' }}</div>
                                    </div>
                                    <div class="equipment-card-done-emissions">
                                        <div class="emissions-amount">{{ number_format($equipment->fuel_consumption_amount * 0.1, 2) }} tCO₂e</div>
                                    </div>
                                    <div class="equipment-card-done-actions">
                                        <button class="btn btn-sm btn-outline-primary" onclick="openFuelConsumptionModal({{ $equipment->id }}, '{{ $equipment->name }}', '{{ $equipment->type }}', '{{ $equipment->equipment_icon }}', {{ $equipment->fuel_consumption_amount }}, '{{ $equipment->fuel_consumption_unit }}', '{{ $equipment->fuel_type }}')">
                                            Edit data <i class="fas fa-external-link-alt ms-1"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-cogs fa-3x mb-3"></i>
                            <p>No equipment with fuel consumption data yet.</p>
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
            <a href="{{ route('admin.equipment.index') }}" class="btn btn-success btn-lg">
                Continue to Equipment <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</div>

<!-- Fuel Consumption Modal -->
<div class="modal fade" id="fuelConsumptionModal" tabindex="-1" aria-labelledby="fuelConsumptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fuelConsumptionModalLabel">Add 2024 fuel consumption (equipment) data.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted mb-4">To calculate the emissions for this piece of equipment, we'll gather the amount of fuel this equipment used during 2024.</p>

                {{-- Equipment Card --}}
                <div class="equipment-card-modal mb-4">
                    <div class="equipment-card-content">
                        <div class="equipment-icon">
                            <img id="modalEquipmentIcon" src="" alt="Equipment" />
                        </div>
                        <div class="equipment-info">
                            <div class="equipment-name" id="modalEquipmentName"></div>
                            <div class="equipment-type" id="modalEquipmentType"></div>
                        </div>
                    </div>
                </div>

                <form id="fuelConsumptionForm">
                    @csrf
                    <input type="hidden" id="equipmentId" name="equipment_id">

                    <div class="mb-3">
                        <label for="fuelType" class="form-label">
                            What kind of fuel does <span id="fuelTypeEquipmentName"></span> use?*
                        </label>
                        <select class="form-select" id="fuelType" name="fuel_type" required>
                            <option value="">Field required</option>
                            <option value="gasoline">Gasoline</option>
                            <option value="diesel">Diesel</option>
                            <option value="propane">Propane</option>
                            <option value="natural_gas">Natural Gas</option>
                            <option value="coal">Coal</option>
                            <option value="fuel_oil">Fuel Oil</option>
                            <option value="kerosene">Kerosene</option>
                            <option value="ethanol">Ethanol</option>
                            <option value="biodiesel">Biodiesel</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="fuelQuestion" class="form-label">
                            How much fuel did this <span id="fuelEquipmentName"></span> use in 2024?*
                        </label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="fuelAmount" name="fuel_amount" placeholder="Field required" step="0.01" min="0" required>
                            <select class="form-select" id="fuelUnit" name="fuel_unit" required>
                                <option value="">Select unit</option>
                                <option value="liter">liter</option>
                                <option value="gallon">gallon</option>
                                <option value="kilogram">kilogram</option>
                                <option value="pound">pound</option>
                                <option value="cubic_meter">cubic meter</option>
                                <option value="cubic_feet">cubic feet</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveFuelConsumptionData()">
                    <span id="saveButtonText">Save</span>
                    <span id="saveButtonSpinner" class="spinner-border spinner-border-sm ms-2" style="display: none;"></span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Equipment search functionality
document.addEventListener('DOMContentLoaded', function() {
    const equipmentSearch = document.getElementById('equipmentSearch');
    const equipmentCards = document.querySelectorAll('.equipment-card');

    if (equipmentSearch) {
        equipmentSearch.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();

            equipmentCards.forEach(card => {
                const equipmentName = card.querySelector('.equipment-name').textContent.toLowerCase();
                const equipmentType = card.querySelector('.equipment-type').textContent.toLowerCase();

                if (equipmentName.includes(searchTerm) || equipmentType.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
});

function openFuelConsumptionModal(equipmentId, equipmentName, equipmentType, equipmentIcon, fuelAmount = null, fuelUnit = null, fuelType = null) {
    // Populate modal with equipment data
    document.getElementById('equipmentId').value = equipmentId;
    document.getElementById('modalEquipmentName').textContent = equipmentName;
    document.getElementById('modalEquipmentType').textContent = equipmentType;
    document.getElementById('fuelEquipmentName').textContent = equipmentName;
    document.getElementById('fuelTypeEquipmentName').textContent = equipmentName;

    // Set equipment icon
    const iconImg = document.getElementById('modalEquipmentIcon');
    if (equipmentIcon) {
        iconImg.src = `/images/admin/equipment/${equipmentIcon}`;
        iconImg.style.display = 'block';
    } else {
        iconImg.style.display = 'none';
    }

    // Reset form
    document.getElementById('fuelConsumptionForm').reset();
    document.getElementById('equipmentId').value = equipmentId;

    // If editing existing data, populate fields
    if (fuelAmount && fuelUnit && fuelType) {
        document.getElementById('fuelAmount').value = fuelAmount;
        document.getElementById('fuelUnit').value = fuelUnit;
        document.getElementById('fuelType').value = fuelType;
        document.getElementById('saveButtonText').textContent = 'Update';
    } else {
        document.getElementById('saveButtonText').textContent = 'Save';
    }

    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('fuelConsumptionModal'));
    modal.show();
}

function saveFuelConsumptionData() {
    const form = document.getElementById('fuelConsumptionForm');
    const formData = new FormData(form);
    const saveButton = document.querySelector('#fuelConsumptionModal .btn-primary');
    const saveButtonText = document.getElementById('saveButtonText');
    const saveButtonSpinner = document.getElementById('saveButtonSpinner');

    // Show loading state
    saveButton.disabled = true;
    saveButtonText.style.display = 'none';
    saveButtonSpinner.style.display = 'inline-block';

    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('{{ route("admin.scope1.fuel-consumption-equipment.store") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            equipment_id: formData.get('equipment_id'),
            fuel_type: formData.get('fuel_type'),
            fuel_amount: formData.get('fuel_amount'),
            fuel_unit: formData.get('fuel_unit')
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Hide modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('fuelConsumptionModal'));
            modal.hide();

            // Move card to done section
            moveCardToDone(data.equipment);

            // Show success message
            showSuccessMessage(data.message);
        } else {
            throw new Error(data.message || 'An error occurred');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error saving equipment fuel consumption data: ' + error.message);
    })
    .finally(() => {
        // Reset loading state
        saveButton.disabled = false;
        saveButtonText.style.display = 'inline';
        saveButtonSpinner.style.display = 'none';
    });
}

function moveCardToDone(equipment) {
    const equipmentId = equipment.id;
    const card = document.querySelector(`[data-equipment-id="${equipmentId}"]`);

    if (card) {
        // Create new card structure for "Done" section
        const doneCard = document.createElement('div');
        doneCard.className = 'equipment-card-done mb-3';
        doneCard.setAttribute('data-equipment-id', equipment.id);

        doneCard.innerHTML = `
            <div class="equipment-card-done-content">
                <div class="equipment-card-done-icon">
                    <img src="/images/admin/equipment/${equipment.equipment_icon}" alt="${equipment.name}" />
                </div>
                <div class="equipment-card-done-info">
                    <div class="equipment-card-done-name">
                        ${equipment.name}
                        <i class="fas fa-check-circle text-success ms-2"></i>
                    </div>
                    <div class="equipment-card-done-type">${equipment.type}</div>
                    <div class="equipment-card-done-description">${equipment.manufacturer || 'work'}</div>
                </div>
                <div class="equipment-card-done-emissions">
                    <div class="emissions-amount">${(equipment.fuel_consumption_amount * 0.1).toFixed(2)} tCO₂e</div>
                </div>
                <div class="equipment-card-done-actions">
                    <button class="btn btn-sm btn-outline-primary" onclick="openFuelConsumptionModal(${equipment.id}, '${equipment.name}', '${equipment.type}', '${equipment.equipment_icon}', ${equipment.fuel_consumption_amount}, '${equipment.fuel_consumption_unit}', '${equipment.fuel_type}')">
                        Edit data <i class="fas fa-external-link-alt ms-1"></i>
                    </button>
                </div>
            </div>
        `;

        // Remove the original card
        card.remove();

        // Add to "Done" section
        const doneSection = document.querySelector('#equipmentCompleted .card-body');
        doneSection.appendChild(doneCard);

        // Update counters
        updateCounters();
    }
}

function updateCounters() {
    const needingDataCount = document.querySelectorAll('.col-md-6:first-child .equipment-card:not(.completed)').length;
    const completedCount = document.querySelectorAll('.col-md-6:last-child .equipment-card.completed').length;

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
