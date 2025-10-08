<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - MyApp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #eef1f6;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            padding: 1.5rem 1rem;
        }

        .sidebar h3 {
            text-align: center;
            margin-bottom: 2rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 0.65rem 1rem;
            border-radius: 8px;
            margin-bottom: 0.6rem;
            transition: background 0.3s, transform 0.2s;
        }

        .sidebar a i {
            margin-right: 10px;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255, 255, 255, 0.18);
            transform: translateX(5px);
        }

        .logout-link {
            margin-top: auto;
        }

        /* Content */
        .content {
            margin-left: 250px;
            padding: 2rem;
            flex: 1;
        }

        .content h1 {
            font-weight: 600;
            margin-bottom: 1.5rem;
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            cursor: pointer;
            background: #fff;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }

        .card i {
            font-size: 2rem;
            margin-bottom: 0.75rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                flex-direction: row;
                justify-content: space-around;
            }

            .content {
                margin-left: 0;
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h3>MyApp</h3>
        <a href="{{ route('dashboard') }}" class="active"><i class="fa-solid fa-gauge"></i> Dashboard</a>
        <a href="#"><i class="fa-solid fa-user"></i> Profile</a>
        {{-- <a href="#"><i class="fa-solid fa-chart-line"></i> Statistics</a> --}}
        <a href="{{ route('application.create') }}"><i class="fa-solid fa-envelope"></i> Application</a>
        <a href="{{ route('applications.index') }}"><i class="fa-solid fa-folder-open"></i> My Applications</a>
        <a href="{{ route('logout') }}" class="logout-link"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

    <!-- Content -->
    <div class="content">
        <h1>Welcome, {{ Auth::user()->name }} 👋</h1>

        <div class="row g-4">
            <div class="col-md-4">
                <a href="{{ route('application.create') }}" class="text-decoration-none text-dark">
                    <div class="card p-4 text-center">
                        <i class="fa-solid fa-envelope text-primary"></i>
                        <h5>Application Form</h5>
                        <p class="text-muted mb-0">Click to fill and submit your application.</p>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('applications.index') }}" class="text-decoration-none text-dark">
                    <div class="card p-4 text-center">
                        <i class="fa-solid fa-folder-open text-info"></i>
                        <h5>My Applications</h5>
                        <p class="text-muted mb-0">View your submitted applications.</p>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <div class="card p-4 text-center">
                    <i class="fa-solid fa-user text-success"></i>
                    <h5>Profile</h5>
                    <p class="text-muted mb-0">Update your personal details.</p>
                </div>
            </div>

            {{-- <div class="col-md-4">
                <div class="card p-4 text-center">
                    <i class="fa-solid fa-chart-line text-warning"></i>
                    <h5>Statistics</h5>
                    <p class="text-muted mb-0">Track your activity and progress.</p>
                </div>
            </div> --}}
        </div>
    </div>

</body>

</html>
