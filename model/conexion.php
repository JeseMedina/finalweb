<?php
$contraseña = "";
$usuario = "root";
$nombre_bd = "crud";

try {
    $bd = new PDO(
        'mysql:host=localhost;
        dbname='.$nombre_bd,
        $usuario,$contraseña,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
    );
} catch (Exception $e) {
    echo "Problemas con la conexion: ".$e->getMessage();
}
?>