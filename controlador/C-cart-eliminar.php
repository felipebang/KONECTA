<?php
include('../Modelo/config.php');
//acciones del carrito de compras: eliminar, eliminar todo, autualizar cantidad;
if (isset($_POST['delete_cart'])) {
  $delete_id = $_POST['delete'];
  $user_id = $_POST['session'];
 
  $select_users = mysqli_query($conn, "SELECT * FROM `orden_pedidos` WHERE user_id = '$user_id'") or die('query failed');
  if(mysqli_num_rows($select_users) > 0){
     echo "<script>
     alert('¡Ups debes esperar que se atienda tu orden de pedido, para eliminar productos de tu carrito!');
     window.location= '../vista/V-products.php'
 </script>";
 
  }else{
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
    header('location:../vista/V-products.php');
  }
 

}

?>