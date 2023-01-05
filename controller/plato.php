<?php
require_once "../models/Plato.php";

$plato = new Plato();

$idplato = isset($_POST["idplato"]) ? limpiarCadena($_POST["idplato"]):"";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]):"";
$descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]):"";
$precio = isset($_POST["precio"]) ? limpiarCadena($_POST["precio"]):"";
$imagen = isset($_POST["imagen"]) ? limpiarCadena($_POST["imagen"]):"";
$estado = isset($_POST["estado"]) ? limpiarCadena($_POST["estado"]):"";

switch($_GET["op"]) {
    case 'guardaryeditar':
        if(empty($idplato)){
            $rspta = $plato->insertar($nombre,$descripcion,$precio,$imagen);
            echo $rspta ? "Plato registrado" : "El plato no se pudo registrar";
        } else {
            $rspta = $plato->editar($idplato,$nombre,$descripcion,$precio,$imagen);
            echo $rspta ? "Plato actualizado" : "El plato no se pudo Actualizar";
        }
    break;

    case 'descativar':
        $rspta = $plato->desactivar($idplato);
        echo $rspta ? "Plato desactivado" : "El plato no se pudo desactivar";
    break;

    case 'activar':
        $rspta = $plato->activar($idplato);
        echo $rspta ? "Plato activado" : "El plato no se pudo activar";
    break;

    case 'mostrar':
        $rspta = $plato->mostrar($idplato);
        echo json_encode($rspta);
    break;

    case 'listar':
        $rspta = $plato->listar();
        $data = Array();
        
        while ($reg = $rspta->fetch_object()){
            $data[] = array(
                "0"=>($reg->estado)?'<button data-toggle="tooltip" title="Actualizar Plato" class= btn btn-warning" onclick="mostrar('.$reg->idplato.')"><i class="fa fa-pencil"><i/></button>'.'<button data-toggle="tooltip" title="Desactivar Plato" class="btn btn-danger" onclick="desactivar('.$reg->idplato.')"><i class=fa fa-close"></i></button>':'<button data-toggle="tooltip" title="Activar Plato" class="btn btn-primary" onclick="activar('.$reg->idplato.')"><i class="fa fa-check"></i></button>',
                "1"=>$reg->nombre,
                "2"=>$reg->descripcion,
                "3"=>$reg->precio,
                "4"=>$reg->imagen,
                "5"=>($reg->estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
            );
        }
        $results = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
        echo json_encode($results);
    break;

    case 'listarActivos':
        $rspta = $plato->listarActivos();
        $data = Array();
        
        while ($reg = $rspta->fetch_object()){
            $data[] = array(
                "0"=>'<button data-togle="tooltip" title"Agregar Plato" class="btn btn-warning" onclick="agregarDetalle('.$reg->idplato.',\''.$reg->nombre.'\',\''.$reg->precio.'\')"<span class="fa fa-plus"></span></button>',
                "1"=>$reg->nombre,
                "2"=>$reg->descripcion,
                "3"=>$reg->precio,
                "4"=>$reg->imagen,
                "5"=>($reg->estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
            );
        }
        $results = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
        echo json_encode($results);
    break;
}
?>