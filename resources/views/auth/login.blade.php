<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in · {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('client/img/logo/logo.png') }}">
    <style>
        :root {
            --ecom-bg: #faf8f4;
            --ecom-surface: #ffffff;
            --ecom-ink: #1b1a17;
            --ecom-muted: #6e675c;
            --ecom-line: #e9e2d6;
            --ecom-primary: #2f5d50;
            --ecom-accent: #c08552;
            --ecom-danger: #b3372f;
            --ecom-radius: 14px;
            --ecom-radius-sm: 10px;
            --ecom-shadow-md: 0 14px 34px rgba(27, 26, 23, 0.12);
            --ecom-font: "Inter", "Segoe UI", "Helvetica Neue", Arial, sans-serif;
        }

        * { box-sizing: border-box; }

        body {
            font-family: var(--ecom-font);
            background: var(--ecom-bg);
            color: var(--ecom-ink);
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 20px;
            background-image:
                radial-gradient(circle at 15% 20%, rgba(47, 93, 80, 0.10), transparent 45%),
                radial-gradient(circle at 85% 80%, rgba(192, 133, 82, 0.14), transparent 45%);
        }

        .auth-card {
            background: var(--ecom-surface);
            border: 1px solid var(--ecom-line);
            border-radius: 20px;
            box-shadow: var(--ecom-shadow-md);
            width: 100%;
            max-width: 420px;
            padding: 40px 36px 32px;
            animation: rise 0.6s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        @keyframes rise {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            justify-content: center;
            margin-bottom: 8px;
        }

        .brand img { width: 42px; height: 42px; object-fit: contain; }

        .brand-name {
            font-size: 19px;
            font-weight: 700;
            letter-spacing: -0.01em;
        }

        h1 {
            font-size: 24px;
            text-align: center;
            margin: 18px 0 6px;
        }

        .subtitle {
            text-align: center;
            color: var(--ecom-muted);
            font-size: 14.5px;
            margin: 0 0 26px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 7px;
            color: var(--ecom-ink);
        }

        input[type=text], input[type=email], input[type=password] {
            width: 100%;
            font-family: var(--ecom-font);
            font-size: 15px;
            padding: 12px 14px;
            margin-bottom: 18px;
            border: 1.5px solid var(--ecom-line);
            border-radius: var(--ecom-radius-sm);
            background: #fff;
            color: var(--ecom-ink);
            transition: border-color 0.25s ease, box-shadow 0.25s ease;
        }

        input:focus {
            outline: none;
            border-color: var(--ecom-primary);
            box-shadow: 0 0 0 4px rgba(47, 93, 80, 0.14);
        }

        .error {
            background: rgba(179, 55, 47, 0.08);
            border: 1px solid rgba(179, 55, 47, 0.25);
            color: var(--ecom-danger);
            font-size: 13.5px;
            padding: 11px 14px;
            border-radius: 8px;
            margin-bottom: 18px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13.5px;
            color: var(--ecom-muted);
            margin: -6px 0 20px;
        }

        .remember input { width: 16px; height: 16px; accent-color: var(--ecom-primary); }

        button {
            width: 100%;
            font-family: var(--ecom-font);
            font-size: 15px;
            font-weight: 600;
            padding: 14px;
            border: none;
            border-radius: 999px;
            background: var(--ecom-ink);
            color: #fff;
            cursor: pointer;
            transition: transform 0.25s cubic-bezier(0.22, 1, 0.36, 1), background-color 0.25s ease, box-shadow 0.25s ease;
        }

        button:hover { background: var(--ecom-primary); transform: translateY(-2px); box-shadow: var(--ecom-shadow-md); }
        button:active { transform: translateY(0) scale(0.98); }

        .links {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            font-size: 13.5px;
        }

        .links a { color: var(--ecom-primary); text-decoration: none; font-weight: 500; }
        .links a:hover { text-decoration: underline; }
        .links .muted { color: var(--ecom-muted); }

        .hint {
            margin-top: 22px;
            padding: 12px 14px;
            background: rgba(47, 93, 80, 0.06);
            border-radius: var(--ecom-radius-sm);
            font-size: 12.5px;
            color: var(--ecom-muted);
            text-align: center;
        }
    </style>
</head>
<body>
    <main class="auth-card">
        <div class="brand">
            <img src="{{ asset('client/img/logo/logo.png') }}" alt="{{ config('app.name') }}">
            <span class="brand-name">{{ config('app.name') }}</span>
        </div>

        <h1>Welcome back</h1>
        <p class="subtitle">Sign in to your account or to the admin area.</p>

        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <form method="POST" action="{{ url('/login') }}">
            @csrf

            <label for="email">Email address</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required autocomplete="current-password">

            <label class="remember">
                <input type="checkbox" name="remember" value="1"> Remember me
            </label>

            <button type="submit">Sign in</button>
        </form>

        <div class="links">
            <a href="{{ url('/register') }}">Create an account</a>
            <a class="muted" href="{{ url('/index') }}">Back to the shop</a>
        </div>

        <p class="hint">Administrators are taken straight to the product manager after signing in.</p>
    </main>
</body>
</html>
