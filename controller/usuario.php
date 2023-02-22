<?php
session_start();
require_once "../models/Usuario.php";

$usuario = new Usuario();

$idusuario  = isset($_POST["idusuario"]) ? limpiarCadena($_POST["idusuario"]):"";
$user = isset($_POST["user"]) ? limpiarCadena($_POST["user"]):"";
$contrasena = isset($_POST["contrasena"]) ? limpiarCadena($_POST["contrasena"]):"";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]):"";
$celular = isset($_POST["celular"]) ? limpiarCadena($_POST["celular"]):"";
$direccion = isset($_POST["direccion"]) ? limpiarCadena($_POST["direccion"]):"";
$tipo = isset($_POST["tipo"]) ? limpiarCadena($_POST["tipo"]):"";

switch($_GET["op"]) {
    case 'guardaryeditar':
        if(empty($idusuario)){
            $contrasenahash=hash("SHA256",$contrasena);

            $rspta = $usuario->insertar($user,$contrasenahash,$nombre,$celular,$direccion);
            echo $rspta ? "Usuario registrado" : "El usuario no se pudo registrar";
            
        } else {
            $rspta = $usuario->editar($idusuario,$contrasenahash,$nombre,$celular,$direccion);
            echo $rspta ? "Usuario actualizado" : "El usuario no se pudo Actualizar";
        }
    break;

    case 'mostrar':
        $rspta = $usuario->mostrar($idusuario);
        echo json_encode($rspta);
    break;

    case 'listar':
        $rspta = $usuario->listar();
        $data = Array();
        
        while ($reg = $rspta->fetch_object()){
            $data[] = array(
                "0"=>$reg->user,
                "1"=>$reg->nombre,
                "2"=>$reg->celular,
                "3"=>$reg->direccion,
                "4"=>tipoUsuario($reg->tipo),
                "5"=>'<button data-toggle="tooltip" data-placement="right" title="Mostrar Usuario" class="btn btn-secondary" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-eye"></i></button>'
            );
        }
        $results = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
        echo json_encode($results);
    break;

    case 'selectClientes':
        $rspta = $usuario->listarClientes();
 
        while ($reg = $rspta->fetch_object()){
            echo '<option value='.$reg->idusuario.'>'.$reg->user.'</option>';
        }
    break;

    case 'listarClientes':
        $rspta = $usuario->listarClientes();
        $data = Array();
        
        while ($reg = $rspta->fetch_object()){
            $data[] = array(
                "0"=>'<button data-toggle="tooltip" title="Actualizar Plato" class= btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"><i/></button>',
                "1"=>$reg->user,
                "2"=>$reg->nombre,
                "3"=>$reg->celular,
                "4"=>$reg->direccion,
                "5"=>$reg->tipo
            );
        }
        $results = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
        echo json_encode($results);
    break;

    case 'verificar':
        $contrasenahash=hash("SHA256",$contrasena);
        $rspta=$usuario->verificar($user,$contrasenahash);

        $fetch=mysqli_fetch_assoc($rspta);
        $_SESSION['idusuario']=$fetch['idusuario'];
        $_SESSION['nombre']=$fetch['nombre'];
        $_SESSION['user']=$fetch['user'];
        $_SESSION['tipo']=$fetch['tipo'];
        echo json_encode($fetch);
    break;

    case 'salir':
        session_unset();
        session_destroy();
        header("location:../login.html");
    break;
}

function tipoUsuario($a){
    if ($a === 'admin'){
        return '<span class="badge bg-danger">Administrador</span>';
    } else{
        return '<span class="badge bg-warning">Cliente</span>';
    }
}

?>