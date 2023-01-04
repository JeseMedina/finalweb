<?php
    if(!isset($_POST['codigo'])){
        header ('Location: platos.php?mensaje=error');
    }

    include '../config/conexion.php';
    $codigo = $_POST['codigo'];
    $nombre = $_POST['txtNombre'];
    $precio = $_POST['txtPrecio'];
    $imagen = $_POST['txtImagen'];

    $sentencia = $bd->prepare("UPDATE platos SET nombre = ?, precio = ? ,imagen = ? WHERE codigo = ?;");
    $resultado = $sentencia->execute([$nombre,$precio,$imagen,$codigo]);

    if ($resultado === TRUE) {
        header ('Location: platos.php?mensaje=editado');
    } else {
        header ('Location: platos.php?mensaje=error');
        exit();
    }
    
?>