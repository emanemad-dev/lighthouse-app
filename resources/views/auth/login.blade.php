<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - MyApp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .login-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
        }

        .login-card h2 {
            text-align: center;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .form-control {
            border-radius: 8px;
            padding: 0.6rem;
        }

        .btn-primary {
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            border: none;
            border-radius: 8px;
            padding: 0.6rem;
            font-weight: 500;
        }

        .btn-primary:hover {
            opacity: 0.9;
        }

        .links {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
        }

        .links a {
            text-decoration: none;
            color: #2575fc;
            font-weight: 500;
        }

        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <h2>Welcome Back 👋</h2>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required
                    autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" class="form-control" type="password" name="password" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember" class="ms-1">Remember me</label>
                </div>
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="small text-decoration-none">Forgot password?</a>
                @endif
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>

            <div class="links">
                <p class="mt-3">Don't have an account? <a href="{{ route('register') }}">Sign Up</a></p>
            </div>
        </form>
    </div>

</body>

</html>
