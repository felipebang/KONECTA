<?php
class conexion{
    private $servidor="localhost";
    private $usuario="root";
    private $contrasenia="";
    private $conexion;

    public function __construct(){
        try{
            $this->conexion= new PDO("mysql:host=$this->servidor;dbname=shop_db",$this->usuario,$this->contrasenia);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch( PDOException $e){   
        return "falla de conexion".$e;

        }
    }
    public function ejecutar($sql){
        $this->conexion->exec($sql);
        return $this->conexion->lastInsertId();
    }
    public function consultar($sql){
        $sentencia=$this->conexion->prepare($sql);
        $sentencia->execute();
        return $sentencia->fetchAll();
    }
}
?>