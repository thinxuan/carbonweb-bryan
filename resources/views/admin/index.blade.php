@extends('admin.layout')

@section('title', 'My Climate Profile')

@section('content')
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">CLIMATE PROFILE</h1>
            <p class="text-muted mb-0">Change IT Services Sdn Bhd</p>
        </div>
        <div>
            <button class="btn btn-primary" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i> Menu
            </button>
        </div>
    </div>
</div>

<div class="row">
    {{-- Climate Profile Section (2/3 width) --}}
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <h4 class="mb-2">Management of Companies and Enterprises</h4>
                    <p class="text-muted mb-3">Malaysia</p>

                    <div class="d-flex gap-3 mb-4">
                        <button class="btn btn-primary">Home</button>
                        <button class="btn btn-outline-secondary">Share Footprint</button>
                    </div>
                </div>

                <div class="mb-4">
                    <h5 class="mb-3">Let's Get Started</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card border h-100">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <i class="fas fa-car fa-4x text-primary"></i>
                                    </div>
                                    <h6 class="card-title">Add Vehicles</h6>
                                    <p class="card-text small">Vehicles form the backbone of your scope 1 (direct emissions) footprint.</p>
                                    <a href="{{ route('admin.vehicles.index') }}" class="btn btn-primary btn-sm">
                                        Vehicles <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="card border h-100">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <i class="fas fa-cogs fa-4x text-success"></i>
                                    </div>
                                    <h6 class="card-title">Add Equipment</h6>
                                    <p class="card-text small">Equipment form the backbone of your scope 1 (direct emissions) footprint.</p>
                                    <a href="{{ route('admin.equipment.index') }}" class="btn btn-success btn-sm">
                                        Equipment <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <h5 class="mb-3">Footprint Estimate</h5>
                    <div class="row align-items-center">
                        <div class="col-md-3 mb-3">
                            <div class="text-center">
                                <div class="mb-3">
                                    <i class="fas fa-tachometer-alt fa-4x text-primary"></i>
                                </div>
                                <div style="font-family: monospace; font-size: 1.5rem; font-weight: bold;">000000</div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <p class="mb-3">Let's estimate your emissions. By providing your estimated revenue, we will be able to give you a <a href="#" class="text-primary">custom estimate</a> of your Scope 1, Scope 2, and Scope 3 emissions.</p>
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="revenue" class="form-label">What was your revenue for the last year?</label>
                                    <input type="text" class="form-control" id="revenue" placeholder="Enter revenue amount">
                                </div>
                                <div class="col-md-4">
                                    <label for="currency" class="form-label">&nbsp;</label>
                                    <select class="form-select" id="currency">
                                        <option value="USD">USD - Dollars</option>
                                        <option value="MYR">MYR - Ringgit</option>
                                        <option value="EUR">EUR - Euro</option>
                                        <option value="GBP">GBP - Pound</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-dark">
                                    <i class="fas fa-calculator"></i> Estimate
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <h5 class="mb-3">Footprint Analytics</h5>
                    <div class="row align-items-center">
                        <div class="col-md-9">
                            <p class="mb-3">View and analyze your total calculated footprint through different metrics and visualizations.</p>
                            <button class="btn btn-primary">
                                View Analytics <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <div class="mb-3">
                                    <i class="fas fa-chart-bar fa-4x text-success"></i>
                                </div>
                                <div style="font-size: 0.8rem; color: #666;">3D Analytics View</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Emissions Summary Box (1/3 width) --}}
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <h6 class="card-title text-muted mb-3">2024 Total Calculated Emissions</h6>
                <div class="mb-3">
                    <div class="display-6 fw-bold text-primary">0</div>
                    <div class="text-muted">tCO₂e</div>
                </div>
                <hr>
                <div class="small text-muted">
                    <div class="mb-2">
                        <i class="fas fa-map-marker-alt"></i> Locations: {{ \App\Models\Location::count() }}
                    </div>
                    <div class="mb-2">
                        <i class="fas fa-car"></i> Vehicles: {{ \App\Models\Vehicle::count() }}
                    </div>
                    <div class="mb-2">
                        <i class="fas fa-cogs"></i> Equipment: {{ \App\Models\Equipment::count() }}
                    </div>
                </div>
                <div class="mt-3">
                    <div class="progress mb-2" style="height: 8px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 0%"></div>
                    </div>
                    <small class="text-muted">0% of footprint measured</small>
                </div>
            </div>
        </div>

        {{-- Quick Stats --}}
        <div class="card mt-3">
            <div class="card-body">
                <h6 class="card-title">Quick Stats</h6>
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <div class="h5 mb-1 text-primary">{{ \App\Models\Location::count() }}</div>
                            <small class="text-muted">Locations</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="h5 mb-1 text-success">{{ \App\Models\Vehicle::count() }}</div>
                        <small class="text-muted">Vehicles</small>
                    </div>
                </div>
                <div class="row text-center mt-3">
                    <div class="col-6">
                        <div class="border-end">
                            <div class="h5 mb-1 text-warning">{{ \App\Models\Equipment::count() }}</div>
                            <small class="text-muted">Equipment</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="h5 mb-1 text-info">0</div>
                        <small class="text-muted">tCO₂e</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
