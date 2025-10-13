@extends('admin.layout')

@section('content')
<!-- Cancel Button -->
<div class="mb-4">
    <a href="{{ route('admin.scope3.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i> Cancel
    </a>
</div>

<div class="content-body">
    <!-- Header Section -->
    <div class="mb-4">
        <h1 class="h2 fw-bold mb-2">Business Travel - Commercial Air Travel</h1>
        <div class="d-flex align-items-center mb-3">
            <span class="text-muted me-2">Scope 3 - Category 6</span>
            <span class="badge bg-light text-dark px-2 py-1 rounded">2024</span>
        </div>
        <p class="text-muted mb-4">
            This category accounts for the transportation of employees for business-related activities in commercial flights operated by third parties in the reporting year 2024. The most accurate...
            <span id="additional-text" style="display: none;">way to calculate emissions is by using the distance traveled for each flight.<br><br>
                If this data is not readily available, alternately you can request spend data from your accounting, finance, or HR team. Most companies track business travel in a 3rd party expense tracking system, like SAP Concur or Navan. If you still have questions, please use the message center on the right.</span>
            <a href="#" class="text-primary text-decoration-none" id="show-more-link" onclick="toggleDescription()">Show more</a>
        </p>
    </div>

    <!-- Form Section -->
    <form>
        <!-- Question 01 -->
        <div class="mb-5">
            <div class="d-flex align-items-center mb-4">
                <span class="badge bg-dark text-white px-2 py-1 me-2 rounded">01</span>
                <label class="form-label fw-semibold mb-0">
                    What type of travel data do you have for reporting year 2024? <span class="text-danger">*</span>
                </label>
            </div>

            <div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="travel_data_type" id="distance_traveled" value="distance_traveled" checked onchange="showQuestion02()">
                    <label class="form-check-label d-flex align-items-center" for="distance_traveled">
                        <span class="me-2">Distance traveled in 2024</span>
                        <span class="badge bg-warning text-dark px-2 py-1 rounded-pill">Recommended</span>
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="travel_data_type" id="amount_spent" value="amount_spent" onchange="showQuestion02()">
                    <label class="form-check-label" for="amount_spent">
                        Amount spent in 2024
                    </label>
                </div>
            </div>
        </div>

        <!-- Question 02 - Distance Traveled (shown when distance_traveled is selected) -->
        <div id="question02-distance" class="mb-5" style="display: block;">
            <div class="d-flex align-items-center mb-4">
                <span class="badge bg-dark text-white px-2 py-1 me-2 rounded">02</span>
                <label class="form-label fw-semibold mb-0">
                    To proceed with Distance-Based data, download and complete the Excel template below.
                </label>
            </div>

            <div class="d-flex align-items-center mb-4">
                <button class="btn btn-outline-primary me-3">
                    <i class="fas fa-download me-2"></i> Download template
                </button>
                <a href="#" class="text-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#distanceTemplateModal">Learn more</a>
            </div>

            <div class="file-upload-area text-center p-5 border border-dashed rounded-lg bg-light" style="max-width: 600px;">
                <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                <p class="text-muted mb-3">Select a file or drop here to upload.</p>
                <button type="button" class="btn btn-outline-secondary mb-2" onclick="document.getElementById('distanceFileInput').click()">Select File</button>
                <input type="file" id="distanceFileInput" style="display: none;" accept=".xlsx,.xls,.csv">
                <small class="text-muted d-block">Max size 10MB</small>
            </div>
        </div>

        <!-- Question 02 - Amount Spent (hidden when distance_traveled is selected) -->
        <div id="question02-amount" class="mb-5" style="display: none;">
            <div class="d-flex align-items-center mb-4">
                <span class="badge bg-dark text-white px-2 py-1 me-2 rounded">02</span>
                <label class="form-label fw-semibold mb-0">
                    To proceed with Spend-Based Industry data, download and complete the Excel template below.
                </label>
            </div>

            <div class="d-flex align-items-center mb-3">
                <button class="btn btn-outline-primary me-3">
                    <i class="fas fa-download me-2"></i> Download template
                </button>
                <a href="#" class="text-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#amountTemplateModal">Learn more</a>
            </div>

            <p class="text-muted mb-4">Once completed, upload the file to submit it to your climate professional to review.</p>

            <div class="file-upload-area text-center p-5 border border-dashed rounded-lg bg-light" style="max-width: 600px;">
                <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                <p class="text-muted mb-3">Select a file or drop here to upload.</p>
                <button type="button" class="btn btn-outline-secondary mb-2" onclick="document.getElementById('amountFileInput').click()">Select File</button>
                <input type="file" id="amountFileInput" style="display: none;" accept=".xlsx,.xls,.csv">
                <small class="text-muted d-block">Max size 10MB</small>
            </div>
        </div>

        <!-- Additional spacing -->
        <div class="mb-5"></div>
        <div class="mb-5"></div>
    </form>
</div>

<!-- Sticky Footer -->
<div class="sticky-continue-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <button type="button" class="btn btn-dark btn-lg px-5">
                    Submit Data for Review
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.sticky-continue-footer {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: white;
    padding: 1rem 0;
    border-top: 1px solid #e9ecef;
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
}

.content-body {
    padding-bottom: 100px;
    min-height: 70vh;
}

.form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.form-check-label {
    font-size: 0.95rem;
    line-height: 1.4;
}

.badge.bg-warning {
    background-color: #ffc107 !important;
    color: #000 !important;
}

.badge.bg-light {
    background-color: #f8f9fa !important;
    color: #6c757d !important;
}

.file-upload-area {
    border: 2px dashed #dee2e6 !important;
    background-color: #f8f9fa !important;
    transition: all 0.3s ease;
}

.file-upload-area:hover {
    border-color: #007bff !important;
    background-color: #e3f2fd !important;
}

.file-upload-area i {
    color: #6c757d !important;
}
</style>

<script>
function toggleDescription() {
    const additionalText = document.getElementById('additional-text');
    const showMoreLink = document.getElementById('show-more-link');

    if (additionalText.style.display === 'none') {
        additionalText.style.display = 'inline';
        showMoreLink.textContent = 'Show less';
    } else {
        additionalText.style.display = 'none';
        showMoreLink.textContent = 'Show more';
    }
}

function showQuestion02() {
    const distanceRadio = document.getElementById('distance_traveled');
    const amountRadio = document.getElementById('amount_spent');
    const distanceQuestion = document.getElementById('question02-distance');
    const amountQuestion = document.getElementById('question02-amount');

    if (distanceRadio.checked) {
        distanceQuestion.style.display = 'block';
        amountQuestion.style.display = 'none';
    } else if (amountRadio.checked) {
        distanceQuestion.style.display = 'none';
        amountQuestion.style.display = 'block';
    }
}

// Initialize the display on page load
document.addEventListener('DOMContentLoaded', function() {
    showQuestion02();

    // Handle file selection for distance traveled
    document.getElementById('distanceFileInput').addEventListener('change', function(e) {
        handleFileSelection(e, 'distance');
    });

    // Handle file selection for amount spent
    document.getElementById('amountFileInput').addEventListener('change', function(e) {
        handleFileSelection(e, 'amount');
    });
});

function handleFileSelection(event, type) {
    const file = event.target.files[0];
    if (file) {
        // Check file size (10MB limit)
        if (file.size > 10 * 1024 * 1024) {
            alert('File size must be less than 10MB');
            event.target.value = ''; // Clear the input
            return;
        }

        // Check file type
        const allowedTypes = ['.xlsx', '.xls', '.csv'];
        const fileExtension = '.' + file.name.split('.').pop().toLowerCase();
        if (!allowedTypes.includes(fileExtension)) {
            alert('Please select an Excel file (.xlsx, .xls) or CSV file (.csv)');
            event.target.value = ''; // Clear the input
            return;
        }

        // Show success message
        const button = event.target.previousElementSibling;
        const originalText = button.textContent;
        button.textContent = 'File Selected ✓';
        button.classList.remove('btn-outline-secondary');
        button.classList.add('btn-success');

        // Reset button after 3 seconds
        setTimeout(() => {
            button.textContent = originalText;
            button.classList.remove('btn-success');
            button.classList.add('btn-outline-secondary');
        }, 3000);

        console.log(`${type} file selected:`, file.name, file.size, 'bytes');
    }
}

function removeSource(type) {
    if (confirm('Are you sure you want to remove this emissions source? You can add it back at any time.')) {
        // Close the modal
        const modal = type === 'distance' ?
            bootstrap.Modal.getInstance(document.getElementById('distanceTemplateModal')) :
            bootstrap.Modal.getInstance(document.getElementById('amountTemplateModal'));
        modal.hide();

        // Make AJAX call to remove the source
        fetch("{{ route('admin.scope3.remove-source') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                source_type: 'business_travel'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Redirect back to Scope 3 index page
                window.location.href = "{{ route('admin.scope3.index') }}";
            } else {
                alert('Error removing source. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error removing source. Please try again.');
        });
    }
}
</script>

<!-- Template Details Modal -->
<div class="modal fade" id="distanceTemplateModal" tabindex="-1" aria-labelledby="distanceTemplateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom pb-3">
                <h5 class="modal-title fw-bold fs-4" id="distanceTemplateModalLabel">Template Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <p class="fw-bold mb-4 fs-5">To calculate your emissions based on the distance traveled, the two columns which require data are:</p>

                <ol class="mb-4 ps-3">
                    <li class="mb-3 fs-6">
                        <strong>Distance Traveled</strong> - Enter the distance traveled in this freeform text entry field. This could be for a single flight or summed across all flights.
                    </li>
                    <li class="mb-3 fs-6">
                        <strong>Distance Traveled UOM</strong> - Select a unit of measure applicable to the Distance Traveled from the dropdown list.
                    </li>
                </ol>

                <div class="bg-light p-3 rounded mb-3">
                    <p class="mb-2 fs-6">If you decide that you no longer want to calculate this category, you can remove it as an emissions source. You can add this source back at any time.</p>
                    <a href="#" class="text-danger text-decoration-none fw-semibold" onclick="removeSource('distance')">Remove Source</a>
                </div>
            </div>
            <div class="modal-footer border-top pt-3">
                <button type="button" class="btn btn-dark btn-lg px-4" data-bs-dismiss="modal">Got It</button>
            </div>
        </div>
    </div>
</div>

<!-- Amount Spent Template Details Modal -->
<div class="modal fade" id="amountTemplateModal" tabindex="-1" aria-labelledby="amountTemplateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom pb-3">
                <h5 class="modal-title fw-bold fs-4" id="amountTemplateModalLabel">Template Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <p class="fw-bold mb-4 fs-5">To calculate your emissions based on the amount spent, the three columns which require data are:</p>

                <ol class="mb-4 ps-3">
                    <li class="mb-3 fs-6">
                        <strong>Purchase Spend</strong> - Enter the amount of money your organization spent on commercial air travel. This can be for a single flight or summed across all flights.
                    </li>
                    <li class="mb-3 fs-6">
                        <strong>Purchase Spend UOM</strong> - Select a currency unit that is applicable to the Purchase Spend.
                    </li>
                    <li class="mb-3 fs-6">
                        <strong>Country</strong> - Select a country where the purchase was made from the dropdown list.
                    </li>
                </ol>

                <div class="bg-light p-3 rounded mb-3">
                    <p class="mb-2 fs-6">If you decide that you no longer want to calculate this category, you can remove it as an emissions source. You can add this source back at any time.</p>
                    <a href="#" class="text-danger text-decoration-none fw-semibold" onclick="removeSource('amount')">Remove Source</a>
                </div>
            </div>
            <div class="modal-footer border-top pt-3">
                <button type="button" class="btn btn-dark btn-lg px-4" data-bs-dismiss="modal">Got It</button>
            </div>
        </div>
    </div>
</div>
@endsection
