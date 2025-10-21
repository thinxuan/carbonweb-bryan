<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Create your free account</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .auth-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            padding: 3rem;
            width: 100%;
            max-width: 620px;
            margin: 2rem;
        }

        .logo {
            font-size: 2rem;
            font-weight: 700;
            color: #6366f1;
            margin-bottom: 2rem;
            text-align: center;
        }

        .auth-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            text-align: center;
            margin-bottom: 0.5rem;
        }

        .auth-subtitle {
            font-size: 1rem;
            color: #6b7280;
            text-align: center;
            margin-bottom: 2rem;
        }

        .social-btn {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: white;
            color: #374151;
            font-weight: 500;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            transition: all 0.2s ease;
            margin-bottom: 1rem;
        }

        .social-btn:hover {
            background: #f9fafb;
            border-color: #d1d5db;
            color: #374151;
            text-decoration: none;
        }

        .social-btn i {
            font-size: 1.25rem;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 2rem 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        .divider span {
            padding: 0 1rem;
            color: #6b7280;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-control {
            padding: 0.875rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        .btn-verify {
            background: #6366f1;
            border: none;
            color: white;
            padding: 0.875rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-verify:hover {
            background: #5856eb;
            color: white;
        }

        .btn-verify:disabled {
            background: #d1d5db;
            color: #9ca3af;
        }

        .privacy-text {
            font-size: 0.875rem;
            color: #6b7280;
            line-height: 1.5;
            margin-bottom: 1.5rem;
        }

        .privacy-text a {
            color: #6366f1;
            text-decoration: none;
        }

        .privacy-text a:hover {
            text-decoration: underline;
        }

        .login-link {
            text-align: center;
            font-size: 0.875rem;
            color: #6b7280;
        }

        .login-link a {
            color: #6366f1;
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .manage-cookies {
            position: absolute;
            bottom: 1rem;
            left: 1rem;
            font-size: 0.75rem;
            color: #6b7280;
            text-decoration: none;
        }

        .manage-cookies:hover {
            color: #374151;
            text-decoration: underline;
        }

        .alert {
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .google-icon {
            width: 20px;
            height: 20px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="%234285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="%2334A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="%23FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path fill="%23EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>') no-repeat center;
            background-size: contain;
        }

        .microsoft-icon {
            width: 20px;
            height: 20px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="%23F25022" d="M1 1h10v10H1z"/><path fill="%2300A4EF" d="M13 1h10v10H13z"/><path fill="%237FBA00" d="M1 13h10v10H1z"/><path fill="%23FFB900" d="M13 13h10v10H13z"/></svg>') no-repeat center;
            background-size: contain;
        }

        .apple-icon {
            width: 20px;
            height: 20px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%23000"><path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/></svg>') no-repeat center;
            background-size: contain;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="logo">CarbonWallet</div>

        <h1 class="auth-title">Create your free account</h1>
        <p class="auth-subtitle">100% free. No credit card needed.</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Social Login Buttons -->
        <a href="{{ route('auth.google') }}" class="social-btn">
            <i class="google-icon"></i>
            Continue with Google
        </a>

        <a href="{{ route('auth.microsoft') }}" class="social-btn">
            <i class="microsoft-icon"></i>
            Sign up with Microsoft
        </a>

        <!-- Divider -->
        <div class="divider">
            <span>OR</span>
        </div>

        <!-- Email Registration Form -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email address</label>
                <div class="input-group">
                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="name@company.com"
                           required
                           autocomplete="email">
                    <button type="submit" class="btn btn-verify" id="verifyBtn">
                        Verify email
                    </button>
                </div>
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </form>

        <p class="privacy-text">
            We may contact you with relevant content, products, and services. You can unsubscribe at any time.
            <a href="#" target="_blank">Learn more in our Privacy Policy</a>.
        </p>

        <div class="login-link">
            Have an account? <a href="{{ route('login') }}">Sign in</a>
        </div>
    </div>

    <a href="#" class="manage-cookies">Manage Cookies</a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Simple email validation and button state
        const emailInput = document.getElementById('email');
        const verifyBtn = document.getElementById('verifyBtn');

        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        emailInput.addEventListener('input', function() {
            const isValid = validateEmail(this.value);
            verifyBtn.disabled = !isValid;

            if (isValid) {
                verifyBtn.style.background = '#6366f1';
                verifyBtn.style.color = 'white';
            } else {
                verifyBtn.style.background = '#d1d5db';
                verifyBtn.style.color = '#9ca3af';
            }
        });

        // Initial state
        verifyBtn.disabled = true;
    </script>
</body>
</html>
