@extends('account.layout')

@section('title', 'Sustainability Reporting')

@section('content')
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-1">Sustainability Reporting</h1>
        </div>
        <div class="d-flex align-items-center gap-2">
            <div class="btn-group">
                <button class="btn btn-outline-secondary btn-sm">tCO₂e</button>
            </div>
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">Reporting Year: {{ $reportingYear }}</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">{{ $reportingYear }}</a></li>
                    <li><a class="dropdown-item" href="#">{{ $reportingYear - 1 }}</a></li>
                </ul>
            </div>
            <button class="btn btn-outline-secondary btn-sm">Copilot</button>
        </div>
    </div>
</div>

<div class="content-body">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center py-5" style="min-height: 420px;">
                <div class="display-4 mb-3" style="opacity:.2;">Ø</div>
                <h5 class="fw-semibold mb-1">Reports for years before {{ $supportsFromYear }} are not available</h5>
                <p class="text-muted mb-0">Sustainability Reporting is a feature that only has support for years {{ $supportsFromYear }} and beyond.</p>
            </div>
        </div>
    </div>
</div>

<style>
.card { background-color: #ffffff; }
</style>
@endsection



