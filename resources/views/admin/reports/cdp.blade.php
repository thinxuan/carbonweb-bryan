@extends('admin.layout')

@section('title', 'CDP GHG Metrics Report')

@section('content')
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 clas">CDP GHG Metrics Report</h1>
            <p class="text-muted mb-0">View and export your scope 1, scope 2, and scope 3 metrics in an easy-to-use report aligned with the CDP questionnaire.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <div class="btn-group">
                <button class="btn btn-outline-secondary btn-sm">tCO₂e</button>
            </div>
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
        <div class="text-center my-3">
            <h1 style="font-weight: 900;">CDP GHG Metrics Report</h1>
            <h6>View and export your scope 1, scope 2, and scope 3 metrics in an easy-to-use report aligned with the CDP questionnaire.</h6>
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

        {{-- Scope 1 Card --}}
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-body">
                <h5 class="fw-semibold mb-1">Scope 1 <span class="text-muted small">GHG Emissions</span></h5>
                <a href="#" id="scope1-toggle" class="small text-primary d-inline-block mb-3">+ Show more</a>
                <div id="scope1-list" class="list-group list-group-flush cdp-list" style="display: none;">
                    @foreach($reportData['scope1'] as $row)
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span>{{ $row['label'] }}</span>
                            <span class="text-muted">—</span>
                        </div>
                    @endforeach
                </div>
                <div id="scope1-note" class="text-muted small mt-2" style="text-align: right; display: none;">Data measured in tCO₂e</div>
            </div>
        </div>

        {{-- Scope 1 by Country --}}
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-body">
                <h5 class="fw-semibold mb-1">Scope 1 by Country <span class="text-muted small">GHG Emissions</span></h5>
                <a href="#" id="scope1-country-toggle" class="small text-primary d-inline-block mb-3">+ Show more</a>
                <div id="scope1-country-list" class="list-group list-group-flush cdp-list" style="display: none;">
                    @foreach($reportData['scope1_country'] as $row)
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span>{{ $row['label'] }}</span>
                            <span class="text-muted">—</span>
                        </div>
                    @endforeach
                </div>
                <div id="scope1-country-note" class="text-muted small mt-2" style="text-align: right; display: none;">Data measured in tCO₂e</div>
            </div>
        </div>

        {{-- Scope 2 by Country --}}
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-body">
                <h5 class="fw-semibold mb-1">Scope 2 by Country <span class="text-muted small">GHG Emissions</span></h5>
                <a href="#" id="scope2-country-toggle" class="small text-primary d-inline-block mb-3">+ Show more</a>
                <div id="scope2-country-list" class="list-group list-group-flush cdp-list" style="display: none;">
                    @foreach($reportData['scope2_country'] as $row)
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span>{{ $row['label'] }}</span>
                            <span class="text-muted">—</span>
                        </div>
                    @endforeach
                </div>
                <div id="scope2-country-note" class="text-muted small mt-2" style="text-align: right; display: none;">Data measured in tCO₂e</div>
            </div>
        </div>

        {{-- Scope 1 by Activity --}}
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-body">
                <h5 class="fw-semibold mb-1">Scope 1 by Activity <span class="text-muted small">GHG Emissions</span></h5>
                <a href="#" id="scope1-activity-toggle" class="small text-primary d-inline-block mb-3">+ Show more</a>
                <div id="scope1-activity-list" class="list-group list-group-flush cdp-list" style="display: none;">
                    @foreach($reportData['scope1_activity'] as $row)
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span>{{ $row['label'] }}</span>
                            <span class="text-muted">—</span>
                        </div>
                    @endforeach
                </div>
                <div id="scope1-activity-note" class="text-muted small mt-2" style="text-align: right; display: none;">Data measured in tCO₂e</div>
            </div>
        </div>

        {{-- Scope 2 by Activity --}}
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-body">
                <h5 class="fw-semibold mb-1">Scope 2 by Activity <span class="text-muted small">GHG Emissions</span></h5>
                <a href="#" id="scope2-activity-toggle" class="small text-primary d-inline-block mb-3">+ Show more</a>
                <div id="scope2-activity-list" class="list-group list-group-flush cdp-list" style="display: none;">
                    @foreach($reportData['scope2_activity'] as $row)
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span>{{ $row['label'] }}</span>
                            <span class="text-muted">—</span>
                        </div>
                    @endforeach
                </div>
                <div id="scope2-activity-note" class="text-muted small mt-2" style="text-align: right; display: none;">Data measured in tCO₂e</div>
            </div>
        </div>

        {{-- Scope 2 by Country/location --}}
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <div class="card-body">
                <h5 class="fw-semibold mb-1">Scope 2 by Country/location for <br>electricity/heat/steam/cooling consumption</h5>
                <a href="#" id="scope2-countrylong-toggle" class="small text-primary d-inline-block mb-3">+ Show more</a>
                <div id="scope2-countrylong-list" style="display: none;">
                    <div class="mb-2 fw-semibold small text-muted">Consumption of purchased electricity (MWh)</div>
                    <div class="list-group list-group-flush cdp-list mb-3">
                        @foreach($reportData['scope2_country'] as $row)
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span>{{ $row['label'] }}</span>
                                <span class="text-muted">—</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="mb-2 fw-semibold small text-muted">Consumption of purchased cooling (MWh)</div>
                    <div class="list-group list-group-flush cdp-list mb-3">
                        @foreach($reportData['scope2_country'] as $row)
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span>{{ $row['label'] }}</span>
                                <span class="text-muted">—</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="mb-2 fw-semibold small text-muted">Consumption of purchased heat and steam (MWh)</div>
                    <div class="list-group list-group-flush cdp-list">
                        @foreach($reportData['scope2_country'] as $row)
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span>{{ $row['label'] }}</span>
                                <span class="text-muted">—</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div id="scope2-countrylong-note" class="text-muted small mt-2" style="text-align: right; display: none;">Data measured in tCO₂e</div>
            </div>
        </div>

        {{-- Scope 3 by Category --}}
        <div class="card border-0 shadow-sm mb-5" style="border-radius: 12px;">
            <div class="card-body">
                <h5 class="fw-semibold mb-1">Scope 3 by Category <span class="text-muted small">GHG Emissions</span></h5>
                <a href="#" id="scope3-category-toggle" class="small text-primary d-inline-block mb-3">+ Show more</a>
                <div id="scope3-category-list" class="list-group list-group-flush cdp-list" style="display: none;">
                    @foreach($reportData['scope3_category'] as $row)
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span>{{ $row['label'] }}</span>
                            <span class="text-muted">—</span>
                        </div>
                    @endforeach
                </div>
                <div id="scope3-category-note" class="text-muted small mt-2" style="text-align: right; display: none;">Data measured in tCO₂e</div>
            </div>
        </div>
    </div>
</div>

<style>
.card { background-color: #f5f5f5; }
.cdp-list .list-group-item {
    background-color: #ffffff;
    border: 0;
    padding: 0.6rem 0.75rem;
    border-radius: 8px;
    margin-bottom: 8px;
}
.cdp-list .list-group-item:nth-child(even) {
    background-color: #f5f5f5;
}
.cdp-list .list-group-item:last-child { margin-bottom: 0; }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var toggle = document.getElementById('scope1-toggle');
    var list   = document.getElementById('scope1-list');
    var note   = document.getElementById('scope1-note');
    if (toggle && list) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            var isHidden = list.style.display === 'none' || list.style.display === '';
            list.style.display = isHidden ? 'block' : 'none';
            toggle.textContent = isHidden ? '− Show less' : '+ Show more';
            if (note) note.style.display = isHidden ? 'block' : 'none';
        });
    }

    var toggleC = document.getElementById('scope1-country-toggle');
    var listC   = document.getElementById('scope1-country-list');
    var noteC   = document.getElementById('scope1-country-note');
    if (toggleC && listC) {
        toggleC.addEventListener('click', function(e) {
            e.preventDefault();
            var isHidden = listC.style.display === 'none' || listC.style.display === '';
            listC.style.display = isHidden ? 'block' : 'none';
            toggleC.textContent = isHidden ? '− Show less' : '+ Show more';
            if (noteC) noteC.style.display = isHidden ? 'block' : 'none';
        });
    }

    var toggleS2C = document.getElementById('scope2-country-toggle');
    var listS2C   = document.getElementById('scope2-country-list');
    var noteS2C   = document.getElementById('scope2-country-note');
    if (toggleS2C && listS2C) {
        toggleS2C.addEventListener('click', function(e) {
            e.preventDefault();
            var isHidden = listS2C.style.display === 'none' || listS2C.style.display === '';
            listS2C.style.display = isHidden ? 'block' : 'none';
            toggleS2C.textContent = isHidden ? '− Show less' : '+ Show more';
            if (noteS2C) noteS2C.style.display = isHidden ? 'block' : 'none';
        });
    }

    function wireToggle(toggleId, listId, noteId) {
        var t = document.getElementById(toggleId);
        var l = document.getElementById(listId);
        var n = document.getElementById(noteId);
        if (t && l) {
            t.addEventListener('click', function(e) {
                e.preventDefault();
                var isHidden = l.style.display === 'none' || l.style.display === '';
                l.style.display = isHidden ? 'block' : 'none';
                t.textContent = isHidden ? '− Show less' : '+ Show more';
                if (n) n.style.display = isHidden ? 'block' : 'none';
            });
        }
    }

    wireToggle('scope1-activity-toggle', 'scope1-activity-list', 'scope1-activity-note');
    wireToggle('scope2-activity-toggle', 'scope2-activity-list', 'scope2-activity-note');
    wireToggle('scope2-countrylong-toggle', 'scope2-countrylong-list', 'scope2-countrylong-note');
    wireToggle('scope3-category-toggle', 'scope3-category-list', 'scope3-category-note');
});
</script>
@endsection


