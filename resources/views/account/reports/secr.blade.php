@extends('account.layout')

@section('title', 'SECR GHG Metrics Report')

@section('content')
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-1">SECR - UK</h1>
            <p class="text-muted mb-0">Mandatory for quoted companies, large unquoted companies, and LLPs</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <div class="btn-group">
                <button class="btn btn-outline-secondary btn-sm">tCO₂e</button>
            </div>
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">Reporting Year: {{ $reportingYear }}</button>
                <ul class="dropdown-menu">
                    @foreach($periods as $year => $range)
                        <li><a class="dropdown-item" href="#">{{ $year }}</a></li>
                    @endforeach
                </ul>
            </div>
            <button class="btn btn-outline-secondary btn-sm">Copilot</button>
        </div>
    </div>
</div>

<div class="content-body">
    <div class="container-fluid">
        {{-- Page Header --}}
        <div class="text-center my-3">
            <h1 style="font-weight: 900;">SECR GHG Metrics Report</h1>
            <h6>View and export your scope 1 and scope 2 emissions in an easy-to-use report aligned to the U.K.'s <a href="">Streamlined Energy and Carbon Reporting (SECR)</a> sustainability reporting framework.</h6>
        </div>

        <div class="secr-wrapper p-4">
            <div class="mb-3">
                <h3 class="fw-bold mb-1">SECR - UK</h3>
                <p class="text-muted mb-0">Mandatory for quoted companies, large unquoted companies, and LLPs</p>
            </div>
            <h5 class="fw-semibold mb-3">Emissions</h5>
            <div class="table-responsive">
                <table class="table align-middle secr-table">
                    <thead>
                        <tr>
                            <th class="secr-th" style="width:10%">Unit</th>
                            <th class="secr-th" style="width:40%">Category</th>
                            @foreach($periods as $year => $range)
                                <th class="secr-th" style="width:20%"><span class="fw-semibold">{{ $year }}</span> <span class="text-muted small ms-2">{{ $range }}</span></th>
                            @endforeach
                            <th class="secr-th" style="width:10%">% Change</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-section"><td colspan="5" class="fw-semibold">Scope 1</td></tr>
                        @foreach($rowsScope1 as $row)
                        <tr>
                            <td class="secr-td">t CO₂e</td>
                            <td class="secr-td">{{ $row['category'] }}</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                        @endforeach

                        <tr class="table-section"><td colspan="5" class="fw-semibold">Scope 2: Location-Based</td></tr>
                        @foreach($rowsScope2Loc as $row)
                        <tr>
                            <td class="secr-td">t CO₂e</td>
                            <td class="secr-td">{{ $row['category'] }}</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                        @endforeach

                        <tr class="table-section"><td colspan="5" class="fw-semibold">Scope 2: Market-Based</td></tr>
                        @foreach($rowsScope2Mkt as $row)
                        <tr>
                            <td class="secr-td">t CO₂e</td>
                            <td class="secr-td">{{ $row['category'] }}</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Energy Use Section --}}
            <h5 class="fw-semibold mt-5 mb-3">Energy Use</h5>
            <div class="table-responsive">
                <table class="table align-middle secr-table">
                    <thead>
                        <tr>
                            <th class="secr-th" style="width:10%">Unit</th>
                            <th class="secr-th" style="width:40%">Category</th>
                            @foreach($periods as $year => $range)
                                <th class="secr-th" style="width:20%"><span class="fw-semibold">{{ $year }}</span> <span class="text-muted small ms-2">{{ $range }}</span></th>
                            @endforeach
                            <th class="secr-th" style="width:10%">% Change</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="secr-td">kWh</td>
                            <td class="secr-td">Stationary Combustion Including...</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                        <tr>
                            <td class="secr-td">kWh</td>
                            <td class="secr-td">Combustion of Fuels for Transport</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                        <tr>
                            <td class="secr-td">kWh</td>
                            <td class="secr-td">Purchased Electricity</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                        <tr>
                            <td class="secr-td">kWh</td>
                            <td class="secr-td">Purchased Heat and Steam</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                        <tr>
                            <td class="secr-td">kWh</td>
                            <td class="secr-td">Purchased Cooling</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                        <tr>
                            <td class="secr-td fw-semibold">kWh</td>
                            <td class="secr-td fw-semibold">Total Energy Use</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Global Excluding UK Wrapper --}}
        <div class="secr-wrapper p-4 mt-4">
            <div class="mb-3">
                <h3 class="fw-bold mb-1">SECR - Global Excluding UK</h3>
                <p class="text-muted mb-0">Mandatory for quoted companies, optional for large unquoted companies and LLPs</p>
            </div>
            <h5 class="fw-semibold mb-3">Emissions</h5>
            <div class="table-responsive">
                <table class="table align-middle secr-table">
                    <thead>
                        <tr>
                            <th class="secr-th" style="width:10%">Unit</th>
                            <th class="secr-th" style="width:40%">Category</th>
                            @foreach($periods as $year => $range)
                                <th class="secr-th" style="width:20%"><span class="fw-semibold">{{ $year }}</span> <span class="text-muted small ms-2">{{ $range }}</span></th>
                            @endforeach
                            <th class="secr-th" style="width:10%">% Change</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-section"><td colspan="5" class="fw-semibold">Scope 1</td></tr>
                        @foreach($rowsScope1 as $row)
                        <tr>
                            <td class="secr-td">t CO₂e</td>
                            <td class="secr-td">{{ $row['category'] }}</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                        @endforeach

                        <tr class="table-section"><td colspan="5" class="fw-semibold">Scope 2: Location-Based</td></tr>
                        @foreach($rowsScope2Loc as $row)
                        <tr>
                            <td class="secr-td">t CO₂e</td>
                            <td class="secr-td">{{ $row['category'] }}</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                        @endforeach

                        <tr class="table-section"><td colspan="5" class="fw-semibold">Scope 2: Market-Based</td></tr>
                        @foreach($rowsScope2Mkt as $row)
                        <tr>
                            <td class="secr-td">t CO₂e</td>
                            <td class="secr-td">{{ $row['category'] }}</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Energy Use Section for Global Excluding UK --}}
            <h5 class="fw-semibold mt-5 mb-3">Energy Use</h5>
            <div class="table-responsive">
                <table class="table align-middle secr-table">
                    <thead>
                        <tr>
                            <th class="secr-th" style="width:10%">Unit</th>
                            <th class="secr-th" style="width:40%">Category</th>
                            @foreach($periods as $year => $range)
                                <th class="secr-th" style="width:20%"><span class="fw-semibold">{{ $year }}</span> <span class="text-muted small ms-2">{{ $range }}</span></th>
                            @endforeach
                            <th class="secr-th" style="width:10%">% Change</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="secr-td">kWh</td>
                            <td class="secr-td">Stationary Combustion Including...</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                        <tr>
                            <td class="secr-td">kWh</td>
                            <td class="secr-td">Combustion of Fuels for Transport</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                        <tr>
                            <td class="secr-td">kWh</td>
                            <td class="secr-td">Purchased Electricity</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                        <tr>
                            <td class="secr-td">kWh</td>
                            <td class="secr-td">Purchased Heat and Steam</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                        <tr>
                            <td class="secr-td">kWh</td>
                            <td class="secr-td">Purchased Cooling</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                        <tr>
                            <td class="secr-td fw-semibold">kWh</td>
                            <td class="secr-td fw-semibold">Total Energy Use</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Total Global Wrapper --}}
        <div class="secr-wrapper p-4 mt-4">
            <div class="mb-3">
                <h3 class="fw-bold mb-1">SECR - Total Global</h3>
                <p class="text-muted mb-0">Mandatory for quoted companies, optional for large unquoted companies and LLPs</p>
            </div>
            <h5 class="fw-semibold mb-3">Emissions</h5>
            <div class="table-responsive">
                <table class="table align-middle secr-table">
                    <thead>
                        <tr>
                            <th class="secr-th" style="width:10%">Unit</th>
                            <th class="secr-th" style="width:40%">Category</th>
                            @foreach($periods as $year => $range)
                                <th class="secr-th" style="width:20%"><span class="fw-semibold">{{ $year }}</span> <span class="text-muted small ms-2">{{ $range }}</span></th>
                            @endforeach
                            <th class="secr-th" style="width:10%">% Change</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-section"><td colspan="5" class="fw-semibold">Scope 1</td></tr>
                        @foreach($rowsScope1 as $row)
                        <tr>
                            <td class="secr-td">t CO₂e</td>
                            <td class="secr-td">{{ $row['category'] }}</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                        @endforeach

                        <tr class="table-section"><td colspan="5" class="fw-semibold">Scope 2: Location-Based</td></tr>
                        @foreach($rowsScope2Loc as $row)
                        <tr>
                            <td class="secr-td">t CO₂e</td>
                            <td class="secr-td">{{ $row['category'] }}</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                        @endforeach

                        <tr class="table-section"><td colspan="5" class="fw-semibold">Scope 2: Market-Based</td></tr>
                        @foreach($rowsScope2Mkt as $row)
                        <tr>
                            <td class="secr-td">t CO₂e</td>
                            <td class="secr-td">{{ $row['category'] }}</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                        @endforeach

                        <tr>
                            <td class="secr-td fw-semibold">t CO₂e</td>
                            <td class="secr-td fw-semibold">Total Emissions</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Energy Use Section for Total Global --}}
            <h5 class="fw-semibold mt-5 mb-3">Energy Use</h5>
            <div class="table-responsive">
                <table class="table align-middle secr-table">
                    <thead>
                        <tr>
                            <th class="secr-th" style="width:10%">Unit</th>
                            <th class="secr-th" style="width:40%">Category</th>
                            @foreach($periods as $year => $range)
                                <th class="secr-th" style="width:20%"><span class="fw-semibold">{{ $year }}</span> <span class="text-muted small ms-2">{{ $range }}</span></th>
                            @endforeach
                            <th class="secr-th" style="width:10%">% Change</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="secr-td">MWh</td>
                            <td class="secr-td">Stationary Combustion Including...</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                        <tr>
                            <td class="secr-td">MWh</td>
                            <td class="secr-td">Combustion of Fuels for Transport</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                        <tr>
                            <td class="secr-td">MWh</td>
                            <td class="secr-td">Purchased Electricity</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                        <tr>
                            <td class="secr-td">MWh</td>
                            <td class="secr-td">Purchased Heat and Steam</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                        <tr>
                            <td class="secr-td">MWh</td>
                            <td class="secr-td">Purchased Cooling</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                        <tr>
                            <td class="secr-td fw-semibold">MWh</td>
                            <td class="secr-td fw-semibold">Total Energy Use</td>
                            @foreach($periods as $year => $range)
                                <td class="secr-td text-muted">—</td>
                            @endforeach
                            <td class="secr-td text-muted">—</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Quantification and Reporting Methodology Wrapper --}}
        <div class="secr-wrapper p-4 mt-4">
            <div class="mb-3">
                <h3 class="fw-bold mb-1">Quantification and Reporting Methodology</h3>
                <p class="text-muted mb-0">Mandatory for quoted companies, large unquoted companies, and LLPs. Calculation Methodology is aligned with the GHG Reporting Protocol - Corporate Standard.</p>
            </div>

            <h5 class="fw-semibold mb-3">2024</h5>
            <div class="table-responsive">
                <table class="table align-middle secr-table">
                    <thead>
                        <tr>
                            <th class="secr-th" style="width:33%">Footprint Source</th>
                            <th class="secr-th" style="width:33%">Calculation Method</th>
                            <th class="secr-th" style="width:34%">Emission Factor Set Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 6; $i++)
                        <tr>
                            <td class="secr-td text-muted">Lorem ipsum dolor sit amet</td>
                            <td class="secr-td text-muted">consectetur adipiscing elit</td>
                            <td class="secr-td text-muted">elit ipsum Lorem consectetur</td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>

            <h5 class="fw-semibold mb-3 mt-4">2025</h5>
            <div class="table-responsive">
                <table class="table align-middle secr-table">
                    <thead>
                        <tr>
                            <th class="secr-th" style="width:33%">Footprint Source</th>
                            <th class="secr-th" style="width:33%">Calculation Method</th>
                            <th class="secr-th" style="width:34%">Emission Factor Set Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 6; $i++)
                        <tr>
                            <td class="secr-td text-muted">Lorem ipsum dolor sit amet</td>
                            <td class="secr-td text-muted">consectetur adipiscing elit</td>
                            <td class="secr-td text-muted">elit ipsum Lorem consectetur</td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.secr-wrapper { background:#f7f7f9; border:1px solid #e5e7eb; border-radius:16px; }
.secr-table { border-collapse: separate; border-spacing:0; width:100%; }
.secr-table thead th.secr-th { background:#fff; border-bottom:2px solid #e5e7eb; padding:14px 16px; white-space:nowrap; color:#000; }
.secr-table tbody td.secr-td { background:#fff; padding:14px 16px; border-top:1px solid #eef0f2; }
.secr-table tbody tr:nth-child(even) td.secr-td { background:#f9fafb; }
.secr-table .table-section td { background:#f5f5f5; border-top:2px solid #e5e7eb; padding:12px 16px; }
</style>
@endsection



