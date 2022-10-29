<?php
session_start();
if (isset($_SESSION['usuario']) != "admin") {
  header("location:./V-products.php");
}

?>

<?php
include('../Modelo/conexion.php');

if (isset($_GET['producto'])) {
  $pedido = $_GET['producto'];
  //print_r($_GET['producto']);

  $grand_total = 0;
  $objconexion = new conexion();
  $resultado = $objconexion->consultar("SELECT * FROM `cart` WHERE user_id = '$pedido'") or die('query failed');
  if (isset($pedido)) {
    $objconexion = new conexion();
    $users = $objconexion->consultar("SELECT * FROM `users` WHERE id = '$pedido'");
  }
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
  <title>Pedidos</title>
  <!-- CSS only -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../CSS/admin-pedido.css">
    <!--Favicon-->
    <link rel="shortcut icon" href="../IMG/media.png" type="image/x-icon">
</head>

<body>

  <div class="cont-tabla">
    <div class="cont-users">
      <?php foreach ($users as $use) { ?>
        <h3><?php echo $use['name'] . ' ' . $use['apellido']; ?></h3>
        <?php $identity = $use['id']; ?>
        <img src="../IMG/user-solid (1).svg" alt="">

      <?php } ?>
    </div>

    

    <h1>Tabla de pedidos</h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Nombre del producto</th>
          <th scope="col">Precio</th>
          <th scope="col">Cantidad</th>
          <th scope="col">Total</th>
        </tr>
      </thead>
      <tbody>

        <?php foreach ($resultado as $product) { ?>

          <tr>
            <td><?php echo $product['nombre']; ?></td>
            <td><?php echo number_format($product['precio']) ?></td>
            <td><?php echo $product['quantity']; ?> Lb</td>
            <td><?php echo number_format($total = $product['quantity'] * $product['precio']); ?></td>
            <?php $grand_total += $total; ?>
      


          </tr>
        <?php } ?>

        <tr>
          <th scope="row">Valor total del pedido</th>
          <td><?php echo number_format($grand_total); ?></td>
          <td><a onclick="return confirm('¿Esta seguro de registrar esta venta?');" class="btn btn-primary" href="../controlador/C-admin-Save-ventas.php?indentity=<?php echo $identity; ?>">Guardar venta</a></td>

        </tr>

      </tbody>
    </table>
  </div>

</body>


</html>