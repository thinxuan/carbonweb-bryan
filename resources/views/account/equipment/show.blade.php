@extends('account.layout')

@section('title', 'Equipment Details')

@section('content')
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Equipment Details</h1>
            <p class="text-muted mb-0">View equipment information and specifications</p>
        </div>
        <div>
            <a href="{{ route('account.equipment.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Equipment
            </a>
        </div>
    </div>
</div>

<div class="content-body">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ $equipment->name }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Basic Information</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>Type:</strong></td>
                                    <td><span class="badge bg-info">{{ $equipment->type }}</span></td>
                                </tr>
                                @if($equipment->model_number)
                                <tr>
                                    <td><strong>Model:</strong></td>
                                    <td>{{ $equipment->model_number }}</td>
                                </tr>
                                @endif
                                @if($equipment->serial_number)
                                <tr>
                                    <td><strong>Serial Number:</strong></td>
                                    <td>{{ $equipment->serial_number }}</td>
                                </tr>
                                @endif
                                @if($equipment->manufacturer)
                                <tr>
                                    <td><strong>Manufacturer:</strong></td>
                                    <td>{{ $equipment->manufacturer }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6>Usage & Performance</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>Usage Hours:</strong></td>
                                    <td>{{ number_format($equipment->usage_hours) }} hrs</td>
                                </tr>
                                @if($equipment->power_consumption)
                                <tr>
                                    <td><strong>Power Consumption:</strong></td>
                                    <td>{{ $equipment->power_consumption }} kW</td>
                                </tr>
                                @endif
                                @if($equipment->purchase_date)
                                <tr>
                                    <td><strong>Purchase Date:</strong></td>
                                    <td>{{ $equipment->purchase_date->format('M d, Y') }}</td>
                                </tr>
                                @endif
                                @if($equipment->last_maintenance)
                                <tr>
                                    <td><strong>Last Maintenance:</strong></td>
                                    <td>{{ $equipment->last_maintenance->format('M d, Y') }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                    @if($equipment->location)
                    <div class="mt-4">
                        <h6>Location</h6>
                        <p class="mb-0">{{ $equipment->location->name }}</p>
                        @if($equipment->location->address)
                            <small class="text-muted">{{ $equipment->location->address }}</small>
                        @endif
                    </div>
                    @endif

                    @if($equipment->vehicle)
                    <div class="mt-4">
                        <h6>Vehicle</h6>
                        <p class="mb-0">{{ $equipment->vehicle->make }} {{ $equipment->vehicle->model }}</p>
                        @if($equipment->vehicle->year)
                            <small class="text-muted">{{ $equipment->vehicle->year }}</small>
                        @endif
                    </div>
                    @endif

                    @if($equipment->specifications)
                    <div class="mt-4">
                        <h6>Specifications</h6>
                        <p>{{ $equipment->specifications }}</p>
                    </div>
                    @endif

                    @if($equipment->notes)
                    <div class="mt-4">
                        <h6>Notes</h6>
                        <p>{{ $equipment->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Actions</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('account.equipment.edit', $equipment) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Equipment
                        </a>
                        <form action="{{ route('account.equipment.destroy', $equipment) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100"
                                    onclick="return confirm('Are you sure you want to delete this equipment?')">
                                <i class="fas fa-trash"></i> Delete Equipment
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
