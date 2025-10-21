@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div>
    <div class="homepage-bg">
        <div class="green-ball">
            <img src="{{ asset('images/home/greenball.png') }}" style="max-width: 100%;">
        </div>
        <div class="container">
            <div class="row-centered">
                <div class="header">
                    <h1><span>AI for Net Zero:</span></h1>
                    <h3>The audit-ready ESG and carbon accounting platform that validates Scope 1–3 data with AI precision.</h3>
                </div>
                <div class="header-btn mt-5">
                    <a href="#" class="start-for-free-btn">Start for Free</a> &nbsp;&nbsp;
                    <a href="#" class="request-demo-btn">Request a Demo</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Display Images -->
    <div class="container-fluid display-section p-0" style="background-image: url('{{ asset('images/home/faded-green.png') }}'); background-size: contain; background-position: center; background-repeat: no-repeat;">
        <div class="display-wrapper">
            <img src="{{ asset('images/home/display-top.png') }}" alt="Display Top" class="display-image">
            <img src="{{ asset('images/home/display-btm.png') }}" alt="Display Bottom" class="display-image">
        </div>
    </div>

    <!-- Value Proposition -->
    <div class="value-proposition">
        <div class="container">
            <div class="row align-items-center" style="padding-top: 5rem; padding-bottom: 5rem; min-height: 500px;">
                <div class="col-12 col-md-6 text-center">
                    <img src="{{ asset('images/home/pic6.png') }}" class="img-fluid rounded shadow">
                </div>

                <div class="col-12 col-md-6">
                    <div class="value-boxes">
                        <div class="value-box" onclick="toggleValueBox(this)">
                            <div class="value-header">
                                <h4 class="value-title">Validate</h4>
                                <button class="dropdown-arrow">↓</button>
                            </div>
                            <div class="value-divider"></div>
                            <p class="value-description">AI-powered and audit-ready ESG data validation for Scope 1-3 emissions.</p>
                        </div>

                        <div class="value-box" onclick="toggleValueBox(this)">
                            <div class="value-header">
                                <h4 class="value-title">Enrich</h4>
                                <button class="dropdown-arrow">↓</button>
                            </div>
                            <div class="value-divider"></div>
                            <p class="value-description">Enhance accuracy with localized emission factors and confidence scoring.</p>
                        </div>

                        <div class="value-box" onclick="toggleValueBox(this)">
                            <div class="value-header">
                                <h4 class="value-title">Connect</h4>
                                <button class="dropdown-arrow">↓</button>
                            </div>
                            <div class="value-divider"></div>
                            <p class="value-description">Integrate seamlessly with carbon accounting software, registries, and financial systems through API.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="/images/home/greenball-side.png" style="max-width: 100%; position: absolute; left: 0; top: 250%; transform: scaleX(-1);">
    </div>

    <!-- Case Tiles -->
    <div class="cards">
        <div class="container">
            <div class="row g-4 mt-4">
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100" style="background-image: url('{{ asset('images/home/pic1.png') }}'); background-size: cover; background-position: center;">
                        <div class="card-body">
                            <h4>Hospitality & <br>Tourism</h4>
                            <div class="content-row">
                                <p>Guest-level sustainability data that converts into verified carbon savings.</p>
                                <a href=""><img src="/images/home/arrow.svg"></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100" style="background-image: url('{{ asset('images/home/pic2.png') }}'); background-size: cover; background-position: center;">
                        <div class="card-body">
                            <h4 style="color: #1AB3C5">Finance & <br>Investments</h4>
                            <div class="content-row">
                                <p>Verified ESG data for green loans, bonds, and carbon-linked financing.</p>
                                <a href=""><img src="/images/home/arrow.svg"></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100" style="background-image: url('{{ asset('images/home/pic3.png') }}'); background-size: cover; background-position: center;">
                        <div class="card-body">
                            <h4>Supply Chain & Manufacturing</h4>
                            <div class="content-row">
                                <p>AI validation for supplier Scope 1-3 disclosures and benchmarking.</p>
                                <a href=""><img src="/images/home/arrow.svg"></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100" style="background-image: url('{{ asset('images/home/pic4.png') }}'); background-size: cover; background-position: center;">
                        <div class="card-body">
                            <h4 style="color: #1AB3C5">Corporate & Integration</h4>
                            <div class="content-row">
                                <p>Plug Carbon AI into your ESG, POS, or ERP systems seamlessly.</p>
                                <a href=""><img src="/images/home/arrow.svg"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="/images/home/greenball-side.png" style="max-width: 100%; position: absolute; right: 0; top: 330%;">
    </div>

    <!-- Differentiation -->
    <div class="differentiation">
        <div class="container" style="padding-top: 10rem; padding-bottom: 10rem;">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h1 style="-webkit-text-fill-color: #fff;">Others measure.</h1>
                    <h1>We validate.</h1>
                    <div class="my-3">
                        <h3>Carbon AI isn’t just a reporting platform. It is an AI driven verification layer linking ESG and carbon accounting data to financial markets.</h3>
                    </div>
                    <div class="my-5"><a href="#">Request a Demo</a></div>
                </div>
                <div class="col-12 col-md-6">
                    <img src="{{ asset('images/home/pic5.png') }}" class="img-fluid rounded shadow" style="float: right;">
                </div>
            </div>
        </div>
        {{-- <div class="w-100 justify-content-center d-flex">
            <div class="line"></div>
        </div> --}}
    </div>

    <!-- Logos -->
    <div class="logos" style="background: #fff; position: relative;">
        <div class="logos-wrapper" style="padding-top: 8rem; padding-bottom: 8rem;">
            <div class="logos-slider" id="logosSlider">
                <img src="{{ asset('images/home/logo1.svg') }}" alt="Logo 1">
                <img src="{{ asset('images/home/logo2.svg') }}" alt="Logo 2">
                <img src="{{ asset('images/home/logo3.svg') }}" alt="Logo 3">
                <img src="{{ asset('images/home/logo4.svg') }}" alt="Logo 4">
                <img src="{{ asset('images/home/logo5.svg') }}" alt="Logo 5">
                <img src="{{ asset('images/home/logo6.svg') }}" alt="Logo 6">
                <img src="{{ asset('images/home/logo7.svg') }}" alt="Logo 7">
                <img src="{{ asset('images/home/logo8.svg') }}" alt="Logo 8">
            </div>
        </div>
    </div>
    <img src="/images/home/greenball-side.png" style="max-width: 100%; position: absolute; left: 0; top: 455%; transform: scaleX(-1); z-index: 1;">

    <!-- Insights -->
    <div class="insights">
        <div class="container">
            <h3>Stay Ahead of the Curve</h3>
            <h5>Discover verified carbon data and decarbonization insights aligned with SBTi and global disclosure standards.</h5>

            <div id="insightsCarousel"  class="carousel slide mt-4" data-bs-wrap="true" data-bs-touch="false"  data-bs-keyboard="false">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row my-5">
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h4>Finance Emissions Guide</h4>
                                        <div class="insights-content-row">
                                            <a href="">Explore Insights</a>
                                            <a href="" class="insights-arrow">
                                                <i class="fa-solid fa-arrow-up"></i>
                                            </a>
                                        </div>
                                        <img src="{{ asset('images/blog1.jpg') }}" alt="Finance Emission">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h4 style="color: #1AB3C5;">Supplier Data Exchange</h4>
                                        <div class="insights-content-row">
                                            <a href="">Explore Insights</a>
                                            <a href="" class="insights-arrow">
                                                <i class="fa-solid fa-arrow-up"></i>
                                            </a>
                                        </div>
                                        <img src="{{ asset('images/blog2.jpg') }}" alt="Supplier Data Exchange">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h4>Scope 3 Decarbonization Insights (Asia & GBA)</h4>
                                        <div class="insights-content-row">
                                            <a href="">Explore Insights</a>
                                            <a href="" class="insights-arrow">
                                                <i class="fa-solid fa-arrow-up"></i>
                                            </a>
                                        </div>
                                        <img src="{{ asset('images/blog3.jpg') }}" alt="Corporate Integration">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="row my-5">
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h4>Finance Emissions Guide</h4>
                                        <div class="insights-content-row">
                                            <a href="">Explore Insights</a>
                                            <a href="" class="insights-arrow">
                                                <i class="fa-solid fa-arrow-up"></i>
                                            </a>
                                        </div>
                                        <img src="{{ asset('images/blog1.jpg') }}" alt="Finance Emission">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h4 style="color: #1AB3C5;">Supplier Data Exchange</h4>
                                        <div class="insights-content-row">
                                            <a href="">Explore Insights</a>
                                            <a href="" class="insights-arrow">
                                                <i class="fa-solid fa-arrow-up"></i>
                                            </a>
                                        </div>
                                        <img src="{{ asset('images/blog2.jpg') }}" alt="Supplier Data Exchange">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h4>Scope 3 Decarbonization Insights (Asia & GBA)</h4>
                                        <div class="insights-content-row">
                                            <a href="">Explore Insights</a>
                                            <a href="" class="insights-arrow">
                                                <i class="fa-solid fa-arrow-up"></i>
                                            </a>
                                        </div>
                                        <img src="{{ asset('images/blog3.jpg') }}" alt="Corporate Integration">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Prev/Next buttons -->
                <button class="carousel-control-prev" type="button" data-bs-target="#insightsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#insightsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Bottom -->
    <div class="container bottom">
        <h1>Carbon data you can trust</h1>
        <div class="my-5">
            <a href="#" class="start-for-free-btn">Start for Free</a>
            <a href="#" class="request-demo-btn">Request a Demo</a>
        </div>
    </div>
</div>
<script>

document.addEventListener("DOMContentLoaded", function () {
    // Accordion image change
    const accordionItems = document.querySelectorAll(".accordion-collapse");
    const image = document.getElementById("dropdown-image");

    accordionItems.forEach(item => {
        item.addEventListener("show.bs.collapse", function () {
            const newImg = item.getAttribute("data-img");
            if (newImg) {
                image.src = newImg;
            }
        });
    });

    // Logos
    const slider = document.getElementById("logosSlider");
    let speed = 1;
    let position = 0;

    function animate() {
        position -= speed;
        slider.style.transform = `translateX(${position}px)`;

        const firstLogo = slider.firstElementChild;
        const firstLogoWidth = firstLogo.offsetWidth + 80;

        if (Math.abs(position) >= firstLogoWidth) {
        slider.appendChild(firstLogo);
        position += firstLogoWidth;
        }

        requestAnimationFrame(animate);
    }
    animate();
});

function toggleValueBox(element) {
    // Remove active class from all value boxes
    document.querySelectorAll('.value-box').forEach(box => {
        box.classList.remove('active');
    });

    // Add active class to clicked box
    element.classList.add('active');
}

// Set first value box as active by default when page loads
document.addEventListener('DOMContentLoaded', function() {
    const firstValueBox = document.querySelector('.value-box');
    if (firstValueBox) {
        firstValueBox.classList.add('active');
    }
});
</script>
@endsection
