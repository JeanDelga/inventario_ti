<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Etiqueta - {{ $device->code }}</title>
    <style>
        @page {
            margin: 10mm;
        }
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }
        .etiqueta {
            border: 1px solid #000;
            width: 90mm;
            height: 40mm;
            padding: 5mm;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-sizing: border-box;
        }
        .logo {
            width: 30mm;
        }
        .codigo {
            writing-mode: vertical-rl;
            transform: rotate(0deg);
            font-weight: bold;
            font-size: 12pt;
        }
    </style>
</head>
<body>
    <div class="etiqueta">
        <img src="{{ public_path('images/logo_brval.png') }}" alt="Logo" class="logo">
        <img src="{{ $qrcode }}" alt="QR Code" style="width: 80px;">
        <div class="codigo">{{ $device->code }}</div>
    </div>
</body>
</html>
