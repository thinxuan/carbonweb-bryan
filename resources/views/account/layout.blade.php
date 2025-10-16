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
            padding-bottom: 100px; /* Add bottom padding to account for fixed footer */
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
            position: relative;
            z-index: 1001;
        }

        .nav-dropdown.show {
            display: block;
        }

        /* Ensure Help Center tab always stays visible */
        .nav-item[onclick*="toggleHelpCenter"] {
            position: absolute !important;
            bottom: 6.5rem !important;
            width: 100% !important;
            z-index: 1002 !important;
            display: block !important;
            visibility: visible !important;
        }

        /* Ensure Profile tab stays visible */
        .nav-item[onclick*="toggleProfileDropdown"] {
            position: absolute !important;
            bottom: 4rem !important;
            width: 100% !important;
            z-index: 1001 !important;
            display: block !important;
            visibility: visible !important;
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

        /* Help Center Panel Styles */
        .help-center-panel {
            position: fixed;
            top: 0;
            right: 0;
            width: 400px;
            height: 100vh;
            background: white;
            box-shadow: -2px 0 10px rgba(0,0,0,0.1);
            z-index: 1100;
            transform: translateX(100%);
            transition: transform 0.3s ease;
            overflow-y: auto;
        }

        .help-center-panel.show {
            transform: translateX(0);
        }

        .help-center-content {
            padding: 2rem;
        }

        .help-center-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e9ecef;
        }

        .help-center-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
            color: #495057;
        }

        .help-center-close {
            background: none;
            border: none;
            font-size: 1.2rem;
            color: #6c757d;
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .help-center-close:hover {
            background-color: #f8f9fa;
            color: #495057;
        }

        .help-center-body {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .help-section {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .help-section-title {
            font-size: 1rem;
            font-weight: 600;
            color: #495057;
            margin: 0;
        }

        .help-article {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 1rem;
            transition: all 0.2s ease;
        }

        .help-article:hover {
            border-color: #667eea;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.1);
        }

        .help-article-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .help-article-title {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .help-article-desc {
            font-size: 0.9rem;
            color: #6c757d;
            line-height: 1.4;
        }

        .help-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f8f9fa;
        }

        .help-item:last-child {
            border-bottom: none;
        }

        .help-item-icon {
            color: #667eea;
            width: 16px;
            text-align: center;
        }

        .help-item-link {
            color: #495057;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .help-item-link:hover {
            color: #667eea;
        }

        /* Settings Modal Styles */
        .settings-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0,0,0,0.5);
            z-index: 1200;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .settings-modal.show {
            opacity: 1;
            visibility: visible;
        }

        .settings-modal-content {
            background: white;
            border-radius: 12px;
            width: 98%; /* Further increased width */
            max-width: 1400px; /* Significantly increased max-width */
            height: 95vh; /* Fixed height instead of max-height */
            min-height: 800px; /* Minimum height for smaller screens */
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            display: flex;
            flex-direction: column;
        }

        .settings-modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .settings-modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
            color: #495057;
        }

        .settings-modal-close {
            background: none;
            border: none;
            font-size: 1.2rem;
            color: #6c757d;
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .settings-modal-close:hover {
            background-color: #f8f9fa;
            color: #495057;
        }

        .settings-modal-body {
            display: flex;
            flex: 1;
            overflow: hidden;
        }

        .settings-sidebar {
            width: 300px;
            background: #f8f9fa;
            border-right: 1px solid #e9ecef;
            padding: 1.5rem;
            overflow-y: auto;
        }

        .settings-user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e9ecef;
        }

        .settings-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #ffa726 0%, #ff9800 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .settings-user-info {
            flex: 1;
        }

        .settings-user-name {
            font-weight: 600;
            color: #495057;
            font-size: 0.95rem;
            margin-bottom: 0.25rem;
        }

        .settings-user-email {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .settings-nav {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .settings-nav-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #495057;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s ease;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .settings-nav-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .settings-nav-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 3px solid #fff;
        }


        .settings-content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }

        .settings-section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #495057;
            margin-bottom: 1.5rem;
        }

        .settings-form-group {
            margin-bottom: 1.5rem;
        }

        .settings-label {
            display: block;
            font-weight: 500;
            color: #495057;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .settings-input-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .settings-input {
            flex: 1;
            padding: 0.75rem;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            background: #f8f9fa;
            color: #495057;
            font-size: 0.9rem;
        }

        .settings-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .settings-edit-btn, .settings-copy-btn {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            padding: 0.5rem;
            color: #6c757d;
            cursor: pointer;
            transition: all 0.2s ease;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .settings-edit-btn:hover, .settings-copy-btn:hover {
            background: #e9ecef;
            color: #495057;
        }

        /* Reporting Team Styles */
        .reporting-team-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            gap: 1rem;
        }

        .reporting-team-info {
            flex: 1;
        }

        .reporting-team-description {
            color: #6c757d;
            font-size: 0.9rem;
            line-height: 1.5;
            margin: 0.5rem 0 0 0;
        }

        .invite-user-btn {
            background: #495057;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .invite-user-btn:hover {
            background: #343a40;
        }

        .reporting-team-tabs {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #e9ecef;
        }

        .team-tab {
            padding: 0.75rem 1rem;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            color: #6c757d;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .team-tab:hover {
            color: #495057;
        }

        .team-tab.active {
            color: #667eea;
            border-bottom-color: #667eea;
        }

        .user-search-section {
            margin-bottom: 1.5rem;
        }

        .team-content-area {
            min-height: 300px;
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .no-data-message {
            color: #6c757d;
            font-size: 1rem;
            font-weight: 500;
        }

        .team-pagination {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .pagination-info {
            color: #6c757d;
            font-size: 0.9rem;
        }

        /* Company Information Styles */
        .company-info-item {
            margin-bottom: 2rem;
            display: flex;
            gap: 2rem;
        }

        .company-info-label {
            min-width: 120px;
            font-weight: 500;
            color: #495057;
            font-size: 0.9rem;
            margin-top: 0.25rem;
        }

        .company-info-content {
            flex: 1;
        }

        .company-info-value {
            font-weight: 500;
            color: #495057;
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
        }

        .company-info-value-with-icon {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .company-info-value-with-icon span {
            font-weight: 500;
            color: #495057;
            font-size: 0.95rem;
        }

        .company-info-edit-btn {
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 4px;
            transition: all 0.2s ease;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .company-info-edit-btn:hover {
            background-color: #f8f9fa;
            color: #495057;
        }

        .company-info-description {
            color: #6c757d;
            font-size: 0.85rem;
            line-height: 1.4;
        }

        .company-info-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }

        .company-info-link:hover {
            text-decoration: underline;
        }

        /* Reporting Years Styles */
        .reporting-years-section {
            margin-top: 1.5rem;
        }

        .reporting-years-subtitle {
            font-size: 1rem;
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.75rem;
        }

        .reporting-years-description {
            color: #6c757d;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 1.5rem;
        }

        .reporting-years-table {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 1.5rem;
            background: white;
        }

        .reporting-years-table-body {
            /* Container for all table rows */
        }

        .reporting-years-header {
            display: flex;
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        .reporting-years-column {
            flex: 1;
            padding: 0.75rem 1rem;
            font-weight: 600;
            color: #495057;
            font-size: 0.9rem;
            border-right: 1px solid #e9ecef;
        }

        .reporting-years-column:last-child {
            border-right: none;
            flex: 0 0 120px;
            text-align: center;
        }

        .reporting-years-row {
            display: flex;
            border-bottom: 1px solid #e9ecef;
        }

        .reporting-years-row:last-child {
            border-bottom: none;
        }

        .reporting-years-cell {
            flex: 1;
            padding: 0.75rem 1rem;
            color: #495057;
            font-size: 0.9rem;
            border-right: 1px solid #e9ecef;
            display: flex;
            align-items: center;
        }

        .reporting-years-cell:last-child {
            border-right: none;
            flex: 0 0 120px;
            justify-content: center;
            gap: 0.5rem;
        }

        .reporting-years-action-btn {
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 4px;
            transition: all 0.2s ease;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .reporting-years-action-btn:hover {
            background-color: #f8f9fa;
            color: #495057;
        }

        .reporting-years-action-btn.trash:hover {
            color: #dc3545;
        }

        .add-reporting-year-btn {
            background: #667eea;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .add-reporting-year-btn:hover {
            background: #5a67d8;
            transform: translateY(-1px);
        }

        /* Add Reporting Year Modal Styles */
        .add-reporting-year-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0,0,0,0.5);
            z-index: 1300;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .add-reporting-year-modal.show {
            opacity: 1;
            visibility: visible;
        }

        .add-reporting-year-modal-content {
            background: white;
            border-radius: 12px;
            width: 95%; /* Increased width */
            max-width: 700px; /* Significantly increased max-width */
            height: 90vh; /* Fixed height instead of max-height */
            min-height: 600px; /* Minimum height for smaller screens */
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            display: flex;
            flex-direction: column;
        }

        .add-reporting-year-modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .add-reporting-year-modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
            color: #495057;
        }

        .add-reporting-year-modal-close {
            background: none;
            border: none;
            font-size: 1.2rem;
            color: #6c757d;
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .add-reporting-year-modal-close:hover {
            background-color: #f8f9fa;
            color: #495057;
        }

        .add-reporting-year-modal-body {
            padding: 1.5rem;
            flex: 1;
            overflow-y: auto;
        }

        .add-reporting-year-description {
            color: #6c757d;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 1.5rem;
        }

        .add-reporting-year-form-group {
            margin-bottom: 1rem;
        }

        .add-reporting-year-label {
            display: block;
            font-weight: 500;
            color: #495057;
            margin-bottom: 0.75rem;
            font-size: 0.9rem;
        }

        .required-asterisk {
            color: #dc3545;
        }

        .add-reporting-year-dropdown-container {
            position: relative;
        }

        .add-reporting-year-dropdown {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 0.75rem;
            background: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.2s ease;
        }

        .add-reporting-year-dropdown:hover {
            border-color: #667eea;
        }

        .add-reporting-year-dropdown.open {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .add-reporting-year-dropdown-selected {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex: 1;
        }

        .add-reporting-year-dropdown-selected i {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .add-reporting-year-placeholder {
            color: #6c757d;
        }

        .add-reporting-year-dropdown-arrow {
            color: #6c757d;
            font-size: 0.8rem;
            transition: transform 0.2s ease;
        }

        .add-reporting-year-dropdown.open .add-reporting-year-dropdown-arrow {
            transform: rotate(180deg);
        }

        .add-reporting-year-dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            z-index: 1000;
            max-height: 200px;
            overflow-y: auto;
            display: none;
            margin-top: 2px;
        }

        .add-reporting-year-dropdown-menu.show {
            display: block;
        }

        .add-reporting-year-dropdown-item {
            padding: 0.75rem;
            cursor: pointer;
            border-bottom: 1px solid #f8f9fa;
            transition: all 0.2s ease;
        }

        .add-reporting-year-dropdown-item:last-child {
            border-bottom: none;
        }

        .add-reporting-year-dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .add-reporting-year-item-year {
            font-weight: 600;
            color: #495057;
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }

        .add-reporting-year-item-range {
            color: #6c757d;
            font-size: 0.8rem;
        }

        .add-reporting-year-modal-footer {
            padding: 1.5rem;
            border-top: 1px solid #e9ecef;
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        .add-reporting-year-cancel-btn {
            background: none;
            border: none;
            color: #6c757d;
            padding: 0.75rem 1rem;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .add-reporting-year-cancel-btn:hover {
            background-color: #f8f9fa;
            color: #495057;
        }

        .add-reporting-year-add-btn {
            background: #495057;
            color: white;
            border: none;
            padding: 0.75rem 1rem;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .add-reporting-year-add-btn:hover {
            background: #343a40;
        }

        .add-reporting-year-add-btn:disabled {
            background: #6c757d;
            cursor: not-allowed;
        }

        /* Additional Content Styles */
        .add-reporting-year-additional-content {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e9ecef;
        }

        .add-reporting-year-data-info {
            color: #6c757d;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 0;
        }

        .selected-year-text {
            font-weight: 600;
            color: #495057;
        }

        .add-reporting-year-revenue-input-group {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }

        .add-reporting-year-revenue-input {
            flex: 1;
            padding: 0.75rem;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .add-reporting-year-revenue-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .add-reporting-year-revenue-dropdown-container {
            position: relative;
            min-width: 150px;
        }

        .add-reporting-year-revenue-dropdown {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 0.75rem;
            background: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.2s ease;
            height: 100%;
        }

        .add-reporting-year-revenue-dropdown:hover {
            border-color: #667eea;
        }

        .add-reporting-year-revenue-dropdown.open {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .add-reporting-year-revenue-selected {
            font-size: 0.9rem;
            color: #495057;
        }

        .add-reporting-year-revenue-arrow {
            color: #6c757d;
            font-size: 0.8rem;
            transition: transform 0.2s ease;
        }

        .add-reporting-year-revenue-dropdown.open .add-reporting-year-revenue-arrow {
            transform: rotate(180deg);
        }

        .add-reporting-year-revenue-dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            z-index: 1000;
            max-height: 200px;
            overflow-y: auto;
            display: none;
            margin-top: 2px;
        }

        .add-reporting-year-revenue-dropdown-menu.show {
            display: block;
        }

        .add-reporting-year-revenue-item {
            padding: 0.75rem;
            cursor: pointer;
            border-bottom: 1px solid #f8f9fa;
            transition: all 0.2s ease;
            font-size: 0.9rem;
            color: #495057;
        }

        .add-reporting-year-revenue-item:last-child {
            border-bottom: none;
        }

        .add-reporting-year-revenue-item:hover {
            background-color: #f8f9fa;
        }

        .add-reporting-year-revenue-note {
            color: #6c757d;
            font-size: 0.85rem;
            line-height: 1.4;
            margin-bottom: 0;
        }

        /* Radio Button Styles */
        .add-reporting-year-radio-group {
            margin-top: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .add-reporting-year-radio-item {
            display: flex;
            align-items: center;
        }

        .add-reporting-year-radio {
            margin-right: 0.75rem;
            width: 16px;
            height: 16px;
            accent-color: #667eea;
            cursor: pointer;
        }

        .add-reporting-year-radio-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            font-size: 0.9rem;
            color: #495057;
            font-weight: 500;
        }

        .add-reporting-year-radio-text {
            margin-right: 0.5rem;
        }

        .add-reporting-year-radio-recommended {
            background: #e8f5e8;
            color: #28a745;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            text-transform: uppercase;
        }

        /* Upgrades Styles */
        .upgrades-header {
            margin-bottom: 2rem;
        }

        .upgrades-subtitle {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .upgrades-currency-selector {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 1rem;
        }

        .upgrades-currency-btn {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            color: #495057;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
        }

        .upgrades-currency-btn:hover {
            background: #e9ecef;
        }

        .upgrades-currency-btn i {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .upgrades-section {
            margin-bottom: 2.5rem;
        }

        .upgrades-section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.75rem;
        }

        .upgrades-section-description {
            color: #6c757d;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 1.5rem;
        }

        .upgrades-learn-more {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }

        .upgrades-learn-more:hover {
            text-decoration: underline;
        }

        .upgrades-items-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1rem;
        }

        .upgrade-item-card {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.2s ease;
        }

        .upgrade-item-card:hover {
            border-color: #667eea;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.1);
        }

        .upgrade-item-icon {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .cdp-icon {
            background: #f8f9fa;
            color: #495057;
            border: 2px solid #e9ecef;
        }

        .ghg-icon {
            background: #28a745;
            color: white;
        }

        .secr-icon {
            background: #dc3545;
            color: white;
        }

        .analytics-icon {
            background: #667eea;
            color: white;
        }

        .concierge-icon {
            background: #ffc107;
            color: #212529;
        }

        .upgrade-item-content {
            flex: 1;
        }

        .upgrade-item-title {
            font-size: 1rem;
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.25rem;
        }

        .upgrade-item-price {
            font-size: 1.1rem;
            font-weight: 700;
            color: #495057;
        }

        .upgrade-item-btn {
            background: #495057;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 0.75rem 1.5rem;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .upgrade-item-btn:hover {
            background: #343a40;
            transform: translateY(-1px);
        }

        /* Billing Styles */
        .billing-section {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .billing-section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #495057;
            margin-bottom: 1rem;
        }

        .billing-subscription-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .billing-subscription-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #f8f9fa;
        }

        .billing-subscription-item:last-child {
            border-bottom: none;
        }

        .billing-subscription-name {
            font-weight: 500;
            color: #495057;
            font-size: 0.95rem;
        }

        .billing-subscription-status {
            color: #6c757d;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .billing-details-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .billing-details-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #f8f9fa;
        }

        .billing-details-item:last-child {
            border-bottom: none;
        }

        .billing-details-label {
            font-weight: 500;
            color: #495057;
            font-size: 0.95rem;
        }

        .billing-details-value-with-edit {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .billing-details-value {
            color: #495057;
            font-size: 0.95rem;
        }

        .billing-details-edit-btn {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            color: #495057;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .billing-details-edit-btn:hover {
            background: #e9ecef;
            color: #343a40;
        }

        /* Billing Card Styles */
        .billing-card {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .billing-card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #495057;
            margin-bottom: 1rem;
        }

        .billing-card-content {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .billing-card-left {
            flex: 1;
        }

        .billing-card-center {
            flex: 2;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .billing-card-right {
            flex: 1;
            display: flex;
            justify-content: flex-end;
        }

        .billing-card-label {
            font-size: 0.95rem;
            color: #495057;
            font-weight: 500;
        }

        .billing-card-currency {
            font-size: 1rem;
            font-weight: 600;
            color: #495057;
        }

        .billing-card-description {
            font-size: 0.85rem;
            color: #6c757d;
            line-height: 1.4;
        }

        .billing-card-change-link {
            color: #495057;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .billing-card-change-link:hover {
            color: #667eea;
            text-decoration: underline;
        }

        .billing-card-date {
            font-size: 0.95rem;
            color: #495057;
            font-weight: 500;
        }

        .billing-card-invoice {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }

        .billing-card-amount {
            font-size: 1rem;
            font-weight: 600;
            color: #495057;
        }

        .billing-card-status {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }

        /* Help Center Overlay */
        .help-center-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0,0,0,0.5);
            z-index: 1099;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .help-center-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        /* Profile Dropdown Styles */
        .profile-dropdown-content {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            padding: 1rem;
            margin: 0.5rem;
            min-width: 250px;
        }

        .profile-user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }

        .profile-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #ffa726 0%, #ff9800 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .profile-details {
            flex: 1;
        }

        .profile-name {
            font-weight: 600;
            color: #495057;
            font-size: 0.95rem;
            margin-bottom: 0.25rem;
        }

        .profile-company {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .profile-divider {
            height: 1px;
            background-color: #e9ecef;
            margin: 0.75rem 0;
        }

        .profile-menu-items {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .profile-menu-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 0.75rem;
            color: #495057;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.2s ease;
            font-size: 0.9rem;
        }

        .profile-menu-item:hover {
            background-color: #f8f9fa;
            color: #495057;
        }

        .profile-menu-item i {
            width: 16px;
            text-align: center;
            color: #6c757d;
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
                padding-bottom: 100px; /* Add bottom padding to account for fixed footer */
            }

            .help-center-panel {
                width: 100vw;
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
        @include('account.partials.sidebar')

        {{-- Main Content --}}
        <div class="main-content">
            @yield('content')
        </div>

        {{-- Help Center Side Panel --}}
        <div id="helpCenterPanel" class="help-center-panel">
            <div class="help-center-content">
                <div class="help-center-header">
                    <h5 class="help-center-title">Help Center</h5>
                    <button class="help-center-close" onclick="toggleHelpCenter()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="help-center-body">
                    <div class="help-section">
                        <h6 class="help-section-title">Related articles for Footprint Analytics</h6>
                        <div class="help-article">
                            <a href="#" class="help-article-link">
                                <div class="help-article-title">Footprint Analytics Overview</div>
                                <div class="help-article-desc">Dive into your organization's footprint with an in-depth analysis.</div>
                            </a>
                        </div>
                    </div>

                    <div class="help-section">
                        <h6 class="help-section-title">Looking for more help?</h6>
                        <div class="help-item">
                            <i class="fas fa-star help-item-icon"></i>
                            <a href="#" class="help-item-link">Ask Copilot</a>
                        </div>
                        <div class="help-item">
                            <i class="fas fa-book help-item-icon"></i>
                            <a href="#" class="help-item-link">Read the Knowledge Base</a>
                        </div>
                        <div class="help-item">
                            <i class="fas fa-graduation-cap help-item-icon"></i>
                            <a href="#" class="help-item-link">Enroll in Persefoni Academy</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mobile sidebar toggle
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
        }

        // Help Center toggle function
        function toggleHelpCenter() {
            const panel = document.getElementById('helpCenterPanel');
            panel.classList.toggle('show');

            // Don't close profile dropdown - let both be open simultaneously
        }

        // Profile dropdown toggle function
        function toggleProfileDropdown() {
            const dropdown = document.getElementById('profile-dropdown');
            const toggle = document.querySelector('[onclick="toggleProfileDropdown()"]');

            if (dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
                toggle.classList.remove('active');
            } else {
                dropdown.classList.add('show');
                toggle.classList.add('active');
                // Don't close help center panel - let both be independent
            }
        }

        // Settings modal functions
        function openSettingsModal() {
            const modal = document.getElementById('settingsModal');
            modal.classList.add('show');
            // Close profile dropdown when opening settings
            const profileDropdown = document.getElementById('profile-dropdown');
            const profileToggle = document.querySelector('[onclick="toggleProfileDropdown()"]');
            profileDropdown.classList.remove('show');
            profileToggle.classList.remove('active');
        }

        function closeSettingsModal() {
            const modal = document.getElementById('settingsModal');
            modal.classList.remove('show');
        }

        // Settings tab switching
        function switchSettingsTab(tab) {
            // Remove active class from all nav items first
            document.querySelectorAll('.settings-nav-item').forEach(item => {
                item.classList.remove('active');
            });

            // Add active class to clicked nav item
            event.target.closest('.settings-nav-item').classList.add('active');

            // Hide all content sections
            document.getElementById('my-account-content').style.display = 'none';
            document.getElementById('profile-settings-content').style.display = 'none';
            document.getElementById('reporting-team-content').style.display = 'none';
            document.getElementById('company-information-content').style.display = 'none';
            document.getElementById('reporting-years-content').style.display = 'none';
            document.getElementById('upgrades-content').style.display = 'none';
            document.getElementById('billing-content').style.display = 'none';

            // Show selected content section
            if (tab === 'my-account') {
                document.getElementById('my-account-content').style.display = 'block';
                document.querySelector('.settings-modal-title').textContent = 'My Account';
            } else if (tab === 'profile-settings') {
                document.getElementById('profile-settings-content').style.display = 'block';
                document.querySelector('.settings-modal-title').textContent = 'Profile Settings';
            } else if (tab === 'reporting-team') {
                document.getElementById('reporting-team-content').style.display = 'block';
                document.querySelector('.settings-modal-title').textContent = 'Reporting Team';
            } else if (tab === 'company-information') {
                document.getElementById('company-information-content').style.display = 'block';
                document.querySelector('.settings-modal-title').textContent = 'Company Information';
            } else if (tab === 'reporting-years') {
                document.getElementById('reporting-years-content').style.display = 'block';
                document.querySelector('.settings-modal-title').textContent = 'Reporting Years';
            } else if (tab === 'upgrades') {
                document.getElementById('upgrades-content').style.display = 'block';
                document.querySelector('.settings-modal-title').textContent = 'Upgrades';
            } else if (tab === 'billing') {
                document.getElementById('billing-content').style.display = 'block';
                document.querySelector('.settings-modal-title').textContent = 'Billing';
            }
        }

        // Team tab switching
        function switchTeamTab(tab) {
            // Remove active class from all team tabs
            document.querySelectorAll('.team-tab').forEach(item => {
                item.classList.remove('active');
            });

            // Add active class to clicked team tab
            event.target.classList.add('active');

            // Here you would typically load different content based on the tab
            // For now, we'll just show the same "No Data" message
            console.log('Switched to team tab:', tab);
        }

        // Toggle edit mode for inputs
        function toggleEdit(inputId) {
            const input = document.getElementById(inputId);
            const button = input.nextElementSibling;
            const icon = button.querySelector('i');

            if (input.readOnly) {
                // Enable editing
                input.readOnly = false;
                input.style.backgroundColor = 'white';
                input.style.borderColor = '#667eea';
                icon.className = 'fas fa-check';
                button.style.backgroundColor = '#28a745';
                button.style.color = 'white';
                input.focus();
            } else {
                // Save changes and disable editing
                input.readOnly = true;
                input.style.backgroundColor = '#f8f9fa';
                input.style.borderColor = '#e9ecef';
                icon.className = 'fas fa-edit';
                button.style.backgroundColor = '#f8f9fa';
                button.style.color = '#6c757d';

                // Here you would typically save the data to the server
                console.log('Saved:', inputId, input.value);
            }
        }

        // Copy email to clipboard
        function copyEmail() {
            const emailInput = document.getElementById('email-input');
            emailInput.select();
            emailInput.setSelectionRange(0, 99999); // For mobile devices

            try {
                document.execCommand('copy');
                // Show feedback
                const button = emailInput.nextElementSibling;
                const originalIcon = button.querySelector('i').className;
                button.querySelector('i').className = 'fas fa-check';
                button.style.backgroundColor = '#28a745';
                button.style.color = 'white';

                setTimeout(() => {
                    button.querySelector('i').className = originalIcon;
                    button.style.backgroundColor = '#f8f9fa';
                    button.style.color = '#6c757d';
                }, 2000);
            } catch (err) {
                console.error('Failed to copy email: ', err);
            }
        }

        // Add Reporting Year Modal Functions
        function openAddReportingYearModal() {
            const modal = document.getElementById('addReportingYearModal');
            modal.classList.add('show');
        }

        function closeAddReportingYearModal() {
            const modal = document.getElementById('addReportingYearModal');
            modal.classList.remove('show');
            // Reset dropdown state
            resetReportingYearDropdown();
        }

        function toggleReportingYearDropdown() {
            const dropdown = document.querySelector('.add-reporting-year-dropdown');
            const menu = document.getElementById('reportingYearDropdownMenu');

            dropdown.classList.toggle('open');
            menu.classList.toggle('show');
        }

        function selectReportingYear(year) {
            const dropdown = document.querySelector('.add-reporting-year-dropdown');
            const menu = document.getElementById('reportingYearDropdownMenu');
            const placeholder = document.querySelector('.add-reporting-year-placeholder');
            const addBtn = document.querySelector('.add-reporting-year-add-btn');
            const additionalContent = document.getElementById('additionalContent');
            const selectedYearTexts = document.querySelectorAll('.selected-year-text');

            // Update selected value
            placeholder.textContent = year;
            placeholder.style.color = '#495057';

            // Update year text in additional content
            selectedYearTexts.forEach(text => {
                text.textContent = year;
            });

            // Show additional content
            additionalContent.style.display = 'block';

            // Close dropdown
            dropdown.classList.remove('open');
            menu.classList.remove('show');

            // Enable add button
            addBtn.disabled = false;
        }

        function resetReportingYearDropdown() {
            const dropdown = document.querySelector('.add-reporting-year-dropdown');
            const menu = document.getElementById('reportingYearDropdownMenu');
            const placeholder = document.querySelector('.add-reporting-year-placeholder');
            const addBtn = document.querySelector('.add-reporting-year-add-btn');
            const additionalContent = document.getElementById('additionalContent');
            const revenueInput = document.querySelector('.add-reporting-year-revenue-input');
            const revenueDropdown = document.querySelector('.add-reporting-year-revenue-dropdown');
            const revenueMenu = document.getElementById('revenueDropdownMenu');

            // Reset dropdown state
            dropdown.classList.remove('open');
            menu.classList.remove('show');

            // Reset placeholder
            placeholder.textContent = 'Select a year';
            placeholder.style.color = '#6c757d';

            // Hide additional content
            additionalContent.style.display = 'none';

            // Reset revenue input and dropdown
            if (revenueInput) {
                revenueInput.value = '';
            }
            if (revenueDropdown) {
                revenueDropdown.classList.remove('open');
            }
            if (revenueMenu) {
                revenueMenu.classList.remove('show');
            }

            // Disable add button
            addBtn.disabled = true;
        }

        // Revenue dropdown functions
        function toggleRevenueDropdown() {
            const dropdown = document.querySelector('.add-reporting-year-revenue-dropdown');
            const menu = document.getElementById('revenueDropdownMenu');

            dropdown.classList.toggle('open');
            menu.classList.toggle('show');
        }

        function selectRevenue(currency) {
            const dropdown = document.querySelector('.add-reporting-year-revenue-dropdown');
            const menu = document.getElementById('revenueDropdownMenu');
            const selected = document.querySelector('.add-reporting-year-revenue-selected');

            // Update selected value
            const currencyMap = {
                'USD': 'USD - Dollars',
                'EUR': 'EUR - Euros',
                'GBP': 'GBP - Pounds',
                'MYR': 'MYR - Malaysian Ringgit'
            };
            selected.textContent = currencyMap[currency];

            // Close dropdown
            dropdown.classList.remove('open');
            menu.classList.remove('show');
        }

        function addReportingYear() {
            const placeholder = document.querySelector('.add-reporting-year-placeholder');
            const selectedYear = placeholder.textContent;
            const revenueInput = document.querySelector('.add-reporting-year-revenue-input');
            const revenueSelected = document.querySelector('.add-reporting-year-revenue-selected');

            if (selectedYear !== 'Select a year' && revenueInput.value.trim() !== '') {
                // Format the revenue for display
                const revenue = formatRevenue(revenueInput.value, revenueSelected.textContent);

                // Add the new row to the table
                addReportingYearToTable(selectedYear, revenue);

                // Close the modal and reset form
                closeAddReportingYearModal();
            }
        }

        function formatRevenue(amount, currency) {
            const numAmount = parseFloat(amount.replace(/[^0-9.-]+/g, ""));
            if (isNaN(numAmount)) return amount;

            if (numAmount >= 1000000) {
                return `${currency.split(' ')[0]} ${(numAmount / 1000000).toFixed(1)}M`;
            } else if (numAmount >= 1000) {
                return `${currency.split(' ')[0]} ${(numAmount / 1000).toFixed(1)}K`;
            } else {
                return `${currency.split(' ')[0]} ${numAmount.toFixed(0)}`;
            }
        }

        function addReportingYearToTable(year, revenue) {
            // Find the table body (or create it if it doesn't exist)
            let tableBody = document.querySelector('.reporting-years-table-body');
            if (!tableBody) {
                // Create table body if it doesn't exist
                const table = document.querySelector('.reporting-years-table');
                tableBody = document.createElement('div');
                tableBody.className = 'reporting-years-table-body';
                table.appendChild(tableBody);
            }

            // Create new row
            const newRow = document.createElement('div');
            newRow.className = 'reporting-years-row';
            newRow.innerHTML = `
                <div class="reporting-years-cell">${year}</div>
                <div class="reporting-years-cell">${revenue}</div>
                <div class="reporting-years-cell actions">
                    <button class="reporting-years-action-btn" title="Delete" onclick="deleteReportingYear(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                    <button class="reporting-years-action-btn" title="Edit" onclick="editReportingYear(this)">
                        <i class="fas fa-edit"></i>
                    </button>
                </div>
            `;

            // Add the new row to the table
            tableBody.appendChild(newRow);
        }

        function deleteReportingYear(button) {
            const row = button.closest('.reporting-years-row');
            if (row && confirm('Are you sure you want to delete this reporting year?')) {
                row.remove();
            }
        }

        function editReportingYear(button) {
            const row = button.closest('.reporting-years-row');
            const year = row.querySelector('.reporting-years-cell').textContent;
            const revenue = row.querySelectorAll('.reporting-years-cell')[1].textContent;

            // Open the modal with pre-filled data
            openAddReportingYearModal();

            // Pre-fill the form with existing data
            setTimeout(() => {
                const placeholder = document.querySelector('.add-reporting-year-placeholder');
                placeholder.textContent = year;
                placeholder.style.color = '#495057';

                // Show additional content
                const additionalContent = document.getElementById('additionalContent');
                additionalContent.style.display = 'block';

                // Pre-fill revenue
                const revenueInput = document.querySelector('.add-reporting-year-revenue-input');
                const revenueValue = revenue.split(' ')[1]; // Extract the number part
                revenueInput.value = revenueValue.replace(/[KMB]/g, '');

                // Enable add button
                const addBtn = document.querySelector('.add-reporting-year-add-btn');
                addBtn.disabled = false;
                addBtn.textContent = 'Update Reporting Year';
            }, 100);
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
                if (currentPath.includes('/account/locations') ||
                    currentPath.includes('/account/vehicles') ||
                    currentPath.includes('/account/equipment') ||
                    currentPath.includes('/account/scope1') ||
                    currentPath.includes('/account/scope2') ||
                    currentPath.includes('/account/scope3') ||
                    currentPath === '/account') {
                    // Activate Measure tab
                    document.querySelector('[data-section="measure"]').classList.add('active');
                    document.getElementById('measure-section').classList.add('active');
                    document.querySelector('[data-section="report"]').classList.remove('active');
                    document.getElementById('report-section').classList.remove('active');

                    // Remove active class from all nav links first (including dropdown items)
                    document.querySelectorAll('.sidebar-nav .nav-link').forEach(link => {
                        link.classList.remove('active');
                    });

                    // Set active state based on current route
                    if (currentPath.includes('/account/scope3/footprint-analytics')) {
                        // Footprint Analytics is active
                        document.querySelector('[data-route="account.scope3.footprint-analytics"]').classList.add('active');
                    } else if (currentPath.includes('/account/scope3')) {
                        // Scope 3 index is active
                        document.querySelector('[data-route="account.scope3.index"]').classList.add('active');
                    }

                    // Handle dropdown navigation items
                    if (currentPath.includes('/account/scope2/electricity-usage')) {
                        document.querySelector('a[href*="electricity-usage"]').classList.add('active');
                    } else if (currentPath.includes('/account/scope2/heat-steam-usage')) {
                        document.querySelector('a[href*="heat-steam-usage"]').classList.add('active');
                    } else if (currentPath.includes('/account/scope2/purchased-cooling')) {
                        document.querySelector('a[href*="purchased-cooling"]').classList.add('active');
                    } else if (currentPath.includes('/account/scope1/natural-gas')) {
                        document.querySelector('a[href*="natural-gas"]').classList.add('active');
                    } else if (currentPath.includes('/account/scope1/vehicle-usage-fuel')) {
                        document.querySelector('a[href*="vehicle-usage-fuel"]').classList.add('active');
                    } else if (currentPath.includes('/account/scope1/vehicle-usage-distance')) {
                        document.querySelector('a[href*="vehicle-usage-distance"]').classList.add('active');
                    } else if (currentPath.includes('/account/scope1/fuel-consumption-equipment')) {
                        document.querySelector('a[href*="fuel-consumption-equipment"]').classList.add('active');
                    } else if (currentPath.includes('/account/locations')) {
                        document.querySelector('a[href*="locations"]').classList.add('active');
                    } else if (currentPath.includes('/account/vehicles')) {
                        document.querySelector('a[href*="vehicles"]').classList.add('active');
                    } else if (currentPath.includes('/account/equipment')) {
                        document.querySelector('a[href*="equipment"]').classList.add('active');
                    }

                    // Auto-expand My Organization dropdown if on those pages
                    if (currentPath.includes('/account/locations') ||
                        currentPath.includes('/account/vehicles') ||
                        currentPath.includes('/account/equipment')) {
                        toggleDropdown('organization');
                    }

                    // Auto-expand Scope 1 dropdown if on scope1 pages
                    if (currentPath.includes('/account/scope1')) {
                        toggleDropdown('scope1');
                    }

                    // Auto-expand Scope 2 dropdown if on scope2 pages
                    if (currentPath.includes('/account/scope2')) {
                        toggleDropdown('scope2');
                    }
                }
        });
    </script>

    {{-- Settings Modal --}}
    <div id="settingsModal" class="settings-modal">
        <div class="settings-modal-content">
            <div class="settings-modal-header">
                <h5 class="settings-modal-title">My Account</h5>
                <button class="settings-modal-close" onclick="closeSettingsModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="settings-modal-body">
                <div class="settings-sidebar">
                    <div class="settings-user-profile">
                        <div class="settings-avatar">FL</div>
                        <div class="settings-user-info">
                            <div class="settings-user-name">Fiona Lee</div>
                            <div class="settings-user-email">fiona@changeitconsultancy.com</div>
                        </div>
                    </div>

                    <div class="settings-nav">
                        <div class="settings-nav-item active" onclick="switchSettingsTab('my-account')">
                            My Account
                        </div>
                        <div class="settings-nav-item" onclick="switchSettingsTab('profile-settings')">
                            Profile Settings
                        </div>
                        <div class="settings-nav-item" onclick="switchSettingsTab('reporting-team')">
                            Reporting Team
                        </div>
                        <div class="settings-nav-item" onclick="switchSettingsTab('company-information')">
                            Company Information
                        </div>
                        <div class="settings-nav-item" onclick="switchSettingsTab('reporting-years')">
                            Reporting Years
                        </div>
                        <div class="settings-nav-item" onclick="switchSettingsTab('upgrades')">
                            Upgrades
                        </div>
                        <div class="settings-nav-item" onclick="switchSettingsTab('billing')">
                            Billing
                        </div>
                    </div>
                </div>

                <div class="settings-content">
                    <!-- My Account Content -->
                    <div class="settings-section" id="my-account-content">
                        <h6 class="settings-section-title">My Account</h6>

                        <div class="settings-form-group">
                            <label class="settings-label">First Name</label>
                            <div class="settings-input-group">
                                <input type="text" class="settings-input" value="Fiona" id="first-name-input">
                                <button class="settings-edit-btn" onclick="toggleEdit('first-name-input')">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </div>
                        </div>

                        <div class="settings-form-group">
                            <label class="settings-label">Last Name</label>
                            <div class="settings-input-group">
                                <input type="text" class="settings-input" value="Lee" id="last-name-input">
                                <button class="settings-edit-btn" onclick="toggleEdit('last-name-input')">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </div>
                        </div>

                        <div class="settings-form-group">
                            <label class="settings-label">Email</label>
                            <div class="settings-input-group">
                                <input type="email" class="settings-input" value="fiona@changeitconsultancy.com" readonly id="email-input">
                                <button class="settings-copy-btn" onclick="copyEmail()">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Settings Content -->
                    <div class="settings-section" id="profile-settings-content" style="display: none;">
                        <h6 class="settings-section-title">Profile Settings</h6>

                        <div class="settings-form-group">
                            <label class="settings-label">Language</label>
                            <div class="settings-input-group">
                                <input type="text" class="settings-input" value="English" readonly>
                                <button class="settings-edit-btn">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </div>
                        </div>

                        <div class="settings-form-group">
                            <label class="settings-label">Date Format</label>
                            <div class="settings-input-group">
                                <input type="text" class="settings-input" value="MM-DD-YYYY" readonly>
                                <button class="settings-edit-btn">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </div>
                        </div>

                        <div class="settings-form-group">
                            <label class="settings-label">Numerical Format</label>
                            <div class="settings-input-group">
                                <input type="text" class="settings-input" value="Decimal Point (1,000.00)" readonly>
                                <button class="settings-edit-btn">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Reporting Team Content -->
                    <div class="settings-section" id="reporting-team-content" style="display: none;">
                        <div class="reporting-team-header">
                            <div class="reporting-team-info">
                                <h6 class="settings-section-title">Reporting Team</h6>
                                <p class="reporting-team-description">
                                    Invite or search for reporting team users in your Persefoni Pro account. These users would only have access and permissions to building out sustainability reports, not doing any carbon emissions measuring.
                                </p>
                            </div>
                            <button class="invite-user-btn">
                                Invite User
                            </button>
                        </div>

                        <div class="reporting-team-tabs">
                            <div class="team-tab active" onclick="switchTeamTab('active')">
                                Active
                            </div>
                            <div class="team-tab" onclick="switchTeamTab('invited')">
                                Invited
                            </div>
                            <div class="team-tab" onclick="switchTeamTab('archived')">
                                Archived
                            </div>
                        </div>

                        <div class="user-search-section">
                            <label class="settings-label">User</label>
                            <input type="text" class="settings-input" placeholder="Search for users...">
                        </div>

                        <div class="team-content-area">
                            <div class="no-data-message">
                                No Data
                            </div>
                        </div>

                        <div class="team-pagination">
                            <span class="pagination-info">1-0 of 0</span>
                        </div>
                    </div>

                    <!-- Company Information Content -->
                    <div class="settings-section" id="company-information-content" style="display: none;">
                        <h6 class="settings-section-title">Company Information</h6>

                        <div class="company-info-item">
                            <label class="company-info-label">Company</label>
                            <div class="company-info-content">
                                <div class="company-info-value">Change IT Services Sdn Bhd</div>
                                <div class="company-info-description">
                                    Company Name is determined by the domain name of the email address associated with your Pro account, and can only be changed upon request. If you require a company name change, please file a ticket <a href="#" class="company-info-link">here</a>.
                                </div>
                            </div>
                        </div>

                        <div class="company-info-item">
                            <label class="company-info-label">Industry</label>
                            <div class="company-info-content">
                                <div class="company-info-value-with-icon">
                                    <span>Management of Companies and Enterprises</span>
                                    <button class="company-info-edit-btn">
                                        <i class="fas fa-external-link-alt"></i>
                                    </button>
                                </div>
                                <div class="company-info-description">
                                    Management of Companies and Enterprises - Corporate, Subsidiary, and Regional Managing Offices
                                </div>
                            </div>
                        </div>

                        <div class="company-info-item">
                            <label class="company-info-label">Headquarters</label>
                            <div class="company-info-content">
                                <div class="company-info-value">Malaysia</div>
                                <div class="company-info-description">
                                    Since you have emissions associated to this account, you will not be able to adjust your account headquarters location.
                                </div>
                            </div>
                        </div>

                        <div class="company-info-item">
                            <label class="company-info-label">Account ID</label>
                            <div class="company-info-content">
                                <div class="company-info-value">d3dokkjgitks73cm5f40</div>
                            </div>
                        </div>
                    </div>

                    <!-- Reporting Years Content -->
                    <div class="settings-section" id="reporting-years-content" style="display: none;">
                        <h6 class="settings-section-title">Reporting Years</h6>

                        <div class="reporting-years-section">
                            <h6 class="reporting-years-subtitle">Configured Reporting Years</h6>
                            <p class="reporting-years-description">
                                Your reporting years are set to begin on 01-01 and end on 12-31. If you need to adjust these dates, please <a href="#" class="company-info-link">contact customer support</a>.
                            </p>

                            <div class="reporting-years-table">
                                <div class="reporting-years-header">
                                    <div class="reporting-years-column">Reporting Year</div>
                                    <div class="reporting-years-column">Revenue</div>
                                    <div class="reporting-years-column actions">Actions</div>
                                </div>

                                <div class="reporting-years-table-body">
                                    <div class="reporting-years-row">
                                        <div class="reporting-years-cell">2025</div>
                                        <div class="reporting-years-cell">$1.2M</div>
                                        <div class="reporting-years-cell actions">
                                            <button class="reporting-years-action-btn" title="Delete" onclick="deleteReportingYear(this)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <button class="reporting-years-action-btn" title="Edit" onclick="editReportingYear(this)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button class="add-reporting-year-btn" onclick="openAddReportingYearModal()">
                                <i class="fas fa-plus"></i>
                                Add Reporting Year
                            </button>
                        </div>
                    </div>

                    <!-- Upgrades Content -->
                    <div class="settings-section" id="upgrades-content" style="display: none;">
                        <div class="upgrades-header">
                            <h6 class="settings-section-title">Upgrades</h6>
                            <p class="upgrades-subtitle">0 of 5 Upgrades Owned</p>
                            <div class="upgrades-currency-selector">
                                <button class="upgrades-currency-btn">
                                    <span>US Dollar ($)</span>
                                    <i class="fas fa-edit"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Reports Section -->
                        <div class="upgrades-section">
                            <h6 class="upgrades-section-title">Reports</h6>
                            <p class="upgrades-section-description">
                                Generate detailed reports to ensure accurate and comprehensive reporting. <a href="#" class="upgrades-learn-more">Learn More</a>.
                            </p>

                            <div class="upgrades-items-grid">
                                <div class="upgrade-item-card">
                                    <div class="upgrade-item-icon cdp-icon">CDP</div>
                                    <div class="upgrade-item-content">
                                        <h6 class="upgrade-item-title">CDP Climate Metrics Report</h6>
                                        <div class="upgrade-item-price">$999/yr</div>
                                    </div>
                                    <button class="upgrade-item-btn">Upgrade</button>
                                </div>

                                <div class="upgrade-item-card">
                                    <div class="upgrade-item-icon ghg-icon">
                                        <i class="fas fa-bullseye"></i>
                                    </div>
                                    <div class="upgrade-item-content">
                                        <h6 class="upgrade-item-title">GHG Methodology Report</h6>
                                        <div class="upgrade-item-price">$999/yr</div>
                                    </div>
                                    <button class="upgrade-item-btn">Upgrade</button>
                                </div>

                                <div class="upgrade-item-card">
                                    <div class="upgrade-item-icon secr-icon">
                                        <i class="fas fa-flag"></i>
                                    </div>
                                    <div class="upgrade-item-content">
                                        <h6 class="upgrade-item-title">SECR GHG Metrics Report</h6>
                                        <div class="upgrade-item-price">$999/yr</div>
                                    </div>
                                    <button class="upgrade-item-btn">Upgrade</button>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Footprint Analytics Section -->
                        <div class="upgrades-section">
                            <h6 class="upgrades-section-title">Additional Footprint Analytics</h6>
                            <p class="upgrades-section-description">
                                Expand your analytics capabilities to see detailed scope 1, 2, and 3 emissions by footprint source and GHG Protocol categories, yielding insights that empower you to make informed decarbonization decisions. <a href="#" class="upgrades-learn-more">Learn More</a>.
                            </p>

                            <div class="upgrade-item-card">
                                <div class="upgrade-item-icon analytics-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div class="upgrade-item-content">
                                    <h6 class="upgrade-item-title">Additional Footprint Analytics</h6>
                                    <div class="upgrade-item-price">$999/yr</div>
                                </div>
                                <button class="upgrade-item-btn">Upgrade</button>
                            </div>
                        </div>

                        <!-- Concierge Support Section -->
                        <div class="upgrades-section">
                            <h6 class="upgrades-section-title">Concierge Support</h6>
                            <p class="upgrades-section-description">
                                Need expert assistance with your carbon footprint? Our Concierge Service provides up to 10 hours of tailored support from Climate Experts to help with data integration, technical carbon accounting questions, and footprint reviews, ensuring accurate and compliant carbon reporting. <a href="#" class="upgrades-learn-more">Learn More</a>.
                            </p>

                            <div class="upgrade-item-card">
                                <div class="upgrade-item-icon concierge-icon">
                                    <i class="fas fa-concierge-bell"></i>
                                </div>
                                <div class="upgrade-item-content">
                                    <h6 class="upgrade-item-title">Concierge Support</h6>
                                    <div class="upgrade-item-price">$4,999/yr</div>
                                </div>
                                <button class="upgrade-item-btn">Upgrade</button>
                            </div>
                        </div>
                    </div>

                    <!-- Billing Content -->
                    <div class="settings-section" id="billing-content" style="display: none;">
                        <h6 class="settings-section-title">Billing</h6>

                        <!-- Active Subscriptions Section -->
                        <div class="billing-section">
                            <h6 class="billing-section-title">Active Subscriptions</h6>

                            <div class="billing-subscription-list">
                                <div class="billing-subscription-item">
                                    <div class="billing-subscription-name">Measure Carbon Accounting Management Module</div>
                                    <div class="billing-subscription-status">Included in Pro</div>
                                </div>

                                <div class="billing-subscription-item">
                                    <div class="billing-subscription-name">Footprint Analytics</div>
                                    <div class="billing-subscription-status">Included in Pro</div>
                                </div>

                                <div class="billing-subscription-item">
                                    <div class="billing-subscription-name">Reduction Target Modeling</div>
                                    <div class="billing-subscription-status">Included in Pro</div>
                                </div>
                            </div>
                        </div>

                        <!-- Billing Details Section -->
                        <div class="billing-section">
                            <h6 class="billing-section-title">Billing Details</h6>

                            <div class="billing-details-list">
                                <div class="billing-details-item">
                                    <div class="billing-details-label">Billing contact</div>
                                    <div class="billing-details-value-with-edit">
                                        <span class="billing-details-value">Fiona Lee fiona@changeitconsultancy.com</span>
                                        <button class="billing-details-edit-btn">Edit</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Billing Currency Section -->
                        <div class="billing-card">
                            <h6 class="billing-card-title">Billing Currency</h6>
                            <div class="billing-card-content">
                                <div class="billing-card-left">
                                    <span class="billing-card-label">System default currency</span>
                                </div>
                                <div class="billing-card-center">
                                    <div class="billing-card-currency">US Dollar ($)</div>
                                    <div class="billing-card-description">The currency you wish to use for billing and invoicing.</div>
                                </div>
                                <div class="billing-card-right">
                                    <a href="#" class="billing-card-change-link">Change</a>
                                </div>
                            </div>
                        </div>

                        <!-- Invoices Section -->
                        <div class="billing-card">
                            <h6 class="billing-card-title">Invoices</h6>
                            <div class="billing-card-content">
                                <div class="billing-card-left">
                                    <div class="billing-card-date">09-30-2025</div>
                                    <div class="billing-card-invoice">Invoice #: --</div>
                                </div>
                                <div class="billing-card-center">
                                    <div class="billing-card-amount">$0</div>
                                    <div class="billing-card-status">Paid In Full</div>
                                </div>
                                <div class="billing-card-right">
                                    <!-- Empty right section -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Reporting Year Modal --}}
    <div id="addReportingYearModal" class="add-reporting-year-modal">
        <div class="add-reporting-year-modal-content">
            <div class="add-reporting-year-modal-header">
                <h5 class="add-reporting-year-modal-title">Add Reporting Year</h5>
                <button class="add-reporting-year-modal-close" onclick="closeAddReportingYearModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="add-reporting-year-modal-body">
                <p class="add-reporting-year-description">
                    Your reporting years are set to begin on 01-01 and end on 12-31. If you need to adjust these dates, please <a href="#" class="company-info-link">contact customer support</a>.
                </p>

                <div class="add-reporting-year-form-group">
                    <label class="add-reporting-year-label">
                        Which reporting year would you like to add? <span class="required-asterisk">*</span>
                    </label>
                    <div class="add-reporting-year-dropdown-container">
                        <div class="add-reporting-year-dropdown" onclick="toggleReportingYearDropdown()">
                            <div class="add-reporting-year-dropdown-selected">
                                <i class="fas fa-calendar-alt"></i>
                                <span class="add-reporting-year-placeholder">Select a year</span>
                            </div>
                            <i class="fas fa-chevron-down add-reporting-year-dropdown-arrow"></i>
                        </div>
                        <div class="add-reporting-year-dropdown-menu" id="reportingYearDropdownMenu">
                            <div class="add-reporting-year-dropdown-item" onclick="selectReportingYear('2026')">
                                <div class="add-reporting-year-item-year">2026</div>
                                <div class="add-reporting-year-item-range">01-01-2026 – 12-31-2026</div>
                            </div>
                            <div class="add-reporting-year-dropdown-item" onclick="selectReportingYear('2024')">
                                <div class="add-reporting-year-item-year">2024</div>
                                <div class="add-reporting-year-item-range">01-01-2024 – 12-31-2024</div>
                            </div>
                            <div class="add-reporting-year-dropdown-item" onclick="selectReportingYear('2023')">
                                <div class="add-reporting-year-item-year">2023</div>
                                <div class="add-reporting-year-item-range">01-01-2023 – 12-31-2023</div>
                            </div>
                            <div class="add-reporting-year-dropdown-item" onclick="selectReportingYear('2022')">
                                <div class="add-reporting-year-item-year">2022</div>
                                <div class="add-reporting-year-item-range">01-01-2022 – 12-31-2022</div>
                            </div>
                            <div class="add-reporting-year-dropdown-item" onclick="selectReportingYear('2021')">
                                <div class="add-reporting-year-item-year">2021</div>
                                <div class="add-reporting-year-item-range">01-01-2021 – 12-31-2021</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Content (Hidden Initially) -->
                <div class="add-reporting-year-additional-content" id="additionalContent" style="display: none;">
                    <div class="add-reporting-year-form-group">
                        <label class="add-reporting-year-label">
                            Add organization data from <span class="selected-year-text">2025</span>? <span class="required-asterisk">*</span>
                        </label>
                        <p class="add-reporting-year-data-info">
                            You have 2 locations, 2 vehicles and 1 piece of equipment from <span class="selected-year-text">2025</span> that can be added.<br>
                            You can always add or remove items from their respective pages later.
                        </p>
                        <div class="add-reporting-year-radio-group">
                            <div class="add-reporting-year-radio-item">
                                <input type="radio" id="add-data-yes" name="addOrganizationData" value="yes" class="add-reporting-year-radio">
                                <label for="add-data-yes" class="add-reporting-year-radio-label">
                                    <span class="add-reporting-year-radio-text">Yes</span>
                                    <span class="add-reporting-year-radio-recommended">recommended</span>
                                </label>
                            </div>
                            <div class="add-reporting-year-radio-item">
                                <input type="radio" id="add-data-no" name="addOrganizationData" value="no" class="add-reporting-year-radio">
                                <label for="add-data-no" class="add-reporting-year-radio-label">
                                    <span class="add-reporting-year-radio-text">No</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="add-reporting-year-form-group">
                        <label class="add-reporting-year-label">
                            What was your annual revenue for the <span class="selected-year-text">2023</span> reporting year? <span class="required-asterisk">*</span>
                        </label>
                        <div class="add-reporting-year-revenue-input-group">
                            <input type="text" class="add-reporting-year-revenue-input" placeholder="Enter amount">
                            <div class="add-reporting-year-revenue-dropdown-container">
                                <div class="add-reporting-year-revenue-dropdown" onclick="toggleRevenueDropdown()">
                                    <span class="add-reporting-year-revenue-selected">USD - Dollars</span>
                                    <i class="fas fa-chevron-down add-reporting-year-revenue-arrow"></i>
                                </div>
                                <div class="add-reporting-year-revenue-dropdown-menu" id="revenueDropdownMenu">
                                    <div class="add-reporting-year-revenue-item" onclick="selectRevenue('USD')">USD - Dollars</div>
                                    <div class="add-reporting-year-revenue-item" onclick="selectRevenue('EUR')">EUR - Euros</div>
                                    <div class="add-reporting-year-revenue-item" onclick="selectRevenue('GBP')">GBP - Pounds</div>
                                    <div class="add-reporting-year-revenue-item" onclick="selectRevenue('MYR')">MYR - Malaysian Ringgit</div>
                                </div>
                            </div>
                        </div>
                        <p class="add-reporting-year-revenue-note">
                            This is used for helping generate reports. You can always edit this from the Settings page.
                        </p>
                    </div>
                </div>
            </div>

            <div class="add-reporting-year-modal-footer">
                <button class="add-reporting-year-cancel-btn" onclick="closeAddReportingYearModal()">
                    Cancel
                </button>
                <button class="add-reporting-year-add-btn" onclick="addReportingYear()">
                    Add Reporting Year
                </button>
            </div>
        </div>
    </div>
</body>
</html>
