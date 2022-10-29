
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="../CSS/RecuperarContrasena.css">
</head>
<body>
<div class="recupero">
    <h1>Recuperar Contraseña</h1>
    
    <form action="../controlador/C-recuperar-contrasena.php" method="post">
    <label for="email">Ingresa tu email</label><br>
    <input type="email" name="email" id="" placeholder="Ingresa tu correo electronico"><br><br>
    <label for="celular">Ingresa tu celular</label><br>
    <input type="number" name="celular" id="" placeholder="Ingresa tu numero celular">
    <input type="submit" value="Validar credenciales" name="validar">
    </form>
    </div>

</body>
</html>