    <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Solicitantes</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background-color: #343a40; color: white; }
        h2 { text-align: center; }
    </style>
</head>
<body>

    <h2>Reporte de Solicitantes</h2>
    <p>Fecha de generación: {{ now()->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Documento</th>
                <th>Correo</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($solicitantes as $solicitante)
            <tr>
                <td>{{ $solicitante->nombre }}</td>
                <td>{{ $solicitante->documento }}</td>
                <td>{{ $solicitante->correo }}</td>
                <td>{{ $solicitante->tipo }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>