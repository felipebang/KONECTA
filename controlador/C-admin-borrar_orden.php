<?php
include('../Modelo/conexion.php');

if(isset($_GET['Remover_orden'])){
    //print_r($_GET);
    $id = $_GET['Remover_orden'];


$objconexion = new conexion();
$sql = "DELETE FROM `orden_pedidos` WHERE `orden_pedidos` . `idPedido` =  $id";
$objconexion->ejecutar($sql);

echo "<script>
alert('Orden eliminada exitosamente');
window.location='../vista/V-admin-ordenes.php'
</script>";



}
else{
    header('location:../vista/V-admin-ordenes.php');
}
?>