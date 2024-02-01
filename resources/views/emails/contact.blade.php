<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-top: 20px;
        }

        h1 {
            color: #333333;
        }

        p {
            color: #666666;
        }
    </style>
</head>

<body>
    <div class="container">
        <p>Has recibido un nuevo mensaje con la siguiente informacion:</p>

        <ul>
            <li><strong>Nombre de la persona que solicita la informacion:</strong> {{ $data['nombre'] }}</li>
            <li><strong>Email de la persona que solicita la informacion:</strong> {{ $data['email'] }}</li>
            <li><strong>Mensaje  del usuario:</strong> {{ $data['mensaje'] }}</li>
        </ul>

    </div>
</body>

</html>
