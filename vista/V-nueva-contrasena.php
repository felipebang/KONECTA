<?php 
if(isset($_GET['identificador'])){
    $identificador = $_GET['id'];
   /* print_r($_GET);*/
}else{
    header('location: ./V-Recuperar-Contrasena.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="../CSS/NuevaContrasena.css">
</head>
<body>
    <div class="crear">
        <h1>Crear nueva contraseña</h1>
    <form action="../controlador/C-nueva-contrasena.php" method="post">

    <label for="contrasenia_1">Ingresar contraseña</label><br>
    <input type="password" name="contrasenia_1" id="" placeholder="Confirma tu contraseña"><br><br>

    <label for="contrasenia_2">Confirmar contraseña</label><br>
    <input type="password" name="contrasenia_2" id="" placeholder="Confirma tu contraseña">

    <input type="hidden" name="id" value="<?php echo $identificador; ?>">

    <input type="submit" value="Cambiar " name="Restablecer">
    </form>
    </div>

</body>
</html>