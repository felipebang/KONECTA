<?php
include("../Modelo/conexion.php");
//Monto minimo
$objconexion = new conexion();
$valor_minimo = $objconexion->consultar("SELECT * FROM `gestionar_valores` WHERE id_valor = 11");

$objconexion = new conexion();
$valor_Domicilio = $objconexion->consultar("SELECT * FROM `gestionar_valores` WHERE id_valor = 22");

?>
