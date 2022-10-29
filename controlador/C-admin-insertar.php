<?php
include('../Modelo/conexion.php');
include('../Modelo/config.php');


if (isset($_POST['agregar'])) {
    //print_r($_POST);
    $nombre = $_POST['nombre'];
   // $imagen = $_POST['imagen'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $date = date("Y-m-d");
 
    $peso = $_POST['peso'];
    $cantidad = $_POST['cantidad'];
    $categoria = $_POST['categoria'];
   

    $validar = mysqli_query($conn, "SELECT * FROM `proyectos` WHERE nombre = '$nombre'") or die('query failed');

    if (mysqli_num_rows($validar) > 0) {
        echo "<script>
        alert('¡Este producto ya existente!');
        window.location= '../vista/V-admin-insertar.php'
    </script>";
    }
  

    else {
        $fecha = new DateTime();

       

        $objconexion = new conexion();
    
        $sql="INSERT INTO `proyectos`(`nombre`,`imagen`, `descripcion`, `precio`, `peso`, `categoria`, `date`, `cantidad`) 
        VALUES ('$nombre', '', '$descripcion', '$precio', '$peso',   '$categoria', '$date',  '$cantidad')";

        $objconexion->ejecutar($sql);


        echo "<script>
            alert('Producto Registrado con Éxito');
            window.location= '../vista/V-admin-insertar.php'
        </script>";
    }

    //header("location:portafolio.php");
} else {
    header("location:../vista/V-admin-table.php");
}
