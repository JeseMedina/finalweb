<?php
require "../config/conexion.php";

Class Favorito{
    public function __contruct(){}

    public function insertar($idusuario,$idplato){
        $sql="INSERT INTO favorito (idusuario,idplato)
        VALUES ('$idusuario','$idplato')";
        return ejecutarConsulta($sql);
    }

    public function listar($idusuario){
        $sql="SELECT p.nombre,p.precio,p.imagen FROM favorito f INNER JOIN plato p ON f.idplato = p.idplato WHERE f.idusuario='$idusuario' AND p.estado = 1";
        return ejecutarConsulta($sql);   
    }

    public function listarTodos($idusuario){
        $sql="SELECT p.nombre,p.precio,p.imagen,p.estado FROM favorito f INNER JOIN plato p ON f.idplato = p.idplato WHERE f.idusuario='$idusuario'";
        return ejecutarConsulta($sql);   
    }

    public function eliminar($idusuario,$idplato){
        $sql="DELETE FROM favorito WHERE idusuario='$idusuario'";
    }
}
?>