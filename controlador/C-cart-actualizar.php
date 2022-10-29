<?php
//acciones del carrito de compras: eliminar, eliminar todo, autualizar cantidad;
include('../Modelo/config.php');
if (isset($_POST['update_quantity'])) {
  $cart_id = $_POST['cart_id'];
  $cart_quantity = $_POST['cart_quantity'];
  $user_id = $_POST['session'];

  $select_users = mysqli_query($conn, "SELECT * FROM `orden_pedidos` WHERE user_id = '$user_id'") or die('query failed');
  if(mysqli_num_rows($select_users) > 0){
     echo "<script>
     alert('¡Ups debes esperar que se atienda tu orden de pedido, para calcular productos de tu carrito!');
     window.location= '../vista/V-products.php'
 </script>";
 
  }else{
    mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
    $message[] = 'cart quantity updated!';
    header('location:../vista/V-products.php');
  }


}

?>