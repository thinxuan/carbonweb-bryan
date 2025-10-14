@extends('admin.layout')

@section('title', 'Footprint Analytics')

@section('content')
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">FOOTPRINT ANALYTICS</h1>
            <p class="text-muted mb-0">View and analyze your total calculated footprint</p>
        </div>
    </div>
</div>

<div class="content-body">
    <div class="container-fluid">
        <!-- Controls Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="text-end">
                <div class="h4 fw-bold text-primary">{{ $footprintData['total_emissions'] }} tCO₂e</div>
                <small class="text-muted">Total Emissions</small>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Reporting Year: {{ $footprintData['reporting_year'] }}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">2024</a></li>
                        <li><a class="dropdown-item" href="#">2023</a></li>
                    </ul>
                </div>
                <button class="btn btn-outline-primary">
                    <i class="fas fa-robot me-2"></i>Copilot
                </button>
                <button class="btn btn-primary">
                    <i class="fas fa-download me-2"></i>Download
                </button>
            </div>
        </div>

        <!-- Your Footprint Section -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h3 class="h5 fw-semibold mb-3">Your Footprint</h3>
                        <div class="mb-3">
                            <small class="text-muted">{{ $footprintData['date_range'] }}</small>
                        </div>

                        <div class="mb-4">
                            <h2 class="h1 fw-bold mb-0">Total Scope 1, Scope 2, and Scope 3 emissions</h2>
                            <div class="h2 fw-bold text-primary">{{ $footprintData['total_emissions'] }} tCO₂e</div>
                        </div>

                        <!-- Scope Breakdown -->
                        <div class="scope-breakdown">
                            @foreach($footprintData['scopes'] as $scope)
                            <div class="d-flex align-items-center mb-3">
                                <div class="scope-indicator me-3" style="width: 16px; height: 16px; background-color: {{ $scope['color'] }}; border-radius: 50%;"></div>
                                <div class="flex-grow-1">
                                    <strong>{{ $scope['label'] }}:</strong> {{ $scope['value'] }}
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="mt-4">
                            <small class="text-muted">Data measured in tCO₂e. <a href="#" class="text-primary">Learn more</a></small>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <!-- Pie Chart Placeholder -->
                        <div class="pie-chart-container text-center">
                            <div class="position-relative d-inline-block">
                                <svg width="200" height="200" class="pie-chart">
                                    <!-- Scope 1 - Yellow (dominant) -->
                                    <circle cx="100" cy="100" r="80" fill="none" stroke="#fbbf24" stroke-width="40"
                                            stroke-dasharray="502.4 0" transform="rotate(-90 100 100)"></circle>
                                    <!-- Scope 2 - Purple (small slice) -->
                                    <circle cx="100" cy="100" r="80" fill="none" stroke="#8b5cf6" stroke-width="40"
                                            stroke-dasharray="2.4 500" stroke-dashoffset="-502.4" transform="rotate(-90 100 100)"></circle>
                                    <!-- Scope 3 - Pink (0, so no visible slice) -->
                                </svg>
                                <div class="position-absolute top-50 start-50 translate-middle text-center">
                                    <div class="h5 fw-bold">{{ $footprintData['total_emissions'] }}</div>
                                    <div class="small text-muted">tCO₂e</div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <small class="text-muted">Data Updated: {{ $footprintData['last_updated'] }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Footprint Analytics Section -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex align-items-start">
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-warning text-dark me-2">Upgrade</span>
                            <h3 class="h5 fw-semibold mb-0">Additional Footprint Analytics</h3>
                        </div>
                        <p class="text-muted mb-3">View a comprehensive breakdown of your footprint by category and GHG footprint category. Understand which aspects of your organization are the top emitters.</p>
                        <a href="#" class="text-primary text-decoration-none">Learn more about additional footprint analytics</a>
                    </div>
                    <div class="ms-4">
                        <button class="btn btn-primary">
                            <i class="fas fa-arrow-up me-2"></i>Upgrade to View Metrics
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.pie-chart {
    filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
}

.scope-indicator {
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.card {
    border-radius: 12px;
}

.btn {
    border-radius: 8px;
}

.badge {
    font-size: 0.75rem;
    padding: 0.375rem 0.75rem;
}

.scope-breakdown {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 1rem;
}
</style>
@endsection
