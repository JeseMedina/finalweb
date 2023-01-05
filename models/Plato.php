<?php
require "../cofig/conexion.php";

Class Plato{
    public function __contruct(){}

    public function insertar($nombre,$descripcion,$precio,$imagen){
        $sql="INSERT INTO plato (nombre,precio,imagen,estado)
        VALUES ('$nombre','$precio','$imagen','1')";
        return ejecutarConsulta($sql);
    }

    public function editar($idplato,$descripcion,$nombre,$precio,$imagen){
        $sql="UPDATE plato SET nombre='$nombre',precio='$precio',imagen='$imagen' WHERE idplato='$idplato'";
        return ejecutarConsulta($sql);
    }

    public function desactivar($idplato)
    {
        $sql="UPDATE plato SET estado='0' WHERE idplato='$idplato'";
        return ejecutarConsulta($sql);
    }

    public function activar($idplato)
    {
        $sql="UPDATE plato SET estado='1' WHERE idplato='$idplato'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idplato)
    {
        $sql="SELECT * FROM plato WHERE idplato='$idplato'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar(){
        $sql="SELECT * FROM plato";
        return ejecutarConsulta($sql);
    }

    public function listarActivos(){
        $sql="SELECT * FROM plato WHERE estado='1'";
        return ejecutarConsulta($sql);
    }
}
?>