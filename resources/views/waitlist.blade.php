<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarbonWallet Waitlist</title>

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
            max-width: 800px;
            width: 100%;
            text-align: center;
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
            font-size: 32px;
            font-weight: 300;
            color: #e0e0e0;
            margin-bottom: 8px;
            line-height: 1.2;
        }

        .accent-text {
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(51deg, #e4e0e0 0%, #16d3ca 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 48px;
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
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
            background: rgba(30, 30, 30, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: #ffffff;
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
            background: rgba(30, 30, 30, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: #ffffff;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            backdrop-filter: blur(10px);
            font-family: Montserrat;
        }

        .submit-btn:hover {
            background: rgba(50, 50, 50, 0.9);
            border-color: #fff;
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
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: .75rem;
            color: #888;
            line-height: 1.6;
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
        }

        .modal-content {
            background: rgba(20, 20, 20, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            margin: 15% auto;
            padding: 40px;
            width: 90%;
            max-width: 400px;
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
            background: linear-gradient(324deg, #16d3ca, #f3f6f6);
            border-radius: 50%;
            margin: 0 auto 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: white;
        }

        .modal-title {
            font-size: 24px;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 16px;
        }

        .modal-message {
            font-size: .9rem;
            color: #a0a0a0;
            line-height: 1.5;
            margin-bottom: 32px;
        }

        .modal-btn {
            background: #16d3ca;
            border: none;
            border-radius: 12px;
            color: white;
            padding: 12px 32px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: Montserrat;
        }

        .modal-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(22, 211, 202, 0.3);
        }

        .success-message {
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
    </style>
</head>
<body>
    <div class="container">
        <div class="waitlist-form">
            <!-- Main title -->
            <h1 class="main-title">Join the waitlist for the</h1>
            <h1 class="accent-text">CarbonAI Tracking Platform</h1>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="error-message">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Waitlist Form -->
            <form method="POST" action="{{ route('waitlist.store') }}">
                @csrf

                <div class="form-group">
                    <div class="input-wrapper">
                        <div class="input-icon"><i class="fa-solid fa-user"></i></div>
                        <input
                            type="text"
                            name="name"
                            class="form-input"
                            placeholder="{{ old('name', 'Full Name...') }}"
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
                            placeholder="{{ old('email', 'Email Address...') }}"
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
                            placeholder="{{ old('company', 'Your Company...') }}"
                            value="{{ old('company') }}"
                        >
                    </div>
                </div>

                <button type="submit" class="submit-btn">
                    Join the waitlist
                    <span class="arrow-icon">→</span>
                </button>
            </form>
        </div>

        <!-- Footer text -->
        <div class="footer-text">
            <p>CarbonWallet is coming soon.</p>
            <p>Designed to help you track and reduce your carbon footprint.</p>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <div class="modal-icon">
                <i class="fa-solid fa-check"></i>
            </div>
            <h2 class="modal-title">We've added you to the waitlist!</h2>
            <p class="modal-message">You'll be the first to know when we launch!</p>
            <button class="modal-btn" onclick="closeModal()">Got it!</button>
        </div>
    </div>

    <script>
        // Show modal on successful form submission
        @if(session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                showModal();
            });
        @endif

        function showModal() {
            document.getElementById('successModal').style.display = 'block';
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
