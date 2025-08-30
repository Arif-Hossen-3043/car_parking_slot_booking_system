<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Car Parking System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #00b4db, #0083b0);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .login-container {
            background: #fff;
            padding: 40px 50px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .login-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .login-container input[type="email"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
            outline: none;
            font-size: 16px;
        }

        .login-container input[type="checkbox"] {
            margin-right: 10px;
        }

        .login-container .btn {
            width: 100%;
            padding: 12px;
            background: #00b4db;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-container .btn:hover {
            background: #0083b0;
        }

        .login-container .forgot-password,
        .login-container .register-link {
            display: block;
            text-align: right;
            margin-bottom: 20px;
            color: #0083b0;
            text-decoration: none;
            font-size: 14px;
        }

        .login-container .forgot-password:hover,
        .login-container .register-link:hover {
            text-decoration: underline;
        }

        .error {
            color: #dc3545;
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login - Car Parking System</h2>

    <!-- Session Status -->
    @if (session('status'))
        <div class="error">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <!-- Password -->
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror

        <!-- Remember Me -->
        <div>
            <label>
                <input type="checkbox" name="remember"> Remember me
            </label>
        </div>

        <!-- Forgot password -->
        @if (Route::has('password.request'))
            <a class="forgot-password" href="{{ route('password.request') }}">
                Forgot your password?
            </a>
        @endif

        <button type="submit" class="btn">Log in</button>
    </form>

    <!-- Register link -->
    <a class="register-link" href="{{ route('register') }}">Don't have an account? Register here</a>
</div>

</body>
</html>
