<?php
include('../Modelo/config.php');

    

$resultado = mysqli_query($conn, "SELECT * FROM `proyectos`") or die('query failed');


?>
