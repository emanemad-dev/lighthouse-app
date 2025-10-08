@component('mail::message')
# New application submitted

A new application has been submitted by **{{ $user->name }}**.

- Contact Email: {{ $app->contact_email }}
- Contact Phone: {{ $app->contact_phone }}
- Date of Birth: {{ $app->date_of_birth ?? 'N/A' }}
- Gender: {{ $app->gender ?? 'N/A' }}
- Country: {{ $app->country ?? 'N/A' }}

Comments:
{{ $app->comments ?? 'N/A' }}

The submitted files and a PDF copy are attached.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
BLADE

# PDF view
cat > resources/views/pdfs/application.blade.php <<'BLADE' <!doctype html>
    <html>

    <head>
        <meta charset="utf-8">
        <title>Application #{{ $app->id }}</title>
        <style>
            body {
                font-family: DejaVu Sans, sans-serif;
            }

            .header {
                text-align: center;
                margin-bottom: 20px
            }

            .field {
                margin-bottom: 8px
            }
        </style>
    </head>

    <body>
        <div class="header">
            <h2>New Application — #{{ $app->id }}</h2>
        </div>

        <div class="field"><strong>Name:</strong> {{ $user->name }}</div>
        <div class="field"><strong>Contact Email:</strong> {{ $app->contact_email }}</div>
        <div class="field"><strong>Contact Phone:</strong> {{ $app->contact_phone }}</div>
        <div class="field"><strong>Date of Birth:</strong> {{ optional($app->date_of_birth)->format('Y-m-d') }}</div>
        <div class="field"><strong>Gender:</strong> {{ $app->gender }}</div>
        <div class="field"><strong>Country:</strong> {{ $app->country }}</div>
        <div class="field"><strong>Comments:</strong> {!! nl2br(e($app->comments)) !!}</div>
    </body>

    </html>
    BLADE

    # Apply page (Blade + AJAX). يفترض layout من Breeze موجود.
    cat > resources/views/apply.blade.php <<'BLADE' @extends('layouts.app') @section('content') <div class="container">
        <h2>Submit Application</h2>
        <form id="appForm" enctype="multipart/form-data">
            @csrf
            <div><label>Email</label><input name="contact_email" type="email" required></div>
            <div><label>Phone</label><input name="contact_phone" type="text" required placeholder="+201234567890"></div>
            <div><label>DOB</label><input name="date_of_birth" type="date"></div>
            <div><label>Gender</label>
                <select name="gender">
                    <option value="">--</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div><label>Country</label><input name="country" type="text"></div>
            <div><label>Files</label><input name="files[]" type="file" multiple></div>
            <div><label>Comments</label><textarea name="comments"></textarea></div>
            <button type="submit">Send</button>
        </form>

        <div id="result" style="margin-top:12px"></div>
        </div>

        <script>
            document.getElementById('appForm').addEventListener('submit', async function(e){
    e.preventDefault();
    const form = e.target;
    const fd = new FormData(form);
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    try {
        const res = await fetch("{{ route('applications.store') }}", {
            method: 'POST',
            headers: {'X-CSRF-TOKEN': token},
            body: fd
        });
        const data = await res.json();
        if (res.ok) {
            document.getElementById('result').innerText = data.message;
            form.reset();
        } else {
            const err = data.errors ?? data;
            document.getElementById('result').innerText = JSON.stringify(err);
        }
    } catch (err) {
        document.getElementById('result').innerText = err.message;
    }
});
        </script>
        @endsection
