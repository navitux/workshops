<!DOCTYPE html>
<html lang="es">
 <head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link rel="stylesheet" href="index.css" media="all"/> 
	<title>Plazas de TAE's Prepa 3</title>
 </head>
 <body>
	<!-- Mensaje de bienvenida para la página y barra de navegación -->
	<header id="inicio">
		<nav id="myTopnav" class="topnav">
		<img src="prepa3-logo.jpg" style="margin:5px;display:block; float:left; height:35px; width:30px;">
		<a href="#home" class="active">Inicio</a>
		<a href="#taes">Ver TAES por Departamento</a>
		<a href="#">Ver Lista de TAEs</a>
		<a href="#contactos">Contacto</a>
		<a href="login.php" id="login">¿Profesor?</a>
		</nav>
	</header>

	<div id="home">
		<div class="bg-image">
			<div style="padding-top:10%; display:block; position:relative; float:center;">
				<h1 class="bg-text">Bienvenido a TAEs Prepa 3</h1>
				<p class="bg-text">Escoge un departamento y selecciona tu TAE/Taller favorito</p>
				<p class="bg-text"><a href="#taes">¡ Comenzar !</a></p>
			</div>
		</div>
	</div>
	
	<!-- Departamentos de las TAEs -->
	<section id="taes">
		<p>Puedes escoger un departamento para ver sus TAEs/Talleres correspondientes</p>
		<br>
		<div style="text-align:center;">
			<?php 
			//obtener conexión con BD:
			require("conexion.php");
			$enlace_db = conectar();
			if(! $enlace_db){
				echo "¡Hubo un error con la conexión a Base de Datos!";
			}
			$dpt = mysqli_query($enlace_db,"SELECT nombre_formal,nombre FROM departamentos ORDER BY nombre_formal ASC") or die();
			while($cad_dpt = mysqli_fetch_row($dpt)){
				
				echo "<a href='#".$cad_dpt[1]."'>".$cad_dpt[0]."</a><br>";
			}
			?>
			
		</div>
	</section>
	<div class="corto" id="fondo-taes1"></div>
	<!-- _______ -->
	
		<!-- Opciones -->
		<!--Se introducen "modal" de formulario de -->
		<!--formulario para inscripción a la TAE -->
		<!--NOTA: Modal es un panel que muestra información -->
		<!--en primer plano y que se cierra dando clic fuera de él -->
		<!--o con un botón-->
		
		<!-- __________ -->
		<?php
		$dpt = mysqli_query($enlace_db,"SELECT nombre_formal,nombre FROM departamentos ORDER BY nombre_formal ASC") or die();
		while($cad_dpt = mysqli_fetch_row($dpt)){
				echo "<section id='".$cad_dpt[1]."'>";
				echo "<h1>".$cad_dpt[0]."</h1>";
				$taller = mysqli_query($enlace_db,"SELECT nombre_formal,nombre_tae FROM ".$cad_dpt[1]." ORDER BY nombre_formal ASC") or die();
				while($cad_taller = mysqli_fetch_row($taller)){
					echo "<article id='".$cad_taller[1]."'>";
					echo "<h1>".$cad_taller[0]."</h1>";
					echo "<br>"; ?>
					<button onclick="document.getElementById(<?php echo "'".$cad_taller[1]."'";?>).style.display='block'">Formulario de Inscripción</button>
					<div id="proteccivil" class="modal">	
						<form class="modal-contenido animate" method="post" action="">
							 <span onclick="document.getElementById(<?php echo "'".$cad_taller[1]."'";?>).style.display='none'" class="close" title="Cerrar">&times;</span>
							<table>
								<tr>
									<td style="text-align:center;"><h1>Protección Civil</h1></td>
								</tr>
								<tr>
									<td style="text-align:right;">Nombre(s): </td><td><input type="text" name="nombres" required></td>
								</tr>
								<tr>
									<td style="text-align:right;">Apellido Paterno: </td><td><input type="text" name="apellido_pa" required></td>
								</tr>
								<tr>
									<td style="text-align:right;">Apellido Materno: </td><td><input type="text" name="apellido_ma"></td>
								</tr>
								<tr>
									<td>Número de Alumno:</td><td><input type="number" name="cod_alumno" minlength="9" maxlength="9" required></td><td>Turno: <select name="turno" required><option selected>Matutino</option><option>Vespertino</option></select></td>
								</tr>
								<tr>
									<td colspan="2"><button type="reset">limpiar campos</button></td>
									<td colspan="2"><button type="submit">Enviar</button></td>
								</tr> 
							</table>
						</form>
					</div>
				<script>
				// Obtener modal
				var modal = document.getElementById(<?php echo "'".$cad_taller[1]."'";?>);
				// cuando se cliquea donde sea entonces cerrar modal:
				window.onclick = function(event) {
				if (event.target == modal) {
					modal.style.display = "none";
					}
				}
				</script>
			<?php	echo "</article>";
				}
				echo "</section>";
				echo "<br><br><br><br><br><br><br><br><br><br>";
			}
		
		?>
		<div class="corto" id="fondo-taes1"></div>
		<footer id="contactos" style="background-color:black; color:white; text-align:center;">
				<div>
					<p>Escuela Preparatoria No. 3  Contáctanos: tel.: 33333333 e-mail: dgsgdgsg@ggsdgg.com </p>
					<p>Dirección: Goméz De Mendiola y Álvarez Del Castillo no. 333 col. Oblatos, Guadalajara, Jalisco</p>
				</div>
		</footer>
 </body>
</html>
