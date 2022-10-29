<?php
include('../Modelo/conexion.php');

if (isset($_GET['days'])) {
    //print_r($_GET);
    $id_day = $_GET['days'];


    $objconexion = new conexion();
    $sql = "DELETE FROM `ventas` WHERE `ventas` . `id_day` =  $id_day";
    $objconexion->ejecutar($sql);


    header('location: ../vista/V-admin-ventas.php');
} else {
    header('location:../vista/V-admin-ventas.php');
}
