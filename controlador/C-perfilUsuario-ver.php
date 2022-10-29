<?php
session_start();

include('../Modelo/config.php');

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
  header('location:../vista/V-products.php');
}

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $perfil = mysqli_query($conn, "SELECT * FROM `users` WHERE id = $user_id") or die('query failed');
  foreach($perfil as $fact){
    
  }
}


?>