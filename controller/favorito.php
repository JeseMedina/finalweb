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

    case 'listarTodos':
        $id=$_GET['id'];
        $rspta = $favorito->listarTodos($id);
        $total=0;

        echo '<thead>
            <th>Plato</th>
            <th>Precio</th>
            <th>Imagen</th>
            <th>Estado</th>
            </thead>';

        while ($reg = $rspta->fetch_object()){
            echo '<tr class="filas">
            <td>'.$reg->nombre.'</td>
            <td>'.$reg->precio.'</td>
            <td><img src="'.$reg->imagen.'" width="50px"></td>
            <td>'.estadoFavorito($reg->estado).'</td>
            </tr>';
            $total=$total+$reg->subtotal;
        }  
    break;

    case 'eliminar':
        $rspta = $favorito->eliminar($idusuario,$idplato);
    break;
}

function estadoFavorito($a){
    if ($a == 0){
        return '<span class="badge bg-danger">Desactivado</span>';
    } elseif ($a == 1){
        return '<span class="badge bg-success">Activado</span>';
    }
}

?>