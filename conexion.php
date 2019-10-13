<?php
//servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
function conectar(){
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'phpmyadmin');
	define('DB_PASSWORD', '');
	define('DB_DATABASE', 'taes');

	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die("Hubo un error de conexión");

	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		 echo "Error: No se pudo conectar a MySQL." . PHP_EOL.'<br>';
		echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL.'<br>';
		exit();
	}
	return $db;
}
//generar una sesión lo más rebuscada posible:
function generarCodigo($longitud) { 
	$key = '';
	$pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ.-_#';
	$max = strlen($pattern)-1;
	for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
	return $key;
}
$proof = "<br>varible de archivo conexion.php<br>";
?>
