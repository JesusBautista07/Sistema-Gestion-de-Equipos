<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Equipos</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background-color: #343a40; color: white; }
        h2 { text-align: center; }
    </style>
</head>
<body>

    <h2>Reporte de Equipos</h2>
    <p>Fecha de generación: {{ now()->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Marca</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($equipos as $equipo)
            <tr>
                <td>{{ $equipo->codigo }}</td>
                <td>{{ $equipo->nombre }}</td>
                <td>{{ $equipo->categoria }}</td>
                <td>{{ $equipo->marca }}</td>
                <td>{{ $equipo->estado }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>