@extends('layouts.app')

@section('title', 'Solutions')

@section('content')
<div>
    <div class="ai-bg">
        <div class="green-ball">
            <img src="{{ asset('images/home/greenball.png') }}" style="max-width: 100%;">
        </div>
        <div class="container">
            <div class="row-centered">
                <div class="header">
                    <h1><span>AI for Net Zero:</span></h1>
                    <h3 style="line-height: 40px;">Automated, high-quality carbon and ESG data for every organization.<br>Accelerate your path to Net Zero with confidence and verified accuracy.</h3>
                </div>
                <div class="header-btn mt-5">
                    <a href="#" class="start-for-free-btn">Start for Free</a> &nbsp;&nbsp;
                    <a href="#" class="request-demo-btn">Request a Demo</a>
                </div>
            </div>
        </div>
    </div>

    <img src="/images/home/greenball-side.png" style="max-width: 100%; position: absolute; right: 0; top: 80%;">

    <!-- AI and Validation Engine -->
    <div class="ai-validation-section">
        <div class="container">
            <div class="row align-items-center" style="padding-top: 5rem; padding-bottom: 5rem; min-height: 600px;">
                <div class="col-12 col-md-6">
                    <div class="ai-content">
                        <h2 class="ai-title">AI and Validation Engine</h2>
                        <div class="ai-text mt-5">
                            <p>The Carbon AI Validation Engine forms the core of our carbon accounting platform.</p>
                            <p>It verifies data integrity, detects anomalies, and applies localized emission factors to improve accuracy.</p>
                            <p>By establishing a verifiable digital audit trail for every carbon footprint, it provides trusted insights that strengthen reporting, assurance, and decarbonization strategies.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 d-flex justify-content-center">
                    <img src="{{ asset('images/ai/pic1.png') }}" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </div>

    <!-- Interoperability and Connectors -->
    <div class="interoperability-section" style="margin-top: 7rem;">
        <div class="container">
            <div class="row align-items-center" style="padding-top: 5rem; padding-bottom: 5rem; min-height: 600px;">
                <div class="col-12 col-md-6 d-flex justify-content-center">
                    <img src="{{ asset('images/ai/pic2.png') }}" class="img-fluid rounded shadow">
                </div>

                <div class="col-12 col-md-6">
                    <div class="ai-content">
                        <h2 class="int-title">Interoperability and Connectors</h2>
                        <div class="int-text mt-5">
                            <p>Connect seamlessly across enterprise systems and tools.</p>
                            <p>Carbon AI integrates securely with existing ESG, finance, and operational platforms through APIs designed for reliability and compliance.</p>
                            <p>It unifies sustainability data across Scope 1, 2, and 3, enabling organizations to track emissions consistently and strengthen assurance within a single connected environment.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Engagement Layer (App and SDK)-->
    <div class="engagement-section" style="margin-top: 7rem;">
        <div class="container">
            <div class="row align-items-center" style="padding-top: 5rem; padding-bottom: 5rem; min-height: 600px;">
                <div class="col-12 col-md-6">
                    <div class="ai-content">
                        <h2 class="ai-title">Engagement Layer (App and SDK)</h2>
                        <div class="ai-text mt-5">
                            <p>Transform participation across the value chain into measurable progress.</p>
                            <p>The Carbon AI Engagement Layer enables employees, suppliers, and partners to contribute verified sustainability data directly through an intuitive app and SDK.</p>
                            <p>From procurement and logistics to daily operations, every interaction feeds into a single, verifiable source of truth that enhances ESG reporting and accelerates progress toward Net Zero.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 d-flex justify-content-center">
                    <img src="{{ asset('images/ai/pic3.png') }}" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </div>

    <!-- Data Exchange Hub -->
    <div class="data-exchange-section" style="margin-top: 7rem;">
        <div class="container">
            <div class="row align-items-center" style="padding-top: 5rem; padding-bottom: 5rem; min-height: 600px;">
                <div class="col-12 col-md-6 d-flex justify-content-center">
                    <img src="{{ asset('images/ai/pic2.png') }}" class="img-fluid rounded shadow">
                </div>

                <div class="col-12 col-md-6">
                    <div class="ai-content">
                        <h2 class="int-title">Data Exchange Hub</h2>
                        <div class="int-text mt-5">
                            <p>Build trust through transparent collaboration.</p>
                            <p>The Carbon AI Data Exchange Hub enables suppliers and partners to share validated carbon emissions data securely and consistently.</p>
                            <p>Aligned with international frameworks including the Greenhouse Gas Protocol and ISSB, it ensures interoperability, strengthens disclosure credibility, and drives collective decarbonization across the value chain.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <img src="/images/home/greenball-side.png" style="max-width: 100%; position: absolute; left: 0; top: 430%; transform: scaleX(-1);">

    <!-- Impact Section -->
    <div class="impact-section" style="margin-top: 7rem; margin-bottom: 7rem;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center mb-5">
                    <h2 class="impact-title">Impact</h2>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12 col-md-4">
                    <div class="impact-card">
                        <div class="impact-metric">80%</div>
                        <div class="impact-subtitle">Efficiency gains</div>
                        <div class="impact-description">
                            Organizations reduce the time spent on data collection and validation, accelerating ESG reporting cycles.
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="impact-card">
                        <div class="impact-metric" style="background: linear-gradient(78deg, #1AB3C5 5.05%, #2D8EEF 43.59%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">+70%</div>
                        <div class="impact-subtitle" style="color: #1AB3C5 !important;">Return within the first year</div>
                        <div class="impact-description">
                            AI-driven automation improves productivity and reallocates resources toward achieving decarbonization goals.
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="impact-card">
                        <div class="impact-metric">+60%</div>
                        <div class="impact-subtitle">Emissions reduction potential</div>
                        <div class="impact-description">
                            Enhanced accuracy and verified data unlock deeper insights for measurable climate impact.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom -->
    <div class="container bottom">
        <h1 style="font-weight: 700; font-size: 1.875rem; line-height: 40px;">Experience the power of AI-driven carbon accounting built for assurance,<br> engagement, and measurable impact.</h1>
        <div class="my-5">
            <a href="#" class="start-for-free-btn">Start for Free</a>
            <a href="#" class="request-demo-btn">Request a Demo</a>
        </div>
    </div>
</div>
<script>
</script>
@endsection
