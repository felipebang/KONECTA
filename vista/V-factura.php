<?php include('../controlador/C-perfilUsuario-ver.php') ?>
<?php
//Monto Domicilio
include("../Modelo/conexion.php");
$objconexion = new conexion();
$valor_Domicilio = $objconexion->consultar("SELECT * FROM `gestionar_valores` WHERE id_valor = 22");

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Factura</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../CSS/factura.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!--Favicon-->
  <link rel="shortcut icon" href="../IMG/media.png" type="image/x-icon">

</head>

<body>


  <div class="cont-center">
    <?php foreach ($perfil as $fact) {


    ?>

      <div class="cont-cabecera">
        <h3>Usuario: <?php echo $fact['name'] . ' ' . $fact['apellido'] ?></h3>


        <div class="cont-datos">

          <div class="cont-datos-1">

            <p>
              <b>
                Fecha y hora:
              </b>
              <?php
              date_default_timezone_set("America/Bogota");
              $fecha = date("d/m/Y");
              $hora = date("h:i a");
              echo $fecha . ' ' . $hora;

              ?>
            </p>
            <p><b>Teléfono:</b> <?php echo $fact['celular'] ?></p>
            <p><b>Correo:</b> <?php echo $fact['email'] ?></p>

          </div>

          <div class="cont-datos-2">


            <p><b>Dirección:</b> <?php echo $fact['direccion'] . ', ' . $fact['ndireccion'] . ' # ' . $fact['ncasa'] . ' - ' . $fact['n1casa'] ?></p>
            <p><b>Ciudad:</b> <?php echo $fact['ciudad'] ?></p>
            <p><b>Barrio:</b> <?php echo $fact['barrio'] ?></p>

          </div>

        </div>
      </div>

    <?php  } ?>


    <div class="cont-tabla">
      <table class="table">
        <thead>
          <tr>
            <th><i>Descarga tu factura</i></th>
            <td>
              <?php foreach ($perfil as $paint) { ?>
                <a href="./V-factura-pdf.php?pedido=<?php echo $paint['id'] ?>"><i class="fa-solid fa-download"></i></a>
              <?php } ?>
            </td>
          </tr>
          <tr>
            <th scope="col">Nombre del producto</th>
            <th scope="col">Precio</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>


          <?php
          if (isset($_GET['pedido'])) {
            //  print_r($_GET);
            $id = $_GET['pedido'];

            include('../Modelo/config.php');

            $ids = 0;
            $grand_total = 0;
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$id'") or die('query failed');
            if (mysqli_num_rows($select_cart) > 0) {
              while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                $total_price = ($fetch_cart['precio'] * $fetch_cart['quantity']);
                $grand_total += $total_price;
                //$id = $fetch_cart['pid'];
          ?>
                <tr>
                  <td><?php echo $fetch_cart['nombre']; ?></td>
                  <td><?php echo number_format($fetch_cart['precio']) ?></td>
                  <td><?php echo $fetch_cart['quantity']; ?> Lb</td>
                  <td><?php echo number_format($total = $fetch_cart['quantity'] * $fetch_cart['precio']); ?></td>
                  <?php $grand_total + $total; ?>
                </tr>

          <?php
              }
            } else {
              echo '<p class="empty">your cart is empty</p>';
            }
          } else {
            header('location:./V-products.php');
          }
          ?>
          <tr>
            <th scope="row">Domicilio</th>
            <td><strong>
                $
                <?php
                          foreach($valor_Domicilio as $minimo){
                            $envio = $minimo['Valor_Domicilio_Minimo'];
                            
                          }
  
                echo number_format($envio);
                ?>
              </strong>
            </td>
          </tr>

          <tr>
            <th scope="row">Total a pagar</th>
            <td><strong>$ <?php echo number_format($grand_total + $envio); ?></strong></td>


            <td>
              <?php foreach ($perfil as $id) { ?>

                <form action="../controlador/C-factura.php" method="get">
                  <input type="hidden" name="id" value="<?php echo $id['id'] ?>">
                  <input type="hidden" name="fecha" value="<?php echo $fecha; ?>">
                  <input type="hidden" name="hora" value="<?php echo $hora; ?>">
                  <button type="submit" name="confirmar">Confirmar</button>
                </form>

              <?php }
              ?>
            </td>





          </tr>


        </tbody>
      </table>

    </div>

  </div>


</body>

</html>