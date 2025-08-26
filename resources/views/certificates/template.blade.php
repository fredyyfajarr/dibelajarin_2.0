<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sertifikat Kelulusan</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            text-align: center;
            color: #333;
        }

        .container {
            border: 20px solid #3b82f6;
            width: 90%;
            height: 90%;
            margin: 2% auto;
            padding: 40px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #3b82f6;
        }

        h1 {
            font-size: 48px;
            margin-bottom: 20px;
            color: #111827;
        }

        .subtitle {
            font-size: 24px;
            margin-bottom: 40px;
        }

        .student-name {
            font-size: 36px;
            font-weight: bold;
            color: #1e40af;
            border-bottom: 2px solid #333;
            display: inline-block;
            padding-bottom: 5px;
            margin-bottom: 40px;
        }

        .course-title {
            font-size: 28px;
            font-style: italic;
            margin-bottom: 60px;
        }

        .footer {
            position: absolute;
            bottom: 80px;
            width: 100%;
            left: 0;
        }

        .date,
        .signature {
            display: inline-block;
            width: 40%;
        }

        .line {
            border-bottom: 1px solid #333;
            width: 80%;
            margin: 5px auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">LMS KITA</div>
        <h1 class="subtitle">Sertifikat Kelulusan</h1>
        <p>Dengan ini menyatakan bahwa:</p>
        <p class="student-name">{{ $studentName }}</p>
        <p>telah berhasil menyelesaikan kursus</p>
        <p class="course-title">"{{ $courseTitle }}"</p>
        <div class="footer">
            <div class="date">
                <p>{{ $completionDate }}</p>
                <div class="line"></div>
                <p>Tanggal</p>
            </div>
            <div class="signature">
                <p>&nbsp;</p> {{-- Placeholder for signature image --}}
                <div class="line"></div>
                <p>Instruktur</p>
            </div>
        </div>
    </div>
</body>

</html>
