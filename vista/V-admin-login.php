<?php
/*admin@sistemas.com */
/*Sistemas*/

session_start();
if ($_POST) {
    if (($_POST['usuario'] == "admin") && ($_POST['contrasenia'] == "Sistemas")) {

        $_SESSION['usuario'] = "admin";

        header('location:./V-admin-listado.php');
    } else {
        echo "<script> alert('Usuario o Constraseña incorrectos') </script>";
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../CSS/admin-login.css">
      <!--Favicon-->
  <link rel="shortcut icon" href="../IMG/media.png" type="image/x-icon">

</head>

<body>
    <div class="cont-login">
        <form action="./V-admin-login.php" method="post">
            <h3>Iniciar sesion</h3><br>

            <div class="cont-imput-1">
                Usuario<br />
                <input type="text" required name="usuario" id="" pattern=".{5}" placeholder="ingrese su contrasena"><br />
            </div>
            <div class="cont-imput">
                Contraseña<br />
                <input type="password" required name="contrasenia" id="" pattern=".{8}" placeholder="ingrese su contrasena"> <br />
            </div>
            <button type="submit">Ingresar</button>
        </form>
    </div>

</body>

</html>