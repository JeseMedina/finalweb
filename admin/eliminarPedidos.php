<?php
    if (!isset($_GET['codigo'])) {
        header ('Location: pedidos.php?mensaje=error');
    }

    include '../model/conexion.php';
    $codigo = $_GET['codigo'];
    $sentencia = $bd->prepare("DELETE FROM pedidos WHERE codigo = ?;");
    $resultado = $sentencia->execute([$codigo]);

    if ($resultado === TRUE) {
        header('Location: pedidos.php?mensaje=eliminado');
    } else {
        header('Location: pedidos.php?mensaje=error');
    }
?>