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

    case 'desactivar':
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
                "0"=>$reg->nombre,
                "1"=>$reg->descripcion,
                "2"=>$reg->precio,
                "3"=>'<img src="'.$reg->imagen.'" width="50px">',
                "4"=>($reg->estado)?'<span class="badge bg-success">Activado</span>':'<span class="badge bg-danger">Desactivado</span>',
                "5"=>($reg->estado)?
                '<button data-toggle="tooltip" title="Desactivar Plato" class="btn btn-danger mx-2" onclick="desactivar('.$reg->idplato.')"><i class="fa fa-ban"></i></button>'.
                '<button data-toggle="tooltip" title="Actualizar Plato" class="btn btn-warning" onclick="mostrar('.$reg->idplato.')"><i class="fa fa-pencil"><i/></button>'
                :'<button data-toggle="tooltip" title="Activar Plato" class="btn btn-primary mx-2" onclick="activar('.$reg->idplato.')"><i class="fa fa-check"></i></button>'.
                '<button data-toggle="tooltip" title="Actualizar Plato" class="btn btn-warning" onclick="mostrar('.$reg->idplato.')"><i class="fa fa-pencil"><i/></button>'
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
                'idplato'=> $reg->idplato,
                'nombre'=>$reg->nombre,
                'descripcion'=>$reg->descripcion,
                'precio'=>$reg->precio,
                'imagen'=>$reg->imagen
            );
        }
        $results = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "results"=>$data);
        echo json_encode($results);
    break;
}
?>