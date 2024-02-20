<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .certificate-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .certificate-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .certificate-header h1 {
            font-size: 32px;
            color: #333;
        }

        .certificate-details {
            margin-bottom: 20px;
        }

        .certificate-details p {
            font-size: 18px;
            color: #555;
            margin: 5px 0;
        }

        .certificate-signature {
            margin-top: 20px;
            text-align: center;
        }

        .certificate-signature p {
            font-size: 18px;
            color: #555;
            margin: 5px 0;
        }

        .signature-img {
            width: 200px;
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <div class="certificate-header">
            <h1>Certificate of Completion</h1>
        </div>
        <div class="certificate-details">
            <p>This is to certify that <strong>{{ $user->firstname }} {{ $user->lastname }}</strong> has successfully completed the course:</p>
            <p><strong>{{ $course->title }}</strong></p>
            <p>Date of completion: {{ now()->format('Y-m-d') }}</p>
        </div>
        {{-- <div class="certificate-signature">
            <p>Signature:</p>
            <img src="{{ asset('path/to/signature.png') }}" alt="Signature" class="signature-img">
            <p>John Doe<br>Course Instructor</p>
        </div> --}}
    </div>
</body>
</html>
