<?php
include('../controlador/C-perfilUsuario-ver.php');
?>
<?php
//Actualizar
if (isset($_POST['Actualizar'])) {
    $exist_id = $_POST['idUsuario'];
    $New_ciudad = $_POST['ciudad']; //cuidad
    $New_direccion = $_POST['direccion']; //calle,carrera,avenida etc.
    $New_ndireccion = $_POST['ndireccion']; //Numero de la calle
    $New_ncasa = $_POST['ncasa']; //primer numero de la casa
    $New_n1casa = $_POST['n1casa']; //Segundo numero de la casa
    $New_barrio = $_POST['barrio']; //Bario vivienda

    //print_r($_POST);
    $sentencia = mysqli_query($conn, "UPDATE `users` SET `ciudad` = '$New_ciudad', `direccion` = '$New_direccion', `ndireccion` = '$New_ndireccion', `ncasa` = '$New_ncasa', `n1casa` = '$New_n1casa', `barrio` = '$New_barrio' WHERE `users`.`id` = $exist_id ;") or die('query failed');

    if ($sentencia = true) {
        echo "<script>
        alert('Direccion modificada con exito...');
        window.location= './V-perfil-usuario.php'
    </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../CSS/perfil.css">
    <!--cdn de iconos-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
      <!--Favicon-->
  <link rel="shortcut icon" href="../IMG/media.png" type="image/x-icon">
</head>

<body>
    <a class="regresar" href="./V-products.php">Regresar</a>

    <div class="cont-informacion">
        <?php foreach ($perfil as $info) { ?>
            <h1>Información personal</h1>

            <div class="cont-input-one">
                <div>
                    <label>Nombre de usuario</label><br>
                    <input type="text" value="<?php echo $info['name'] ?>" disabled><br>
                </div>

                <div>
                    <label>Apellido de usuario</label><br>
                    <input class="input-one" type="text" value="<?php echo $info['apellido'] ?>" disabled><br>
                </div>
            </div>

            <div class="cont-input-two">
                <div>
                    <label>Teléfono de usuario</label><br>
                    <input type="text" value="<?php echo $info['celular'] ?>" disabled><br>
                </div>

                <div>
                    <label>Correo electrónico</label><br>
                    <input type="text" value="<?php echo $info['email'] ?>" disabled><br>
                </div>
            </div>

            <div class="cont-input-tre">
                <div>
                    <label>Cuidad</label><br>
                    <input type="text" value="<?php echo $info['ciudad'] ?>" disabled><br>
                </div>

                <div>
                    <label>Dirección</label><br>
                    <input type="text" value="<?php echo $info['direccion'] . ',' . ' ' . $info['ndireccion'] . ' ' . '# ' . $info['ncasa'] . ' - ' . $info['n1casa']  ?>" disabled><br>
                </div>

                <div>
                    <label>Barrio</label><br>
                    <input type="text" value="<?php echo $info['barrio'] ?>" disabled><br>
                </div>

            </div>


            <form class="direct" action="./V-perfil-usuario.php" method="post">

            <div class="cerrar">
              <a href="./V-perfil-usuario.php"><i class="fa-solid fa-xmark"></i></a>
            </div>
                <h3>Modificar dirección</h3>

                <input type="hidden" name="idUsuario" value="<?php echo $info['id']; ?>">

                <div class="cont-select">
                    <label for="ciudad">Ciudad</label>
                    <select name="ciudad" id="">
                        <option value="Palmira">Palmira</option>
                    </select>


                    <label for="direccion">Direccion</label>
                    <select name="direccion" id="">
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


                <div class="cont-tres">
                    <label for="ndireccion">No.</label>
                    <input type="text" name="ndireccion" value="<?php echo $info['ndireccion']; ?>">

                    <label for="ncasa">#</label>
                    <input type="text" name="ncasa" value="<?php echo $info['ncasa']; ?>">

                    <label for="n1casa">-</label>
                    <input type="text" name="n1casa" value="<?php echo $info['n1casa']; ?>">
                </div>

                <div class="cont-barrio">
                    <label for="barrio">Barrio</label>
                    <input type="text" name="barrio" value="<?php echo $info['barrio']; ?>">
                </div>

                <button type="submit" name="Actualizar">Actualizar</button>

            </form>


            <button class="form-direct">Cambiar direccion</button>

        <?php } ?>
    </div>

    <script src="../JS/perfilUsuario.js"></script>
</body>

</html>