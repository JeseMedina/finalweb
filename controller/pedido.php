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
            <th>Opciones</th>
            <th>Plato</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Subtotal</th>
            </thead>';

        while ($reg = $rspta->fetch_object()){
            echo '<tr class="filas">
            <td></td>
            <td>'.$reg->nombre.'</td>
            <td>'.$reg->cantidad.'</td>
            <td>'.$reg->precio.'</td>
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
            "0"=>botonesPedido($reg->estado,$reg->idpedido),
            "1"=>$reg->fecha,
            "2"=>$reg->cliente,
            "3"=>$reg->usuario,
            "4"=>$reg->total_venta,
            "5"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':
            '<span class="label bg-red">Anulado</span>'
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

function botonesPedido($a,$id){
    if ($a == 0){
        return 'Cancelado';
    } elseif ($a == 1){
        return '<button data-toggle="tooltip" data-placement="right" title="Mostrar Pedido" class="btn btn-warning" onclick="mostrar('.$id.')"><i class="fa fa-eye"></i></button>'.' <button data-toggle="tooltip" data-placement="right" title="Cancelar Pedido" class="btn btn-danger" onclick="cancelar('.$id.')"><i class="fa fa-close"></i></button>'.' <button data-toggle="tooltip" data-placement="right" title="Cocinar Pedido" class="btn btn-danger" onclick="cocinar('.$id.')"><i class="fa fa-close"></i></button>';
    } elseif ($a == 2){
        return '<button data-toggle="tooltip" data-placement="right" title="Mostrar Pedido" class="btn btn-warning" onclick="mostrar('.$id.')"><i class="fa fa-eye"></i></button>'.' <button data-toggle="tooltip" data-placement="right" title="Cancelar Pedido" class="btn btn-danger" onclick="cancelar('.$id.')"><i class="fa fa-close"></i></button>'.' <button data-toggle="tooltip" data-placement="right" title="Llevar Pedido" class="btn btn-danger" onclick="llevar('.$id.')"><i class="fa fa-close"></i></button>';
    } elseif ($a == 3){
        return '<button data-toggle="tooltip" data-placement="right" title="Mostrar Pedido" class="btn btn-warning" onclick="mostrar('.$id.')"><i class="fa fa-eye"></i></button>'.' <button data-toggle="tooltip" data-placement="right" title="Cancelar Pedido" class="btn btn-danger" onclick="cancelar('.$id.')"><i class="fa fa-close"></i></button>'.' <button data-toggle="tooltip" data-placement="right" title="Llevar Pedido" class="btn btn-danger" onclick="entregar('.$id.')"><i class="fa fa-close"></i></button>';
    } elseif ($a == 4){
        return 'Entregado';
    }
}
?>