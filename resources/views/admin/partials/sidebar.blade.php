<div class="sidebar">
    {{-- Sidebar Tabs --}}
    <div class="sidebar-tabs">
        <button class="sidebar-tab active" data-section="measure">Measure</button>
        <button class="sidebar-tab" data-section="report">Report</button>
    </div>

    {{-- Measure Section --}}
    <nav class="sidebar-nav sidebar-section active" id="measure-section">
        <div class="nav-item">
            <a href="{{ route('admin.index') }}" class="nav-link {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                <i class="fas fa-user-circle"></i>
                My Climate Profile
            </a>
        </div>

        <div class="nav-item">
            <div class="nav-link nav-dropdown-toggle {{ request()->routeIs('admin.locations.*') || request()->routeIs('admin.vehicles.*') || request()->routeIs('admin.equipment.*') ? 'active' : '' }}" onclick="toggleDropdown('organization')">
                <i class="fas fa-building"></i>
                My Organization
                <i class="fas fa-chevron-down nav-dropdown-icon"></i>
            </div>
            <div class="nav-dropdown" id="organization-dropdown">
                <a href="{{ route('admin.locations.index') }}" class="nav-link nav-dropdown-item {{ request()->routeIs('admin.locations.*') ? 'active' : '' }}">
                    <i class="fas fa-map-marker-alt"></i>
                    Locations
                </a>
                <a href="{{ route('admin.vehicles.index') }}" class="nav-link nav-dropdown-item {{ request()->routeIs('admin.vehicles.*') ? 'active' : '' }}">
                    <i class="fas fa-car"></i>
                    Vehicles
                </a>
                <a href="{{ route('admin.equipment.index') }}" class="nav-link nav-dropdown-item {{ request()->routeIs('admin.equipment.*') ? 'active' : '' }}">
                    <i class="fas fa-cogs"></i>
                    Equipment
                </a>
            </div>
        </div>

        <div class="nav-item">
            <div class="nav-link nav-dropdown-toggle {{ request()->routeIs('admin.scope1.*') ? 'active' : '' }}" onclick="toggleDropdown('scope1')">
                <i class="fas fa-industry"></i>
                Scope 1
                <i class="fas fa-chevron-down nav-dropdown-icon"></i>
            </div>
            <div class="nav-dropdown" id="scope1-dropdown">
                <a href="{{ route('admin.scope1.natural-gas') }}" class="nav-link nav-dropdown-item {{ request()->routeIs('admin.scope1.natural-gas') ? 'active' : '' }}">
                    <i class="fas fa-fire"></i>
                    Natural Gas Consumption (Location)
                </a>
                <a href="{{ route('admin.scope1.vehicle-usage-fuel') }}" class="nav-link nav-dropdown-item {{ request()->routeIs('admin.scope1.vehicle-usage-fuel') ? 'active' : '' }}">
                    <i class="fas fa-gas-pump"></i>
                    Vehicle Usage (Fuel)
                </a>
                <a href="{{ route('admin.scope1.vehicle-usage-distance') }}" class="nav-link nav-dropdown-item {{ request()->routeIs('admin.scope1.vehicle-usage-distance') ? 'active' : '' }}">
                    <i class="fas fa-road"></i>
                    Vehicle Usage (Distance)
                </a>
                <a href="{{ route('admin.scope1.fuel-consumption-equipment') }}" class="nav-link nav-dropdown-item {{ request()->routeIs('admin.scope1.fuel-consumption-equipment') ? 'active' : '' }}">
                    <i class="fas fa-fire"></i>
                    Fuel Consumption (Equipment)
                </a>
            </div>
        </div>

        <div class="nav-item">
            <div class="nav-link nav-dropdown-toggle {{ request()->routeIs('admin.scope2.*') ? 'active' : '' }}" onclick="toggleDropdown('scope2')">
                <i class="fas fa-bolt"></i>
                Scope 2
                <i class="fas fa-chevron-down nav-dropdown-icon"></i>
            </div>
            <div class="nav-dropdown" id="scope2-dropdown">
                <a href="{{ route('admin.scope2.electricity-usage') }}" class="nav-link nav-dropdown-item {{ request()->routeIs('admin.scope2.electricity-usage') ? 'active' : '' }}">
                    <i class="fas fa-bolt"></i>
                    Electricity Usage
                </a>
                <a href="{{ route('admin.scope2.heat-steam-usage') }}" class="nav-link nav-dropdown-item {{ request()->routeIs('admin.scope2.heat-steam-usage') ? 'active' : '' }}">
                    <i class="fas fa-fire"></i>
                    Heat & Steam Usage
                </a>
                <a href="{{ route('admin.scope2.purchased-cooling') }}" class="nav-link nav-dropdown-item {{ request()->routeIs('admin.scope2.purchased-cooling') ? 'active' : '' }}">
                    <i class="fas fa-snowflake"></i>
                    Purchased Cooling
                </a>
            </div>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.scope3.index') }}" class="nav-link {{ request()->routeIs('admin.scope3.*') ? 'active' : '' }}">
                <i class="fas fa-truck"></i>
                Scope 3
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.scope3.footprint-analytics') }}" class="nav-link {{ request()->routeIs('admin.scope3.footprint-analytics') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i>
                Footprint Analytics
            </a>
        </div>
    </nav>

    {{-- Report Section --}}
    <nav class="sidebar-nav sidebar-section" id="report-section">
        <div class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-chart-bar"></i>
                Emissions Report
            </a>
        </div>

        <div class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-file-pdf"></i>
                PDF Reports
            </a>
        </div>

        <div class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-download"></i>
                Export Data
            </a>
        </div>

        <div class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-calendar"></i>
                Yearly Summary
            </a>
        </div>
    </nav>

    <div class="sidebar-footer" style="position: absolute; bottom: 1rem; left: 1rem; right: 1rem;">
        <a href="{{ url('/') }}" class="btn btn-outline-light btn-sm w-100">
            <i class="fas fa-home"></i> Back to Site
        </a>
    </div>
</div>
