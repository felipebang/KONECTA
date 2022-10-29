
<?php 
include('../Modelo/conexion.php'); 
include('../Modelo/config.php');
session_start();
if (isset($_SESSION['usuario']) != "admin") {
  header("location:../vista/V-products.php");
}


?>


<?php

if (isset($_POST['editarProduct'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $peso = $_POST['peso'];
    $categoria = $_POST['categoria'];
    $cantidad = $_POST['cantidad'];
   



        
   
   
     
   

        //Guardar nueva imagen en la carpeta imagenes
        $fecha = new DateTime();
        $imagen_guardad = $fecha->getTimestamp();
    
?>

<?PHP

if (isset($_POST['submit']) && isset($_POST['update']) &&  $_POST['update'] > 0) {
  //Ejecutamos Datos actualizados

  
    print_r($_GET);
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $peso = $_POST['peso'];
    $categoria = $_POST['categoria'];
    $cantidad = $_POST['cantidad'];
    

        

}
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar</title>
    <link rel="stylesheet" href="../CSS/admin-style.css">
      <!--Favicon-->
  <link rel="shortcut icon" href="../IMG/media.png" type="image/x-icon">

    
</head>

<body>
    <br><br>
    <section class="form-editar">
        <form action="./C-actualizarPropducto.php" method="post" enctype="multipart/form-data">
            <h2 class="form-title">Modificar producto</h2>

            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <label>Modificar nombre</label>
            <input type="text" name="nombre" value="<?php echo $nombre; ?>">

            <label>Modificar cantidad</label>
            <input type="number" name="cantidad" value="<?php echo $cantidad; ?>">



            <label>Modificar precio</label>
            <input type="number" name="precio"   value="<?php echo $precio; ?>">

            <label for="peso">peso</label>
                <input type="number" name="peso"  value="<?php echo $peso; ?>">

                <label for="categoria">categoria </label>
                <input type="text" name="categoria" value="<?php echo $categoria; ?>">


            <label class="label-editar">Modificar descripcionción</label>
            <textarea class="descrip-editar" type="text" cols="30" rows="5" name="descripcion"><?php echo $descripcion; ?>
            </textarea>

            <input type="hidden" name="update" value="<?php echo $id; ?>">

            <input class="form-btn" type="submit"  name="editarProduct">
        </form>
    </section>
</body>

</html>

