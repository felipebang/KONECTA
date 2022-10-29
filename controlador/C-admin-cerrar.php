<?php

session_start();
session_destroy();
header("location:../vista/V-products.php");

?>