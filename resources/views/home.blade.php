@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="" style="background: #000">
    <div class="container">
        <div class="row-centered row">
            <!-- First Section -->
            <div class="col-12 col-md-6 text-center text-md-start">
                <div class="header">
                    <h1><span>AI for Net Zero:</span> Audit-Ready Scope 3 Data</h1>
                    <h3>Beyond disclosure: validate data, unlock insights, accelerate decarbonization.</h3>
                    <h5>Carbon data you can trust.</h5>
                </div>
                <div class="header-btn mt-4">
                    <a href="#">Start for Free</a> &nbsp;&nbsp;
                    <a href="#" style="background: none;">Request a Demo</a>
                </div>
            </div>

            <div class="col-12 col-md-6 d-flex justify-content-center align-items-center text-center">
                <div>
                    <h1>Welcome to My Laravel Project</h1>
                    <p>This is the home page.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Video -->
    <div class="container-fluid video p-0">
        <div class="video-wrapper">
            <iframe src="https://www.youtube.com/embed/r2IzYkxmRHI?si=zBlrIGRWhCIde4j7"
                title="YouTube video player"
                allowfullscreen>
            </iframe>
        </div>
    </div>

    <!-- Dropdown -->
    <div class="dropdown">
        <div class="row align-items-center" style="padding-top: 10rem; padding-bottom: 10rem;">
            <div class="col-12 col-md-5 text-center">
                <img id="dropdown-image" src="{{ asset('images/pic1.jpg') }}" class="img-fluid rounded shadow">
            </div>

            <div class="col-12 col-md-7" style="justify-content: left; display: flex;">
                <div class="accordion mx-5" id="dropdownAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                Validate
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#dropdownAccordion"
                            data-img="{{ asset('images/pic1.jpg') }}">
                            <div class="accordion-body">
                                Audit-ready Scope 3 data with AI anomaly detection.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                Enrich
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#dropdownAccordion"
                            data-img="{{ asset('images/pic2.jpg') }}">
                            <div class="accordion-body">
                                Fill gaps using local emission factors & confidence scoring.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                Connect
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#dropdownAccordion"
                            data-img="{{ asset('images/pic3.jpg') }}">
                            <div class="accordion-body">
                                Plug into CDP, SBTi, PACT, ISSB, and your existing tools.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-100 justify-content-center d-flex">
        <div class="line"></div>
    </div>

    <img src="/images/footer-logo.svg" style="width: 15%; position: absolute; right: 5%; transform: scaleX(-1);">

    <!-- Case Tiles -->
    <div class="cards">
        <div class="container">
            <h3>Flexible SaaS solutions <br>for your real estate needs</h3>
            <div class="row g-4 mt-4">
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100">
                        <img src="{{ asset('images/pic1.jpg') }}" alt="Finance Emission">
                        <div class="card-body">
                            <h4>Finance Emission</h4>
                            <p>Meet PCAF & ISSB with validated financed emissions.</p>
                            <a href="">Explore Solution &nbsp; <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100">
                        <img src="{{ asset('images/pic2.jpg') }}" alt="Supplier Data Exchange">
                        <div class="card-body">
                            <h4>Supplier Data Exchange</h4>
                            <p>Collect, validate & enrich supplier climate data.</p>
                            <a href="">Explore Solution &nbsp; <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100">
                        <img src="{{ asset('images/pic3.jpg') }}" alt="Corporate Integration">
                        <div class="card-body">
                            <h4>Corporate Integration</h4>
                            <p>Works with your existing carbon accounting software.</p>
                            <a href="">Explore Solution &nbsp; <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100">
                        <img src="{{ asset('images/pic4.jpg') }}" alt="Emerging Sectors">
                        <div class="card-body">
                            <h4>Emerging Sectors</h4>
                            <p>Validate Scope 3 in the low-altitude economy.</p>
                            <a href="">Explore Solution &nbsp; <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <img src="/images/footer-logo.svg" style="width: 10%; position: absolute; left: 5%;">

    <!-- Differentiation -->
    <div class="differentiation">
        <div class="w-100 justify-content-center d-flex">
            <div class="line"></div>
        </div>
        <div class="container" style="padding-top: 10rem; padding-bottom: 10rem; text-align: right;">
            <h1>Differentiation</h1>
            <div class="my-3">
                <h3>Others measure. We validate.</h3>
                <h3>Carbon AI is not another carbon accounting tool.</h3>
                <h3>We are the infra layer that makes Scope 3 data trusted, verifiable, and interoperable.</h3>
            </div>
            <div class="my-5"><a href="#">Request a Demo</a></div>
        </div>
        {{-- <div class="w-100 justify-content-center d-flex">
            <div class="line"></div>
        </div> --}}
    </div>

    <!-- Logos -->
    <div class="logos" style="background: #fff">
        <div class="logos-wrapper" style="padding-top: 2rem; padding-bottom: 2rem;">
            <div class="logos-slider" id="logosSlider">
                <img src="{{ asset('images/logo1.png') }}" alt="Logo 1">
                <img src="{{ asset('images/logo2.png') }}" alt="Logo 2">
                <img src="{{ asset('images/logo3.jpg') }}" alt="Logo 3">
                <img src="{{ asset('images/logo4.jpg') }}" alt="Logo 4">
                <img src="{{ asset('images/logo5.jpg') }}" alt="Logo 5">
                <img src="{{ asset('images/logo6.jpg') }}" alt="Logo 6">
                <img src="{{ asset('images/logo1.png') }}" alt="Logo 7">
                <img src="{{ asset('images/logo2.png') }}" alt="Logo 8">
            </div>
        </div>
    </div>

    <!-- Insights -->
    <div class="insights">
        <div class="container">
            <h3>Stay Ahead of the Curve</h3>
            <h5 style="text-align: center">
                Explore guides, blogs, and events on Scope 3 validation, finance emissions, and supplier data exchange.
            </h5>

            <div id="insightsCarousel"  class="carousel slide mt-4" data-bs-wrap="true" data-bs-touch="false"  data-bs-keyboard="false">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row my-5">
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="card h-100">
                                <div class="card-body">
                                    <h4>Finance Emissions Guide</h4>
                                    <a href="">Explore Insights →</a>
                                </div>
                                <img src="{{ asset('images/blog1.jpg') }}" alt="Finance Emission">
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="card h-100">
                                <div class="card-body">
                                    <h4>Supplier Data Exchange</h4>
                                    <a href="">Explore Insights →</a>
                                </div>
                                <img src="{{ asset('images/blog2.jpg') }}" alt="Supplier Data Exchange">
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="card h-100">
                                <div class="card-body">
                                    <h4>Scope 3 Decarbonization Insights <span style="font-weight:400; font-size: 1.25rem;"><i>(Asia & GBA)<i></span></h4>
                                    <a href="">Explore Insights →</a>
                                </div>
                                <img src="{{ asset('images/blog3.jpg') }}" alt="Corporate Integration">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="row my-5">
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="card h-100">
                                <div class="card-body">
                                    <h4>Finance Emission</h4>
                                    <a href="">Explore Insights →</a>
                                </div>
                                <img src="{{ asset('images/blog1.jpg') }}" alt="Finance Emission">
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="card h-100">
                                <div class="card-body">
                                    <h4>Supplier Data Exchange</h4>
                                    <a href="">Explore Insights →</a>
                                </div>
                                <img src="{{ asset('images/blog2.jpg') }}" alt="Supplier Data Exchange">
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="card h-100">
                                <div class="card-body">
                                    <h4>Scope 3 Decarbonization Insights<span style="font-weight:400; font-size: 1.25rem;"><i>(Asia & GBA)<i></span></h4>
                                    <a href="">Explore Insights →</a>
                                </div>
                                <img src="{{ asset('images/blog3.jpg') }}" alt="Corporate Integration">
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
    <div class="bottom" style="background: linear-gradient(rgb(64, 224, 219) 40%, rgb(47, 219, 142) 100%);">
        <div class="container" style="padding-top: 5rem; padding-bottom: 5rem; text-align: center;">
            <h1 style="font-weight: 700; font-style: normal; color: #000">Carbon data you can trust</h1>
            <div class="my-5">
                <a href="#" class="btn" style="color: #000; border: 1px solid #000;">Start for Free</a> &nbsp; &nbsp;
                <a href="#" class="btn-outline" style="color: #000; border: 1px solid #000;">Request a Demo</a>
            </div>
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
</script>
@endsection
