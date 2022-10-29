<?php
include('../Modelo/config.php');

if(isset($_POST['validar'])){
    //print_r($_POST);
    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);
    $filter_celular = filter_var($_POST['celular'], FILTER_SANITIZE_STRING);
    $celular = mysqli_real_escape_string($conn, $filter_celular);

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND celular = '$celular'") or die('query failed');
}else{
   header('location:../vista/V-Recuperar-Contrasena.php');
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Validacion</title>
   <link rel="stylesheet" href="../CSS/validacion-recuperar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

</head>
<body>
<?php  
if(mysqli_num_rows($select_users) > 0){ 
   $row = mysqli_fetch_assoc($select_users);

   if($row['user_type'] == 'user'){
      $id = $row['id'];
   
?>

<div class="cont-modal-validar">

<form action="../vista/V-nueva-contrasena.php" method="get">
      
      <input type="hidden" name="id" value="<?php echo $id; ?>" >
      <a href="../vista/V-products.php"><i class="fa-solid fa-xmark"></i></a>
      <h3>¿Desear realmente reasignar tu contraseña?</h3>
      <div class="cont-btn">
      <a  class="cancelar" href="../vista/V-products.php">Cancelar</a>
      <button type="submit" name="identificador" >Aceptar</button>

      </div>
   </form>

</div>



<?php }
}  else{
   echo "<script>
   alert('Credenciales incorrectas');
   window.location='../vista/V-Recuperar-Contrasena.php'
   </script>";
}  ?>
   
</body>
</html>

