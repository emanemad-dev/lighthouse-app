<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Account - MyApp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .auth-card {
            background: #fff;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 420px;
            animation: fadeInUp 0.7s ease;
        }

        .auth-card h2 {
            text-align: center;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .auth-card p.sub-text {
            text-align: center;
            color: #666;
            margin-bottom: 1.8rem;
            font-size: 0.95rem;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.3rem;
        }

        .form-control {
            padding: 0.6rem 0.75rem;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #6a11cb;
            box-shadow: 0 0 0 0.15rem rgba(106, 17, 203, 0.25);
        }

        .btn-primary {
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            border: none;
            border-radius: 10px;
            padding: 0.6rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }

        .auth-footer {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.95rem;
        }

        .auth-footer a {
            text-decoration: none;
            color: #2575fc;
            font-weight: 500;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 400px) {
            .auth-card {
                padding: 1.8rem;
            }
        }
    </style>
</head>

<body>

    <div class="auth-card">
        <h2>Create Account</h2>
        <p class="sub-text">Join us and start your journey today 🚀</p>

       <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            @error('name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
            @error('email')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control">
            @error('password')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary w-100 mt-2">Sign Up</button>
    </form>

        <div class="auth-footer">
            <p>Already have an account? <a href="{{ route('login') }}">Log in</a></p>
        </div>
    </div>

</body>

</html>
