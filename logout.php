<?php
require("conexion.php");
//Inicia una nueva sesión o reanuda la existente 
session_start();
//Eliminar cookies:
 if( isset($_COOKIE[$_SESSION["id"]]) )
    {
		setcookie($_SESSION["id"], "", time() - 1 );
    }
//Destruye toda la información registrada de una sesión junto con las cookies:
	unset($_COOKIE[$_SESSION["id"]]);
	session_unset();
    session_destroy(); 
//Cerrar la base de datos:
	mysqli_close ($db);
//Redirecciona a la página de login
    header('location: login.php');
	exit();
?>