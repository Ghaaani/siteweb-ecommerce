<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin login</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f1f5f9; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; }
        form { background: #fff; padding: 2rem; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,.1); width: 100%; max-width: 360px; }
        h1 { margin: 0 0 1.5rem; font-size: 1.5rem; text-align: center; }
        input[type=email], input[type=password] { width: 100%; box-sizing: border-box; padding: .7rem; margin-bottom: 1rem; border: 1px solid #cbd5e1; border-radius: 8px; }
        button { width: 100%; padding: .8rem; background: #2563eb; color: #fff; border: 0; border-radius: 8px; font-weight: bold; cursor: pointer; }
        .error { color: #b91c1c; font-size: .9rem; margin-bottom: 1rem; }
        label.remember { display: block; font-size: .9rem; margin-bottom: 1rem; }
        a { display: block; text-align: center; margin-top: 1rem; font-size: .9rem; color: #475569; }
    </style>
</head>
<body>
    <form method="POST" action="{{ url('/login') }}">
        @csrf
        <h1>Admin login</h1>

        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus autocomplete="username">
        <input type="password" name="password" placeholder="Password" required autocomplete="current-password">
        <label class="remember"><input type="checkbox" name="remember" value="1"> Remember me</label>
        <button type="submit">Login</button>
        <a href="{{ url('/index') }}">Back to the shop</a>
    </form>
</body>
</html>
