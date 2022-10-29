<?php
session_start();
if (isset($_SESSION['usuario']) != "admin") {
    header("location:./V-products.php");
}
?>

<?php include('../Modelo/conexion.php'); ?>


<?php
if (isset($_GET['informacion-personal'])) {
    $info = $_GET['informacion-personal'];
    //print_r($_GET['informacion-personal']);

    $objconexion = new conexion();
    $resultado = $objconexion->consultar("SELECT * FROM `users` WHERE id = '$info'");
}else{
    header('location: ./V-admin-ordenes.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos usuario</title>
    <link rel="stylesheet" href="../CSS/admin-informacion-user.css">
      <!--Favicon-->
  <link rel="shortcut icon" href="../IMG/media.png" type="image/x-icon">
</head>
<body>
<div class="cont-form">
<form action="">
<?php foreach($resultado as $user) { ?>
    <h1>Datos del usuario</h1>
    <input type="hidden" name="" id="" value="<?php echo $user['id'] ?>" disabled><br>
    <label>Nombre del usuario</label><br>
    <input type="text" name="" id="" value="<?php echo $user['name'].' '.$user['apellido'] ?>" disabled><br>
    <label>Correo electrónico</label><br>
    <input type="text" name="" id="" value="<?php echo $user['email'] ?>" disabled><br>
    <label>Teléfono</label><br>
    <input type="text" name="" id="" value="<?php echo $user['celular']; ?>" disabled><br>
    <label>Descripción </label><br>
    <input type="text" value="<?php echo $user['direccion'] . ',' . ' ' . $user['ndireccion'] . ' ' . '# ' . $user['ncasa'] . ' - ' . $user['n1casa']  ?>" disabled><br>
    <label>Barrio</label><br>
    <input type="text" name="" id="" value="<?php echo $user['barrio']; ?>" disabled><br>

<?php } ?>
        
    </form>
</div>
    
</body>
</html>