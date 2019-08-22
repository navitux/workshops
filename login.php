<DOCTYPE! html>
<html lang="es">
 <head>
  <!--Este proyecto usará sqlite para manipular la base de datos de los estudiantes -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>P3 - Iniciar sesión</title>
 </head>
 <?php
 error_reporting(E_ALL & ~(E_NOTICE));
 date_default_timezone_set('America/Mexico_City');

 ?>
 <style>
/*empieza estilo de login.php*/
*{
margin:0;
padding:0;
box-sizing:border-box;
}
html,body{
scroll-behavior:smooth;
height:100%;
font-family:Helvetica;
}

body button{
	padding:10px;
	border:none;
	background-color:#eae8e8;
	border:1px solid black;
}
body button:hover{
	background-color:#b7a8c4;
}
body button:active{
	background-color:#740ed3;
}
#fondo-login{
background-image: url("fondo_login.png");
filter:blur(8px);
-webkit-filter: blur(3px);
height:100%;
background-position: center;
background-repeat: no-repeat;
background-size: cover;
}
#header{
	margin-top:10%;
	background-color:white;
	color:black;
}
#login{
	background-color:white;
	color:black;
	font-weight: bold;
	border: 3px solid #f1f1f1;
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	z-index: 2;
	width: 80%;
	padding: 20px;
	text-align: center;
	border:2px solid black;
	text-align:center;
}
#login table{
	margin:0 auto;
}
#login-footer{
width:100%;
background-color:black;
color:white;
text-align:center;
display:block;
position:absolute;
bottom:0;
}
/*termina estilo de login.php*/
</style>
<?php
	$us = $_GET["error_usuario"];
	$ps = $_GET["error_pass"];
	$db = $_GET["error_data_base"];
?>
<!-- Mecánica de mensajes de error -->
<body>
  <div id="fondo-login"></div>
	<section id="login">
		<!--Cabecera de la página-->

		<header id="titulo"><h1>Control de TAEs/TALLERES</h1></header>

		<header id="titulo"><h1>Control de TAEs</h1></header>

		<form method="post" action="motor-login.php">
			<table>
			<tr>
				<th colspan="2" style="text-align:center;">Iniciar Sesión</th>
			</td>
			<tr>
				<td style="text-align:right;">usuario:</td><td><input type="text" name="usuario" placeholder="nombre de usuario" required></td>
			</tr>
			<tr>
				<td style="text-align:right;">contraseña:</td><td><input type="password" name="password" placeholder="Su contraseña" required></td>
			</tr>
			<tr>
				<td colspan="3" style="text-align:center;"><button type="submit">Entrar</button></td>
			</tr>
			</table>
		</form>
		<a href="index.php" style="display:inline-block; float:right; text-decoration:none; color:black; border:black 1px solid;">Volver a TAEs</a>
		<?php
		if( $us == "true" ){
			echo '<script language="javascript">alert("Usuario incorrecto");</script>';
			echo '<script language="javascript">location.href="login.php";</script>';

		}
		if( $ps == "true" ){
			echo '<script language="javascript">alert("Contraseña incorrecta");</script>';
			echo '<script language="javascript">location.href="login.php";</script>';
		}
		if( $db == "true" ){
			echo '<script language="javascript">alert("Hubo un problema con la base de datos");</script>';
			echo '<script language="javascript">location.href="login.php";</script>';
		}
		?>

	</section>
	<!--Termina el formulario de inicio de sesión-->
	<footer id="login-footer">Escuela Preparatoria no. 3 Guadalajara, Jal. </footer>
  <?php //require("conexion.php");  conecta() = $db; echo "hola: ".$db."'";?>

</body>
</html>
