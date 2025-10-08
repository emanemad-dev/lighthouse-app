<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Applications - MyApp</title>
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
            padding: 2rem;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 1.5rem;
        }

        .page-header h2 {
            font-weight: 600;
            margin: 0;
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            border: none;
        }

        .btn-back:hover {
            opacity: 0.9;
        }

        table {
            background-color: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        thead.table-primary {
            background: linear-gradient(90deg, #6a11cb, #2575fc) !important;
            color: #fff;
        }

        thead th {
            font-weight: 500;
        }

        tbody tr:hover {
            background-color: #f1f3f8;
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="page-header">
            <h2>My Submitted Applications</h2>
            <a href="{{ route('dashboard') }}" class="btn btn-back text-white">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Dashboard
            </a>
        </div>

        @if($applications->isEmpty())
        <div class="alert alert-info shadow-sm">You have not submitted any applications yet.</div>
        @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Country</th>
                        <th>Comments</th>
                        <th>Files</th>
                        <th>Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $app)
                    <tr>
                        <td>{{ $app->id }}</td>
                        <td>{{ $app->contact_email }}</td>
                        <td>{{ $app->contact_phone }}</td>
                        <td>{{ $app->date_of_birth->format('Y-m-d') }}</td>
                        <td>{{ ucfirst($app->gender) }}</td>
                        <td>{{ $app->country }}</td>
                        <td>{{ $app->comments }}</td>
                        <td>
                            @if($app->files)
                            @foreach($app->files as $file)
                            <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                class="d-block text-decoration-none text-primary">
                                <i class="fa-solid fa-file me-1"></i> View File
                            </a>
                            @endforeach
                            @else
                            <em>No files</em>
                            @endif
                        </td>
                        <td>{{ $app->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

</body>

</html>
