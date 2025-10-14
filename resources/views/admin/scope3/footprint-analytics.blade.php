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
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h2 fw-bold mb-2">2024 Footprint Analytics</h1>
                <p class="text-muted mb-0">View and analyze your total calculated footprint through different metrics and visualizations. Analytics can take up to 5 minutes to refresh.</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                {{-- <div class="dropdown">
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
                </button> --}}
                <button class="btn btn-primary">
                    <i class="fas fa-download me-2"></i>Download
                </button>
            </div>
        </div>

        <!-- Your Footprint Section -->
        <div class="card border-0 shadow-sm mb-4" style="background-color: #f8f9fa; border-radius: 12px;">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h3 class="h5 fw-bold mb-3" style="color: #495057;">Your Footprint</h3>
                        <div class="mb-3">
                            <small class="text-muted" style="color: #6c757d;">{{ $footprintData['date_range'] }}</small>
                        </div>

                        <div class="mb-4">
                            <h2 class="h1 fw-bold mb-0" style="color: #495057; font-size: 1.5rem;">Total Scope 1, Scope 2, and Scope 3 emissions</h2>
                            <div class="h2 fw-bold" style="color: #495057; font-size: 2.5rem;">{{ $footprintData['total_emissions'] }} tCO₂e<i class="fas fa-info-circle ms-2" style="font-size: 0.8rem; color: #6c757d;"></i></div>
                        </div>

                        <!-- Scope Breakdown -->
                        <div class="scope-breakdown" style="background: #f8f9fa; border-radius: 8px; padding: 1rem;">
                            <div class="d-flex align-items-center justify-content-between" style="flex-direction: row; align-content: center;">
                                @foreach($footprintData['scopes'] as $scope)
                                <div class="d-flex align-items-center" style="flex: 1;">
                                    <div class="scope-indicator me-3" style="width: 16px; height: 16px; background-color: {{ $scope['color'] }}; border-radius: 50%;"></div>
                                    <div>
                                        <strong style="color: #495057;">{{ $scope['label'] }}:</strong> <span style="color: #495057; font-weight: bold; font-size: 1.1rem;">{{ $scope['value'] }}</span>
                                    </div>
                                </div>
                                @if(!$loop->last)
                                <div class="border-end" style="height: 40px; margin: 0 15px;"></div>
                                @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-4">
                            <small class="text-muted" style="color: #6c757d;">Data measured in tCO₂e. <a href="#" class="text-primary">Learn more</a></small>
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
                                    <!-- White line indicator -->
                                    <line x1="100" y1="20" x2="100" y2="0" stroke="white" stroke-width="2"></line>
                                </svg>
                                <div class="position-absolute top-50 start-50 translate-middle text-center">
                                    <div class="h5 fw-bold" style="color: #495057;">{{ $footprintData['total_emissions'] }}</div>
                                    <div class="small text-muted" style="color: #6c757d;">tCO₂e</div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 d-flex align-items-center justify-content-center">
                            <div style="width: 8px; height: 8px; background-color: #20c997; border-radius: 50%; margin-right: 8px;"></div>
                            <small class="text-muted" style="color: #6c757d;">Data Updated: {{ $footprintData['last_updated'] }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Footprint Analytics Section -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <span class="badge bg-warning text-dark me-2">Upgrade</span>
                    <h3 class="h5 fw-semibold mb-0">Additional Footprint Analytics</h3>
                </div>
                <p class="text-muted mb-3">View a comprehensive breakdown of your footprint by category and GHG footprint category. Understand which aspects of your organization are the top emitters.</p>
                <a href="#" class="text-primary text-decoration-none d-block mb-4">Learn more about additional footprint analytics</a>
                <button class="btn btn-primary">
                    <i class="fas fa-arrow-up me-2"></i>Upgrade to View Metrics
                </button>
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
