<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Importación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 10px;
            border-radius: 5px 5px 0 0;
        }

        .content {
            padding: 20px;
        }

        .success-message {
            color: green;
        }

        .error-message {
            color: red;
        }

        .message {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .error-list {
            margin-top: 10px;
        }

        .error-list li {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Reporte de Importación</h2>
        </div>
        <div class="content">
            <p class="message">
                Estado de la importación:
                @if ($success)
                <span class="success-message">Importación completada correctamente.</span>
                @else
                <span class="error-message">Hubo errores durante la importación.</span>
                @endif
            </p>
            <p>Total de filas procesadas: {{ $totalRows }}</p>

            @if (!empty($errors))
            <h3>Errores:</h3>
            <ul class="error-list">
                @foreach ($errors as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif

            @if (!empty($insertedVehicles))
            <h3>Éxitos:</h3>
            <ul class="error-list">
                @foreach ($insertedVehicles as $insert)
                <li>{{ $insert }}</li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</body>

</html>