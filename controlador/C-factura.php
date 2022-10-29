<?php
include('../Modelo/conexion.php');
include('../Modelo/config.php');


if (isset($_GET['confirmar'])) {
  $user = $_GET['id'];
  $fecha = $_GET['fecha'];
  $hora = $_GET['hora'];
  $fechaYhora = $fecha.' '.$hora;

  $select_users = mysqli_query($conn, "SELECT * FROM `orden_pedidos` WHERE user_id = '$user'") or die('query failed');
  if(mysqli_num_rows($select_users) > 0){
     $message[] = '¡usuario ya existente!';
     echo "<script>
     alert('¡Ups debes esperar que se atienda tu orden de pedido, para realizar nuevas órdenes!');
     window.location= '../vista/V-products.php'
 </script>";
  }else{

    $objconexion = new conexion();
    $sql = "INSERT INTO `orden_pedidos` (`idPedido`, `user_id`, `datetime` ) VALUES (NULL, '$user', '$fechaYhora');";
    $objconexion->ejecutar($sql);
  
    
  
    if (isset($user)) {
      echo "<script>
        alert('Su orden de pedido está en trámite, por favor no realice más pedidos, ni agregue productos al carrito de compras, hasta que se atienda su orden de pedido...');
        window.location='../vista/V-products.php'
        </script>";
    }
  }
  
  //print_r($user);

}

?>