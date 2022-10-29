<?php
include('../Modelo/config.php');

 if(isset($_POST['Restablecer'])){
    $filter_pass = filter_var($_POST['contrasenia_1'], FILTER_SANITIZE_STRING);
    $pass = mysqli_real_escape_string($conn, md5($filter_pass));
    $filter_cpass = filter_var($_POST['contrasenia_2'], FILTER_SANITIZE_STRING);
    $cpass = mysqli_real_escape_string($conn, md5($filter_cpass));
    $ident = $_POST['id'];
    //print_r($_POST);
    if($pass != $cpass){
        echo "<script>
        alert('confirmar contraseña no coincide!');
        window.location= '../vista/V-recuperar-contrasena.php'
    </script>";
     }else{
        mysqli_query($conn, "UPDATE `users` SET `password` = '$cpass' WHERE `users`.`id` = $ident") or die('query failed');
        echo "<script>
        alert('¡Registrado correctamente!');
        window.location= '../vista/V-products.php'
    </script>";
     }
 }

 
?>