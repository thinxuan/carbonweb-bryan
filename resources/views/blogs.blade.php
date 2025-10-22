@extends('layouts.app')

@section('title', 'Blogs')

@section('content')
<div>
    <div class="blogs-bg">
        <div class="green-ball">
            <img src="{{ asset('images/home/greenball.png') }}" style="max-width: 100%;">
        </div>
        <div class="container">
            <div class="row-centered">
                <div class="header">
                    <h1><span>Blogs</span></h1>
                    <h3 style="line-height: 40px;">Turning sustainability intelligence into action.</h3>
                    <h3 style="line-height: 40px;">Explore insights on carbon accounting software, ESG reporting, decarbonization, climate technology, and the path to Net Zero.</h3>
                </div>
            </div>
        </div>
    </div>

    <img src="/images/home/greenball-side.png" style="max-width: 100%; position: absolute; right: 0; top: 80%;">









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
