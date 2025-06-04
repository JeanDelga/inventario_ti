<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Etiqueta - {{ $device->code }}</title>
    <style>
        @page {
            margin: 0;
        }

        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }


        .etiqueta {
            width: 30mm;
            height: 43mm;
            border: 1px solid #000;
            padding: 4mm;
            margin: 20mm auto;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: start;
            align-items: center;
            text-align: center;
        }

        .logo-container,
        .qr-container,
        .codigo-container {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
        }

        .logo {
            width: 100px;
        }

        .qrcode {
            width: 100px;
            height: 100px;
        }

        .codigo {
            font-size: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="etiqueta">
        <div class="logo-container">
            <img src="{{ public_path('images/logo_brval.png') }}" class="logo" alt="Logo">
        </div>
        <div class="qr-container">
            <img src="{{ $qrcode }}" class="qrcode" alt="QR Code">
        </div>
        <div class="codigo-container">
            <div class="codigo">{{ $device->code }}</div>
        </div>
    </div>
</body>
</html>
