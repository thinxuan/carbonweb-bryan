@extends('admin.layout')

@section('title', 'Scope 3')

@section('content')
<div class="container-fluid">
    <div class="content-body">
        <div class="mb-4">
            <h1 class="h2">Scope 3</h1>
        </div>

        <!-- Search Bar and Progress -->
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search Scope 3 Sources" id="scope3Search">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <div class="d-inline-flex align-items-center">
                    <div class="progress-circle me-3">
                        <div class="progress-circle-inner">
                            <span class="progress-text">0/2</span>
                        </div>
                    </div>
                    <span class="me-3">Complete</span>
                    <button class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-comments me-1"></i> Messages
                    </button>
                </div>
            </div>
        </div>

        <!-- Three Column Layout -->
        <div class="row">
            <!-- Upload Data Column -->
            <div class="col-md-4">
                <div class="scope3-column upload-data-column">
                    <div class="column-header">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            Upload Data
                            <span class="badge bg-secondary ms-2">{{ count($uploadDataItems) }}</span>
                        </h5>
                    </div>
                    <div class="column-body">
                        @foreach($uploadDataItems as $item)
                            <div class="scope3-card">
                                <div class="card-header-custom">
                                    <h6 class="card-title">{{ $item['title'] }}</h6>
                                </div>
                                <div class="card-body-custom">
                                    <p class="card-text">{{ $item['category'] }}</p>
                                </div>
                                <div class="card-footer-custom">
                                    @if($item['route'] !== '#')
                                        @if(isset($item['route_params']))
                                            <a href="{{ route($item['route'], $item['route_params']) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-plus me-1"></i> Add Data
                                            </a>
                                        @else
                                            <a href="{{ route($item['route']) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-plus me-1"></i> Add Data
                                            </a>
                                        @endif
                                    @else
                                        <button class="btn btn-primary btn-sm" disabled title="Coming Soon">
                                            <i class="fas fa-plus me-1"></i> Add Data
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="column-footer">
                        <button class="btn btn-outline-secondary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#editSourcesModal">
                            <i class="fas fa-edit me-1"></i> Edit Sources
                        </button>
                    </div>
                </div>
            </div>

            <!-- Uploaded & In Review Column -->
            <div class="col-md-4">
                <div class="scope3-column in-review-column">
                    <div class="column-header">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            Uploaded & In Review
                            <span class="badge bg-secondary ms-2">{{ count($inReviewItems) }}</span>
                        </h5>
                    </div>
                    <div class="column-body text-center">
                        @if(count($inReviewItems) > 0)
                            <!-- Items in review would go here -->
                        @else
                            <div class="empty-state">
                                <i class="fas fa-file-alt empty-icon"></i>
                                <p class="empty-text">After uploading data, your climate professional will calculate your footprint.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Done Column -->
            <div class="col-md-4">
                <div class="scope3-column done-column">
                    <div class="column-header">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            Done
                            <span class="badge bg-secondary ms-2">0 CO₂e 0</span>
                        </h5>
                    </div>
                    <div class="column-body text-center">
                        @if(count($doneItems) > 0)
                            <!-- Completed items would go here -->
                        @else
                            <div class="empty-state">
                                <i class="fas fa-check-circle empty-icon done-icon"></i>
                                <p class="empty-text">After calculation, your data and total tCO₂e will appear here.</p>
                            </div>
                        @endif
                    </div>
                    <div class="column-footer">
                        <button class="btn btn-warning btn-sm">
                            Upgrade Additional Analytics
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.scope3-column {
    background: #ffffff;
    border-radius: 12px;
    border: 1px solid #e9ecef;
    height: 600px;
    display: flex;
    flex-direction: column;
}

.upload-data-column {
    background: #ffffff;
}

.in-review-column {
    background: #f8f9fa;
}

.done-column {
    background: #f0f8f0;
}

.column-header {
    padding: 1.5rem 1.5rem 1rem 1.5rem;
    border-bottom: 1px solid #e9ecef;
}

.column-header h5 {
    font-weight: 600;
    color: #212529;
    display: flex;
    align-items: center;
}

.column-body {
    flex: 1;
    padding: 1.5rem;
    overflow-y: auto;
}

.column-footer {
    padding: 1rem 1.5rem 1.5rem 1.5rem;
    border-top: 1px solid #e9ecef;
}

.scope3-card {
    background: #ffffff;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    margin-bottom: 1rem;
    transition: all 0.2s ease;
}

.scope3-card:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.card-header-custom {
    padding: 1rem 1rem 0.5rem 1rem;
}

.card-title {
    font-weight: 600;
    color: #212529;
    margin: 0;
    font-size: 0.95rem;
    line-height: 1.3;
}

.card-body-custom {
    padding: 0.5rem 1rem;
}

.card-text {
    color: #6c757d;
    font-size: 0.85rem;
    margin: 0;
    line-height: 1.4;
}

.card-footer-custom {
    padding: 0.5rem 1rem 1rem 1rem;
}

.progress-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.progress-circle-inner {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
}

.progress-text {
    font-size: 0.75rem;
    font-weight: 600;
    color: #495057;
}

.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    padding: 2rem;
}

.empty-icon {
    font-size: 3rem;
    color: #6c757d;
    margin-bottom: 1rem;
}

.done-icon {
    color: #28a745;
}

.empty-text {
    color: #6c757d;
    text-align: center;
    font-size: 0.9rem;
    line-height: 1.4;
    margin: 0;
}

#scope3Search {
    border-radius: 8px 0 0 8px;
}

.input-group-text {
    background: #ffffff;
    border-left: 0;
    border-radius: 0 8px 8px 0;
    color: #6c757d;
}

/* Edit Sources Modal Styles */
.category-item {
    transition: all 0.2s ease;
    cursor: pointer;
}

.category-item:hover {
    background-color: #f8f9fa;
    border-color: #007bff !important;
}

.category-item input[type="checkbox"]:checked + div {
    color: #007bff;
}

.form-check-input:checked {
    background-color: #007bff;
    border-color: #007bff;
}

.categories-list::-webkit-scrollbar {
    width: 6px;
}

.categories-list::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.categories-list::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

.categories-list::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>

<!-- Edit Sources Modal -->
<div class="modal fade" id="editSourcesModal" tabindex="-1" aria-labelledby="editSourcesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom pb-3">
                <h5 class="modal-title fw-bold fs-4" id="editSourcesModalLabel">Edit Sources</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <p class="text-muted mb-4 fs-6">
                    Select which sources you would like to be tracking for your Scope 3 footprint. Note: If you remove a source that already has data associated with it, that data will still be saved and can be retrieved by adding the source back.
                </p>

                <!-- Search Bar -->
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" placeholder="Search" id="sourceSearch">
                    </div>
                </div>

                <!-- Sources Section -->
                <div class="sources-section">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="mb-0 fw-semibold d-flex align-items-center">
                            <i class="fas fa-minus-circle me-2 text-primary"></i>
                            Sources
                        </h6>
                        <span class="badge bg-primary" id="selectedCount">3 Selected</span>
                    </div>

                    <!-- Categories List -->
                    <div class="categories-list" style="max-height: 400px; overflow-y: auto;">
                        <div class="category-item p-3 border rounded mb-2 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-3" id="category1" checked>
                                <div>
                                    <label class="form-check-label fw-semibold mb-0" for="category1">
                                        Purchased Goods and Services
                                    </label>
                                    <div class="text-muted small">Category 1</div>
                                </div>
                            </div>
                            <span class="badge bg-secondary">Recommended</span>
                        </div>

                        <div class="category-item p-3 border rounded mb-2 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-3" id="category2" checked>
                                <div>
                                    <label class="form-check-label fw-semibold mb-0" for="category2">
                                        Capital Goods
                                    </label>
                                    <div class="text-muted small">Category 2</div>
                                </div>
                            </div>
                        </div>

                        <div class="category-item p-3 border rounded mb-2 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-3" id="category3">
                                <div>
                                    <label class="form-check-label fw-semibold mb-0" for="category3">
                                        Fuel and Energy-Related Activities Not Included in Scope 1 or Scope 2
                                    </label>
                                    <div class="text-muted small">Category 3</div>
                                </div>
                            </div>
                        </div>

                        <div class="category-item p-3 border rounded mb-2 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-3" id="category4">
                                <div>
                                    <label class="form-check-label fw-semibold mb-0" for="category4">
                                        Upstream Transportation and Distribution
                                    </label>
                                    <div class="text-muted small">Category 4</div>
                                </div>
                            </div>
                        </div>

                        <div class="category-item p-3 border rounded mb-2 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-3" id="category5">
                                <div>
                                    <label class="form-check-label fw-semibold mb-0" for="category5">
                                        Waste Generated in Operations
                                    </label>
                                    <div class="text-muted small">Category 5</div>
                                </div>
                            </div>
                        </div>

                        <!-- Business Travel Categories -->
                        <div class="category-item p-3 border rounded mb-2 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-3" id="category6">
                                <div>
                                    <label class="form-check-label fw-semibold mb-0" for="category6">
                                        Business Travel - Commercial Air Travel
                                    </label>
                                    <div class="text-muted small">Category 6</div>
                                </div>
                            </div>
                        </div>

                        <div class="category-item p-3 border rounded mb-2 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-3" id="category7">
                                <div>
                                    <label class="form-check-label fw-semibold mb-0" for="category7">
                                        Business Travel - Hotel Stay
                                    </label>
                                    <div class="text-muted small">Category 6</div>
                                </div>
                            </div>
                        </div>

                        <div class="category-item p-3 border rounded mb-2 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-3" id="category8">
                                <div>
                                    <label class="form-check-label fw-semibold mb-0" for="category8">
                                        Business Travel - Private Air Travel
                                    </label>
                                    <div class="text-muted small">Category 6</div>
                                </div>
                            </div>
                        </div>

                        <div class="category-item p-3 border rounded mb-2 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-3" id="category9">
                                <div>
                                    <label class="form-check-label fw-semibold mb-0" for="category9">
                                        Business Travel - Ground Travel
                                    </label>
                                    <div class="text-muted small">Category 6</div>
                                </div>
                            </div>
                        </div>

                        <div class="category-item p-3 border rounded mb-2 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-3" id="category10">
                                <div>
                                    <label class="form-check-label fw-semibold mb-0" for="category10">
                                        Employee Commuting
                                    </label>
                                    <div class="text-muted small">Category 7</div>
                                </div>
                            </div>
                        </div>

                        <div class="category-item p-3 border rounded mb-2 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-3" id="category11">
                                <div>
                                    <label class="form-check-label fw-semibold mb-0" for="category11">
                                        Upstream Leased Assets
                                    </label>
                                    <div class="text-muted small">Category 8</div>
                                </div>
                            </div>
                        </div>

                        <div class="category-item p-3 border rounded mb-2 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-3" id="category12">
                                <div>
                                    <label class="form-check-label fw-semibold mb-0" for="category12">
                                        Downstream Transportation and Distribution
                                    </label>
                                    <div class="text-muted small">Category 9</div>
                                </div>
                            </div>
                        </div>

                        <div class="category-item p-3 border rounded mb-2 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-3" id="category13">
                                <div>
                                    <label class="form-check-label fw-semibold mb-0" for="category13">
                                        Downstream Processing of Sold Products
                                    </label>
                                    <div class="text-muted small">Category 10</div>
                                </div>
                            </div>
                        </div>

                        <div class="category-item p-3 border rounded mb-2 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-3" id="category14">
                                <div>
                                    <label class="form-check-label fw-semibold mb-0" for="category14">
                                        Use of Sold Products Direct Use Phase
                                    </label>
                                    <div class="text-muted small">Category 11</div>
                                </div>
                            </div>
                        </div>

                        <div class="category-item p-3 border rounded mb-2 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-3" id="category15">
                                <div>
                                    <label class="form-check-label fw-semibold mb-0" for="category15">
                                        End of Life Treatment of Sold Products
                                    </label>
                                    <div class="text-muted small">Category 12</div>
                                </div>
                            </div>
                        </div>

                        <div class="category-item p-3 border rounded mb-2 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-3" id="category16">
                                <div>
                                    <label class="form-check-label fw-semibold mb-0" for="category16">
                                        Downstream Leased Asset
                                    </label>
                                    <div class="text-muted small">Category 13</div>
                                </div>
                            </div>
                        </div>

                        <div class="category-item p-3 border rounded mb-2 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-3" id="category17">
                                <div>
                                    <label class="form-check-label fw-semibold mb-0" for="category17">
                                        Franchises
                                    </label>
                                    <div class="text-muted small">Category 14</div>
                                </div>
                            </div>
                        </div>

                        <div class="category-item p-3 border rounded mb-2 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-3" id="category18">
                                <div>
                                    <label class="form-check-label fw-semibold mb-0" for="category18">
                                        Investment - Equity
                                    </label>
                                    <div class="text-muted small">Category 15</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top pt-3">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveSourceChanges()">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<script>
function updateSelectedCount() {
    const checkboxes = document.querySelectorAll('.category-item input[type="checkbox"]');
    const checkedCount = Array.from(checkboxes).filter(cb => cb.checked).length;
    document.getElementById('selectedCount').textContent = `${checkedCount} Selected`;
}

async function saveSourceChanges() {
    const checkboxes = document.querySelectorAll('.category-item input[type="checkbox"]');
    const selectedCategories = Array.from(checkboxes)
        .filter(cb => cb.checked)
        .map(cb => cb.id);

    console.log('Selected categories:', selectedCategories);

    // Disable the save button and show loading state
    const saveButton = document.querySelector('.modal-footer .btn-primary');
    const originalButtonText = saveButton.innerHTML;
    saveButton.disabled = true;
    saveButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Saving...';

    try {
        const response = await fetch('{{ route("admin.scope3.save-categories") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                categories: selectedCategories
            })
        });

        const data = await response.json();

        if (data.success) {
            // Show success state
            saveButton.innerHTML = '<i class="fas fa-check me-2"></i>Saved!';
            saveButton.classList.remove('btn-primary');
            saveButton.classList.add('btn-success');

            // Close modal after a brief delay
            setTimeout(() => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('editSourcesModal'));
                modal.hide();

                // Reload the page to show updated categories
                window.location.reload();
            }, 500);
        } else {
            // Restore button state
            saveButton.disabled = false;
            saveButton.innerHTML = originalButtonText;
            alert('Failed to save categories. Please try again.');
        }
    } catch (error) {
        console.error('Error saving categories:', error);
        saveButton.disabled = false;
        saveButton.innerHTML = originalButtonText;
        alert('An error occurred while saving categories.');
    }
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    // Set initial checked state based on current selection
    const selectedCategories = @json(session('scope3_selected_categories', ['category1', 'category2']));

    document.querySelectorAll('.category-item input[type="checkbox"]').forEach(checkbox => {
        if (selectedCategories.includes(checkbox.id)) {
            checkbox.checked = true;
        }

        // Add event listener
        checkbox.addEventListener('change', updateSelectedCount);
    });

    // Search functionality
    document.getElementById('sourceSearch').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        document.querySelectorAll('.category-item').forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(searchTerm) ? 'flex' : 'none';
        });
    });

    // Reset modal state when opened
    const editSourcesModal = document.getElementById('editSourcesModal');
    editSourcesModal.addEventListener('show.bs.modal', function() {
        // Reset save button state
        const saveButton = document.querySelector('.modal-footer .btn-primary, .modal-footer .btn-success');
        if (saveButton) {
            saveButton.disabled = false;
            saveButton.innerHTML = 'Save Changes';
            saveButton.classList.remove('btn-success');
            saveButton.classList.add('btn-primary');
        }

        // Reset search input
        document.getElementById('sourceSearch').value = '';

        // Show all category items
        document.querySelectorAll('.category-item').forEach(item => {
            item.style.display = 'flex';
        });
    });

    // Initial count update
    updateSelectedCount();
});
</script>
@endsection
