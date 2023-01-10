<?php
require_once "../models/Pedido.php";

$pedido = new Pedido();

$idpedido = isset($_POST["idpedido"]) ? limpiarCadena($_POST["idpedido"]):"";
$idusuario = isset($_POST["idusuario"]) ? limpiarCadena($_POST["idusuario"]):"";
$fecha = isset($_POST["fecha"]) ? limpiarCadena($_POST["fecha"]):"";
$hora = isset($_POST["hora"]) ? limpiarCadena($_POST["hora"]):"";
$total = isset($_POST["total"]) ? limpiarCadena($_POST["total"]):"";
$estado = isset($_POST["estado"]) ? limpiarCadena($_POST["estado"]):"";

switch ($_GET["op"]) {
    case 'guardar':
        $rspta = $pedido->insertar($idusuario,$fecha,$hora,$total,$_POST["idplato"],$_POST["cantidad"],$_POST["precio"]);
        echo $rspta ? "Pedido registrado" : "No se pudo registrar el pedido";
    break;

    case 'cancelar':
        $rspta = $pedido->cancelar($idpedido);
        echo $rspta ? "Pedido cancelado" : "No se pudo cancelar el pedido";
    break;

    case 'cocinar':
        $rspta = $pedido->cocinar($idpedido);
        echo $rspta ? "Cocinando pedido" : "Error. Intentelo nuevamente";
    break;

    case 'llevar':
        $rspta = $pedido->llevar($idpedido);
        echo $rspta ? "Llevando pedido" : "Error. Intentelo nuevamente";
    break;

    case 'entregado':
        $rspta = $pedido->entregado($idpedido);
        echo $rspta ? "Pedido entregado" : "Error. Intentelo nuevamente";
    break;

    case 'mostrar':
        $rspta = $pedido->mostrar($idpedido);
        echo json_encode($rspta);
    break;

    case 'listarDetalle':
        $id=$_GET['id'];
        $rspta = $pedido->listarDetalle($id);
        $total=0;

        echo '<thead>
            <th>Plato</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Imagen</th>
            <th>Subtotal</th>
            </thead>';

        while ($reg = $rspta->fetch_object()){
            echo '<tr class="filas">
            <td>'.$reg->nombre.'</td>
            <td>'.$reg->cantidad.'</td>
            <td>'.$reg->precio.'</td>
            <td><img src="'.$reg->imagen.'" width="50px"></td>
            <td>'.$reg->subtotal.'</td>
            </tr>';
            $total=$total+$reg->subtotal;
        }  

        echo '<tfoot>
            <th></th>
            <th></th>
            <th></th>
            <th>Total</th>
            <th>$'.$total.'<input type="hidden" name="total" id="total"></th>
            </tfoot>';    
    break;
    
    case 'listar':
        $rspta = $pedido->listar();
        $data= Array();
        while ($reg=$rspta->fetch_object()){
            $data[]=array(
            
            "0"=>$reg->usuario,
            "1"=>$reg->direccion,
            "2"=>$reg->fecha,
            "3"=>$reg->hora,
            "4"=>'$ '.$reg->total,
            // "5"=>($reg->estado==1)?'<span class="label bg-green">Aceptado</span>':
            // '<span class="label bg-red">Anulado</span>',
            "5"=>estadoPedido($reg->estado),
            "6"=>botonesPedido($reg->estado,$reg->idpedido)
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

function estadoPedido($a){
    if ($a == 0){
        return '<span class="badge bg-danger">cancelado</span>';
    } elseif ($a == 1){
        return '<span class="badge bg-secondary">Aceptado</span>';
    } elseif ($a == 2){
        return '<span class="badge bg-warning">Cocinado</span>';
    } elseif ($a == 3){
        return '<span class="badge bg-primary">Llevando</span>';
    } elseif ($a == 4){
        return '<span class="badge bg-success">Entregado</span>';
    }
}

function botonesPedido($a,$id){
    if ($a == 0){
        return '';
    } elseif ($a == 1){
        return '<button data-toggle="tooltip" data-placement="right" title="Mostrar Pedido" class="btn btn-secondary" onclick="mostrar('.$id.')"><i class="fa fa-eye"></i></button>'.' <button data-toggle="tooltip" data-placement="right" title="Cocinar Pedido" class="btn btn-warning" onclick="cocinar('.$id.')"><i class="fa fa-utensils"></i></button>'.' <button data-toggle="tooltip" data-placement="right" title="Cancelar Pedido" class="btn btn-danger" onclick="cancelar('.$id.')"><i class="fa fa-ban"></i></button>';
    } elseif ($a == 2){
        return '<button data-toggle="tooltip" data-placement="right" title="Mostrar Pedido" class="btn btn-secondary" onclick="mostrar('.$id.')"><i class="fa fa-eye"></i></button>'.' <button data-toggle="tooltip" data-placement="right" title="Llevar Pedido" class="btn btn-primary" onclick="llevar('.$id.')"><i class="fa fa-person-running"></i></button>'.' <button data-toggle="tooltip" data-placement="right" title="Cancelar Pedido" class="btn btn-danger" onclick="cancelar('.$id.')"><i class="fa fa-ban"></i></button>';
    } elseif ($a == 3){
        return '<button data-toggle="tooltip" data-placement="right" title="Mostrar Pedido" class="btn btn-secondary" onclick="mostrar('.$id.')"><i class="fa fa-eye"></i></button>'.' <button data-toggle="tooltip" data-placement="right" title="Llevar Pedido" class="btn btn-success" onclick="entregar('.$id.')"><i class="fa fa-face-smile"></i></button>'.' <button data-toggle="tooltip" data-placement="right" title="Cancelar Pedido" class="btn btn-danger" onclick="cancelar('.$id.')"><i class="fa fa-ban"></i></button>';
    } elseif ($a == 4){
        return '<button data-toggle="tooltip" data-placement="right" title="Mostrar Pedido" class="btn btn-secondary" onclick="mostrar('.$id.')"><i class="fa fa-eye"></i></button>';
    }
}
?>