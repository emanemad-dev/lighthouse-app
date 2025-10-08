<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Application Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 1rem;
        }

        .app-card {
            position: relative;
            background: #fff;
            padding: 2rem;
            border-radius: 15px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: #f8f9fa;
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: 0.2s;
        }

        .close-btn:hover {
            background: #dc3545;
            color: #fff;
        }

        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .spinner-border {
            width: 1.3rem;
            height: 1.3rem;
        }

        .preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 0.5rem;
        }

        .preview-item {
            position: relative;
            width: 80px;
            height: 80px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .remove-btn {
            position: absolute;
            top: 2px;
            right: 2px;
            background: rgba(255, 255, 255, 0.7);
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .error-msg {
            color: red;
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }
    </style>
</head>

<body>

    <div class="app-card">
        <button class="close-btn" onclick="window.location.href='{{ route('dashboard') }}'">
            <i class="fa-solid fa-xmark fa-lg"></i>
        </button>

        <h2>Submit Your Application</h2>

        <form id="applicationForm" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="contact_email" class="form-control" required>
                <div class="error-msg" id="emailError"></div>
            </div>

            <div class="mb-3">
                <label>Phone (International)</label>
                <input type="text" name="contact_phone" class="form-control" required>
                <div class="error-msg" id="phoneError"></div>
            </div>

            <div class="mb-3">
                <label>Date of Birth</label>
                <input type="date" name="date_of_birth" class="form-control" required>
                <div class="error-msg" id="dobError"></div>
            </div>

            <div class="mb-3">
                <label>Gender</label>
                <select name="gender" class="form-select" required>
                    <option value="">-- Select --</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <div class="error-msg" id="genderError"></div>
            </div>

            <div class="mb-3">
                <label>Country</label>
                <input type="text" name="country" class="form-control" required>
                <div class="error-msg" id="countryError"></div>
            </div>

            <div class="mb-3">
                <label>Files (Images / PDFs)</label>
                <input type="file" id="filesInput" class="form-control" multiple accept=".jpg,.jpeg,.png,.pdf">
                <div class="preview-container" id="previewContainer"></div>
                <div class="error-msg" id="filesError"></div>
            </div>

            <div class="mb-3">
                <label>Comments</label>
                <textarea name="comments" class="form-control" rows="3"></textarea>
            </div>

            <button type="submit" id="submitBtn" class="btn btn-primary w-100">
                <span class="btn-text">Submit Application</span>
                <span class="spinner-border spinner-border-sm d-none" role="status"></span>
            </button>
        </form>

        <div id="responseMsg" class="alert mt-3 d-none"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        let selectedFiles = [];

        function updatePreview() {
            let container = $('#previewContainer');
            container.html('');
            selectedFiles.forEach((file, index) => {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let previewItem = $(`
                        <div class="preview-item">
                            ${file.type.startsWith('image/') ? `<img src='${e.target.result}' />` : `<i class='fa-solid fa-file fa-2x'></i>`}
                            <button type='button' class='remove-btn' data-index='${index}'>&times;</button>
                        </div>
                    `);
                    container.append(previewItem);
                }
                reader.readAsDataURL(file);
            });
        }

        $('#filesInput').on('change', function(e){
            selectedFiles = selectedFiles.concat(Array.from(e.target.files));
            updatePreview();
            $(this).val('');
        });

        $(document).on('click', '.remove-btn', function(){
            let idx = $(this).data('index');
            selectedFiles.splice(idx, 1);
            updatePreview();
        });

        $('#applicationForm').on('submit', function(e) {
            e.preventDefault();
            $('.error-msg').text('');

            let formData = new FormData(this);
            selectedFiles.forEach(file => formData.append('files[]', file));
            formData.append('_token', '{{ csrf_token() }}');

            let btn = $('#submitBtn');
            let spinner = btn.find('.spinner-border');
            let btnText = btn.find('.btn-text');
            let responseBox = $('#responseMsg');

            btn.prop('disabled', true);
            spinner.removeClass('d-none');
            btnText.text('Submitting...');

            $.ajax({
                url: "{{ route('application.store') }}",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if(response.success){
                        responseBox.removeClass('d-none alert-danger')
                            .addClass('alert-success')
                            .text(response.message);
                        setTimeout(()=> window.location.href = response.redirect, 1500);
                    } else {
                        responseBox.removeClass('d-none alert-success')
                            .addClass('alert-danger')
                            .text('Something went wrong. Please try again.');
                    }
                },
                error: function(xhr){
                    if(xhr.status === 422){
                        let errors = xhr.responseJSON.errors;
                        for(const key in errors){
                            $(`#${key}Error`).text(errors[key][0]);
                        }
                    } else {
                        responseBox.removeClass('d-none alert-success')
                            .addClass('alert-danger')
                            .text('Something went wrong. Please try again.');
                    }
                },
                complete: function(){
                    btn.prop('disabled', false);
                    spinner.addClass('d-none');
                    btnText.text('Submit Application');
                }
            });
        });
    </script>

</body>

</html>
