<html lang="es">
 <head> 
  <!--Este proyecto usará sqlite para manipular la base de datos de los estudiantes -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 </head>
<?php
//ES MUY IMPORTANTE CONFIGURAR LA ZONA HORARIA PARA EL MANEJO TIEMPOS DE FORMA CORRECTA:
date_default_timezone_set('America/Mexico_City');
/* ******************************************* */
/*Se inicia una consulta a la base de datos */
require("conexion.php");


$user_ingresado = $_POST["usuario"];
$pass_ingresado = $_POST["password"];

if(!empty($user_ingresado) OR !empty($pass_ingresado)) {
	
}else{
	header("Location:login.php");
}
/*VARIABLES USADAS EN EL ENTORNO, USADAS PARA LOGIN */
$servidor       = "localhost";
$usuario        = "phpmyadmin";
$clave          = "";
$basedatos      = "taes";
$error_data_base = false;
$error_usuario = false;
$error_pass = false;

//verificando enlace con la base de datos:
$enlace_db = mysqli_connect($servidor,$usuario,$clave);
if (!$enlace_db) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    exit;
	header("Location:login.php?error_data_base=true");
}
echo "Éxito: Se realizó una conexión apropiada a MySQL!." . PHP_EOL.'<br>';
echo "Información del host: " . mysqli_get_host_info($enlace_db) . PHP_EOL."<br>";
if (mysqli_connect_errno()) {
    printf("Conexión fallida: %s\n", mysqli_connect_error());
    exit();
}
/* ******************************************* */
/* ******************************************* */
//seleccionar la base de datos:
mysqli_select_db($enlace_db ,$basedatos) or die('No se pudo seleccionar la base de datos');
/* ******************************************* */
	//buscar y mostrar contenido de tabla usuario:
	/*$consulta_usuario = "SELECT usuario FROM admins";
	$resultado = mysqli_query($enlace_db,$consulta_usuario) or die('Consulta fallida: ' . mysqli_error());
	$usuario_de_bd = mysqli_fetch_array($resultado);
	echo '<table> <thead>
		<tr>
			<th>USUARIOS</th>
		</tr>
		</thead>';

		echo '<td>'.$usuario_de_bd['usuario'].'</td>';

	echo '</table>';*/
/* ******************************************* */
//comparar usuario ingrasado con el de registro de tabla:
if (isset($user_ingresado) && !empty($user_ingresado)) {
//1 Hacer una consulta a la base de datos en tu tabla antes de registrar la tabla            
$dato_usuario =  mysqli_query($enlace_db, "SELECT usuario FROM admins WHERE usuario = '".$user_ingresado."'");
$cadena_dato_usuario = mysqli_fetch_array($dato_usuario);

if($cadena_dato_usuario['usuario'] == $user_ingresado){
	//dentro de este bloque se verifica la contraseña si el usuario es correcto:
	if (isset($pass_ingresado) && !empty($pass_ingresado)) {
		$dato_pass =  mysqli_query($enlace_db, "SELECT password FROM admins WHERE usuario = '".$user_ingresado."'");
		$cadena_dato_pass = mysqli_fetch_array($dato_pass);
		if($cadena_dato_pass['password'] == $pass_ingresado){
			//INICIAR SESSION:
			unset($error_data_base);
			unset($error_usuario);
			unset($error_pass);
			
			session_start();
			$fecha = date('H:i:s_d-m-Y'); //OBTENER HORA Y FECHA SEGÚN FECHA HORARIA EN FORMATO.
			$fecha_en_segundos = time(); //FECHA ABSOLUTA PERO EN SEGUNDOS
			$_SESSION["fecha"] = $fecha;
			$_SESSION["expire"] = $fecha_en_segundos;
			$_SESSION["id"] = $user_ingresado.generarCodigo(33).$_SESSION["fecha"];
			$_SESSION["nombre"] = $user_ingresado;
			setcookie($_SESSION["id"], 1, time() + (3600) );  // Crea una Cookie con un tiempo de vida de 1 hora
			
			
			if($user_ingresado == 'admingral'){
				header("Location:home-sudo_admin.php");
			}else{
			header("Location:home.php");
			}
			
		}else{
			header("Location:login.php?error_pass=true");
			unset($user_ingresado);
			unset($pass_ingresado);
		}
	}
}else{
	header("Location:login.php?error_usuario=true");
	unset($user_ingresado);
	unset($pass_ingresado);
}
}
/* ******************************************* */

	/* Verifica si encontro al menos un registro..Contar el numero de filas 
	$duplicado = mysqli_num_rows($dato);
	if($duplicado==1){
	//Quiere decir que no se encontró un item igual a la del input entonces inserta
	echo "usuario unico <br>"; 
	}else{
	echo "<script> alert('Item duplicado') </script>";
	unset($user_ingresado);}
	*/

?>
</html>
