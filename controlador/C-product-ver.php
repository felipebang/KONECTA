    <!--ver mas-->
    <?php
    //Mostrar productos Registrados
    include('../Modelo/config.php');

    $por_pagina = 4;
    if(isset($_GET['pagina'])){
      $pagina = $_GET['pagina'];
    }else{
      $pagina = 1;
    }
    $empieza = ($pagina-1) * $por_pagina;
    $select_products = ("SELECT * FROM `proyectos` LIMIT $empieza,$por_pagina") or die('query failed');
    $resultado = mysqli_query($conn,$select_products);

    ?>
    