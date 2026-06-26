<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            max-width: 600px;
            margin: 0 auto;
        }

        .header {
            background-color: #0d6efd;
            color: white;
            padding: 15px;
            border-radius: 6px 6px 0 0;
            text-align: center;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        td {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }

        .label {
            font-weight: bold;
            width: 40%;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #888;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Confirmación de Préstamo</h2>
        </div>

        <p>Hola <strong>{{ $prestamo->solicitante->nombre }}</strong>,</p>
        <p>Se ha registrado el préstamo del siguiente equipo a tu nombre:</p>

        <table>
            <tr>
                <td class="label">Equipo:</td>
                <td>{{ $prestamo->equipo->nombre }} ({{ $prestamo->equipo->codigo }})</td>
            </tr>
            <tr>
                <td class="label">Categoría:</td>
                <td>{{ $prestamo->equipo->categoria }}</td>
            </tr>
            <tr>
                <td class="label">Fecha de Préstamo:</td>
                <td>{{ $prestamo->fecha_prestamo }}</td>
            </tr>
            <tr>
                <td class="label">Fecha Esperada de Devolución:</td>
                <td>{{ $prestamo->fecha_devolucion_esperada }}</td>
            </tr>
        </table>

        <p style="margin-top: 20px;">Por favor recuerda devolver el equipo en buen estado antes de la fecha esperada.
        </p>

        <div class="footer">
            Sistema de Gestión de Préstamo de Equipos
        </div>
    </div>
</body>

</html>