
<?php 
include('../Modelo/conexion.php'); 
include('../Modelo/config.php');
session_start();
if (isset($_SESSION['usuario']) != "admin") {
  header("location:../vista/V-products.php");
}


?>

<?PHP

if ( isset($_POST['id']) ) {
  //Ejecutamos Datos actualizados
  echo "<pre>";
  printf($_POST['id']);
  
  echo "</pre>";
  
    print_r($_GET);
    $id = $_POST['id'];
    $nombre = $_POST["nombre"];
    $descripcion = $_POST['descripcion'];
    $date = date("Y-m-d");
    $precio = $_POST['precio'];
    $peso = $_POST['peso'];
    $categoria = $_POST['categoria'];
    $cantidad = $_POST['cantidad'];
    
 

  $objconexion = new conexion();
  $sql = "UPDATE `proyectos` SET `nombre` = '$nombre',   `descripcion` = '$descripcion',
            `precio` ='$precio' , `cantidad` = '$cantidad',  `date` = '$date', 
            `categoria` = '$categoria'  WHERE `proyectos`.`id` = $id ;";

       
  $objconexion->ejecutar($sql);

         echo "<script>
        alert('Producto modificado con éxito');
        window.location= '../vista/V-admin-table.php'
        </script>";
       
        

}

?>

