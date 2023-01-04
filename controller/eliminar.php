<?php
    if (!isset($_GET['codigo'])) {
        header ('Location: platos.php?mensaje=error');
    }

    include '../config/conexion.php';
    $codigo = $_GET['codigo'];
    $sentencia = $bd->prepare("DELETE FROM platos WHERE codigo = ?;");
    $resultado = $sentencia->execute([$codigo]);

    if ($resultado === TRUE) {
        header('Location: platos.php?mensaje=eliminado');
    } else {
        header('Location: platos.php?mensaje=error');
    }
?>