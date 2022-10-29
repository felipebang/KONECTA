<?php
session_start();
if (isset($_SESSION['usuario']) != "admin") {
    header("location:./V-products.php");
}

?>

<?php
include("../controlador/C-admin-gestionar_valores-ver.php");
if(isset($_POST['Act_domicilio'])){
    $valor_Domicilio_Actualizar = $_POST['domicilio'];
    $valor_id = $_POST['id_domicilio'];
    echo $valor_Domicilio_Actualizar . $valor_id;

    $objconexion = new conexion();
    $sql = "UPDATE `gestionar_valores` SET `Valor_Domicilio_Minimo` = '$valor_Domicilio_Actualizar' WHERE `gestionar_valores`.`id_valor` = $valor_id;";
    $objconexion->ejecutar($sql);
    header("location: ./V-admin-gestionar-valores.php");
    
}

if(isset($_POST['Act_minimo'])){
    $valor_minimo_Actualizar = $_POST['minimo'];
    $valor_id_minimo = $_POST['id_minimo'];
    echo $valor_minimo_Actualizar . $valor_id_minimo;

    $objconexion = new conexion();
    $sql = "UPDATE `gestionar_valores` SET `Valor_Domicilio_Minimo` = '$valor_minimo_Actualizar' WHERE `gestionar_valores`.`id_valor` = $valor_id_minimo;";
    $objconexion->ejecutar($sql);
    header("location: ./V-admin-gestionar-valores.php");
    
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracion</title>
    <link rel="stylesheet" href="../CSS/admin-style.css">
      <!--Favicon-->
  <link rel="shortcut icon" href="../IMG/media.png" type="image/x-icon">
</head>

<body>

    <div class="cont-dashboard">
        <div class="con-cerrar">
            <div class="con-user">
                <img src="../IMG/user-solid (1).svg" alt="">
                <a href="../controlador/C-admin-cerrar.php">Cerrar sesión</a>
            </div>
        </div>
        <nav>

            <ul>
                <li><a href="./V-admin-insertar.php">Agregar productos</a></li>
                <li><a href="./V-admin-table.php">Tabla de acciones</a></li>
                <li><a href="./V-admin-listado.php">Lista de productos</a></li>
                <li><a href="./V-admin-ordenes.php">Ordenes de pedidos</a></li>
                <li><a class="activo" href="#">stock Gestionar valores</a></li>
                <li><a href="./V-admin-ventas.php">Visualizar ventas</a></li>


            </ul>
            <!--  <a href="./cerrar.php">Cerrar Sesion</a>-->

        </nav>

        <section>

            <div class="cont-values__domicilio">
                <?php foreach ($valor_Domicilio as $Domicilio) { ?>

                <form style="padding: 10px; margin: 0 10px;height: 150px;" action="./V-admin-gestionar-valores.php" method="post">
                <h1>Domicilios: <i><?php echo number_format($Domicilio['Valor_Domicilio_Minimo']); ?></i></h1>
                
                <h3 class="sub-domicilio">¿Deseas modificar el costo del domicilio?</h3>

                    <input type="number" name="domicilio" value="<?php echo $Domicilio['Valor_Domicilio_Minimo']; ?>" >
                    <input type="hidden" name="id_domicilio" value="<?php echo $Domicilio['id_valor']; ?>" >

                    <button style="height: 30px;cursor:pointer;background:green;border:none;color:white;" type="submit" onclick="return confirm('¿Desea Modificar el valor del domicilio actual?');" name="Act_domicilio" >Actualizar</button>

                </form>
                <?php } ?>

            </div>

            <div class="cont-values__minimo">
            <?php foreach ($valor_minimo as $minimo) { ?>

           

                <form style="padding: 10px; margin: 0 10px;height: 150px;" action="./V-admin-gestionar-valores.php" method="post">
                <h1>Monto minimo: <i><?php echo number_format($minimo['Valor_Domicilio_Minimo']); ?></i></h1>
            <p class="valor_minimo"></p>
                <h3 class="sub-minimo">¿Deseas modificar el monto mínimo, para que los clientes realicen sus órdenes de pedidos?</h3>

                    <input type="number" name="minimo" value="<?php echo $minimo['Valor_Domicilio_Minimo']; ?>" >
                    <input type="hidden" name="id_minimo" value="<?php echo $minimo['id_valor']; ?>" >

                    <button style="height: 30px;cursor:pointer;background:green;border:none;color:white;" type="submit" onclick="return confirm('¿Desea Modificar el valor minimo actual?');" name="Act_minimo" >Actualizar</button>

                </form>
                <?php } ?>

            </div>
            
        </section>
    </div>

</body>

</html>