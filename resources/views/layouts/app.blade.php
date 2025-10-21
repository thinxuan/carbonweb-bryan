<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <title>@yield('title', 'My Laravel App')</title> --}}
    <title>CARBON WALLET</title>

    {{-- Google Fonts - Montserrat --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">

    {{-- Font Awesome CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <!-- Left Nav -->
            <div class="nav-left d-flex align-items-center">
                <div class="" style="display: flex; align-items: center; flex-direction: row;">
                    <a href="{{ url('/') }}" class="me-4" style="    margin-right: 0 !important;"><img src="/images/logo.svg"></a>
                    <h5>CarbonAI</h5>
                </div>

                <div class="">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown me-4">
                            <a class="nav-link" href="{{ url('/') }}" id="homeDropdown">
                                Home
                            </a>
                        </li>
                        <li class="nav-item dropdown me-4">
                            <a class="nav-link dropdown-toggle" href="{{ url('/ai') }}" id="aiDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                AI
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="aiDropdown">
                                <li><a class="dropdown-item" href="#">AI & Validation Engine</a></li>
                                <li><a class="dropdown-item" href="#">Interoperability & Connectors</a></li>
                                <li><a class="dropdown-item" href="#">Engagement Layer</a></li>
                                <li><a class="dropdown-item" href="#">Data Exchange Hub</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown me-4">
                            <a class="nav-link dropdown-toggle" href="{{ url('/customers') }}" id="customersDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Customers
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="customersDropdown">
                                <li><a class="dropdown-item" href="#">Finance Emissions</a></li>
                                <li><a class="dropdown-item" href="#">Supplier & Corporate Integration</a></li>
                                <li><a class="dropdown-item" href="#">Low-Altitude Economy </a></li>
                                <li><a class="dropdown-item" href="#">Hospitality & Logistics</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown me-4">
                            <a class="nav-link dropdown-toggle" href="{{ url('/industries') }}" id="industriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Industries
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="industriesDropdown">
                                <li><a class="dropdown-item" href="#">Finance</a></li>
                                <li><a class="dropdown-item" href="#">Hospitality</a></li>
                                <li><a class="dropdown-item" href="#">Logistics</a></li>
                                <li><a class="dropdown-item" href="#">Consumer Goods</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown me-4">
                            <a class="nav-link dropdown-toggle" href="{{ url('/insights') }}" id="insightsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Insights
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="insightsDropdown">
                                <li><a class="dropdown-item" href="#">Blog</a></li>
                                <li><a class="dropdown-item" href="#">Glossary</a></li>
                                <li><a class="dropdown-item" href="#">Events</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown me-4">
                            <a class="nav-link dropdown-toggle" href="{{ url('/company') }}" id="companyDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Company
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="companyDropdown">
                                <li><a class="dropdown-item" href="#">About</a></li>
                                <li><a class="dropdown-item" href="#">Careers</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Right Nav -->
            <div class="nav-right">
                {{-- <a href="{{ route('account.index') }}" class="btn btn-outline me-2">Account Dashboard</a> --}}
                <a href="#" class="btn">Start for Free</a>
                <a href="#" class="btn-outline">Request a Demo</a>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <main class="">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer text-white">
        {{-- <div class="container py-5">
            <div class="row">
                <!-- Newsletter -->
                <div class="col-12 col-lg-5 mb-4 mb-lg-0">
                    <h5 class="mb-3">Subscribe to our Newsletter</h5>
                    <form class="d-flex flex-column flex-sm-row">
                        <input type="email" class="form-control me-sm-2 mb-2 mb-sm-0" placeholder="Enter your email">
                        <button type="submit" class="btn form-submit-btn">Subscribe</button>
                    </form>
                </div>

                <!-- About & Contact -->
                <div class="col-12 col-lg-7">
                    <div class="row"  style="justify-content: right;">
                        <div class="col-6 col-md-4 mb-4 mb-md-0">
                            <h6 class="fw-bold mb-3">Company</h6>
                            <ul class="list-unstyled mt-4">
                                <li><a href="#">About</a></li>
                                <li><a href="#">Careers</a></li>
                            </ul>
                        </div>

                        <img src="/images/footer-logo.svg" style="max-width: 15%; position: absolute; right: 40%; top: -25%;">

                        <div class="col-6 col-md-4 mb-4 mb-md-0">
                            <a href="/contact" class="fw-bold mb-3">Contact</a>
                            <ul class="list-unstyled mt-4">
                                <li><a href="mailto:info@example.com">info@example.com</a></li>
                                <li><a href="#">+60 123 456 789</a></li>
                                <li><a href="#">Kuala Lumpur, MY</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Copyright -->
        <div class="footer-bottom text-center py-3">
            <small>© {{ date('Y') }} Carbon AI. All rights reserved.</small>
        </div>
    </footer>
</body>

</html>
