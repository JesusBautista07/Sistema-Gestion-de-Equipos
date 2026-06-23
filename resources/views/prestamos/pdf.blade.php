<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Préstamos</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background-color: #343a40; color: white; }
        h2 { text-align: center; }
    </style>
</head>
<body>

    <h2>Reporte de Préstamos</h2>
    <p>Fecha de generación: {{ now()->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Equipo</th>
                <th>Solicitante</th>
                <th>Fecha Préstamo</th>
                <th>Fecha Esperada</th>
                <th>Fecha Devolución</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prestamos as $prestamo)
            <tr>
                <td>{{ $prestamo->equipo->nombre }}</td>
                <td>{{ $prestamo->solicitante->nombre }}</td>
                <td>{{ $prestamo->fecha_prestamo }}</td>
                <td>{{ $prestamo->fecha_devolucion_esperada }}</td>
                <td>{{ $prestamo->fecha_devolucion_real ?? 'Pendiente' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>