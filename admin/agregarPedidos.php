<?php
    if(empty($_POST['oculto']) || empty($_POST['txtNombre']) ||empty($_POST['txtCelular']) || empty($_POST['txtDireccion']) || empty($_POST['txtOrden'])){
        header('Location: ../index.php');
    }

    include_once '../model/conexion.php';
    $nombre = $_POST['txtNombre'];
    $celular = $_POST['txtCelular'];
    $direccion = $_POST['txtDireccion'];
    $orden = $_POST['txtOrden'];

    $sentencia = $bd->prepare("INSERT INTO pedidos(nombre,celular,direccion,orden) VALUE(?,?,?,?);");
    $resultado = $sentencia->execute([$nombre,$celular,$direccion,$orden]);

    if ($resultado === TRUE) {
        header('Location: ../index.php?mensaje=registrado');
    } else {
        header('Location: ../index.php?mensaje=error');
        exit();
    }
?>