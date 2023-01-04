<?php
// $contraseña = "";
// $usuario = "root";
// $nombre_bd = "crud";

// try {
//     $bd = new PDO(
//         'mysql:host=localhost;
//         dbname='.$nombre_bd,
//         $usuario,$contraseña,
//         array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
//     );
// } catch (Exception $e) {
//     echo "Problemas con la conexion: ".$e->getMessage();
// }

require_once"global.php";
$conexion = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME); 
mysqli_query( $conexion, 'SET NAMES "'.DB_ENCODE.'"');

if (mysqli_connect_errno()) 
{
	printf("Falló la conexión a la Base de Datos: %s\n",mysqli_connect_errno());
	exit();
}
if (!function_exists('ejecutarConsulta'))
{
	function ejecutarConsulta($sql)
	{
		global $conexion;
		$query = $conexion->query($sql);
		return $query;
	}
	function ejecutarConsultaSimpleFila($sql)
	{
		global $conexion;
		$query = $conexion->query($sql);
		$row = $query->fetch_assoc();
		return $row;
	}
	function ejecutarConsulta_retornarID($sql)
	{
		global $conexion;
		$query = $conexion->query($sql);
		return $conexion->insert_id;
	}
	function limpiarCadena($str)
	{
		global $conexion;
		$str = mysqli_real_escape_string($conexion,trim($str));
		return htmlspecialchars($str);
	}
}
?>