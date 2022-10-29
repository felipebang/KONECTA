<?php
    include('../Modelo/conexion.php');

if(isset($_GET['indentity'])){
    print_r($_GET);
    $id = $_GET['indentity'];

    // Funcion para obtener la zona horaria
    date_default_timezone_set("America/Bogota");
    // guardo el dia 
    $dia = date("D");
    // guardo el formato de fecha
    $fecha = date("d/m/Y");
    // guardo el formato de horas
    $hora = date("h:i a");
    // concateno la fecha y la hora 
    $fechaYhora = $fecha.' '.$hora;


    // validamos el dia y acorde el dia que obtengamos asignamos un number
    if($dia == "Mon"){
        $dia = 1;
        echo $dia;
    }elseif($dia == "Tue"){
        $dia = 2;
        echo $dia;

    }elseif($dia == "Wed"){
        $dia = 3;
        echo $dia;

    }elseif($dia == "Thu"){
        $dia = 4;
        echo $dia;

    }elseif($dia == "Fri"){
        $dia = 5;
        echo $dia;

    }elseif($dia == "Sat"){
        $dia = 6;
        echo $dia;

    }elseif($dia == "Sun"){
        $dia = 7;
        echo $dia;
    }

    // instancia de la class conexion
    $objconexion = new conexion();
    // Consulta para obtener todo los datos de la tabla car
    $resultado = $objconexion->consultar("SELECT * FROM `cart` WHERE user_id = '$id'") or die('query failed');
    // Recorremos el array que contiene la variable $resultado
    foreach($resultado as $result){
        $name_product = $result['nombre'];
        $price_product = $result['precio'];
        $quantity = $result['quantity'];
        $user_id = $result['user_id'];

        // insertamos cada registro por cada vuelta que de el foreach
        $objconexion = new conexion();
        $sql = "INSERT INTO `ventas` (`id_venta`, `name_product`, `price_product`, `quantity`,`fecha_venta`, `user_id`, `id_day`) VALUES (NULL, '$name_product', '$price_product', '$quantity','$fechaYhora', '$user_id', '$dia');";
        $objconexion->ejecutar($sql);

    }
    header('location: ../vista/V-admin-days.php?days='.$dia);
 
   
}else{
    header('location: ../vista/V-admin-listado.php');
}
