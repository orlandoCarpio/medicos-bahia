<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médicos Bahia Blanca</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <!-- JS, Popper.js, and jQuery -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        .btn{
            background: #3171e4;
            padding: 15px;
            border-radius: 5px;
            color: white;
            text-decoration-line: none;
            font-size: 20px;
            font-weight: 500;
            margin-top:20px;
            text-align:center;
        }
        body{
            font-size:23px;
        }
        h1{
            font-size:28px;
        }
        .contenedor{
            max-width:800px;
            width:100%;
            margin:auto;
        }
    </style>
</head>
    <body>
        <div class="contenedor">
            <h1>Bienvenido</h1>
            {{$email}}!<br><br>
            ¡Gracias por utilizar nuestro servicio!<br><br>

            Haga click en el siguiente boton para cambiar la contraseña.<br><br>
            
        </div><br>                 
        <a href={{url('reset-pass', [$clave])}} class="btn">Cambiar contraseña</a>
        
    </body>
</html>