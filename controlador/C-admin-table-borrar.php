<?php
include('../Modelo/conexion.php');
if (isset($_GET['borrar'])) {
    $id = $_GET['borrar'];
    $objconexion = new conexion();
    $imagen = $objconexion->consultar("SELECT * FROM `proyectos` WHERE id=" . $id);
   // unlink("../imagenes/" . $imagen[0]['imagen']);

    $sql = "DELETE FROM `proyectos` WHERE `proyectos`.`id` =" . $id;
    $objconexion->ejecutar($sql);
    echo "<script>
            alert('Producto eliminado con éxito');
            window.location= '../vista/V-admin-table.php'
        </script>";
    //header("location:portafolio.php");
}else{
    header('location:../vista/V-admin-table.php');
}

?>
