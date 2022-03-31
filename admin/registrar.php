<?php
    if(empty($_POST["oculto"]) || empty($_POST["txtNombre"]) || empty($_POST["txtPrecio "]) || empty($_POST["txtImagen"])) {
        header('Location: platos.php?mensaje=falta');
    }

    include_once '../model/conexion.php';
    $nombre = $_POST["txtNombre"];
    $precio = $_POST["txtPrecio"];
    $imagen = $_POST["txtImagen"];

    $sentencia = $bd->prepare("INSERT INTO platos(nombre,precio,imagen) VALUES (?,?,?);");
    $resultado = $sentencia->execute([$nombre,$precio,$imagen]);
    
    if ($resultado === TRUE) {
        header('Location: platos.php?mensaje=registrado');
    } else {
        header('Location: platos.php?mensaje=error');
        exit();
    }
?>