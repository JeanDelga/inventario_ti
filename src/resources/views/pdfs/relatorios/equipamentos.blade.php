<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório de Equipamentos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <h2>Relatório de Equipamentos</h2>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Tipo</th>
                <th>Usuário</th>
                <th>Empresa</th>
                <th>Data de Compra</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($devices as $device)
                <tr>
                    <td>{{ $device->code }}</td>
                    <td>{{ $device->device_type }}</td>
                    <td>{{ $device->assignedUser?->name }}</td>
                    <td>{{ $device->company }}</td>
                    <td>{{ \Carbon\Carbon::parse($device->purchase_date)->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
