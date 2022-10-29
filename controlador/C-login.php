<?php

include '../Modelo/config.php';

session_start();

if(isset($_POST['submit'])){

   if (($_POST['email'] == "admin@sistemas.com") && ($_POST['pass'] == "Sistemas")) {

      $_SESSION['usuario'] = "admin";

      header('location:../vista/V-admin-listado.php');
  }

   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');


   if(mysqli_num_rows($select_users) > 0){
      
      $row = mysqli_fetch_assoc($select_users);

      
if($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:../vista/V-products.php');
         //echo "logueado";
         


      }else{
         $message[] = 'no user found!';
      }

   }else{

      echo "<script>
      alert('Credenciales incorrectas');
      window.location='../vista/V-products.php'
      </script>";

   }

}else{
   header('location: ../vista/V-products.php');
}



?>
