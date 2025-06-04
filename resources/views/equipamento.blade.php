<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipamento {{ $device->code }}</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f7f7f7;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 22px;
            margin-top: 0;
            color: #2c3e50;
        }

        p {
            margin: 8px 0;
            font-size: 16px;
        }

        strong {
            color: #333;
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            .container {
                padding: 16px;
            }

            h2 {
                font-size: 22px;
            }

            p {
                font-size: 17px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Equipamento {{ $device->code }}</h2>
        <p><strong>Tipo:</strong> {{ $device->device_type }}</p>
        <p><strong>Fabricante:</strong> {{ $device->manufacturer }}</p>
        <p><strong>Modelo:</strong> {{ $device->model }}</p>
        <p><strong>Número de Série:</strong> {{ $device->serial_number }}</p>
        <p><strong>Usuário:</strong> {{ $device->assignedUser?->name }}</p>
        <p><strong>Setor:</strong> {{ $device->department?->name }}</p>
        <p><strong>IP:</strong> {{ $device->ip_address }}</p>
        <p><strong>Empresa:</strong> {{ $device->company }}</p>
        <p><strong>Aquisição:</strong> {{ \Carbon\Carbon::parse($device->purchase_date)->format('d/m/Y') }}</p>
    </div>
</body>
</html>
