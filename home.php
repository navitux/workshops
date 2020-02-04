<DOCTYPE! html>
<?php
date_default_timezone_set('America/Mexico_City');
error_reporting(E_ALL & ~(E_NOTICE));
session_start();
if(!isset($_SESSION["id"]) AND ($_COOKIE[$_SESSION["id"]] ==false) AND $_SESSION["nombre"] != "simple-admin")
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
	<link rel="stylesheet" href="homs_style.css" media="all"/>
	<title>TAEs Prepa 3</title>
<script language="JavaScript">
	setTimeout("alert('se cierra sesión por inactividad')", 3300000);
    setTimeout("location.href='logout.php'", 3700000);

</script>
</head>
<body >
<?php
$time = 3600; // 1 hora en segundos
// verificamos si existe la sesión
// el nombre "session_name" es como ejemplo
if(isset($_SESSION["id"]))
{
	// verificamos si existe la sesión que se encarga del tiempo
	// si existe, y el tiempo es mayor que una hora, expiramos la sesión
	if(isset($_SESSION["expire"]) && time() > $_SESSION["expire"] + $time)
	{
		unset($_SESSION["expire"]);
		unset($_SESSION["id"]);
		header("Location: logout.php");
	}else // si no existe la creamos
	{
		$_SESSION["expire"] = time();
    }
}


echo 'bienvenido<br>';
echo $_SESSION["id"]."<br>";
?>
 <p>administrador normal</p>
 <a href = "logout.php" style="text_decoration:none;">Sign Out</a>
</body>
=======
﻿<DOCTYPE! html>
<?php
date_default_timezone_set('America/Mexico_City');
error_reporting(E_ALL & ~(E_NOTICE));
session_start();
if(!isset($_SESSION["id"]) AND ($_COOKIE[$_SESSION["id"]] ==false) AND $_SESSION["nombre"] != "simple-admin")
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
	<link rel="stylesheet" href="homs_style.css" media="all"/>
	<title>TAEs Prepa 3</title>
<script language="JavaScript">
	setTimeout("alert('se cierra sesión por inactividad')", 3300000);
    setTimeout("location.href='logout.php'", 3700000);

</script>
</head>
<body >
<?php
$time = 3600; // 1 hora en segundos
// verificamos si existe la sesión
// el nombre "session_name" es como ejemplo
if(isset($_SESSION["id"]))
{
	// verificamos si existe la sesión que se encarga del tiempo
	// si existe, y el tiempo es mayor que una hora, expiramos la sesión
	if(isset($_SESSION["expire"]) && time() > $_SESSION["expire"] + $time)
	{
		unset($_SESSION["expire"]);
		unset($_SESSION["id"]);
		header("Location: logout.php");
	}else // si no existe la creamos
	{
		$_SESSION["expire"] = time();
    }
}


echo 'bienvenido<br>';
echo $_SESSION["id"]."<br>";
?>
 <p>administrador normal</p>
 <a href = "logout.php" style="text_decoration:none;">Sign Out</a>
</body>
</html>
