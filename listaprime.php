<DOCTYPE! html>
<?php
date_default_timezone_set('America/Mexico_City');
error_reporting(E_ALL & ~(E_NOTICE));
session_start();
if(!isset($_SESSION["id"]) AND ($_COOKIE[$_SESSION["id"]] ==false) AND $_SESSION["nombre"] != "admingral")
{
 header("Location: logout.php");
 exit;
}
// El siguiente key se crea cuando se inicia sesión
$_SESSION["timeout"] = time();
?>

<html lang="es">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>taes/talleres Prepa 3</title>
	<title>TAEs Prepa 3</title>
	<script src="jquery-3.4.1.min.js"></script>
	<script language="JavaScript">
		setTimeout("alert('se cierra sesión por inactividad')", 3200000);
		setTimeout("location.href='logout.php'", 3200000);
	</script>
<?php
$time = 3600; // 1 hora en segundos
// verificamos si existe la sesión
// el nombre "session_name" es como ejemplo
if(isset($_SESSION["id"]))
{
	//BUCLE PARA REVISAR CADA HORA SI HA EXPIRADO SESIÓN:
	for($i=0;$i<=3600;$i++ ){	
		// verificamos si existe la sesión que se encarga del tiempo
		// si existe, y el tiempo es mayor que una hora, expiramos la sesión 
		if(isset($_SESSION["expire"]) && time() > $_SESSION["expire"] + $time)
		{
			unset($_SESSION["expire"]);
			unset($_SESSION["id"]);
			header("Location: logout.php");
		}else // si no existe la creamos
	
		$_SESSION["expire"] = time();
    }
}

//obtener el nombre real del administrador:
require("conexion.php");

$user_ingresado = $_SESSION["nombre"];

$enlace_db = conectar();

$dato_usuario =  mysqli_query($enlace_db, "SELECT nombre_real FROM admins WHERE usuario = '".$user_ingresado."'");
$cadena_dato_usuario = mysqli_fetch_array($dato_usuario);
?>
</head>
<body>












</body>
</html>
