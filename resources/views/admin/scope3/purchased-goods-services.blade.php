@extends('admin.layout')

@section('content')
<!-- Cancel Button -->
<div class="mb-4">
    <a href="{{ route('account.scope3.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i> Cancel
    </a>
</div>

<div class="content-body">
    <!-- Header Section -->
    <div class="mb-4">
        <h1 class="h2 fw-bold mb-2">Purchased Goods and Services</h1>
        <div class="d-flex align-items-center mb-3">
            <span class="text-muted me-2">Scope 3 - Category 1</span>
            <span class="badge bg-light text-dark px-2 py-1 rounded">2024</span>
        </div>
        <p class="text-muted mb-4">
            This category accounts for all upstream (i.e., cradle-to-gate) emissions from the production of products purchased or acquired by your organization in the reporting year 2024. The two most common approaches for calculating these emissions are the spend-based method and the physical quantity method.
            <span id="additional-text" style="display: none;"> primary ways to calculate these emissions in Pro are by providing the physical quantity (e.g., weight, volume, # of items purchased) or by using the amount spent on goods and services. Of the two, the more accurate is using physical quantity, but this may be a challenge for certain industries that spend more on services than goods.
            <br><br>
            If your organization doesn't track this data or you can't find a good match for the products you purchase in the physical quantity template, we recommend using the amount spent on items by exporting your general ledger. Everyone has a slightly different internal tracking system, but your accounting, finance, or procurement team should be able to help. Some companies track their spend based on individual supplier and others track it based on the product or services purchased. Either is fine, but ultimately you will need to submit your spend categorized by sub-industry, and this may require you to map each supplier or product to the most appropriate category. If you have questions during this process, please use the message center on the right.</span>
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
                    What type of purchase data do you have for reporting year 2024? <span class="text-danger">*</span>
                </label>
            </div>

            <div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="purchase_data_type" id="amount_spent" value="amount_spent" onchange="showQuestion02()">
                    <label class="form-check-label d-flex align-items-center" for="amount_spent">
                        <span class="me-2">Amount spent in 2024</span>
                        <span class="badge bg-warning text-dark px-2 py-1 rounded-pill">Recommended</span>
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="purchase_data_type" id="physical_quantity" value="physical_quantity" onchange="showQuestion02()">
                    <label class="form-check-label" for="physical_quantity">
                        Physical quantity purchased in 2024 (e.g., weight, volume, # of units)
                    </label>
                </div>
            </div>
        </div>

        <!-- Question 02 - Amount Spent (shown when amount_spent is selected) -->
        <div id="question02-amount" class="mb-5" style="display: none;">
            <div class="d-flex align-items-start mb-4">
                <span class="badge bg-dark text-white px-2 py-1 me-2 rounded flex-shrink-0">02</span>
                <label class="form-label fw-semibold mb-0">
                    To proceed using amount spent, download and complete the Spend-Based Industry Excel template below. Once completed, upload the file to submit it to your climate professional to review.
                </label>
            </div>

            <div class="d-flex align-items-center gap-3 mb-4">
                <button type="button" class="btn btn-outline-primary">
                    <i class="fas fa-download me-2"></i> Download template
                </button>
                <a href="#" class="text-primary text-decoration-none" onclick="openTemplateModal()">Learn more</a>
            </div>

            <!-- File Upload Area -->
            <div class="upload-area border border-2 border-dashed rounded p-5 text-center" style="background-color: #f8f9fa;">
                <div class="upload-icon mb-3">
                    <i class="fas fa-arrow-up fa-2x text-muted"></i>
                </div>
                <p class="mb-3 text-muted">Select a file or drop here to upload.</p>
                <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('fileInput').click()">
                    Select File
                </button>
                <input type="file" id="fileInput" class="d-none" accept=".xlsx,.xls,.csv">
                <p class="small text-muted mt-2 mb-0">Max size 10MB</p>
            </div>
        </div>

        <!-- Question 02 - Physical Quantity (shown when physical_quantity is selected) -->
        <div id="question02-physical" class="mb-5" style="display: none;">
            <div class="d-flex align-items-start mb-4">
                <span class="badge bg-dark text-white px-2 py-1 me-2 rounded flex-shrink-0">02</span>
                <label class="form-label fw-semibold mb-0">
                    To proceed using physical quantity, download and complete the Average-Data Based Excel template below. Once completed, upload the file to submit it to your climate professional to review.
                </label>
            </div>

            <div class="d-flex align-items-center gap-3 mb-4">
                <button type="button" class="btn btn-outline-primary">
                    <i class="fas fa-download me-2"></i> Download template
                </button>
                <a href="#" class="text-primary text-decoration-none" onclick="openPhysicalTemplateModal()">Learn more</a>
            </div>

            <!-- File Upload Area -->
            <div class="upload-area border border-2 border-dashed rounded p-5 text-center" style="background-color: #f8f9fa;">
                <div class="upload-icon mb-3">
                    <i class="fas fa-arrow-up fa-2x text-muted"></i>
                </div>
                <p class="mb-2">Select a file or drop here to upload</p>
                <button type="button" class="btn btn-outline-primary btn-sm" onclick="document.getElementById('physicalFileInput').click()">
                    Select File
                </button>
                <input type="file" id="physicalFileInput" class="d-none" accept=".xlsx,.xls,.csv" onchange="handlePhysicalFileSelect(this.files[0])">
                <p class="text-muted small mt-2 mb-0">Max size 10MB</p>
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

<!-- Template Details Modal -->
<div class="modal fade" id="templateModal" tabindex="-1" aria-labelledby="templateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom pb-3">
                <h5 class="modal-title fw-bold fs-4" id="templateModalLabel">Template Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <p class="mb-4">
                    To calculate your emissions based on the amount spent, the following four columns require data:
                </p>

                <ol class="list-unstyled">
                    <li class="mb-3">
                        <p class="fw-semibold mb-1">1. Purchase Spend</p>
                        <p class="text-muted mb-0">Amount of money your organization spent on each line item in your ledger.</p>
                    </li>
                    <li class="mb-3">
                        <p class="fw-semibold mb-1">2. Purchase Spend UOM</p>
                        <p class="text-muted mb-0">Select a currency unit that is applicable to the Purchase Spend. This information can be sourced from your purchase records.</p>
                    </li>
                    <li class="mb-3">
                        <p class="fw-semibold mb-1">3. Country</p>
                        <p class="text-muted mb-0">Choose a country where the purchase was made from the dropdown list. For example, if you are a US-based company purchasing a good from France, you would select France for this field, not the US.</p>
                    </li>
                    <li class="mb-0">
                        <p class="fw-semibold mb-1">4. Sub Industry</p>
                        <p class="text-muted mb-0">Select the specific sub-industry related to the purchase type. If you already classify your spend to North American Industry Classification System (NAICS) sub-industries, there is no additional work that needs to be done and you can simply copy and paste that into the template. If you need to do the mapping to sub-industry on your own, pick the best fit for each line of spend. If you need help, please reach out to your climate professional for assistance.</p>
                    </li>
                </ol>

                <!-- Remove Source Section -->
                <div class="mt-4 p-3 bg-light rounded">
                    <p class="text-muted mb-2 small">
                        If you decide that you no longer want to calculate this category, you can remove it as an emissions source. You can add this source back at any time.
                    </p>
                    <a href="#" class="text-primary text-decoration-underline" onclick="removeSource()">Remove Source</a>
                </div>
            </div>
            <div class="modal-footer border-top pt-3">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Got It</button>
            </div>
        </div>
    </div>
</div>

<!-- Physical Quantity Template Details Modal -->
<div class="modal fade" id="physicalTemplateModal" tabindex="-1" aria-labelledby="physicalTemplateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom pb-3">
                <h5 class="modal-title fw-bold fs-4" id="physicalTemplateModalLabel">Template Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <p class="mb-4">
                    The Average-Data Based template allows you to calculate your emissions based on the physical quantity (e.g., weight, volume, # of units). The following three columns require data:
                </p>

                <ol class="list-unstyled">
                    <li class="mb-3">
                        <p class="fw-semibold mb-1">1. Product Category</p>
                        <p class="text-muted mb-0">Choose a product category from the dropdown list. If you don't see a good fit based on your industry, you may want to try the spend-based method instead or contact your climate professional for help.</p>
                    </li>
                    <li class="mb-3">
                        <p class="fw-semibold mb-1">2. Purchased Quantity</p>
                        <p class="text-muted mb-0">Enter the total weight of purchased goods for this Footprint Activity in this freeform text entry field. This data can be sourced from your purchase records.</p>
                    </li>
                    <li class="mb-0">
                        <p class="fw-semibold mb-1">3. Purchased Quantity UOM</p>
                        <p class="text-muted mb-0">Select a unit of measure that is applicable to the Purchase Quantity.</p>
                    </li>
                </ol>

                <!-- Remove Source Section -->
                <div class="mt-4 p-3 bg-light rounded">
                    <p class="text-muted mb-2 small">
                        If you decide that you no longer want to calculate this category, you can remove it as an emissions source. You can add this source back at any time.
                    </p>
                    <a href="#" class="text-primary text-decoration-underline" onclick="removeSource()">Remove Source</a>
                </div>
            </div>
            <div class="modal-footer border-top pt-3">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Got It</button>
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

.upload-area {
    transition: all 0.3s ease;
    cursor: pointer;
}

.upload-area:hover {
    background-color: #e9ecef !important;
    border-color: #007bff !important;
}

.upload-area.dragover {
    background-color: #e3f2fd !important;
    border-color: #2196f3 !important;
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
    const amountRadio = document.getElementById('amount_spent');
    const physicalRadio = document.getElementById('physical_quantity');
    const amountQuestion = document.getElementById('question02-amount');
    const physicalQuestion = document.getElementById('question02-physical');

    if (amountRadio.checked) {
        amountQuestion.style.display = 'block';
        physicalQuestion.style.display = 'none';
    } else if (physicalRadio.checked) {
        amountQuestion.style.display = 'none';
        physicalQuestion.style.display = 'block';
    } else {
        amountQuestion.style.display = 'none';
        physicalQuestion.style.display = 'none';
    }
}

function openTemplateModal() {
    const modal = new bootstrap.Modal(document.getElementById('templateModal'));
    modal.show();
}

function openPhysicalTemplateModal() {
    const modal = new bootstrap.Modal(document.getElementById('physicalTemplateModal'));
    modal.show();
}

function handlePhysicalFileSelect(file) {
    if (!file) return;

    // Validate file type
    const allowedTypes = ['.xlsx', '.xls', '.csv'];
    const fileExtension = '.' + file.name.split('.').pop().toLowerCase();

    if (!allowedTypes.includes(fileExtension)) {
        alert('Please select a valid file type (.xlsx, .xls, .csv)');
        return;
    }

    // Validate file size (10MB)
    const maxSize = 10 * 1024 * 1024; // 10MB in bytes
    if (file.size > maxSize) {
        alert('File size must be less than 10MB');
        return;
    }

    // Update upload area to show selected file
    const uploadArea = document.querySelector('#physical-question .upload-area');
    uploadArea.innerHTML = `
        <div class="upload-success mb-3">
            <i class="fas fa-check-circle fa-2x text-success"></i>
        </div>
        <p class="mb-2 text-success fw-semibold">${file.name}</p>
        <p class="text-muted small mb-0">File selected successfully</p>
        <button type="button" class="btn btn-outline-secondary btn-sm mt-2" onclick="resetPhysicalUploadArea()">
            Change File
        </button>
    `;
}

function resetPhysicalUploadArea() {
    const uploadArea = document.querySelector('#physical-question .upload-area');
    uploadArea.innerHTML = `
        <div class="upload-icon mb-3">
            <i class="fas fa-arrow-up fa-2x text-muted"></i>
        </div>
        <p class="mb-2">Select a file or drop here to upload</p>
        <button type="button" class="btn btn-outline-primary btn-sm" onclick="document.getElementById('physicalFileInput').click()">
            Select File
        </button>
        <input type="file" id="physicalFileInput" class="d-none" accept=".xlsx,.xls,.csv" onchange="handlePhysicalFileSelect(this.files[0])">
        <p class="text-muted small mt-2 mb-0">Max size 10MB</p>
    `;
}

async function removeSource() {
    if (!confirm('Are you sure you want to remove "Purchased Goods and Services" as an emissions source? You can add it back at any time.')) {
        return;
    }

    try {
        const response = await fetch('{{ route("account.scope3.remove-source") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                source_type: 'purchased_goods'
            })
        });

        const data = await response.json();

        if (data.success) {
            // Show success message
            alert('Purchased Goods and Services has been removed from your emissions sources. You can add it back anytime from the Edit Sources modal.');

            // Redirect back to Scope 3 index page
            window.location.href = '{{ route("account.scope3.index") }}';
        } else {
            alert('Failed to remove source. Please try again.');
        }
    } catch (error) {
        console.error('Error removing source:', error);
        alert('An error occurred while removing the source.');
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    showQuestion02();

    // File upload functionality for amount spent
    const uploadArea = document.querySelector('#question02-amount .upload-area');
    const fileInput = document.getElementById('fileInput');

    // File upload functionality for physical quantity
    const physicalUploadArea = document.querySelector('#question02-physical .upload-area');
    const physicalFileInput = document.getElementById('physicalFileInput');

    // Click to upload
    uploadArea.addEventListener('click', function() {
        fileInput.click();
    });

    // Drag and drop functionality
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadArea.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('dragover');

        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            handleFileSelect(files[0]);
        }
    });

    // File input change
    fileInput.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            handleFileSelect(e.target.files[0]);
        }
    });

    // Physical quantity file upload event listeners
    if (physicalUploadArea) {
        // Click to upload
        physicalUploadArea.addEventListener('click', function() {
            physicalFileInput.click();
        });

        // Drag and drop functionality
        physicalUploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            physicalUploadArea.classList.add('dragover');
        });

        physicalUploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            physicalUploadArea.classList.remove('dragover');
        });

        physicalUploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            physicalUploadArea.classList.remove('dragover');

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handlePhysicalFileSelect(files[0]);
            }
        });
    }

    if (physicalFileInput) {
        physicalFileInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                handlePhysicalFileSelect(e.target.files[0]);
            }
        });
    }
});

function handleFileSelect(file) {
    // Validate file type
    const allowedTypes = ['.xlsx', '.xls', '.csv'];
    const fileExtension = '.' + file.name.split('.').pop().toLowerCase();

    if (!allowedTypes.includes(fileExtension)) {
        alert('Please select a valid Excel or CSV file.');
        return;
    }

    // Validate file size (10MB)
    if (file.size > 10 * 1024 * 1024) {
        alert('File size must be less than 10MB.');
        return;
    }

    // Update upload area to show selected file
    const uploadArea = document.querySelector('.upload-area');
    uploadArea.innerHTML = `
        <div class="upload-icon mb-3">
            <i class="fas fa-check-circle fa-2x text-success"></i>
        </div>
        <p class="mb-3 text-success fw-semibold">File selected: ${file.name}</p>
        <button type="button" class="btn btn-outline-secondary" onclick="resetUploadArea()">
            Select Different File
        </button>
    `;
}

function resetUploadArea() {
    const uploadArea = document.querySelector('.upload-area');
    uploadArea.innerHTML = `
        <div class="upload-icon mb-3">
            <i class="fas fa-arrow-up fa-2x text-muted"></i>
        </div>
        <p class="mb-3 text-muted">Select a file or drop here to upload.</p>
        <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('fileInput').click()">
            Select File
        </button>
        <p class="small text-muted mt-2 mb-0">Max size 10MB</p>
    `;

    // Reset file input
    document.getElementById('fileInput').value = '';
}
</script>
@endsection
