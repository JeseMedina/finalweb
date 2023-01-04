<?php 

require "../config/Conexion.php";
 
Class Usuario{
    public function __construct()
    {
 
    }

    public function insertar($usuario,$contrasena,$nombre,$celular,$direccion)
    {
        $sql="INSERT INTO usuario (usuario,contrasena,nombre,celular,direccion,tipo)
        VALUES ('$usuario','$contrasena','$nombre','$celular','$direccion','cliente')";
        return ejecutarConsulta($sql);
    }

    public function editar($idusuario,$contrasena,$nombre,$celular,$direccion){
        $sql="UPDATE usuario SET contrasena='$contrasena',codigo='$codigo',nombre='$nombre',celular='$celular',direccion='$direccion' WHERE idusuario='$idusuario'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idusuario){
        $sql="SELECT * FROM usuario WHERE idusuario='$idusuario'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listarClientes(){
        $sql="SELECT * FROM usuario WHERE tipo='cliente'";
        return ejecutarConsulta($sql);
    }

    public function listar(){
        $sql="SELECT * FROM usuario";
        return ejecutarConsulta($sql);
    }


}
?>