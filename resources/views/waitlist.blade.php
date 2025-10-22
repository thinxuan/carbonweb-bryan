<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CarbonWallet Waitlist</title>

    <!-- Google Fonts - Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: #0a0a0a;
            color: #ffffff;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        .container {
            position: relative;
            z-index: 3;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .waitlist-form {
            width: 100%;
            max-width: 1200px;
            text-align: center;
            justify-content: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            margin: 0 auto 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            color: white;
        }

        .brand-text {
            font-size: 12px;
            font-weight: 500;
            color: #a0a0a0;
            letter-spacing: 2px;
            margin-bottom: 16px;
            text-transform: uppercase;
        }

        .main-title {
            font-size: 3.5rem;
            font-weight: 700 !important;
            background: linear-gradient(180deg, #212026 0%, #504f54 30%, #ffffff 90%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
            line-height: 1.2;
        }

        .accent-text {
            font-size: 4.375rem;
            font-weight: 700;
            background: linear-gradient(90deg, #16D3CA 0%, #1AB3C5 50%, #0FA3B8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .waitlist-form p {
            font-weight: 500;
            font-size: 1.25rem;
            line-height: 30px;
            color: #ffffff;
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            color: #ffffff;
            font-size: 16px;
            z-index: 1;
            opacity: 0.7;
        }

        .form-input {
            width: 100%;
            padding: 16px 16px 16px 48px;
            background: #0B0B0B;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: #ffffff;
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .form-input:focus {
            outline: none;
            border-color: #16d3ca;
            box-shadow: 0 0 0 3px rgba(22, 211, 202, 0.1);
            background: rgba(30, 30, 30, 0.8);
        }

        .form-input::placeholder {
            color: #666;
            font-family: Montserrat;
            font-size: 1rem;
            font-weight: 400;
        }

        /* Override browser autofill styling */
        .form-input:-webkit-autofill,
        .form-input:-webkit-autofill:hover,
        .form-input:-webkit-autofill:focus,
        .form-input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px rgba(30, 30, 30, 0.8) inset !important;
            -webkit-text-fill-color: #ffffff !important;
            background-color: rgba(30, 30, 30, 0.8) !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        /* Firefox autofill styling */
        .form-input:-moz-autofill {
            background-color: rgba(30, 30, 30, 0.8) !important;
            color: #ffffff !important;
        }

        .submit-btn {
            width: 100%;
            padding: 16px 24px;
            background: linear-gradient(90deg, #16D3CA 0%, #1AB3C5 50%, #0FA3B8 100%);
            border-radius: 12px;
            color: #ffffff;
            font-size: 1.25rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            backdrop-filter: blur(10px);
            font-family: 'Montserrat', sans-serif;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .arrow-icon {
            font-size: 18px;
            transition: transform 0.3s ease;
        }

        .submit-btn:hover .arrow-icon {
            transform: translateX(4px);
        }

        .footer-text {
            position: fixed;
            width: 100%;
            bottom: 1%;
            left: 50%;
            transform: translateX(-50%);
            font-size: .75rem;
            color: #ffffffa8;
            text-align: center;
            z-index: 4;
        }

        .footer-text p {
            margin-bottom: 4px;
        }

        .footer-text p:last-child {
            margin-bottom: 0;
        }

        /* Success Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            align-items: center;
        }

        .modal-content {
            background: radial-gradient(circle at top center, #16D3CA 0%, rgba(22, 211, 202, 0.3) 0%, transparent 35%), linear-gradient(179deg, transparent 0%, #0a0a0a 10%);
            backdrop-filter: blur(20px);
            background-repeat: no-repeat;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            margin: 15% auto;
            padding: 40px;
            width: 100%;
            max-width: 500px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(324deg, #47D67B, #16D3CA);
            border-radius: 50%;
            margin: 0 auto 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: white;
        }

        .modal-title {
            font-size: 2.188rem;
            font-weight: 600;
            margin-bottom: 16px;
            background: linear-gradient(90deg, #16D3CA 0%, #1AB3C5 50%, #0FA3B8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .modal-message {
            font-size: 1.25rem;
            color: #fff;
            line-height: 30px;
            font-weight: 500;
        }

        .modal-btn {
            background: #0d958f;
            border: none;
            border-radius: 12px;
            color: white;
            padding: 1rem 0rem;
            font-size: 1.25rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: Montserrat;
            width: 100%;
            margin-top: 2rem;
        }

        .modal-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(22, 211, 202, 0.3);
        }

        .success-message {
            display: none;
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #22c55e;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
        }

        .error-message {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #ef4444;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
        }

        @media (max-width: 1200px) {
            .main-title {
                font-size: 2rem;
            }

            .modal-title {
                font-size: 1.75rem;
            }

            .modal-message, .submit-btn {
                font-size: .9rem;
                line-height: 20px;
            }

            .modal-btn {
                font-size: .75rem;
            }

            .waitlist-form p {
                font-size: .95rem;
                line-height: 20px;
                padding: 0rem 3rem;
            }

            .footer-text {
                font-size: .5rem;
            }
        }

        /* Tablet Landscape Responsive Styles */
        @media (max-width: 992px) and (orientation: landscape) {
            .container {
                padding: 10px;
            }

            .waitlist-form {
                max-width: 100%;
                padding: 0 5px;
            }

            .main-title {
                font-size: 1.8rem;
                line-height: 1.1;
                margin-bottom: 0.5rem;
            }

            .accent-text {
                font-size: 1.8rem;
                line-height: 1.1;
                margin-bottom: 0.5rem;
            }

            .waitlist-form p {
                font-size: 0.8rem;
                line-height: 1.3;
                padding: 0;
                margin-bottom: 1rem;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-input {
                padding: 12px 16px 12px 40px;
                font-size: 0.85rem;
            }

            .form-input::placeholder {
                font-size: 0.8rem;
            }

            .submit-btn {
                padding: 12px 20px;
                font-size: 0.9rem;
                margin-top: 1rem;
            }

            .modal-content {
                width: 85%;
                max-width: 350px;
                padding: 1.5rem 1rem;
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .modal-content h2 {
                font-size: 1.2rem;
                margin-bottom: 0.8rem;
            }

            .modal-content p {
                font-size: 0.8rem;
                line-height: 1.4;
            }

            .modal-btn {
                padding: 10px 20px;
                font-size: 0.85rem;
            }

            .footer-text {
                font-size: 0.45rem;
                bottom: 1%;
                padding: 0 15px;
            }
        }

        /* Mobile Responsive Styles */
        @media (max-width: 992px) and (orientation: portrait) {
            .container {
                padding: 15px;
            }

            .waitlist-form {
                max-width: 100%;
                padding: 0 10px;
            }

            .main-title {
                font-size: 2.5rem;
                line-height: 1.2;
            }

            .accent-text {
                font-size: 2.5rem;
                line-height: 1.2;
            }

            .waitlist-form p {
                font-size: .9rem;
                line-height: 1.4;
                padding: 0;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-input {
                padding: 16px 20px 16px 48px;
                font-size: .9rem;
            }

            .form-input::placeholder {
                font-size: 1rem;
            }

            .submit-btn {
                padding: 16px 24px;
                font-size: 1rem;
                margin-top: 1.5rem;
            }

            .modal-content {
                width: 90%;
                max-width: 400px;
                padding: 2rem 1.5rem;
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .modal-content h2 {
                font-size: 1.5rem;
                margin-bottom: 1rem;
            }

            .modal-content p {
                font-size: .9rem;
                line-height: 1.5;
            }

            .modal-btn {
                padding: 12px 24px;
                font-size: 1rem;
            }

            .footer-text {
                font-size: 0.5rem;
                bottom: 2%;
                padding: 0 20px;
            }
        }


        /* Responsive design */
        @media (max-width: 640px) {
            .waitlist-form {
                padding: 40px 24px;
                margin: 20px;
            }

            .main-title {
                font-size: 28px;
            }

            .accent-text {
                font-size: 32px;
            }
        }


        @media (max-width: 578px) {
            .main-title {
                font-size: 1.25rem;
            }

            .accent-text {
                font-size: 1.5rem;
            }

            .waitlist-form p {
                font-size: .75rem;
                line-height: 25px;
            }

            .form-input {
                padding: 14px 16px 14px 48px;
                font-size: .9rem;
            }

            .form-input::placeholder {
                font-size: .75rem;
            }

            .submit-btn {
                font-size: 0.75rem;
            }

            .modal-content {
                padding: 1.5rem 1rem;
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .modal-content h2 {
                font-size: 0.875rem;
            }

            .modal-content p {
                font-size: 0.75rem;
                line-height: 25px;
            }

            .modal-btn {
                font-size: 0.75rem;
            }

            .footer-text {
                font-size: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="waitlist-form">
            <!-- Main title -->
            <img src="{{ asset('images/logo.svg') }}" class="carbon-logo">
            <h1 class="main-title">Join the waitlist for</h1>
            <h1 class="accent-text">CarbonAI</h1>

            <p>Be among the first to access Carbon AI's audit-ready carbon accounting platform, purpose-built for verified ESG reporting and measurable progress toward Net Zero.</p>

            <!-- Error Messages -->
            @if($errors->any())
                <div class="error-message">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Waitlist Form -->
            <form method="POST" action="{{ route('waitlist.store') }}" style="width: 100%; max-width: 600px; padding-top: 2rem;">
                @csrf
                <div class="form-group my-5">
                    <div class="input-wrapper">
                        <div class="input-icon"><i class="fa-solid fa-user"></i></div>
                        <input
                            type="text"
                            name="name"
                            class="form-input"
                            placeholder="{{ old('name', 'Name') }}"
                            value="{{ old('name') }}"
                            required
                        >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <div class="input-icon"><i class="fa-solid fa-envelope"></i></div>
                        <input
                            type="email"
                            name="email"
                            class="form-input"
                            placeholder="{{ old('email', 'Email Address') }}"
                            value="{{ old('email') }}"
                            required
                        >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <div class="input-icon"><i class="fa-solid fa-building"></i></div>
                        <input
                            type="text"
                            name="company"
                            class="form-input"
                            placeholder="{{ old('company', 'Company') }}"
                            value="{{ old('company') }}"
                        >
                    </div>
                </div>

                <button type="button" class="submit-btn" onclick="submitForm()">
                    Join the waitlist
                </button>
            </form>
        </div>

        <!-- Footer text -->
        <div class="footer-text">
            <p>By joining the waitlist, you consent to be contacted regarding early access and product updates. Your information will be managed in accordance with our Privacy Policy.</p>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <div class="modal-icon">
                <i class="fa-solid fa-check"></i>
            </div>
            <h2 class="modal-title">You're on the waitlist.</h2>
            <p class="modal-message">Thank you for joining Carbon AI's early access program.<br><br>You'll receive a confirmation email shortly with more details about what's next.</p>
            <button class="modal-btn" onclick="closeModal()">Go Back to Homepage</button>
        </div>
    </div>

    <script>
        function submitForm() {
            // Get form data
            const form = document.querySelector('form');
            const formData = new FormData(form);

            // Show modal immediately
            showModal();

            // Submit form in background
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (response.ok) {
                    // Form submitted successfully, modal is already shown
                    console.log('Form submitted successfully');
                } else {
                    // Handle error if needed
                    console.error('Form submission failed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function showModal() {
            document.getElementById('successModal').style.display = 'flex';
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        function closeModal() {
            document.getElementById('successModal').style.display = 'none';
            document.body.style.overflow = 'auto'; // Restore scrolling
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('successModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>
</html>
