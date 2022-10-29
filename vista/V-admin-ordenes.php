<?php
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
  <link rel="stylesheet" href="../CSS/admin-orden.css">
   <!--cdn de iconos-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <!--Paginacion-->
   <link rel="stylesheet" href="../CSS/pag.css">
     <!--Favicon-->
  <link rel="shortcut icon" href="../IMG/media.png" type="image/x-icon">

   <style>
    .cont-pag-orden{
      position: absolute;
      width: 100%;
      bottom: 13px;
      right: 0;
      left: 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }
   </style>


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
        <li><a href="./V-admin-listado.php">Lista de productos</a></li>
        <li><a class="activo" href="./orden_pedido.php">Ordenes de pedidos</a></li>
        <li><a href="./V-admin-gestionar-valores.php">stock Gestionar valores</a></li>
        <li><a href="./V-admin-ventas.php">Visualizar ventas</a></li>

      </ul>
      <!--  <a href="./cerrar.php">Cerrar Sesion</a>-->

    </nav>

    <section>
    <?php
    //Mostrar productos Registrados
    include('../Modelo/config.php');
    $por_pagina = 6;
    if(isset($_GET['pagina'])){
      $pagina = $_GET['pagina'];
    }else{
      $pagina = 1;
    }
    $empieza = ($pagina-1) * $por_pagina;
    $select_products = ("SELECT * FROM `orden_pedidos` LIMIT $empieza,$por_pagina") or die('query failed');
    $resultado = mysqli_query($conn,$select_products);

    if (mysqli_num_rows($resultado) > 0) { 
      while ($products = mysqli_fetch_assoc($resultado)) {
        $orden = $products['idPedido'];
    ?>


        <div class="cont-order">
        

          <img class="cont-img-order" src="../img/noti.jpeg" alt="notificacion" />
          <div class="cont-fecha">
            <h5><b>Fecha y hora: <?php echo $products['datetime']; ?></b></h5>
          </div>
          <div class="cont-id">
            <h3>
            <?php echo $products['user_id']; ?>
            </h3>
          </div>

          <div class="cont-btn-order">
            <button class="infor">
              <a href="./V-admin-infor-usuario.php?informacion-personal=<?php echo $products['user_id']; ?>">Información personal</a>
            </button>

            <button class="gestion">
            <a href="./V-admin-pedido.php?producto=<?php echo $products['user_id']; ?>">Gestionar Pedido</a>
            </button>
          </div>

          <div class="cerrar">
              <a  onclick="return confirm('Desea eliminar esta orden?');" href="../controlador/C-admin-borrar_orden.php?Remover_orden=<?php echo $orden; ?>"><i class="fa-solid fa-xmark"></i></a>
            </div>

        </div>

        <?php } ?>

        <div class="cont-pag-orden">
                      <!--paginacion-->
                      <?php 
           $select_products = ("SELECT * FROM `orden_pedidos`") or die('query failed');
           $resultado = mysqli_query($conn,$select_products);

           $total_productos = mysqli_num_rows($resultado);
           $total_paginas=ceil($total_productos/$por_pagina);

           echo "<center><a class='pag-1' href='V-admin-ordenes.php?pagina=1'>".'Anterior'. "</a>";

           for($i=1; $i<=$total_paginas; $i++){
           echo "<a class='pag' href='V-admin-ordenes.php?pagina=".$i."'> ".$i." </a> ";
           }
           echo "<a class='pag-1' href='V-admin-ordenes.php?pagina=$total_paginas'>".'Siguiente'. "</a></center>";

       
          ?>
        </div>

        <?php   } else{
          echo "<h1 style='color:red;'>No hay ordenes de pedidos</h1>";
        } ?>




    </section>

  </div>




</body>
</html>