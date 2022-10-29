<?php
ob_start();
?>


<?php
include("../Modelo/config.php");

if (isset($_GET['days'])) {
    // print_r($_GET['days']);
    $id_day = $_GET['days'];

    // Consulta para obtener todo los datos de la tabla car
    $resultado = mysqli_query($conn, "SELECT * FROM `ventas` WHERE id_day = $id_day;") or die('query failed');
    $grand_total = 0;

    // SELECT * FROM `day`

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
    <title>Reprortes</title>

    <style>
        table {
            background-color: rgb(230, 225, 225);
            width: 100%;
            border-radius: none;
        }

        th {
            background-color: #E0E4E5;
            padding: 10px 5px;
            border-radius: 2px;
            color: rgb(0, 0, 0);
            font-weight: 300;
            font-size: 15px;

        }

        td {
            background-color: white;
            padding: 0 5px;
            font-size: 13px;
            text-align: justify;
            border-radius: 2px;
            font-size: 16px;


        }

        td button {
            border: none;
            background-color: red;
            color: white;
            font-size: 16px;
            border-radius: 2px;
        }
    </style>

</head>

<body>
    <center>
        <h1>Reportes del dia (<?php echo $diaSemana; ?>)</h1>
    </center>

    <?php if (mysqli_num_rows($resultado) > 0) { ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
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
                        <td><button class="btn btn-info"><?php echo $proyectos['user_id']; ?></button></td>

                        <?php $grand_total += $total; ?>
                    </tr>

                <?php } ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <th scope="row">Total de ventas</th>
                    <td style="color:red; font-weight: bold;"><?php echo number_format($grand_total); ?></td>
                    <td></td>
                    <td></td>

                </tr>
            </tbody>
        </table>
    <?php } else {
        echo "<h1 style='color:red;'>¡No hay ventas por ahora!</h1>";
    }
    ?>

</body>

</html>



<?php
$html = ob_get_clean();
//echo $html;
require_once '../dompdf/autoload.inc.php';


use Dompdf\Dompdf;

$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);


$dompdf->loadHtml($html);

$dompdf->setPaper('letter');

$dompdf->render();

$dompdf->stream("Reportes de ventas.pdf", array("Attachment" => true));


?>