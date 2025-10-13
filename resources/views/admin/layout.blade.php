<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Carbon Wallet</title>

    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    {{-- Font Awesome CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Leaflet CSS and JS for maps --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        .dashboard-container {
            display: flex;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .admin-navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1050;
        }

        .admin-navbar .logo {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: #667eea;
        }

        .admin-navbar .logo img {
            height: 40px;
            margin-right: 10px;
        }

        .year-selector {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .year-selector select {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            background: white;
        }

        .sidebar {
            width: 350px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            padding-top: 80px;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-header h3 {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-item {
            margin: 0.25rem 0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .nav-link:hover, .nav-link.active {
            background-color: rgba(255,255,255,0.1);
            color: white;
            border-left-color: #fff;
        }

        .nav-link i {
            margin-right: 0.75rem;
            width: 20px;
            text-align: center;
        }

        .main-content {
            margin-left: 350px;
            flex: 1;
            padding: 2rem;
            padding-top: 120px;
        }

        .sidebar-tabs {
            display: flex;
            background: rgba(255,255,255,0.1);
            border-radius: 8px;
            margin: 1rem;
            overflow: hidden;
        }

        .sidebar-tab {
            flex: 1;
            padding: 0.75rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            background: transparent;
            color: rgba(255,255,255,0.7);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .sidebar-tab.active {
            background: rgba(255,255,255,0.2);
            color: white;
        }

        .sidebar-tab:hover {
            background: rgba(255,255,255,0.15);
            color: white;
        }

        .sidebar-section {
            display: none;
        }

        .sidebar-section.active {
            display: block;
        }

        .nav-dropdown-toggle {
            cursor: pointer;
            position: relative;
        }

        .nav-dropdown-icon {
            position: absolute;
            right: 1rem;
            transition: transform 0.3s ease;
        }

        .nav-dropdown-toggle.active .nav-dropdown-icon {
            transform: rotate(180deg);
        }

        .nav-dropdown {
            display: none;
            background: rgba(0,0,0,0.1);
            margin: 0.25rem 0;
        }

        .nav-dropdown.show {
            display: block;
        }

        .nav-dropdown-item {
            padding-left: 3rem !important;
            font-size: 0.9rem;
        }

        .nav-dropdown-item:hover {
            background-color: rgba(255,255,255,0.05);
        }

        .content-header {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .content-body {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .table thead th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            font-weight: 500;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #e9ecef;
            padding: 0.75rem;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .alert {
            border-radius: 8px;
            border: none;
        }

        .map-container {
            height: 300px;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e9ecef;
        }

        .map-container .leaflet-container {
            height: 100%;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                padding-top: 80px;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding-top: 120px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        {{-- Admin Navbar --}}
        <nav class="admin-navbar">
            <div class="logo">
                <img src="/images/logo.svg" alt="Carbon Wallet Logo">
                <span>Carbon Wallet</span>
            </div>
            <div class="year-selector">
                <label for="reporting-year">Reporting Year:</label>
                <select id="reporting-year" name="reporting_year">
                    @for($year = date('Y'); $year >= 2020; $year--)
                        <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ $year }}</option>
                    @endfor
                </select>
            </div>
        </nav>

        {{-- Sidebar --}}
        @include('admin.partials.sidebar')

        {{-- Main Content --}}
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    <script>
        // Mobile sidebar toggle
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
        }

        // Dropdown toggle function
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId + '-dropdown');
            const toggle = document.querySelector(`[onclick="toggleDropdown('${dropdownId}')"]`);

            if (dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
                toggle.classList.remove('active');
            } else {
                dropdown.classList.add('show');
                toggle.classList.add('active');
            }
        }

        // Sidebar tab switching
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');

            // Set active nav item
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });

            // Handle sidebar tab clicks
            const tabs = document.querySelectorAll('.sidebar-tab');
            const sections = document.querySelectorAll('.sidebar-section');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const targetSection = this.getAttribute('data-section');

                    // Remove active class from all tabs and sections
                    tabs.forEach(t => t.classList.remove('active'));
                    sections.forEach(s => s.classList.remove('active'));

                    // Add active class to clicked tab and corresponding section
                    this.classList.add('active');
                    document.getElementById(targetSection + '-section').classList.add('active');
                });
            });

            // Auto-select appropriate tab based on current route
            if (currentPath.includes('/admin/locations') ||
                currentPath.includes('/admin/vehicles') ||
                currentPath.includes('/admin/equipment') ||
                currentPath.includes('/admin/scope1') ||
                currentPath.includes('/admin/scope2') ||
                currentPath.includes('/admin/scope3') ||
                currentPath === '/admin') {
                // Activate Measure tab
                document.querySelector('[data-section="measure"]').classList.add('active');
                document.getElementById('measure-section').classList.add('active');
                document.querySelector('[data-section="report"]').classList.remove('active');
                document.getElementById('report-section').classList.remove('active');

                // Auto-expand My Organization dropdown if on those pages
                if (currentPath.includes('/admin/locations') ||
                    currentPath.includes('/admin/vehicles') ||
                    currentPath.includes('/admin/equipment')) {
                    toggleDropdown('organization');
                }

                // Auto-expand Scope 1 dropdown if on scope1 pages
                if (currentPath.includes('/admin/scope1')) {
                    toggleDropdown('scope1');
                }

                // Auto-expand Scope 2 dropdown if on scope2 pages
                if (currentPath.includes('/admin/scope2')) {
                    toggleDropdown('scope2');
                }
            }
        });
    </script>
</body>
</html>
