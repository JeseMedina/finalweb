<?php
require "../config/conexion.php";

Class Pedido{
    public function __contruct(){}
    // 0 cancelado
    // 1 aceptado
    // 2 en cocina
    // 3 llevando
    // 4 entregado

    public function insertar($idusuario,$fecha,$hora,$total,$idplato,$cantidad,$precio){
        $sql="INSERT INTO pedido (idusuario,fecha,hora,total,estado)
        VALUES ('$idusuario','$fecha','$hora','$total','1')";

        $idpedidonew=ejecutarConsulta_retornarID($sql);
        $num_elementos=0;
        $sw=True;

        while($num_elementos < count($idplato)){
            $sql_detalle = "INSERT INTO pedido_plato(idpedido,idplato,cantidad,precio) VALUES ('$idpedidonew','$idplato[$num_elementos]','$cantidad[$num_elementos]','$precio[$num_elementos]')";
            ejecutarConsulta($sql_detalle) or $sw = false;
            $num_elementos=$num_elementos + 1;
        }
        return $sw;
    }

    public function cancelar($idpedido){
        $sql="UPDATE pedido SET estado=0 WHERE idpedido='$idpedido'";
        return ejecutarConsulta($sql);
    }

    public function cocinar($idpedido){
        $sql="UPDATE pedido SET estado=2 WHERE idpedido='$idpedido'";
        return ejecutarConsulta($sql);
    }

    public function llevar($idpedido){
        $sql="UPDATE pedido SET estado=3 WHERE idpedido='$idpedido'";
        return ejecutarConsulta($sql);
    }

    public function entregado($idpedido){
        $sql="UPDATE pedido SET estado=4 WHERE idpedido='$idpedido'";
        return ejecutarConsulta($sql);
    }

    public function listar(){
        $sql="SELECT p.idpedido,p.fecha,p.hora,p.total,u.nombre as usuario,u.direccion,u.celular, p.estado FROM pedido p INNER JOIN usuario u ON p.idusuario = u.idusuario ORDER BY p.idpedido desc";
        return ejecutarConsulta($sql); 
    }

    public function mostrar($idpedido){
        $sql="SELECT p.idpedido,p.fecha,p.hora,p.total,u.nombre as usuario,u.direccion,u.celular FROM pedido p INNER JOIN usuario u ON p.idusuario = u.idusuario WHERE p.idpedido = '$idpedido'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listarDetalle($idpedido){
        $sql="SELECT pp.idplato, p.nombre,pp.cantidad,p.imagen, pp.precio,(pp.cantidad * pp.precio) as subtotal FROM pedido_plato pp INNER JOIN plato p ON pp.idplato = p.idplato WHERE pp.idpedido = '$idpedido'";
        return ejecutarConsulta($sql);
    }
}
?>