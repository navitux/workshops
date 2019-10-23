﻿<!DOCTYPE html>
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
		<a href="#contactos">Contacto</a>
		<a href="login.php" id="login">¿Profesor?</a>
		</nav>
	</header>

	
	
	<!-- Departamentos de las TAEs -->
	<section id="taes">
		<p>Bienvenido</p>
		<p>Puedes escoger un departamento para ver sus TAEs/Talleres correspondientes</p>
		<br>
		<div style="text-align:center;">
			<style>
				.accordion {
					background-color: #eee;
					color: #444;
					cursor: pointer;
					padding: 18px;
					width: 100%;
					text-align: left;
					border: none;
					outline: none;
					transition: 0.4s;
					outline: none;
				}
				/* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
				.active, .accordion:hover {
					background-color: #ccc;
					outline: none;
				}
				
				.openmodal{
					background-color: #fff;
					color: #444;
					cursor: pointer;
					padding: 18px;
					width: 100%;
					text-align: left;
					border: none;
					outline: none;
					transition: 0.4s;
					outline: none;
				}

				/* Style the accordion panel. Note: hidden by default */
				.panel {
					padding: 0 18px;
					background-color: white;
					display: none;
					overflow: hidden;
					color:black;
				}
				
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
  overflow:auto;
}
			</style>
			<?php 
			//obtener conexión con BD:
			require("conexion.php");
			$enlace_db = conectar();
			if(! $enlace_db){
				echo "¡Hubo un error con la conexión a Base de Datos!";
			}
			$dpt = mysqli_query($enlace_db,"SELECT nombre_formal,nombre FROM departamentos ORDER BY nombre_formal ASC") or die();
			while($cad_dpt = mysqli_fetch_row($dpt)){
				echo "<button class='accordion'>".$cad_dpt[0]."</button>";
				$taller = mysqli_query($enlace_db,"SELECT nombre_formal,nombre_tae FROM ".$cad_dpt[1]." ORDER BY nombre_formal ASC") or die();
				echo "<div class='panel'>";
				while($cad_taller = mysqli_fetch_row($taller)){
					echo "<button class='openmodal' id='btn-".$cad_taller[1]."'>".$cad_taller[0]."</button><br>";
				}
				echo "</div>";
			}
			?>
		</div>
	</section>
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
	acc[i].addEventListener("click", function() {
	/* Toggle between adding and removing the "active" class,
	to highlight the button that controls the panel */
	this.classList.toggle("active");
	
	/* Toggle between hiding and showing the active panel */
	var panel = this.nextElementSibling;
	if (panel.style.display === "block") {
		panel.style.display = "none";
	} else {
		panel.style.display = "block";
	}
	});
} 
</script>
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
				
				$taller = mysqli_query($enlace_db,"SELECT nombre_formal,nombre_tae FROM ".$cad_dpt[1]." ORDER BY nombre_formal ASC") or die();
				while($cad_taller = mysqli_fetch_row($taller)){
					
		?>
					<script>
					// Obtener modal
					var modal<?php echo "_".$cad_taller[1];?> = document.getElementById(<?php echo "'".$cad_taller[1]."'";?>);
					// cuando se cliquea donde sea entonces cerrar modal:
					window.onclick = function(event) {
						if (event.target == modal<?php echo "_".$cad_taller[1];?>) {
						modal<?php echo "_".$cad_taller[1];?>.style.display = "none";
						}
					}
					</script>
					<style>
/* The Close Button */
<?php echo "#close-".$cad_taller[1];?>{
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

<?php echo "#close-".$cad_taller[1].":hover";?>,
<?php echo "#close-".$cad_taller[1].":focus";?> {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
					</style>
					<div id=<?php echo "'modal_".$cad_taller[1]."'";?> class="modal">
						<div class="modal-content">
						<span id=<?php echo "'close-".$cad_taller[1]."'";?> title="Cerrar">&times;</span>
						<b><?php echo $cad_taller[0]; ?></b>
						<form  method="post" action="">
							<table>
								<tr>
									<td>Número de Alumno:</td><td><input type="number" name="cod_alumno" minlength="9" maxlength="9" required></td>
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
									<td>Número de teléfono:</td><td><input type="number" name="tel_alumno" maxlength="15" placeholder="opcional"></td>
								</tr>
								<tr>
									<td style="text-align:right;">Correo: </td><td><input type="e-mail" name="correo_alumno" placeholder="opcional"></td>
								</tr>
								<tr>
									<td colspan="2"><button type="reset">limpiar campos</button></td>
									<td colspan="2"><button type="submit">Enviar</button></td>
								</tr> 
							</table>
						</form>
						</div>
					</div>
<script>
// Get the modal
var modal<?php echo "_".$cad_taller[1];?> = document.getElementById(<?php echo "'modal_".$cad_taller[1]."'";?>);

// Get the button that opens the modal
var btn = document.getElementById(<?php echo "'btn-".$cad_taller[1]."'";?>);

// Get the <span> element that closes the modal
var span = document.getElementById(<?php echo "'close-".$cad_taller[1]."'";?>);

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal<?php echo "_".$cad_taller[1];?>.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal<?php echo "_".$cad_taller[1];?>.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
modal<?php echo "_".$cad_taller[1];?>.onclick = function(event) {
  
    modal<?php echo "_".$cad_taller[1];?>.style.display = "none";
}
</script>
			<?php
				}
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
