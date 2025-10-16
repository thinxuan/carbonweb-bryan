@extends('account.layout')

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
        <h1 class="h2 fw-bold mb-2">{{ $categoryData['title'] }}</h1>
        <div class="d-flex align-items-center mb-3">
            <span class="text-muted me-2">{{ $categoryData['scope'] }}</span>
            <span class="badge bg-light text-dark px-2 py-1 rounded">2024</span>
        </div>
        <p class="text-muted mb-4">
            {{ $categoryData['description'] }}
            <span id="additional-text" style="display: none;">{{ $categoryData['additional_text'] }}</span>
            <a href="#" class="text-primary text-decoration-none" id="show-more-link" onclick="toggleDescription()">Show more</a>
        </p>
    </div>

    <!-- Form Section -->
    <form>
        @if($categoryData['template_type'] === 'dual_option')
            <!-- Question 01 - Dual Option -->
            <div class="mb-5">
                <div class="d-flex align-items-center mb-4">
                    <span class="badge bg-dark text-white px-2 py-1 me-2 rounded">01</span>
                    <label class="form-label fw-semibold mb-0">
                        What type of {{ strtolower(str_replace(['-', '_'], ' ', $category)) }} data do you have for reporting year 2024? <span class="text-danger">*</span>
                    </label>
                </div>

                <div>
                    @foreach($categoryData['options'] as $optionKey => $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="data_type" id="{{ $optionKey }}" value="{{ $optionKey }}" onchange="showQuestion02()">
                            <label class="form-check-label d-flex align-items-center" for="{{ $optionKey }}">
                                <span class="me-2">{{ $option['title'] }}</span>
                                @if($option['recommended'])
                                    <span class="badge bg-warning text-dark px-2 py-1 rounded-pill">Recommended</span>
                                @endif
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Dynamic Question 02 Sections -->
            @foreach($categoryData['options'] as $optionKey => $option)
                <div id="question02-{{ $optionKey }}" class="mb-5" style="display: none;">
                    <div class="d-flex align-items-start mb-4">
                        <span class="badge bg-dark text-white px-2 py-1 me-2 rounded flex-shrink-0">02</span>
                        <label class="form-label fw-semibold mb-0">
                            {{ $option['description'] }}
                        </label>
                    </div>

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <button type="button" class="btn btn-outline-primary">
                            <i class="fas fa-download me-2"></i> Download template
                        </button>
                        <a href="#" class="text-primary text-decoration-none" onclick="openLearnMoreModal('{{ $optionKey }}')">Learn more</a>
                    </div>

                    <!-- File Upload Area -->
                    <div class="upload-area border border-2 border-dashed rounded p-5 text-center" style="background-color: #f8f9fa;">
                        <div class="upload-icon mb-3">
                            <i class="fas fa-arrow-up fa-2x text-muted"></i>
                        </div>
                        <p class="mb-3 text-muted">Select a file or drop here to upload.</p>
                        <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('fileInput_{{ $optionKey }}').click()">
                            Select File
                        </button>
                        <input type="file" id="fileInput_{{ $optionKey }}" class="d-none" accept=".xlsx,.xls,.csv">
                        <p class="small text-muted mt-2 mb-0">Max size 10MB</p>
                    </div>
                </div>
            @endforeach

        @elseif($categoryData['template_type'] === 'single_option')
            <!-- Question 01 - Single Option -->
            <div class="mb-5">
                <div class="d-flex align-items-center mb-4">
                    <span class="badge bg-dark text-white px-2 py-1 me-2 rounded">01</span>
                    <label class="form-label fw-semibold mb-0">
                        What type of {{ strtolower(str_replace(['-', '_'], ' ', $category)) }} data do you have for reporting year 2024? <span class="text-danger">*</span>
                    </label>
                </div>

                <div>
                    @foreach($categoryData['options'] as $optionKey => $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="data_type" id="{{ $optionKey }}" value="{{ $optionKey }}" checked onchange="showQuestion02()">
                            <label class="form-check-label d-flex align-items-center" for="{{ $optionKey }}">
                                <span class="me-2">{{ $option['title'] }}</span>
                                @if($option['recommended'])
                                    <span class="badge bg-warning text-dark px-2 py-1 rounded-pill">Recommended</span>
                                @endif
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Dynamic Question 02 Section -->
            @foreach($categoryData['options'] as $optionKey => $option)
                <div id="question02-{{ $optionKey }}" class="mb-5" style="display: block;">
                    <div class="d-flex align-items-start mb-4">
                        <span class="badge bg-dark text-white px-2 py-1 me-2 rounded flex-shrink-0">02</span>
                        <label class="form-label fw-semibold mb-0">
                            {{ $option['description'] }}
                        </label>
                    </div>

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <button type="button" class="btn btn-outline-primary">
                            <i class="fas fa-download me-2"></i> Download template
                        </button>
                        <a href="#" class="text-primary text-decoration-none" onclick="openLearnMoreModal('{{ $optionKey }}')">Learn more</a>
                    </div>

                    <!-- File Upload Area -->
                    <div class="upload-area border border-2 border-dashed rounded p-5 text-center" style="background-color: #f8f9fa;">
                        <div class="upload-icon mb-3">
                            <i class="fas fa-arrow-up fa-2x text-muted"></i>
                        </div>
                        <p class="mb-3 text-muted">Select a file or drop here to upload.</p>
                        <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('fileInput_{{ $optionKey }}').click()">
                            Select File
                        </button>
                        <input type="file" id="fileInput_{{ $optionKey }}" class="d-none" accept=".xlsx,.xls,.csv">
                        <p class="small text-muted mt-2 mb-0">Max size 10MB</p>
                    </div>
                </div>
            @endforeach

        @elseif($categoryData['template_type'] === 'direct_upload')
            <!-- Direct Upload - No Question 01, Direct to Upload -->
            @foreach($categoryData['options'] as $optionKey => $option)
                <div class="mb-5">
                    <div class="mb-4">
                        <label class="form-label fw-semibold mb-0">
                            {{ $option['description'] }}
                        </label>
                    </div>

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <button type="button" class="btn btn-outline-primary">
                            <i class="fas fa-download me-2"></i> Download template
                        </button>
                        <a href="#" class="text-primary text-decoration-none" onclick="openLearnMoreModal('{{ $optionKey }}')">Learn more</a>
                    </div>

                    <!-- File Upload Area -->
                    <div class="upload-area border border-2 border-dashed rounded p-5 text-center" style="background-color: #f8f9fa;">
                        <div class="upload-icon mb-3">
                            <i class="fas fa-arrow-up fa-2x text-muted"></i>
                        </div>
                        <p class="mb-3 text-muted">Select a file or drop here to upload.</p>
                        <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('fileInput_{{ $optionKey }}').click()">
                            Select File
                        </button>
                        <input type="file" id="fileInput_{{ $optionKey }}" class="d-none" accept=".xlsx,.xls,.csv">
                        <p class="small text-muted mt-2 mb-0">Max size 10MB</p>
                    </div>
                </div>
            @endforeach
        @endif

        <!-- Additional spacing -->
        <div class="mb-5"></div>
        <div class="mb-5"></div>
    </form>

    <!-- Submit Button -->
    <div class="sticky-continue-footer">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <button type="button" class="btn btn-primary w-100">
                        Submit Data for Review
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dynamic Learn More Modals -->
@foreach($categoryData['options'] as $optionKey => $option)
    @if(isset($option['learn_more']))
        <!-- {{ $option['template_name'] }} Template Details Modal -->
        <div class="modal fade" id="learnMoreModal_{{ $optionKey }}" tabindex="-1" aria-labelledby="learnMoreModalLabel_{{ $optionKey }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom pb-3">
                        <h5 class="modal-title fw-bold fs-4" id="learnMoreModalLabel_{{ $optionKey }}">{{ $option['learn_more']['title'] }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-4">
                        <p class="mb-4">
                            {{ $option['learn_more']['description'] }}
                        </p>

                        <ol class="list-unstyled">
                            @foreach($option['learn_more']['columns'] as $index => $column)
                                <li class="mb-3">
                                    <p class="fw-semibold mb-1">{{ $index + 1 }}. {{ $column['title'] }}</p>
                                    <p class="text-muted mb-0">{!! nl2br(e($column['description'])) !!}</p>
                                </li>
                            @endforeach
                        </ol>

                        <!-- Additional Note (if exists) -->
                        @if(isset($option['learn_more']['additional_note']))
                            <div class="mt-4">
                                <p class="text-muted mb-0 small">
                                    {{ $option['learn_more']['additional_note'] }}
                                </p>
                            </div>
                        @endif

                        <!-- Remove Source Section -->
                        <div class="mt-4 p-3 bg-light rounded">
                            <p class="text-muted mb-2 small">
                                If you decide that you no longer want to calculate this category, you can remove it as an emissions source. You can add this source back at any time.
                            </p>
                            <a href="#" class="text-primary text-decoration-underline" onclick="removeSource('{{ $category }}')">Remove Source</a>
                        </div>
                    </div>
                    <div class="modal-footer border-top pt-3">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Got It</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach

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
    border-color: #007bff !important;
}
</style>

<script>
// Category data for JavaScript
const categoryData = @json($categoryData);

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
    const dataTypeRadios = document.querySelectorAll('input[name="data_type"]');

    dataTypeRadios.forEach(radio => {
        const questionDiv = document.getElementById('question02-' + radio.value);
        if (questionDiv) {
            if (radio.checked) {
                questionDiv.style.display = 'block';
            } else {
                questionDiv.style.display = 'none';
            }
        }
    });
}

function openLearnMoreModal(optionKey) {
    const modal = new bootstrap.Modal(document.getElementById('learnMoreModal_' + optionKey));
    modal.show();
}

async function removeSource(category) {
    if (!confirm('Are you sure you want to remove this category as an emissions source? You can add it back at any time.')) {
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
                source_type: category
            })
        });

        const data = await response.json();

        if (data.success) {
            alert('Category has been removed from your emissions sources. You can add it back anytime from the Edit Sources modal.');
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

    // File upload functionality for all options
    categoryData.options.forEach((option, optionKey) => {
        const uploadArea = document.querySelector('#question02-' + optionKey + ' .upload-area');
        const fileInput = document.getElementById('fileInput_' + optionKey);

        if (uploadArea && fileInput) {
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
                    handleFileSelect(files[0], optionKey);
                }
            });

            // File input change
            fileInput.addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    handleFileSelect(e.target.files[0], optionKey);
                }
            });
        }
    });
});

function handleFileSelect(file, optionKey) {
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
    const uploadArea = document.querySelector('#question02-' + optionKey + ' .upload-area');
    uploadArea.innerHTML = `
        <div class="upload-success mb-3">
            <i class="fas fa-check-circle fa-2x text-success"></i>
        </div>
        <p class="mb-2 text-success fw-semibold">${file.name}</p>
        <p class="text-muted small mb-0">File selected successfully</p>
        <button type="button" class="btn btn-outline-secondary btn-sm mt-2" onclick="resetUploadArea('${optionKey}')">
            Change File
        </button>
    `;
}

function resetUploadArea(optionKey) {
    const uploadArea = document.querySelector('#question02-' + optionKey + ' .upload-area');
    uploadArea.innerHTML = `
        <div class="upload-icon mb-3">
            <i class="fas fa-arrow-up fa-2x text-muted"></i>
        </div>
        <p class="mb-3 text-muted">Select a file or drop here to upload.</p>
        <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('fileInput_${optionKey}').click()">
            Select File
        </button>
        <input type="file" id="fileInput_${optionKey}" class="d-none" accept=".xlsx,.xls,.csv">
        <p class="small text-muted mt-2 mb-0">Max size 10MB</p>
    `;

    // Re-attach event listeners
    const fileInput = document.getElementById('fileInput_' + optionKey);
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                handleFileSelect(e.target.files[0], optionKey);
            }
        });
    }
}
</script>
@endsection
