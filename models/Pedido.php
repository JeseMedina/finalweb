<?php
require "../cofig/conexion.php";

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
        $sql="UPDATE pedido SET estado=5 WHERE idpedido='$idpedido'";
        return ejecutarConsulta($sql);
    }
}
?>