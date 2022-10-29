<?php
    include('../Modelo/conexion.php');

    $objconexion = new conexion();
    // Consulta para obtener todo los datos de la tabla car
    $days = $objconexion->consultar("SELECT * FROM `day`");

?>