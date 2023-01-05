<?php
require_once "../models/Favorito.php";

$favorito = new Favorito();

$idfavorito = isset($_POST["idfavorito"]) ? limpiarCadena($_POST["idfavorito"]):"";
$idusuario = isset($_POST["idusuario"]) ? limpiarCadena($_POST["idusuario"]):"";
$idplato = isset($_POST["idplato"]) ? limpiarCadena($_POST["idplato"]):"";

switch($_GET["op"]){
    case 'guardar':
        $rspta = $favorito->insertar($idusuario,$idplato);
        echo $rspta ? "Favorito registrado" : "Favorito no se pudo registrar";
    break;

    case 'listar':
        $rspta = $favorito->listar($idusuario);
        $data = Array();

        while ($reg = $rspta->fetch_object()){
            $data[] = array(
                "0"=>'<button data-toggle="tooltip" title="Eliminar de Favoritos" class="btn btn-primary" onclick="eliminar('.$reg->idusuario.',\''.$reg->idplato.'\')"><i class="fa fa-check"></i></button>',
                "1"=>$reg->nombre,
                "2"=>$reg->precio,
                "3"=>$reg->imagen
            );
        }
        $results = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
        echo json_encode($results);
    break;

    case 'eliminar':
        $rspta = $favorito->eliminar($idusuario,$idplato);
    break;
}
?>