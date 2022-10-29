<?php
include('../Modelo/conexion.php');
include('../Modelo/config.php');
include('../controlador/C-product-ver.php');


//Validacion del inicio de sesion del usuario
session_start();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];

  $informacion = mysqli_query($conn, "SELECT * FROM `users` WHERE id = $user_id") or die('query failed');

  if (mysqli_num_rows($informacion) > 0) {

    $row = mysqli_fetch_assoc($informacion);
    //print_r($row);
  }
  //echo "Logueado";
}
//Caso en el que el usuario no este logueado

else {
  $user_id = "";
  //echo "Iniciar seccion";
}

?>
<?php
//busqueda de productos
if (isset($_POST['search'])) {
  $buscar = $_POST['busqueda'];
  //print_r($buscar);

  $objconexion = new conexion();
  $resultado = $objconexion->consultar("SELECT * FROM `proyectos` WHERE nombre LIKE '%$buscar%'");
  if (empty($resultado)) {
    echo "<script>
    alert('No hay Resultados...');
    window.location='./V-products.php'
    </script>";
  } else {
    echo "Resultados de tu Busqueda...";
  }
}
?>
<?php
//Monto minimo
$objconexion = new conexion();
$valor_minimo = $objconexion->consultar("SELECT * FROM `gestionar_valores` WHERE id_valor = 11");

$objconexion = new conexion();
$valor_Domicilio = $objconexion->consultar("SELECT * FROM `gestionar_valores` WHERE id_valor = 22");

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Productos</title>

  <!--style del ocultar carito-->
  <link rel="stylesheet" href="../CSS/style.css">
  <!--cdn de iconos-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <!--style del navbar-->
  <link rel="stylesheet" href="../CSS/navbar.css">
  <!--style del footer-->
  <link rel="stylesheet" href="../CSS/footer.css">
  <!--style del Rsposive-->
  <link rel="stylesheet" href="../CSS/responsive.css">
  <!--style del productos-->
  <link rel="stylesheet" href="../CSS/vista-producto.css">
  <!--style del cart-->
  <link rel="stylesheet" href="../CSS/cart.css">
  <!--style del Login-->
  <link rel="stylesheet" href="../CSS/login.css">
  <!--style de la paginacion-->
  <link rel="stylesheet" href="../CSS/pag.css">
  <!--Favicon-->
  <link rel="shortcut icon" href="../IMG/media.png" type="image/x-icon">
  <!-- Slider -->
  <link rel="stylesheet" href="../CSS/slider.css">
</head>

<body>

  <header>
    <nav class="navbar">
      <div class="cont-logo">
        <img class="logo" src="../IMG/Restaurant.png" alt="logo" />
      </div>

      <div class="cont-logo-media">
        <img class="logo-media" src="../IMG/Restaurant.png" alt="logo" />
      </div>

      <div class="cont-ul">
        <ul class="lista">
          <li><a href="../index.php">Inicio</a></li>
          <li><a class="active__inicio" href="#">Productos</a></li>
          <li><a href="../contacto.php">Contacto</a></li>
        </ul>
      </div>

   


      <div class="cont-buscar">
        <img class="search" src="../img/buscar.svg" alt="" />
      </div>

      <div class="cont-carrito">
        <img src="../img/cart-shopping-solid.svg" alt="" />
        <?php
        //Carrito number
        $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        $cart_num_rows = mysqli_num_rows($select_cart_count);
        ?>
        <b><?php echo $cart_num_rows; ?></b>
      </div>


      <!--Validacion de incio de sesion start-->
      <div class="cont-user">
        <?php
        if (isset($_SESSION['user_id'])) {
          $user_id = $_SESSION['user_id'];
          $informacion = mysqli_query($conn, "SELECT * FROM `users` WHERE id = $user_id") or die('query failed');
          if (mysqli_num_rows($informacion) > 0) {
            while ($row = mysqli_fetch_assoc($informacion)) {
              echo '<a class="name" href="./V-perfil-usuario.php">' . $row['name'] . ' ' . ' ' . $row['apellido'] . '</a>';
            }
          }
          echo '<a class="cerrar-seccion" href="../controlador/C-cerrar.php">' . '<b>Cerrrar sesion</b>' . '<i class="fa-solid fa-arrow-right-from-bracket"></i>' . '</a>';
        ?>

        <?php } else {
          $user_id = "";
          echo '<h3 class="login">' . '<b class="respont">iniciar sesion</b>' . '<i class="fa-solid fa-arrow-right-to-bracket"></i>' . '</h3>';
        } ?>

      </div>
      <!--Validacion de incio de sesion end-->


      <div class="cont-bars">
        <img class="icon" src="../img/menu (1).png" alt="bars" />
      </div>

    </nav>
  </header>

  <section class="container-seccion">

    <!--Mostrar productos Registrados start-->
    <?php  
        if (mysqli_num_rows($resultado) > 0) {
          while ($products = mysqli_fetch_assoc($resultado)) {

    ?>
      <!--Cards dentro del ciclo white-->
      <div class="cont-cards-new">
        <h1><?php echo $products['nombre']; ?></h1>
        <div class="cont-img-cards">
          <img src="../imagenes/<?php echo $products['imagen']; ?>" alt="" class="image">
        </div>
        <small>Precio $<?php echo number_format($products['precio']); ?></small>

        <form action="./V-products.php" method="POST">
          <input type="hidden" name="identificador" value="<?php echo $products['id']; ?>">
          <input class="btn-cards" type="submit" value="Detalle del producto" name="submit">
        </form>

        <form action="../controlador/C-cart-add.php" method="POST">

          <input type="hidden" name="product_id" value="<?php echo $products['id']; ?>">
          <input type="hidden" name="product_nombre" value="<?php echo $products['nombre']; ?>">
          <input type="hidden" name="product_precio" value="<?php echo $products['precio']; ?>">
          <input type="hidden" name="product_imagen" value="<?php echo $products['cantidad']; ?>">
          <input type="hidden" name="product_imagen" value="<?php echo $products['categoria']; ?>">

          <input type="submit" value="Agregar al carrito" name="add_to_cart" class="btn-cards A">

        </form>

      </div>

    <?php }  ?>


      <div class="cont-pag">
      <!--paginacion-->
      <?php
      $select_products = ("SELECT * FROM `proyectos`") or die('query failed');
      $resultado = mysqli_query($conn, $select_products);

      $total_productos = mysqli_num_rows($resultado);
      $total_paginas = ceil($total_productos / $por_pagina);

      echo "<center><a class='pag-1' href='./V-products.php?pagina=1'>" . 'Anterior' . "</a>";

      for ($i = 1; $i <= $total_paginas; $i++) {
        echo "<a class='pag' href='./V-products.php?pagina=" . $i . "'> " . $i . " </a> ";
      }
      echo "<a  class='pag-1' href='./V-products.php?pagina=$total_paginas'>" . 'Siguiente' . "</a></center>";


      ?>
    </div>


    <?php }  else { ?>

      <section class="product"> 
        <h2 class="product-category">No hay productos disponibles en este momento, por favor regresa mas tarde</h2>
        <button class="pre-btn"><img src="../images/arrow.png" alt=""></button>
        <button class="nxt-btn"><img src="../images/arrow.png" alt=""></button>
        <div class="product-container">
            <div class="product-card">
                <div class="product-image">
                    <!-- <span class="discount-tag"></span> -->
                    <img  src="../images/fresas.jpg" class="product-thumb" alt="">
                    <!-- <button class="card-btn">add to wishlist</button> -->
                </div>
                <div class="product-info">
                    <!-- <h2 class="product-brand">brand</h2> -->
                    <!-- <p class="product-short-description">a short line about the cloth..</p> -->
                    <!-- <span class="price">00</span><span class="actual-price">$40</span> -->
                </div>
            </div>
            
            <div class="product-card">
                <div class="product-image">
                    <!-- <span class="discount-tag"></span> -->
                    <img src="../images/guanábana--blanco.webp" class="product-thumb" alt="">
                    <!-- <button class="card-btn">add to wishlist</button> -->
                </div>
                <div class="product-info">
                    <!-- <h2 class="product-brand">brand</h2> -->
                    <!-- <p class="product-short-description">a short line about the cloth..</p> -->
                    <!-- <span class="price">00</span><span class="actual-price">$40</span> -->
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <!-- <span class="discount-tag"></span> -->
                    <img src="../images/istockphoto-147642614-612x612.jpg" class="product-thumb" alt="">
                    <!-- <button class="card-btn">add to wishlist</button> -->
                </div>
                <div class="product-info">
                    <!-- <h2 class="product-brand">brand</h2> -->
                    <!-- <p class="product-short-description">a short line about the cloth..</p> -->
                    <!-- <span class="price">00</span><span class="actual-price">$40</span> -->
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <!-- <span class="discount-tag"></span> -->
                    <img src="../images/istockphoto-470008813-612x612.jpg" class="product-thumb" alt="">
                    <!-- <button class="card-btn">add to wishlist</button> -->
                </div>
                <div class="product-info">
                    <!-- <h2 class="product-brand">brand</h2> -->
                    <!-- <p class="product-short-description">a short line about the cloth..</p> -->
                    <!-- <span class="price">00</span><span class="actual-price">$40</span> -->
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <!-- <span class="discount-tag"></span> -->
                    <img src="../images/istockphoto-611606916-612x612.jpg" class="product-thumb" alt="">
                    <!-- <button class="card-btn">add to wishlist</button> -->
                </div>
                <div class="product-info">
                    <!-- <h2 class="product-brand">brand</h2> -->
                    <!-- <p class="product-short-description">a short line about the cloth..</p> -->
                    <!-- <span class="price">00</span><span class="actual-price">$40</span> -->
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <!-- <span class="discount-tag"></span> -->
                    <img src="../images/istockphoto-636739634-612x612.jpg" class="product-thumb" alt="">
                    <!-- <button class="card-btn">add to wishlist</button> -->
                </div>
                <div class="product-info">
                    <!-- <h2 class="product-brand">brand</h2> -->
                    <!-- <p class="product-short-description">a short line about the cloth..</p> -->
                    <!-- <span class="price">00</span><span class="actual-price">$40</span> -->
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <!-- <span class="discount-tag"></span> -->
                    <img src="../images/mango.jpg" class="product-thumb" alt="">
                    <!-- <button class="card-btn">add to wishlist</button> -->
                </div>
                <div class="product-info">
                    <!-- <h2 class="product-brand">brand</h2> -->
                    <!-- <p class="product-short-description">a short line about the cloth..</p> -->
                    <!-- <span class="price">00</span><span class="actual-price">$40</span> -->
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <!-- <span class="discount-tag"></span> -->
                    <img src="../images/tomate.jpg" class="product-thumb" alt="">
                    <!-- <button class="card-btn">add to wishlist</button> -->
                </div>
                <div class="product-info">
                    <!-- <h2 class="product-brand">brand</h2> -->
                    <!-- <p class="product-short-description">a short line about the cloth..</p> -->
                    <!-- <span class="price">00</span><span class="actual-price">$40</span> -->
                </div>
            </div>
    </section>
    

    <?php } ?>
    <!--Mostrar productos Registrados end-->



    <!--Container del detalle del producto strat-->
    <?php
    if (isset($_POST['submit'])) {
      //print_r($_POST);
      $id = $_POST['identificador'];
      print_r($id);

      $objconexion = new conexion();
      $detalle = $objconexion->consultar("SELECT * FROM `proyectos` WHERE id = $id");
      //print_r($resultado);
      foreach ($detalle as $cards) {

    ?>
        <div class="cont-print">

          <div class="cont-card-detalle">
            <div class="cont-image-detalle">
              <img src="../imagenes/<?php echo $cards['imagen']; ?>" alt="">
            </div>

            <div class="cont-informacion-datalle">

              <h2><?php echo $cards['nombre']; ?></h2>
              <h5>Precio $<?php echo number_format($cards['precio']) ?></h5>
              <p><?php echo $cards['descripcion']; ?></p>

              <form action="../controlador/C-cart-add.php" method="POST">

                <input type="hidden" name="product_id" value="<?php echo $cards['id']; ?>">
                <input type="hidden" name="product_nombre" value="<?php echo $cards['nombre']; ?>">
                <input type="hidden" name="product_precio" value="<?php echo $cards['precio']; ?>">
                <input type="hidden" name="product_imagen" value="<?php echo $cards['cantidad']; ?>">
                <input type="hidden" name="product_imagen" value="<?php echo $cards['categoria']; ?>">
              

            

                <input type="submit" value="Agregar al carrito" name="add_to_cart" class="btn-card-add">

              </form>
            </div>


            <div class="cerrar">
              <a href="./V-products.php"><i class="fa-solid fa-xmark"></i></a>
            </div>



          </div>


        </div>

    <?php }
    } ?>
    <!--Container del detalle del producto end-->



    <!--container del carrito letaral start-->
    <div class="cont-cart-ver">

      <?php
      //$envio = 2000;
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if (mysqli_num_rows($select_cart) > 0) {
        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
      ?>
          <div class="cont-card-cart">

            <div class="cont-card-cart__caintainer">

              <div class="cont-card-cart__img">
                <img src="../imagenes/<?php echo $fetch_cart['imagen']; ?>" alt="" class="image">
              </div>

              <div class="cont-form-cart">
                <h3 class="name"><?php echo $fetch_cart['nombre']; ?> * LIBRA</h3>
                <h4 class="price">$<?php echo number_format($fetch_cart['precio']); ?></h4>
                <form class="form_cart" action="../controlador/C-cart-actualizar.php" method="post">
                  <input type="hidden" value="<?php echo $fetch_cart['id']; ?>" name="cart_id">
                  <input type="number" min="1" value="<?php echo $fetch_cart['quantity']; ?>" name="cart_quantity" class="qty">
                  <input type="hidden" name="session" value="<?php echo $user_id; ?>" >
                  <input class="calcular" type="submit" value="Calcular" name="update_quantity">
                </form>

                <div class="sub-total"> sub-total : <span>$<?php echo number_format($sub_total = $fetch_cart['precio'] * $fetch_cart['quantity']); ?></span> </div>
              </div>

            </div>

            <div class="cont-close">
              <form action="../controlador/C-cart-eliminar.php" method="post">
                <input type="hidden" name="delete" value="<?php echo $fetch_cart['id']; ?>" >
                <input type="hidden" name="session" value="<?php echo $user_id; ?>" >
                <button style="background-color: transparent; border:none;" class="fas fa-times" type="submit" onclick="return confirm('Desea eliminar este producto del carrito?');" name="delete_cart"></button>
              </form>

            </div>



          </div>




      <?php
          $grand_total += $sub_total;
        }
      } else {
        echo "<p style='color:black; font-weight: 800; text-align: center; font-size: 21px;' >!No hay nada en el carrito de compras¡</p>";
      }
      ?>

      <div class="cart-total">

        <p style="color:black;" ><strong>Envió: $<?php 
        foreach($valor_Domicilio as $domicilio){
          $envio = $domicilio['Valor_Domicilio_Minimo'];
          echo number_format($envio);
        }
        ?> COP</strong></p>
        
        <p style="color:green;"><strong>Total: $<?php echo number_format($grand_total + $envio); ?> COP</strong></p>

        <?php
                  foreach($valor_minimo as $val){
                    $habilitar_compra = $val['Valor_Domicilio_Minimo'];
                   
                  }

        if ($grand_total >= $habilitar_compra) {


        ?>

          <a class="confirmar" href="./V-factura.php?pedido=<?php echo $user_id; ?>" class="option-btn">Realizar pedido</a>

        <?php
        } else {
          foreach($valor_minimo as $minimo){
            $habilitar = $minimo['Valor_Domicilio_Minimo'];
            $min = number_format($habilitar);
          }
          echo "<p style='color:red; font-weight: 800;'>!El monto minimo desbe ser mayor a $min para realizar tu pedido¡</p>";
        }
        ?>
      




      </div>

    </div>
    <!--container del carrito letaral end-->



    <!--container del login start-->
    <div class="cont-login">
      <form class="form-control" action="../controlador/C-login.php" method="post">
        <div class="cont-a">
          <a href="./V-products.php"><i class="fa-solid fa-xmark"></i></a>
        </div>
        <h3>Iniciar sesión</h3>
        <input type="email" name="email" class="box" placeholder="Ingresa tu email" required>
        <input type="password" name="pass" class="box" placeholder="Ingresa tu contraseña" required>
        <input type="submit" class="btn" name="submit" value="Iniciar sesión">
        <div class="cont-link-pg">
          <a href="./V-RegistroClientes.php">¿No tienes cuenta?</a>
          <a href="./V-Recuperar-Contrasena.php">¿Olvide mi contraseña?</a>
        </div>
      </form>
    </div>
    <!--container del login end-->

  </section>

  <!--Footer-->
  <footer>
    <div class="cont-footer">
      <div class="nombre">
        <h3>konecta</h3>
      </div>
      <div class="cont-text">
        <p>
          Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum
          harum minus laudantium, placeat libero sit in alias corrupti
          necessitatibus similique magnam et reprehenderit blanditiis earum
          quis atque nam dignissimos maiores?
        </p>
      </div>
      <div class="cont-icon">
        <img src="../img/facebook.png" alt="Red-social" />
        <img src="../img/instagram.png" alt="Red-social" />
        <img src="../img/whatsapp.png" alt="Red-social" />
      </div>
    </div>
    <div class="copy">
      <small>&copy; 2022 <b>konecta</b> - Todos los Derechos Reservados.</small>
    </div>
  </footer>


  <!--Code javaScript-->
  <script src="../JS/script.js"></script>
  <script src="../JS/cart.js"></script>
  <script src="../JS/login.js"></script>
  <script src="../JS/slider.js"></script>
</body>

</html>