<?php

include '../Modelo/config.php';


if(isset($_POST['submit'])){

   $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $name = mysqli_real_escape_string($conn, $filter_name);
   $filter_apellido = filter_var($_POST['apellido'], FILTER_SANITIZE_STRING);
   $apellido = mysqli_real_escape_string($conn, $filter_apellido);
   $filter_celular = filter_var($_POST['celular'], FILTER_SANITIZE_STRING);
   $celular = mysqli_real_escape_string($conn, $filter_celular);
   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));
   $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
   $cpass = mysqli_real_escape_string($conn, md5($filter_cpass));
   $filter_ciudad = filter_var($_POST['ciudad'], FILTER_SANITIZE_STRING);
   $ciudad = mysqli_real_escape_string($conn, $filter_ciudad);
   $filter_direccion = filter_var($_POST['direccion'], FILTER_SANITIZE_STRING);
   $direccion = mysqli_real_escape_string($conn, $filter_direccion);
   $filter_ndireccion = filter_var($_POST['ndireccion'], FILTER_SANITIZE_STRING);
   $ndireccion = mysqli_real_escape_string($conn, $filter_ndireccion);
   $filter_ncasa = filter_var($_POST['ncasa'], FILTER_SANITIZE_STRING);
   $ncasa = mysqli_real_escape_string($conn, $filter_ncasa);
   $filter_n1casa = filter_var($_POST['n1casa'], FILTER_SANITIZE_STRING);
   $n1casa = mysqli_real_escape_string($conn, $filter_n1casa);
   $filter_barrio = filter_var($_POST['barrio'], FILTER_SANITIZE_STRING);
   $barrio = mysqli_real_escape_string($conn, $filter_barrio);

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

   $errors = array(
      'name'=> false,
      'apellido'=> false,
      
      'email'=> false,
      'pass'=> false,
      'cpass'=> false,
      'ndireccion' => false,
      'barrio' => false,
      'check' => false,
);

// Validations for errors

if(!preg_match("/^([A-Za-zÑñÁáÉéÍíÓóÚú]+['\-]{0,1}[A-Za-zÑñÁáÉéÍíÓóÚú]+)(\s+([A-Za-zÑñÁáÉéÍíÓóÚú]+['\-]{0,1}[A-Za-zÑñÁáÉéÍíÓóÚú]+))*$/", $name)){
  $errors['name'] = true;
}

if(!preg_match("/^([A-Za-zÑñÁáÉéÍíÓóÚú]+['\-]{0,1}[A-Za-zÑñÁáÉéÍíÓóÚú]+)(\s+([A-Za-zÑñÁáÉéÍíÓóÚú]+['\-]{0,1}[A-Za-zÑñÁáÉéÍíÓóÚú]+))*$/", $apellido)){
  $errors['apellido'] = true;
}



if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
  $errors['email'] = true;
}



if(!preg_match("/^([A-Za-zÑn0-9]{1,10})*$/", $pass)){
   $errors['pass'] = true;
}

if(!preg_match("/^([A-Za-zÑn0-9]{1,10})*$/", $ndireccion)){
   $errors['ndireccion'] = true;
}

if(!preg_match("/^([A-Za-zÑñÁáÉéÍíÓóÚú]+['\-]{0,1}[A-Za-zÑñÁáÉéÍíÓóÚú]+)(\s+([A-Za-zÑñÁáÉéÍíÓóÚú]+['\-]{0,1}[A-Za-zÑñÁáÉéÍíÓóÚú]+))*$/", $barrio)){
   $errors['barrio'] = true;
}

if($pass != $cpass){
  $errors['cpass'] = true;
}

if($check =! 1){
  $errors['cpass'] = true;
}

if(!isset($_POST['check']) || $_POST['check'] != 1){
  $errors['check'] = true;
}

if (array_search(true, $errors) != false){

  if($errors['name'] == true){
      echo "<div class=\"alert alert-danger\" role=\"alert\">
              Nombre incorrecto
          </div>
      ";
  }

  if($errors['apellido'] == true){
      echo "<div class=\"alert alert-danger\" role=\"alert\">
              Apellido incorrecto
          </div>
      ";
  }

  

  if($errors['email'] == true){
      echo "<div class=\"alert alert-danger\" role=\"alert\">
              Correo incorrecto
          </div>
      ";
  }

  if($errors['pass'] == true){
      echo "<div class=\"alert alert-danger\" role=\"alert\">
              Contraseña debil, intente con Mayusculas y digitos
          </div>
      ";
  }

  if($errors['cpass'] == true){
      echo "<div class=\"alert alert-danger\" role=\"alert\">
              Las contraseñas no coinciden
          </div>
      ";
  }

  

  if($errors['ndireccion'] == true){
      echo "<div class=\"alert alert-danger\" role=\"alert\">
      Nombre de direccion incorrecto
      </div>
      ";
  }

  if($errors['barrio'] == true){
      echo "<div class=\"alert alert-danger\" role=\"alert\">
      Nombre del barrio incorrecto
      </div>
      ";
  }

  if($errors['check'] == true){
      echo "<div class=\"alert alert-danger\" role=\"alert\">
              Debe aceptar los terminos y condiciones
          </div>
      ";
  }

  if(mysqli_num_rows($select_users) > 0){
      $message[] = '¡usuario ya existente!';
      echo "<script>
      alert('¡usuario ya existente!');
      window.location= '../Vista/V-RegistroClientes.php'
  </script>";
  }



}
else{
  mysqli_query($conn, "INSERT INTO `users`(name, apellido, celular, email, password, ciudad, direccion, ndireccion, ncasa, n1casa, barrio) VALUES('$name', '$apellido', '$celular', '$email', '$pass', '$ciudad', '$direccion', '$ndireccion', '$ncasa', '$n1casa', '$barrio')") or die('query failed');
echo 
"<script>
  alert ('Registrado con éxito');
  window.location='../Vista/V-products.php'
  
  </script>
  ";

 
}

}

?>