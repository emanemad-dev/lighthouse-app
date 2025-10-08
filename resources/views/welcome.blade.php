<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome - MyApp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
        }

        nav .logo {
            font-size: 1.5rem;
            font-weight: 600;
            letter-spacing: 1px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin-left: 1rem;
            font-weight: 500;
            transition: opacity 0.3s, transform 0.3s;
        }

        nav a:hover {
            opacity: 0.8;
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 0 1rem;
            animation: fadeInUp 1s ease;
        }

        .hero h1 {
            font-size: 2.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            max-width: 600px;
            opacity: 0.9;
        }

        .hero .btn {
            padding: 0.75rem 1.6rem;
            border-radius: 50px;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .hero .btn-light {
            color: #2575fc;
            background: #fff;
        }

        .hero .btn-light:hover {
            background: #e6e6e6;
        }

        .hero .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.05);
            font-size: 0.9rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
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

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav>
        <div class="logo">MyApp</div>
        <div>
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Sign Up</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Welcome to MyApp 👋</h1>
        <p>
            A modern Laravel application where you can register, log in, and submit your application easily.
        </p>
        <div>
            <a href="{{ route('register') }}" class="btn btn-light">Get Started</a>
            <a href="{{ route('login') }}" class="btn btn-outline-light">Log In</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        &copy; {{ date('Y') }} MyApp. All rights reserved.
    </footer>

</body>

</html>
