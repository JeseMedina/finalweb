<?php 

require "../config/Conexion.php";
 
Class Usuario{
    public function __construct()
    {
 
    }

    public function insertar($user,$contrasena,$nombre,$celular,$direccion)
    {
        $sql="INSERT INTO usuario (user,contrasena,nombre,celular,direccion,tipo)
        VALUES ('$user','$contrasena','$nombre','$celular','$direccion','cliente')";
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

    public function verificar($user, $contrasena){
        $sql="SELECT * FROM usuario WHERE user='$user' AND contrasena='$contrasena'";
		return ejecutarConsulta($sql);
    }

    public function verificarOlvido($user,$celular){
        $sql="SELECT * FROM usuario WHERE user='$user' AND celular='$celular'";
		return ejecutarConsulta($sql);
    }

    public function cambiarContrasena($user, $contrasena){
        $sql="UPDATE usuario SET contrasena='$contrasena' WHERE user='$user'";
			return ejecutarConsulta($sql);
    }
}
?>