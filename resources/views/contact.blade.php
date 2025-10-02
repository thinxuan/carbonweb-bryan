@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
    <section class="contact-content">
        <div class="container py-5">
            <div class="banner">
                <h1 class="banner-title">Get in Touch</h1>
                <p class="banner-subtitle">We’d love to hear from you. Reach out anytime.</p>
            </div>
            <img src="/images/footer-logo.svg" style="width: 15%; position: absolute; right: 0; transform: scaleX(-1);">
            <div class="row justify-content-center">
                <div class="form col-md-8">
                    <form action="" method="POST" class="p-4">
                        @csrf
                        <div class="my-2">
                            <label for="first_name" class="form-label">First Name:</label>
                            <input type="text" class="form-control mt-2" id="first_name" name="first_name" placeholder="First Name" required>
                        </div>

                        <div class="my-2">
                            <label for="last_name" class="form-label">Last Name:</label>
                            <input type="text" class="form-control" mt-2 id="last_name" name="last_name" placeholder="Last Name" required>
                        </div>

                        <div class="row my-2">
                            <div class="col-12 col-md-6">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control mt-2" id="email" name="email" placeholder="abc@gmail.com" required>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="email" class="form-label">Contact Number:</label>
                                <input type="text" class="form-control mt-2" id="contact" name="contact" placeholder="012-xxxxxxxx" required>
                            </div>
                        </div>

                        <div class="my-2">
                            <label for="cpmpany" class="form-label">Company Name:</label>
                            <input type="text" class="form-control mt-2" id="company" name="company" placeholder="Company Name" required>
                        </div>

                       <div class="row my-2">
                            <div class="col-12 col-md-6">
                                <label for="hierarchy" class="form-label">Hierarchy:</label>
                                <div class="custom-select-wrapper">
                                    <select class="form-control mt-2 custom-select" id="hierarchy" name="hierarchy" required>
                                        <option value="" disabled selected>Hierarchy</option>
                                        <option value="intern">Intern</option>
                                        <option value="junior">Junior</option>
                                        <option value="senior">Senior</option>
                                        <option value="manager">Manager</option>
                                        <option value="director">Director</option>
                                        <option value="executive">Executive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="department" class="form-label">Department:</label>
                                <div class="custom-select-wrapper">
                                    <select class="form-control mt-2 custom-select" id="department" name="department" required>
                                        <option value="" disabled selected>Department</option>
                                        <option value="hr">Human Resources</option>
                                        <option value="it">IT</option>
                                        <option value="marketing">Marketing</option>
                                        <option value="sales">Sales</option>
                                        <option value="finance">Finance</option>
                                        <option value="operations">Operations</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="my-2">
                            <label for="assets" class="form-label">Number of assets:</label>
                            <div class="custom-select-wrapper">
                                <select class="form-control mt-2 custom-select" id="assets" name="assets" required>
                                    <option value="" disabled selected>Please Select</option>
                                    <option value="200">More than 200</option>
                                    <option value="100">Between 100 and 200</option>
                                    <option value="50">Between 50 and 100</option>
                                    <option value="30">Between 30 and 50</option>
                                    <option value="15">Between 15 and 30</option>
                                    <option value="0">Less than 15</option>
                                </select>
                            </div>
                        </div>

                        <div class="my-2">
                            <label for="message" class="form-label">Message:</label>
                            <textarea class="form-control mt-2" id="message" name="message" rows="5" placeholder="Write your message here..." required></textarea>
                        </div>

                        <p>
                            By submitting this form, you confirm that you agree to the processing of your personal data by Deepki as described in the Privacy Statement.
                        </p>
                        <p style="font-style: italic; font-size: 0.75rem;">
                            You may unsubscribe from these communications at any time. See our Privacy Policy to learn more about our unsubscribe policy, our privacy policies and our commitment to privacy protection and respect. By clicking on "Submit" below, you authorise Deepki to store and process the personal data submitted above in order to provide you with the requested content.
                        </p>
                        <div class="my-3">
                            <label style="display: flex; align-items: center; gap: 8px;">
                                <input type="checkbox" name="consent" required>
                                <span>I consent to receive other communications from Carbonwallet.</span>
                            </label>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="form-submit-btn btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
