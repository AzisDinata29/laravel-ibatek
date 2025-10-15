<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }

        html,
        body {
            margin: 0;
            padding: 0;
        }

        .page {
            position: relative;
            width: 297mm;
            height: 210mm;
            overflow: hidden;
        }

        .bg {
            position: absolute;
            inset: 0;
        }

        .bg img {
            width: 100%;
            height: 100%;
        }

        .name {
            position: absolute;
            left: 50%;
            top: 48%;
            transform: translate(-50%, -50%);
            font-family: "DejaVu Sans", sans-serif;
            font-weight: 700;
            font-size: {{ $fontSize }}pt;
            color: #111111;
            text-align: center;
            white-space: nowrap;
            letter-spacing: 0.5pt;
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="bg">
            <img src="{{ $bgBase64 }}" />
        </div>
        <div class="name">{{ $name }}</div>
    </div>
</body>

</html>
