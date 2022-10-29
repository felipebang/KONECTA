<?php
session_start();
if (isset($_SESSION['usuario']) != "admin") {
    header("location:./V-products.php");
}
?>

<?php
include ("../controlador/C-admin-view-day.php");

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
    <style>
        .cont-days{
            margin: 10px;
            border: solid black 1px;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #A7B1AA;
            flex-direction: column;
            width: 20%;
            padding: 10px 0;
        }
    </style>
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
                <li><a href="./V-admin-gestionar-valores.php">stock Gestionar valores</a></li>
                <li><a class="activo" href="#">Visualizar ventas</a></li>


            </ul>
            <!--  <a href="./cerrar.php">Cerrar Sesion</a>-->

        </nav>

        <section>
                <?php foreach($days as $result) { ?>
                    <div class="cont-days">
                        <h1><?php echo $result['name_day'] ?></h1>
                        <p>Ventas del dia: <?php echo $result['name_day'] ?></p><br>
                        <a  class="btn btn-success" href="./V-admin-days.php?days=<?php echo $result['id_day'] ?>">Vizualizar</a>
                    </div>

                <?php } ?>

        </section>
    </div>

</body>

</html>