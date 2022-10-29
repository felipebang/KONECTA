<?php
include('../controlador/C-admin-table-ver.php');

session_start();
if (isset($_SESSION['usuario']) != "admin") {
    header("location:./V-products.php");
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
                <li><a class="activo" href="#">Tabla de acciones</a></li>
                <li><a href="./V-admin-listado.php">Lista de productos</a></li>
                <li><a href="./V-admin-ordenes.php">Ordenes de pedidos</a></li>
                <li><a href="./V-admin-gestionar-valores.php">stock Gestionar valores</a></li>
                <li><a href="./V-admin-ventas.php">Visualizar ventas</a></li>

            </ul>
            <!--  <a href="./cerrar.php">Cerrar Sesion</a>-->

        </nav>

        <section>

            <?php if (mysqli_num_rows($resultado) > 0) { ?>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th class="td-descrip">Descripción</th>
                            <th>Precio</th>
                            <th>cantidad</th>
                            <th>fecha</th>
                            <th>categoria</th>
                            <th>Eliminar</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($proyectos = mysqli_fetch_assoc($resultado)) { ?>
                            <tr>
                                <td><?php echo $proyectos['id']; ?></td>
                                <td><?php echo $proyectos['nombre']; ?></td>
                                <td class="td-descrip"><?php echo $proyectos['descripcion']; ?></td>
                                <td><?php echo number_format($proyectos['precio']); ?></td>
                                <td><?php echo $proyectos['cantidad']; ?></td>
                                <td><?php echo $proyectos['date']; ?></td>
                                <td><?php echo $proyectos['categoria']; ?></td>
                                <td>
                                    <center><a class="btn-denger" onclick="return confirm('Desea eliminar este producto?');" href="../controlador/C-admin-table-borrar.php?borrar=<?php echo $proyectos['id']; ?>">Eliminar</a></center>
                                </td>
                                <td>
                                    <form class="form-portafolio" action="../controlador/C-admin-editar.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $proyectos['id']; ?>">
                                        <input type="hidden" name="nombre" value="<?php echo $proyectos['nombre']; ?>">
                                        <input type="hidden" name="descripcion" value="<?php echo $proyectos['descripcion']; ?>"/>
                                        <input type="hidden" name="precio" value="<?php echo $proyectos['precio']; ?>">
                                        <input type="hidden" name="cantidad" value="<?php echo $proyectos['cantidad']; ?>">
                                        <input type="hidden" name="date" value="<?php echo $proyectos['date']; ?>"/>
                                        <input type="hidden" name="peso" value="<?php echo $proyectos['peso']; ?>">
                                        <input type="hidden" name="categoria" value="<?php echo $proyectos['categoria']; ?>"/>
                                      
                                     

                                        <input type="hidden" name="editarProduct" value="editarProduct">

                                        <input class="btn-portafolio" type="submit" value="Modificar" name="submit">
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else {
                echo "<h1 style='color:red;'>¡Ups no tienes productos para realizar acciones!</h1>";
            }
            ?>

        </section>


    </div>



</body>

</html>