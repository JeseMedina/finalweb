<?php
require "../cofig/conexion.php";

Class Favorito{
    public function __contruct(){}

    public function insertar($idusuario,$idplato){
        $sql="INSERT INTO favorito (idusuario,idplato)
        VALUES ('$idusuario','$idplato')";
        return ejecutarConsulta($sql);
    }

    public function listar($idusuario){
        $sql="SELECT * FROM favorito WHERE idusuario='$idusuario'";
        return ejecutarConsulta($sql);   
    }

    public function eliminar($idusuario,$idplato){
        $sql="DELETE FROM favorito WHERE idusuario='$idusuario'";
    }
}
?>