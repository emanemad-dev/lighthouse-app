<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>New Application Submitted</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f9fafb;
            color: #1a202c;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 600px;
            background-color: #fff;
            margin: 0 auto;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }

        .header {
            background-color: #2563eb;
            color: #fff;
            padding: 20px;
            border-radius: 12px 12px 0 0;
            text-align: center;
        }

        .header h2 {
            margin: 0;
            font-size: 22px;
            font-weight: 600;
        }

        .content {
            padding: 20px 30px;
        }

        .content p {
            margin: 8px 0;
            font-size: 15px;
            line-height: 1.6;
        }

        .content strong {
            color: #2d3748;
        }

        .footer {
            text-align: center;
            padding-top: 20px;
            font-size: 13px;
            color: #718096;
            border-top: 1px solid #e2e8f0;
        }

        .highlight {
            color: #2563eb;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>New Application Submitted</h2>
        </div>

        <div class="content">
            <p><strong>User:</strong> <span class="highlight">{{ $user->name }}</span></p>
            <p><strong>Email:</strong> {{ $data['contact_email'] }}</p>
            <p><strong>Phone:</strong> {{ $data['contact_phone'] }}</p>
            <p><strong>Date of Birth:</strong> {{ $data['date_of_birth'] }}</p>
            <p><strong>Gender:</strong> {{ ucfirst($data['gender']) }}</p>
            <p><strong>Country:</strong> {{ $data['country'] }}</p>
            <p><strong>Comments:</strong> {{ $data['comments'] ?? 'N/A' }}</p>

            <p style="margin-top: 20px;">
                Please find attached files and a PDF summary for your reference.
            </p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} The Lighthouse Centre. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
