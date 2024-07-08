<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Achievement</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .certificate-container {
            position: relative;
            width: 1122px;
            height: 794px;
            background: url('{{ asset('assets/img/certificate.jpg') }}') no-repeat center center;
            background-size: cover;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .certificate-text {
            position: absolute;
            width: 100%;
            text-align: center;
            color: #000;
        }

        .certificate-title {
            top: 150px;
            font-size: 36px;
            font-weight: bold;
        }

        .certificate-subtitle {
            top: 220px;
            font-size: 24px;
        }

        .certificate-name {
            top: 350px;
            font-size: 28px;
            font-weight: bold;
        }

        .certificate-body {
            top: 310px;
            font-size: 20px;
            line-height: 1.6;
            padding: 0 100px;
        }

        .certificate-signature {
            position: absolute;
            bottom: 220px;
            left: 315px;
            font-size: 18px;
            text-align: left;
        }

        .certificate-date {
            position: absolute;
            bottom: 220px;
            right: 320px;
            font-size: 18px;
            text-align: right;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
</head>
<body>
    <div class="certificate-container" id="certificate">
        <div class="certificate-text certificate-name">
            {{ $user->firstname }} {{ $user->lastname }}
        </div>
        <div class="certificate-date">
            {{ now()->format('F d, Y') }}
        </div>
    </div>

    <script>
        function downloadPDF() {
            var element = document.querySelector('.certificate-container');
            var opt = {
                margin: [0, 0, 0, 0], // Set all margins to 0 to remove white space
                filename: '{{ $user->firstname }}_certificate.pdf',
                image: { type: 'jpeg', quality: 1.0 }, // Increase quality
                html2canvas: { scale: 3 }, // Increase scale for higher resolution
                jsPDF: { unit: 'px', format: [1122, 794], orientation: 'landscape' }
            };
            html2pdf().from(element).set(opt).save();
        }

        window.onload = downloadPDF;
    </script>
</body>
</html>
