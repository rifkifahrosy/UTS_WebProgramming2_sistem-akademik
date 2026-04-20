<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login — Sistem Akademik">
    <title>Login — Sistem Akademik</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            display: flex;
            background: #0f0c29;
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #0ea5e9 100%);
            position: relative;
            overflow: hidden;
        }

        /* Animated background blobs */
        body::before {
            content: '';
            position: fixed;
            top: -30%; left: -20%;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(79,70,229,0.35) 0%, transparent 70%);
            border-radius: 50%;
            animation: blob1 8s ease-in-out infinite;
        }
        body::after {
            content: '';
            position: fixed;
            bottom: -20%; right: -10%;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(14,165,233,0.3) 0%, transparent 70%);
            border-radius: 50%;
            animation: blob2 10s ease-in-out infinite;
        }

        @keyframes blob1 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, 40px) scale(1.05); }
        }
        @keyframes blob2 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-40px, -30px) scale(1.08); }
        }

        .login-wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.07);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 20px;
            padding: 44px 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.5s ease forwards;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .login-logo {
            width: 56px; height: 56px;
            background: linear-gradient(135deg, #4f46e5, #0ea5e9);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem;
            color: #fff;
            margin: 0 auto 20px;
            box-shadow: 0 8px 20px rgba(79,70,229,0.4);
        }

        .login-title {
            text-align: center;
            color: #fff;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .login-subtitle {
            text-align: center;
            color: rgba(255,255,255,0.55);
            font-size: 0.82rem;
            margin-bottom: 32px;
        }

        .form-label {
            color: rgba(255,255,255,0.8);
            font-size: 0.82rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .input-group-text {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            border-right: none;
            color: rgba(255,255,255,0.6);
            font-size: 0.9rem;
        }

        .form-control {
            background: rgba(255,255,255,0.08) !important;
            border: 1px solid rgba(255,255,255,0.15) !important;
            border-left: none !important;
            color: #fff !important;
            padding: 11px 14px;
            font-size: 0.875rem;
            border-radius: 0 8px 8px 0;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control::placeholder { color: rgba(255,255,255,0.3); }

        .form-control:focus {
            border-color: rgba(79,70,229,0.7) !important;
            box-shadow: 0 0 0 3px rgba(79,70,229,0.2) !important;
            background: rgba(255,255,255,0.12) !important;
        }

        .input-group { border-radius: 8px; }

        .btn-login {
            background: linear-gradient(135deg, #4f46e5, #0ea5e9);
            border: none;
            color: #fff;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 12px;
            border-radius: 10px;
            width: 100%;
            transition: opacity 0.2s, transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 15px rgba(79,70,229,0.4);
        }

        .btn-login:hover {
            opacity: 0.92;
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(79,70,229,0.5);
            color: #fff;
        }

        .btn-login:active { transform: translateY(0); }

        .alert-custom {
            background: rgba(239,68,68,0.15);
            border: 1px solid rgba(239,68,68,0.3);
            color: #fca5a5;
            border-radius: 10px;
            font-size: 0.82rem;
            padding: 11px 14px;
        }

        .form-check-input {
            background-color: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.3);
        }

        .form-check-label { color: rgba(255,255,255,0.65); font-size: 0.82rem; }

        .login-hint {
            text-align: center;
            margin-top: 24px;
            padding: 14px;
            background: rgba(255,255,255,0.05);
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.08);
        }

        .login-hint p { margin: 0; font-size: 0.78rem; color: rgba(255,255,255,0.45); }
        .login-hint strong { color: rgba(255,255,255,0.75); }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="login-box">
        <div class="login-logo"><i class="bi bi-mortarboard-fill"></i></div>
        <h1 class="login-title">Sistem Akademik</h1>
        <p class="login-subtitle">Masuk untuk mengakses dashboard</p>

        @if($errors->any())
            <div class="alert-custom mb-4">
                <i class="bi bi-exclamation-circle me-1"></i>
                {{ $errors->first() }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success mb-4" style="background:rgba(16,185,129,0.15); border:1px solid rgba(16,185,129,0.3); color:#6ee7b7; border-radius:10px; font-size:0.82rem; padding:11px 14px;">
                <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
            </div>
        @endif

        <form id="loginForm" action="{{ route('login.post') }}" method="POST" novalidate>
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" id="email" name="email" class="form-control"
                           placeholder="contoh@email.com" value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" id="password" name="password" class="form-control"
                           placeholder="••••••••" required>
                </div>
            </div>

            <div class="mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Ingat saya</label>
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
            </button>
        </form>

        {{-- <div class="login-hint">
            <p>Demo: <strong>admin@akademik.com</strong> / <strong>password123</strong></p>
        </div> --}}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
