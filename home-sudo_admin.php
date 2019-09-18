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
	<link rel="stylesheet" href="homs_style.css" media="all"/>
	<title>taes/talleres Prepa 3</title>
<script src="jquery-3.4.1.min.js"></script>
<script language="JavaScript">
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
<nav>
 <p style="text-align:center;">Administrador General</p> 
 <a href = "logout.php" style="text-decoration:none; color:black;"><button style="float:right;" title="Cerrar sesión actual" href = "logout.php">Cerrar Sesión  <img src='cerrar-sesion.jpg' width='20px' height='20px' title='Cerrar sesión de usuario actual'/></button></a>
 <h1>Bienvenido <?php $cadena_dato_usuario["nombre_real"] = utf8_encode($cadena_dato_usuario["nombre_real"]); echo $cadena_dato_usuario["nombre_real"];?></h1>
 <p><b>Hora</b> y <b>Fecha</b> de ingreso (último acceso): <?php echo $_SESSION["fecha"]; ?></p>
</nav>
<!--Estos scripts son para abrir/cerrar el menú de opciones -->
<script>
function openNav() {
  document.getElementById("opciones-fuertes").style.width = "20%";
}

function closeNav() {
  document.getElementById("opciones-fuertes").style.width = "0";
}
</script>
<aside id="opciones-fuertes">
 <!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ -->
 <a style="font-size:30px; color:white; text-align:right;text-decoration:none;" href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
 <button id="edit_depto" onclick="document.getElementById('edit_depto_modal').style.display='block'" type='button' style='border:none;' title="Añadir Departamento o Modificar información de alguno"><img src='editar.jpg' width='20px' height='20px'/>Añadir/Editar Departamento</button>
 <br><br>
 <div id="edit_depto_modal" class="modal">
	<div class="modal-content">
		<span onclick="document.getElementById('edit_depto_modal').style.display='none'" class="close" title="Cerrar">&times;</span>
		<table>
			<tr>
				<td style="text-align:center;"><h1>Departamentos</h1></td>
			</tr>
		</table>
		<!-- FORMULARIO "ELIMINAR DEPARTAMENTO"-->
		<form method="post" action="">
		<table>
			<tr>
				<hr>
				<b>Eliminar Departamento:</b>
				<select name="eliminar_depto">
				<?php 
				$lista_deptos =  mysqli_query($enlace_db, "SELECT nombre_formal FROM departamentos");
				$n = mysqli_num_rows($lista_deptos);
				if ($n > 0) {
					while($depto = mysqli_fetch_row($lista_deptos)){
					//$depto[0] = utf8_encode($depto[0]);
					echo "<option value='".$depto[0]."'>".$depto[0]."</option>";
					$depto[0] = utf8_decode($depto[0]);
					}
				}
				//EL SIGUIENTE BLOQUE IF SE EJECUTA PARA ELIMINAR LA TABLA DEL DEPARTAMENTO Y SU REGISTRO EN LA TABLA DE TODOS LOS DEPARTAMENTOS:
				if(isset($_POST['eliminar_depto'])){
				$el_depto = $_POST['eliminar_depto'];
				$nombre_corto_depto = mysqli_query($enlace_db,"SELECT nombre FROM departamentos WHERE nombre_formal = '".$el_depto."'");
				$cad_nombre_corto_depto =  mysqli_fetch_row($nombre_corto_depto);
				mysqli_query($enlace_db,"DROP TABLE IF EXIST ".$cad_nombre_corto_depto[0]);
				mysqli_query($enlace_db,"DELETE FROM departamentos WHERE nombre_formal = '".$el_depto."'");
				 header("Location: home-sudo_admin.php");;
				}
				?>
				</select>
			</tr>
			<tr>
				<small>(Recuerde que no se podrá deshacer ésta operación)</small>
			</tr>
			<tr>
				<td colspan="2"><button type="reset">Limpiar campos</button></td>
				<td colspan="2"><button type="submit" onclick="confirmacion()">Eliminar Departamento</button></td>
			</tr>
		</table>
		</form>
		<!-- FORMULARIO "ELIMINAR DEPARTAMENTO" FIN-->
		<!-- FOMRMULARIO PARA AÑADIR ALGÚN DEPARTAMENTO-->
		<br>
		<form method="post" action="">
		<table>
			<tr>
				<hr>
				<th><b>Crear Departamento Nuevo:</b></th>
			</tr>
	
					echo "<option value='".$depto[0]."'>".$depto		<tr>
				<td style="text-align:right;">Nombre del Departamento: </td><td><input type="text" name="nombre_depto" maxlength="200" required /></td>
			</tr>
			<tr>
				<td style="text-align:right;">Nombre Corto del departamento:</td><td><input type="text" name="nombre_corto_depto" maxlength="200" required placeholder="Sin espacios, en minúsculas" /></td>
			</tr>
			<tr>
				<td colspan="2"><button type="reset">limpiar campos</button></td>
				<td colspan="2"><button type="submit">Crear</button></td>
			</tr> 
		</table>
		</form>
		<?php
		//EL SIGUIENTE BLOQUE IF SE EJECUTA PARA CREAR UN NUEVO DEPARTAMENTO SI NO EXISTE:
		if(isset($_POST['nombre_depto']) AND isset($_POST['nombre_corto_depto'])){
			$new_depto = $_POST['nombre_depto'];
			$short_new_depto = $_POST['nombre_corto_depto'];
			$vacantes_depto = $_POST['vacantes_depto'];//Si no se asigna queda por default en 25 vacantes.
			//EN LA SIG. LÍNEA SE AÑADE EL REGISTRO DE LA NUEVA TAE A LA TABLA ´departamentos´.
			mysqli_query($enlace_db,"INSERT INTO departamentos (`nombre`, `nombre_formal`) VALUES('".$short_new_depto."', '".$new_depto."')");
			//AQUÍ SE CREA UNA NUEVA TABLA AL DEPARTAMENTO YA "RESGISTRADO"
			mysqli_query($enlace_db,"CREATE TABLE IF NOT EXISTS `".$short_new_depto."` (
			`id_tae` int(100) NOT NULL AUTO_INCREMENT,
			`nombre_tae` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
			`nombre_formal` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
			`vacantes_totales` int(25) NOT NULL DEFAULT '25',
			PRIMARY KEY (`id_tae`))");
			 header("Location: home-sudo_admin.php");;
			unset($vacantes_dept);
		}	
		?>
		<!-- FOMRMULARIO PARA AÑADIR ALGÚN DEPARTAMENTO FIN -->
		<!-- FOMRMULARIO PARA EDITAR LA INFORMACIÓN DE ALGÚN DEPARTAMENTO-->
		<br>
		<form method="post" action="">
		<table>
			<tr>
				<hr>
				<th><b>Editar Información de Departamentos:</b></th>
			</tr>
			<tr>
				<td style="text-align:right;">
				Elige el Departamento a Editar:
				<select name="editar_depto">
				<?php 
				$lista_deptos =  mysqli_query($enlace_db, "SELECT nombre_formal FROM departamentos");
				$n = mysqli_num_rows($lista_deptos);
				if ($n > 0) {
					while($depto = mysqli_fetch_row($lista_deptos)){
					//$depto[0] = utf8_encode($depto[0]);
					echo "<option value='UPDATE clientes SET nombre=\'José\' WHERE nombre=\'Pepe\''>".$depto[0]."</option>";
					$depto[0] = utf8_decode($depto[0]);
					}
				}
				?>
				</select>
				</td>
			</tr>
			<tr>
				<td style="text-align:right;"><b>Editar nombre de Departamento:</b> </td><td><input type="text" name="ed_nombre_largo_depto" maxlength="200" /></td>
			</tr>
			<tr>
				<td colspan="2"><button type="reset">limpiar campos</button></td>
				<td colspan="2"><button type="submit">Cambiar Nombre</button></td>
			</tr> 
		</table>
		</form>
		<?php
		//
		if(isset($_POST['editar_depto']) ){
			$edit_depto = $_POST['editar_depto'];
			if(isset($_POST['ed_nombre_largo_depto'])){
				$ed_largo_depto = $_POST['ed_nombre_largo_depto'];
				//EN LA SIG. LÍNEA SE RENOMBRA LA TABLA INDICADA.
				mysqli_query($enlace_db,"UPDATE departamentos SET nombre_formal = '".$ed_largo_depto."' WHERE nombre_formal = '".$edit_depto."'");
				 header("Location: home-sudo_admin.php");;
			}
		}
		unset($edit_depto);
		unset($ed_largo_depto);
		?>
		<!-- FOMRMULARIO PARA EDITAR LA INFORMACIÓN DE ALGÚN DEPARTAMENTO FIN-->
	</div>
 </div>
 <script>
	// Obtener modal
	var modal = document.getElementById('edit_depto_modal');
	// cuando se cliquea donde sea entonces cerrar modal:
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
 </script>
 <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
 <button id="edit_tae" onclick="document.getElementById('edit_tae_modal').style.display='block'" type='button' style='border:none;' title="Añadir TAE o modificar alguna"><img src='editar.jpg' width='20px' height='20px'/>Añadir/Editar Taller/TAE</button>
 <br><br>
 <div id="edit_tae_modal" class="modal">
	<div class="modal-content">
		<span onclick="document.getElementById('edit_tae_modal').style.display='none'" class="close" title="Cerrar">&times;</span>
		<table>
			<tr>

				<td style="text-align:center;"><h1><b>Editar Datos de taes/talleres:</b></h1></td>

				<td style="text-align:center;"><h1><b>Editar Datos de TAEs:</b></h1></td>

			</tr>
		</table>
		<!-- FORMULARIO "AÑADIR TAE"-->
		<br/>
		<table>
			<tr>
				<hr>
				<b>Añadir TAE a Departamento:</b>
				
				<form method='post' action=''>
					<td>
					<select name="depto_add_tae" >
						<option id='depto_seleccionado' value=''>--Escoge un departamento para esta TAE--</option>
						<?php 
							$listar_deptos =  mysqli_query($enlace_db, "SELECT nombre_formal FROM departamentos");
							$n = mysqli_num_rows($listar_deptos);
							echo "<div style='border:1px solid black;'>"; 
							if ($n > 0) {
								while($cad_listar_deptos = mysqli_fetch_row($listar_deptos)){
									echo "<hr/>";
									//$cad_listar_deptos[0] = utf8_encode($cad_listar_deptos[0]);
									echo "<option id='depto_seleccionado' value='".$cad_listar_deptos[0]."'>".$cad_listar_deptos[0]."</option>";
								}
							}
						?>
					</select>
					</td>
					<td><input name='add_tae' type='text' placeholder='Nombre de Nueva TAE' />
					<input name='add_short_tae' type='text' placeholder='Nombre Corto TAE' />
					<input name='add_no_tae' type='number' placeholder='Número de vacantes' /></td>
		
					<td colspan="2"><button type="reset">Limpiar Nombre</button></td>
					<td colspan="2"><button type="submit">Añadir TAE</button></td>
				</form>
				<?php
				echo "</div>";
				//LA SIG. LÍNEA ES PARA AÑADIR UNA TAE NUEVA A UN DEPARTAMENTO CORRESPONDIENTE:
				
				if(isset($_POST['add_tae']) AND isset($_POST['add_short_tae']) AND isset($_POST['depto_add_tae'])){
					$nombre_obtenido_depto = $_POST['depto_add_tae'];
					$nombre_obtenido_depto = utf8_decode($nombre_obtenido_depto);
					$obten_nombre_corto_depto =  mysqli_query($enlace_db, "SELECT nombre FROM departamentos WHERE nombre_formal = '".$nombre_obtenido_depto."'");
					$cad_obten_nombre_corto_depto = mysqli_fetch_row($obten_nombre_corto_depto);
					$tae_added = $_POST['add_tae'];//Nombre Largo de TAE a añadir.
					$tae_short_added = $_POST['add_short_tae'];//Nombre Corto de TAE a añadir.
					$no_tae_add = $_POST['add_no_tae'];//Número de TAE añadida.	
					$tae_added = utf8_decode($tae_added);
					$tae_short_added = utf8_decode($tae_short_added);
					
					if(isset($no_tae_add)){
						mysqli_query($enlace_db,"INSERT INTO `".$cad_obten_nombre_corto_depto[0]."` (`nombre_tae`,`nombre_formal`,`vacantes_totales`) VALUES('".$tae_short_added."','".$tae_added."',".$no_tae_add.")");
					}else{
					mysqli_query($enlace_db,"INSERT INTO `".$cad_obten_nombre_corto_depto[0]."` (`nombre_tae`,`nombre_formal`,`vacantes_totales`) VALUES('".$tae_short_added."','".$tae_added."',25)");
					}
					 header("Location: home-sudo_admin.php");;
					$tae_added = '';
					unset($_POST['add_tae']);
					$tae_short_added = '';
					unset($_POST['add_short_tae']);
					$no_tae_add = '';
					unset($_POST['add_no_tae']);
					header('Location: home-sudo_admin.php');
				}
				?>
			</tr>
		</table>
		<!-- FORMULARIO "AÑADIR TAE" FIN-->
		<br/>
		<br/>
		<br/>
		<!-- FORMULARIO "ELIMINAR TAE"-->
		<br/>
			<tr>
				<hr/>
				<table>
				<td><b>Seleccionar una TAE a eliminar:</b></td>
				</table>
		<table>
				<?php
				//LA SIG. PORCIÓN DE CÓDIGO ES PARA COLOCAR UN SELECT DE CADA DEPARTAMENTO CON SUS TAE A CAMBIAR NOMBRE.
				$listar_deptos =  mysqli_query($enlace_db, "SELECT nombre_formal FROM departamentos");
				$n = mysqli_num_rows($listar_deptos);
				
				if ($n > 0) {
					echo "<form method='post' action=''>"; 
					echo "<select name='delete_tae'>";
					echo "<option></option>";
					while($cad_listar_deptos = mysqli_fetch_row($listar_deptos)){
						//$cad_listar_deptos[0] = utf8_encode($cad_listar_deptos[0]);
						echo "<optgroup label='".$cad_listar_deptos[0]."'>";
						//$cad_listar_deptos[0] = utf8_decode($cad_listar_deptos[0]);
						//En base al nombre formal se obtiene el nombre corto en cada iteración:
						$listar_dept_corto = mysqli_query($enlace_db,"SELECT nombre FROM departamentos WHERE nombre_formal = '".$cad_listar_deptos[0]."'");
						$cad_listar_dept_corto = mysqli_fetch_row($listar_dept_corto);
						//Aquí se consulta la tabla con el nombre obtenido anteriormente y además se ponen en cada iteración como una opción a elegir.
						$dime_taes = mysqli_query($enlace_db,"SELECT nombre_formal FROM ".$cad_listar_dept_corto[0]);
						while ($cad_dime_taes = mysqli_fetch_row($dime_taes)){
							echo "<option value='DELETE FROM ".$cad_listar_dept_corto[0]." WHERE nombre_formal = \"".$cad_dime_taes[0]."\"'>".$cad_dime_taes[0]."</option>";
						}
						echo "</optgroup>";
					}
					echo "</select>";
					echo "<button type='submit'>Eliminar TAE</button>";
					echo "</form>";
				}
				
				//EL SIGUIENTE BLOQUE IF SE EJECUTA PARA ELIMINAR UNA TAE:
				if(isset($_POST['delete_tae'])){
					$delete_sentence = $_POST['delete_tae'];
					mysqli_query($enlace_db,$delete_sentence);//Aquì borra la tabla.
					unset($_POST['delete_tae']);
					$delete_sentence='';
					 header("Location: home-sudo_admin.php");;
				}
				?>
			</tr>
			<tr>
				<small>(Recuerde que no se podrá deshacer ésta operación)</small>
			</tr>
		</table>
		<!-- FORMULARIO "ELIMINAR TAE" FIN-->
		<br/>
		<br/>
		<br/>
		<!-- FORMULARIO "EDITAR NOMBRE DE TAE"-->
		<br/>
			<tr>
				<hr/>
				<table>
				<td><b>Seleccionar una TAE a cambiar el nombre:</b></td>
				</table>
		<table>
				<?php
				//LA SIG. PORCIÓN DE CÓDIGO ES PARA COLOCAR UN SELECT DE CADA DEPARTAMENTO CON SUS TAE A CAMBIAR NOMBRE.
				$listar_deptos =  mysqli_query($enlace_db, "SELECT nombre_formal FROM departamentos");
				$n = mysqli_num_rows($listar_deptos);
				echo "<form method='post' action=''>";
				echo "<select name='editar_nombre_tae'>";
				echo "<option></option>";
				if ($n > 0) {
					while($cad_listar_deptos = mysqli_fetch_row($listar_deptos)){
						//$cad_listar_deptos[0] = utf8_encode($cad_listar_deptos[0]);
						echo "<optgroup label='".$cad_listar_deptos[0]."'>";
						//$cad_listar_deptos[0] = utf8_decode($cad_listar_deptos[0]);
						//En base al nombre formal se obtiene el nombre corto en cada iteración:
						$listar_dept_corto = mysqli_query($enlace_db,"SELECT nombre FROM departamentos WHERE nombre_formal = '".$cad_listar_deptos[0]."'");
						$cad_listar_dept_corto = mysqli_fetch_row($listar_dept_corto);
						//Aquí se consulta la tabla con el nombre obtenido anteriormente y además se ponen en cada iteración como una opción a elegir.
						$dime_taes = mysqli_query($enlace_db,"SELECT nombre_formal FROM ".$cad_listar_dept_corto[0]);
						while ($cad_dime_taes = mysqli_fetch_row($dime_taes)){
							echo "<option value='".$cad_listar_dept_corto[0]." ".$cad_dime_taes."'>".$cad_dime_taes[0]."</option>";
							echo "<option value='".$cad_listar_dept_corto[0]." ".$cad_dime_taes[0]."'>".$cad_dime_taes[0]."</option>";

						}
						echo "</optgroup>";
					}
				}
				echo "</select>";

				echo "<input name='rename_tae' type='text' placeholder='Nombre Nuevo de la TAE/Taller' size='29'></input>";
				echo "<p><b>(Para cambiar el número de vacantes, se debe cambiar el nombre, sino, introduzca el mismo nombre anterior así solamente se actualizará el número)</b></p>";
				echo "<input name='reset_vacantes' type='text' placeholder='Nuevo Número de Vacantes' size='29'></input>";
				echo "<button type='submit'>Cambiar Información de TAE/Taller</button>";
				echo "<input name='rename_tae' type='text' placeholder='Nombre Nuevo de la TAE' size='29'></input>";
				echo "<p><b>(Para cambiar el número de vacantes, se debe cambiar el nombre, sino, introduzca el mismo nombre anterior así solamente se actualizará el número)</b></p>";
				echo "<input name='reset_vacantes' type='text' placeholder='Nuevo Número de Vacantes' size='29'></input>";
				echo "<button type='submit'>Cambiar Información de TAE</button>";
				echo "</form>";
				
				$dato_sentence = $_POST['editar_nombre_tae'];
				$rename_sentence = $_POST['rename_tae'];
				$reset_taes_sentence = $_POST['reset_vacantes'];
				if(isset($dato_sentence)){
					$dat = explode(' ',$dato_sentence);
					//Aquí cortamos el valor de vacantes del depto. y la tae para usarlos individualmente:
					mysqli_query($enlace_db,"UPDATE ".$dat[0]." SET nombre_formal ='".$rename_sentence."' WHERE nombre_formal ='".$dat[1]."'");
					if(isset($reset_taes_sentence)){
						mysqli_query($enlace_db,"UPDATE ".$dat[0]." SET vacantes_totales='".$reset_taes_sentence."' WHERE nombre_formal ='".$rename_sentence."'");
					}
				}
				$dato_sentence ='';
				$rename_sentence ='';
				$reset_taes_sentence ='';
				unset($_POST['editar_nombre_tae']);
				unset($_POST['rename_tae']);
				unset($_POST['reset_vacantes']);
				header("Location: home-sudo_admin.php");
				?>
			</tr>
		</table>
		<!-- FORMULARIO "EDITAR NOMBRE DE TAE" FIN-->
	</div>
 </div>
 <script>
	// Obtener modal
	var modal = document.getElementById('edit_tae_modal');
	// cuando se cliquea donde sea entonces cerrar modal:
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
 </script>
 
 <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
 <button id="edit_alumno" onclick="document.getElementById('edit_alumno_modal').style.display='block'" type='button' style='border:none;' title="Añadir Alumno Nuevo o Modificar alguno"><img src='editar.jpg' width='20px' height='20px'/>Añadir/Editar Alumno</button>
  <br><br>
 <div id="edit_alumno_modal" class="modal">	
	<div class="modal-content" method="post" action="">
	<!--AÑADIR ALUMNO-->
	<hr/>
	<form method="post" action="" name="add_single_student">
		<span onclick="document.getElementById('edit_alumno_modal').style.display='none'" class="close" title="Cerrar">&times;</span>
		<table>
			<tr>
				<td style="text-align:center;"><h1>Añadir Alumnos</h1></td>
			</tr>
			<tr>
				<td style="text-align:right;">Nombre(s): </td><td><input type="text" name="add_alumno_nombre" maxlength="300" required></td>
			</tr>
			<tr>
				<td style="text-align:right;">Apellido(s):</td><td><input type="text" name="add_alumno_apellido" maxlength="300" required></td>
			</tr>
			<tr>
				<td style="text-align:right;">Correo: </td><td><input type="email" name="add_alumno_correo" maxlength="100"></td>
			</tr>
			<tr>
				<td style="text-align:right;">Teléfono: </td><td><input type="text" name="add_alumno_tel" maxlength="15" size="15" ></td>
			</tr>
			<tr>
				<td>Número de Alumno:</td><td><input type="text" name="add_alumno_num" maxlength="9" size="15" required></td>
			</tr>
			<tr>
				<td>TAE Perteneciente:</td>

				<td><!--Aquí se listan toodas las taes/talleres que existen actualmente -->

				<td><!--Aquí se listan toodas las TAEs que existen actualmente -->

					<?php
					echo  "<select name='add_alumno_tae' required>";
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
							echo "<option value='".$cad_dime_taes[0]."'>".$cad_dime_taes[0]."</option>";
						}
						echo "</optgroup>";
					}
				}
					echo "</select>";
					?>
				</td>
			</tr>
			<tr>
				<td colspan="2"><button type="reset">limpiar campos</button></td>
				<td colspan="2"><button type="submit">Enviar</button></td>
			</tr> 
		</table>
	</form><!--Aquí el espacio para procesar el formulario para añadir alumnos (uno a uno manualmente)-->
	<?php
	$new_name = $_POST['add_alumno_nombre'];
	$new_lastname = $_POST['add_alumno_apellido'];
	$new_mail = $_POST['add_alumno_correo'];
	$new_tel = $_POST['add_alumno_tel'];
	$new_alumn_num = $_POST['add_alumno_num'];
	$new_alumn_tae = $_POST['add_alumno_tae'];
	//echo $new_name." ".$new_lastname." ".$new_mail." ".$new_tel." ".$new_alumn_num." ".$new_alumn_tae;
	if(isset($new_name)){
		mysqli_query($enlace_db,"INSERT INTO `alumnos_taes`(`apellido`, `nombre`, `no_estudiante`, `telefono`, `correo`, `tae`)
		VALUES ('".$new_lastname."', 
				'".$new_name."', 
				'".$new_alumn_num."',
				'".$new_tel."',
				'".$new_mail."',
				'".$new_alumn_tae."');");
	}
	$new_name ='';
	$new_lastname ='';
	$new_mail ='';
	$new_tel ='';
	$new_alumn_num ='';
	$new_alumn_tae ='';
	unset($_POST['add_single_student']);
	unset($_POST['add_alumno_nombre']);
	unset($_POST['add_alumno_apellido']);
	unset($_POST['add_alumno_correo']);
	unset($_POST['add_alumno_tel']);
	unset($_POST['add_alumno_num']);
	unset($_POST['add_alumno_tae']);
	header("Location: home-sudo_admin.php");
	
	?>
	<hr/>
	<!--AÑADIR ALUMNO FIN-->
	<!--EDITAR INFO ALUMNO-->
	<form method="post" action="" name="edit_single_student">
		<table>
			<tr>
				<td style="text-align:center;"><h1>Editar Alumno:</h1></td>
			</tr>
			<tr>
				<td style="text-align:right;">Alumno:</td>
				<td><!--Aquí se listan toodas las taes/talleres que existen actualmente -->
					<?php
					$listar_alumnos =  mysqli_query($enlace_db, "SELECT apellido, nombre FROM alumnos_taes");
					?>
				<td> <!--Aquí se listan toodas las TAEs que existen actualmente -->
					<?php
					echo  "<select name='alumno_name' required>";
					echo "<option value=''>--Escoja al alumno--</option>";
					$listar_alumnos =  mysqli_query($enlace_db, "SELECT apellido, nombre FROM alumnos_taes");

					$m = mysqli_num_rows($listar_alumnos);
					if ($m > 0) {
						while($cad_listar_alumnos = mysqli_fetch_row($listar_alumnos)){
						$lista_limpia_alumno = $cad_listar_alumnos[0]."&#&".$cad_listar_alumnos[1];
						//Aquí se consultan los alumnos disponibles:
						echo "<option value='".$lista_limpia_alumno."'>".$cad_listar_alumnos[0]." ".$cad_listar_alumnos[1]."</option>";
						}
					}
					echo "</select>";
					?>
				</td>
			</tr>
			<tr>
				<td style="text-align:right;">Escoja el valor a cambiar:</td>
				<td>
					<select name="param_viejo" required>
						<option></option>
						<option value="nombre">Nombre(s)</option>
						<option value="apellido">Apellidos</option>
						<option value="correo">Correo</option>
						<option value="telefono">Teléfono</option>
						<option value="no_estudiante">Número de Estudiante</option>
						<option value="tae">TAE perteneciente</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Nuevo Valor a introducir:</td><td><input type="text" name="param_nuevo" size="15" required /></td>
			</tr>
			<tr>
				<td colspan="2"><button type="reset">limpiar campos</button></td>
				<td colspan="2"><button type="submit">Enviar</button></td>
			</tr> 
		</table>
	</form>
	<?php
		$nombre_alumno_a_modificar = $_POST['alumno_name'];
		$param_viejo_a_mover = $_POST['param_viejo'];
		$nuevo_dato = $_POST['param_nuevo'];
		if(isset($nombre_alumno_a_modificar)){
			$dato_cortado = explode('&#&',$nombre_alumno_a_modificar);
			$cambio_sentence = "UPDATE alumnos_taes SET ".$param_viejo_a_mover." ='".$nuevo_dato."' WHERE apellido ='".$dato_cortado[0]."' AND nombre ='".$dato_cortado[1]."'";
			$cambio_sentence = "UPDATE alumnos_taes SET ".$param_viejo_a_mover." ='".$nuevo_dato."' WHERE apellido ='".$dato_cortado[0]."' AND nombre ='".$dato_cortado[1]."'";
			echo $nombre_alumno_a_modificar."<br>";
			echo $param_viejo_a_mover."<br>";
			echo $nuevo_dato."<br>";
			mysqli_query($enlace_db,$cambio_sentence);
			unset($_POST['alumno_name']);
			unset($_POST['param_viejo']);
			unset($_POST['param_nuevo']);
			$nombre_alumno_a_modificar ='';
			$param_viejo_a_mover ='';
			$nuevo_dato ='';
			header("Location: home-sudo_admin.php");
		}
	?>
	<br>
	<br>
	<!--EDITAR INFO ALUMNO FIN-->
	<!--ELIMINAR ALUMNO -->
	<hr>
	<form method="post" action="" name="delete_single_student">
		<table>
			<tr>
				<td style="text-align:center;"><h1>Eliminar Alumno:</h1></td>
			</tr>
			<tr>
				<td style="text-align:right;">Alumno:</td>
				<td><!--Aquí se listan toodas las taes/talleres que existen actualmente -->
					<?php
					echo  "<select name='alumno_deleted' required>";
					echo "<option></option>";
					$listar_alumnos =  mysqli_query($enlace_db, "SELECT apellido, nombre FROM alumnos_taes");
					?>
				<td><!--Aquí se listan toodas las TAEs que existen actualmente -->
					<?php
					echo  "<select name='alumno_deleted' required>";
					echo "<option></option>";
					$listar_alumnos =  mysqli_query($enlace_db, "SELECT apellido, nombre FROM alumnos_taes");

					$m = mysqli_num_rows($listar_alumnos);
					if ($m > 0) {
						while($cad_listar_alumnos = mysqli_fetch_row($listar_alumnos)){
						$lista_limpia_alumno = $cad_listar_alumnos[0]."&#&".$cad_listar_alumnos[1];
						//Aquí se consultan los alumnos disponibles:
						echo "<option value='".$lista_limpia_alumno."'>".$cad_listar_alumnos[0]." ".$cad_listar_alumnos[1]."</option>";
						}
					}
					echo "</select>";
					?>
				</td>
			</tr>
			<tr>
				<td colspan="2"><button type="reset">limpiar campos</button></td>
				<td colspan="2"><button type="submit">Eliminar Alumno</button></td>
			</tr> 
		</table>
	</form>
	<?php
	$alumno_deleted = $_POST['alumno_deleted'];
	if(isset($alumno_deleted)){
		$datas = explode('&#&', $alumno_deleted);
		mysqli_query($enlace_db,"DELETE FROM alumnos_taes WHERE nombre = '".$datas[1]."' AND apellido ='".$datas[0]."'");
		unset($_POST['alumno_deleted']);
		$alumno_deleted = '';
		header("Location: home-sudo_admin.php");
		mysqli_query( $enlace_db,"DELETE FROM alumnos_taes WHERE nombre = '".$datas[1]."' AND apellido ='".$datas[0]."'");
		unset($_POST['alumno_deleted']);
		$alumno_deleted = '';
	}
	?>
	<!--ELIMINAR ALUMNO FIN-->
	</div>
 </div>
 <script>
	// Obtener modal
	var modal = document.getElementById('edit_alumno_modal');
	// cuando se cliquea donde sea entonces cerrar modal:
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
 </script>
 <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- --> 
 <a href="listaprime.php" target="_blank"><button id="ver_listas" type='button' style='border:none;' title="Solamente visualizar las listas de alumnos de cualquier TAE"><img src='tabla.jpg' width='20px' height='20px'/>Ver Solamente listas</button></a>
 <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- --> 
</aside>
<!--BUSCADOR DE ALUMNOS-->
<section id="buscador">
	<article>
		<button id="global-edit" onclick="openNav()">&#9776; Opciones para Editar</button>
	</article>
</section>

<section id="taes_detalles">

<?php 
	//se consultan solamente las tablas que empiezan con 'depto%' el símbolo '%' es wildcat o comodín pero sólo en SQL 
	$lista_deptos =  mysqli_query($enlace_db, "SELECT nombre_formal FROM departamentos") or die(mysqli_error());
	/*este ciclo es posible gracias a la función que devuelve el número de filas devueltas:
	y solamente se imprimen según su orden normal.*/
	$n = mysqli_num_rows($lista_deptos);
	if ($n > 0) {
		while($depto = mysqli_fetch_row($lista_deptos)){
			//$depto[0] = utf8_encode($depto[0]);
			//print "<a>".$depto[0]."</a><br>";
		}
	}
	/*Aquí se pretende crear un "article" por cada departamento existente

       y con todas sus taes/talleres correspondientes, su número de vacantes actual con
       un botón para editar las propiedades de una o más taes/talleres ó departamentos
       y con todas sus TAEs correspondientes, su número de vacantes actual con
       un botón para editar las propiedades de una o más TAEs ó departamentos*/

	$nombres_formales_deptos =  mysqli_query($enlace_db, "SELECT nombre_formal FROM departamentos") or die(mysqli_error());
	$n = mysqli_num_rows($nombres_formales_deptos);
	if ($n > 0) {//Aquí se imprime cuántos departamentos haya.
		while($depto = mysqli_fetch_row($nombres_formales_deptos)){
			//$depto[0] = utf8_encode($depto[0]);
			echo '<br><hr style="border:2px solid #0c0030;">';
			print "<h1>".$depto[0]."</h1>";
			//$depto[0] = utf8_decode($depto[0]);//Esta línea es muy importante dado que se necesita devolver la cadena su codificación "original" para realizar la consulta, sino devolverá null.

			/*A continuación se nombran las taes/talleres correspondientes de cada departamento
			para ello se obtiene el nombre corto de cada departamento por una consulta,
			después de eso se consultará en la tabla del "nombre corto" de la TAE y 
			por consiguiente se podrá ver cada departamento con TODAS sus taes/talleres*/
			/*EN ESTAS SIGUIENTES LÍNEAS SE HACEN CONSULTAS SQL DEL NOMBRE "CORTO" DEL DEPARTAMENTO EN CADA ITERACIÓN Y LA SIGUIENTE ES PARA
			CONSULTAR LAS taes/talleres (CON NOMBRE "FORMAL") DE CADA DEPARTAMENTO RESPECTIVAMENTE */
			$nombre_corto_depto = mysqli_query($enlace_db, "SELECT nombre FROM departamentos WHERE nombre_formal = '".$depto[0]."'");
			$cad_nombre_corto_depto = mysqli_fetch_row($nombre_corto_depto); 
			
			/*AQUÍ ES DONDE SE EMPIEZAN A MOSTRAR TODAS LAS taes/talleres DE CADA DEPARTAMENTO EN CADA ITERACIÓN (UNA ITERACIÓN POR CADA DEPTO., CLARO)*/
			$lista_de_taes = mysqli_query($enlace_db,"SELECT nombre_formal, vacantes_totales FROM ".$cad_nombre_corto_depto[0]);
			//El arreglo obtenido arriba ahora se imprime en pantalla a manera de: "Nombre de TAE" con "número de vacantes":
			echo "<table border='0' bordercolor='#000000' cellspacing='1px' bordercolor='#000000' style='display:block; float:center;'> 
					<tr> 
						<th style='background-color:#FF55FF; color:white;'>Nombre de TAE</th> 
						<th style='background-color:#FF55FF; color:white;'>Vacantes / Alumnos Registrados:</th>  
					</tr>";
			while($cad_lista_de_taes = mysqli_fetch_row($lista_de_taes)){
				//A continuación se mostrará la cantidad de alumnos registrados al lado de las vacantes establecidas.
				$alumno_realm_reg = mysqli_query($enlace_db,"SELECT count(tae) FROM alumnos_taes WHERE tae='".$cad_lista_de_taes[0]."'");
				$cad_alumno_realm_reg = mysqli_fetch_row($alumno_realm_reg);
				echo "<tr>
						<td style='width:150px; '>".$cad_lista_de_taes[0]."</td>".
						"<td style='text-align:center;'>".$cad_lista_de_taes[1]."	/	".$cad_alumno_realm_reg[0]."</td>
						<td>
							<table border='0'>
								<tr>
									<th style='background-color:#0000FF; color:white;'>Apellido(s)</th> 
									<th style='background-color:#0000FF; color:white;'>Nombre(s)</th>
									<th style='background-color:#0000FF; color:white;'>No. Estudiante</th>
									<th style='background-color:#0000FF; color:white;'>Teléfono</th>
									<th style='background-color:#0000FF; color:white;'>Correo</th> 
								</tr>";
								
						echo "</table>
						</td>
					</tr>";
				echo "<tr border='none' style='background-color:white;'></tr>";
				echo "<tr border='none' style='background-color:white;'></tr>";
				echo "<tr border='none' style='background-color:white;'></tr>";
				echo "<tr border='none' style='background-color:white;'></tr>";
			}
			echo "</table>";
			echo "<br>";
		}
	}else{ echo "No hay nada"; echo "</table>";echo '<br><hr style="border:2px s0olid #0c0030;">';}
?>
</section>

</body>
</html>
