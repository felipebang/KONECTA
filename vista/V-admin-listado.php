<?php
include('../controlador/C-admin-table-ver.php');

session_start();
if (isset($_SESSION['usuario']) != "admin") {
  header("location:./V-products.php");
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administracion</title>
  <link rel="stylesheet" href="../CSS/admin-style.css">
    <!--Favicon-->
    <link rel="shortcut icon" href="../IMG/media.png" type="image/x-icon">
</head>

<body>

  <div class="cont-dashboard">
    <div class="con-cerrar">
      <div class="con-user">
        <img src="../IMG/user-solid (1).svg" alt="">
        <a href="../controlador/C-admin-cerrar.php">Cerrar sesión</a>
      </div>
    </div>
    <nav>

      <ul>
        <li><a href="./V-admin-insertar.php">Agregar productos</a></li>
        <li><a href="./V-admin-table.php">Tabla de acciones</a></li>
        <li><a class="activo" href="#">Lista de productos</a></li>
        <li><a href="./V-admin-ordenes.php">Ordenes de pedidos</a></li>
        <li><a href="./V-admin-gestionar-valores.php">stock Gestionar valores</a></li>
        <li><a href="./V-admin-ventas.php">Visualizar ventas</a></li>
      </ul>
      <!--  <a href="./cerrar.php">Cerrar Sesion</a>-->

    </nav>

    <section>
      <?php 
                  if (mysqli_num_rows($resultado) > 0) {
                    while ($proyectos = mysqli_fetch_assoc($resultado)) {
      ?>

        <div class="cont-card">

          <div class="cont-img-card">
            <img class="img-producto" src="../imagenes/<?php echo $proyectos['imagen']; ?>" alt="" />
          </div>

          <div class="cont-detalle">
            <h2 class="title"><?php echo $proyectos['nombre']; ?></h2>
            <h3>Precio: <?php echo number_format($proyectos['precio']); ?></h3>
            
            
            

            <p class="texto"><?php echo $proyectos['descripcion']; ?></p>

          </div>



        </div>
      <?php
       } 
      }else{
        echo "<h1 style='color:red;'>¡Ups no tines productos para visualizar!</h1>";
      }
      
      ?>
    </section>


  </div>



</body>

</html>