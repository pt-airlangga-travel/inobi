<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Login - Admin INOBI')</title>

    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Manrope', -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
            background: #f0f2f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .auth-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            padding: 40px 35px;
            border: 1px solid #e8eaed;
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .auth-logo img {
            max-width: 70px;
            height: auto;
            margin-bottom: 12px;
        }

        .auth-logo h1 {
            font-size: 20px;
            font-weight: 800;
            color: #14171C;
            letter-spacing: -0.5px;
        }

        .auth-logo p {
            font-size: 13px;
            color: #777777;
            margin: 4px 0 0;
        }

        .form-label {
            font-size: 13px;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }

        .form-control {
            height: 48px;
            border-radius: 6px;
            border: 1px solid #dde0e4;
            font-size: 14px;
            font-weight: 500;
            font-family: 'Manrope', sans-serif;
            padding: 0 15px;
            transition: border-color 0.25s ease, box-shadow 0.25s ease;
        }

        .form-control:focus {
            border-color: #2A416A;
            box-shadow: 0 0 0 3px rgba(42, 65, 106, 0.12);
        }

        .input-group-text {
            background: #f7f8fa;
            border: 1px solid #dde0e4;
            border-right: none;
            color: #999;
            font-size: 14px;
        }

        .input-group .form-control {
            border-left: none;
        }

        .input-group .form-control:focus {
            border-left: none;
            box-shadow: none;
        }

        .input-group:focus-within {
            border-radius: 6px;
            box-shadow: 0 0 0 3px rgba(42, 65, 106, 0.12);
        }

        .input-group:focus-within .input-group-text {
            border-color: #2A416A;
        }

        .input-group:focus-within .form-control {
            border-color: #2A416A;
        }

        .btn-login {
            width: 100%;
            height: 50px;
            background: #2A416A;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 700;
            font-family: 'Manrope', sans-serif;
            transition: background 0.25s ease, transform 0.25s ease;
        }

        .btn-login:hover {
            background: #1f3152;
            color: #ffffff;
            transform: translateY(-1px);
        }

        .btn-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .form-check-label {
            font-size: 13px;
            color: #666;
            font-weight: 500;
        }

        .form-check-input:checked {
            background-color: #2A416A;
            border-color: #2A416A;
        }

        .auth-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #999;
        }

        .auth-footer a {
            color: #2A416A;
            font-weight: 700;
            text-decoration: none;
        }

        .auth-footer a:hover {
            color: #1f3152;
            text-decoration: underline;
        }

        .alert {
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .auth-card {
                padding: 30px 20px;
            }

            .auth-logo h1 {
                font-size: 18px;
            }

            .form-control {
                height: 44px;
                font-size: 13px;
            }

            .btn-login {
                height: 46px;
                font-size: 14px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    <div class="auth-container">
        <div class="auth-card">

            {{-- Logo --}}
            <div class="auth-logo">
                <img src="{{ asset('images/logo.png') }}" alt="INOBI Logo" onerror="this.src='https://via.placeholder.com/70x70/2A416A/FFFFFF?text=INOBI'">
                <h1>PT. INOBI</h1>
                <p>Administration Panel</p>
            </div>

            {{-- Content --}}
            @yield('content')

        </div>

        <div class="auth-footer">
            &copy; {{ date('Y') }} PT. Inovasi Bioproduk Indonesia. All rights reserved.
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>

