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
	<style>
		body{
			display:block;	
		}
		#seleccionador{
			border:1px solid black;
		}
	</style>
	<title>Listas</title>
	<script type="text/javascript" src="jquery-3.4.1.min.js"></script>
	<script type="text/javascript">
		setTimeout("alert('se cierra sesión por inactividad')", 3200000);
		setTimeout("location.href='logout.php'", 3200000);
	</script>
</head>
<body>
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
	<hr>
	<h1 style="text-align:center;">Seleccione la lista a editar:</h1>
	<table style="float:center; text-align:center;" align="center">
		<form name="quick_edit" method="post" action="">
			<th style="color:white;background-color:#006666;">TALLER/TAE:</th>
			<tr><td>
				<select name="qe_search">
				<?php
				echo "<option></option>";
				$listar_deptos =  mysqli_query($enlace_db, "SELECT nombre_formal FROM departamentos");
				$n = mysqli_num_rows($listar_deptos);
				if ($n > 0) {
					while($cad_listar_deptos = mysqli_fetch_row($listar_deptos)){
					//$cad_listar_deptos[0] = utf8_encode($cad_listar_deptos[0]);
					echo "<optgroup label='".$cad_listar_deptos[0]."'>";
					//En base al nombre formal se obtiene el nombre corto en cada iteración:
					$listar_dept_corto = mysqli_query($enlace_db,"SELECT nombre FROM departamentos WHERE nombre_formal = '".$cad_listar_deptos[0]."'");
					$cad_listar_dept_corto = mysqli_fetch_row($listar_dept_corto);
					//Aquí se consulta la tabla con el nombre obtenido anteriormente y además se ponen en cada iteración como una opción a elegir.
					$dime_taes = mysqli_query($enlace_db,"SELECT nombre_formal FROM ".$cad_listar_dept_corto[0]);
					while ($cad_dime_taes = mysqli_fetch_row($dime_taes)){
							echo "<option value='".$cad_dime_taes[0]."#%#".$cad_listar_deptos[0]."'>".$cad_dime_taes[0]."</option>";
						}
						echo "</optgroup>";
					}
				}
				?>
				</select>
				</td>
			</tr>
			<tr>
				<td>
					<button type="submit">Ver tabla</button>
				</td>
			</tr>
		</form>
	</table>
	<hr>
	<?php
	//Se verifica si hay algún valor en la varible enviada por el formulario previo.
	$busqueda = $_POST["qe_search"];
	if(isset($busqueda)){
		$quicksearch = explode("#%#", $busqueda);
		echo "<b style='text-align:center;' align='center'>".$quicksearch[1]." > ".$quicksearch[0]."</b><br>";
		echo "<table id='lista' class='tablesorter' border='1' align='center'>";
			echo "<tr style='color:white; background-color:#283c80; text-align:center;'>";
				echo "<td colspan='5'>";
					echo $quicksearch[0];
				echo "</td>";
			echo "</tr>";
			echo "<tr style='color:white; background-color:#283c80;'>";
				echo "<td>";
					echo "Apellido(s)";
				echo "</td>";
				echo "<td>";
					echo "Nombre(s)";
				echo "</td>";
				echo "<td>";
					echo "No. de Alumno";
				echo "</td>";
				echo "<td>";
					echo "Teléfono";
				echo "</td>";
				echo "<td>";
					echo "Correo";
				echo "</td>";
			echo "</tr>";
		$qss = mysqli_query($enlace_db,"SELECT apellido, nombre, no_estudiante, telefono, correo FROM alumnos_taes WHERE tae ='".$quicksearch[0]."' ORDER BY apellido, nombre ASC");
		while($cad_qss = mysqli_fetch_row($qss)){
			echo "<tr contenteditable>";
				echo "<td>";
					echo $cad_qss[0];
				echo "</td>";
				echo "<td>";
					echo $cad_qss[1];
				echo "</td>";
				echo "<td>";
					echo $cad_qss[2];
				echo "</td>";
				echo "<td>";
					echo $cad_qss[3];
				echo "</td>";
				echo "<td>";
					echo $cad_qss[4];
				echo "</td>";
			echo "</tr>";
		}
		echo "</table>";
		$fecha = date('H_i_s--d-m-Y');
		echo "<div align='center'>
			<button id='toexcel'>Descargar lista en formato Excel (.xls)</button><br>
			<button id='tocsv' onclick='CSV()'>Descargar lista en formato de texto CSV (.csv)</button>
			</div>";
		echo "<br><b style='text-align:center;' align='center'> Opciones al grupo de ".$quicksearch[0]."</b><br>";
		echo "<form name='delete_list' method='post action='' align='left'>";
			echo "<button>Borrar a todos los alumnos</button><br>";
		echo "</form>";
		echo "<form name='import_list' method='post action='' align='left'>";
			echo "Importar lista desde archivo (.csv):   <input type='file' name='import_csv'><br>";
			echo "<button type='submit'>Importar<button/>";
		echo "</form>";
	}
	?>
	
	<!-- Script para convertir la tabla de alumnos a archivo de Excel (.xls)-->
	<script type="text/javascript" src="jquery.table2excel.js"></script>
	<script>
		$("#toexcel").click(function(){
			$("#lista").table2excel({
				filename: <?php $fecha = date('H_i_s--d-m-Y'); echo '"'.$quicksearch[0].'_'.$fecha.'.xls"'; ?>
			}); 
		});
	</script>
	<!-- Script para convertir la tabla de alumnos a archivo de texto de valores separados por coma (.cvs) -->
	<script type="text/javascript" src="csvExport.min.js"></script>
	<script type="text/javascript">
	function CSV(){
		$('#lista').csvExport({
			title:<?php $fecha = date('H_i_s--d-m-Y'); echo '"'.$quicksearch[0].'_'.$fecha.'.csv"'; ?>
		});
	}
	</script>
	<?php 
	unset($_POST["qe_search"]);
	$busqueda = '';
	?>
</body>
</html>
