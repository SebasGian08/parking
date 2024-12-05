<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memorandum - {{ $memorandum->empleado->nombre }} {{ $memorandum->empleado->apellido }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 80%;
            max-width: 800px;
            margin: 20px auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 1;
        }

        h1 {
            text-align: center;
            color: #0056b3;
            margin-bottom: 20px;
            font-size: 28px;
            border-bottom: 3px solid #0056b3;
            padding-bottom: 10px;
            font-weight: bold;
        }

        .header,
        .content,
        .footer {
            margin-bottom: 30px;
        }

        .header p {
            margin: 5px 0;
            line-height: 1.5;
        }

        .content {
            line-height: 1.6;
        }

        .footer {
            text-align: left;
            font-size: 0.8em;
            color: #afafaf;
        }

        .bold {
            font-weight: bold;
        }

        .separator {
            margin: 20px 0;
            border-top: 1px solid #ccc;
        }

        p {
            text-align: justify;
        }

        .imagen-logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .imagen-logo img {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="imagen-logo">
            <img src="https://grupocodware.com/images/tulogoaqui.png" alt="Logo">
        </div>
        <h1>Memorandum</h1>
        <div class="header">
            <p class="bold">DNI:</p>
            <p>{{ $memorandum->dni }}</p>
            <p class="bold">Nombre:</p>
            <p>{{ $memorandum->empleado->nombre }} {{ $memorandum->empleado->apellido }}</p>
            <p class="bold">Fecha de creación:</p>
            <p>{{ $memorandum->created_at }}</p>
        </div>
        <div class="separator"></div>
        <div class="content">
            <p>Estimado/a {{ $memorandum->empleado->nombre }},</p>
            <p>Por medio del presente memorándum, se comunica que ha habido tardanzas en su asistencia durante las
                últimas semanas. Agradecemos su comprensión y solicitamos que, en la medida de lo posible, se realicen
                los ajustes necesarios para cumplir con el horario establecido.</p>
            <p class="bold">{{ $memorandum->asunto }}</p>
        </div>
        <div class="footer">
            <p>Confidencial - Uso exclusivo de la empresa</p>
            <p>&copy; {{ date('Y') }} Tu Empresa. Todos los derechos reservados.</p>
        </div>
    </div>
</body>

</html>
