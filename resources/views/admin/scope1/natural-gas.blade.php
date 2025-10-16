@extends('admin.layout')

@section('title', 'Natural Gas Consumption (Location)')

@section('content')
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Natural Gas Consumption (Location)</h1>
        </div>
    </div>
</div>

<div class="content-body">
    {{-- Summary Header --}}
    <div class="mb-4">
        <h4 class="mb-2">You have <span class="text-warning">{{ $locationsNeedingData->count() }}</span> location that requires data.</h4>
        <p class="text-muted">Click into each Location card in the left panel to add your natural gas consumption data. You'll need the amount of natural gas consumed (e.g. 230 MCF) during your reporting period.</p>
    </div>

    {{-- Search Bar --}}
    <div class="mb-4">
        <div class="position-relative">
            <input type="text" class="form-control" id="locationSearch" placeholder="Search added locations" style="padding-left: 2.5rem;">
            <i class="fas fa-search position-absolute" style="left: 1rem; top: 50%; transform: translateY(-50%); color: #6c757d;"></i>
        </div>
    </div>

    {{-- Two Column Layout --}}
    <div class="row">
        {{-- Location needs data added --}}
        <div class="col-md-6">
            <div class="mb-3">
                <h5><strong>{{ $locationsNeedingData->count() }} Location needs data added</strong></h5>
            </div>

            @if($locationsNeedingData->count() > 0)
                @foreach($locationsNeedingData as $location)
                    <div class="location-card mb-3">
                        <div class="location-card-content">
                            <div class="location-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="location-info">
                                <div class="location-name">
                                    <strong>{{ $location->name }}</strong>
                                </div>
                                <div class="location-address">
                                    {{ $location->city }}, {{ $location->postal_code }}<br>
                                    {{ $location->state }},<br>
                                    {{ $location->country }}
                                </div>
                                <div class="location-action mt-2">
                                    <button class="btn btn-primary btn-sm" onclick="openNaturalGasModal({{ $location->id }}, '{{ $location->name }}', '{{ $location->city }}, {{ $location->postal_code }} {{ $location->state }}, {{ $location->country }}')">
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
                    <p class="text-muted">All locations have data added!</p>
                </div>
            @endif
        </div>

        {{-- Done --}}
        <div class="col-md-6">
            <div class="mb-3">
                <h5><strong>{{ $locationsCompleted->count() }} Done</strong></h5>
            </div>

            @if($locationsCompleted->count() > 0)
                @foreach($locationsCompleted as $location)
                    <div class="location-card mb-3 completed">
                        <div class="location-card-content">
                            <div class="location-icon">
                                <i class="fas fa-check-circle text-success"></i>
                            </div>
                            <div class="location-info">
                                <div class="location-name">
                                    <strong>{{ $location->name }}</strong>
                                </div>
                                <div class="location-address">
                                    {{ $location->city }}, {{ $location->postal_code }}<br>
                                    {{ $location->state }},<br>
                                    {{ $location->country }}
                                </div>
                                <div class="location-action mt-2">
                                    <button class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-edit"></i> Edit data
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-4">
                    <i class="fas fa-hourglass-half fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No completed locations yet</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Natural Gas Consumption Modal -->
<div class="modal fade" id="naturalGasModal" tabindex="-1" aria-labelledby="naturalGasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="naturalGasModalLabel">Add 2024 natural gas consumption data.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">To add your natural gas consumption data, you'll need the amount of natural gas consumed (e.g. 230 MCF) during 2024.</p>

                <!-- Location Card in Modal -->
                <div class="location-card-modal mb-3">
                    <div class="location-card-content">
                        <div class="location-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="location-info">
                            <div class="location-name" id="modalLocationName">
                                <!-- Location name will be populated here -->
                            </div>
                            <div class="location-address" id="modalLocationAddress">
                                <!-- Location address will be populated here -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form id="naturalGasForm">
                    <input type="hidden" id="locationId" name="location_id">
                    <div class="mb-3">
                        <label for="naturalGasAmount" class="form-label">How much natural gas did <span id="locationNameText"></span> use in 2024? *</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="naturalGasAmount" name="amount" step="0.01" min="0" required>
                            <select class="form-select" id="naturalGasUnit" name="unit" style="max-width: 120px;">
                                <option value="therm">therm</option>
                                <option value="mcf">MCF</option>
                                <option value="ccf">CCF</option>
                                <option value="cubic_meter">cubic meter</option>
                                <option value="gigajoule">GJ</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveNaturalGasData()">Save</button>
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
let currentLocationId = null;
let currentLocationCard = null;

// Open modal function
function openNaturalGasModal(locationId, locationName, locationAddress) {
    currentLocationId = locationId;

    // Find the current location card
    const locationCards = document.querySelectorAll('.location-card');
    locationCards.forEach(card => {
        const nameElement = card.querySelector('.location-name strong');
        if (nameElement && nameElement.textContent.trim() === locationName) {
            currentLocationCard = card;
        }
    });

    // Populate modal
    document.getElementById('modalLocationName').innerHTML = `<strong>${locationName}</strong>`;
    document.getElementById('modalLocationAddress').textContent = locationAddress;
    document.getElementById('locationNameText').textContent = locationName;
    document.getElementById('locationId').value = locationId;

    // Reset form
    document.getElementById('naturalGasAmount').value = '';
    document.getElementById('naturalGasUnit').value = 'therm';

    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('naturalGasModal'));
    modal.show();
}

// Save natural gas data
function saveNaturalGasData() {
    const amount = document.getElementById('naturalGasAmount').value;
    const unit = document.getElementById('naturalGasUnit').value;

    if (!amount || amount <= 0) {
        alert('Please enter a valid amount');
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
    formData.append('location_id', currentLocationId);
    formData.append('amount', amount);
    formData.append('unit', unit);
    formData.append('_token', csrfToken.getAttribute('content'));

    // Show loading state
    const saveButton = document.querySelector('#naturalGasModal .btn-primary');
    const originalText = saveButton.innerHTML;
    saveButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
    saveButton.disabled = true;

    // Send AJAX request
    fetch('{{ route("account.scope1.natural-gas.store") }}', {
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
            moveCardToDone();

            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('naturalGasModal'));
            modal.hide();

            // Show success message
            showSuccessMessage('Natural gas data saved successfully!');
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
function moveCardToDone() {
    if (!currentLocationCard) return;

    // Clone the card
    const cardClone = currentLocationCard.cloneNode(true);

    // Update the cloned card for done section
    const iconElement = cardClone.querySelector('.location-icon i');
    iconElement.className = 'fas fa-check-circle text-success';

    const buttonElement = cardClone.querySelector('.location-action button');
    buttonElement.className = 'btn btn-outline-secondary btn-sm';
    buttonElement.innerHTML = '<i class="fas fa-edit"></i> Edit data';

    // Add completed class
    cardClone.classList.add('completed');

    // Remove from needs data section
    currentLocationCard.remove();

    // Add to done section
    const doneSection = document.querySelector('.col-md-6:last-child');
    const doneCardsContainer = doneSection.querySelector('.location-card, .text-center');

    if (doneCardsContainer && doneCardsContainer.classList.contains('text-center')) {
        // Replace the "no completed locations" message
        doneCardsContainer.parentNode.replaceChild(cardClone, doneCardsContainer);
    } else {
        // Add to existing cards
        doneCardsContainer.parentNode.insertBefore(cardClone, doneCardsContainer);
    }

    // Update counters
    updateCounters();

    // Clear current references
    currentLocationId = null;
    currentLocationCard = null;
}

// Update counters
function updateCounters() {
    const needsDataCards = document.querySelectorAll('.col-md-6:first-child .location-card');
    const doneCards = document.querySelectorAll('.col-md-6:last-child .location-card');

    // Update needs data counter
    const needsDataCounter = document.querySelector('.col-md-6:first-child h5 strong');
    needsDataCounter.textContent = `${needsDataCards.length} Location needs data added`;

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
    const searchInput = document.getElementById('locationSearch');
    const locationCards = document.querySelectorAll('.location-card');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();

        locationCards.forEach(card => {
            const locationName = card.querySelector('.location-name').textContent.toLowerCase();
            const locationAddress = card.querySelector('.location-address').textContent.toLowerCase();

            if (locationName.includes(searchTerm) || locationAddress.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
});
</script>
@endsection

