<?php
session_start();
if (isset($_SESSION['usuario']) != "admin") {
    header("location:./V-products.php");
}
?>

<?php
include("../Modelo/config.php");

if (isset($_GET['days'])) {
    // print_r($_GET['days']);
    $id_day = $_GET['days'];

    // Consulta para obtener todo los datos de la tabla car
    $resultado = mysqli_query($conn, "SELECT * FROM `ventas` WHERE id_day = $id_day;") or die('query failed');
    $grand_total = 0;

    
    $days = mysqli_query($conn, "SELECT * FROM `day` WHERE id_day = $id_day;") or die('query failed');
    if (mysqli_num_rows($days) > 0) {
        while ($dia = mysqli_fetch_assoc($days)) {
            $diaSemana = $dia['name_day'];
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro ventas</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        .table{
            width: 80%;
            margin: 20px auto;
            border: 1px solid black;
        }
    </style>

</head>

<body>
    
    <h1>Ventas de este dia (<?php echo $diaSemana; ?>)</h1>

    <?php if (mysqli_num_rows($resultado) > 0) { ?>
        <table  class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" >#</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Sub total</th>
                    <th scope="col">Fecha de venta</th>
                    <th scope="col">Codigo del usuario</th>

                </tr>
            </thead>
            <tbody>
                <?php while ($proyectos = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td><?php echo $proyectos['id_venta']; ?></td>
                        <td><?php echo $proyectos['name_product']; ?></td>
                        <td><?php echo $proyectos['price_product']; ?></td>
                        <td><?php echo $proyectos['quantity']; ?></td>
                        <td><?php echo $total = $proyectos['price_product'] * $proyectos['quantity']; ?></td>
                        <td><?php echo $proyectos['fecha_venta']; ?></td>
                        <td><button class="btn btn-info" ><?php echo $proyectos['user_id']; ?></button></td>

                        <?php $grand_total += $total; ?>
                    </tr>

                <?php } ?>
                <tr>

                        <td></td>
                        <td></td>
                        <td></td>
                        <th scope="row">Total de ventas</th>
                        <td><h5>$ <?php echo number_format($grand_total); ?></h5></td>

                        <td><a  class="btn btn-success" href="./Reporte-venta.php?days=<?php echo $id_day; ?>">Descargar reporte</a></td>
 

                        <td><a  onclick="return confirm('Antes de eliminar este reporte diario asegurate de haber descargado el reporte?');" class="btn btn-danger" href="../controlador/C-admin-eliminar-reportes.php?days=<?php echo $id_day; ?>">Eliminar reporte diario</a></td>



                    </tr>
            </tbody>
        </table>
    <?php } else {
        echo "<h1 style='color:red;'>¡No hay ventas por ahora!</h1>";
    }
    ?>

</body>

</html>