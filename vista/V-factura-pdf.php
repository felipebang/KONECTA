<?php
ob_start();
?>

<?php include('../controlador/C-perfilUsuario-ver.php') ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: roboto;
        }

        .cont-center {
            border: 1px black solid;
            border-radius: 2px;
            padding: 10px;
            width: 80%;
            margin: 50px auto;
            position: relative;
            overflow: hidden;
        }

        .cont-datos {
            /*background: red;*/
            width: 100%;
            position: relative;
            overflow: hidden;
            padding: 10px;
            margin: 25px 0 0 0;
        }

        .cont-datos-1 {
            /*background: blue;*/
            width: 50%;

        }

        .cont-datos-2 {
            /*background: yellow;*/
            width: 50%;
            position: absolute;
            top: 0;
            right: 0;
        }

        .cont-tabla {
            width: 100%;
        }

        .cont-tabla .table {
            width: 80%;
            margin: auto;
            padding: 10px;
        }

        .cont-tabla .table thead tr th {
            border-bottom: 1px solid black;
            text-align: left;
            background-color: white;
            font-size: 15px;
            padding: 5px;
            text-transform: uppercase;
        }

        .cont-tabla .table tbody tr th {
            text-align: left;

        }

        .cont-tabla .table tbody tr td {
            text-align: left;
            background-color: white;
            font-weight: 400;
            font-size: 15px;


        }

        .red {
            color: red;

        }

        img {
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
        }
    </style>
</head>

<body>

    <div class="cont-center">
        <?php foreach ($perfil as $fact) {




        ?>

            <div class="cont-cabecera">
                <i>
                    <h3>Usuario: <?php echo $fact['name'] . ' ' . $fact['apellido'] ?></h3>
                </i>
                <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/proyectos/Agromprenx/IMG/logo.jpeg" alt="">


                <div class="cont-datos">

                    <div class="cont-datos-1">

                        <p>
                            <b>
                                Fecha y hora:
                            </b>
                            <?php
                            date_default_timezone_set("America/Bogota");
                            $fecha = date("d/m/Y");
                            $hora = date("h:i a");
                            echo $fecha . ' ' . $hora;

                            ?>
                        </p>
                        <p><b>Teléfono:</b> <?php echo $fact['celular'] ?></p>
                        <p><b>Correo:</b> <?php echo $fact['email'] ?></p>

                    </div>

                    <div class="cont-datos-2">


                        <p><b>Dirección:</b> <?php echo $fact['direccion'] . ', ' . $fact['ndireccion'] . ' # ' . $fact['ncasa'] . ' - ' . $fact['n1casa'] ?></p>
                        <p><b>Ciudad:</b> <?php echo $fact['ciudad'] ?></p>
                        <p><b>Barrio:</b> <?php echo $fact['barrio'] ?></p>

                    </div>

                </div>
            </div>

        <?php  } ?>

        <hr>

        <div class="cont-tabla">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nombre del producto</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>


                    <?php
                    if (isset($_GET['pedido'])) {
                        //  print_r($_GET);
                        $id = $_GET['pedido'];

                        include('../Modelo/config.php');

                        $ids = 0;
                        $grand_total = 0;
                        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$id'") or die('query failed');
                        if (mysqli_num_rows($select_cart) > 0) {
                            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                                $total_price = ($fetch_cart['precio'] * $fetch_cart['quantity']);
                                $grand_total += $total_price;
                                //$id = $fetch_cart['pid'];
                    ?>
                                <tr>
                                    <td><?php echo $fetch_cart['nombre']; ?></td>
                                    <td><?php echo number_format($fetch_cart['precio']) ?></td>
                                    <td><?php echo $fetch_cart['quantity']; ?> Lb</td>
                                    <td><?php echo number_format($total = $fetch_cart['quantity'] * $fetch_cart['precio']); ?></td>
                                    <?php $grand_total + $total; ?>
                                </tr>

                    <?php
                            }
                        } else {
                            echo '<p class="empty">your cart is empty</p>';
                        }
                    } else {
                        header('location:./V-products.php');
                    }
                    ?>

                    <tr>
                        <th scope="row">Domicilio</th>
                        <td class="red">
                            <strong>
                                $
                                <?php
                           
                                //Monto Domicilio
                                include("../Modelo/conexion.php");
                                $objconexion = new conexion();
                                $valor_Domicilio = $objconexion->consultar("SELECT * FROM `gestionar_valores` WHERE id_valor = 22");
                                
                                foreach($valor_Domicilio as $minimo){
                                    $envio = $minimo['Valor_Domicilio_Minimo'];
                                    
                                  }
                                
                                echo number_format($envio);
                                ?>
                            </strong>
                        </td>


                    </tr>

                    <tr>
                        <th scope="row">Total a pagar</th>
                        <td class="red"><strong>$ <?php echo number_format($grand_total + $envio); ?></strong></td>


                    </tr>

                </tbody>
            </table>

        </div>

    </div>


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

$dompdf->stream("factura-pedido.pdf", array("Attachment" => true));


?>