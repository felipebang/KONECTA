<?php
include ('../Modelo/config.php');
include('../controlador/C-RegistroCliente.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Registro</title>
   <link rel="stylesheet" href="../CSS/estilo.css">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="../CSS/RegistroCliente.css">
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
   <a href="../vista/V-products.php">Regresar</a>
<section class="form-container">
<div class="cont-informacion">
   

   <form action="../controlador/C-RegistroCliente.php" method="post">
      <?php include('../Controlador/C-RegistroCliente.php') ?>
      <h1>Registrarme</h1>
      <div class="cont-input-one">
         <div>
            <label >Nombre</label></br>
      <input type="text" name="name" class="box" placeholder="Ingresa tu nombre" required>
      </div>
      <div>
         <label >Apellido</label>
      <input type="text" name="apellido" placeholder="Ingresa tu apellido" require>
      </div>


   <div>
      <label >Numero celular</label>
      <input type="number" name="celular"  placeholder="Ingresa tu numero celular"  maxlength="10" minlength="10" require>
      </div>
      </div>
      
      
      <div class="cont-input-two">
      <div>
         <label >Correo electronico</label>
      <input type="email" name="email" class="box" placeholder="Ingrese su correo" required>
      </div>
      
      
         <div>
            <label >Ingresa tu contraseña</label>
      <input  type="password" name="pass" class="box" placeholder="Ingrese su contraseña" maxlength="12" minlength="8" required>
      </div>
      <div>
         <label >Confirma tu contraseña</label>
      <input  type="password" name="cpass" class="box" placeholder="Confirmar contraseña" required>
      
      </div>
      </div>
      <div >
</br>
         <h3>Mi Dirección</h3>
         <div class="cuarta">
        <div>

         <label >Ciudad de residencia</label>
         <select name="ciudad" require>
   <option value="Palmira">Palmira</option>
  </select> 
  </div>
  <div>
  <label >Nombre de direccion</label>
  <select name="direccion" require>
   <option value="Calle">Calle</option>
   <option value="Carrera">Carrera</option>
   <option value="Avenida">Avenida</option>
   <option value="Avenida Carrera">Avenida Carrera</option>
   <option value="Avenida Calle">Avenida Calle</option>
   <option value="Circular">Circular</option>
   <option value="Circunvalar">Circunvalar</option>
   <option value="Diagonal">Diagonal</option>
   <option value="Manzana">Manzana</option>
   <option value="Transversal">Transversal</option>
   <option value="Via">Via</option>
  </select>
  
  </div>
  </div>
</br>
  
 <div class="quinto">
   <div>
      <label >Nombre de la dirección</label>
  <input type="text" name="ndireccion" placeholder="" require placeholder="41B">
  </div>
  <div>
  <label >Primer numero</label>
  <input type="number" name="ncasa" placeholder="" require placeholder="22">
  </div>
  <div>
  <label >Segundo numero</label>
  <input type="number" name="n1casa" placeholder="" require placeholder="34">
  </div>
  <div>
   <label >Barrio de residencia</label>
  <input type="text" name="barrio" placeholder="ingresa tu barrido de residencia" require>
  </div>
      </div>
      </div>
      <br>
      <div class="mb-3" id="check">
                <input type="checkbox" class="form-check-input" id="check" name="check" value="1">
                <label class="form-check-label" id="check-label" for="check">Acepto los terminos y condiciones</label>
            </div>


    <center>  <input type="submit" class="btn" name="submit" value="Registrarme"> </center>
     
   </form>
   </div>

</section>

</body>
</html>