@extends('admin.layout')

@section('title', 'GHG Methodology Report')

@section('content')
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-1">GHG Methodology Report</h1>
            <p class="text-muted mb-0">View and export the methodology used to calculate your footprint.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">Reporting Year: {{ $reportData['reporting_year'] }}</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">{{ $reportData['reporting_year'] }}</a></li>
                    <li><a class="dropdown-item" href="#">{{ (int)$reportData['reporting_year'] - 1 }}</a></li>
                </ul>
            </div>
            <button class="btn btn-outline-secondary btn-sm">Copy</button>
        </div>
    </div>
</div>

<div class="content-body">
    <div class="container-fluid">
        {{-- Upgrade Banner Placeholder --}}
        <div class="text-center my-3">
            <h1 style="font-weight: 900;">GHG Methodology Report</h1>
            <h5>View and export your footprint methodology report to better understand the methodologies and emission factor sets used to calculate your footprint.</h5>
        </div>

        {{-- Reporting Period Card --}}
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-body">
                <h5 class="fw-semibold mb-3">Reporting Period</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded">Start date <div class="text-muted small">{{ $reportData['period']['start'] }}</div></div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded">End date <div class="text-muted small">{{ $reportData['period']['end'] }}</div></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Scope 1 --}}
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-body">
                <h5 class="fw-semibold mb-1">Scope 1 <span class="text-muted small">GHG Emissions</span></h5>
                <a href="#" id="m-s1-toggle" class="small text-primary d-inline-block mb-3">+ Show more</a>
                <div id="m-s1-list" class="list-group list-group-flush method-list" style="display: none;">
                    @foreach($reportData['scope1_sections'] as $label)
                        <div class="list-group-item px-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>{{ $label }}</span>
                                <span class="text-muted">—</span>
                            </div>
                            <div class="method-meta mt-2">
                                <div class="meta-row"><span>GHG Calculation Methodology</span><span class="text-muted">consectetur dolor Lorem</span></div>
                                <div class="meta-row"><span>Calculation Type</span><span class="text-muted">adipiscing elit amet elit</span></div>
                                <div class="meta-row"><span>Emission Factor Set</span><span class="text-muted">elit ipsum Lorem consectetur</span></div>
                                <div class="meta-row"><span>Emissions</span><span class="text-muted">—</span></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Scope 2 --}}
        <div class="card border-0 shadow-sm mb-5" style="border-radius: 12px;">
            <div class="card-body">
                <h5 class="fw-semibold mb-1">Scope 2 <span class="text-muted small">GHG Emissions</span></h5>
                <a href="#" id="m-s2-toggle" class="small text-primary d-inline-block mb-3">+ Show more</a>
                <div id="m-s2-list" class="list-group list-group-flush method-list" style="display: none;">
                    @foreach($reportData['scope2_sections'] as $label)
                        <div class="list-group-item px-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>{{ $label }}</span>
                                <span class="text-muted">—</span>
                            </div>
                            <div class="method-meta mt-2">
                                <div class="meta-row"><span>GHG Calculation Methodology</span><span class="text-muted">consectetur dolor Lorem</span></div>
                                <div class="meta-row"><span>Calculation Type</span><span class="text-muted">adipiscing elit amet elit</span></div>
                                <div class="meta-row"><span>Emission Factor Set</span><span class="text-muted">elit ipsum Lorem consectetur</span></div>
                                <div class="meta-row"><span>Emissions</span><span class="text-muted">—</span></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Scope 3 --}}
        <div class="card border-0 shadow-sm mb-5" style="border-radius: 12px;">
            <div class="card-body">
                <h5 class="fw-semibold mb-1">Scope 3 by Category <span class="text-muted small">GHG Emissions</span></h5>
                <a href="#" id="m-s3-toggle" class="small text-primary d-inline-block mb-3">+ Show more</a>
                <div id="m-s3-list" class="list-group list-group-flush method-list" style="display: none;">
                    @foreach($reportData['scope3_sections'] as $label)
                        <div class="list-group-item px-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>{{ $label }}</span>
                                <span class="text-muted">—</span>
                            </div>
                            <div class="method-meta mt-2">
                                <div class="meta-row"><span>GHG Calculation Methodology</span><span class="text-muted">consectetur dolor Lorem</span></div>
                                <div class="meta-row"><span>Calculation Type</span><span class="text-muted">adipiscing elit amet elit</span></div>
                                <div class="meta-row"><span>Emission Factor Set</span><span class="text-muted">elit ipsum Lorem consectetur</span></div>
                                <div class="meta-row"><span>Emissions</span><span class="text-muted">—</span></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    background: #f5f5f5;
}

.method-list .list-group-item {
    background-color: transparent; /* Title sits outside the box */
    border: 0;
    padding: 0.6rem 0.2rem 0.2rem 0.2rem;
    margin-bottom: 10px;
}
.method-list .list-group-item:last-child { margin-bottom: 0; }
.method-list .list-group-item.no-alt { background-color: #ffffff !important; }

.method-meta .meta-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    padding: 6px 10px;
    background: #ffffff; /* default white */
    border-radius: 6px;
    margin-top: 6px;
}
.method-meta .meta-row:nth-child(even) { background: #f5f5f5; } /* light grey for even rows */
.method-meta .meta-row span:first-child { font-size: 0.9rem; color: #495057; }
.method-meta .meta-row span:last-child { font-size: 0.9rem; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function wireToggle(toggleId, listId) {
        var t = document.getElementById(toggleId);
        var l = document.getElementById(listId);
        if (t && l) {
            t.addEventListener('click', function(e) {
                e.preventDefault();
                var isHidden = l.style.display === 'none' || l.style.display === '';
                l.style.display = isHidden ? 'block' : 'none';
                t.textContent = isHidden ? '− Show less' : '+ Show more';
            });
        }
    }
    wireToggle('m-s1-toggle', 'm-s1-list');
    wireToggle('m-s2-toggle', 'm-s2-list');
    wireToggle('m-s3-toggle', 'm-s3-list');
});
</script>
@endsection


