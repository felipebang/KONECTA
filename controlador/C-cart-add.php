<?php
include('../Modelo/config.php');
session_start();
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];

  $informacion = mysqli_query($conn, "SELECT * FROM `users` WHERE id = $user_id") or die('query failed');

  if (mysqli_num_rows($informacion) > 0) {

    $row = mysqli_fetch_assoc($informacion);
    //print_r($row);
    header('location:../vista/V-products.php');
  }
  //echo "Logueado";
}
//Caso en el que el usuario no este logueado

else {
  $user_id = "";
  //echo "Iniciar seccion";
}

//agregar al cart
if (isset($_POST['add_to_cart'])) {

  $product_id = $_POST['product_id'];
  $product_nombre = $_POST['product_nombre'];
  $product_precio = $_POST['product_precio'];
  $product_imagen = $_POST['product_imagen'];

  //Agregar cantidad //
  $product_quantity = 1;


  $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE nombre = '$product_nombre' AND user_id = '$user_id'") or die('query failed');

  if (mysqli_num_rows($check_cart_numbers) > 0) {
    $message[] = 'already added to cart';
  } else {

    if (isset($_SESSION['user_id'])) {
      $user_id = $_SESSION['user_id'];
      

      $select_users = mysqli_query($conn, "SELECT * FROM `orden_pedidos` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_users) > 0){
         echo "<script>
         alert('¡ups debes esperar que se atienda tu orden de pedido, para realizar nuevas ordenes!');
         window.location= '../vista/V-products.php'
     </script>";
     
      }else{
        mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, nombre, precio, quantity, imagen) VALUES('$user_id', '$product_id', '$product_nombre', '$product_precio', '$product_quantity', '$product_imagen')") or die('query failed');
        $message[] = 'product added to cart';
  
        header('location:../vista/V-products.php');
      }

    }

    //Caso en el que el usuario no este logueado

    else {
      $user_id = "";
      echo "<script>
      alert('Debes iniciar sesión');
      window.location= '../vista/V-products.php'
  </script>";
      //echo "Iniciar seccion";
    }
  }
}
else{
  header('location:../vista/V-products.php');
}
?>
